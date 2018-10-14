<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\User;
use Xolens\LarapollContract\App\Contract\Repository\UserRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableUsers;

class UserRepository extends AbstractWritableRepository implements UserRepositoryContract
{
    public function model(){
        return User::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableUsers::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })
        ],];
    }//*/
    
}
