<?php

namespace Xolens\PgLarapoll\Test\Repository;

use Xolens\PgLarapoll\App\Repository\UserGroupRepository;
use Xolens\PgLarapoll\App\Repository\GroupRepository;
use Xolens\PgLarapoll\App\Repository\UserRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLarapoll\Test\WritableTestPgLarapollBase;

final class UserGroupRepositoryTest extends WritableTestPgLarapollBase
{
    protected $groupRepo;
    protected $userRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new UserGroupRepository();
        $this->groupRepo = new GroupRepository();
        $this->userRepo = new UserRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $groupId = $this->groupRepo->model()::inRandomOrder()->first()->id;
        $userId = $this->userRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            'group_id' => $groupId,
            'user_id' => $userId,
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
            $userId = $this->userRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                'group_id' => $groupId,
                'user_id' => $userId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   

