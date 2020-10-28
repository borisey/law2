<h1>Субъекты законодательной инициативы на федеральном уровне</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <?php foreach ($govs as $gov): ?>
                    <tr>
                        <td>
                            <a href='<?= \yii\helpers\Url::to(['gov/gov', 'id' => $gov['id']]) ?>' title="<?= $gov['name']; ?> - субъект законодательной инициативы"><?= $gov['name']; ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>