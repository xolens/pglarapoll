<?php

namespace Xolens\PgLarapoll\Test\Repository;

use Xolens\PgLarapoll\App\Repository\FieldRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLarapoll\Test\WritableTestPgLarapollBase;

final class FieldRepositoryTest extends WritableTestPgLarapollBase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new FieldRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $types = ['Integer', 'Number', 'Boolean', 'String', 'Date', 'Select',];
        $index = rand(0, 5);
        $i = rand(0, 10000);
        $item = $this->repository()->make([
            'type' => $types[$index],            'name' => 'name'.$i,
            'display_text' => 'display_text'.$i,
            'required' => 'required'.$i,
            'value_list' => 'valueList'.$i,
            'description' => 'description'.$i,
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
        $types = ['Integer', 'Number', 'Boolean', 'String', 'Date', 'Select',];
        $index = rand(0, 5);
        for($i=$count; $i<($toGenerateCount+$count); $i++){
            $item = $this->repository()->create([
                'type' => $types[$index],
                'name' => 'name'.$i,
                'display_text' => 'display_text'.$i,
                'required' => $i%2==0,
                'value_list' => 'valueList'.$i,
                'description' => 'description'.$i,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   

