<?php
namespace backend\models;
use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "tbl_channel".
 *
 * @property string $name
 * @property string $version
 * @property string $package
 */

class Change extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */

    public $icon;

    public static function tableName()
    {
        return 'tbl_upload';
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [["icon"], "file",],
            [["name", "version", "package"], "string"]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名字',
            'version' => '渠道号',
            'package' => '包名',
        ];
    }
}