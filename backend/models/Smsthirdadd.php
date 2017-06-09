<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_smsthirdadd".
 *
 * @property integer $id
 * @property integer $sms
 * @property integer $third
 * @property string $channel
 * @property string $time
 */
class Smsthirdadd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_smsthirdadd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sms', 'third', 'channel', 'time'], 'required'],
            [['sms', 'third'], 'integer'],
            [['time'], 'safe'],
            [['channel'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sms' => '短信',
            'third' => '第三方',
            'channel' => '渠道',
            'time' => '时间',
        ];
    }
}
