<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Channel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="channel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($power=="发行商") { ?>
        <?= $form->field($model, 'third')->textInput(['maxlength' => true, 'readonly' => true , 'value'=>Yii::$app->user->identity->username]) ?>
    <?php }else {?>
        <?= $form->field($model, 'third')->textInput(['maxlength' => true]) ?>
    <?php } ?>

    <?= $form->field($model, 'gamename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clear')->dropDownList(['0'=>'关闭','1'=>'开启']) ?>

    <?= $form->field($model, 'second')->dropDownList(['0'=>'关闭','1'=>'开启']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
