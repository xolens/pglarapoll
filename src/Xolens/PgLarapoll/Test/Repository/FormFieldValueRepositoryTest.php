<?php

namespace Xolens\PgLarapoll\Test\Repository;

use Xolens\PgLarapoll\App\Repository\FormFieldValueRepository;
use Xolens\PgLarapoll\App\Repository\UserGroupInvestigationRepository;
use Xolens\PgLarapoll\App\Repository\FormFieldRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLarapoll\Test\WritableTestPgLarapollBase;

final class FormFieldValueRepositoryTest extends WritableTestPgLarapollBase
{
    protected $userGroupInvestigationRepo;
    protected $formFieldRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new FormFieldValueRepository();
        $this->userGroupInvestigationRepo = new UserGroupInvestigationRepository();
        $this->formFieldRepo = new FormFieldRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $userGroupInvestigationId = $this->userGroupInvestigationRepo->model()::inRandomOrder()->first()->id;
        $formFieldId = $this->formFieldRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            'value' => 'value'.$i,
            'user_group_investigation_id' => $userGroupInvestigationId,
            'form_field_id' => $formFieldId,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id');
        return $sorter;
    }

    public function generateFilterer(){
        $filterer = new Filterer();
        $filterer->between('id',[0,14]);
        return $filterer;
    }

    public function generateItems($toGenerateCount){
        $count = $this->repository()->count()->response();
        $generatedItemsId = [];
        
        for($i=$count; $i<($toGenerateCount+$count); $i++){
            $userGroupInvestigationId = $this->userGroupInvestigationRepo->model()::inRandomOrder()->first()->id;
            $formFieldId = $this->formFieldRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                'value' => 'value'.$i,
                'user_group_investigation_id' => $userGroupInvestigationId,
                'form_field_id' => $formFieldId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   

