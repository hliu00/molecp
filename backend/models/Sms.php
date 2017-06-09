<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sms".
 *
 * @property integer $sid
 * @property integer $price
 * @property string $channel
 * @property string $ctime
 */
class Sms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'channel', 'ctime'], 'required'],
            [['price'], 'integer'],
            [['ctime'], 'safe'],
            [['channel'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sid' => 'id',
            'price' => '金额(元)',
            'channel' => '渠道号',
            'ctime' => '支付时间',
        ];
    }
}
