<?php

namespace app\models\Records;

use Yii;
use yii\db\ActiveRecord;

class CompradorDetalle extends ActiveRecord
{
    public static function tableName()
    {
        return 'comprador';
    }

    public static function getId(){
        return parent::find()->select('id')->where(['user_id' => Yii::$app->user->id])->one();
    }
}