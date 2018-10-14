<?php

namespace Xolens\PgLarapoll\App\Util;

use Illuminate\Support\Facades\DB;

abstract class PgLarapollMigration extends AbstractPgLarapollMigration
{
    public static function tablePrefix(){
        return config('xolens-config.pglarapoll-database_table_prefix');
    }

    public static function triggerPrefix(){
        return config('xolens-config.pglarapoll-database_trigger_prefix');
    }

    public static function logEnabled(){
        return config('xolens-config.pglarapoll-enable_database_log');
    }
}
