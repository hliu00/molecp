<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChanneladdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户新增';
$this->params['pagetitle']='用户新增';
$this->params['pageindex']=6;
?>
<div class="channeladd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        $a = null;
            echo Html::a('创建新增', ['create'], ['class' => 'btn btn-success']);
        $a =  [
            'channel',
            'count',
            'time',
            ['class' => 'yii\grid\ActionColumn'],
        ];
        ?>
    </p>
    <div style="margin-bottom: 5px;line-height:30px;height:50px; ">
        <a style="float: left;font-size: 20px;margin-right: 10px;text-decoration:none;">查询日期: </a>
        <div style="width:220px;float:left;">
            <?= DatePicker::widget([
                'id'=>'daytime',
                'name' => '',
                'value' =>$daytime,
                'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
        </div>
        <div style="width:220px;float:left;">
            <a style="float:left;margin-left:10px;margin-right: 10px">到</a>
            <?= DatePicker::widget([
                'id'=>'enddaytime',
                'name' => '',
                'value' =>$enddaytime,
                'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
        </div>
        <a class="btn btn-success"  style="float:left;color:white;margin-left:10px" onclick="window.location.href= '/molecp/backend/web/channeladd/index?daytime='+$('#daytime').val()+'&enddaytime='+$('#enddaytime').val()">查询数据</a>
    </div>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => $a,
    ]); ?>

</div>
