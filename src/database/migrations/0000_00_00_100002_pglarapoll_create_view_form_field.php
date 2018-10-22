<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateViewFormField extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'form_field_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLarapollCreateTableFormFields::table();
        $fieldTable = PgLarapollCreateTableFields::table();
        $formTable = PgLarapollCreateTableForms::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    ".$fieldTable.".name as field_name,
                    ".$formTable.".name as form_name
                FROM ".$mainTable." 
                    LEFT JOIN ".$fieldTable." ON ".$fieldTable.".id = ".$mainTable.".field_id
                    LEFT JOIN ".$formTable." ON ".$formTable.".id = ".$mainTable.".form_id
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

