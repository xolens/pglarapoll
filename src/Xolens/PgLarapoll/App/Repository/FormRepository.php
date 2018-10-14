<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\Form;
use Xolens\LarapollContract\App\Contract\Repository\FormRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableForms;

class FormRepository extends AbstractWritableRepository implements FormRepositoryContract
{
    public function model(){
        return Form::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableForms::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })
        ],];
    }//*/
    
}
