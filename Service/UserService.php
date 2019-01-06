<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 0:29
 */

namespace Service;


use Helpers\RepositoryFactory;
use View\ViewMaker;

class UserService
{
    public static $instance = null;

    public function getInstance()
    {
        if (empty(UserService::$instance)) {
            UserService::$instance = new UserService();
        }

        return UserService::$instance;
    }

    public function doRegister($params)
    {
        $result = [];

        if ($params['password'] == $params['repPassword']) {
            $checkIfThereAreOtherUsers = RepositoryFactory::create('User')->checkForAlreadyRegisteredUsers($params);
            if ($checkIfThereAreOtherUsers['count']) {
                $result['message'] = 'Потребител с такъв email, username вече съществува.';
                $result['success'] = false;
                return $result;
            }
            unset($params['repPassword']);
            $params['isParent'] = empty($params['isParent']) ? 0 : 1;
            $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
            $result['success'] = RepositoryFactory::create('User')->doRegister($params);
        } else {
            $result['message'] = 'Паролите не са еднакви.';
            $result['success'] = false;
        }

        return $result;
    }

    public function doLogin($params)
    {
        $result = RepositoryFactory::create('User')->doLogin($params);
        if (empty($result)) {
            $result['message'] = 'Потребител с такива креденции не съществува.';
            $result['success'] = false;
            return $result;
        } else {
            if (password_verify($params['password'], $result['password'])) {
                $_SESSION['user'] = $result;
            }
            $result['success'] = true;
        }

        return $result;
    }

    public function doEditProfile($params)
    {
        $result = [];

        foreach ($params as $key => $index) {
            if (empty($index)) {
                $result['success'] = false;
                $result['message'] = 'Всички полета са задължителни';
                return $result;
            }
        }

        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);

        $updatedUser = RepositoryFactory::create('User')->doEditProfile($params);
        if ($updatedUser) {
            $result['success'] = true;
            foreach ($params as $key => $index) {
                if ($key == 'number') {
                    $_SESSION['user']['tel'] = $index;
                    continue;
                }
                $_SESSION['user'][$key] = $index;
            }

        } else {
            $result['success'] = false;
            $result['message'] = 'Нещо се обърка';
        }

        return $result;
    }
}