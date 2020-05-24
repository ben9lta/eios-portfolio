<?php
namespace common\models;

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
 * @property int $gender
 * @property string|null $birthday
 * @property int|null $consent
 * @property string|null $photo
 *
 * @property Group[] $groups
 * @property Publications[] $publications
 * @property string $password
 * @property string $authKey
 * @property Students[] $students
 */

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const DEFAULT_USER_IMAGE = 'users/undefined-user.webp';
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
            TimestampBehavior::className(),
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
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'photo'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 20],
            [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/i'],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['birthday'], 'datetime', 'format' => 'php:Y-m-d'],
            [['photo', 'imageFile'], 'image',
                'extensions' => ['jpg', 'jpeg', 'png'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 2000 * 1024, // 2 МБ = 2000 * 1024 байта = 2 048 000‬ байт
                'tooBig' => 'Лимит 2Мб'
            ],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['photo', 'phone', 'first_name', 'last_name', 'middle_name', 'gender'], 'default', 'value' => null]
        ];
    }

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
//        if($this->status === 0)
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

    public static function getFullname($username) {
        $user = static::findOne(['username' => $username]);
        return $user['last_name'] . ' ' . $user['first_name'] . ' ' . $user['middle_name'];
    }

    public static function getUserInitials($username)
    {
        $user = static::findOne(['username' => $username]);
        if($user['last_name'] && $user['first_name'])
            if($user['middle_name'])
                return $user['last_name'] .' '. mb_substr($user['first_name'],0, 1) . '. ' . mb_substr($user['middle_name'],0, 1). '.' ;
            else
                return $user['last_name'] .' '. mb_substr($user['first_name'],0, 1) . '.' ;

        return $user['username'];
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

            $destination = 'users/' . $this->id . '/uploads/photo/';
            $path = Storage::getStoragePath() . $destination;
            $filename = Storage::randomFileName($image);

            if($this->photo)
                unlink(Storage::getStoragePath() . $this->photo);

            if (FileHelper::createDirectory($path, $mode = 0775, $recursive = true)) {
                $image->saveAs($path . $filename);
                $this->photo = $destination . $filename;
            }

            return true;
        } else {
            return false;
        }
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $photo = UploadedFile::getInstance($this, 'imageFile');
        $this->uploadImage($photo, 'imageFile');
        $this->birthday = empty($this->birthday) ? null : (Yii::$app->formatter->asDate(strtotime($this->birthday), "php:Y-m-d"));
        return parent::save($runValidation, $attributeNames);
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
