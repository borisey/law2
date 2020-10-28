<?php
use app\models\DateFormat;
?>

<h1><?= $gov['laws']['0']['subject']['departments']['0']['name']; ?></h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<h2>Внесенные законопроекты</h2>

<table class="table">
    <?php foreach($gov['laws'] as $bill): ?>
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