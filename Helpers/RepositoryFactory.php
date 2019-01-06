<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 1:06
 */

namespace Helpers;


class RepositoryFactory
{
    public static function create($name)
    {
        $name = '\\Repository\\' . $name . 'Repository';

        return $name::getInstance();
    }
}