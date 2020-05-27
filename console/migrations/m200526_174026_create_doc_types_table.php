<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%doc_types}}`.
 */
class m200526_174026_create_doc_types_table extends Migration
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
        $this->createTable('{{%doc_types}}', [
            'id'               => $this->primaryKey(),
            'title'            => $this->string()->notNull(),
            'doc_maintypes_id' => $this->integer()->notNull(),
            'comment'          => $this->string()->defaultValue(null)
        ],$tableOptions);

        $this->createIndex(
          '{{%idx-doc_types-doc_maintypes_id}}',
          '{{%doc_types}}',
          'doc_maintypes_id'
        );
        $this->addForeignKey(
            '{{%fk-doc_types-doc_maintypes_id}}',
            '{{%doc_types}}',
            'doc_maintypes_id',
            '{{%doc_maintypes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-doc_types-doc_maintypes_id}}',
            '{{%doc_types}}'
        );
        $this->dropIndex(
            '{{%idx-doc_types-doc_maintypes_id}}',
            '{{%doc_types}}'
        );
        $this->dropTable('{{%doc_types}}');
    }
}
