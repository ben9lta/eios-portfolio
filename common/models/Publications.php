<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publications".
 *
 * @property int $id
 * @property string $title
 * @property string|null $authors
 * @property string $document
 * @property string $date
 * @property string|null $description
 * @property int|null $indexing_id
 * @property int $stud_id
 * @property int|null $user_id
 * @property string|null $comment
 *
 * @property PublIndexing $indexing
 * @property Students $stud
 * @property User $user
 */
class Publications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'document', 'date', 'stud_id'], 'required'],
            [['date'], 'safe'],
            [['indexing_id', 'stud_id', 'user_id'], 'integer'],
            [['title', 'authors', 'document', 'description', 'comment'], 'string', 'max' => 255],
            [['indexing_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublIndexing::className(), 'targetAttribute' => ['indexing_id' => 'id']],
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
            'id' => '№ Публикации',
            'title' => 'Наименование',
            'authors' => 'Авторы',
            'document' => 'Документ',
            'date' => 'Дата',
            'description' => 'Описание',
            'indexing_id' => '№ Индекс',
            'stud_id' => '№ Студента',
            'user_id' => '№ Соавтора',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * Gets query for [[Indexing]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexing()
    {
        return $this->hasOne(PublIndexing::className(), ['id' => 'indexing_id']);
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
