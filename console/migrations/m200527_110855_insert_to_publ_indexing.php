<?php

use yii\db\Migration;

/**
 * Class m200527_110855_insert_to_publ_indexing
 */
class m200527_110855_insert_to_publ_indexing extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('publ_indexing', ['id', 'title'], [
            [1, 'РИНЦ'],
            [2, 'Scopus'],
            [3, 'Web of Science'],
            [4, 'ВАК']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200527_110855_insert_to_publ_indexing cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_110855_insert_to_publ_indexing cannot be reverted.\n";

        return false;
    }
    */
}
