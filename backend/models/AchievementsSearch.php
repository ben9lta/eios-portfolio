<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Achievements;

/**
 * AchievementsSearch represents the model behind the search form of `common\models\Achievements`.
 */
class AchievementsSearch extends Achievements
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stud_id', 'status_id', 'type_id'], 'integer'],
            [['title', 'date', 'result', 'document', 'comment'], 'safe'],
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
        $query = Achievements::find();

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
            'date' => $this->date,
            'stud_id' => $this->stud_id,
            'status_id' => $this->status_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'document', $this->document])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
