<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 14:07
 */

namespace Service;


use Helpers\RepositoryFactory;

class ParentService
{
    public static $instance = null;

    public function getInstance()
    {
        if (empty(ParentService::$instance)) {
            ParentService::$instance = new ParentService();
        }

        return ParentService::$instance;
    }

    public function getContactedParents()
    {
        $params['babysitterId'] = $_SESSION['user']['id'];
        $parentList = RepositoryFactory::create('Parent')->getParentList($params);
        if (empty($parentList)) {
            $result['message'] = 'Няма свързали се с вас родители за днес.';
            $result['success'] = false;
        } else {
            $result['parentList'] = $parentList;
        }

        return $result;
    }
}