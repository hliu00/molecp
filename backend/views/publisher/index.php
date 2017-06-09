<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '发行商管理';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/molecp/backend/web/css/site.css',['depends' => ['frontend\assets\AppAsset'],'position' => \yii\web\View::POS_HEAD]);


?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建发行商', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            // 'email:email',
//             'role',
            // 'status',
             'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
