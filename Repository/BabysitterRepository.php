<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 12:55
 */

namespace Repository;


use Repository\Dao\DAO;

class BabysitterRepository
{
    const iS_NOT_PARENT = 0;
    public static $instance = null;

    public function getInstance()
    {
        if (empty(BabysitterRepository::$instance)) {
            BabysitterRepository::$instance = new BabysitterRepository();
        }

        return BabysitterRepository::$instance;
    }

    public function getAllBabysitters()
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            SELECT
                first_name AS firstName,
                last_name AS lastName,
                second_name AS secondName,
                username,
                id,
                tel,
                address,
                email
            FROM
                users
            WHERE
                is_parent = :isParent
        ';

        $getBabysitters = $pdo->prepare($sql);

        $getBabysitters->execute([
            'isParent' => BabysitterRepository::iS_NOT_PARENT
        ]);

        return $getBabysitters->fetchAll($pdo::FETCH_ASSOC);
    }

    public function checkIfBabysitterExists($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            SELECT 
                COUNT(id) AS count
            FROM
                users
            WHERE
                id = :babysitterId
                AND is_parent = :isParent
        ';

        $getBabysittersCount = $pdo->prepare($sql);

        $getBabysittersCount->execute([
            'isParent' => BabysitterRepository::iS_NOT_PARENT,
            'babysitterId' => $params['babysitterId']
        ]);

        return $getBabysittersCount->fetch($pdo::FETCH_ASSOC);
    }

    public function checkIfParentHaveHiredBabysitters($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            SELECT 
                COUNT(id) AS count
            FROM
                hired_babysitters
            WHERE
                parent_id = :parentId
                AND date = CURDATE()
        ';

        $getBabysittersCount = $pdo->prepare($sql);

        $getBabysittersCount->execute([
            'parentId' => $_SESSION['user']['id']
        ]);

        return $getBabysittersCount->fetch($pdo::FETCH_ASSOC);
    }

    public function hireBabysitter($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = "
                INSERT INTO
                    hired_babysitters
                        (
                        parent_id,
                        babysitter_id,
                        date
                        )
                VALUES (
                    :parentId,
                    :babysitterId,
                    CURDATE()
                    )";

        $insertTrans = $pdo->prepare($sql);
        return $insertTrans->execute([
            'parentId' => $_SESSION['user']['id'],
            'babysitterId' => $params['babysitterId']
        ]);
    }

    public function getChildrenForParent($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
            SELECT 
                name,
                age,
                c.id_child AS childId,
                hb.parent_id AS parentId
            FROM
                children AS c
            INNER JOIN
                hired_babysitters AS hb
                ON (c.parent_id = hb.parent_id)
            INNER JOIN
                users AS u
                ON (u.id = hb.parent_id)
            WHERE
                u.id = :parentId
                AND hb.date = CURDATE()
        ';

        $getBabysittersCount = $pdo->prepare($sql);

        $getBabysittersCount->execute([
            'parentId' => $params['parentId']
        ]);

        return $getBabysittersCount->fetchAll($pdo::FETCH_ASSOC);
    }

    public function getChildrenForParentActivity($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $addition = '';
        if ($_SESSION['user']['isParent']) {
            $addition = 'INNER JOIN
                hired_babysitters AS hb
                ON (:userId = hb.parent_id)';
        } else {
            $addition = 'INNER JOIN
                hired_babysitters AS hb
                ON (:userId = hb.babysitter_id)';
        }

        $sql = "
            SELECT 
                at.activity,
                at.date,
                at.is_parent AS isParent
            FROM
                activity_table AS at
            $addition
            WHERE
                at.child_id = :childId
                AND at.day = CURDATE()
                AND hb.date = CURDATE()
        ";

        $getBabysittersCount = $pdo->prepare($sql);

        $getBabysittersCount->execute([
            'childId' => $params['childId'],
            'userId' => $_SESSION['user']['id']
        ]);

        return $getBabysittersCount->fetchAll($pdo::FETCH_ASSOC);
    }

    public function insertActivity($params)
    {
        /* @var $pdo \PDO */
        $pdo = DAO::getInstance();

        $sql = '
        INSERT INTO activity_table 
            (activity,is_parent,user_id,date,child_id,day) 
        VALUES 
            (:activity, :isParent, :userId, :date, :childId,CURDATE()) 
            ON DUPLICATE KEY UPDATE activity = :activity
        ';


        $insertActivity = $pdo->prepare($sql);

        $insertActivity->execute(
            [
                'activity' => $params['activity'],
                'isParent' => $_SESSION['user']['isParent'],
                'userId' => $_SESSION['user']['id'],
                'date' => $params['date'],
                'childId' => $params['childId']
            ]
        );
    }
}