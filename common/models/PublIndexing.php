<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publ_indexing".
 *
 * @property int $id
 * @property string $title
 *
 * @property Publications[] $publications
 */
class PublIndexing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publ_indexing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Индекса',
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publications::className(), ['indexing_id' => 'id']);
    }
}
