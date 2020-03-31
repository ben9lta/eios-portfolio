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
        $user = new \common\models\User();
        $user->username = 'admin';
        $user->setPassword(123456);
        $user->generateAuthKey();
        $user->email = Yii::$app->params['supportEmail'];
        $user->status = 10;
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
        $id = \common\models\User::findOne(['username' => 'admin'])->getId();
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