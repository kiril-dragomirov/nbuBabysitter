<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2019 г.
 * Time: 15:40
 */
?>
<script>
    function sendText(val, childId) {
        var text = document.getElementById(val).value;
        if (text !== null) {
            console.log(123);
            var request = new XMLHttpRequest();
            request.open("post", "index.php?target=babysitter&action=insertActivity");
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    console.log(this.response);
                    var response = JSON.parse(this.response);
                    console.log(response);
                    location.reload();
                }
            }
            request.send("activity=" + text + "&childId=" + childId + "&date=" + val);

        }
    }
</script>

<table>

    <?php
    //hours
    for ($i = 6;
         $i <= 23;
         $i++) {
        //minutes
        $curTime = $i;
        for ($j = 0;
             $j <= 45;
             $j += 15) {
            $curTime = $i + $j;

            ?>
            <tr>
            <th><?= $i . ' : ' . $j; ?></th>
            <?php if (!empty($params['activity'])) {
                ?>
                <?php foreach ($params['activity'] as $key => $activity) {
                    ?>
                    <tr>
                        <?php
                        $babysitter = '';
                        $parent = '';
                        if ($activity['date'] == $curTime) { ?>
                            <?php ?>
                            <?php if (empty($activity['isParent'])) {
                                $babysitter = $activity['activity'];
                            } ?>
                            <?php if (!empty($activity['isParent'])) {
                                $parent = $activity['activity'];
                            } ?>
                            <td><?= empty($babysitter) ? '' : $babysitter.'- Коментар детегедач.' ?></td>
                            <td><?= empty($parent) ? '' : $parent.'- Коментар родител.' ?></td>
                        <?php } ?>
                    <tr>
                    <?php
                }
            } else { ?>
                <td>няма</td>
                <td>няма</td>

                <?php

            } ?>
            <td><textarea id=<?= $curTime ?>></textarea></td>
            <td>
            <button value='<?= $curTime ?>' onclick=sendText(this.value,<?= $params['childId'] ?>)>Въведи
                Активност
            </button>
            </td><?php


        } ?>
        </tr>
        <?php
        if ($i == 23) {
            break;
        }


        if ($j == 60) {
            continue;
        }


        //inside the outer loop
    }
    //outside the outer loop
    ?>
</table>

