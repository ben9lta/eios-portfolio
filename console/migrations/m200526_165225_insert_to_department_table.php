<?php

use yii\db\Migration;

/**
 * Class m200526_165225_insert_to_department_table
 */
class m200526_165225_insert_to_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('univer', [
            'id'      => 1,
            'title'   => 'ГПА (филиал) ФГАОУ ВО "КФУ им. В.И. Вернадского" в г. Ялте',
            'address' => 'г. Ялта, ул. Севастопольская, 2'
        ]);

        $this->insert('institute', [
            'id'        => 1,
            'title'     => 'Институт экономики и управления',
            'address'   => 'г. Ялта, ул. Халтурина, 14',
            'univer_id' => 1
        ]);

        $this->insert('department', [
            'title'     => 'Кафедра менеджмента и туристского бизнеса',
            'address'   => 'г. Ялта, ул. Халтурина, д.14, каб.4, 12',
            'inst_id'   => 1
        ]);

        $this->insert('department', [
            'title'     => 'Кафедра математики, теории и методики обучения математике',
            'address'   => 'г. Ялта, ул. Севастопольска, 2-А, каб. 16',
            'inst_id'   => 1
        ]);

        $this->insert('department', [
            'title'     => 'Кафедра информатики и информационных технологий',
            'address'   => 'г. Ялта, ул. Халтурина, д. 14, каб 36',
            'inst_id'   => 1
        ]);

        $this->insert('department', [
            'title'     => 'Кафедра экономики и финансов',
            'address'   => 'г. Ялта, ул. Халтурина, д. 14, каб.15',
            'inst_id'   => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('department');
        $this->delete('institute');
        $this->delete('univer');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200526_165225_insert_to_department_table cannot be reverted.\n";

        return false;
    }
    */
}
