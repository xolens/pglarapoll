<?php

namespace Xolens\PgLarapoll\App\Repository\View;

use Xolens\PgLarapoll\App\Model\Field;
use Xolens\PgLarapoll\App\Model\View\FieldView;
use Xolens\PgLarapoll\App\Repository\View\FieldViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLarautil\App\Util\Model\Sorter;

class FieldViewRepository extends AbstractReadableRepository implements FieldViewRepositoryContract
{
    public function model(){
        return FieldView::class;
    }
}
