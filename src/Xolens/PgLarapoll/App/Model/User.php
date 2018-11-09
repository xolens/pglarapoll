<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;
use Xolens\LarautilContract\App\Util\Format\Formater;
use PgLarapollCreateTableUsers;


class User extends Model
{
    public const GROUP_PROPERTY = 'group_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'phone', 'category', 'gender', 'group_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableUsers::table();
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->phone = Formater::formatPhone($model->phone);
        });
        
        self::updating(function($model){
            $model->phone = Formater::formatPhone($model->phone);
        });
    }
}
