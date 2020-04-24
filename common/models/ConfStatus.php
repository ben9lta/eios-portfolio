<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conf_status".
 *
 * @property int $id
 * @property string $title
 *
 * @property Conferences[] $conferences
 */
class ConfStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conf_status';
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
            'id' => '№ Статуса конф.',
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Conferences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConferences()
    {
        return $this->hasMany(Conferences::className(), ['status_id' => 'id']);
    }
}
