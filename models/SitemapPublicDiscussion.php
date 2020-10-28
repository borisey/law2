<?php
namespace app\models;
use Yii;
use yii\base\Model;

class SitemapPublicDiscussion extends Model{
    public function getUrl(){
        ob_start();
        $config = array(
            "limit" => "20",
            "offset" => 0,
        );
        $url = "https://regulation.gov.ru/api/npalist?limit=$config[limit]&offset=$config[offset]&sort=desc";
        $content = simplexml_load_file($url);

//        echo '<pre>';
//        print_r($content);
//        die();

        $url_rules = $content;

        foreach ($url_rules->project as $url_rule){
            $urls[] = array(Yii::$app->urlManager->createUrl('public_discussion/' . $url_rule['id']),'daily');
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