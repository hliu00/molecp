<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2016/12/1
 * Time: 下午2:43
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '还原';

?>

<div class="sql-backup">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <br>
    <p>
        <?= Html::a('返回', ['back'], ['class' => 'btn btn-success']) ?>
    </p>
</div>