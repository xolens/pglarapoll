<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\UserGroupInvestigation;
use Xolens\PollContract\App\Contract\Repository\UserGroupInvestigationRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableUserGroupInvestigations;

class UserGroupInvestigationRepository extends AbstractWritableRepository implements UserGroupInvestigationRepositoryContract
{
    public function model(){
        return UserGroupInvestigation::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $userGroupId = self::get($data,'user_group_id');
        $investigationId = self::get($data,'investigation_id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableUserGroupInvestigations::table())->where(function ($query) use($id, $userGroupId, $investigationId) {
                return $query->where('id','!=', $id)->where('user_group_id', $userGroupId)->where('investigation_id', $investigationId);
            })],
        ];
    }
    //*/
    
}
