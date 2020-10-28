<?php


namespace app\models;


use yii\db\ActiveRecord;

class CaseAct extends ActiveRecord
{
    public static function tableName()
    {
        return 'sud_act';
    }
}