<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%univer}}`.
 */
class m200326_173021_create_univer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%univer}}', [
            'id'      => $this->primaryKey(),
            'title'   => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%univer}}');
    }
}
