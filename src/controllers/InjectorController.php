<?php
namespace quatrecentquatre\injector\controllers;

use Craft;
use craft\web\Controller;
use quatrecentquatre\injector\records\InjectorScriptsRecord;
use quatrecentquatre\injector\services\InjectorService;

class InjectorController extends Controller
{
    /**
     * @inheritdoc
     */
    protected array|bool|int $allowAnonymous = [];
    // Public Methods
    // =========================================================================

    public function actionSave()
    {
        $this->requirePermission('accessplugin-injector');
        $request = Craft::$app->getRequest();
        $scripts = $request->getParam('scripts');

        $site = (new InjectorService())->getSiteIdFromHandle();
        InjectorScriptsRecord::deleteAll(['=', 'site', $site]);

        foreach($scripts as $script) {
            $record = new InjectorScriptsRecord();
            $record->position = $script['position'];
            $record->script = $script['script'];
            $record->site = $site;
            $record->save();
        }

        $default = Craft::t('app', "All scripts were saved.");
        $this->setSuccessFlash($default);
        return;

    }

}