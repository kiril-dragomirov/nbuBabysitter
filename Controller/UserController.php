<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 20:39
 */

namespace Controller;


use Helpers\Input;
use Helpers\ServiceFactory;
use Service\UserService;
use View\ViewMaker;

class UserController
{
    public function getLoginPage()
    {
        return ViewMaker::view('login', []);
    }

    public function doLogin()
    {
        $params = Input::inputAllPost();
        $result['success'] = true;
        foreach ($params as $key => $index) {
            $params[$key] = htmlentities($index);
        }

        if (
            !empty($params['username'])
            && !empty($params['password'])
        ) {
            $result = ServiceFactory::create('User')->doLogin($params);
        } else {
            $result['success'] = false;
            $result['message'] = 'Попълнете всички полета.';
        }

        if ($result['success']) {
            header('location:index.php');
        } else {
            return ViewMaker::view('login', $result);
        }
    }

    public function getRegisterPage()
    {
        return ViewMaker::view('register', []);
    }

    public function doRegister()
    {
        $params = Input::inputAllPost();

        foreach ($params as $key => $index) {
            $params[$key] = htmlentities($index);
        }

        if (
            !empty($params['email'])
            && !empty($params['password'])
            && !empty($params['username'])
            && !empty($params['firstName'])
            && !empty($params['secondName'])
            && !empty($params['lastName'])
            && !empty($params['number'])
            && !empty($params['address'])
        ) {
            $result = ServiceFactory::create('User')->doRegister($params);
        } else {
            $result['success'] = false;
            $result['message'] = 'Всички полета са задължителни!';
        }

        if ($result['success']) {
            return ViewMaker::view('login', []);
        } else {
            return ViewMaker::view('register', $result);
        }
    }

    public function getEditProfile()
    {
        return ViewMaker::view('editProfile', []);
    }

    public function doEditProfile()
    {
        $params = Input::inputAllPost();

        foreach ($params as $key => $index) {
            $params[$key] = htmlentities($index);
        }

        $result = ServiceFactory::create('user')->doEditProfile($params);

        return ViewMaker::view('editProfile', $result, ['target' => 'user', 'action' => 'getEditProfile']);
    }

    public function doLogout()
    {
        unset($_SESSION);
        session_destroy();
        header('location:index.php');
    }
}