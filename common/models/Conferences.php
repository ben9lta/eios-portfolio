<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conferences".
 *
 * @property int $id
 * @property string $title
 * @property string $date_start
 * @property string $date_end
 * @property string|null $location
 * @property string|null $document
 * @property string|null $program
 * @property string|null $comments
 * @property int $student_id
 * @property int $status_id
 * @property int $type_id
 *
 * @property ConfStatus $status
 * @property Students $student
 * @property ConfType $type
 */
class Conferences extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conferences';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date_start', 'date_end', 'student_id', 'status_id', 'type_id'], 'required'],
            [['date_start', 'date_end'], 'safe'],
            [['comments'], 'string'],
            [['student_id', 'status_id', 'type_id'], 'integer'],
            [['title', 'location', 'document', 'program'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConfStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConfType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Конференции',
            'title' => 'Наименование',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата завершения',
            'location' => 'Место проведения',
            'document' => 'Сборник',
            'program' => 'Программа',
            'comments' => 'Комментарий',
            'student_id' => '№ Студента',
            'status_id' => '№ Статуса конф.',
            'type_id' => '№ Вида конф.',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ConfStatus::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ConfType::className(), ['id' => 'type_id']);
    }
}
