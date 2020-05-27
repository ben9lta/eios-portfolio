<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%doc_maintypes}}`.
 */
class m200526_172325_create_doc_maintypes_table extends Migration
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
        $this->createTable('{{%doc_maintypes}}', [
            'id'      => $this->primaryKey(),
            'title'   => $this->string()->notNull(),
            'comment' => $this->string()->defaultValue(null),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%doc_maintypes}}');
    }
}
