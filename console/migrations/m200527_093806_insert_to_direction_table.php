<?php

use yii\db\Migration;

/**
 * Class m200527_093806_insert_to_direction_table
 */
class m200527_093806_insert_to_direction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('direction', ['id', 'title', 'code', 'dep_id', 'level_id'], [
           [1, 'Прикладная информатика в менеджменте', '09.03.03', 3, 1],
           [2, 'Информационные системы и технологии корпоративного управления', '09.04.03', 3, 2],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('direction');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_093806_insert_to_direction_table cannot be reverted.\n";

        return false;
    }
    */
}
