<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Channelthird */

$this->title = '修改渠道: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Channelthirds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="channelthird-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'power' => $power,
        'type' => $type,
    ]) ?>

</div>
