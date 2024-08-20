<?php

namespace quatrecentquatre\injector;

use Craft;
use craft\base\Plugin;
use quatrecentquatre\injector\services\InjectorService;
use quatrecentquatre\injector\twigextensions\InjectorTwigExtension;

/**
 * Injector plugin
 *
 * @author QuatreCentQuatre <production@quatrecentquatre.com>
 * @copyright QuatreCentQuatre
 * @license https://craftcms.github.io/license/ Craft License
 */
class Injector extends Plugin
{
    public string $schemaVersion = '1.0.1';
    public bool $hasCpSection = true;

    public function init(): void
    {
        parent::init();
        
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'quatrecentquatre\injector\console\controllers';
        } else {
            Craft::$app->view->registerTwigExtension(new InjectorTwigExtension());
        }

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
        });
    }

    private function attachEventHandlers(): void
    {
        (new InjectorService())->registerScripts();   
    }

    public function getCpNavItem(): ?array
    {
        $item = parent::getCpNavItem();
        $item['icon'] = '@quatrecentquatre/injector/icon.svg';
        
        return $item;
    }

}