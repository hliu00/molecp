<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Channelthird */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Channelthirds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channelthird-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'channel',
            'third',
            [
                'label'=> '渠道类型',
                'value'=> $_GET["type"],
            ],
        ],
    ]) ?>


</div>
