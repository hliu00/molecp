<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Hfivehand */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '更新数据', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hfivehand-view">

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
//            'id',
            'channel',
            'third',
            'time',
            'count',
        ],
    ]) ?>

</div>
