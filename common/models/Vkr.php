<?php

namespace common\models;

use common\models\storage\Storage;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "vkr".
 *
 * @property int $id
 * @property string $title
 * @property string|null $document
 * @property int|null $evaluation
 * @property int $stud_id
 * @property int|null $user_id
 * @property string|null $comment
 *
 * @property Students $stud
 * @property User $user
 */
class Vkr extends \yii\db\ActiveRecord
{

    public $file;
    public $fullName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vkr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'stud_id'], 'required'],
            [['evaluation', 'stud_id', 'user_id'], 'integer'],
            [['title', 'document', 'comment'], 'string', 'max' => 255],
            [['evaluation'], 'integer', 'min' => 0, 'max' => 100],
            [['file',], 'file',
                'extensions' => ['pdf', 'doc', 'docx', 'rtf'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 5000 * 1024,
                'tooBig' => 'Лимит 5Мб'
            ],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ ВКР',
            'title' => 'Наименование',
            'document' => 'Документ',
            'evaluation' => 'Оценка',
            'stud_id' => '№ Студента',
            'user_id' => '№ Научного руководителя',
            'comment' => 'Комментарий'
        ];
    }

    public function uploadFile($file, $attr)
    {
        if ($this->validate($attr)) {

            if(empty($file))
                return false;

            if(Yii::$app->controller->action->id === 'upload-vkr')
                $userID = Yii::$app->user->id;
            else $userID = $this->stud->user_id;

            $destination = 'users/' . $userID . '/uploads/files/Учебная деятельность/ВКР/';
            $path = Storage::getStoragePath() . $destination;
            $filename = Storage::randomFileName($file);

            if($this->document)
                unlink(Storage::getStoragePath() . $this->document);

            if (FileHelper::createDirectory($path, $mode = 0755, $recursive = true)) {
                $file->saveAs($path . $filename);
                $this->document = $destination . $filename;
            }

            return true;
        }
        return false;
    }

    public function deleteFile()
    {
        if($this->document)
        {
            $file = $this->document;
            $this->document = null;
            if($this->save())
                unlink(Storage::getStoragePath() . $file);
        }
    }

    public function beforeDelete()
    {
        $this->deleteFile();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        switch (Yii::$app->controller->action->id){
            case 'upload-vkr':
            case 'update':
            case 'create':
                if($this->validate())
                {
                    $file = UploadedFile::getInstance($this, 'file');
                    $this->uploadFile($file, 'file');
                }
                break;
            default: break;
        }
        return parent::save($runValidation, $attributeNames);
    }

    /**
     * Gets query for [[Stud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStud()
    {
        return $this->hasOne(Students::className(), ['id' => 'stud_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
