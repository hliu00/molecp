<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
    public function search($params,$type=0)
    {
        $query = User::find();

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
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'role' => $this->role,
//            'status' => $this->status,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ]);
//
//        $query->andFilterWhere(['like', 'username', $this->username])
//            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
//            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
//            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
//            ->andFilterWhere(['like', 'email', $this->email]);

        $connection = \Yii::$app->db;

        if ($type==1) {
            $query->andFilterWhere(['id' => -1]);
            $command = $connection->createCommand('SELECT * FROM auth_assignment WHERE item_name = "发行商"');
            $result = $command->queryAll();
            foreach ($result as $value) {
                $query->orFilterWhere(['id' => $value["user_id"]]);
            }
        }

        if ($type==2) {
            $query->andFilterWhere(['id' => -1]);
            $command = $connection->createCommand('SELECT * FROM auth_assignment WHERE item_name = "cps渠道" or item_name="cpa渠道" or item_name="h5渠道"');
            $result = $command->queryAll();
            foreach ($result as $value) {
                $query->orFilterWhere(['id' => $value["user_id"]]);
            }
        }

        return $dataProvider;
    }
}