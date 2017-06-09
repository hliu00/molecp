<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_newuser".
 *
 * @property integer $id
 * @property string $time
 * @property integer $count
 */
class Newuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_newuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'count'], 'required'],
            [['time'], 'safe'],
            [['count'], 'integer']
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
            'count' => '数量',
        ];
    }
}
