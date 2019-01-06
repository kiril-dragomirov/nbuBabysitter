<?php

?>

<div id='register-form'>
    <h2> Login </h2>
    <form method="post" action="index.php?action=doLogin&target=user">
        Username:<br>
        <input type="text" name="username"> <br>
        Password<br>
        <input type="password" name="password"> <br>
        <input type="submit">
    </form>
    <?php if (!empty($params['message'])) { ?>
        <p style="background-color: red"><?= $params['message']; ?> </p>
    <?php } ?>
</div>
