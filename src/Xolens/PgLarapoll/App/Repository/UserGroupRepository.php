<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\UserGroup;
use Xolens\PollContract\App\Contract\Repository\UserGroupRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableUserGroups;

class UserGroupRepository extends AbstractWritableRepository implements UserGroupRepositoryContract
{
    public function model(){
        return UserGroup::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $groupId = self::get($data,'group_id');
        $userId = self::get($data,'user_id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableUserGroups::table())->where(function ($query) use($id, $groupId, $userId) {
                return $query->where('id','!=', $id)->where('group_id', $groupId)->where('user_id', $userId);
            })],
        ];
    }//*/
    
}
