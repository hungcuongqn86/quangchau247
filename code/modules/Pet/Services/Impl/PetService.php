<?php

namespace Modules\Pet\Services\Impl;

use Modules\Common\Entities\Pet;
use Modules\Common\Entities\OwnerPet;
use Modules\Common\Services\Impl\CommonService;
use Modules\Pet\Services\Intf\IPetService;
use Illuminate\Support\Facades\DB;

class PetService extends CommonService implements IPetService
{
    protected function getDefaultModel()
    {
        return Pet::getTableName();
    }

    protected function getDefaultClass()
    {
        return Pet::class;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function search($filter)
    {
        $query = Pet::with(['PetType', 'PetMedia'])->with(['OwnerPet' => function ($query) {
            $query->with(['Owner']);
        }]);

        $ipettype = isset($filter['pettype']) ? $filter['pettype'] : 0;
        if ($ipettype > 0) {
            $query->where('pet_type_id', '=', $ipettype);
        }

        $iowner = isset($filter['owner']) ? $filter['owner'] : 0;
        if ($iowner > 0) {
            $objOwnerPet = OwnerPet::where('owner_id', '=', $iowner);
            $arrPetId = $objOwnerPet->pluck('pet_id')->toArray();
            $query->whereIn('id', $arrPetId);
        }

        $query->where('is_deleted', '=', 0);

        $limit = isset($filter['limit']) ? $filter['limit'] : config('const.LIMIT_PER_PAGE');
        $rResult = $query->paginate($limit)->toArray();
        return $rResult;
    }

    public function findById($id)
    {
        $rResult = Pet::with(['PetType', 'PetMedia'])->with(['OwnerPet' => function ($query) {
            $query->with(['Owner']);
        }])->where('id', '=', $id)->first();
        return array('pet' => $rResult);
    }

    public function create($arrInput)
    {
        $pet = new Pet($arrInput);
        DB::beginTransaction();
        try {
            $pet->save();
            DB::commit();
            return $pet;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($arrInput)
    {
        $id = $arrInput['id'];
        DB::beginTransaction();
        try {
            $pet = Pet::find($id);
            $pet->update($arrInput);
            DB::commit();
            return $pet;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
