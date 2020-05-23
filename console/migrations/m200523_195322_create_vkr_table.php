<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vkr}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%students}}`
 * - `{{%user}}`
 */
class m200523_195322_create_vkr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vkr}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'document' => $this->string(),
            'evaluation' => $this->string(),
            'stud_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `stud_id`
        $this->createIndex(
            '{{%idx-vkr-stud_id}}',
            '{{%vkr}}',
            'stud_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-vkr-stud_id}}',
            '{{%vkr}}',
            'stud_id',
            '{{%students}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-vkr-user_id}}',
            '{{%vkr}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-vkr-user_id}}',
            '{{%vkr}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%students}}`
        $this->dropForeignKey(
            '{{%fk-vkr-stud_id}}',
            '{{%vkr}}'
        );

        // drops index for column `stud_id`
        $this->dropIndex(
            '{{%idx-vkr-stud_id}}',
            '{{%vkr}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-vkr-user_id}}',
            '{{%vkr}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-vkr-user_id}}',
            '{{%vkr}}'
        );

        $this->dropTable('{{%vkr}}');
    }
}
