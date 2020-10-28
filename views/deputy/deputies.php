<h1>Депутаты Государственной Думы Российской Федерации</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <?php foreach ($deputies as $deputy): ?>
                    <tr>
                        <td>
                            <a href='<?= \yii\helpers\Url::to(['deputy/deputy', 'id' => $deputy['id']]) ?>'><?= $deputy['name']; ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>