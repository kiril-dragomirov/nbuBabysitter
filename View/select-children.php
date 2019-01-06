<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 14:54
 */
?>

<div id='register-form'>
    <h2>Деца за гледане</h2>
    <?php if (!empty($params['message'])) { ?>
        <p><?= $params['message'] ?></p>
    <?php } ?>

    <?php if (!empty($params['childList'])) {
        ?>
        <table id="child-reg">
            <tr>
                <th>Три имена</th>
                <th>Телефон за връзка</th>
                <th>Действие</th>
            </tr>
            <?php
            foreach ($params['childList'] as $index => $child) { ?>
                <tr>
                    <td><?= $child['name']; ?></td>
                    <td><?= $child['age'] ?></td>
                    <td>
                        <button>
                            <a href="index.php?target=babysitter&action=getChildrenForParentActivity&parentId=<?= $child['parentId'] ?>&childId=<?= $child['childId'] ?>">Въведи Дейсности
                        </button>
                    </td>
                </tr>
                <?php
            } ?>
        </table>
    <?php } ?>
</div>
