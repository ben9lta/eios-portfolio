<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "achievements".
 *
 * @property int $id
 * @property string $title
 * @property string|null $type
 * @property string|null $status
 * @property string $date
 * @property string|null $result
 * @property string|null $document
 * @property int $stud_id
 *
 * @property Students $stud
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
            [['title', 'date', 'stud_id'], 'required'],
            [['date'], 'safe'],
            [['stud_id'], 'integer'],
            [['title', 'type', 'status', 'result', 'document'], 'string', 'max' => 255],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
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
            'type' => 'Вид',
            'status' => 'Статус',
            'date' => 'Дата',
            'result' => 'Результат',
            'document' => 'Документ',
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
