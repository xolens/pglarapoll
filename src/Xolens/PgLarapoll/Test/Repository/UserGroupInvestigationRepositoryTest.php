<?php

namespace Xolens\PgLarapoll\Test\Repository;

use Xolens\PgLarapoll\App\Repository\UserGroupInvestigationRepository;
use Xolens\PgLarapoll\App\Repository\UserGroupRepository;
use Xolens\PgLarapoll\App\Repository\InvestigationRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLarapoll\Test\WritableTestPgLarapollBase;

final class UserGroupInvestigationRepositoryTest extends WritableTestPgLarapollBase
{
    protected $userGroupRepo;
    protected $investigationRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new UserGroupInvestigationRepository();
        $this->userGroupRepo = new UserGroupRepository();
        $this->investigationRepo = new InvestigationRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $userGroupId = $this->userGroupRepo->model()::inRandomOrder()->first()->id;
        $investigationId = $this->investigationRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            'state' => 'state'.$i,
            'user_group_id' => $userGroupId,
            'investigation_id' => $investigationId,
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
            $userGroupId = $this->userGroupRepo->model()::inRandomOrder()->first()->id;
            $investigationId = $this->investigationRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                'state' => 'state'.$i,
                'user_group_id' => $userGroupId,
                'investigation_id' => $investigationId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   

