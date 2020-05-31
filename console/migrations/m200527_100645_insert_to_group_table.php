<?php

use yii\db\Migration;

/**
 * Class m200527_100645_insert_to_group_table
 */
class m200527_100645_insert_to_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('group', [
            'id'         => 1,
            'title'      => 'Я/ПИ-м-о-181',
            'course'     => 2,
            'dir_id'     => 2,
            'curator_id' => 2,
            'form_id'    => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('group', ['id' => 1]);
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_100645_insert_to_group_table cannot be reverted.\n";

        return false;
    }
    */
}
