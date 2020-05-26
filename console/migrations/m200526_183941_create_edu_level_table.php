<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%edu_level}}`.
 */
class m200526_183941_create_edu_level_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%edu_level}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%edu_level}}');
    }
}
