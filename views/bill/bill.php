<?php

use app\models\DateFormat;

$value = $bill['laws']['0'];
?>

<h1>Проект федерального закона № <?php echo $value['number']; ?> «<?php echo $value['name']; ?>»</h1>

<?php include(Yii::getAlias('@app/web/share.php')); ?>

<br>
<br>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <td>Идентификатор</td>
                    <td><?php echo $value['id']; ?></td>
                </tr>
                <tr>
                    <td>Номер</td>
                    <td><?php echo $value['number']; ?></td>
                </tr>
                <tr>
                    <td>Тип документа</td>
                    <td><?php echo $value['type']['name']; ?></td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td><?php echo $value['name']; ?></td>
                </tr>
                <tr>
                    <td>Комментарий</td>
                    <td><?php echo $value['comments']; ?></td>
                </tr>
                <tr>
                    <td>Дата внесения</td>
                    <td>
                        <?php
                            $date = new DateFormat($value['introductionDate']);
                            echo $date->changeDateFormat();
                        ?>
                    </td>
                </tr>
            </table>

                <div class="jumbotron">
                    <h2>Последнее событие, связанное с законопроектом</h2>
                </div>

            <table class="table">
                <tr>
                    <td>Стадия рассмотрения</td>
                    <td><?php echo $value['lastEvent']['stage']['name']; ?></td>
                </tr>

                <tr>
                    <td>Событие рассмотрения</td>
                    <td><?php echo $value['lastEvent']['phase']['name']; ?></td>
                </tr>

                <tr>
                    <td>Принятое решение (формулировка)</td>
                    <td><?php echo $value['lastEvent']['solution'] ?></td>
                </tr>

                <tr>
                    <td>Дата последнего события</td>
                    <td>
                        <?php
                            $date = new DateFormat($value['lastEvent']['date']);
                            echo $date->changeDateFormat();
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Документ, связанный с событием рассмотрения законопроекта</td>
                    <td>
                        <?php echo $value['lastEvent']['document']['type'] . ' ' . $value['lastEvent']['document']['name'] ; ?>
                    </td>

                </tr>
            </table>

                <div class="jumbotron">
                    <h2>Субъект законодательной инициативы</h2>
                </div>

            <table class="table">

                <tr>
                    <td>Депутаты</td>
                    <td>
                        <?php foreach ($value['subject']['deputies'] as $deputy): ?>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['deputy/deputy', 'id' => $deputy['id']]) ?>" title="<?php echo $deputy['position'] . ' ' . $deputy['name']; ?>"><?= $deputy['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td>Орган государственной власти</td>
                    <td>
                        <?php foreach ($value['subject']['departments'] as $deputy): ?>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['gov/gov', 'id' => $deputy['id']]) ?>" title="<?php echo $deputy['name'] . ' - внесенные законопроекты'; ?>"><?= $deputy['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td>Фракции</td>
                    <td>
                        <?php foreach ($value['subject']['factions'] as $deputy): ?>
                            <li>
                                <?= $deputy['name']; ?>
                            </li>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>

                <div class="jumbotron">
                    <h2>Комитеты</h2>
                </div>

            <table class="table">
                <tr>
                    <td>Ответственный комитет</td>
                    <td>
                        <ul>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['committee/committee', 'id' => $value['committees']['responsible']['id']]) ?>" title="<?= $value['committees']['responsible']['name']; ?>"><?php echo $value['committees']['responsible']['name']; ?></a>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Профильный комитет</td>
                    <td>
                        <ul>
                            <?php foreach ($value['committees']['profile'] as $deputy): ?>
                                <li>
                                    <a href="<?= \yii\helpers\Url::to(['committee/committee', 'id' => $deputy['id']]) ?>" title="<?= $deputy['name']; ?>"><?= $deputy['name']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Комитет-соисполнитель</td>
                    <td>
                        <ul>
                            <?php foreach ($value['committees']['soexecutor'] as $deputy): ?>
                                <li>
                                    <a href="<?= \yii\helpers\Url::to(['committee/committee', 'id' => $deputy['id']]) ?>" title="<?= $deputy['name']; ?>"><?= $deputy['name']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            </table>

            <h2>Стенограмма рассмотрения законопроекта</h2>
            <?php foreach ($transcripts['meetings'] as $translit): ?>
                <?php foreach ($translit['questions'] as $question): ?>
                    <h3>Стадия: <?php echo $question['stage']; ?></h3>
                    <h4>Вопрос: <?php echo $question['name']; ?></h4>
                    <table class="table">
                        <?php foreach ($question['parts'] as $part): ?>
                            <?php foreach ($part['lines'] as $key => $line): ?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $line; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </table>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>