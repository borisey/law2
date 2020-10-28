<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="google-site-verification" content="M0wnaA5ZZfX3mGooAn4qjBHZtb33nW7WsHja_TkJZ9E" />
    <meta name="yandex-verification" content="2264fdd034fe398a" />
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(53600677, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/53600677" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Меню', 'items' => [
                ['label' => 'Внесенные', 'url' => ['/bill/bills']],
                ['label' => 'Общественное обсуждение проектов НПА', 'url' => ['/public-discussion/bills']],
                ['label' => 'На рассмотрении', 'url' => ['/consideration/bills']],
                ['label' => 'Завершено', 'url' => ['/complete/bills']],
                ['label' => 'Подписанные', 'url' => ['/sign/bills']],
                ['label' => 'Отклоненные', 'url' => ['/cancel/bills']],
                ['label' => 'Депутаты', 'url' => ['/deputy/deputies']],
                ['label' => 'Комитеты', 'url' => ['/committee/committees']],
                ['label' => 'ФОИВы', 'url' => ['/gov/govs']],
            ]],
    ]]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        &copy; <?= Yii::$app->name ?>, <?= date('Y') ?>
    </div>
</footer>

<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>