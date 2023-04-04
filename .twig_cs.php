<?php

declare(strict_types=1);

use FriendsOfTwig\Twigcs\Config\Config;
use FriendsOfTwig\Twigcs\Finder\TemplateFinder;
use FriendsOfTwig\Twigcs\RegEngine\RulesetBuilder;
use FriendsOfTwig\Twigcs\RegEngine\RulesetConfigurator;
use FriendsOfTwig\Twigcs\Rule;
use FriendsOfTwig\Twigcs\Ruleset\RulesetInterface;
use FriendsOfTwig\Twigcs\Ruleset\TemplateResolverAwareInterface;
use FriendsOfTwig\Twigcs\TemplateResolver\NullResolver;
use FriendsOfTwig\Twigcs\TemplateResolver\TemplateResolverInterface;
use FriendsOfTwig\Twigcs\Validator\Violation;

class CustomRulesetBuilder extends RulesetBuilder
{
    /**
     * An override of a parent function for the purpose of adding an allowed operator
     * @return array<string, array<int, mixed>>
     */
    public function build(): array
    {
        $newOps = $this->using(self::OP_VARS, [['$➀\?\?\?➁$', $this->binaryOpSpace('???')]]);

        $build = parent::build();
        $expr = $build['expr'];
        $build['expr'] = array_merge(
            $newOps,
            $expr,
        );
        return $build;
    }
}

class CustomRuleset implements RulesetInterface, TemplateResolverAwareInterface
{
    private int $twigMajorVersion;

    private TemplateResolverInterface $resolver;

    public function __construct(int $twigMajorVersion)
    {
        $this->twigMajorVersion = $twigMajorVersion;
        $this->resolver = new NullResolver();
    }

    public function getRules()
    {
        $configurator = new RulesetConfigurator();
        $configurator->setTwigMajorVersion($this->twigMajorVersion);
        $builder = new CustomRulesetBuilder($configurator);

        return [
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\TrailingSpace(Violation::SEVERITY_ERROR),
            new Rule\UnusedMacro(Violation::SEVERITY_WARNING, $this->resolver),
            new Rule\UnusedVariable(Violation::SEVERITY_WARNING, $this->resolver),
        ];
    }

    public function setTemplateResolver(TemplateResolverInterface $resolver): void
    {
        $this->resolver = $resolver;
    }
}


return Config::create()
    ->addFinder(TemplateFinder::create()->in('templates'))
    ->setRuleSet(CustomRuleset::class)
;
