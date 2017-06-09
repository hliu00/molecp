<?php

use yii\helpers\Html;
use yii\grid\GridView;;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '每日新增';
$this->params['pagetitle']='每日新增';
$this->params['pageindex']=5;
$this->title = '每日新增';
?>
<div class="newuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div style="margin-bottom: 5px;line-height:30px;height:50px; ">
        <a style="float: left;font-size: 20px;margin-right: 10px;">查询日期: </a>
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

        <a class="btn btn-success"  style="float:left;color:white;margin-left:10px" onclick="window.location.href= '/moke_server/backend/web/index.php?r=newuser/index&daytime='+$('#daytime').val()+'&enddaytime='+$('#enddaytime').val()">查询数据</a>
    </div>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'time',
            'count',

        ],
    ]); ?>

</div>
