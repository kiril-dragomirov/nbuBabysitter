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

        $getUserCount = $pdo->prepare($sql);

        $getUserCount->execute([
            'isParent' => BabysitterRepository::iS_NOT_PARENT
        ]);

        return $getUserCount->fetchAll($pdo::FETCH_ASSOC);
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
}