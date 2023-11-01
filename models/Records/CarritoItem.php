<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

class CarritoItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'carrito_item';
    }

    public static function getCarritoItem($id, $carrito_id)
    {
        return parent::find()->where(['id' => $id, 'carrito_id' => $carrito_id])->one();
    }
}