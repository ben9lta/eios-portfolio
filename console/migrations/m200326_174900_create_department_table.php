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
        $this->createTable('{{%department}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string()->notNull(),
            'address'   => $this->string()->notNull(),
            'inst_id'   => $this->integer()->notNull(),
        ]);

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
