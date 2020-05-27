<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%achievements}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%students}}`
 */
class m200326_201505_create_achievements_table extends Migration
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

        $this->createTable('{{%achievements}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string()->notNull(),
            'date'      => $this->dateTime()->notNull(),
            'result'    => $this->string()->defaultValue(null),
            'document'  => $this->string()->defaultValue(null),
            'stud_id'   => $this->integer()->notNull(),
            'status_id' => $this->integer()->defaultValue(null),
            'comment'   => $this->string()->defaultValue(null)
        ], $tableOptions);

        // creates index for column `stud_id`
        $this->createIndex(
            '{{%idx-achievements-stud_id}}',
            '{{%achievements}}',
            'stud_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-achievements-stud_id}}',
            '{{%achievements}}',
            'stud_id',
            '{{%students}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `status_id`
        $this->createIndex(
            '{{%idx-achievements-status_id}}',
            '{{%achievements}}',
            'status_id'
        );

        // add foreign key for table `{{%event_status}}`
        $this->addForeignKey(
            '{{%fk-achievements-status_id}}',
            '{{%achievements}}',
            'status_id',
            '{{%event_status}}',
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
            '{{%fk-achievements-stud_id}}',
            '{{%achievements}}'
        );

        // drops index for column `stud_id`
        $this->dropIndex(
            '{{%idx-achievements-stud_id}}',
            '{{%achievements}}'
        );

        $this->dropForeignKey(
            '{{%fk-achievements-status_id}}',
            '{{%achievements}}'
        );

        $this->dropIndex(
            '{{%idx-achievements-status_id}}',
            '{{%achievements}}'
        );

        $this->dropTable('{{%achievements}}');
    }
}
