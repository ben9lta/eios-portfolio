<?php

use yii\db\Migration;

/**
 * Class m200326_163655_add_other_fields_to_user_table
 */
class m200326_163655_add_other_fields_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->string(11));
        $this->addColumn('user', 'gender', $this->smallInteger()->notNull()->defaultValue(0));// 0 - не определено, 1 - мужской, 2 - женский
        $this->addColumn('user', 'birthday', $this->date()->notNull());
        $this->addColumn('user', 'consent', $this->boolean()->notNull());
        $this->addColumn('user', 'photo', $this->string()->null());
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
        echo "m200326_163655_add_other_fields_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
