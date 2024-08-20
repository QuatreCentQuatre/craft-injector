<?php

namespace quatrecentquatre\injector\twigextensions;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;
use quatrecentquatre\injector\records\InjectorScriptsRecord;

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
     * Get key for Craft template caching.
     *
     * @param string $prefix
     * @param bool $paginate
     * @return string
     */
    public function getAllScripts()
    {
        return InjectorScriptsRecord::find()->all();
    }
    
}
