<?php

namespace Xolens\PgLarapoll\Test\Repository\View;

use Xolens\PgLarapoll\App\Repository\View\UserGroupNotificationViewRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLarapoll\Test\ReadOnlyTestPgLarapollBase;

final class UserGroupNotificationViewRepositoryTest extends ReadOnlyTestPgLarapollBase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new UserGroupNotificationViewRepository();
        $this->repo = $repo;
    }

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id');
                //->asc('name');
        return $sorter;
    }

    public function generateFilterer(){
        $filterer = new Filterer();
        $filterer->between('id',[0,14]);
                //->like('name','%tab%');
        return $filterer;
    }
}

