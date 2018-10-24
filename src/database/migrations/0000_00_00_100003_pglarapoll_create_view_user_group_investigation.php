<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateViewUserGroupInvestigation extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'user_group_investigation_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLarapollCreateTableUserGroupInvestigations::table();
        $investigationTable = PgLarapollCreateTableInvestigations::table();
        $userGroupTable = PgLarapollCreateTableUserGroups::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    ".$investigationTable.".name as investigation_name,
                    ".$investigationTable.".title as investigation_title
                FROM ".$mainTable." 
                    LEFT JOIN ".$investigationTable." ON ".$investigationTable.".id = ".$mainTable.".investigation_id
                    LEFT JOIN ".$userGroupTable." ON ".$userGroupTable.".id = ".$mainTable.".user_group_id
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

