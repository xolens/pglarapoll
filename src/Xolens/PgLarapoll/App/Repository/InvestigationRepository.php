<?php

namespace Xolens\PgLarapoll\App\Repository;

use Xolens\PgLarapoll\App\Model\Investigation;
use Xolens\PollContract\App\Contract\Repository\InvestigationRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLarapollCreateTableInvestigations;

class InvestigationRepository extends AbstractWritableRepository implements InvestigationRepositoryContract
{
    public function model(){
        return Investigation::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $groupId = self::get($data,'group_id');
        $formId = self::get($data,'form_id');
        return [
            'id' => ['required',Rule::unique(PgLarapollCreateTableInvestigations::table())->where(function ($query) use($id, $groupId, $formId) {
                return $query->where('id','!=', $id)->where('group_id', $groupId)->where('form_id', $formId);
            })],
            'name' => [Rule::unique(PgLarapollCreateTableInvestigations::table())->where(function ($query) use($id, $groupId, $formId) {
                return $query->where('id','!=', $id)->where('group_id', $groupId)->where('form_id', $formId);
            })],
        ];
    }
    //*/
    
}
