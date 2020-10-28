<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;

class CancelController extends SiteController
{
    public function actionBills()
    {
        ob_start();
        $page = Yii::$app->request->get('page');

        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
            "status" => "6",
            "page" => $page,
        );

        $url = "http://api.duma.gov.ru/api/$config[token]/search.json?app_token=$config[app_token]&status=$config[status]&page=$config[page]";

        $content = file_get_contents($url);
        $bills = json_decode($content,true);

        $pages = new Pagination(['totalCount' => $bills['count'], 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $title = 'Отклоненные (снятые) с рассмотрения законопроекты | law2.ru';
        $description = 'На сайте представлены отклоненные (снятые) с рассмотрения законопроекты';

        if(isset($_GET['page'])) {
            $this->setMeta($title, $description, 'noindex');
        } else {
            $this->setMeta($title, $description, 'all');
        }

        return $this->render('bills', compact('pages', 'bills'));
    }
}