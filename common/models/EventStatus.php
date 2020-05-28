<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_status".
 *
 * @property int $id
 * @property string $title
 *
 * @property Achievements[] $achievements
 * @property Events[] $events
 */
class EventStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_status';
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
            'id' => '№ Статуса',
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Achievements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAchievements()
    {
        return $this->hasMany(Achievements::className(), ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['status_id' => 'id']);
    }
}
