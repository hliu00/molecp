<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2016/12/1
 * Time: 下午2:20
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SqlController extends Controller {
    public function actionIndex(){

        return $this->render('index', [
        ]);
    }
    
    public function actionBackup(){

        return $this->render('backup', [
        ]);
    }

    public function actionBack() {

        return $this->render('index', [
        ]);
    }

    public function actionRestore() {
        return $this->render('restore', [
        ]);
    }
}