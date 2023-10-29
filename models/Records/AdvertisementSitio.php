<?php

namespace app\models\Records;

use yii\db\ActiveRecord;

class AdvertisementSitio extends ActiveRecord
{
    public static function tableName()
    {
        return 'advertisement_site';
    }
}