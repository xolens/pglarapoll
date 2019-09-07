<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableFields;


class Field extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type', 'name', 'display_text', 'required', 'value_list', 'description', 
        'size', 'default_value'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableFields::table();
        parent::__construct($attributes);
    }
}
