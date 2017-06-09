<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_channeladd".
 *
 * @property integer $id
 * @property string $channel
 * @property integer $count
 * @property string $time
 */
class Channeladd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_channeladd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['channel', 'count', 'time'], 'required'],
            [['count'], 'integer'],
            [['time'], 'safe'],
            [['channel'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel' => '渠道号',
            'count' => '用户新增',
            'time' => '日期',
        ];
    }
}
