<?php

use yii\db\Migration;

/**
 * Class m200531_144227_insert_100_users_to_user_table
 */
class m200531_144227_insert_100_users_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Faker\Factory::create('Ru_RU');
        for($i = 0; $i < 100; $i++)
        {
            $user = new \common\models\User();
            $user->username = $faker->userName;
            $user->id = 5000 + $i;
            $user->setPassword(123456);
            $user->generateAuthKey();
            $user->email = $faker->email;
            $user->status = 10;
            $user->created_at = time();
            $user->updated_at = $user->created_at;
            $user->first_name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->consent = 1;
            $user->generateEmailVerificationToken();
            $user->save();
//            if($user->save()) {
//                $auth = Yii::$app->authManager;
//                $role = $auth->getRole('Пользователь');
//                $auth->assign($role, $user->getId());
//                $user->save();
//            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        for($i = 0; $i < 100; $i++) {
            $id = $i + 5000;
            $this->delete('user', ['id' => $id]);
            //$this->delete('auth_assignment', ['user_id' => $id]);
        }
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200531_144227_insert_100_users_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
