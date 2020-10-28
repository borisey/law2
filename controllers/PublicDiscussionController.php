<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;

class PublicDiscussionController extends SiteController
{
    public function actionBills()
    {
        ob_start();
        $page = Yii::$app->request->get('page');

        $config = array(
            "limit" => "20",
            "offset" => $page,
        );

        $url = "https://regulation.gov.ru/api/npalist?limit=$config[limit]&offset=$config[offset]&sort=desc";

        $bills = simplexml_load_file($url);

        $pages = new Pagination(['totalCount' => $bills['total'], 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);

        $title = 'Законопроекты России на сайте law2.ru';
        $description = 'На сайте представлены проекты федеральных законов и иных нормативных правовых актов России';

        if(isset($_GET['page'])) {
            $this->setMeta($title, $description, 'noindex');
        } else {
            $this->setMeta($title, $description, 'all');
        }

        return $this->render('bills', compact('bills', 'pages'));
    }

    public function actionBill($id)
    {
        ob_start();
        $id = Yii::$app->request->get('id');
        $url = "https://regulation.gov.ru/api/npalist/$id";
        $bill = simplexml_load_file($url);

        $title = $bill->project->kind . ' «' . $bill->project->title . '» | Law2.ru';
        $description = 'На данной странице представлен разработанный ' . $bill->project->department . ' проект нормативного правового акта «' . $bill->project->title . '»';

        $this->setMeta($title, $description, 'all');

        return $this->render('bill', compact('bill'));
    }
}