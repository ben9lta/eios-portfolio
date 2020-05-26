<?php

use yii\db\Migration;

/**
 * Class m200526_191642_add_fk_to_group_table
 */
class m200526_191642_add_fk_to_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('group', 'form_id', $this->integer()->notNull());

        $this->createIndex(
            '{{%idx-group-form_id}}',
            '{{%group}}',
            'form_id'
        );

        $this->addForeignKey(
            '{{%fk-group-form_id}}',
            '{{%group}}',
            'form_id',
            '{{%edu_form}}',
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
            '{{%fk-group-form_id}}',
            '{{%group}}'
        );

        $this->dropIndex(
            '{{%idx-group-form_id}}',
            '{{%group}}'
        );

        $this->dropColumn('group', 'form_id');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200526_191642_add_fk_to_group_table cannot be reverted.\n";

        return false;
    }
    */
}
