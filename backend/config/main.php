<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        "admin" => [        
            "class" => "mdm\admin\Module",  
            // 'layout' => 'left-menu' 
        ],
    ],
    "aliases" => [    
        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    'components' => [
        'assetManager'=>[
            'bundles'=>[
                'yii\web\JqueryAsset'=>[
                    'jsOptions'=>[
                        'position'=>\yii\web\View::POS_HEAD,
                    ]
                ]
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        "authManager" => [        
            "class" => 'yii\rbac\DbManager', //这里记得用单引号而不是双引号        
            "defaultRoles" => ["guest"],    
        ], 
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','trace','error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'as access' => [
       //ACF肯定是要加的，因为粗心导致该配置漏掉了，很是抱歉
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*'
            //这里是允许访问的action
            //controller/action
        ]
    ],
    'params' => $params,
];
