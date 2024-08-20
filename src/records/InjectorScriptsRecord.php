<?php

namespace quatrecentquatre\injector\records;

use craft\db\ActiveRecord;

/**
 * @property int $id
 * @property string $position
 * @property string $script
 * @property int $site
 */
class InjectorScriptsRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%injector_scripts}}';
    }
}
