<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\FormField;
use Xolens\PollContract\App\Contract\Repository\FormFieldRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableFormFields;

class FormFieldRepository extends AbstractWritableRepository implements FormFieldRepositoryContract
{
    public function model(){
        return FormField::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $formId = self::get($data,'form_id');
        $fieldId = self::get($data,'field_id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableFormFields::table())->where(function ($query) use($id, $formId, $fieldId) {
                return $query->where('id','!=', $id)->where('form_id', $formId)->where('field_id', $fieldId);
            })],
        ];
    }
    //*/
    
}
