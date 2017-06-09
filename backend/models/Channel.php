<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_channel".
 *
 * @property integer $channelId
 * @property string $gamename
 * @property string $name
 * @property integer $clear
 * @property integer $second
 */
class Channel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gamename'], 'required'],
            [['clear', 'second'], 'integer'],
            [['gamename', 'name','third'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'channelId' => 'ID',
            'gamename' => '游戏名',
            'name' => '渠道名',
            'clear' => '开启清晰计费',
            'second' => '开启二次弹框',
            'third' => '发行商',
        ];
    }
}
