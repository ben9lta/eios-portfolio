<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "univer".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 *
 * @property Institute[] $institutes
 */
class Univer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'univer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address'], 'required'],
            [['title', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Университета',
            'title' => 'Наименование',
            'address' => 'Адрес',
        ];
    }

    /**
     * Gets query for [[Institutes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutes()
    {
        return $this->hasMany(Institute::className(), ['univer_id' => 'id']);
    }
}
