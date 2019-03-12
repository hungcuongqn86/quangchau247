<?php

namespace Modules\Owner\Services\Impl;

use Modules\Common\Entities\Owner;
use Modules\Common\Services\Impl\CommonService;
use Modules\Owner\Services\Intf\IOwnerService;
use Illuminate\Support\Facades\DB;

class OwnerService extends CommonService implements IOwnerService
{
    protected function getDefaultModel()
    {
        return Owner::getTableName();
    }

    protected function getDefaultClass()
    {
        return Owner::class;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function search($filter)
    {

    }

    public function findById($id)
    {
        $rResult = Owner::where('id', '=', $id)->first();
        return array('owner' => $rResult);
    }

    public function create($arrInput)
    {
        $owner = new Owner($arrInput);
        DB::beginTransaction();
        try {
            $owner->save();
            DB::commit();
            return $owner;
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
            $owner = Owner::find($id);
            $owner->update($arrInput);
            DB::commit();
            return $owner;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
