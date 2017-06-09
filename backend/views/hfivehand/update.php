<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hfivehand */

$this->title = '更新数据: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '更新数据', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hfivehand-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'power' => $power
    ]) ?>

</div>
