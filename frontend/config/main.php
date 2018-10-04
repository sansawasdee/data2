<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
  
    


return [
    'id' => 'CR',
    'name'=>'CR DATA',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'view'=>[
            'theme'=>[
                'pathMap'=>[
                  // '@app/views'=>'@frontend/themes/matrial/views'
				     '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ]
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
		   //'identityClass' => 'common\models\User',
           //  'enableAutoLogin' => true,
           'identityClass' => 'dektrium\user\models\User',
		    'enableAutoLogin' => false,
           'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
		   
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
	
        	
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
        ],
    ],
    'params' => $params,
];
