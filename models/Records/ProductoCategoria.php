<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

class ProductoCategoria extends ActiveRecord
{
    public static function tableName()
    {
        return 'categoria';
    }
}