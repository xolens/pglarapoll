<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableFormFieldValues;


class FormFieldValue extends Model
{
    public const USER_GROUP_NOTIFICATION_PROPERTY = 'user_group_notification_id';
    public const FORM_FIELD_PROPERTY = 'form_field_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'value', 'user_group_notification_id', 'form_field_id', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableFormFieldValues::table();
        parent::__construct($attributes);
    }

    public function userGroupNotification(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\UserGroupNotification','user_group_notification_id');
    } 

    public function formField(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\FormField','form_field_id');
    } 
}
