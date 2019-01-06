<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 14:06
 */

namespace Controller;


use Helpers\ServiceFactory;
use View\ViewMaker;

class ParentController
{
    public function getContactedParentsPage()
    {
        $result = $this->getContactedParents();

        return ViewMaker::view('contacted-parents', $result);
    }

    public function getContactedParents()
    {
        return ServiceFactory::create('Parent')->getContactedParents();
    }
}