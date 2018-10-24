<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\Field;
use Xolens\PollContract\App\Contract\Repository\FieldRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableFields;

class FieldRepository extends AbstractWritableRepository implements FieldRepositoryContract
{
    public function model(){
        return Field::class;
    }
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'name' => [Rule::unique(PgLarapollCreateTableFields::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })],
        ];
    }
    
}
