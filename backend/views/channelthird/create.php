<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Channelthird */

$this->title = '创建渠道';
$this->params['breadcrumbs'][] = ['label' => 'Channelthirds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channelthird-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'power' => $power,
        'type' => "1",
    ]) ?>

</div>
