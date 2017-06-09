<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Channel */

$this->title = '更新控制: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->channelId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="channel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'power' => $power,
    ]) ?>

</div>
