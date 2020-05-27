<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shedule}}`.
 */
class m200525_174505_create_shedule_table extends Migration
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
        $this->createTable('{{%shedule}}', [
            'id'           => $this->primaryKey(),
          	'user_add'     => $this->integer()->notNull(),
          	'user_approve' => $this->integer()->notNull(),
          	'group_id'     => $this->integer()->notNull(),
          	'document'     => $this->string()->notNull(),
          	'comment'     => $this->string()->defaultValue(null)
        ], $tableOptions);

        $this->createIndex(
            '{{%idx-shedule-user_add}}',
            '{{%shedule}}',
            'user_add'
        );
        $this->createIndex(
            '{{%idx-shedule-user_approve}}',
            '{{%shedule}}',
            'user_approve'
        );
        $this->createIndex(
            '{{%idx-shedule-group_id}}',
            '{{%shedule}}',
            'group_id'
        );

        $this->addForeignKey(
            '{{%fk-shedule-user_add}}',
            '{{%shedule}}',
            'user_add',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%fk-shedule-user_approve}}',
            '{{%shedule}}',
            'user_approve',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%fk-shedule-group_id}}',
            '{{%shedule}}',
            'group_id',
            '{{%group}}',
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
      //deleting FK
      $this->dropForeignKey(
          '{{%fk-shedule-user_add}}',
          '{{%shedule}}'
      );
      $this->dropForeignKey(
          '{{%fk-shedule-user_approve}}',
          '{{%shedule}}'
      );
      $this->dropForeignKey(
          '{{%fk-shedule-group_id}}',
          '{{%shedule}}'
      );

      //deleting indexes
      $this->dropIndex(
          '{{%idx-shedule-group_id}}',
          '{{%shedule}}'
      );

      $this->dropIndex(
          '{{%idx-shedule-user_add}}',
          '{{%shedule}}'
      );
      $this->dropIndex(
          '{{%idx-shedule-user_approve}}',
          '{{%shedule}}'
      );

      //deleting table
      $this->dropTable('{{%shedule}}');
    }
}
