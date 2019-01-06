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
    <h3 id="site-title">Babysitter</h3>
    <?php if (!empty($_SESSION['user'])) { ?>
        <p>Добре дошли, <?= $_SESSION['user']['firstName'] . ' ' . $_SESSION['user']['lastName'] ?></p>
    <?php } ?>
</header>
<nav>
    <?php if (empty($_SESSION['user'])) { ?>

        <a href="index.php?action=getLoginPage&target=user">Login</a>
        <a href="index.php?action=getRegisterPage&target=user">Register</a>

    <?php } else {
        ?>
        <a href="index.php?action=getEditProfile&target=user">Edit Profile</a>
        <a href="index.php?action=doLogout&target=user">Logout</a>
    <?php } ?>

</nav>

<body>