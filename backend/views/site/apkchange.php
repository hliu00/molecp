<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChannelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'apk包修改';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/molecp/backend/web/css/site.css',['depends' => ['frontend\assets\AppAsset'],'position' => \yii\web\View::POS_HEAD]);
?>
<div class="apkchange-box">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"upload_label\">{input}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <div class="apkchange_upload_akp">
        <?php
        echo $form->field($model, 'file',[])->fileInput([
//'accept' => 'image/*',
            'value' => 'null',
            'options' => [],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'browseLabel' => '选择文件',
                'removeLabel' => '移除',
                'mainClass' => 'input-group-lg',
            ],
        ]);
        ?>
    </div>
    <div class="apkchange_upload_icon" style="padding-top: 10px;">
<!--        <div >-->
            <?php
            echo $form->field($changemodel, 'icon',[])->fileInput([
                'value' => 'null',
                'accept' => 'image/png',
                'options' => [],//'accept' => 'image/*'
                'pluginOptions' => [
//                'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseLabel' => '选择icon',
                    'removeLabel' => '移除',
                    'mainClass' => 'input-group-lg',
                    'initialPreviewAsData'=>true,
                    'overwriteInitial'=>false,
                    'previewFileType' => 'image/*',
                ],
            ]);
            ?>
        </div>
    </div>
    <div style="">
        <?= $form->field($changemodel, 'name')->textInput([]) ?>
        <?= $form->field($changemodel, 'version')->textInput([]) ?>
        <?= $form->field($changemodel, 'package')->textInput([]) ?>
    </div>
    <button class="btn btn-success">确定</button>

    <?php ActiveForm::end(); ?>
    

    <script type=text/javascript>
        $(function() {
            $('#calculate').click(function(){
//                $.ajax({
//                    url: '/add',
//                    data:{
//                        a: $('#a').val(),
//                        b: $('#b').val()
//                    },
//                    dataType: 'JSON',
//                    type: 'GET',
//                    success: function(data){
//                        $("#result").html(data.result);
//                    }
//                });
                

            });
        });
    </script>
</div>

