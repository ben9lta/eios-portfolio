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
        $this->batchInsert('group', ['id', 'title', 'course', 'dir_id', 'curator_id', 'form_id'], [
            [1, 'Я/ПИ-м-о-181', 2, 2, 2, 1],
            [2, 'Я/ПИ-м-о-191', 2, 2, 2, 1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('group', ['id' => 1]);
        $this->delete('group', ['id' => 2]);
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
