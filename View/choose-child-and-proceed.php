<?php
if (!empty($params['children'])) {
    ?>
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
<?php }
?>
