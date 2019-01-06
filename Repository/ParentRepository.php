<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 14:07
 */

namespace Repository;


use Repository\Dao\DAO;

class ParentRepository
{
    public static $instance = null;
    const IS_PARENT = 1;

    public function getInstance()
    {
        if (empty(ParentRepository::$instance)) {
            ParentRepository::$instance = new ParentRepository();
        }

        return ParentRepository::$instance;
    }

    public function getParentList($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            SELECT
                u.first_name AS firstName,
                u.last_name AS lastName,
                u.second_name AS secondName,
                u.username,
                u.id,
                u.tel,
                u.address,
                u.email
            FROM
                users AS u
            INNER JOIN 
                hired_babysitters AS hb
                ON (u.id = hb.parent_id)
            WHERE
                u.is_parent = :isParent
                AND hb.babysitter_id = :babysitterId
                AND date = CURDATE()
                
        ';

        $getBabysitters = $pdo->prepare($sql);

        $getBabysitters->execute([
            'isParent' => ParentRepository::IS_PARENT,
            'babysitterId' => $params['babysitterId']
        ]);

        return $getBabysitters->fetchAll($pdo::FETCH_ASSOC);
    }
}