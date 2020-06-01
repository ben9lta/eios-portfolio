<?php

use yii\db\Migration;

/**
 * Class m200417_195917_insert_users_user_table_
 */
class m200417_195917_insert_users_user_table_ extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     * @throws Exception
     */
    public function safeUp()
    {
        $user = new \common\models\User();
        $user->id = 2;
        $user->username = 'user1';
        $user->setPassword(123456);
        $user->generateAuthKey();
        $user->email = 'user1@mail.ru';
        $user->status = 10;
        $user->created_at = time();
        $user->updated_at = $user->created_at;
        $user->first_name = 'Александр';
        $user->last_name = 'Кочерыжкин';
        $user->middle_name = 'Сергеевич';
        $user->phone = '+7 (978) 000-00-00';
        $user->consent = 1;
        $user->generateEmailVerificationToken();
        if($user->save()) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('Преподаватель');
            $auth->assign($role, $user->getId());
            $user->save();
        }

        $user = new \common\models\User();
        $user->id = 3;
        $user->username = 'user2';
        $user->setPassword(123456);
        $user->generateAuthKey();
        $user->email = 'user2@mail.ru';
        $user->status = 10;
        $user->created_at = time();
        $user->updated_at = $user->created_at;
        $user->consent = 0;
        $user->generateEmailVerificationToken();
        if($user->save()) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('Преподаватель');
            $auth->assign($role, $user->getId());
            $user->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $id = 2;
        $this->delete('user', ['id' => $id]);
        $this->delete('auth_assignment', ['user_id' => $id]);

        $id = 3;
        $this->delete('user', ['id' => $id]);
        $this->delete('auth_assignment', ['user_id' => $id]);
        return true;
//        echo "m200417_195917_insert_users_user_table_ cannot be reverted.\n";
//
//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200417_195917_insert_users_user_table_ cannot be reverted.\n";

        return false;
    }
    */
}
