<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateViewField extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'field_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLarapollCreateTableFields::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*
                FROM ".$mainTable." 
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS ".self::table());
    }
}

