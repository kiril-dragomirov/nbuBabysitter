<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 5:04
 */

namespace Service;


use Helpers\RepositoryFactory;

class ChildService
{
    public static $instance = null;

    public function getInstance()
    {
        if (empty(ChildService::$instance)) {
            ChildService::$instance = new ChildService();
        }

        return ChildService::$instance;
    }

    public function getRegisteredChildren()
    {
        $params = [];
        $params['parentId'] = $_SESSION['user']['id'];
        return RepositoryFactory::create('Child')->getRegisteredChildren($params);
    }

    public function doRegisterChild($params)
    {
        $params = array_merge($params, ['parentId'=>$_SESSION['user']['id']]);
        return RepositoryFactory::create('Child')->doRegisterChild($params);
    }
}