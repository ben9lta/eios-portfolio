<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%students}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%group}}`
 */
class m200326_193539_create_students_table extends Migration
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

        $this->createTable('{{%students}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-students-user_id}}',
            '{{%students}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-students-user_id}}',
            '{{%students}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            '{{%idx-students-group_id}}',
            '{{%students}}',
            'group_id'
        );

        // add foreign key for table `{{%group}}`
        $this->addForeignKey(
            '{{%fk-students-group_id}}',
            '{{%students}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-students-user_id}}',
            '{{%students}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-students-user_id}}',
            '{{%students}}'
        );

        // drops foreign key for table `{{%group}}`
        $this->dropForeignKey(
            '{{%fk-students-group_id}}',
            '{{%students}}'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            '{{%idx-students-group_id}}',
            '{{%students}}'
        );

        $this->dropTable('{{%students}}');
    }
}
