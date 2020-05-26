<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "edu_level".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Direction[] $directions
 */
class EduLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edu_level';
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
            'id' => '№ Уровня образования',
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Directions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirections()
    {
        return $this->hasMany(Direction::className(), ['level_id' => 'id']);
    }
}
