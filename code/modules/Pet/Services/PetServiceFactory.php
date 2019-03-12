<?php

namespace Modules\Pet\Services;

use Modules\Pet\Services\Impl\PetService;
use Modules\Pet\Services\Impl\PettypeService;

class PetServiceFactory
{
    protected static $mPetService;
    protected static $mPettypeService;

    public static function mPetService()
    {
        if (self::$mPetService == null) {
            self::$mPetService = new PetService();
        }
        return self::$mPetService;
    }

    public static function mPettypeService()
    {
        if (self::$mPettypeService == null) {
            self::$mPettypeService = new PettypeService();
        }
        return self::$mPettypeService;
    }
}