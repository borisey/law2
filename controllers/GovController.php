<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;

class GovController extends SiteController
{
    public function actionGovs()
    {
        ob_start();
        $page = Yii::$app->request->get('page');

        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
            "status" => "8",
            "page" => $page,
        );

        $url = "http://api.duma.gov.ru/api/$config[token]/federal-organs.json?app_token=$config[app_token]";

        $get_govs = file_get_contents($url);
        $govs = json_decode($get_govs,true);

        $title = 'Федеральные органы власти | law2.ru';
        $description = 'На сайте представлены федеральные органы власти Российской Федерации';

        if(isset($_GET['page'])) {
            $this->setMeta($title, $description, 'noindex');
        } else{
            $this->setMeta($title, $description, 'all');
        }

        return $this->render('govs', compact('pages', 'govs'));
    }

    public function actionGov($id)
    {
        ob_start();

        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
        );

        $url = "http://api.duma.gov.ru/api/$config[token]/search.json?app_token=$config[app_token]&federal_subject=$id"; // Запрос законопроектов
        $get_gov = file_get_contents($url);
        $gov = json_decode($get_gov,true);

        $pages = new Pagination(['totalCount' => $gov['count'], 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $committee = $gov['laws']['0']['subject']['departments']['0']['name'];

        $title = $committee . ' - перечень законопроектов | Law2.ru';
        $description = $committee . ' - перечень внесенных в Государственную Думу законопроектов';

        if(isset($_GET['page'])) {
            $this->setMeta($title, $description, 'noindex');
        } else {
            $this->setMeta($title, $description, 'all');
        }

        return $this->render('gov', compact('pages', 'gov'));
    }
}