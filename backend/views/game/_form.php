<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TblGame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publisher_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'game_name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
