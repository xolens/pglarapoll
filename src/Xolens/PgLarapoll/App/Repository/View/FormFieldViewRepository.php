<?php

namespace Xolens\PgLarapoll\App\Repository\View;

use Xolens\PgLarapoll\App\Model\FormField;
use Xolens\PgLarapoll\App\Model\View\FormFieldView;
use Xolens\PgLarapoll\App\Repository\View\FormFieldViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLarautil\App\Util\Model\Sorter;

class FormFieldViewRepository extends AbstractReadableRepository implements FormFieldViewRepositoryContract
{
    public function model(){
        return FormFieldView::class;
    }
     public function paginateByForm($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FORM_PROPERTY, $parentId);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
     }

     public function paginateByFormSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FORM_PROPERTY, $parentId);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
     }

     public function paginateByFormFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FORM_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
     }

     public function paginateByFormSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FORM_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
     }

     public function paginateByField($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FIELD_PROPERTY, $parentId);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
     }

     public function paginateByFieldSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FIELD_PROPERTY, $parentId);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
     }

     public function paginateByFieldFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FIELD_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
     }

     public function paginateByFieldSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(FormField::FIELD_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
     }

}
