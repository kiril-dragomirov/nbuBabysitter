<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 20:11
 */

namespace Repository\Dao;

class DAO
{
    const DB_NAME = "babysitter";
    const DB_IP = "127.0.0.1";
    const DB_PORT = "3306";
    const DB_USER = "root";
    const DB_PASS = "";
    public static $instance = null;

    /* @var $pdo \PDO */
    protected static $pdo;

    private function __construct()
    {
        try {
            self::$pdo = new \PDO("mysql:host=" . self::DB_IP . ":" . self::DB_PORT . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Problem with db query  - " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (empty(DAO::$instance)) {
            new DAO();
            DAO::$instance = DAO::$pdo;
        }

        return DAO::$instance;
    }
}