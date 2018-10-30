<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateViewUserInvestigation extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'user_investigation_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLarapollCreateTableUserInvestigations::table();
        $userTable = PgLarapollCreateTableUsers::table();
        $investigationTable = PgLarapollCreateTableInvestigations::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    ".$userTable.".name as user_name,
                    ".$userTable.".email as user_email,
                    ".$userTable.".phone as user_phone,
                    ".$investigationTable.".name as investigation_name,
                    ".$investigationTable.".title as investigation_title
                FROM ".$mainTable." 
                    LEFT JOIN ".$userTable." ON ".$userTable.".id = ".$mainTable.".user_id
                    LEFT JOIN ".$investigationTable." ON ".$investigationTable.".id = ".$mainTable.".investigation_id
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

