<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shedule".
 *
 * @property int $id
 * @property int $user_add
 * @property int $user_approve
 * @property int $group_id
 * @property string $document
 * @property string|null $comment
 *
 * @property Group $group
 * @property User $userAdd
 * @property User $userApprove
 */
class Shedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_add', 'user_approve', 'group_id', 'document'], 'required'],
            [['user_add', 'user_approve', 'group_id'], 'integer'],
            [['document', 'comment'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_add'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_add' => 'id']],
            [['user_approve'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_approve' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Расписания',
            'user_add' => '№ Пользователя1',
            'user_approve' => '№ Пользователя2',
            'group_id' => '№ Группы',
            'document' => 'Документ',
            'comment' => 'Комментарий',
        ];
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
     * Gets query for [[UserAdd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAdd()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    /**
     * Gets query for [[UserApprove]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserApprove()
    {
        return $this->hasOne(User::className(), ['id' => 'user_approve']);
    }
}
