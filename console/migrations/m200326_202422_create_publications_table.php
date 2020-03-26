<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publications}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%publ_indexing}}`
 * - `{{%students}}`
 * - `{{%user}}`
 */
class m200326_202422_create_publications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publications}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'authors'     => $this->string()->notNull(),
            'document'    => $this->string()->notNull(),
            'date'        => $this->dateTime()->notNull(),
            'description' => $this->string(),
            'indexing_id' => $this->integer()->notNull(),
            'stud_id'     => $this->integer()->notNull(),
            'user_id'     => $this->integer()->notNull(),
        ]);

        // creates index for column `indexing_id`
        $this->createIndex(
            '{{%idx-publications-indexing_id}}',
            '{{%publications}}',
            'indexing_id'
        );

        // add foreign key for table `{{%publ_indexing}}`
        $this->addForeignKey(
            '{{%fk-publications-indexing_id}}',
            '{{%publications}}',
            'indexing_id',
            '{{%publ_indexing}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `stud_id`
        $this->createIndex(
            '{{%idx-publications-stud_id}}',
            '{{%publications}}',
            'stud_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-publications-stud_id}}',
            '{{%publications}}',
            'stud_id',
            '{{%students}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-publications-user_id}}',
            '{{%publications}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-publications-user_id}}',
            '{{%publications}}',
            'user_id',
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
        // drops foreign key for table `{{%publ_indexing}}`
        $this->dropForeignKey(
            '{{%fk-publications-indexing_id}}',
            '{{%publications}}'
        );

        // drops index for column `indexing_id`
        $this->dropIndex(
            '{{%idx-publications-indexing_id}}',
            '{{%publications}}'
        );

        // drops foreign key for table `{{%students}}`
        $this->dropForeignKey(
            '{{%fk-publications-stud_id}}',
            '{{%publications}}'
        );

        // drops index for column `stud_id`
        $this->dropIndex(
            '{{%idx-publications-stud_id}}',
            '{{%publications}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-publications-user_id}}',
            '{{%publications}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-publications-user_id}}',
            '{{%publications}}'
        );

        $this->dropTable('{{%publications}}');
    }
}
