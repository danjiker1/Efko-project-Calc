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
        // '@mdm/admin' => '@app/extensions/mdm/yii2-admin-2.12',
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        // 'defaultRoles' => ['guest'],
        'allowActions' => ['site/*', 'admin/*'],
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // defaults to null, using the application's layout without the menu
                                     // other available values are 'right-menu' and 'top-menu'
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager' PhpManager
            'defaultRoles'    => ['guest'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache', // Используем файловый кэш FileCache
            // 'class' => 'yii\caching\ApcCache', // Используйте APC, если он доступен
        ],
        'httpClient' => [
            'class' => 'yii\httpclient\Client',
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HuT5O38AoyjQRIO63cW-Rj-aHHeaPf2n',
            
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
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
                'history' => 'site/history',
                'users' => 'site/users',
                'site/index',
                'api/get-data/<type:\w+>' => 'api/get-data',
                'api/v1/json-schema' => 'swagger-ui/get-spec',
                'api/v1/months' => 'api/api-month',
                'api/v1/tonnages' => 'api/api-tonnages',
                'api/v1/types' => 'api/api-types',
                'api/v1/calculate' => 'api/get-calculate',
                'api/calculate' => 'api/get-calculate',
            ],
        ],
 
    ],
    'params' => $params,
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
// yii migrate --migrationPath=@yii/rbac/migrations