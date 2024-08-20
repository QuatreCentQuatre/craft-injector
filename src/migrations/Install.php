<?php

namespace quatrecentquatre\injector\migrations;

use Craft;
use craft\db\Migration;

/**
 * Install migration.
 */
class Install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Place migration code here...
        $this->createTable('{{%injector_scripts}}', [
            'id'            => $this->primaryKey(),
            'dateCreated'   => $this->dateTime(),
            'dateUpdated'   => $this->dateTime(),
            'position'      => $this->string()->defaultValue('head'),
            'site'          => $this->integer(),
            'script'        => $this->text(),
            'uid'           => $this->string(),
        ]);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTable('{{%injector_scripts}}');
        return true;
    }
}
