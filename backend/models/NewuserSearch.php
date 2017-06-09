<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Newuser;

/**
 * NewuserSearch represents the model behind the search form about `backend\models\Newuser`.
 */
class NewuserSearch extends Newuser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count'], 'integer'],
            [['time'], 'safe'],
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
    public function search($params,$daytime=0,$enddaytime=0)
    {
        date_default_timezone_set('PRC');
        $query = Newuser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'time' => $this->time,
            'count' => $this->count,
        ]);

        if($daytime!=0)
        {
            
                $query->andFilterWhere(['between', 'time', $daytime.' 00:00:00', $enddaytime.' 23:59:59'])->all();
        }

        return $dataProvider;
    }
}
