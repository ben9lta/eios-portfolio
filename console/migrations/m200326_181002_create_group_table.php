<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%direction}}`
 * - `{{%user}}`
 */
class m200326_181002_create_group_table extends Migration
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

        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'course' => $this->smallInteger()->notNull(),
            'dir_id' => $this->integer()->notNull(),
            'curator_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `dir_id`
        $this->createIndex(
            '{{%idx-group-dir_id}}',
            '{{%group}}',
            'dir_id'
        );

        // add foreign key for table `{{%direction}}`
        $this->addForeignKey(
            '{{%fk-group-dir_id}}',
            '{{%group}}',
            'dir_id',
            '{{%direction}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `curator_id`
        $this->createIndex(
            '{{%idx-group-curator_id}}',
            '{{%group}}',
            'curator_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-group-curator_id}}',
            '{{%group}}',
            'curator_id',
            '{{%user}}',
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
        // drops foreign key for table `{{%direction}}`
        $this->dropForeignKey(
            '{{%fk-group-dir_id}}',
            '{{%group}}'
        );

        // drops index for column `dir_id`
        $this->dropIndex(
            '{{%idx-group-dir_id}}',
            '{{%group}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-group-curator_id}}',
            '{{%group}}'
        );

        // drops index for column `curator_id`
        $this->dropIndex(
            '{{%idx-group-curator_id}}',
            '{{%group}}'
        );

        $this->dropTable('{{%group}}');
    }
}
