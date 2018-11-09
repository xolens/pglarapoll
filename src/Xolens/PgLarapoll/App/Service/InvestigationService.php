<?php

namespace Xolens\PgLarapoll\App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Xolens\LarautilContract\App\Repository\RepositoryResponse;
use Xolens\PgLarapoll\App\Model\FormFieldValue;
use Xolens\PgLarapoll\App\Model\View\FormFieldValueView;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use PglarapollCreateFunctionCreateSelectInvestigationValuesQuery;

class InvestigationService {
        
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
