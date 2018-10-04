<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\F43;

/**
 * F43Search represents the model behind the search form of `frontend\models\F43`.
 */
class F43Search extends F43
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'hosname', 'ampurname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = F43::find();

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
        $query->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
            ->andFilterWhere(['like', 'hosname', $this->hosname])
            ->andFilterWhere(['like', 'ampurname', $this->ampurname]);

        return $dataProvider;
    }
}
