<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Channeladd */

$this->title = 'Update 用户新增: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Channeladds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->params['pagetitle']='用户新增';
$this->params['pageindex']=6;

?>
<div class="channeladd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
