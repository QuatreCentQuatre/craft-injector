<?php

namespace quatrecentquatre\injector\migrations;

use Craft;
use craft\db\Migration;

/**
 * m240819_153321_create_injector_table migration.
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
        return false;
    }
}
