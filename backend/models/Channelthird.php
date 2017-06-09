<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_channelthird".
 *
 * @property integer $id
 * @property string $channel
 * @property string $third
 * @property string $password
 * @property string $link
 */
class Channelthird extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_channelthird';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['channel', 'third', 'password'], 'required'],
            [['channel', 'third'], 'string', 'max' => 50],
            [['password','link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel' => '渠道账号',
            'third' => '发行商',
            'password' => '密码',
            'link' => '链接',
        ];
    }
}
