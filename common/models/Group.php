<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $title
 * @property int $course
 * @property int $dir_id
 * @property int $curator_id
 * @property int $form_id
 *
 * @property User $curator
 * @property Direction $dir
 * @property EduForm $form
 * @property Shedule[] $shedules
 * @property Students[] $students
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'course', 'dir_id', 'curator_id', 'form_id'], 'required'],
            [['course', 'dir_id', 'curator_id', 'form_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['curator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['curator_id' => 'id']],
            [['dir_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['dir_id' => 'id']],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => EduForm::className(), 'targetAttribute' => ['form_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Группы',
            'title' => 'Наименование',
            'course' => 'Курс',
            'dir_id' => '№ Направления',
            'curator_id' => '№ Куратора',
            'form_id' => '№ Формы обучения',
        ];
    }

    /**
     * Gets query for [[Curator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurator()
    {
        return $this->hasOne(User::className(), ['id' => 'curator_id']);
    }

    /**
     * Gets query for [[Dir]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDir()
    {
        return $this->hasOne(Direction::className(), ['id' => 'dir_id']);
    }

    /**
     * Gets query for [[Form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(EduForm::className(), ['id' => 'form_id']);
    }

    /**
     * Gets query for [[Shedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShedules()
    {
        return $this->hasMany(Shedule::className(), ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['group_id' => 'id']);
    }
}
