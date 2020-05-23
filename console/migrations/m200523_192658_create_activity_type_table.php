<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity_type}}`.
 */
class m200523_192658_create_activity_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%activity_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%activity_type}}');
    }
}
