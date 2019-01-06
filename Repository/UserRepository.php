<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 1:07
 */

namespace Repository;


use Repository\Dao\DAO;

class UserRepository
{
    public static $instance = null;

    public function getInstance()
    {
        if (empty(UserRepository::$instance)) {
            UserRepository::$instance = new UserRepository();
        }

        return UserRepository::$instance;
    }

    public function doRegister($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = "
                INSERT INTO
                    users
                        (
                        first_name,
                        second_name,
                        last_name,
                        address,
                        tel,
                        is_parent,
                        username,
                        password,
                        email
                        )
                VALUES (
                    :firstName,
                    :secondName,
                    :lastName,
                    :address,
                    :number,
                    :isParent,
                    :username,
                    :password,
                    :email
                    )";

        $insertTrans = $pdo->prepare($sql);
        return $insertTrans->execute($params);
    }

    public function checkForAlreadyRegisteredUsers($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = 'SELECT
                    COUNT(id) AS count
                FROM
                    users
                WHERE
                    username = :username
                    AND email = :email
                ';

        $getUserCount = $pdo->prepare($sql);
        $getUserCount->execute([
            'username' => $params['username'],
            'email' => $params['email']
        ]);
        return $getUserCount->fetch($pdo::FETCH_ASSOC);
    }

    public function doLogin($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            SELECT
                first_name AS firstName,
                last_name AS lastName,
                second_name AS secondName,
                password,
                username,
                id,
                tel,
                address,
                is_Parent AS isParent,
                email
            FROM
                users
            WHERE
                username = :username
        ';

        $getUserCount = $pdo->prepare($sql);

        $getUserCount->execute([
            'username' => $params['username']
        ]);

        return $getUserCount->fetch($pdo::FETCH_ASSOC);
    }

    public function doEditProfile($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            UPDATE 
                users
            SET 
                username = :username,
                password = :password,
                tel = :number,
                address = :address,
                email = :email,
                first_name = :firstName,
                last_name = :lastName,
                second_name = :secondName
            WHERE id = :id;
        ';

        $getUserCount = $pdo->prepare($sql);
        $params = array_merge($params, ['id' => $_SESSION['user']['id']]);
        return $getUserCount->execute($params);
    }
}