<?php
use app\models\DateFormat;
?>

<h1><?= $bill->project->kind; ?> «<?= $bill->project->title; ?>» (разработчик - <?= $bill->project->department; ?>)</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <td width="30%">Информация о проекте на Федеральном портале проектов НПА</td>
                    <td><a href="https://regulation.gov.ru/projects#npa=107713<?= $bill->project->id; ?>">https://regulation.gov.ru/projects#npa=107713<?= $bill->project->id; ?></a></td>
                </tr>
                <tr>
                    <td>Название проекта</td>
                    <td><?= $bill->project->title; ?></td>
                </tr>
                <tr>
                    <td>Тип проекта</td>
                    <td><?= $bill->project->kind; ?></td>
                </tr>
                <tr>
                    <td>Идентификатор проекта</td>
                    <td><?= $bill->project->projectId; ?></td>
                </tr>
                <tr>
                    <td>Дата и время размещения</td>
                    <td>
                        <?php
                            $project_date = new DateFormat($bill->project->date);
                            echo $project_date->changeDateTimeFormat();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Этап</td>
                    <td><?= $bill->project->stage; ?></td>
                </tr>
                <tr>
                    <td>Статус</td>
                    <td><?= $bill->project->status; ?></td>
                </tr>
                <tr>
                    <td>Разработчик</td>
                    <td><?= $bill->project->department; ?></td>
                </tr>
                <tr>
                    <td>Стадия</td>
                    <td><?= $bill->project->procedure; ?></td>
                </tr>
                <tr>
                    <td>Сотрудник, ответственный за разработку проекта</td>
                    <td><?= $bill->project->responsible; ?></td>
                </tr>
                <tr>
                    <td>Степень регулирующего воздействия</td>
                    <td><?= $bill->project->regulatoryImpact; ?></td>
                </tr>
                <tr>
                    <td>Результат процедуры</td>
                    <td><?= $bill->project->procedureResult; ?></td>
                </tr>
                <tr>
                    <td>Начало параллельной стадии обсуждения</td>
                    <td>
                        <?php
                            $parallel_date = new DateFormat($bill->project->parallelStageStartDiscussion);
                            echo $parallel_date->changeDateTimeFormat();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Следующий этап</td>
                    <td><?= $bill->project->nextStageDuration; ?></td>
                </tr>
                <tr>
                    <td>Начало публичного обсуждения</td>
                    <td><?= $bill->project->startDiscussion; ?></td>
                </tr>
                <tr>
                    <td>Завершение публичного обсуждения</td>
                    <td><?= $bill->project->endDiscussion; ?></td>
                </tr>
                <tr>
                    <td>Количество дней на публичное обсуждение</td>
                    <td><?= $bill->project->discussionDays; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>