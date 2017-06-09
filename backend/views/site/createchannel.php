<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;


$this->title = '注册发行商';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/molecp/backend/web/css/site.css',['depends' => ['frontend\assets\AppAsset'],'position' => \yii\web\View::POS_HEAD]);

?>

<div class="createchannel-page">
    <h2><?= Html::encode($this->title) ?></h2>

    <div class="smsthirdadd-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form
            ->field($model, 'username')
        ?>
        <?= $form
            ->field($model, 'password') ?>
        <div class="row">
        <div class="col-xs-4">
            <?= Html::submitButton('注册', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'register-button']) ?>
        </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
