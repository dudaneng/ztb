<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'nishiwoxinneideyishouge',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
        'db' => require(__DIR__ . '/db.php'),
		'view' => [
			'theme' => [
				'pathMap' => [
					'@app/views' => '@app/themes/default/views',
					'@app/modules' => '@app/themes/default/views',
				],
				'baseUrl' => '@web/themes/default/public',
			],
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules'=>[
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			],
		],
		
		// 邮箱配置
		'mailer' => [
           'class' => 'yii\swiftmailer\Mailer',  
           'transport' => [
						   'class' => 'Swift_SmtpTransport',  
						   'host' => 'smtp.qq.com',  
						   'username' => '2315968941@qq.com',  
						   'password' => 'zhouyz1991',  
						   'port' => '25',  
						   'encryption' => 'tls',  
                                   
                           ],   
           'messageConfig'=>[
               'charset'=>'UTF-8',
               'from'=>['2315968941@qq.com'=>'大业互动']
               ],  
       ],  
    ],
    'params' => $params,
	'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\admin',
        ],
		'user' => [
            'class' => 'app\modules\user\user',
        ],
		'express' => [
            'class' => 'app\modules\express\express',
        ],
		'myweb' => [
            'class' => 'app\modules\myweb\myweb',
        ],
	],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
