<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 * @property int $budget
 *
 * @property Achievements[] $achievements
 * @property Courseworks[] $courseworks
 * @property Events[] $events
 * @property Practics[] $practics
 * @property Publications[] $publications
 * @property Group $group
 * @property User $user
 * @property Vkr[] $vkrs
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id', 'budget'], 'required'],
            [['user_id', 'group_id', 'budget'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Студента',
            'user_id' => '№ Пользователя',
            'group_id' => '№ Группы',
            'budget' => 'Бюджетная форма',
            'fullName' => 'ФИО',
            'groupName' => 'Группа'
        ];
    }

    public function getBudget()
    {
        return $this->budget === 1 ? 'Бюджет' : 'Коммерция';
    }

    public function getFullName()
    {
        return $this->user->fullname;
    }

    public function getGroupName()
    {
        return $this->group->title;
    }

    function save($runValidation = true, $attributeNames = null)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole('Студент');

        if(Yii::$app->controller->action->id !== 'delete') {
            if(empty($auth->getRolesByUser($this->user_id)['Студент'])){
                $auth->assign($role, $this->user_id);
            }
        }
        if(Yii::$app->controller->action->id === 'delete')
        {
            if(!empty($auth->getRolesByUser($this->user_id)['Студент'])){
                $auth->revoke($role, $this->user_id);
            }
        }
        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

    /**
     * Gets query for [[Achievements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAchievements()
    {
        return $this->hasMany(Achievements::className(), ['stud_id' => 'id']);
    }

    /**
     * Gets query for [[Courseworks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseworks()
    {
        return $this->hasMany(Courseworks::className(), ['stud_id' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['student_id' => 'id']);
    }

    /**
     * Gets query for [[Practics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPractics()
    {
        return $this->hasMany(Practics::className(), ['stud_id' => 'id']);
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publications::className(), ['stud_id' => 'id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
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

    /**
     * Gets query for [[Vkrs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVkrs()
    {
        return $this->hasMany(Vkr::className(), ['stud_id' => 'id']);
    }
}
