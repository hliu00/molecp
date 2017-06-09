<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_hfivehand".
 *
 * @property integer $id
 * @property string $time
 * @property string $channel
 * @property string $third
 * @property integer $count
 */
class Hfivehand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_hfivehand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'channel', 'third', 'count'], 'required'],
            [['time'], 'safe'],
            [['count'], 'integer'],
            [['channel', 'third'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => '时间',
            'channel' => '渠道号',
            'third' => '发行商',
            'count' => '收益',
        ];
    }
}
