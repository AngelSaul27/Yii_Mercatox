<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '975XXmvdkgqjNGlVNMoIzkc9JQRb9n16',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'bootstrap' => [
            'class' => 'yii\bootstrap5\BootstrapAsset',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'timeZone' => 'America/Mexico_City'
        ],

        /** ====================
            replace for user-management
            'user' => [
                'identityClass' => 'app\models\User',
                'enableAutoLogin' => true,
            ],
        ==================== */

        /** ==================== */
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',

            // Comment this if you don't want to record user logins
            'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
        /** ===============*/

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'register' => 'site/register',
                'register-vendedor' => 'site/register-vendedor',

                //Vendedor
                'vendedor/mis-productos' => 'vendedor/productos',
                'vendedor/mis-productos/create' => 'vendedor/producto-create',
                'vendedor/mi-producto/<id:\d+>/oferta' => 'vendedor/producto-oferta',
                'vendedor/mi-producto/<id:\d+>/edit' => 'vendedor/producto-edit',
                'vendedor/mi-producto/<id:\d+>/delete' => 'vendedor/producto-delete',

                //Compradores
                'mi-carrito/' => 'carrito/view',
                'mi-carrito/procesar/comprar' => 'carrito/procesar-carrito',
                'mi-carrito/producto/<id:\d+>/remove' => 'carrito/remove-producto',
                'mis-compras' => 'carrito/historial',

                //Sitio
                'producto/<id:\d+>' => 'producto/view',
                'producto/search' => 'site/search',
                'producto/explorar' => 'producto/all-producto',

                //Administración
                'management/advertisements' => 'sistema/advertisement',
                'management/advertisements/<id:\d+>/delete' => 'sistema/advertisement-delete',
                'management/advertisements/<id:\d+>/edit' => 'sistema/advertisement-edit',
                'management/advertisements/create' => 'sistema/advertisement-create',

            ],
        ],
    ],
    'params' => $params,
    /**====================**/
    'modules'=>[
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'enableRegistration' => true,
            // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
            // The example below allows user to enter :
            // any set of characters
            // (?=\S{8,}): of at least length 8
            // (?=\S*[a-z]): containing at least one lowercase letter
            // (?=\S*[A-Z]): and at least one uppercase letter
            // (?=\S*[\d]): and at least one number
            // $: anchored to the end of the string
            //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',
            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction'=>function(yii\base\ActionEvent $event) {},
        ],
    ],
    /**====================*/
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
