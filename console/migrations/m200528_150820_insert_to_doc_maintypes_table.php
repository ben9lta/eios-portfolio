<?php

use yii\db\Migration;

/**
 * Class m200528_150820_insert_to_doc_maintypes_table
 */
class m200528_150820_insert_to_doc_maintypes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->batchInsert('doc_maintypes', ['id', 'title'], [
          [1, 'Учебная документация'],
          [2, 'Электронное учебное издание'],
          [3, 'Электронный образовательный ресурс']
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('doc_maintypes');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200528_150820_insert_to_doc_maintypes_table cannot be reverted.\n";

        return false;
    }
    */
}
