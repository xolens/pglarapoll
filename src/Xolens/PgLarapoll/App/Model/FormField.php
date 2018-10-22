<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableFormFields;


class FormField extends Model
{
    public const FORM_PROPERTY = 'form_id';
    public const FIELD_PROPERTY = 'field_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'field_position', 'form_id', 'field_id', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableFormFields::table();
        parent::__construct($attributes);
    }

    public function form(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Form','form_id');
    } 

    public function field(){
        return $this->belongsTo('Xolens\PgLarapoll\App\Model\Field','field_id');
    } 
}
