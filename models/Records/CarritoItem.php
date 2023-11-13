<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

/**
 * @property int|mixed|null $cantidad
 * @property mixed|null $producto_id
 * @property mixed|null $carrito_id
 * @property mixed|null $precio_cantidad
 */
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