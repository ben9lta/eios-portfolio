<?php

namespace common\models;

use common\models\storage\Storage;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "achievements".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property string|null $result
 * @property string|null $document
 * @property int $stud_id
 * @property int|null $status_id
 * @property string|null $comment
 * @property int $type_id
 *
 * @property EventStatus $status
 * @property Students $stud
 * @property ActivityType $type
 */
class Achievements extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'achievements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date', 'stud_id', 'type_id'], 'required'],
            [['date'], 'safe'],
            [['stud_id', 'status_id', 'type_id'], 'integer'],
            [['file',], 'file',
                'extensions' => ['pdf', 'doc', 'docx', 'rtf'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 5000 * 1024,
                'tooBig' => 'Лимит 5Мб'
            ],
            [['title', 'result', 'document', 'comment'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ActivityType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Достижения',
            'title' => 'Наименование',
            'date' => 'Дата',
            'result' => 'Результат',
            'document' => 'Документ',
            'stud_id' => '№ Студента',
            'type_id' => '№ Деятельности',
            'comment' => 'Комментарий',
        ];
    }

    public function uploadFile($file, $attr)
    {
        if ($this->validate($attr)) {

            if(empty($file))
                return false;

            if(Yii::$app->controller->action->id === 'upload-achievements')
                $userID = Yii::$app->user->id;
            else $userID = $this->stud->user_id;

            $destination = 'users/' . $userID . '/uploads/files/Внеучебные достижения/Достижения/';
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
        $this->date = empty($this->date) ? null : (Yii::$app->formatter->asDate(strtotime($this->date), "php:Y-m-d"));

        switch (Yii::$app->controller->action->id){
            case 'upload-achievements':
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(EventStatus::className(), ['id' => 'status_id']);
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ActivityType::className(), ['id' => 'type_id']);
    }
}
