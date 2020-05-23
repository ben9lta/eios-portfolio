<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "practics".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $place
 * @property string|null $date_start
 * @property string|null $date_end
 * @property string|null $document
 * @property string|null $diary
 * @property string|null $characteristic
 * @property string|null $evaluation
 * @property int $stud_id
 *
 * @property Students $stud
 */
class Practics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'practics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'safe'],
            [['stud_id'], 'required'],
            [['stud_id'], 'integer'],
            [['title', 'place', 'document', 'diary', 'characteristic', 'evaluation'], 'string', 'max' => 255],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Практики',
            'title' => 'Наименование',
            'place' => 'Место',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'document' => 'Документ',
            'diary' => 'Дневник',
            'characteristic' => 'Характеристика',
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
