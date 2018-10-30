<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollCreateTableUserInvestigations extends PgLarapollMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'user_investigations';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::table(), function (Blueprint $table) {
            $table->increments('id');
            $table->enum('state',['CREATED','SEND','SUBMITED', 'UPDATED', 'VALIDATED']);
            $table->timestamp('create_time');
            $table->timestamp('send_time')->nullable();
            $table->timestamp('submit_time')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->timestamp('validation_time')->nullable();
            $table->integer('user_id')->index();
            $table->integer('investigation_id')->index();
        });
        if(self::logEnabled()){
            self::registerForLog();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(self::logEnabled()){
            self::unregisterFromLog();
        }
        Schema::dropIfExists(self::table());

    }
}
