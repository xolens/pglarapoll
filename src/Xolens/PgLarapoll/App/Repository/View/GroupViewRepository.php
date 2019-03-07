<?php

namespace Xolens\PgLarapoll\App\Repository\View;

use Xolens\PgLarapoll\App\Model\Group;
use Xolens\PgLarapoll\App\Model\View\GroupView;
use Xolens\PgLarapoll\App\Repository\View\GroupViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLarautil\App\Util\Model\Sorter;

class GroupViewRepository extends AbstractReadableRepository implements GroupViewRepositoryContract
{
    public function model(){
        return GroupView::class;
    }
}
