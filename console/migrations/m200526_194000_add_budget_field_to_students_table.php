<?php

use yii\db\Migration;

/**
 * Class m200526_194000_add_budget_field_to_students_table
 */
class m200526_194000_add_budget_field_to_students_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('students', 'budget', $this->tinyInteger(1)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('students', 'budget');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200526_194000_add_budget_field_to_students_table cannot be reverted.\n";

        return false;
    }
    */
}
