<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 23:45
 */
?>
<div id='register-form'>
    <h2> Register </h2>
    <form method="post" action="index.php?action=doRegister&target=user">
        Username:<br>
        <input type="text" name="username"> <br>
        Password<br>
        <input type="password" name="password"> <br>
        Repeat Password<br>
        <input type="password" name="repPassword"> <br>
        First Name<br>
        <input type="text" name="firstName"> <br>
        Second Name<br>
        <input type="text" name="secondName"> <br>
        Last Name<br>
        <input type="text" name="lastName"> <br>
        Email<br>
        <input type="email" name="email"> <br>
        Address<br>
        <input type="text" name="address"> <br>
        Number<br>
        <input type="number" name="number"> <br>
        Parent Or Babysitter:<br>
        <select name="isParent">
            <option>Choose</option>
            <option value="0">Babysitter</option>
            <option value="1">Parent</option>
        </select> <br>

        <input type="submit">
    </form>
    <?php if (!empty($params['message'])) { ?>
    <p style="background-color: red"><?= $params['message']; ?> </p>
    <?php } ?>
</div>