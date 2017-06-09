<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ThirdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="third-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'orderId') ?>

    <?= $form->field($model, 'out_trade_no') ?>

    <?= $form->field($model, 'attach') ?>

    <?= $form->field($model, 'out_transaction_id') ?>

    <?= $form->field($model, 'total_fee') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'createTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
