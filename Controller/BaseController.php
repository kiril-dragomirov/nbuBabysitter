<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 20:40
 */

namespace Controller;

use View\ViewMaker;

class BaseController
{
    public function getMainPage ()
    {
       return ViewMaker::view('main',[]);
    }
}