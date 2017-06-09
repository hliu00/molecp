<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Channelthird;

/**
 * ChannelthirdSearch represents the model behind the search form about `backend\models\Channelthird`.
 */
class ChannelthirdSearch extends Channelthird
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['channel', 'third', 'password'], 'safe'],
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
    public function search($params,$power)
    {
        $query = Channelthird::find();
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
        ]);

        $query->andFilterWhere(['like', 'channel', $this->channel])
            ->andFilterWhere(['like', 'third', $this->third])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'link', $this->link]);

        $connection = \Yii::$app->db;

        $username = Yii::$app->user->identity->username;
       
        $query->andFilterWhere(['id' => -1]);
        $command = $connection->createCommand('SELECT * FROM auth_assignment WHERE item_name = "cps渠道" or item_name="cpa渠道" or item_name="h5渠道"');
        $result = $command->queryAll();
        foreach ($result as $value) {
            $query->orFilterWhere(['id' => $value["user_id"]]);
        }

        if ($power=="发行商"){
            $query->andFilterWhere(['third' => $username]);
        }

        return $dataProvider;
    }
}
