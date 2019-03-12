<?php

namespace Modules\Pet\Http\Controllers\V1;

use Modules\Common\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Pet\Services\PetServiceFactory;
use Modules\Owner\Services\OwnerServiceFactory;
use Modules\Common\Services\CommonServiceFactory;

class PetController extends CommonController
{
    public function index()
    {
        return $this->sendResponse([], 'Successfully.');
    }

    /**
     * @SWG\Get(
     *      path="/mpet/pet/search",
     *      operationId="getPetsList",
     *      tags={"Pet"},
     *      summary="Get list of pets",
     *      description="Returns list of pets",
     *      @SWG\Parameter(
     *          name="pettype",
     *          description="Loại thú nuôi",
     *          required=false,
     *          type="integer",
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="owner",
     *          description="Chủ sở hữu",
     *          required=false,
     *          type="integer",
     *          in="query"
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

    public function search(Request $request)
    {
        $input = $request->all();
        try {
            return $this->sendResponse(PetServiceFactory::mPetService()->search($input), 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\Get(
     *      path="/mpet/pet/detail/{id}",
     *      operationId="getPetDetai",
     *      tags={"Pet"},
     *      summary="Get pet detail",
     *      description="Returns detail of pet",
     *      @SWG\Parameter(
     *          name="id",
     *          description="ID thú nuôi",
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
            return $this->sendResponse(PetServiceFactory::mPetService()->findById($id), 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\POST(
     *      path="/mpet/pet/create",
     *      operationId="postCreatePet",
     *      tags={"Pet"},
     *      summary="Create Pet",
     *      description="Returns Pet detail",
     *      @SWG\Parameter(
     *         description="images is list file id, example '2,5,36,1'",
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(
     *             type="object",
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="owner_id", type="integer"),
     *              @SWG\Property(property="pet_type_id", type="integer"),
     *              @SWG\Property(property="gender", type="integer"),
     *              @SWG\Property(property="birth_day", type="string"),
     *              @SWG\Property(property="dead_day", type="string"),
     *              @SWG\Property(property="age", type="integer"),
     *              @SWG\Property(property="story", type="string"),
     *              @SWG\Property(property="diary", type="string"),
     *              @SWG\Property(property="guest_book", type="string"),
     *              @SWG\Property(property="images", type="string"),
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
     * Returns Pet detail
     */

    public function create(Request $request)
    {
        $input = $request->all();
        try {
            $arrRules = [
                'name' => 'required',
                'owner_id' => 'required',
                'pet_type_id' => 'required',
                'story' => 'required',
            ];
            $arrMessages = [
                'name.required' => 'name.required',
                'owner_id.required' => 'owner_id.required',
                'pet_type_id.required' => 'pet_type_id.required',
                'story.required' => 'story.required',
            ];

            $validator = Validator::make($input, $arrRules, $arrMessages);
            if ($validator->fails()) {
                return $this->sendError('Error', $validator->errors()->all());
            }

            // Check owner
            $owner = OwnerServiceFactory::mOwnerService()->findById($input['owner_id']);
            if (empty($owner)) {
                return $this->sendError('Error', 'OwnerNotExist');
            }

            $create = PetServiceFactory::mPetService()->create($input);
            if (!empty($create)) {
                // Update owner
                OwnerServiceFactory::mOwnerPetService()->create(array(
                    'owner_id' => $input['owner_id'],
                    'pet_id' => $create['id']
                ));
                // Update media
                if (!empty($input['images'])) {
                    $arrFileId = explode(',', $input['images']);
                    foreach ($arrFileId as $id) {
                        $fileinput = array(
                            'id' => $id,
                            'pet_id' => $create['id']
                        );
                        CommonServiceFactory::mMediaService()->update($fileinput);
                    }
                }
            }
            return $this->sendResponse($create, 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\PUT(
     *      path="/mpet/pet/update",
     *      operationId="putUpdatePet",
     *      tags={"Pet"},
     *      summary="Update Pet Info",
     *      description="Returns Pet detail",
     *      @SWG\Parameter(
     *         description="images is list file id, example '2,5,36,1'",
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(
     *             type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="owner_id", type="integer"),
     *              @SWG\Property(property="pet_type_id", type="integer"),
     *              @SWG\Property(property="gender", type="integer"),
     *              @SWG\Property(property="birth_day", type="string"),
     *              @SWG\Property(property="dead_day", type="string"),
     *              @SWG\Property(property="age", type="integer"),
     *              @SWG\Property(property="story", type="string"),
     *              @SWG\Property(property="diary", type="string"),
     *              @SWG\Property(property="guest_book", type="string"),
     *              @SWG\Property(property="images", type="string"),
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
     * Returns Pet detail
     */

    public function update(Request $request)
    {
        $input = $request->all();
        try {
            $arrRules = [
                'name' => 'required',
                'owner_id' => 'required',
                'pet_type_id' => 'required',
                'story' => 'required',
            ];
            $arrMessages = [
                'name.required' => 'name.required',
                'owner_id.required' => 'owner_id.required',
                'pet_type_id.required' => 'pet_type_id.required',
                'story.required' => 'story.required',
            ];

            $validator = Validator::make($input, $arrRules, $arrMessages);
            if ($validator->fails()) {
                return $this->sendError('Error', $validator->errors()->all());
            }

            // Check owner
            $owner = OwnerServiceFactory::mOwnerService()->findById($input['owner_id']);
            if (empty($owner)) {
                return $this->sendError('Error', 'OwnerNotExist');
            }

            $update = PetServiceFactory::mPetService()->update($input);

            if (!empty($update)) {
                // Update owner
                OwnerServiceFactory::mOwnerPetService()->create(array(
                    'owner_id' => $input['owner_id'],
                    'pet_id' => $update['id']
                ));

                // Update media
                if (!empty($input['images'])) {
                    $arrFileId = explode(',', $input['images']);
                    foreach ($arrFileId as $id) {
                        $fileinput = array(
                            'id' => $id,
                            'pet_id' => $update['id']
                        );
                        CommonServiceFactory::mMediaService()->update($fileinput);
                    }
                }
            }
            return $this->sendResponse($update, 'Successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }
    }

    /**
     * @SWG\DELETE(
     *      path="/mpet/pet/delete",
     *      operationId="deletePets",
     *      tags={"Pet"},
     *      summary="Delete Pets",
     *      description="Returns bol successful or error",
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="list id of Pets",
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
        return $this->sendResponse(true, 'Successfully.');
    }
}
