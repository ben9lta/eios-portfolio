<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "institute".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property int $univer_id
 *
 * @property Department[] $departments
 * @property Univer $univer
 */
class Institute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address', 'univer_id'], 'required'],
            [['univer_id'], 'integer'],
            [['title', 'address'], 'string', 'max' => 255],
            [['univer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Univer::className(), 'targetAttribute' => ['univer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Института',
            'title' => 'Наименование',
            'address' => 'Адрес',
            'univer_id' => '№ Университета',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['inst_id' => 'id']);
    }

    /**
     * Gets query for [[Univer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniver()
    {
        return $this->hasOne(Univer::className(), ['id' => 'univer_id']);
    }
}
