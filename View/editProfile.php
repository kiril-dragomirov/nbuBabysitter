<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 3:20
 */
?>

<div id='register-form'>
    <h2> Edit Profile </h2>
    <form method="post" action="index.php?action=doEditProfile&target=user">
        Username:<br>
        <input type="text" name="username" value = <?= $_SESSION['user']['username'] ?>> <br>
        Password<br>
        <input type="password" name="password" > <br>
        First Name<br>
        <input type="text" name="firstName" value = <?= $_SESSION['user']['firstName'] ?>> <br>
        Second Name<br>
        <input type="text" name="secondName" value = <?= $_SESSION['user']['secondName'] ?>> <br>
        Last Name<br>
        <input type="text" name="lastName" value = <?= $_SESSION['user']['lastName'] ?>> <br>
        Email<br>
        <input type="email" name="email" value = <?= $_SESSION['user']['email'] ?>> <br>
        Address<br>
        <input type="text" name="address" value = <?= $_SESSION['user']['address'] ?>> <br>
        Number<br>
        <input type="number" name="number" value = <?= $_SESSION['user']['tel'] ?>> <br>

        <input type="submit">
    </form>
    <?php if (!empty($params['message'])) { ?>
        <p style="background-color: red"><?= $params['message']; ?> </p>
    <?php } ?>
</div>
