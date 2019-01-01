<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableUserInvestigations;


class UserInvestigation extends Model
{
    public const INVESTIGATION_PROPERTY = 'investigation_id';
    public const USER_PROPERTY = 'user_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','auth_code', 'state', 'create_time', 'send_time', 'submit_time', 'update_time', 'validation_time','investigation_id', 'user_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'auth_code',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableUserInvestigations::table();
        parent::__construct($attributes);
    }

    public function investigation(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Investigation','investigation_id');
    } 

    public function user(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\User','user_id');
    } 
}
