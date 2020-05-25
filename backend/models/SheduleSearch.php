<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Shedule;

/**
 * SheduleSearch represents the model behind the search form of `common\models\Shedule`.
 */
class SheduleSearch extends Shedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_add', 'user_approve', 'group_id'], 'integer'],
            [['document', 'comments'], 'safe'],
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
        $query = Shedule::find();

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
            'user_add' => $this->user_add,
            'user_approve' => $this->user_approve,
            'group_id' => $this->group_id,
        ]);

        $query->andFilterWhere(['like', 'document', $this->document])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
