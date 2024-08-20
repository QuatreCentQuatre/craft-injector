<?php

namespace quatrecentquatre\injector\twigextensions;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;
use quatrecentquatre\injector\records\InjectorScriptsRecord;
use quatrecentquatre\injector\services\InjectorService;

class InjectorTwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @inheritdoc
     */
    public function getGlobals(): array
    {
        return [
        ];
    }

    /**
     * Return our Twig Extension name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Site';
    }

    /**
     * Return our Twig filters
     *
     * @return array
     */
    public function getFilters(): array
    {
        return [];
    }

    /**
     * Return our Twig functions
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('getAllScripts', [$this, 'getAllScripts']),
            
        ];
    }

    /**
     * Get script by site
     * @return string
     */
    public function getAllScripts()
    {
        $site = (new InjectorService())->getSiteIdFromHandle();
        return InjectorScriptsRecord::find()->where(['=', 'site', $site])->all();
    }
    
}
