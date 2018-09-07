<?php
return [
	'timeZone' => 'Asia/Shanghai',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
        // this is the name of the session cookie used for login on the frontend
        	'timeout'=>300,
         
        ],
    ],
    
];
