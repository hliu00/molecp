<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2016/12/1
 * Time: 下午2:21
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = '数据库';

?>

<div class="sql-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <p>
        <?= Html::a('还原数据', ['restore'], ['class' => 'btn btn-success']) ?>
    </p>
    <br>
    <p>
        <?= Html::a('备份数据', ['backup'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
