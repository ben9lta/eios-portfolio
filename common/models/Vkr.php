<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vkr".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $document
 * @property string|null $evaluation
 * @property int $stud_id
 * @property int $user_id
 *
 * @property Students $stud
 * @property User $user
 */
class Vkr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vkr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stud_id', 'title'], 'required'],
            [['stud_id', 'user_id', 'evaluation'], 'integer'],
            [['title', 'document', 'comment'], 'string', 'max' => 255],
            [['stud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['stud_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ ВКР',
            'title' => 'Наименование',
            'document' => 'Документ',
            'evaluation' => 'Оценка',
            'stud_id' => '№ Студента',
            'user_id' => '№ Научного руководителя',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
