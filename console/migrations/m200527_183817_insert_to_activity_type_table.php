<?php

use yii\db\Migration;

/**
 * Class m200527_183817_insert_to_activity_type_table
 */
class m200527_183817_insert_to_activity_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('activity_type', ['id', 'title'], [
            [1, 'Спортивная'],
            [2, 'Культурно-творческая'],
            [3, 'Общественная'],
            [4, 'Научно-исследовательская'],
            [5, 'Другое']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity_type');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_183817_insert_to_activity_type_table cannot be reverted.\n";

        return false;
    }
    */
}
