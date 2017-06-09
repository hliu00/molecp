<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TblGame */

$this->title = '更新游戏: ' . $model->game_name;
$this->params['breadcrumbs'][] = ['label' => '游戏列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->game_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="tbl-game-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
