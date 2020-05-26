<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "edu_form".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Group[] $groups
 */
class EduForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edu_form';
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
            'id' => '№ Формы образования',
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['form_id' => 'id']);
    }
}
