<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%courseworks}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%students}}`
 */
class m200523_194928_create_courseworks_table extends Migration
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

        $this->createTable('{{%courseworks}}', [
            'id' => $this->primaryKey(),
            'subject' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'document' => $this->string(),
            'evaluation' => $this->string(),
            'stud_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `stud_id`
        $this->createIndex(
            '{{%idx-courseworks-stud_id}}',
            '{{%courseworks}}',
            'stud_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-courseworks-stud_id}}',
            '{{%courseworks}}',
            'stud_id',
            '{{%students}}',
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
        // drops foreign key for table `{{%students}}`
        $this->dropForeignKey(
            '{{%fk-courseworks-stud_id}}',
            '{{%courseworks}}'
        );

        // drops index for column `stud_id`
        $this->dropIndex(
            '{{%idx-courseworks-stud_id}}',
            '{{%courseworks}}'
        );

        $this->dropTable('{{%courseworks}}');
    }
}
