<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conf_status}}`.
 */
class m200326_193858_create_conf_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conf_status}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%conf_status}}');
    }
}
