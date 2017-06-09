<?php

namespace backend\controllers;

use Yii;
use backend\models\Newuser;
use backend\models\NewuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewuserController implements the CRUD actions for Newuser model.
 */
class NewuserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Newuser models.
     * @return mixed
     */
    public function actionIndex($daytime=0,$enddaytime=0)
    {
        echo Yii::$app->security->generatePasswordHash("test");

        if(!$daytime)
            $daytime=date("Y-m-d",time());
        if(!$enddaytime)
            $enddaytime=date("Y-m-d",time());


        $today=date("Y-m-d",time());
        $connection = \Yii::$app->db;
        $command=null;
        $command = $connection->createCommand('SELECT * FROM tbl_newuser WHERE time=:time');
        $command->bindParam(":time", $today);
        $result=$command->queryAll();
        if (count($result)>0)
            $result=$result[0]['count'];
        else
            $result=null;


        $begintime=$today." 00:00:00";
        $endtime=$today." 23:59:59";
        $commadsms = $connection->createCommand('SELECT * FROM tbl_sms where ctime between :begintime and :endtime');
        $commadsms->bindParam(':begintime', $begintime);
        $commadsms->bindParam(':endtime', $endtime);
        $resultsms = $commadsms->queryAll();

        $commadthird = $connection->createCommand('SELECT * FROM tbl_third where createTime between :begintime and :endtime');
        $commadthird->bindParam(':begintime', $begintime);
        $commadthird->bindParam(':endtime', $endtime);
        $resultthird = $commadthird->queryAll();

        $r = (count($resultsms)*0.36+count($resultthird)*0.8)/(2.3+rand(0,50)/100);
        if ($result!=null) {
            if ($result>$r) {
                $r = $result;
            }
            $connection->createCommand()->update('tbl_newuser', [
                'count' => $r,
            ], "time=:time", [
                ':time' => $today
            ])->execute();
        }else {

            $command=$connection->createCommand('INSERT INTO tbl_newuser (time,count) values(:time,:count)');
            $command->bindParam(':time', $today);
            $command->bindParam(':count',intval($r));
            $result=$command->query();
        }

        $searchModel = new NewuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$daytime,$enddaytime);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'daytime' => $daytime,
            'enddaytime' => $enddaytime
        ]);
    }

    /**
     * Displays a single Newuser model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new Newuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Newuser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing Newuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Newuser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Newuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Newuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Newuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
