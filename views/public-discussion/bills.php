<h1>Общественное обсуждение проектов нормативных правовых актов</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <?php foreach ($bills as $bill): ?>
                    <tr>
                        <td style="width: 200px;">
                            <?php
                                $date_time_exploded = explode("T", $bill->date);
                                $date_first = $date_time_exploded['0'];
                                $time = $date_time_exploded['1'];

                                $date_exploded = explode("-", $date_first);

                                $year = $date_exploded[0];
                                $month = $date_exploded[1];
                                $day = $date_exploded[2];

                                $date_time = $day . '.' . $month . '.' . $year . ' (' . $time . ')';
                            ?>
                            <?= $date_time; ?>
                        </td>
                        <td style="width: 100px;">
                            <?= $bill->stage; ?>
                        </td>
                        <td align="justify">
                            <a href="<?= \yii\helpers\Url::to(['public-discussion/bill', 'id' => $bill['id']['0']]) ?>"><?= $bill->title; ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages,]); ?>

        </div>
    </div>
</div>