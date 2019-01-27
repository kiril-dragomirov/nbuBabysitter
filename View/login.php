<?php

?>

<div id='register-form'>
    <h2> Вход </h2>
    <form method="post" action="index.php?action=doLogin&target=user">
        Потребителско име:<br>
        <input type="text" name="username"> <br>
        Парола<br>
        <input type="password" name="password"> <br>
        <input type="submit" value= "Вход">
    </form>
    <?php if (!empty($params['message'])) { ?>
        <p style="background-color: red"><?= $params['message']; ?> </p>
    <?php } ?>
</div>
