<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

class Producto extends ActiveRecord
{
    public static function tableName()
    {
        return 'producto';
    }
}