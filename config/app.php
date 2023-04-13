<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 *
 * Read more about application configuration:
 * https://craftcms.com/docs/4.x/config/app.html
 */

use craft\helpers\App;
use craft\mutex\Mutex as CraftMutex;
use modules\cpassets;
use yii\queue\redis\Queue;
use yii\redis\Cache;
use yii\redis\Mutex as YiiMutex;

return [
    'id' => App::env('CRAFT_APP_ID') ?: 'CraftCMS',
    'components' => [
        'cache' => function() {
            $config = [
                'class' => Cache::class,
                'keyPrefix' => Craft::$app->id,
                'defaultDuration' => Craft::$app->config->general->cacheDuration,

                'redis' => [
                    'hostname' => App::env('REDIS_HOST'),
                    'port' => App::env('REDIS_PORT'),
                    'password' => App::env('REDIS_PASS'),
                    'database' => 0,
                ],
            ];

            return Craft::createObject($config);
        },
        'queue' => [
            'proxyQueue' => [
                'class' => Queue::class,
                'redis' => [
                    'hostname' => App::env('REDIS_HOST'),
                    'port' => App::env('REDIS_PORT'),
                    'password' => App::env('REDIS_PASS'),
                    'database' => 1,
                ],
            ],
            'channel' => 'queue', // Queue channel key
        ],
        'mutex' => function() {
            $config = [
                'class' => CraftMutex::class,
                'mutex' => [
                    'class' => YiiMutex::class,
                    // set the max duration to 15 minutes for console requests
                    'expire' => Craft::$app->request->isConsoleRequest ? 900 : 30,
                    'redis' => [
                        'hostname' => App::env('REDIS_HOST'),
                        'port' => App::env('REDIS_PORT'),
                        'password' => App::env('REDIS_PASS'),
                        'database' => 2,
                    ],
                ],
            ];

            return Craft::createObject($config);
        },
    ],
    'modules' => ['cp-assets' => cpassets\Module::class],
    'bootstrap' => ['cp-assets'],
];
