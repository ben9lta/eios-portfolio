<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property int $inst_id
 *
 * @property Institute $inst
 * @property Direction[] $directions
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address', 'inst_id'], 'required'],
            [['inst_id'], 'integer'],
            [['title', 'address'], 'string', 'max' => 255],
            [['inst_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institute::className(), 'targetAttribute' => ['inst_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Факультета',
            'title' => 'Наименование',
            'address' => 'Адрес',
            'inst_id' => '№ Института',
        ];
    }

    /**
     * Gets query for [[Inst]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInst()
    {
        return $this->hasOne(Institute::className(), ['id' => 'inst_id']);
    }

    /**
     * Gets query for [[Directions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirections()
    {
        return $this->hasMany(Direction::className(), ['dep_id' => 'id']);
    }
}
