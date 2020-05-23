<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "achievements".
 *
 * @property int $id
 * @property string $title
 * @property string|null $status
 * @property string $date
 * @property string|null $result
 * @property string|null $document
 * @property int $stud_id
 * @property int $type_id
 *
 * @property Students $stud
 * @property ActivityType $type
 */
class Achievements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'achievements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date', 'stud_id', 'type_id'], 'required'],
            [['date'], 'safe'],
            [['stud_id', 'type_id'], 'integer'],
            [['title', 'status', 'result', 'document'], 'string', 'max' => 255],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ActivityType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Достижения',
            'title' => 'Наименование',
            'status' => 'Статус',
            'date' => 'Дата',
            'result' => 'Результат',
            'document' => 'Документ',
            'stud_id' => '№ Студента',
            'type_id' => '№ Деятельности',
        ];
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ActivityType::className(), ['id' => 'type_id']);
    }
}
