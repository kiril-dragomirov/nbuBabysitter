<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 4:57
 */
?>

<div id='register-form'>
    <h2> Въведи Дете </h2>
    <form method="post" action="index.php?action=doRegisterChild&target=child">
        Име на дете:<br>
        <input type="text" name="name"> <br>
        Възраст<br>
        <input type="number" name="age"> <br>
        <input type="submit">
    </form>
    <?php if (!empty($params['message'])) { ?>
        <p style="background-color: red"><?= $params['message']; ?> </p>
    <?php } ?>

</div>

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


