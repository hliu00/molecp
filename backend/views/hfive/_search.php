<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HfiveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hfive-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'version') ?>

    <?= $form->field($model, 'editor') ?>

    <?php // echo $form->field($model, 'channel') ?>

    <?php // echo $form->field($model, 'third') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
