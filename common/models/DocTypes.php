<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc_types".
 *
 * @property int $id
 * @property string $title
 * @property int $doc_maintypes_id
 * @property string|null $comment
 *
 * @property DocMaintypes $docMaintypes
 * @property Documents[] $documents
 */
class DocTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'doc_maintypes_id'], 'required'],
            [['doc_maintypes_id'], 'integer'],
            [['title', 'comment'], 'string', 'max' => 255],
            [['doc_maintypes_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocMaintypes::className(), 'targetAttribute' => ['doc_maintypes_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Типа документа',
            'title' => 'Наименование',
            'doc_maintypes_id' => '№ Главного типа документа',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * Gets query for [[DocMaintypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocMaintypes()
    {
        return $this->hasOne(DocMaintypes::className(), ['id' => 'doc_maintypes_id']);
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['doc_type_id' => 'id']);
    }
}
