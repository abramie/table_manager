<?php

namespace App\Services;


use App\Services\ToastService;

/**
 * Class Services
 * @package App\Services
 */
class Services
{
    protected static $toastService;



    public static function toast(): ToastService
    {
        self::$toastService = self::$toastService ?? new ToastService();

        return self::$toastService;
    }




}
