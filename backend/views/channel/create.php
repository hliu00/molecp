<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Channel */

$this->title = '创建控制';
$this->params['breadcrumbs'][] = ['label' => 'Channels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'power' => $power,
    ]) ?>

</div>
