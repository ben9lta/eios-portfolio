<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property int $user_add_id
 * @property int|null $user_approve_id
 * @property int $doc_type_id
 * @property string $title
 * @property string $document
 * @property int|null $status
 * @property string|null $comment
 *
 * @property DocTypes $docType
 * @property User $userAdd
 * @property User $userApprove
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_add_id', 'doc_type_id', 'title', 'document'], 'required'],
            [['user_add_id', 'user_approve_id', 'doc_type_id', 'status'], 'integer'],
            [['title', 'document', 'comment'], 'string', 'max' => 255],
            [['docTypeName'],'safe'],
            [['doc_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocTypes::className(), 'targetAttribute' => ['doc_type_id' => 'id']],
            [['user_add_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_add_id' => 'id']],
            [['user_approve_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_approve_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Документа',
            'user_add_id' => 'Добавил',
            'user_approve_id' => 'Заверил',
            'doc_type_id' => 'Тип документа',
            'title' => 'Наименование',
            'document' => 'Документ',
            'status' => 'Статус',
            'comment' => 'Комментарий',
            'docTypeName' => 'Тип документа',
        ];
    }

    /**
     * Gets query for [[DocType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocType()
    {
        return $this->hasOne(DocTypes::className(), ['id' => 'doc_type_id']);
    }

    /**
     * Gets query for [[UserAdd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAdd()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add_id']);
    }

    /**
     * Gets query for [[UserApprove]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserApprove()
    {
        return $this->hasOne(User::className(), ['id' => 'user_approve_id']);
    }

    public function getDocTypes()
    {
        return $this->hasOne(DocTypes::className(), ['id' => 'doc_type_id']);
    }

    public function getProfAdd()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add_id']);
    }

    public function getProfApprove()
    {
        return $this->hasOne(User::className(), ['id' => 'user_approve_id']);
    }

    public function getDocTypeName()
    {
        return $this->docTypes->title;
    }

    public function getProfAddName()
    {
        return $this->profAdd->fullname;
    }

    public function getProfApproveName()
    {
        return $this->profApprove->fullname;
    }

    public function getStatusValue()
    {
        return $this->status === 1? "Одобрено" : "На рассмотрении";
    }

    public function uploadDocument($doc, $attr)
    {
        if ($this->validate($attr)) {

            if(empty($doc))
                return false;

            $destination = 'documents/' . $this->getId() . '/'.$this->getDocType()."/";
            $path = Storage::getStoragePath() . $destination;
            $filename = Storage::randomFileName($doc);

            if($this->document)
                unlink(Storage::getStoragePath() . $this->document);

            if (FileHelper::createDirectory($path, $mode = 0755, $recursive = true)) {
                $image->saveAs($path . $filename);
                $this->document = $destination . $filename;
            }

            return true;
        }
        return false;
    }
}
