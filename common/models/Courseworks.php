<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "courseworks".
 *
 * @property int $id
 * @property string|null $subject
 * @property string|null $title
 * @property string|null $document
 * @property string|null $evaluation
 * @property int $stud_id
 *
 * @property Students $stud
 */
class Courseworks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courseworks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stud_id'], 'required'],
            [['stud_id'], 'integer'],
            [['subject', 'title', 'document', 'evaluation'], 'string', 'max' => 255],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Курсовой работы',
            'subject' => 'Дисциплина',
            'title' => 'Наименование',
            'document' => 'Документ',
            'evaluation' => 'Оценка',
            'stud_id' => '№ Студента',
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
}