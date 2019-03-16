<?php

namespace Modules\Cart\Services\Impl;

use Modules\Common\Entities\Cart;
use Modules\Common\Services\Impl\CommonService;
use Modules\Cart\Services\Intf\ICartService;
use Illuminate\Support\Facades\DB;

class CartService extends CommonService implements ICartService
{
    protected function getDefaultModel()
    {
        return Cart::getTableName();
    }

    protected function getDefaultClass()
    {
        return Cart::class;
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
        $rResult = Cart::where('id', '=', $id)->first();
        return array('owner' => $rResult);
    }

    public function create($arrInput)
    {
        $owner = new Cart($arrInput);
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
            $owner = Cart::find($id);
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
