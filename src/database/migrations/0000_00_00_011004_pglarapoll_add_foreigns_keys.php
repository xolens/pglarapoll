<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

use Xolens\PgLarapoll\App\Util\PgLarapollMigration;

class PgLarapollAddForeignsKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(PgLarapollCreateTableUsers::table(), function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on(PgLarapollCreateTableGroups::table())->onDelete('cascade');      
        });
        Schema::table(PgLarapollCreateTableFormFields::table(), function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on(PgLarapollCreateTableForms::table())->onDelete('cascade');      
            $table->foreign('field_id')->references('id')->on(PgLarapollCreateTableFields::table())->onDelete('cascade');      
        });
        Schema::table(PgLarapollCreateTableInvestigations::table(), function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on(PgLarapollCreateTableForms::table())->onDelete('cascade');      
            $table->foreign('group_id')->references('id')->on(PgLarapollCreateTableGroups::table())->onDelete('cascade');      
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table(PgLarapollCreateTableUsers::table(), function (Blueprint $table) {
            $table->dropForeign(['group_id']);      
        });
        Schema::table(PgLarapollCreateTableFormFields::table(), function (Blueprint $table) {
            $table->dropForeign(['form_id','field_id']);      
        });
        Schema::table(PgLarapollCreateTableInvestigations::table(), function (Blueprint $table) {
            $table->dropForeign(['form_id','group_id']);      
        });
        
    }
}