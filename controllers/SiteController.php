<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Sitemap;
use app\models\SitemapPublicDiscussion;
use app\models\Novapress;
use app\models\NovapressReg;
use yii\data\Pagination;

class SiteController extends Controller
{

    protected function setMeta($title = null, $description = null, $robots = 'all'){
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
        $this->view->registerMetaTag(['name' => 'robots', 'content' => "$robots"]);
        $this->view->registerLinkTag(['rel' => 'icon', 'type' => 'image/jpeg', 'href' => '/web/favicon.jpg']);
    }

    // Карта сайта законопроектов. Выводит в виде XML файла.
    public function actionSitemap(){
        $sitemap = new Sitemap();
        $urls = $sitemap->getUrl();
        $xml_sitemap = $sitemap->getXml($urls);
        $sitemap->showXml($xml_sitemap);
    }

    // Карта сайта публичного обсуждения. Выводит в виде XML файла.
    public function actionSitemapPublicDiscussion(){
        $sitemap_public = new SitemapPublicDiscussion();
        $urls = $sitemap_public->getUrl();
        $xml_sitemap = $sitemap_public->getXml($urls);
        $sitemap_public->showXml($xml_sitemap);
    }

    // RSS-лента для кросспостинга Госдумы
    public function actionNovapress(){
        $sitemap = new Novapress();
        $urls = $sitemap->getUrl();
        $xml_sitemap = $sitemap->getXml($urls);
        $sitemap->showXml($xml_sitemap);
    }

    // RSS-лента для кросспостинга regulation
    public function actionNovapressReg(){
        $sitemap = new NovapressReg();
        $urls = $sitemap->getUrl();
        $xml_sitemap = $sitemap->getXml($urls);
        $sitemap->showXml($xml_sitemap);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}