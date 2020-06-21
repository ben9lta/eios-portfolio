<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Documents;

/**
 * DocumentsSearch represents the model behind the search form of `common\models\Documents`.
 */
class DocumentsSearch extends Documents
{
    public $docTypeName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_add_id', 'user_approve_id', 'status'], 'integer'],
            [['title', 'document', 'comment','docTypeName','doc_type_id'], 'safe'],
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
        $query = Documents::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_add_id' => $this->user_add_id,
            'user_approve_id' => $this->user_approve_id,
            //'doc_type_id' => $this->doc_type_id,
            'status' => $this->status,
        ]);


        //добавить правила сортировки для дургих полей, или выяснить как можно добавить 1 правило для какого-то поля
        $dataProvider->setSort([
            'attributes' => [
              'docTypeName' => [
                  'asc' => ['docTypeName' => SORT_ASC],
                  'desc' => ['docTypeName' => SORT_DESC],
                  'default' => SORT_ASC
              ],]
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'document', $this->document])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        $query->joinWith(['docTypes' => function ($q) {
            $q->where('doc_types.title LIKE "%' . $this->docTypeName . '%"');
        }]);

        return $dataProvider;
    }
}
