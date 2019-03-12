<?php

namespace Modules\Owner\Services\Impl;

use Modules\Common\Entities\OwnerPet;
use Modules\Common\Services\Impl\CommonService;
use Modules\Owner\Services\Intf\IOwnerPetService;
use Illuminate\Support\Facades\DB;

class OwnerPetService extends CommonService implements IOwnerPetService
{
    protected function getDefaultModel()
    {
        return OwnerPet::getTableName();
    }

    protected function getDefaultClass()
    {
        return OwnerPet::class;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function search($filter)
    {

    }

    public function create($arrInput)
    {
        $ownerPets = new OwnerPet($arrInput);
        DB::beginTransaction();
        try {
            $ownerPets->save();
            DB::commit();
            return $ownerPets;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
