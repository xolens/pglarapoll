<?php

namespace Xolens\PgLarapoll\Test;

use DB;
use Xolens\PgLarautil\Test\CleanSchemaBase;

final class CleanSchemaTest extends CleanSchemaBase
{
    protected function getPackageProviders($app): array{
        return [
            'Xolens\PgLarapoll\PgLarapollServiceProvider',
        ];
    }
}
