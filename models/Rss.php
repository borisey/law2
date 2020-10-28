<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Rss extends Model{
    public function getUrl(){
        ob_start();
        $url_rules = Blog::find()
            ->select(['id', 'title'])
            ->where('pub=1')
            ->orderBy('id DESC')
            ->all();
        return $url_rules;
    }
    public function getXml($urls){

//        echo '<pre>';
//        print_r($urls);
//        echo '</pre>';
//        die();


        $host = Yii::$app->request->hostInfo; // домен сайта
        ob_start();?>
        <rss version="2.0">
            <channel>
                <title>Сайт для юристов Лоер.рф</title>
                <link>http://xn--e1aljj.xn--p1ai</link>
                <?php foreach($urls as $key => $value): ?>
                    <item>
                        <title><?= $value['title'] ?></title>
                        <link>http://лоер.рф/пост/<?= $value['id'] ?>/</link>
                        <description><?= $value['description'] ?></description>
                        <author>лоер.рф</author>
                        <enclosure url='http://лоер.рф/web/img/blog/<?= $value['id'] ?>.jpg' type='image/jpeg'/>
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
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        echo $xml_sitemap;
        Yii::$app->end();
    }
}