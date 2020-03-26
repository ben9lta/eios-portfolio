<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publ_indexing}}`.
 */
class m200326_201750_create_publ_indexing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publ_indexing}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%publ_indexing}}');
    }
}
