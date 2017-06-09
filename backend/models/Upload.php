<?php
namespace backend\models;
use Yii;
use yii\web\UploadedFile;
class Upload extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */

    public $file;

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
            [["file"], "file",],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => '选择apk',
        ];
    }
}