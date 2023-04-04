<?php

declare(strict_types=1);

use craft\ecs\SetList;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function(ECSConfig $ecsConfig): void {
    $ecsConfig->parallel();
    $ecsConfig->paths([
        __DIR__ . '/.twig_cs.php',
        __DIR__ . '/bootstrap.php',
        __DIR__ . '/ecs.php',
        __DIR__ . '/config',
        __DIR__ . '/modules',
    ]);

    $ecsConfig->sets([SetList::CRAFT_CMS_4]);
};
