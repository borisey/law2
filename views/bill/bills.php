<?php
use app\models\DateFormat;
?>

<h1>Проекты законов и иных нормативных правовых актов России</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <h2>Законопроекты, внесенные в Государственную Думу</h2>
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
                            <a href="<?= \yii\helpers\Url::to(['bill/bill', 'id' => $doc['number']]) ?>"
                               title="<?= 'Проект федерального закона ' . ' № ' . $doc['number']; ?>">
                                <?= 'Законопроект № ' . $doc['number'] . ' ' . '«' . $doc['name']  . '»'; ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages,]); ?>
        </div>
    </div>
</div>