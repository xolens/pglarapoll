<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PglarapollCreateTriggerInvestigationChanges extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'trigger_investigation_changes';
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
                        INSERT INTO ".PgLarapollCreateTableUserInvestigations::table()."(state, create_time, user_id,investigation_id)
                        SELECT 'CREATED', NOW(), id, NEW.id from ".PgLarapollCreateTableUsers::table()." where group_id=NEW.group_id;
                    ELSEIF TG_OP = 'UPDATE' THEN
                        NEW.group_id = OLD.group_id;
                        NEW.form_id = OLD.form_id;
                    ELSEIF TG_OP = 'DELETE' THEN
                        DELETE FROM ".PgLarapollCreateTableUserInvestigations::table()." WHERE investigation_id = OLD.id; 
                        RETURN OLD;
                    END IF;
                    RETURN NEW;
                END;
            $$;
        
            CREATE TRIGGER ".self::table()." AFTER INSERT OR UPDATE OR DELETE ON ".PgLarapollCreateTableInvestigations::table()." FOR EACH ROW
                EXECUTE PROCEDURE ".$triggerFunction."();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        DB::unprepared("DROP TRIGGER ".self::table()." ON ".PgLarapollCreateTableInvestigations::table().";");
    }
}

