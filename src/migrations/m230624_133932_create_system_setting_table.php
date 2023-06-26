<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%system_setting}}`.
 */
class m230624_133932_create_system_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%system_setting}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
            'value' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%system_setting}}');
    }
}
