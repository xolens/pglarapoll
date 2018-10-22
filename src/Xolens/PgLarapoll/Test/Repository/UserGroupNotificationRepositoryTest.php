<?php

namespace Xolens\PgLarapoll\Test\Repository;

use Xolens\PgLarapoll\App\Repository\UserGroupNotificationRepository;
use Xolens\PgLarapoll\App\Repository\UserGroupRepository;
use Xolens\PgLarapoll\App\Repository\NotificationRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLarapoll\Test\WritableTestPgLarapollBase;

final class UserGroupNotificationRepositoryTest extends WritableTestPgLarapollBase
{
    protected $userGroupRepo;
    protected $notificationRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new UserGroupNotificationRepository();
        $this->userGroupRepo = new UserGroupRepository();
        $this->notificationRepo = new NotificationRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $userGroupId = $this->userGroupRepo->model()::inRandomOrder()->first()->id;
        $notificationId = $this->notificationRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            'state' => 'state'.$i,
            'user_group_id' => $userGroupId,
            'notification_id' => $notificationId,
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
            $notificationId = $this->notificationRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                'state' => 'state'.$i,
                'user_group_id' => $userGroupId,
                'notification_id' => $notificationId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   

