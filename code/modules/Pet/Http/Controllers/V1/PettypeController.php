<?php

namespace Modules\Pet\Http\Controllers\V1;

use Modules\Common\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Pet\Services\PetServiceFactory;

class PettypeController extends CommonController
{
    /**
     * @SWG\Get(
     *      path="/mpet/pettype/search",
     *      operationId="getPettypesList",
     *      tags={"Pettype"},
     *      summary="Get list of pettypes",
     *      description="Returns list of pettypes",
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns list of pettypes
     */

    public function index()
    {
        return $this->sendResponse([], 'Successfully.');
    }

    public function search(Request $request)
    {
        $input = $request->all();
        try {
            return $this->sendResponse(PetServiceFactory::mPettypeService()->search($input), 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\Get(
     *      path="/mpet/pettype/detail/{id}",
     *      operationId="getPettypeDetai",
     *      tags={"Pettype"},
     *      summary="Get pettype detail",
     *      description="Returns detail of pettype",
     *      @SWG\Parameter(
     *          name="id",
     *          description="ID loại thú nuôi",
     *          required=true,
     *          type="integer",
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns list of pets
     */
    public function detail($id)
    {
        try {
            return $this->sendResponse(PetServiceFactory::mPettypeService()->findById($id), 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\POST(
     *      path="/mpet/pettype/create",
     *      operationId="postCreatePettype",
     *      tags={"Pettype"},
     *      summary="Create Pettype",
     *      description="Returns Pettype detail",
     *      @SWG\Parameter(
     *         description="Loại thú nuôi",
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(
     *             type="object",
     *              @SWG\Property(property="name", type="string"),
     *         )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns Pettype detail
     */
    public function create(Request $request)
    {
        $input = $request->all();
        try {
            $arrRules = [
                'name' => 'required',
            ];
            $arrMessages = [
                'name.required' => 'ERRORS_MS.BAD_REQUEST.NAME.REQUIRED',
            ];

            $validator = Validator::make($input, $arrRules, $arrMessages);
            if ($validator->fails()) {
                return $this->sendError('Error', $validator->errors()->all());
            }

            $create = PetServiceFactory::mPettypeService()->create($input);
            return $this->sendResponse($create, 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\PUT(
     *      path="/mpet/pettype/update",
     *      operationId="putUpdatePettype",
     *      tags={"Pettype"},
     *      summary="Update Pettype Info",
     *      description="Returns Pettype detail",
     *      @SWG\Parameter(
     *         description="Loại thú nuôi",
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(
     *             type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *         )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns Pettype detail
     */

    public function update(Request $request)
    {
        $input = $request->all();
        try {
            $arrRules = [
                'id' => 'required',
                'name' => 'required',
            ];
            $arrMessages = [
                'id.required' => 'ERRORS_MS.BAD_REQUEST.ID.REQUIRED',
                'name.required' => 'ERRORS_MS.BAD_REQUEST.NAME.REQUIRED',
            ];

            $validator = Validator::make($input, $arrRules, $arrMessages);
            if ($validator->fails()) {
                return $this->sendError('Error', $validator->errors()->all());
            }
            $update = PetServiceFactory::mPettypeService()->update($input);
            return $this->sendResponse($update, 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\DELETE(
     *      path="/mpet/pettype/delete",
     *      operationId="deletePettypes",
     *      tags={"Pettype"},
     *      summary="Delete Pettypes",
     *      description="Returns bol successful or error",
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="list id of Pettypes",
     *          required=true,
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(
     *                  type="integer",
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *      ),
     *      @SWG\Response(response=400, description="Bad request"),
     *      security={
     *           {"api_key_security_example": {}}
     *      }
     *   )
     *
     * Returns bol successful or error
     */

    public function delete(Request $request)
    {
        $input = $request->all();
        $pettypes = PetServiceFactory::mPettypeService()->findByIds($input);
        $deleteData = array();
        $errData = array();
        foreach ($input as $id) {
            $check = false;
            foreach ($pettypes as $pettype) {
                if ($id == $pettype['id']) {
                    $check = true;
                    $pettype['is_deleted'] = 1;
                    $deleteData[] = $pettype;
                }
            }
            if (!$check) {
                $errData[] = 'Pettype Id ' . $id . ' NotExist';
            }
        }

        if (!empty($errData)) {
            return $this->sendError('Error', $errData);
        }

        try {
            PetServiceFactory::mPettypeService()->delete($input);
            return $this->sendResponse(true, 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }
}
