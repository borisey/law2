<?php
namespace app\models;
use Yii;
use yii\base\Model;

class NovapressReg extends Model {
    public function getUrl() {
        ob_start();

        $url = "https://regulation.gov.ru/api/npalist?limit=20&sort=desc";
        $content = simplexml_load_file($url);

//
//        echo '<pre>';
//        print_r($content);
//        die();

        foreach ($content as $url_rule){
            $urls[] = $url_rule;
        }

        return $urls;
    }
    public function getXml($urls){
        $host = Yii::$app->request->hostInfo; // домен сайта
        ob_start();
        echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
        <rss version="2.0">
            <channel>
                <title>Общественное обсуждение проектов федеральных законов и иных нормативных правовых актов</title>
                <link>http://law2.ru/public_discussion</link>
                <?php foreach($urls as $url): ?>
                    <item>
                        <title><?= $url->kind; ?> (разработчик - <?= $url->department; ?>) «<?= $url->title; ?>» (<?= $url->status; ?>)</title>
                        <description>
                            Стадия - <?= $url->procedure; ?> (<?= $url->stage; ?>).
                            Дата размещения - <?= $url->date; ?>.
                        </description>

                        <link><?= $host . '/public_discussion/' . $url['id'] ?></link>
                        <author>law2.ru</author>
                    </item>
                <?php endforeach; ?>
            </channel>
        </rss>
        <?php return ob_get_clean();
    }
    public function showXml($xml_sitemap){
        // устанавливаем формат отдачи контента
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        //повторно т.к. может не сработать
        header("Content-type: text/xml");
        echo $xml_sitemap;
        Yii::$app->end();
    }
}