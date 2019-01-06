<div id='register-form'>
    <h2>Наеми Детегледачка</h2>
    <?php if (!empty($params['message'])) { ?>
        <p style="background-color: darkseagreen"><?= $params['message'] ?></p>
    <?php } ?>
    <?php
    if (!empty($params['babysitters'])) {
        ?>
        <table id="child-reg">
            <tr>
                <th>Три имена</th>
                <th>Телефон за връзка</th>
                <th>Действие</th>
            </tr>
            <?php
            foreach ($params['babysitters'] as $index => $babysitter) { ?>
                <tr>
                    <td><?= $babysitter['firstName'] . ' ' . $babysitter['secondName'] . ' ' . $babysitter['lastName']; ?></td>
                    <td><?= $babysitter['tel'] ?></td>
                    <td>
                        <button>
                            <a href="index.php?target=babysitter&action=hireBabysitter&babysitterId=<?= $babysitter['id'] ?>">Наеми
                        </button>
                    </td>
                </tr>
                <?php
            } ?>
        </table>
    <?php } else { ?>
        <p>Няма налични детегледачки.</p>
        <?php
    }
    ?>
</div>
