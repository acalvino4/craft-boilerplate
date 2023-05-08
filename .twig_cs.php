<?php

declare(strict_types=1);

use acalvino4\crafttwigruleset\CraftRuleset;
use FriendsOfTwig\Twigcs\Config\Config;
use FriendsOfTwig\Twigcs\Finder\TemplateFinder;

return Config::create()
    ->addFinder(TemplateFinder::create()->in('templates'))
    ->setRuleSet(CraftRuleset::class)
;
