<?php
if (!empty($params['children'])) {
    ?>
    <div id=register-form style="background-color: papayawhip; margin-bottom: 2%"><p>Име на детегледачката: <?= $params['info'][0]['name'] ?></p></div>
    <table id="child-reg"> <?php
        foreach ($params['children'] as $index => $child) { ?>
            <tr>
                <td><?= $child['name']; ?></td>
                <td><?= $child['age']; ?></td>
                <td>
                    <a href="index.php?target=babysitter&action=getChildrenForParentActivity&parentId=<?= $_SESSION['user']['id'] ?>&childId=<?= $child['id_child'] ?>">
                        Проследи
                    </a>
                </td>

            </tr>
            <?php
        } ?>
    </table>
<?php } else {
    ?>
        <p style="text-align: center">Нямате регистрирани деца.</p>
    <?php
}
?>
