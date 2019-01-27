<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 3:20
 */
?>

<div id='register-form'>
    <h2> Редактиране на профил </h2>
    <form method="post" action="index.php?action=doEditProfile&target=user">
        Потребителско име:<br>
        <input type="text" name="username" value = <?= $_SESSION['user']['username'] ?>> <br>
        Нова парола<br>
        <input type="password" name="password" > <br>
        Първо име<br>
        <input type="text" name="firstName" value = <?= $_SESSION['user']['firstName'] ?>> <br>
        Бащино име<br>
        <input type="text" name="secondName" value = <?= $_SESSION['user']['secondName'] ?>> <br>
        Фамилно име<br>
        <input type="text" name="lastName" value = <?= $_SESSION['user']['lastName'] ?>> <br>
        Имейл адрес<br>
        <input type="email" name="email" value = <?= $_SESSION['user']['email'] ?>> <br>
        Адрес<br>
        <input type="text" name="address" value = <?= $_SESSION['user']['address'] ?>> <br>
        Телефон<br>
        <input type="number" name="number" value = <?= $_SESSION['user']['tel'] ?>> <br>

        <input type="submit" value="Запази">
    </form>
    <?php if (!empty($params['message'])) { ?>
        <p style="background-color: red"><?= $params['message']; ?> </p>
    <?php } ?>
</div>
