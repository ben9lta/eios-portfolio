<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Students;

/**
 * StudentsSearch represents the model behind the search form of `common\models\Students`.
 */
class StudentsSearch extends Students
{
    public $fullName;
    public $groupName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'group_id', 'budget'], 'integer'],
            [['fullName', 'groupName'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
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

        return $dataProvider;
    }
}
