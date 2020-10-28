<h1>Комитеты Государственной Думы Российской Федерации</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <ol>
                <?php foreach ($committees as $committee): ?>
                    <li>
                        <a href='<?= \yii\helpers\Url::to(['committee/committee', 'id' => $committee['id']]) ?>'><?= $committee['name']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</div>