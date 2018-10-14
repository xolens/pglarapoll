<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableUserGroups;


class UserGroup extends Model
{
    public const GROUP_PROPERTY = 'group_id';
    public const USER_PROPERTY = 'user_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'group_id', 'user_id', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableUserGroups::table();
        parent::__construct($attributes);
    }

    public function group(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Group','group_id');
    } 

    public function user(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\User','user_id');
    } 
}
