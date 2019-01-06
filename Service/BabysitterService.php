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

}