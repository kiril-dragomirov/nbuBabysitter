<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 5:06
 */

namespace Repository;


use Repository\Dao\DAO;

class ChildRepository
{
    public static $instance = null;

    public function getInstance()
    {
        if (empty(ChildRepository::$instance)) {
            ChildRepository::$instance = new ChildRepository();
        }

        return ChildRepository::$instance;
    }

    public function getRegisteredChildren($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            SELECT
                *
            FROM
                children
            WHERE
                parent_id = :parentId
        ';

        $getChild = $pdo->prepare($sql);
        $getChild->execute($params);
        return $getChild->fetchAll($pdo::FETCH_ASSOC);
    }

    public function doRegisterChild($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            INSERT INTO
                    children
                        (
                        parent_id,
                        name,
                        age
                        )
                VALUES (
                    :parentId,
                    :name,
                    :age
                    );
        ';

        $getChild = $pdo->prepare($sql);
        return $getChild->execute($params);
    }
}