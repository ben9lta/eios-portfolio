<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Practics;

/**
 * PracticsSearch represents the model behind the search form of `common\models\Practics`.
 */
class PracticsSearch extends Practics
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'evaluation', 'stud_id'], 'integer'],
            [['title', 'place', 'date_start', 'date_end', 'document', 'diary', 'characteristic', 'comment'], 'safe'],
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
        $query = Practics::find();

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
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'evaluation' => $this->evaluation,
            'stud_id' => $this->stud_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'document', $this->document])
            ->andFilterWhere(['like', 'diary', $this->diary])
            ->andFilterWhere(['like', 'characteristic', $this->characteristic])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
