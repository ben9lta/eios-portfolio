<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%edu_form}}`.
 */
class m200526_191333_create_edu_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%edu_form}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%edu_form}}');
    }
}
