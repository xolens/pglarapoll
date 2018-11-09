<?php

namespace Xolens\PgLarapoll\App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Xolens\LarautilContract\App\Repository\RepositoryResponse;
use Xolens\PgLarapoll\App\Model\FormFieldValue;
use Xolens\PgLarapoll\App\Model\View\FormFieldValueView;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use PgLarapollCreateTableUsers;

class UserService {
        
    public static function importFromSelectionQuery($grouId, $category, $selectionQuery, $attrMap=['name'=>'name','email'=>'email','phone'=>'phone','gender'=>'gender']){
        return self::returnResponse(DB::select(DB::raw('
            WITH data_selection as (
                '.$selectionQuery.'
            )
            INSERT INTO '.PgLarapollCreateTableUsers::table().'
                (name, email, phone, gender, group_id, category)
            SELECT data_selection.'.$attrMap['name'].', data_selection.'.$attrMap['email'].', data_selection.'.$attrMap['phone'].', data_selection.'.$attrMap['gender'].', ?, ? FROM data_selection
            ON CONFLICT (group_id, email) DO UPDATE 
            SET name = excluded.name, 
                email = excluded.email, 
                gender = excluded.gender, 
                phone = excluded.phone;
        '),[$grouId, $category,]));
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
