<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 12:54
 */

namespace Service;


use Helpers\RepositoryFactory;

class BabysitterService
{
    public static $instance = null;

    public function getInstance()
    {
        if (empty(BabysitterService::$instance)) {
            BabysitterService::$instance = new BabysitterService();
        }

        return BabysitterService::$instance;
    }

    public function getAllBabysitters()
    {
        return RepositoryFactory::create('Babysitter')->getAllBabysitters();
    }

    public function hireBabysitter($params)
    {
        $babysitterRepository = RepositoryFactory::create('Babysitter');

        $checkIfExists = $babysitterRepository->checkIfBabysitterExists($params);

        if (!empty($checkIfExists['count'])) {
            $checkIfParentHaveHiredBabysitters = $babysitterRepository->checkIfParentHaveHiredBabysitters($params);
            if (empty($checkIfParentHaveHiredBabysitters['count'])) {
                $result['success'] = $babysitterRepository->hireBabysitter($params);
            } else {
                $result['success'] = false;
                $result['message'] = 'Вече имате наета детегледачка за деня.';
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Такава детегледачка не съществува.';
        }

        return $result;
    }

    public function getChildrenForParent($params)
    {
        $childList = RepositoryFactory::create('Babysitter')->getChildrenForParent($params);

        if (empty($childList)) {
            $result['success'] = false;
            $result['message'] = 'Няма активни деца.';
        } else {
            $result['childList'] = $childList;
        }

        return $result;
    }

    public function getChildrenForParentActivity($params)
    {
        $isHired['count'] = true;

        if (! empty($_SESSION['user']['isParent'])) {
            $isHired = $this->checkIfBabysitterIsHired($params);
        }
        if (!empty($isHired['count'])) {
            $activityForChildList = RepositoryFactory::create('Babysitter')->getChildrenForParentActivity($params);
            $result['activity'] = $activityForChildList;
        } else {
            $result['success'] = false;
            $result['message'] = 'Няма наета детегледачка';
        }

        return $result;
    }

    public function insertActivity($params)
    {
        return RepositoryFactory::create('Babysitter')->insertActivity($params);
    }

    public function checkIfBabysitterIsHired($params)
    {
        $babysitterRepository = RepositoryFactory::create('Babysitter');

        $checkIfExists = $babysitterRepository->checkIfParentHaveHiredBabysitters($params);

        return $checkIfExists;
    }
}