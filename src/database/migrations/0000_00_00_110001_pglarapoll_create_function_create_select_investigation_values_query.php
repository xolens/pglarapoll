<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PglarapollCreateFunctionCreateSelectInvestigationValuesQuery extends PgLarapollMigration
{
    public static function invoque($id){
        $result = DB::select('select '.self::table().' (?) as query', [$id]);
        if($result[0]->query){
            return $result[0]->query;
        }
        return false;
    }

    public static function executeInvestigationValuesQuery($investId, $perPage, $page, $orderProperty, $orderDirection, $likePatern = '%'){
        $partialQuery = PglarapollCreateFunctionCreateSelectInvestigationValuesQuery::invoque($investId);
        if($partialQuery){
            $orderDirection = ($orderDirection == 'ASC'?'ASC':'DESC');
            $orderProperty = ( $orderProperty == null?'user_email':$orderProperty );
            $orderProperty = preg_replace('/[^\w]+/','_', $orderProperty);
            $result = DB::select(DB::raw('
                WITH investigation_values as (
                    '.$partialQuery.'
                )
                SELECT 
                    investigation_values.*,

                    '.PgLarapollCreateTableUserInvestigations::table().'.state as user_investigation_state,
                    '.PgLarapollCreateTableUserInvestigations::table().'.create_time as user_investigation_create_time,
                    '.PgLarapollCreateTableUserInvestigations::table().'.send_time as user_investigation_send_time,
                    '.PgLarapollCreateTableUserInvestigations::table().'.submit_time as user_investigation_submit_time,
                    '.PgLarapollCreateTableUserInvestigations::table().'.update_time as user_investigation_update_time,
                    '.PgLarapollCreateTableUserInvestigations::table().'.validation_time as user_investigation_validation_time,

                    count(investigation_values.user_investigation_id) OVER() as total,
                    '.PgLarapollCreateTableUsers::table().'.name as user_name,
                    '.PgLarapollCreateTableUsers::table().'.email as user_email,
                    '.PgLarapollCreateTableUsers::table().'.phone as user_phone,
                    '.PgLarapollCreateTableUsers::table().'.category as user_category
                FROM 
                investigation_values
                JOIN '.PgLarapollCreateTableUserInvestigations::table().' ON investigation_values.user_investigation_id =  '.PgLarapollCreateTableUserInvestigations::table().'.id
                JOIN '.PgLarapollCreateTableUsers::table().' ON '.PgLarapollCreateTableUsers::table().'.id =  '.PgLarapollCreateTableUserInvestigations::table().'.user_id
                ORDER BY '.$orderProperty.' '.$orderDirection.'
                LIMIT ? OFFSET ? 
            '),[$perPage, ($page-1)*$perPage]);
            return $result;
        }
        return [];
    }
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'function_create_select_investigation_values_query';
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
            query  text = '';          
            temprow record;
            BEGIN
                FOR temprow IN
                    with current_investigation as (
                        select * from pglarapoll_investigations where id = $1
                    )
                    select
                    ".PgLarapollCreateTableFields::table().".id as field_id,
                    ".PgLarapollCreateTableFields::table().".name as field_name
                    from
                    (select * from ".PgLarapollCreateTableFormFields::table()." where form_id = (select form_id from current_investigation)) as form_fields
                    left join ".PgLarapollCreateTableFields::table()." on form_fields.field_id = ".PgLarapollCreateTableFields::table().".id
                LOOP
                    query := query || ', ' || CONCAT('field_', temprow.field_id) || ' text';
                END LOOP;
                IF (query='') THEN
                    RETURN NULL;
                ELSE
                    RETURN 'with current_investigation as (select * from ".PgLarapollCreateTableInvestigations::table()." where id = ' || $1 || ') select * from ".PgLarapollCreateFunctionSelectFormValues::table()."((select form_id from current_investigation)) as form_field_values(user_investigation_id integer' || query|| ')';
                END IF;
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

