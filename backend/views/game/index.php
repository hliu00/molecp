<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TblGameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '游戏列表';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/molecp/backend/web/css/site.css',['depends' => ['frontend\assets\AppAsset'],'position' => \yii\web\View::POS_HEAD]);

$cssString = "
td {
    vertical-align:middle!important;
}
";
$this->registerCss($cssString);

?>
<div class="tbl-game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建游戏', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'publisher_name',
            'game_name',
            'update_time:datetime',

            [
                'format'=>'raw',
                'value' => function($data){
                    $url = "../site/apkchange?gamename=".$data->game_name."&publisher=".$data->publisher_name;
                    return Html::a('<span class="btn btn-default" style="height: auto;font-size: 9px;">打包</span>', $url, ['title' => '审核']);
                }
            ],
            [
                'format'=>'raw',
                'value' => function($data){
                    $url = "../site/apkchange?gamename=".$data->game_name."&publisher=".$data->publisher_name;
                    return Html::a('<span class="btn btn-default" style="height: auto;font-size: 9px;">上传母包</span>', $url, ['title' => '审核']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
