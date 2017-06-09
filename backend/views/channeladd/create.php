<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Channeladd */


$this->params['pagetitle']='用户新增';
$this->params['pageindex']=6;
$this->title = '用户新增';
?>
<div class="channeladd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
