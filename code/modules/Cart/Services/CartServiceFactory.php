<?php

namespace Modules\Owner\Services;

use Modules\Owner\Services\Impl\OwnerService;
use Modules\Owner\Services\Impl\OwnerPetService;

class OwnerServiceFactory
{
    protected static $mOwnerService;
    protected static $mOwnerPetService;

    public static function mOwnerService()
    {
        if (self::$mOwnerService == null) {
            self::$mOwnerService = new OwnerService();
        }
        return self::$mOwnerService;
    }

    public static function mOwnerPetService()
    {
        if (self::$mOwnerPetService == null) {
            self::$mOwnerPetService = new OwnerPetService();
        }
        return self::$mOwnerPetService;
    }
}