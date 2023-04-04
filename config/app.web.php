<?php
/**
 * Yii Web Application Config
 */

use craft\helpers\App;

use yii\redis\Session;

return [
    'id' => App::env('CRAFT_APP_ID') ?: 'CraftCMS',
    'components' => [
        'session' => function() {
            $config = craft\helpers\App::sessionConfig();
            $config['class'] = Session::class;
            $config['redis'] = [
                'hostname' => App::env('REDIS_HOST'),
                'port' => App::env('REDIS_PORT'),
                'password' => App::env('REDIS_PASS'),
                'database' => 3,
            ];

            // @phpstan-ignore-next-line
            return Craft::createObject($config);
        },
    ],
];
