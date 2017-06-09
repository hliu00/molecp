<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Smsthirdadd */

$this->title = 'Update 产品收入: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Smsthirdadds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->params['pagetitle']='产品收入';
$this->params['pageindex']=7;
?>
<div class="smsthirdadd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
