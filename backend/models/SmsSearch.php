<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sms;

/**
 * SmsSearch represents the model behind the search form about `backend\models\Sms`.
 */
class SmsSearch extends Sms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'price'], 'integer'],
            [['channel', 'ctime'], 'safe'],
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
        $query = Sms::find();

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
            'sid' => $this->sid,
            'price' => $this->price,
            'ctime' => $this->ctime,
        ]);

        $query->andFilterWhere(['like', 'channel', $this->channel]);

        $username=Yii::$app->user->identity->username;
        if ($power=='发行商') {

            $query->andFilterWhere(['channel' => "-1"]);
            $connection = \Yii::$app->db;
            $command = $connection->createCommand('SELECT * FROM tbl_channelthird WHERE third =:third');
            $command->bindParam(":third",$username);
            $result = $command->queryAll();
            foreach ($result as $value) {
                $query->orFilterWhere(['channel' => $value["channel"]]);
            }
        }
        if ($power=="cps渠道"||$power=="cpa渠道"||$power=="h5渠道"){
            $query->andFilterWhere(['channel' => $username]);
        }

        if($daytime!=0)
        {

                $query->andFilterWhere(['between', 'ctime', $daytime.' 00:00:00', $enddaytime.' 23:59:59'])->all();
        }
        return $dataProvider;
    }
}
