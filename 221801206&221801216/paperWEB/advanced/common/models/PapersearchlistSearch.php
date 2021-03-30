<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Papersearchlist;

/**
 * PapersearchlistSearch represents the model behind the search form about `common\models\Papersearchlist`.
 */
class PapersearchlistSearch extends Papersearchlist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'storeID'], 'integer'],
            [['displayTitle', 'abstract', 'year', 'pubdate', 'link', 'keyword'], 'safe'],
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
        $query = Papersearchlist::find();

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
            'storeID' => $this->storeID,
        ]);

        $query->andFilterWhere(['like', 'displayTitle', $this->displayTitle])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'pubdate', $this->pubdate])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'keyword', $this->keyword]);

        return $dataProvider;
    }
}
