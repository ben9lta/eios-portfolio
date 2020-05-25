<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%direction}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%department}}`
 */
class m200326_175143_create_direction_table extends Migration
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

        $this->createTable('{{%direction}}', [
            'id'     => $this->primaryKey(),
            'title'  => $this->string()->notNull(),
            'code'   => $this->string(20)->notNull(),
            'dep_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `dep_id`
        $this->createIndex(
            '{{%idx-direction-dep_id}}',
            '{{%direction}}',
            'dep_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-direction-dep_id}}',
            '{{%direction}}',
            'dep_id',
            '{{%department}}',
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
        // drops foreign key for table `{{%department}}`
        $this->dropForeignKey(
            '{{%fk-direction-dep_id}}',
            '{{%direction}}'
        );

        // drops index for column `dep_id`
        $this->dropIndex(
            '{{%idx-direction-dep_id}}',
            '{{%direction}}'
        );

        $this->dropTable('{{%direction}}');
    }
}
