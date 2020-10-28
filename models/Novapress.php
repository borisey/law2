<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Novapress extends Model{
    public function getUrl(){
        ob_start();
        $config = array(
            "token"     => "71ed9438b0340eedada46ea317de560b15acc083",
            "app_token" => "appc9f47f4a1c75d63dfe8ad54a728889438f20f5ae",
        );
        $url = "http://api.duma.gov.ru/api/$config[token]/search.json?app_token=$config[app_token]&status=1";
        $content = file_get_contents($url);
        $jsonResult = json_decode($content,true);
        $url_rules = $jsonResult;

        foreach ($url_rules['laws'] as $url_rule){
            $urls[] = $url_rule;
        }

//        echo '<pre>';
//        print_r($urls);
//        die();

        return $urls;
    }
    public function getXml($urls){
        $host = Yii::$app->request->hostInfo; // домен сайта
        ob_start();
        echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
        <rss version="2.0">
            <channel>
                <title>Внесенные в ГД Законопроекты</title>
                <link>http://law2.ru</link>
                <?php foreach($urls as $url): ?>
                    <item>
                        <title>В Государственную Думу внесен проект федерального закона № <?= $url['number'] ?> «<?= $url['name'] ?>»</title>
                        <link><?= $host . '/' . $url['number'] ?></link>
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