<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 16/10/13
 * Time: 下午2:59
 */

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

class ForthController  extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex() {

        $connection = \Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM tbl_smsmix');
        $result=$command->queryAll();

        if( $_POST )
        {
            $checkbox1 = \Yii::$app->request->post('checkbox1');
            $checkbox2 = \Yii::$app->request->post('checkbox2');
            $checkbox3 = \Yii::$app->request->post('checkbox3');
            $checkbox4 = \Yii::$app->request->post('checkbox4');
            $checkbox5 = \Yii::$app->request->post('checkbox5');
            $checkbox6 = \Yii::$app->request->post('checkbox6');
//            echo count($checkbox);

            for($n = 0; $n < count($result); $n++) {

                $cotent = json_decode($result[$n]["content"], true);
                $isSelect1 = false;
                for ($i = 0; $i < count($checkbox1); $i++) {
                    if (!is_null($checkbox1[$i])) {
                        if ($result[$n]["id"] == $checkbox1[$i]) {
                            $cotent["1"]["10"] = 1;
                            $isSelect1=true;
                        }
                    }
                }
                if ($isSelect1==false){
                    $cotent["1"]["10"] = 0;
                }

                $isSelect2 = false;
                for ($i = 0; $i < count($checkbox2); $i++) {
                    if (!is_null($checkbox2[$i])) {
                        if ($result[$n]["id"] == $checkbox2[$i]) {
                            $cotent["2"]["10"] = 1;
                            $isSelect2=true;
                        }
                    }
                }
                if ($isSelect2==false){
                    $cotent["2"]["10"] = 0;
                }

                $isSelect3 = false;
                for ($i = 0; $i < count($checkbox3); $i++) {
                    if (!is_null($checkbox3[$i])) {
                        if ($result[$n]["id"] == $checkbox3[$i]) {
                            $cotent["3"]["10"] = 1;
                            $isSelect3=true;
                        }
                    }
                }
                if ($isSelect3==false){
                    $cotent["3"]["10"] = 0;
                }
                $isSelect4 = false;
                for ($i = 0; $i < count($checkbox4); $i++) {
                    if (!is_null($checkbox4[$i])) {
                        if ($result[$n]["id"] == $checkbox4[$i]) {
                            $cotent["1"]["20"] = 1;
                            $isSelect4=true;
                        }
                    }
                }
                if ($isSelect4==false){
                    $cotent["1"]["20"] = 0;
                }
                $isSelect5 = false;
                for ($i = 0; $i < count($checkbox5); $i++) {
                    if (!is_null($checkbox5[$i])) {
                        if ($result[$n]["id"] == $checkbox5[$i]) {
                            $cotent["2"]["20"] = 1;
                            $isSelect5=true;
                        }
                    }
                }
                if ($isSelect5==false){
                    $cotent["2"]["20"] = 0;
                }
                $isSelect6 = false;
                for ($i = 0; $i < count($checkbox6); $i++) {
                    if (!is_null($checkbox6[$i])) {
                        if ($result[$n]["id"] == $checkbox6[$i]) {
                            $cotent["3"]["20"] = 1;
                            $isSelect6=true;
                        }
                    }
                }
                if ($isSelect6==false){
                    $cotent["3"]["20"] = 0;
                }


                $result[$n]["content"] = json_encode($cotent);

                $connection->createCommand()->update('tbl_smsmix', [
                    'content' => $result[$n]["content"],
                ], "id=:id", [
                    ':id' => ($n+1)
                ])->execute();
            }
        }



        return $this->render('index', [
            'result'=>$result
        ]);
    }

    public function actionGetsimsmix($sim,$smix) {
        $connection = \Yii::$app->db;
        $smixs=array("移动"=>1,"电信"=>2,"联通"=>3);
        $command = $connection->createCommand('SELECT * FROM tbl_smsmix WHERE province=:province');
        $command->bindParam(':province', $sim);
        $result = $command->queryOne();
        $obj = json_decode($result["content"],true);
        $back = 10;
        if ($obj[$smixs[$smix]]["20"]==1) {
            $back=20;
        }
        echo $back;
    }

}