<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateViewUserGroup extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'user_group_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLarapollCreateTableUserGroups::table();
        $groupTable = PgLarapollCreateTableGroups::table();
        $userTable = PgLarapollCreateTableUsers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    ".$groupTable.".name as group_name,
                    ".$userTable.".name as user_name,
                    ".$userTable.".email as user_email,
                    ".$userTable.".phone as user_phone
                FROM ".$mainTable." 
                    LEFT JOIN ".$groupTable." ON ".$groupTable.".id = ".$mainTable.".group_id
                    LEFT JOIN ".$userTable." ON ".$userTable.".id = ".$mainTable.".user_id
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

