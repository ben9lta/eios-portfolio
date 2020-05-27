<?php

use yii\db\Migration;

/**
 * Class m200527_094536_insert_to_edu_form_table
 */
class m200527_094536_insert_to_edu_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('edu_form', ['id', 'title'], [
           [1, 'Очная'],
           [2, 'Заочная']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('edu_form');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_094536_insert_to_edu_form_table cannot be reverted.\n";

        return false;
    }
    */
}
