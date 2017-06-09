<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Channelthird */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="channelthird-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'channel')->textInput(['maxlength' => true]) ?>
    <?php if ($power=="发行商") { ?>
        <?= $form->field($model, 'third')->textInput(['maxlength' => true, 'readonly' => true , 'value'=>Yii::$app->user->identity->username]) ?>
    <?php }else {?>
        <?= $form->field($model, 'third')->textInput(['maxlength' => true]) ?>
    <?php } ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <div class="form-group">

        <p style="font-size:15px;font-weight:bold;">
            渠道类别
        </p>
        <p>
            <select name="select" style="height:35px;width:90px" >
                <option value="cps渠道" <?php if ($type=='cps渠道') echo 'selected'?>>cps渠道</option>
                <option value="cpa渠道" <?php if ($type=='cpa渠道') echo 'selected'?>>cpa渠道</option>
                <option value="h5渠道" <?php if ($type=='h5渠道') echo 'selected'?>>h5渠道</option>
            </select>
        </p>

        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
