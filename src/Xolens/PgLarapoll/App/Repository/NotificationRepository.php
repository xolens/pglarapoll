<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\Notification;
use Xolens\LarapollContract\App\Contract\Repository\NotificationRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableNotifications;

class NotificationRepository extends AbstractWritableRepository implements NotificationRepositoryContract
{
    public function model(){
        return Notification::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $groupId = self::get($data,'group_id');
        $formId = self::get($data,'form_id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableNotifications::table())->where(function ($query) use($id, $groupId, $formId) {
                return $query->where('id','!=', $id)->where('group_id', $groupId)->where('form_id', $formId);
            })
        ],];
    }//*/
    
}
