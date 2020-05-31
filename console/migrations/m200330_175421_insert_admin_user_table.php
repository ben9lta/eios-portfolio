<?php

use yii\db\Migration;

/**
 * Class m200330_175421_insert_admin_user_table
 */
class m200330_175421_insert_admin_user_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        // добавляем роль "Администратор"
        $admin = $auth->createRole('Администратор');
        $auth->add($admin);

        // добавляем роль "Преподаватель"
        $professor = $auth->createRole("Преподаватель");
        $auth->add($professor);

        // добавляем роль "Студент"
        $student = $auth->createRole("Студент");
        $auth->add($student);

        // добавляем роль "Пользователь"
        $simple = $auth->createRole("Пользователь");
        $auth->add($simple);

        $user = new \common\models\User();
        $user->id = 1;
        $user->username = 'admin';
        $user->setPassword(123456);
        $user->generateAuthKey();
        $user->email = Yii::$app->params['supportEmail'];
        $user->created_at = time();
        $user->updated_at = $user->created_at;
        $user->status = 10;
        $user->consent = 1;
        $user->generateEmailVerificationToken();
        if($user->save()) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('Администратор');
            $auth->assign($role, $user->getId());
            return $user->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $id = 1;
        $this->delete('user', ['id' => $id]);
        $this->delete('auth_assignment', ['user_id' => $id]);
        return true;
//        echo "m200330_175421_insert_admin_user_table cannot be reverted.\n";
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
        echo "m200330_175421_insert_admin_user_table cannot be reverted.\n";

        return false;
    }
    */
}
