<?php

namespace frontend\models\students;

use common\models\Students;
use yii\data\ActiveDataProvider;

class StudentsSearch extends \backend\models\StudentsSearch
{
    public $fullName;
    public $groupName;
    public $institute;
    public $department;
    public $direction;

    public function rules()
    {
        return [
            [['id', 'user_id', 'group_id', 'budget'], 'integer'],
            [['fullName', 'groupName', 'department', 'institute', 'direction'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '№ Студента',
            'user_id' => '№ Пользователя',
            'group_id' => '№ Группы',
            'budget' => 'Бюджетная форма',
            'fullName' => 'ФИО',
            'groupName' => 'Группа',
            'institute' => 'Институт',
            'department' => 'Кафедра',
            'direction' => 'Направление'
        ];
    }

    public function search($params)
    {
        $query = Students::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['students.id' => SORT_ASC],
                    'desc' => ['students.id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'fullName' => [
                    'asc' => ['user.first_name' => SORT_ASC, 'user.last_name' => SORT_ASC],
                    'desc' => ['user.first_name' => SORT_DESC, 'user.last_name' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'groupName' => [
                    'asc' => ['group.title' => SORT_ASC],
                    'desc' => ['group.title' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'budget' => [
                    'asc' => ['budget' => SORT_ASC],
                    'desc' => ['budget' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'department' => [
                    'asc' => ['department.title' => SORT_ASC],
                    'desc' => ['department.title' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'institute' => [
                    'asc' => ['institute.title' => SORT_ASC],
                    'desc' => ['institute.title' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'direction' => [
                    'asc' => ['direction.code' => SORT_ASC],
                    'desc' => ['direction.code' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['user', 'group']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'students.id' => $this->id,
            'user_id' => $this->user_id,
            'group_id' => $this->group_id,
            'budget' => $this->budget,
        ]);

        $query->joinWith(['user' => function ($q) {
            $q->where('user.first_name LIKE "%' . $this->fullName . '%" ' .
                'OR user.last_name LIKE "%' . $this->fullName . '%"');
        }]);

        $query->joinWith(['group' => function ($q) {
            $q->where('group.title LIKE "%' . $this->groupName . '%"');
        }]);

        $query->joinWith(['group.dir.dep' => function ($q) {
            $q->where('department.id LIKE "%' . $this->department . '%"');
//            $q->where(['department.id' => $this->department]);
        }]);

        $query->joinWith(['group.dir' => function ($q) {
            $q->where('direction.id LIKE "%' . $this->direction . '%"');
        }]);

        $query->joinWith(['group.dir.dep.inst' => function ($q) {
            $q->where('institute.title LIKE "%' . $this->institute . '%"');
        }]);

        return $dataProvider;
    }
}