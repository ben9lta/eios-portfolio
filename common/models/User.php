<?php
namespace common\models;

use frontend\models\SignupForm;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use common\models\Group;
use common\models\Publications;
use common\models\storage\Storage;
use common\models\Students;
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
 * @property int|null $gender
 * @property string|null $birthday
 * @property int|null $consent
 * @property string|null $photo
 * @property string|null $new_pass
 *
 * @property Documents[] $documents
 * @property Documents[] $documents0
 * @property Events[] $events
 * @property Group[] $groups
 * @property Publications[] $publications
 * @property Shedule[] $shedules
 * @property Shedule[] $shedules0
 * @property Students[] $students
 * @property string $fullname
 * @property string $userInitials
 * @property string $authKey
 * @property Vkr[] $vkrs
 */

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const DEFAULT_USER_IMAGE = 'users/undefined-user.webp';

    const ROLE_USER = 1;
    const ROLE_STUDENT = 2;
    const ROLE_TUTOR = 3;
    const ROLE_CURATOR = 4;
    const ROLE_HEAD_DEPARTMENT = 5;
    const ROLE_MODERATOR = 6;
    const ROLE_ADMIN = 7;

    public static $rolesList = [
        self::ROLE_USER             => 'Пользователь',
        self::ROLE_STUDENT          => 'Студент',
        self::ROLE_TUTOR            => 'Преподаватель',
        self::ROLE_CURATOR          => 'Куратор',
        self::ROLE_HEAD_DEPARTMENT  => 'Зав_каф',
        self::ROLE_MODERATOR        => 'Модератор',
        self::ROLE_ADMIN            => 'Администратор',
    ];

    public $imageFile;
    public $new_pass;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function fields()
    {
        return array_merge(parent::fields(), ['gender' => null]);
    }

    /**
     * {@inheritdoc}
     */
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
            [['created_at', 'updated_at', 'gender', 'consent'], 'integer'],
            [['birthday'], 'safe'],
            [['username', 'new_pass', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'photo'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 20],
            [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/i'],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['new_pass'], 'string', 'min' => 6],
            [['new_pass'], 'match', 'pattern' => '/^[^'.preg_quote('\\/', '/').'\s]*$/i'],
            [['password_reset_token'], 'unique'],
            [['birthday'], 'datetime', 'format' => 'php:Y-m-d'],
            [['photo', 'imageFile'], 'image',
                'extensions' => ['jpg', 'jpeg', 'png'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 2000 * 1024, // 2 МБ = 2000 * 1024 байта = 2 048 000‬ байт
                'tooBig' => 'Лимит 2Мб'
            ],
            [['created_at', 'updated_at'], 'default', 'value' => time()],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['photo', 'phone', 'first_name', 'last_name', 'middle_name', 'gender'], 'default', 'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '№',
            'username' => 'Логин',
            'auth_key' => 'Auth Key',
            'new_pass' => 'Пароль',
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
        if (!isset($this->gender))
            return null;
        return $this->gender === 0 ? 'Мужской' : 'Женский';
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 9: return 'Не подтвержденный';
            case 10: return 'Подтвержден';
            default: return null;
        }
    }

    public function getBirthday()
    {
        return $this->birthday ? Yii::$app->formatter->asDate(strtotime($this->birthday),'dd.MM.Y') : null;
    }

    public function getConsent()
    {
        return $this->consent === 1 ? 'Подтверждено' : null;
    }

    public function hasLastname() {
        return empty($this->last_name) ? false : true;
    }

    public function getFullname() {
        return $this->hasLastname()
            ? implode(' ', [$this->last_name, $this->first_name, $this->middle_name])
            : $this->username;
    }

    public function getUserPhoto()
    {
        return Storage::getFileUrl((!empty($this->photo) ? $this->photo : self::DEFAULT_USER_IMAGE));
    }

    public function getUserInitials()
    {
        if($this->last_name AND $this->first_name) {
            if($this->middle_name) return $this->last_name .' '. mb_substr($this->first_name, 0, 1) . '. ' . mb_substr($this->middle_name, 0, 1) . '.';
            else return $this->last_name .' '. mb_strstr($this->first_name, 0, 1) . '.';
        }
        return $this->username;
    }

    public static function findByLogin($login)
    {
        return static::find()->where(['status' => self::STATUS_ACTIVE])->andWhere(['username' => $login])->orWhere(['email' => $login])->limit(1)->one();
    }

    public function uploadImage($image, $attr)
    {
        if ($this->validate($attr)) {

            if(empty($image))
                return false;

            $destination = 'users/' . $this->getId() . '/uploads/photo/';
            $path = Storage::getStoragePath() . $destination;
            $filename = Storage::randomFileName($image);

            if($this->photo)
                unlink(Storage::getStoragePath() . $this->photo);

            if (FileHelper::createDirectory($path, $mode = 0755, $recursive = true)) {
                $image->saveAs($path . $filename);
                $this->photo = $destination . $filename;
            }

            return true;
        }
        return false;
    }

    public function deleteImage()
    {
//        if($this->photo)
//            FileHelper::removeDirectory(Storage::getStoragePath() . 'users/' . $this->id);

        if($this->photo)
        {
            $photo = $this->photo;
            $this->photo = null;
            if($this->save())
                unlink(Storage::getStoragePath() . $photo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

     /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     * @throws \yii\base\Exception
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->birthday = empty($this->birthday) ? null : (Yii::$app->formatter->asDate(strtotime($this->birthday), "php:Y-m-d"));
        if(Yii::$app->id === 'app-backend') {
            if(Yii::$app->controller->action->id === 'create')
            {
                if(empty($this->new_pass))
                    return false;
                $this->setPassword($this->new_pass);
                $this->consent = 0;
                $this->created_at = time();
                $this->updated_at = $this->created_at;
                $this->status = 10;
                $this->generateAuthKey();
                $this->generateEmailVerificationToken();
            }
            else
            {
                if(!empty($this->new_pass) && $this->validate('new_pass'))
                    $this->setPassword($this->new_pass);
                $this->updated_at = time();
            }
        }
        else
        {
            $this->consent = 0;
            $this->created_at = time();
            $this->updated_at = $this->created_at;
        }
        $photo = UploadedFile::getInstance($this, 'imageFile');
        $this->uploadImage($photo, 'imageFile');
        return parent::save($runValidation, $attributeNames);
    }

    public function delete()
    {
        if(FileHelper::findDirectories(Storage::getStoragePath() . 'users/' . $this->id))
            FileHelper::removeDirectory(Storage::getStoragePath() . 'users/' . $this->id);
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['user_add_id' => 'id']);
    }

    /**
     * Gets query for [[Documents0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments0()
    {
        return $this->hasMany(Documents::className(), ['user_approve_id' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['user_id' => 'id']);
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
     * Gets query for [[Shedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShedules()
    {
        return $this->hasMany(Shedule::className(), ['user_add' => 'id']);
    }

    /**
     * Gets query for [[Shedules0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShedules0()
    {
        return $this->hasMany(Shedule::className(), ['user_approve' => 'id']);
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

    /**
     * Gets query for [[Vkrs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVkrs()
    {
        return $this->hasMany(Vkr::className(), ['user_id' => 'id']);
    }
}
