<?php

use app\models\DateFormat;

printf ("<h1>Депутат $deputy[family] $deputy[name] $deputy[patronymic]</h1>");
?>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<ul>
    <li>Дата рождения:
        <?php
            $date = new DateFormat($deputy['birthdate']);
            echo $date->changeDateFormat();
        ?>
    </li>
    <li>Дата начала полономочий в последнем созыве:
        <?php
            $date = new DateFormat($deputy['credentialsStart']);
            echo $date->changeDateFormat();
        ?>
    </li>
    <li>Полное название фракции: <?= $deputy['factionName'];?></li>
</ul>

<div class="jumbotron">
<h2>Инициированы законопроекты</h2>
</div>
<table class="table">
    <?php foreach($bills['laws'] as $bill): ?>
        <tr>
            <td style="width: 100px;">
                <?php
                    $date = new DateFormat($bill['introductionDate']);
                    echo $date->changeDateFormat();
                ?>
            </td>
            <td align="justify">
                <a href="<?= \yii\helpers\Url::to(['bill/bill', 'id' => $bill['number']]) ?>" title="<?php echo 'Законопроект' . ' № ' . $bill['number']; ?>"><?php echo 'Законопроект' . ' № ' . $bill['number'] . ' ' . '«' . $bill['name']  . '»'; ?></a>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<?= \yii\widgets\LinkPager::widget(['pagination' => $pages,]); ?>