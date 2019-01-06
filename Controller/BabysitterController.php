<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 12:54
 */

namespace Controller;


use Helpers\Input;
use Helpers\ServiceFactory;
use View\ViewMaker;

class BabysitterController
{
    public function getBabysitterListPage($params = null)
    {
        $result['babysitters'] = $this->getAllBabysitters();

        if (!empty($params)) {
            $result = array_merge($result, $params);
        }

        return ViewMaker::view('babysitter-list', $result);
    }

    public function getAllBabysitters()
    {
        $result = ServiceFactory::create('Babysitter')->getAllBabysitters();
        return $result;
    }

    public function hireBabysitter()
    {
        $params = Input::inputAllGet();
        $params['babysitterId'] = htmlentities($params['babysitterId']);

        $result = ServiceFactory::create('Babysitter')->hireBabysitter($params);

        return $this->getBabysitterListPage($result);
    }

    public function getChildrenForParent()
    {
        $params = Input::inputAllGet();
        $result = ServiceFactory::create('Babysitter')->getChildrenForParent($params);

        return ViewMaker::view('select-children', $result);
    }

    public function getChildrenForParentActivity()
    {
        $params = Input::inputAllGet();
        $result['activity'] = ServiceFactory::create('Babysitter')->getChildrenForParentActivity($params);
        $result = array_merge($result, ['childId'=> $params['childId']]);
        return ViewMaker::view('activity-list', $result);
    }

    public function insertActivity()
    {
        $params = Input::inputAllPost();

        ServiceFactory::create('Babysitter')->insertActivity($params);

        echo json_encode($params);
        return true;
    }
}