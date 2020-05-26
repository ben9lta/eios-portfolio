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
        $this->createTable('{{%doc_types}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'doc_maintypes_id' => $this->integer()->notNull(),
            'comments' => $this->string()->defaultValue(null)
        ]);

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
