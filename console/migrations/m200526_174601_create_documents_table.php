<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents}}`.
 */
class m200526_174601_create_documents_table extends Migration
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
      $this->createTable('{{%documents}}', [
          'id' => $this->primaryKey(),
          'user_add_id' =>$this->integer()->notNull(),
          'user_approve_id' =>$this->integer()->defaultValue(null),
          'doc_type_id' =>$this->integer()->notNull(),
          'title' =>$this->string()->notNull(),
          'document' =>$this->string()->notNull(),
          'status' =>$this->smallInteger()->defaultValue(null),
          'comment' =>$this->string()
      ], $tableOptions);

      //creates indexes for foreign keys
      $this->createIndex(
        '{{%idx-documents-user_add_id}}',
        '{{%documents}}',
        'user_add_id'
      );
      $this->createIndex(
        '{{%idx-documents-user_approve_id}}',
        '{{%documents}}',
        'user_approve_id'
      );
      $this->createIndex(
        '{{%idx-documents-doc_type_id}}',
        '{{%documents}}',
        'doc_type_id'
      );

      //creates foreign keys
      $this->addForeignKey(
          '{{%fk-documents-user_add_id}}',
          '{{%documents}}',
          'user_add_id',
          '{{%user}}',
          'id',
          'CASCADE',
          'CASCADE'
      );
      $this->addForeignKey(
          '{{%fk-documents-user_approve_id}}',
          '{{%documents}}',
          'user_approve_id',
          '{{%user}}',
          'id',
          'CASCADE',
          'CASCADE'
      );
      $this->addForeignKey(
          '{{%fk-documents-doc_type_id}}',
          '{{%documents}}',
          'doc_type_id',
          '{{%doc_types}}',
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
            '{{%fk-documents-user_add_id}}',
            '{{%documents}}'
        );
        $this->dropForeignKey(
            '{{%fk-documents-user_approve_id}}',
            '{{%documents}}'
        );
        $this->dropForeignKey(
            '{{%fk-documents-doc_type_id}}',
            '{{%documents}}'
        );

        $this->dropIndex(
            '{{%idx-documents-user_add_id}}',
            '{{%documents}}'
        );
        $this->dropIndex(
            '{{%idx-documents-user_approve_id}}',
            '{{%documents}}'
        );
        $this->dropIndex(
            '{{%idx-documents-doc_type_id}}',
            '{{%documents}}'
        );

        $this->dropTable('{{%documents}}');
    }
}
