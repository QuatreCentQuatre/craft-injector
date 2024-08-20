<?php

namespace quatrecentquatre\injector\services;

use Craft;
use craft\base\Component;
use quatrecentquatre\injector\Injector;
use craft\web\View;
use quatrecentquatre\injector\records\InjectorScriptsRecord;

class InjectorService extends Component
{

    public $settings;
    
    /**
     * @inheritdoc
     */
    public function init() :void
    {
        parent::init();
    }

    public function registerScripts() 
    {
        $request = Craft::$app->getRequest();

        if (!$request->getIsCpRequest() && !$request->getIsConsoleRequest()) {
            $scripts = InjectorScriptsRecord::find()->all();
            foreach ($scripts as $script) {
                
                $position = match($script['position']) {
                    'head' => View::POS_HEAD,
                    'body_top' => View::POS_BEGIN,
                    'body_bottom' => View::POS_END,
                    default => View::POS_END,
                };

                $view = Craft::$app->getView();
                $view->registerHtml($script['script'], $position);

            }
        }
    }

}
