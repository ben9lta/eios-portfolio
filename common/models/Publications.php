<?php

namespace common\models;

use common\models\storage\Storage;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "publications".
 *
 * @property int $id
 * @property string $title
 * @property string|null $authors
 * @property string $document
 * @property string $date
 * @property string|null $description
 * @property int|null $indexing_id
 * @property int $stud_id
 * @property int|null $user_id
 * @property string|null $comment
 *
 * @property PublIndexing $indexing
 * @property Students $stud
 * @property User $user
 */
class Publications extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'document', 'date', 'stud_id'], 'required'],
            [['date'], 'safe'],
            [['indexing_id', 'stud_id', 'user_id'], 'integer'],
            [['file',], 'file',
                'extensions' => ['pdf', 'doc', 'docx', 'rtf'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 5000 * 1024,
                'tooBig' => 'Лимит 5Мб'
            ],
            [['title', 'authors', 'document', 'description', 'comment'], 'string', 'max' => 255],
            [['indexing_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublIndexing::className(), 'targetAttribute' => ['indexing_id' => 'id']],
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
            'id' => '№ Публикации',
            'title' => 'Наименование',
            'authors' => 'Авторы',
            'document' => 'Документ',
            'date' => 'Дата',
            'description' => 'Описание',
            'indexing_id' => '№ Индекс',
            'stud_id' => '№ Студента',
            'user_id' => '№ Соавтора',
            'comment' => 'Комментарий',
        ];
    }

    public function uploadFile($file, $attr)
    {
        if ($this->validate($attr)) {

            if(empty($file))
                return false;

            $destination = 'users/' . Yii::$app->user->id . '/uploads/files/Научная деятельность/Публикации/';
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
        if(Yii::$app->controller->action->id === 'upload-publ')
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
     * Gets query for [[Indexing]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexing()
    {
        return $this->hasOne(PublIndexing::className(), ['id' => 'indexing_id']);
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
