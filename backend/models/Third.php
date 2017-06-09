<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_third".
 *
 * @property integer $orderId
 * @property string $out_trade_no
 * @property string $attach
 * @property string $out_transaction_id
 * @property integer $total_fee
 * @property integer $type
 * @property string $createTime
 */
class Third extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_third';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['out_trade_no', 'attach', 'out_transaction_id', 'total_fee', 'type', 'createTime'], 'required'],
            [['total_fee', 'type'], 'integer'],
            [['out_trade_no'], 'string', 'max' => 1024],
            [['attach', 'out_transaction_id', 'createTime'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderId' => 'Order ID',
            'out_trade_no' => '订单号',
            'attach' => '渠道号',
            'out_transaction_id' => '商户订单号',
            'total_fee' => '金额（元）',
            'type' => '支付类型',
            'createTime' => '支付时间',
        ];
    }
}
