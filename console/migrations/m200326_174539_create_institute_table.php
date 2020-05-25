<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%institute}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%univer}}`
 */
class m200326_174539_create_institute_table extends Migration
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

        $this->createTable('{{%institute}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string()->notNull(),
            'address'   => $this->string()->notNull(),
            'univer_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `univer_id`
        $this->createIndex(
            '{{%idx-institute-univer_id}}',
            '{{%institute}}',
            'univer_id'
        );

        // add foreign key for table `{{%univer}}`
        $this->addForeignKey(
            '{{%fk-institute-univer_id}}',
            '{{%institute}}',
            'univer_id',
            '{{%univer}}',
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
        // drops foreign key for table `{{%univer}}`
        $this->dropForeignKey(
            '{{%fk-institute-univer_id}}',
            '{{%institute}}'
        );

        // drops index for column `univer_id`
        $this->dropIndex(
            '{{%idx-institute-univer_id}}',
            '{{%institute}}'
        );

        $this->dropTable('{{%institute}}');
    }
}
