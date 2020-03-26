<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conf_type}}`.
 */
class m200326_194008_create_conf_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conf_type}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%conf_type}}');
    }
}
