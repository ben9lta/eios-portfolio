<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $title
 * @property string|null $date_start
 * @property string|null $date_end
 * @property string|null $location
 * @property string|null $document
 * @property int|null $evaluation
 * @property int $student_id
 * @property int|null $user_id
 * @property int|null $status_id
 * @property int|null $type_id
 * @property string|null $comment
 *
 * @property EventStatus $status
 * @property Students $student
 * @property EventType $type
 * @property User $user
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'student_id'], 'required'],
            [['date_start', 'date_end'], 'safe'],
            [['evaluation', 'student_id', 'user_id', 'status_id', 'type_id'], 'integer'],
            [['title', 'location', 'document', 'comment'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Мероприятия',
            'title' => 'Наименвоание',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'location' => 'Место проведения',
            'document' => 'Документ',
            'evaluation' => 'Оценка',
            'student_id' => '№ Студента',
            'user_id' => '№ Научного руководителя',
            'status_id' => '№ Статуса',
            'type_id' => '№ Типа мероприятия',
            'comment' => 'Комменатрий',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(EventStatus::className(), ['id' => 'status_id']);
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
        return $this->hasOne(EventType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
