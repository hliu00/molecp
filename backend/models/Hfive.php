<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_hfive".
 *
 * @property integer $id
 * @property string $time
 * @property string $content
 * @property string $version
 * @property string $editor
 * @property string $channel
 * @property string $third
 */
class Hfive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_hfive';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'content', 'version', 'editor', 'channel', 'third'], 'required'],
            [['time'], 'safe'],
            [['content'], 'string', 'max' => 255],
            [['version'], 'string', 'max' => 10],
            [['editor', 'channel', 'third'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => '修改日期',
            'content' => '修改内容',
            'version' => '版本号',
            'editor' => '修改者',
            'channel' => '渠道号',
            'third' => '发行商',
        ];
    }
}
