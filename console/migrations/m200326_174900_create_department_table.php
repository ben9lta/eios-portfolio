<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%department}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%institute}}`
 */
class m200326_174900_create_department_table extends Migration
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

        $this->createTable('{{%department}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string()->notNull(),
            'address'   => $this->string()->notNull(),
            'inst_id'   => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `inst_id`
        $this->createIndex(
            '{{%idx-department-inst_id}}',
            '{{%department}}',
            'inst_id'
        );

        // add foreign key for table `{{%institute}}`
        $this->addForeignKey(
            '{{%fk-department-inst_id}}',
            '{{%department}}',
            'inst_id',
            '{{%institute}}',
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
        // drops foreign key for table `{{%institute}}`
        $this->dropForeignKey(
            '{{%fk-department-inst_id}}',
            '{{%department}}'
        );

        // drops index for column `inst_id`
        $this->dropIndex(
            '{{%idx-department-inst_id}}',
            '{{%department}}'
        );

        $this->dropTable('{{%department}}');
    }
}
