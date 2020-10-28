<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;

class DeputyController extends SiteController
{
    public function actionDeputies()
    {
        ob_start();
        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
        );

        $url = "http://api.duma.gov.ru/api/$config[token]/deputies.json?app_token=$config[app_token]&current=1&position=Депутат%20ГД";

        $get_deputies = file_get_contents($url);
        $deputies = json_decode($get_deputies,true);

        $title = 'Депутаты Государственной Думы России | law2.ru';
        $description = 'На сайте представлена информация о депутатах Государственной Думы Федерального Собрания Российской Федерации';

        $this->setMeta($title, $description, 'all');
        return $this->render('deputies', compact('deputies'));
    }

    public function actionDeputy($id)
    {
        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
        );
        $url = "http://api.duma.gov.ru/api/$config[token]/deputy.json?app_token=$config[app_token]&id=$id"; // Инфо о депутате
        $content = file_get_contents($url);
        $deputy = json_decode($content,true);

        $url_bills = "http://api.duma.gov.ru/api/$config[token]/search.json?app_token=$config[app_token]&deputy=$id"; // Запрос законопроектов, инициированных конкретным депутатом
        $get_bills = file_get_contents($url_bills);
        $bills = json_decode($get_bills,true);

        $pages = new Pagination(['totalCount' => $bills['count'], 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $name = $deputy['family'] .' ' . $deputy['name'] .' ' . $deputy['patronymic'];

        $title = $name . ' - депутат Государственной Думы | Law2.ru';
        $description = 'Депутат Государственной Думы Федерального Собрания Российской Федерации' .  $name;

        if(isset($_GET['page'])) {
            $this->setMeta($title, $description, 'noindex');
        } else {
            $this->setMeta($title, $description, 'all');
        }

        return $this->render('deputy', compact('deputy','bills', 'pages'));
    }
}