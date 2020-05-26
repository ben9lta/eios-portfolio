<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property int $dep_id
 * @property int $level_id
 *
 * @property Department $dep
 * @property EduLevel $level
 * @property Group[] $groups
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code', 'dep_id', 'level_id'], 'required'],
            [['dep_id', 'level_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 20],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dep_id' => 'id']],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => EduLevel::className(), 'targetAttribute' => ['level_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Направления',
            'title' => 'Наименование',
            'code' => 'Шифр',
            'dep_id' => '№ Факультета',
            'level_id' => '№ Уровня образования',
        ];
    }

    /**
     * Gets query for [[Dep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Department::className(), ['id' => 'dep_id']);
    }

    /**
     * Gets query for [[Level]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(EduLevel::className(), ['id' => 'level_id']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['dir_id' => 'id']);
    }
}
