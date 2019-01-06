<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . $class;
});

session_start();

\Repository\DAO\DAO::getInstance();
$fileNotFound = false;
$controllerName = isset($_GET['target']) ? ucfirst($_GET['target']) : 'Base';
$methodName = isset($_GET['action']) ? $_GET['action'] : 'getMainPage';
$controllerClassName = '\\Controller\\' . $controllerName . 'Controller';

if (class_exists($controllerClassName)) {
    $contoller = new $controllerClassName();
    if (method_exists($contoller, $methodName)) {
//                    if request is not for login or register, check for login
        if (!(
            $controllerName == "User" &&
            (
                $methodName == "doLogin"
                || $methodName == "doRegister"
                || $methodName == "getLoginPage"
                || $methodName == "getRegisterPage"
            )
        )
        ) {
            if (!isset($_SESSION["user"])) {
                header("location:index.php?target=User&action=getLoginPage");
                die();
            }
        }

        if (
            $controllerName == "User" &&
            (
                $methodName == "doLogin"
                || $methodName == "doRegister"
                || $methodName == "getLoginPage"
                || $methodName == "getRegisterPage"
            )
        ) {
            if (isset($_SESSION["user"])) {
                header("location:index.php?target=base&action=getMainPage");
                die();
            }
        }
        try {
            $contoller->$methodName();
        } catch (\PDOException $e) {
            //            header("HTTP/1.1 500");
            echo $e->getMessage();
            die();
        }
    } else {
        $fileNotFound = true;
    }
} else {
    $fileNotFound = true;
}
if ($fileNotFound) {
    //return header 404
    echo 'target or action invalid: target = ' . $controllerName . ' and action = ' . $methodName;
    header("location:./View/404.html");
}
