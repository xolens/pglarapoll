<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PglarapollCreateTriggerUserInvestigationChanges extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'trigger_user_investigation_changes';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $triggerFunction = self::table()."_function";
        DB::unprepared("
            CREATE OR REPLACE FUNCTION ".$triggerFunction."() RETURNS trigger
            LANGUAGE plpgsql AS $$
                BEGIN
                    IF TG_OP = 'INSERT' THEN
                        INSERT INTO ".PgLarapollCreateTableFormFieldValues::table()."(user_investigation_id, form_field_id)
                        SELECT NEW.id, id as form_field_id  from ".PgLarapollCreateTableFormFields::table()." WHERE form_id in (
                            SELECT form_id from ".PgLarapollCreateTableInvestigations::table()." WHERE id = NEW.investigation_id
                        );

                    ELSEIF TG_OP = 'UPDATE' THEN
                        
                    ELSEIF TG_OP = 'DELETE' THEN
                        DELETE FROM ".PgLarapollCreateTableFormFieldValues::table()." WHERE user_investigation_id = OLD.id; 
                        RETURN OLD;
                    END IF;
                    RETURN NEW;
                END;
            $$;
        
            CREATE TRIGGER ".self::table()." AFTER INSERT OR UPDATE OR DELETE ON ".PgLarapollCreateTableUserInvestigations::table()." FOR EACH ROW
                EXECUTE PROCEDURE ".$triggerFunction."();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        DB::unprepared("DROP TRIGGER ".self::table()." ON acces_groupes;");
    }
}

