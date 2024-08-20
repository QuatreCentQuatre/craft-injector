<?php
namespace quatrecentquatre\injector\controllers;

use Craft;
use craft\web\Controller;
use quatrecentquatre\injector\records\InjectorScriptsRecord;

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

        Craft::$app->db->createCommand()->truncateTable(InjectorScriptsRecord::tableName())->execute();

        foreach($scripts as $script) {
            $record = new InjectorScriptsRecord();
            $record->position = $script['position'];
            $record->script = $script['script'];
            $record->save();
        }

        $default = Craft::t('app', "All scripts were saved.");
        $this->setSuccessFlash($default);
        return;

    }

}