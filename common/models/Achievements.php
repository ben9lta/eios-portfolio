<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "achievements".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property string|null $result
 * @property string|null $document
 * @property int $stud_id
 * @property int|null $status_id
 * @property string|null $comment
 * @property int $type_id
 *
 * @property EventStatus $status
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
            [['stud_id', 'status_id', 'type_id'], 'integer'],
            [['title', 'result', 'document', 'comment'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
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
            'date' => 'Дата',
            'result' => 'Результат',
            'document' => 'Документ',
            'stud_id' => '№ Студента',
            'type_id' => '№ Деятельности',
            'comment' => 'Комментарий',
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
