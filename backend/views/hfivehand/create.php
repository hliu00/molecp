<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Hfivehand */

$this->title = '创建数据';
$this->params['breadcrumbs'][] = ['label' => '更新数据', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hfivehand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'power' => $power,
    ]) ?>

</div>
