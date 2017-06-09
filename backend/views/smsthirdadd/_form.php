<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Smsthirdadd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smsthirdadd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sms')->textInput() ?>

    <?= $form->field($model, 'third')->textInput() ?>

    <?= $form->field($model, 'channel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
