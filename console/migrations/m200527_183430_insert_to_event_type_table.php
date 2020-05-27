<?php

use yii\db\Migration;

/**
 * Class m200527_183430_insert_to_event_type_table
 */
class m200527_183430_insert_to_event_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('event_type', ['id', 'title'], [
            [1, 'Конференция'],
            [2, 'Форум'],
            [3, 'Олимпиада']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('event_type');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_183430_insert_to_event_type_table cannot be reverted.\n";

        return false;
    }
    */
}
