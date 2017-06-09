<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Third;

/**
 * ThirdSearch represents the model behind the search form about `backend\models\Third`.
 */
class ThirdSearch extends Third
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'total_fee', 'type'], 'integer'],
            [['out_trade_no', 'attach', 'out_transaction_id', 'createTime'], 'safe'],
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
        date_default_timezone_set('PRC'); 
        $query = Third::find();

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
            'orderId' => $this->orderId,
            'total_fee' => $this->total_fee,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'out_trade_no', $this->out_trade_no])
            ->andFilterWhere(['like', 'attach', $this->attach])
            ->andFilterWhere(['like', 'out_transaction_id', $this->out_transaction_id])
            ->andFilterWhere(['like', 'createTime', $this->createTime]);

        $username=Yii::$app->user->identity->username;
        if ($power=="发行商") {
//            $query->andFilterWhere(['third' => Yii::$app->user->identity->username]);
            $query->andFilterWhere(['attach' => "-1"]);
            $connection = \Yii::$app->db;
            $command = $connection->createCommand('SELECT * FROM tbl_channelthird WHERE third =:third');
            $command->bindParam(":third",$username);
            $result = $command->queryAll();
            foreach ($result as $value) {
                $query->orFilterWhere(['attach' => $value["channel"]]);
            }
        }
//
        if ($power=="cps渠道"||$power=="cpa渠道"||$power=="h5渠道"){
            $query->andFilterWhere(['attach' => $username]);
        }

        if($daytime!=0)
        {
            $query->andFilterWhere(['between', 'createTime', $daytime.' 00:00:00', $enddaytime.' 23:59:59'])->all();
        }

        return $dataProvider;
    }
}
