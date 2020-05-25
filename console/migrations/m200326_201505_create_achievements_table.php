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
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'type' => $this->string(),
            'status' => $this->string(),
            'date' => $this->dateTime()->notNull(),
            'result' => $this->string(),
            'document' => $this->string(),
            'stud_id' => $this->integer()->notNull(),
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

        $this->dropTable('{{%achievements}}');
    }
}
