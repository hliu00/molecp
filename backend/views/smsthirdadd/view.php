<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Smsthirdadd */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Smsthirdadds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['pagetitle']='产品收入';
$this->params['pageindex']=7;
?>
<div class="smsthirdadd-view">

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
            'sms',
            'third',
            'channel',
            'time',
        ],
    ]) ?>

</div>
