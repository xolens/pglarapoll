<?php

namespace Xolens\PgLarapoll\Test\Repository;

use Xolens\PgLarapoll\App\Repository\NotificationRepository;
use Xolens\PgLarapoll\App\Repository\GroupRepository;
use Xolens\PgLarapoll\App\Repository\FormRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLarapoll\Test\WritableTestPgLarapollBase;

final class NotificationRepositoryTest extends WritableTestPgLarapollBase
{
    protected $groupRepo;
    protected $formRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new NotificationRepository();
        $this->groupRepo = new GroupRepository();
        $this->formRepo = new FormRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $groupId = $this->groupRepo->model()::inRandomOrder()->first()->id;
        $formId = $this->formRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            'group_id' => $groupId,
            'form_id' => $formId,
            'name' => 'name'.$i,
            'title' => 'title'.$i,
            'text' => 'text'.$i,
            'type' => 'type'.$i,
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
            $groupId = $this->groupRepo->model()::inRandomOrder()->first()->id;
            $formId = $this->formRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                'group_id' => $groupId,
                'form_id' => $formId,
                'name' => 'name'.$i,
                'title' => 'title'.$i,
                'text' => 'text'.$i,
                'type' => 'type'.$i,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   

