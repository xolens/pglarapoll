<?php

namespace Xolens\PgLarapoll\App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Xolens\LarautilContract\App\Repository\RepositoryResponse;
use Xolens\PgLarapoll\App\Model\Investigation;
use Xolens\PgLarapoll\App\Model\User;
use Xolens\PgLarapoll\App\Model\UserInvestigation;
use Xolens\PgLarapoll\App\Model\FormFieldValue;
use Xolens\PgLarapoll\App\Model\View\FormFieldValueView;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use PglarapollCreateFunctionCreateSelectInvestigationValuesQuery;

class InvestigationService {
        
    public static function getNotifyInfos($investigationId, $userInvestigationId){
        try{
            $investigation= Investigation::findOrFail($investigationId);
            $userInvestigation= UserInvestigation::findOrFail($userInvestigationId);
            $user = User::findOrFail($userInvestigation->user_id);
            return [
                'success'=>true,
                'user' => $user,
                'investigation' => $investigation,
                'userInvestigation' => $userInvestigation,
            ];
        }catch(\Exception $e){
                return [
                    'success'=>false,
                    'errors' => [$e->getMessage()],
                ];
        }
    }
    public static function initInvestigation($investigationId, $filterType, $filters = [], array $userInvestigationIdentifiers =[]){
        $investigationId = (int) $investigationId;
        $query = "
            with user_investigation_selection as (
                UPDATE pglarapoll_user_investigations
                SET 
                    state = 'CREATED'
                WHERE 
                    investigation_id = ".$investigationId." AND (
                         ".self::equalsAsBoolString($filterType, 'all')." OR 
                        (".self::equalsAsBoolString($filterType, 'selection')." AND id in ".self::intArrayToSqlString($userInvestigationIdentifiers,-1)." ) OR
                        (".self::equalsAsBoolString($filterType, 'filters')." AND state in ".self::stringArrayToSqlQuottedString($filters,'NONE').")
                    )
                RETURNING id
            )
            select id from user_investigation_selection
        ";
        return self::returnResponse(DB::select(DB::raw($query)));
    }

    public static function equalsAsBoolString($val, $cmpVal){
        return $val == $cmpVal ? 'true':'false';
    }

    public static function intArrayToSqlString(array $values, $emptyVal){
        $sqlString = '(';
        if($values == null || count($values)==0){
            $sqlString .= (int) $emptyVal;
        }else {
            $sqlString .= (int) $values[0];
            for($i=1; $i<count($values); $i++){
                $sqlString .= ", ".((int) $values[$i]);
            }
        }
        $sqlString .= ')';
        return $sqlString;
    }

    public static function stringArrayToSqlQuottedString(array $values, $emptyVal){
        $sqlString = '(';
        if($values == null || count($values)==0){
            $sqlString .= "'".$emptyVal."'";
        }else {
            $sqlString .= "'".$values[0]."'";
            for($i=1; $i<count($values); $i++){
                $sqlString .= ", '".$values[$i]."'";
            }
        }
        $sqlString .= ')';
        return $sqlString;
    }
    public static function paginateValue($investId, $perPage, $page, $orderProperty, $orderDirection, $likePatern = '%'){
        $result = PglarapollCreateFunctionCreateSelectInvestigationValuesQuery::executeInvestigationValuesQuery($investId, $perPage, $page, $orderProperty, $orderDirection, $likePatern);
        return self::returnResponse(['data'=>$result]);
    }
        
    public static function updateValue(array $data){
        $userInvestigationId = (int) $data['user_investigation_id'];
        unset($data['user_investigation_id']);
        DB::transaction(function () use ($userInvestigationId, $data){
            foreach ($data as $key => $value) {
                $fieldId = (int) str_replace('field_','',$key);
                $formFieldValue = FormFieldValueView::where('user_investigation_id',$userInvestigationId)->where('field_id',$fieldId)->first();
                if($formFieldValue){
                    FormFieldValue::where('user_investigation_id',$userInvestigationId)
                                    ->where('form_field_id',$formFieldValue->form_field_id)
                                    ->update(['value' => $value]);
                }
            }
        });
        return self::returnResponse(true);
    }
    public static function returnResponse($response){
        $resp = new RepositoryResponse();
        $resp->setSuccess(true);
        $resp->setResponse($response);
        return $resp;
    }
    
    public static function returnErrors($errors){
        $err = new RepositoryResponse();
        $err->setSuccess(false);
        $err->setErrors($errors);
        return $err;
    }
}
