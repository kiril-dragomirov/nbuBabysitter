<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5.1.2019 г.
 * Time: 21:01
 */
?>
    <link href="assets/style.css" type="text/css" rel="stylesheet">

    <header>
        <span><img src="assets/pictures/biberon-logo.png" style="width:6rem;display:inline-block"></span>
        <span><a href="index.php?target=base&action=getMainPage" style="text-decoration: none"><h3 id="site-title">Babysitter</h3></a> </span>


    </header>
    <nav>
        <?php if (empty($_SESSION['user'])) { ?>

            <a href="index.php?action=getLoginPage&target=user">Вход</a>
            <a href="index.php?action=getRegisterPage&target=user">Регистрация</a>

        <?php } else {
            ?>
            <?php if (!empty($_SESSION['user']['isParent'])) { ?>
                <a href="index.php?action=getRegisterChild&target=child">Въведи дете</a>
                <a href="index.php?action=getBabysitterListPage&target=babysitter">Свържи се с детегледачка</a>
                <a href="index.php?action=getBabysitterActivityList&target=babysitter">Активности на детегледачката</a>

            <?php } else { ?>
                <a href="index.php?action=getContactedParentsPage&target=parent">Свързани родители с мен</a>
            <?php } ?>
            <a href="index.php?action=getEditProfile&target=user">Редактиране на профил</a>
            <a href="index.php?action=doLogout&target=user">Изход</a>
        <?php } ?>

    </nav>

    <body>
<?php if (!empty($_SESSION['user'])) { ?>
    <p style="margin-left:1rem;color:dodgerblue;font-size:1rem;font-style:normal; font-size: 20px;">Добре
        дошли, <?= $_SESSION['user']['firstName'] . ' ' . $_SESSION['user']['lastName'] ?></p>
<?php } ?>