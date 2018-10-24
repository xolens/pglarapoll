<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PglarapollCreateFunctionCreateSelectFormValuesQuery extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'function_create_select_form_values_query';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE FUNCTION ".self::table()."(integer)
            RETURNS text AS
            $$
            DECLARE
            query  text = 'user_group_notification_id integer';          
            temprow record;
            BEGIN
                FOR temprow IN
                    select
                        ".PgLarapollCreateTableFields::table().".name as field_name
                    from
                    (select * from ".PgLarapollCreateTableFormFields::table()." where form_id = $1) as form_fields
                    left join ".PgLarapollCreateTableFields::table()." on form_fields.field_id = ".PgLarapollCreateTableFields::table().".id
                LOOP
                    query := query || ', ' || regexp_replace(temprow.field_name, '[^\w]+','_', 'g') || ' text';
                END LOOP;

                RETURN 'select * from ".PgLarapollCreateFunctionSelectFormValues::table()."('||$1||') as form_field_values(' || query|| ');';
            END;
            $$
            LANGUAGE plpgsql;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        DB::unprepared("DROP FUNCTION IF EXISTS ".self::table()."(integer);");
    }
}

