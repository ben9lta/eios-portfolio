<?php

namespace backend\models\users;

use common\models\Group;
use common\models\Publications;
use common\models\Students;
use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property string|null $phone
 * @property int $gender
 * @property string|null $birthday
 * @property int|null $consent
 * @property string|null $photo
 *
 * @property Group[] $groups
 * @property Publications[] $publications
 * @property Students[] $students
 */
class Users extends ActiveRecord
{

    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function fields()
    {
        return array_merge(parent::fields(), ['gender' => null]);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'consent'], 'required'],
            [['status', 'created_at', 'updated_at', 'gender', 'consent'], 'integer'],
            [['birthday'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'photo'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 20],
            [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/i'],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['gender'], 'default', 'value' => null],
            [['birthday'], 'datetime', 'format' => 'php:Y-m-d'],
            [['photo', 'imageFile'], 'image',
                'extensions' => ['jpg', 'jpeg', 'png'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 2000 * 1024, // 2 МБ = 2000 * 1024 байта = 2 048 000‬ байт
                'tooBig' => 'Лимит 2Мб'
            ],
            [['photo'], 'default', 'value' => null]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'username' => 'Логин',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Пароль',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'verification_token' => 'Verification Token',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Телефон',
            'gender' => 'Пол',
            'birthday' => 'День рождение',
            'consent' => 'Согласие',
            'photo' => 'Фото',
        ];
    }

    public function getGender()
    {
        return $this->gender > 0 ? $this->gender === 1 ? 'Мужской' : 'Женский' : null;
    }

    public function getStatus()
    {
        if($this->status === 9)
            return 'Не подтвержденный';
        if($this->status === 10)
            return 'Подтвержден';
        if($this->status === 0)
            return '-';
    }

    public function getBirthday()
    {
        return $this->birthday ? Yii::$app->formatter->asDate(strtotime($this->birthday),'dd.MM.Y') : null;
    }

    public function getConsent()
    {
        return $this->consent === 1 ? 'Подтверждено' : null;
    }

    public function uploadImage($image, $attr)
    {
        if ($this->validate($attr)) {

            if(empty($image))
                return false;

            $destination = 'users/' . $this->id . '/uploads/photo/';
            $path = Yii::getAlias('@storage/' . $destination);
            $filename = $this->randomFileName($image);

            if($this->photo)
                unlink(Yii::getAlias('@storage/' . $this->photo));

            if (FileHelper::createDirectory($path, $mode = 0775, $recursive = true)) {
                $image->saveAs($path . $filename);
                $this->photo = $destination . $filename;
            }

            return true;
        } else {
            return false;
        }
    }

    public function randomFileName($file)
    {
        return uniqid() . '.' . $file->extension; //QW52ASDx.jpg
    }

    public static function getFileUrl($file)
    {
        $url = Url::base(true);
        $position = strpos($url, '//') + 2;

        $storageUrl = substr($url, 0, $position) . 'storage.' . substr($url, $position);

        return $storageUrl . '/'. $file;
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        $photo = UploadedFile::getInstance($this, 'imageFile');
        $this->uploadImage($photo, 'imageFile');
        $this->birthday = Yii::$app->formatter->asDate(strtotime($this->birthday), "php:Y-m-d");
        return parent::save($runValidation, $attributeNames);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['curator_id' => 'id']);
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publications::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['user_id' => 'id']);
    }
}
