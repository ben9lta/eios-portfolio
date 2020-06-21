<?php

use yii\db\Migration;

/**
 * Class m200621_132358_add_hide_field_and_relation_with_auth_to_user
 */
class m200621_132358_add_hide_field_and_relation_with_auth_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'hidden', $this->tinyInteger(1)->notNull()->defaultValue(0)); //0 - виден всем
        $this->alterColumn('auth_assignment', 'user_id', $this->integer()->notNull());
        $this->createIndex(
            '{{%idx-auth_assignment-user_id2}}',
            '{{%auth_assignment}}',
            'user_id'
        );

        $this->addForeignKey(
            '{{%fk-auth_assignment-user_id2}}',
            '{{%auth_assignment}}',
            'user_id',
            '{{%user}}',
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
        $this->dropColumn('user', 'hidden');
        $this->alterColumn('auth_assignment', 'user_id', $this->string(64));
        $this->dropForeignKey('{{%fk-auth_assignment-user_id2}}','{{%auth_assignment}}');
        $this->dropIndex('{{%idx-auth_assignment-user_id}}','{{%auth_assignment}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200621_132358_add_hide_field_and_relation_with_auth_to_user cannot be reverted.\n";

        return false;
    }
    */
}
