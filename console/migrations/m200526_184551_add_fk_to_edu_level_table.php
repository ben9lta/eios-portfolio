<?php

use yii\db\Migration;

/**
 * Class m200526_184551_add_fk_to_edu_level_table
 */
class m200526_184551_add_fk_to_edu_level_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('direction', 'level_id', $this->integer()->notNull());

        $this->createIndex(
            '{{%idx-direction-level_id}}',
            '{{%direction}}',
            'level_id'
        );

        $this->addForeignKey(
            '{{%fk-direction-level_id}}',
            '{{%direction}}',
            'level_id',
            '{{%edu_level}}',
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
        $this->dropForeignKey(
            '{{%fk-direction-level_id}}',
            '{{%direction}}'
        );

        $this->dropIndex(
            '{{%idx-direction-level_id}}',
            '{{%direction}}'
        );

        $this->dropColumn('direction', 'level_id');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200526_184551_add_fk_to_edu_level_table cannot be reverted.\n";

        return false;
    }
    */
}
