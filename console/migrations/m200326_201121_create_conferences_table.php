<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conferences}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%students}}`
 * - `{{%conf_status}}`
 * - `{{%conf_type}}`
 */
class m200326_201121_create_conferences_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conferences}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string()->notNull(),
            'date_start' => $this->dateTime()->notNull(),
            'date_end'   => $this->dateTime()->notNull(),
            'location'   => $this->string(),
            'document'   => $this->string(),
            'program'    => $this->string(),
            'comments'   => $this->text(),
            'student_id' => $this->integer()->notNull(),
            'status_id'  => $this->integer()->notNull(),
            'type_id'    => $this->integer()->notNull(),
        ]);

        // creates index for column `student_id`
        $this->createIndex(
            '{{%idx-conferences-student_id}}',
            '{{%conferences}}',
            'student_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-conferences-student_id}}',
            '{{%conferences}}',
            'student_id',
            '{{%students}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `status_id`
        $this->createIndex(
            '{{%idx-conferences-status_id}}',
            '{{%conferences}}',
            'status_id'
        );

        // add foreign key for table `{{%conf_status}}`
        $this->addForeignKey(
            '{{%fk-conferences-status_id}}',
            '{{%conferences}}',
            'status_id',
            '{{%conf_status}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            '{{%idx-conferences-type_id}}',
            '{{%conferences}}',
            'type_id'
        );

        // add foreign key for table `{{%conf_type}}`
        $this->addForeignKey(
            '{{%fk-conferences-type_id}}',
            '{{%conferences}}',
            'type_id',
            '{{%conf_type}}',
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
            '{{%fk-conferences-student_id}}',
            '{{%conferences}}'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            '{{%idx-conferences-student_id}}',
            '{{%conferences}}'
        );

        // drops foreign key for table `{{%conf_status}}`
        $this->dropForeignKey(
            '{{%fk-conferences-status_id}}',
            '{{%conferences}}'
        );

        // drops index for column `status_id`
        $this->dropIndex(
            '{{%idx-conferences-status_id}}',
            '{{%conferences}}'
        );

        // drops foreign key for table `{{%conf_type}}`
        $this->dropForeignKey(
            '{{%fk-conferences-type_id}}',
            '{{%conferences}}'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            '{{%idx-conferences-type_id}}',
            '{{%conferences}}'
        );

        $this->dropTable('{{%conferences}}');
    }
}
