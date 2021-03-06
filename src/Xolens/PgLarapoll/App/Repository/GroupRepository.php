<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\Group;
use Xolens\PgLarapoll\App\Repository\GroupRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableGroups;

class GroupRepository extends AbstractWritableRepository implements GroupRepositoryContract
{
    public function model(){
        return Group::class;
    }
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'name' => [Rule::unique(PgLarapollCreateTableGroups::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })],
        ];
    }
    
}
