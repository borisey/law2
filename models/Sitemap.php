<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Sitemap extends Model{
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
            $urls[] = array(Yii::$app->urlManager->createUrl($url_rule['number']),'daily');
        }
        return $urls;
    }
    public function getXml($urls){
        $host = Yii::$app->request->hostInfo; // домен сайта
        ob_start();
        echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <url>
                <loc><?= $host ?></loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>
            </url>
            <?php foreach($urls as $url): ?>
                <url>
                    <loc><?= $host.$url[0] ?></loc>
                    <changefreq><?= $url[1] ?></changefreq>
                </url>
            <?php endforeach; ?>
        </urlset>
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