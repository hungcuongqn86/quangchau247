<?php

namespace Modules\Pet\Services\Impl;

use Modules\Common\Entities\PetType;
use Modules\Common\Services\Impl\CommonService;
use Modules\Pet\Services\Intf\IPettypeService;
use Illuminate\Support\Facades\DB;

class PettypeService extends CommonService implements IPettypeService
{
    protected function getDefaultModel()
    {
        return PetType::getTableName();
    }

    protected function getDefaultClass()
    {
        return PetType::class;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function search($filter)
    {
        $query = PetType::where('is_deleted', '=', 0);
        $rResult = $query->get(['id', 'name'])->toArray();
        return $rResult;
    }

    public function findById($id)
    {
        $rResult = PetType::where('id', '=', $id)->first();
        return array('pettype' => $rResult);
    }

    public function findByIds($ids)
    {
        $rResult = PetType::wherein('id', $ids)->get()->toArray();
        return $rResult;
    }

    public function create($arrInput)
    {
        $pettype = new PetType($arrInput);
        DB::beginTransaction();
        try {
            $pettype->save();
            DB::commit();
            return $pettype;
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
            $pettype = PetType::find($id);
            $pettype->update($arrInput);
            DB::commit();
            return $pettype;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($ids)
    {
        DB::beginTransaction();
        try {
            PetType::wherein('id', $ids)->update(['is_deleted' => 1]);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
