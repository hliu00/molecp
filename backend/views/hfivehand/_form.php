<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Hfivehand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hfivehand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'channel')->textInput(['maxlength' => true]) ?>

    <?php if ($power=="发行商") { ?>
    <?= $form->field($model, 'third')->textInput(['maxlength' => true, 'readonly' => true , 'value'=>Yii::$app->user->identity->username]) ?>
    <?php }else {?>
    <?= $form->field($model, 'third')->textInput(['maxlength' => true]) ?>
    <?php } ?>
    
    <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
