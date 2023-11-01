<?php

namespace app\models;

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use Yii;

class Usuario extends User
{
    public const ROLE_COMPRADOR = 'Comprador';
    public const ROLE_VENDEDOR = 'Vendedor';

    public static function getRoleName(){
        return key(Role::getUserRoles(Yii::$app->user->id));
    }

}