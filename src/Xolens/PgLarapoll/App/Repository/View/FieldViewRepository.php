<?php

namespace Xolens\PgLarapoll\App\Repository\View;

use Xolens\PgLarapoll\App\Model\Field;
use Xolens\PgLarapoll\App\Model\View\FieldView;
use Xolens\PollContract\App\Contract\Repository\View\FieldViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\LarautilContract\App\Util\Model\Sorter;

class FieldViewRepository extends AbstractReadableRepository implements FieldViewRepositoryContract
{
    public function model(){
        return FieldView::class;
    }
}
