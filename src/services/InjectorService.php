<?php

namespace quatrecentquatre\injector\services;

use Craft;
use craft\base\Component;
use yii\web\NotFoundHttpException;
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

            $scripts = InjectorScriptsRecord::find()->where(['=', 'site', Craft::$app->getSites()->currentSite->id])->all();
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

    /**
     * Return a siteId from a siteHandle
     *
     * @param string|null $siteHandle
     *
     * @return int|null
     * @throws NotFoundHttpException
     */
    public function getSiteIdFromHandle()
    {
        $siteHandle = Craft::$app->getRequest()->getParam('site', 'default');

        // Get the site to edit
        if ($siteHandle !== null) {
            $site = Craft::$app->getSites()->getSiteByHandle($siteHandle);
            if (!$site) {
                throw new NotFoundHttpException('Invalid site handle: ' . $siteHandle);
            }
            $siteId = $site->id;
        } else {
            $siteId = Craft::$app->getSites()->currentSite->id;
        }

        return $siteId;
    }

}
