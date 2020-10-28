<?php
use app\models\DateFormat;
?>

<h1>Законопроекты, рассмотрение которых завершено</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <?php foreach($bills['laws'] as $doc): ?>
                    <tr>
                        <td style="width: 100px;">
                            <?php
                                $date = new DateFormat($doc['introductionDate']);
                                echo $date->changeDateFormat();
                            ?>
                        </td>
                        <td align="justify">
                            <a href="<?= \yii\helpers\Url::to(['bill/bill', 'id' => $doc['number']]) ?>" title="<?php echo 'Законопроект' . ' № ' . $doc['number']; ?>"><?php echo 'Законопроект № ' . $doc['number'] . ' ' . '«' . $doc['name']  . '»'; ?></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages,]); ?>
        </div>
    </div>
</div>