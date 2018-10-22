<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateViewFormFieldValue extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'form_field_value_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLarapollCreateTableFormFieldValues::table();
        $formFieldTable = PgLarapollCreateTableFormFields::table();
        $userGroupNotificationTable = PgLarapollCreateTableUserGroupNotifications::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*
                FROM ".$mainTable." 
                    LEFT JOIN ".$formFieldTable." ON ".$formFieldTable.".id = ".$mainTable.".form_field_id
                    LEFT JOIN ".$userGroupNotificationTable." ON ".$userGroupNotificationTable.".id = ".$mainTable.".user_group_notification_id
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

