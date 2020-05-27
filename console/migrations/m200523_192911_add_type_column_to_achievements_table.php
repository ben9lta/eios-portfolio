<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%achievements}}`.
 */
class m200523_192911_add_type_column_to_achievements_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('achievements', 'type_id', $this->integer()->notNull());
        $this->createIndex(
            '{{%idx-achievements-type_id}}',
            '{{%achievements}}',
            'type_id'
        );

        // add foreign key for table `{{%students}}`
        $this->addForeignKey(
            '{{%fk-achievements-type_id}}',
            '{{%achievements}}',
            'type_id',
            '{{%activity_type}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-achievements-type_id}}','{{%achievements}}');
        $this->dropIndex('{{%idx-achievements-type_id}}', '{{%achievements}}');
        $this->dropColumn('achievements', 'type_id');

    }
}
