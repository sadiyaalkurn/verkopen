<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'  => [
            'class' => 'yii\rbac\DbManager',
        ],
        'authClientCollection' => [
	    'class' => yii\authclient\Collection::className(),
	    'clients' => [
	        'facebook' => [
	            'class'        => 'dektrium\user\clients\Facebook',
	            'clientId'     => '1201043749966099',
	            'clientSecret' => '9b2ff733e230ffc33abcff5ee9c9a0a2',
	        ],
	        'google' => [
	            'class'        => 'dektrium\user\clients\Google',
	            'clientId'     => '624081729337-kna3uvahsmtdl1hlud1l93sq20um1u09.apps.googleusercontent.com',
	            'clientSecret' => '3MV32U87GLWr_pXwU1c5zn7B',
	        ],
	    ],
	],
	'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            //'host' => '74.125.200.108',
            'username' => 'sadiya.alkurn@gmail.com',
            'password' => 'alkurnworkforce',
            'port' => '587',
            'encryption' => 'tls',
            ],
        ],
        'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/index',
            'user/login',
            'site/about',
            'site/our-services',
            'site/our-partners',
            'user/register',
            'debug/*'
        ]
    ]
    ],
];
