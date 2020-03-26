<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email'                => $this->string()->notNull()->unique(),
            'status'               => $this->smallInteger()->notNull()->defaultValue(0), // Статус активности аккаунта 0 - не активен, 9 - ждет подтверждения, 10 - подтвержден
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
            'phone'                => $this->string(11),
            'gender'               => $this->smallInteger()->notNull()->defaultValue(0), // 0 - не определено, 1 - мужской, 2 - женский
            'birthday'             => $this->date()->notNull(),
            'consent'              => $this->boolean()->notNull(), // Согласие на обработку данных
            'photo'                => $this->string()->null(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
