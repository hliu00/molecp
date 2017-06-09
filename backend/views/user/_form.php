<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label("账号：") ?>


    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true])->label("密码：") ?>

    
    <div class="form-group">
        <?php if ( isset($type) && $type==2) { ?>
<!--            -->
<!--            <p>-->
<!--                <select name="select" style="height:35px;width:90px">-->
<!--                    <option value="cps渠道">cps渠道</option>-->
<!--                    <option value="cpa渠道">cpa渠道</option>-->
<!--                    <option value="h5渠道">h5渠道</option>-->
<!--                </select>-->
<!--            </p>-->
        <?php } ?>

        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
