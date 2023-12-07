<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

/**
 * @property mixed|null $stock
 * @property mixed|null $vendedor_id
 * @property mixed|null $categoria_id
 */
class Producto extends ActiveRecord
{
    public static function tableName()
    {
        return 'producto';
    }
}