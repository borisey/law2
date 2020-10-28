<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;

class BillController extends SiteController
{
    public function actionBills() {
        ob_start();
        $page = Yii::$app->request->get('page');

        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
            "status" => "1",
            "page" => $page,
        );

        $url = "http://api.duma.gov.ru/api/$config[token]/search.json?app_token=$config[app_token]&status=$config[status]&page=$config[page]";

        $get_bills = file_get_contents($url);
        $bills = json_decode($get_bills,true);

        $pages = new Pagination(['totalCount' => $bills['count'], 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $title = 'Проекты федеральных законов и иных нормативных правовых актов России | law2.ru';
        $description = 'Актуальная информация о законопроектах и иных нормативных правовых актах России по состоянию на ' . date('Y') . ' год';

        if(isset($_GET['page'])) {
            $this->setMeta($title, $description, 'noindex');
        } else {
            $this->setMeta($title, $description, 'all');
        }

        return $this->render('bills', compact('pages', 'bills'));
    }

    public function actionBill($id)
    {
        ob_start();
        $config = array(
            "token"     => Yii::$app->params['token'],
            "app_token" => Yii::$app->params['app_token'],
            "search_mode" => "1",
            "stage" => "1",
        );

        $url_bills = "http://api.duma.gov.ru/api/$config[token]/search.json?app_token=$config[app_token]&number=$id&search_mode=$config[search_mode]&stage=$config[stage]";
        $get_bills = file_get_contents($url_bills);
        $bill = json_decode($get_bills,true);

        $number = $bill['laws']['0']['number'];
        $name = $bill['laws']['0']['name'];
        $name = '«' . $name . '»';

        $title = $number . ' - законопроект ' . $name;
        $description = 'Актуальная информация о проекте федерального закона № ' . $number . ' ' . $name . ' по состоянию на ' . date('Y') . ' год';

        $this->setMeta($title, $description, 'all');

        $url_transcripts = "http://api.duma.gov.ru/api/" . $config["token"] . "/transcript/$id.json?app_token=$config[app_token]" ;
        $get_transcripts = file_get_contents($url_transcripts);
        $transcripts = json_decode($get_transcripts,true);

        return $this->render('bill', compact('bill', 'transcripts'));
    }
}