<?php

use yii\db\Migration;

/**
 * Class m200527_183032_insert_to_event_status_table
 */
class m200527_183032_insert_to_event_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('event_status', ['id', 'title'], [
            [1, 'Внутривузовский'],
            [2, 'Всероссийский'],
            [3, 'Международный']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('event_status');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_183032_insert_to_event_status_table cannot be reverted.\n";

        return false;
    }
    */
}
