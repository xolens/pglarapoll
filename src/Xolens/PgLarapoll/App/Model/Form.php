<?php

namespace Xolens\PgLarapoll\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateTableForms;


class Form extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateTableForms::table();
        parent::__construct($attributes);
    }
}
