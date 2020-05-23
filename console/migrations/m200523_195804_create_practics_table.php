<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%practics}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%students}}`
 */
class m200523_195804_create_practics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%practics}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'place' => $this->string(),
            'date_start' => $this->datetime(),
            'date_end' => $this->datetime(),
            'document' => $this->string(),
            'diary' => $this->string(),
            'characteristic' => $this->string(),
            'evaluation' => $this->string(),
            'stud_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `stud_id`
        $this->createIndex(
            '{{%idx-practics-stud_id}}',
            '{{%practics}}',
            'stud_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-practics-stud_id}}',
            '{{%practics}}',
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
            '{{%fk-practics-stud_id}}',
            '{{%practics}}'
        );

        // drops index for column `stud_id`
        $this->dropIndex(
            '{{%idx-practics-stud_id}}',
            '{{%practics}}'
        );

        $this->dropTable('{{%practics}}');
    }
}
