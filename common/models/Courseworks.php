<?php

namespace common\models;

use common\models\storage\Storage;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "courseworks".
 *
 * @property int $id
 * @property string $subject
 * @property string $title
 * @property string|null $document
 * @property int|null $evaluation
 * @property int $stud_id
 * @property string|null $comment
 *
 * @property Students $stud
 */
class Courseworks extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courseworks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'title', 'stud_id'], 'required'],
            [['evaluation', 'stud_id'], 'integer'],
            [['subject', 'title', 'document', 'comment'], 'string', 'max' => 255],
            [['evaluation'], 'integer', 'min' => 0, 'max' => 100],
            [['file',], 'file',
                'extensions' => ['pdf', 'doc', 'docx', 'rtf'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 5000 * 1024,
                'tooBig' => 'Лимит 5Мб'
            ],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Курсовой работы',
            'subject' => 'Дисциплина',
            'title' => 'Наименование',
            'document' => 'Документ',
            'evaluation' => 'Оценка',
            'stud_id' => '№ Студента',
            'comment' => 'Комментарий',
        ];
    }

    public function uploadFile($file, $attr)
    {
        if ($this->validate($attr)) {

            if(empty($file))
                return false;

            $destination = 'users/' . Yii::$app->user->id . '/uploads/files/Учебная деятельность/Курсовые работы/';
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
        if(Yii::$app->controller->action->id === 'upload-cources')
        {
            if($this->validate())
            {
                $file = UploadedFile::getInstance($this, 'file');
                $this->uploadFile($file, 'file');
            }
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
}
