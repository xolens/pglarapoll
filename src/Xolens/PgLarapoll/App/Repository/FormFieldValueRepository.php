<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\FormFieldValue;
use Xolens\PgLarapoll\App\Repository\FormFieldValueRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableFormFieldValues;

class FormFieldValueRepository extends AbstractWritableRepository implements FormFieldValueRepositoryContract
{
    public function model(){
        return FormFieldValue::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $userInvestigationId = self::get($data,'user_investigation_id');
        $formFieldId = self::get($data,'form_field_id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableFormFieldValues::table())->where(function ($query) use($id, $userInvestigationId, $formFieldId) {
                return $query->where('id','!=', $id)->where('user_investigation_id', $userInvestigationId)->where('form_field_id', $formFieldId);
            })],
        ];
    }
    //*/
    
}
