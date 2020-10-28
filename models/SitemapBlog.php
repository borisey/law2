<?php
namespace app\models;
use Yii;
use yii\base\Model;
class SitemapBlog extends Model{
    public function getUrl(){
        $urls = array();
        //Получаем массив URL из таблицы Sef
        $url_rules = Blog::find()
            ->select('id')
            ->where(['pub' => '1'])
            ->orderBy(['id' => SORT_DESC])
            ->limit(50000)
            ->all();
        foreach ($url_rules as $url_rule){
            $urls[] = array(Yii::$app->urlManager->createUrl([$url_rule->id]),'daily');
        }
        return $urls;
    }
    public function getXml($urls){
        $host = Yii::$app->request->hostInfo; // домен сайта
        ob_start(); ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <url>
                <loc><?= $host ?></loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>
            </url>
            <?php foreach($urls as $url): ?>
                <url>
                    <loc><?= $host.'/пост'.$url[0] ?></loc>
                    <changefreq><?= $url[1] ?></changefreq>
                </url>
            <?php endforeach; ?>
        </urlset>
        <?php
    }
    public function showXml($xml_sitemap){
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        header("Content-type: text/xml");
        echo $xml_sitemap;
        Yii::$app->end();
    }
}