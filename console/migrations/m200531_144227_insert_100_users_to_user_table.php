<?php

use yii\db\Migration;

/**
 * Class m200531_144227_insert_100_users_to_user_table
 */
class m200531_144227_insert_100_users_to_user_table extends Migration
{
    function translit($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $eng = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
        return str_replace($rus, $eng, $str);
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Faker\Factory::create('ru_RU');
        for($i = 0; $i < 100; $i++)
        {
            $user = new \common\models\User();
            $name[1] = $faker->lastName;
            if(rand(0, 1) === 0) {
                $name[0] = $faker->firstName('male');
                $name[1] = substr($name[1], -1) == 'a' ? substr($name[1],0,-1) : $name[1];
                $user->gender = 0;
            }
            else
            {
                $name[0] = $faker->firstName('female');
                $name[1] = substr($name[1], -1) == 'a' ? $name[1] : $name[1].'а';
                $user->gender = 1;
            }
            $mail = $faker->freeEmail;
            $username = $this->translit($name[0]) . '.' . $this->translit($name[1]);
            $mail = $username.substr($mail, strpos($mail, '@'));
            $user->username = $username;
            $user->id = 5000 + $i;
            $user->setPassword(123456);
            $user->generateAuthKey();
            $user->email = $mail;
            $user->status = 10;
            $user->created_at = time();
            $user->updated_at = $user->created_at;
            $user->first_name = $name[0];
            $user->last_name = $name[1];
            $user->consent = 1;
            $user->generateEmailVerificationToken();
            $user->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        for($i = 0; $i < 100; $i++) {
            $id = $i + 5000;
            $this->delete('user', 'id >= 5000 and id < 5100');
//            $this->delete('user', ['id' => $id]);
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
