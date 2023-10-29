<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

class DireccionEntrega extends ActiveRecord
{
    public static function tableName()
    {
        return 'direccion_entrega';
    }
}