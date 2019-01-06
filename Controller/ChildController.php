<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 4:56
 */

namespace Controller;


use Helpers\Input;
use Helpers\ServiceFactory;
use View\ViewMaker;

class ChildController
{
    public function getRegisterChild()
    {
        $result['children'] = $this->getRegisteredChildren();

        return ViewMaker::view('childRegister', $result);
    }

    public function getRegisteredChildren()
    {
        return ServiceFactory::create('Child')->getRegisteredChildren();
    }

    public function doRegisterChild()
    {
        $params = Input::inputAllPost();

        foreach ($params as $key => $index) {
            $params[$key] = htmlentities($index);
        }

        foreach ($params as $key => $index) {
            if (empty($index)) {
                $result['message'] = 'Всички полета са задължителни';
                $result['success'] = false;
                return $result;
            }
        }

        $result = ServiceFactory::create('Child')->doRegisterChild($params);

        return ViewMaker::view('childRegister', [], ['action'=>'getRegisterChild', 'target'=>'Child']);
    }
}