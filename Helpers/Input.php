<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 21:21
 */

namespace Helpers;


class Input
{
    public static function inputGet($name)
    {
        if (empty($_GET[$name])) {
            $result = '';
        } else {
            $result = $_GET[$name];
        }

        return $result;
    }

    public static function inputPost($name)
    {
        if (empty($_POST[$name])) {
            $result = '';
        } else {
            $result = $_POST[$name];
        }

        return $result;
    }

    public static function inputAllPost()
    {
        return $_POST;
    }

    public static function inputAllGet()
    {
        return $_GET;
    }
}