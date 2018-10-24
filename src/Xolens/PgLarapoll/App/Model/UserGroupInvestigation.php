<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableUserGroupInvestigations;


class UserGroupInvestigation extends Model
{
    public const USER_GROUP_PROPERTY = 'user_group_id';
    public const NOTIFICATION_PROPERTY = 'investigation_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'state', 'user_group_id', 'investigation_id', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableUserGroupInvestigations::table();
        parent::__construct($attributes);
    }

    public function userGroup(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\UserGroup','user_group_id');
    } 

    public function investigation(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Investigation','investigation_id');
    } 
}
