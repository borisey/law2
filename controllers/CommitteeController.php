<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;

class CommitteeController extends SiteController
{
    public function actionCommittees()
    {
        ob_start();
        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
        );

        $url = "http://api.duma.gov.ru/api/$config[token]/committees.json?app_token=$config[app_token]&current=1";
        $get_committees = file_get_contents($url);
        $committees = json_decode($get_committees,true);

        $title = 'Комитеты Государственной Думы России | law2.ru';
        $description = 'На сайте представлена информация о комитетах Государственной Думы Федерального Собрания Российской Федерации';

        $this->setMeta($title, $description, 'all');

        return $this->render('committees', compact('pages', 'committees'));
    }

    public function actionCommittee($id)
    {
        ob_start();

        $page = Yii::$app->request->get('page');

        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
        );

        $url = "http://api.duma.gov.ru/api/$config[token]/search.json?app_token=$config[app_token]&profile_committee=$id&page=$page"; // Запрос законопроектов
        $content = file_get_contents($url);
        $committee = json_decode($content,true);

        $pages = new Pagination(['totalCount' => $committee['count'], 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $title = $committee['laws']['0']['committees']['profile']['0']['name'] . ' | Law2.ru';
        $description = $committee['laws']['0']['committees']['profile']['0']['name'] . ' - перечень законопроектов';

        if(isset($_GET['page'])) {
            $this->setMeta($title, $description, 'noindex');
        } else {
            $this->setMeta($title, $description, 'all');
        }

        return $this->render('committee', compact('pages', 'committee'));
    }
}