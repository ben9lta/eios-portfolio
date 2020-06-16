<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DocTypes;

/**
 * DocTypesSearch represents the model behind the search form of `common\models\DocTypes`.
 */
class DocTypesSearch extends DocTypes
{
    public $mainTypeName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'doc_maintypes_id'], 'integer'],
            [['title', 'comment','mainTypeName'], 'safe'],
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
        $query = DocTypes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->setSort([
            'attributes' => [
              'id' => [
                  'asc' => ['id' => SORT_ASC],
                  'desc' => ['id' => SORT_DESC],
                  'default' => SORT_ASC
              ],
              'title' => [
                  'asc' => ['title' => SORT_ASC],
                  'desc' => ['title' => SORT_DESC],
                  'default' => SORT_ASC
              ],
              'comment' => [
                  'asc' => ['comment' => SORT_ASC],
                  'desc' => ['comment' => SORT_DESC],
                  'default' => SORT_ASC
              ],
                'mainTypeName' => [
                    'asc' => ['doc_maintypes.title' => SORT_ASC],
                    'desc' => ['doc_maintypes.title' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ],
        ]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'doc_maintypes_id' => $this->doc_maintypes_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        $query->joinWith(['docMaintypes' => function ($q) {
            $q->where('doc_maintypes.title LIKE "%' . $this->mainTypeName . '%"');
        }]);
        return $dataProvider;
    }
}
