<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Smsthirdadd */

$this->title = '产品收入';
$this->params['breadcrumbs'][] = ['label' => 'Smsthirdadds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->params['pagetitle']='产品收入';
$this->params['pageindex']=7;

?>
<div class="smsthirdadd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
