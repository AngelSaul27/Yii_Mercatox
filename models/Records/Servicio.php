<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

class Servicio extends ActiveRecord
{
    public static function tableName()
    {
        return 'servicio';
    }
}