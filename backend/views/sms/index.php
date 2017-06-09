<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '短信支付';
$this->params['pagetitle']='短信支付';
$this->params['pageindex']=2;
$this->title = '短信支付';
?>
<div class="sms-index">

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
        <a class="btn btn-success"  style="float:left;color:white;margin-left:10px" onclick="window.location.href= '/molecp/backend/web/sms/index?daytime='+$('#daytime').val()+'&enddaytime='+$('#enddaytime').val()">查询数据</a>
        <a style="float: left;font-size: 20px;margin-left: 30px;text-decoration:none;">当日总额：</a>
        <a style="float: left;font-size: 25px;margin-left: 0px;text-decoration:none;color:green"><?php echo $totalfee;?></a>
    </div>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'sid',
            'price',
            'channel',
            'ctime',
        ],
    ]); ?>

</div>
