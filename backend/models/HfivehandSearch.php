<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hfivehand;

/**
 * HfivehandSearch represents the model behind the search form about `backend\models\Hfivehand`.
 */
class HfivehandSearch extends Hfivehand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['time', 'channel', 'third'], 'safe'],
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
    public function search($params,$daytime=0,$enddaytime=0,$power)
    {
        $query = Hfivehand::find();

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
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'channel', $this->channel])
            ->andFilterWhere(['like', 'third', $this->third])
            ->andFilterWhere(['like', 'count', $this->count]);

        if($daytime!=0)
        {
            $query->andFilterWhere(['between', 'time', $daytime.' 00:00:00', $enddaytime.' 23:59:59'])->all();
        }

        $username = Yii::$app->user->identity->username;
        if ($power=='发行商') {
            $query->andFilterWhere(['third' => $username]);
        }

        return $dataProvider;
    }
}
