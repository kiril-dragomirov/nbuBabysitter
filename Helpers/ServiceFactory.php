<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 0:19
 */

namespace Helpers;

use Service;

class ServiceFactory
{
    public static function create($name)
    {
        $name = '\\Service\\' . $name . 'Service';

        return $name::getInstance();
    }
}