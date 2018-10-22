<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateViewUserGroupNotification extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'user_group_notification_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLarapollCreateTableUserGroupNotifications::table();
        $notificationTable = PgLarapollCreateTableNotifications::table();
        $userGroupTable = PgLarapollCreateTableUserGroups::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    ".$notificationTable.".name as notification_name,
                    ".$notificationTable.".title as notification_title
                FROM ".$mainTable." 
                    LEFT JOIN ".$notificationTable." ON ".$notificationTable.".id = ".$mainTable.".notification_id
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

