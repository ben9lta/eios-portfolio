<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc_maintypes".
 *
 * @property int $id
 * @property string $title
 * @property string|null $comments
 *
 * @property DocTypes[] $docTypes
 */
class DocMaintypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_maintypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'comments'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Главного типа документа',
            'title' => 'Наименование',
            'comments' => 'Комментарий',
        ];
    }

    /**
     * Gets query for [[DocTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocTypes()
    {
        return $this->hasMany(DocTypes::className(), ['doc_maintypes_id' => 'id']);
    }
}
