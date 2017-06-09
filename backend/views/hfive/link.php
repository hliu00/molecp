<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2016/11/4
 * Time: 下午4:49
 */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '推广链接';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="hfive-link">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'channel',
            'link',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
