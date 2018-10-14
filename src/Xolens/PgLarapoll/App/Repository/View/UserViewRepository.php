<?php

namespace Xolens\PgLarapoll\App\Repository\View;

use Xolens\PgLarapoll\App\Model\User;
use Xolens\PgLarapoll\App\Model\View\UserView;
use Xolens\LarapollContract\App\Contract\Repository\View\UserViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\LarautilContract\App\Util\Model\Sorter;

class UserViewRepository extends AbstractReadableRepository implements UserViewRepositoryContract
{
    public function model(){
        return UserView::class;
    }
}
