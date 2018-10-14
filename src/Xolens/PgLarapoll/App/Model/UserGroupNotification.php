<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableUserGroupNotifications;


class UserGroupNotification extends Model
{
    public const USER_GROUP_PROPERTY = 'user_group_id';
    public const NOTIFICATION_PROPERTY = 'notification_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_group_id', 'notification_id', 'state', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableUserGroupNotifications::table();
        parent::__construct($attributes);
    }

    public function userGroup(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\UserGroup','user_group_id');
    } 

    public function notification(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Notification','notification_id');
    } 
}
