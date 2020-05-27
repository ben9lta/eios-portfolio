<?php

use yii\db\Migration;

/**
 * Class m200527_093412_insert_to_edu_level_table
 */
class m200527_093412_insert_to_edu_level_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('edu_level', ['id', 'title'], [
           [1, 'Бакалавриат'],
           [2, 'Магистратура'],
           [3, 'Аспирантура']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('edu_level');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_093412_insert_to_edu_level_table cannot be reverted.\n";

        return false;
    }
    */
}
