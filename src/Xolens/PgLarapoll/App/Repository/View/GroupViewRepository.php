<?php

namespace Xolens\PgLarapoll\App\Repository\View;

use Xolens\PgLarapoll\App\Model\Group;
use Xolens\PgLarapoll\App\Model\View\GroupView;
use Xolens\PollContract\App\Contract\Repository\View\GroupViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\LarautilContract\App\Util\Model\Sorter;

class GroupViewRepository extends AbstractReadableRepository implements GroupViewRepositoryContract
{
    public function model(){
        return GroupView::class;
    }
}
