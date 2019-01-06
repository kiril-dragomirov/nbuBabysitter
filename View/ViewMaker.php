<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 20:44
 */

namespace View;


class ViewMaker
{
    public static function view (
        $view,
        $params,
        $redirect = false
    ){
        require_once 'header.php';

        if (! empty($redirect)) {
            header('location:index.php?action='.$redirect['action'].'&target='.$redirect['target'].'');
            die();
        }

        require_once "$view.php";

        require_once 'footer.php';

        return true;
    }
}