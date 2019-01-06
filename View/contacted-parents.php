<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 14:13
 */
?>
<div id='register-form'>
    <h2>Свързани родители с мен</h2>
    <?php if (!empty($params['message'])) { ?>
        <p><?= $params['message'] ?></p>
    <?php } ?>

    <?php if (!empty($params['parentList'])) {
        ?>
        <table id="child-reg">
            <tr>
                <th>Три имена</th>
                <th>Телефон за връзка</th>
                <th>Действие</th>
            </tr>
            <?php
            foreach ($params['parentList'] as $index => $parent) { ?>
                <tr>
                    <td><?= $parent['firstName'] . ' ' . $parent['secondName'] . ' ' . $parent['lastName']; ?></td>
                    <td><?= $parent['tel'] ?></td>
                    <td>
                        <button>
                            <a href="index.php?target=babysitter&action=getChildrenForParent&parentId=<?= $parent['id'] ?>">Продължи
                        </button>
                    </td>
                </tr>
                <?php
            } ?>
        </table>
    <?php } ?>
</div>