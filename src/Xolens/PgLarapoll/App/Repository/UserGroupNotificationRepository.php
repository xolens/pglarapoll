<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\UserGroupNotification;
use Xolens\LarapollContract\App\Contract\Repository\UserGroupNotificationRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableUserGroupNotifications;

class UserGroupNotificationRepository extends AbstractWritableRepository implements UserGroupNotificationRepositoryContract
{
    public function model(){
        return UserGroupNotification::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $userGroupId = self::get($data,'user_group_id');
        $notificationId = self::get($data,'notification_id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableUserGroupNotifications::table())->where(function ($query) use($id, $userGroupId, $notificationId) {
                return $query->where('id','!=', $id)->where('user_group_id', $userGroupId)->where('notification_id', $notificationId);
            })
        ],];
    }//*/
    
}
