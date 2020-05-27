<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%students}}`
 * - `{{%events_status}}`
 * - `{{%events_type}}`
 * - `{{%user}}`
 */
class m200326_201121_create_events_table extends Migration
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

        $this->createTable('{{%events}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string()->notNull(),
            'date_start' => $this->dateTime()->defaultValue(null),
            'date_end'   => $this->dateTime()->defaultValue(null),
            'location'   => $this->string()->defaultValue(null),
            'document'   => $this->string()->defaultValue(null),
            'evaluation' => $this->tinyInteger()->defaultValue(null),
            'student_id' => $this->integer()->notNull(),
            'user_id'    => $this->integer()->defaultValue(null),
            'status_id'  => $this->integer()->defaultValue(null),
            'type_id'    => $this->integer()->defaultValue(null),
            'comment'    => $this->string()->defaultValue(null),
        ], $tableOptions);

        // creates index for column `student_id`
        $this->createIndex(
            '{{%idx-events-student_id}}',
            '{{%events}}',
            'student_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-events-student_id}}',
            '{{%events}}',
            'student_id',
            '{{%students}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-events-user_id}}',
            '{{%events}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-events-user_id}}',
            '{{%events}}',
            'user_id',
            '{{%students}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `status_id`
        $this->createIndex(
            '{{%idx-events-status_id}}',
            '{{%events}}',
            'status_id'
        );

        // add foreign key for table `{{%event_status}}`
        $this->addForeignKey(
            '{{%fk-events-status_id}}',
            '{{%events}}',
            'status_id',
            '{{%event_status}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            '{{%idx-events-type_id}}',
            '{{%events}}',
            'type_id'
        );

        // add foreign key for table `{{%event_type}}`
        $this->addForeignKey(
            '{{%fk-events-type_id}}',
            '{{%events}}',
            'type_id',
            '{{%event_type}}',
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
            '{{%fk-events-student_id}}',
            '{{%events}}'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            '{{%idx-events-student_id}}',
            '{{%events}}'
        );

        // drops foreign key for table `{{%events_status}}`
        $this->dropForeignKey(
            '{{%fk-events-status_id}}',
            '{{%events}}'
        );

        // drops index for column `status_id`
        $this->dropIndex(
            '{{%idx-events-status_id}}',
            '{{%events}}'
        );

        // drops foreign key for table `{{%events_type}}`
        $this->dropForeignKey(
            '{{%fk-events-type_id}}',
            '{{%events}}'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            '{{%idx-events-type_id}}',
            '{{%events}}'
        );

        $this->dropTable('{{%events}}');
    }
}
