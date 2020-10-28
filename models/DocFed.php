<?php


namespace app\models;


use yii\db\ActiveRecord;

class DocFed extends ActiveRecord
{
    public static function tableName()
    {
        return 'fed_zakon';
    }
}