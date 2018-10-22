<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableNotifications;


class Notification extends Model
{
    public const GROUP_PROPERTY = 'group_id';
    public const FORM_PROPERTY = 'form_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'title', 'text', 'type', 'group_id', 'form_id', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableNotifications::table();
        parent::__construct($attributes);
    }

    public function group(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Group','group_id');
    } 

    public function form(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Form','form_id');
    } 
}
