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
                    CONCAT('field_',".$fieldTable.".id) as field_identifier,
                    ".$fieldTable.".name as field_name,
                    ".$fieldTable.".display_text as field_display_text,
                    ".$fieldTable.".type as field_type,
                    ".$fieldTable.".required as field_required,
                    ".$fieldTable.".value_list as field_value_list,
                    ".$fieldTable.".description as field_description,
                    ".$formTable.".name as form_name,
                    ".$formTable.".description as form_description
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

