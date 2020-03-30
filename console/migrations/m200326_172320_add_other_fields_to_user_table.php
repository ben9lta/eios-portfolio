<?php

use yii\db\Migration;

/**
 * Class m200326_172320_add_other_fields_to_user_table
 */
class m200326_172320_add_other_fields_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->string(11));
        $this->addColumn('user', 'gender', $this->smallInteger()->defaultValue(0));
        $this->addColumn('user', 'birthday', $this->dateTime());
        $this->addColumn('user', 'consent', $this->boolean()); // Согласие на обработку персональных данных
        $this->addColumn('user', 'photo', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'gender');
        $this->dropColumn('user', 'birthday');
        $this->dropColumn('user', 'consent');
        $this->dropColumn('user', 'photo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200326_172320_add_other_fields_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
