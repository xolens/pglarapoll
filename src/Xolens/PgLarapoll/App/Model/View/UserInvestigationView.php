<?php

namespace Xolens\PgLarapoll\App\Model\View;
use Illuminate\Database\Eloquent\Model;

use PgLarapollCreateViewUserInvestigation;



class UserInvestigationView extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLarapollCreateViewUserInvestigation::table();
        parent::__construct($attributes);
    }
}

