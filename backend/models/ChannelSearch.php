<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Channel;

/**
 * ChannelSearch represents the model behind the search form about `app\models\Channel`.
 */
class ChannelSearch extends Channel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['channelId', 'clear', 'second'], 'integer'],
            [['gamename', 'name','third'], 'safe'],
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
        $query = Channel::find();

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
            'channelId' => $this->channelId,
            'clear' => $this->clear,
            'second' => $this->second,
        ]);

        $query->andFilterWhere(['like', 'gamename', $this->gamename])
            ->andFilterWhere(['like', 'name', $this->name]);

        $username=Yii::$app->user->identity->username;
        if ($power=="发行商") {
//            $query->andFilterWhere(['third' => Yii::$app->user->identity->username]);
//            $query->andFilterWhere(['name' => "-1"]);
//            $connection = \Yii::$app->db;
//            $command = $connection->createCommand('SELECT * FROM tbl_channel WHERE third =:third');
//            $command->bindParam(":third",$username);
//            $result = $command->queryAll();
//            foreach ($result as $value) {
                $query->andFilterWhere(['third' => $username]);
//            }
        }


        return $dataProvider;
    }
}
