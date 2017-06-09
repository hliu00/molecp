<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Channeladd */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Channeladds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$this->params['pagetitle']='用户新增';
$this->params['pageindex']=6;

?>
<div class="channeladd-view">

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
            'count',
            'time',
        ],
    ]) ?>

</div>
