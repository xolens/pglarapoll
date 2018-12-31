<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateFunctionSelectFormValues extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'function_select_form_values';
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
            RETURNS SETOF record AS
            --RETURNS text AS
            $$
            DECLARE
            selectors  text = '';          
            joins  text = '';           
            joins_separator  character varying(50) = '';           
            using_stm  character varying(50) = '';           
            subselect_prefix character varying(10) = 'selection';           
            newl character varying(10) = E'\n';
            ltab1 character varying(10) = E'\n\t';
            ltab2 character varying(10) = E'\n\t\t';
            /*
            newl character varying(1) = ' ';
            ltab1 character varying(1) = ' ';
            ltab2 character varying(1) = ' ';
            --*/
            temprow record;
            loopIndex integer = 1;
            BEGIN
                FOR temprow IN
                    select 
                        form_fields.id,
                        ".PgLarapollCreateTableFields::table().".id as field_id, 
                        ".PgLarapollCreateTableFields::table().".name as field_name
                    from
                    (select * from ".PgLarapollCreateTableFormFields::table()." where form_id = $1) as form_fields
                    left join ".PgLarapollCreateTableFields::table()." on form_fields.field_id = ".PgLarapollCreateTableFields::table().".id
                    order by field_id
                LOOP
                    selectors := selectors || ',' || ltab1 || subselect_prefix || loopIndex || '.value as \"' || temprow.field_name || '\"';
                    joins := joins || joins_separator || 
                        '(SELECT value, user_investigation_id from ".PgLarapollCreateTableFormFieldValues::table()." where form_field_id in (select id from ".PgLarapollCreateTableFormFields::table()." where form_id = ' || $1 || ' and field_id = ' || temprow.field_id ||'))' 
                        || ' as ' || subselect_prefix || loopIndex || using_stm;
                    
                    joins_separator := ltab1 || ' JOIN ';
                    using_stm := ' using (user_investigation_id)';
                    loopIndex := loopIndex+1;
                END LOOP;

                IF FOUND THEN
                    -- RETURN 'SELECT' || ltab1 || 'selection1.user_investigation_id' ||selectors || newl || ' FROM ' || ltab1 || joins || ';';
                    RETURN QUERY EXECUTE 'SELECT' || ltab1 || 'selection1.user_investigation_id' ||selectors || newl || ' FROM ' || ltab1 || joins || ';';
                END IF;
            
                --RETURN 'NOT FOUND !';
                RETURN;
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

