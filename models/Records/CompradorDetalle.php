<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

class CompradorDetalle extends ActiveRecord
{
    public static function tableName()
    {
        return 'comprador';
    }
}