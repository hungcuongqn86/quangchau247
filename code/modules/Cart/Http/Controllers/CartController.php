<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Common\Http\Controllers\CommonController;

class CartController extends CommonController
{
    public function create(Request $request)
    {
        $input = $request->all();
        return $this->sendResponse($input, 'Successfully.');
    }
}
