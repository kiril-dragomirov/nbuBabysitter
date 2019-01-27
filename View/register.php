<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 23:45
 */
?>
<div id='register-form'>
    <h2> Регистрация </h2>
    <form method="post" action="index.php?action=doRegister&target=user">
        Потребителско име:<br>
        <input type="text" name="username"> <br>
        Парола<br>
        <input type="password" name="password"> <br>
        Повторете парола<br>
        <input type="password" name="repPassword"> <br>
        Първо име<br>
        <input type="text" name="firstName"> <br>
        Бащино име<br>
        <input type="text" name="secondName"> <br>
        Фамилно име<br>
        <input type="text" name="lastName"> <br>
        Имейл адрес<br>
        <input type="email" name="email"> <br>
        Адрес<br>
        <input type="text" name="address"> <br>
        Телефон<br>
        <input type="number" name="number"> <br>
         Родител или детегледачка:<br>
        <select name="isParent">
            <option>Изберете</option>
            <option value="0">Детегледачка</option>
            <option value="1">Родиел</option>
        </select> <br>

        <input type="submit" value="Регистрация">
    </form>
    <?php if (!empty($params['message'])) { ?>
    <p style="background-color: red"><?= $params['message']; ?> </p>
    <?php } ?>
</div>