<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_game".
 *
 * @property integer $id
 * @property string $publisher_name
 * @property string $game_name
 * @property integer $update_time
 */
class TblGame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publisher_name', 'game_name', 'update_time'], 'required'],
            [['update_time'], 'integer'],
            [['publisher_name'], 'string', 'max' => 255],
            [['game_name'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publisher_name' => '发行商',
            'game_name' => '游戏名称',
            'update_time' => '母包更新时间',
        ];
    }
}
