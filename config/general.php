<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\config\GeneralConfig;
use craft\helpers\App;

$isDev = App::env('CRAFT_ENVIRONMENT') === 'dev';
$isProd = App::env('CRAFT_ENVIRONMENT') === 'production';

return GeneralConfig::create()
    ->defaultWeekStartDay(0)
    ->omitScriptNameInUrls()
    ->devMode($isDev)
    ->preloadSingles()
    ->allowAdminChanges($isDev)
    ->disallowRobots(!$isProd)
    ->privateTemplateTrigger('')
    ->errorTemplatePrefix('error/')
    ->cpTrigger('CHANGEME')
    ->sendPoweredByHeader(false)
    ->aliases([
        '@web' => App::env('PRIMARY_SITE_URL'),
    ])
    ->cacheDuration(86400)
    ->upscaleImages(false)
;
