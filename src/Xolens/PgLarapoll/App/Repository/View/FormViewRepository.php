<?php

namespace Xolens\PgLarapoll\App\Repository\View;

use Xolens\PgLarapoll\App\Model\Form;
use Xolens\PgLarapoll\App\Model\View\FormView;
use Xolens\PollContract\App\Contract\Repository\View\FormViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\LarautilContract\App\Util\Model\Sorter;

class FormViewRepository extends AbstractReadableRepository implements FormViewRepositoryContract
{
    public function model(){
        return FormView::class;
    }
}
