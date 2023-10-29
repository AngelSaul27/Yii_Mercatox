<?php

namespace app\models\Records;

use Yii;
use yii\db\ActiveRecord;

class Vendedor extends ActiveRecord
{
    public static function tableName()
    {
        return 'vendedor';
    }

    public static function getIdVendedor(){
        return parent::find()->select('id')->where(['user_id' => Yii::$app->user->id])->scalar();
    }
}