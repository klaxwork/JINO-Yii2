<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //*/
        'user' => [
            'class' => 'common\components\WebUser',
            'identityClass' => 'common\components\UserIdentity',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        //*/
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=klaxwork',
            'username' => 'klaxwork',
            'password' => 'likakglp',
            'charset' => 'utf8',
        ],
    ],
];
