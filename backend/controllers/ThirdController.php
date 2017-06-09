<?php

namespace backend\controllers;

use Yii;
use backend\models\Third;
use backend\models\ThirdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ThirdController implements the CRUD actions for Third model.
 */
class ThirdController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Third models.
     * @return mixed
     */
    public function actionIndex($daytime=0,$enddaytime=0)
    {

        $power = $this->getPower();
        date_default_timezone_set('PRC'); 
        if(!$daytime)
            $daytime=date("Y-m-d",time());
        if(!$enddaytime)
            $enddaytime=date("Y-m-d",time());
        $searchModel = new ThirdSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$daytime,$enddaytime,$power);
        $models = $dataProvider->getModels();
        $totalfee=0;
        foreach ($dataProvider->getModels() as $key => $value) {
            $totalfee+=$value->total_fee;
        }

        $begintime=$daytime." 00:00:00";
        $endtime=$enddaytime." 23:59:59";
        $channel=Yii::$app->user->identity->username;
        $connection = \Yii::$app->db;
        $command=null;
        if($channel=="admin"){
            $command = $connection->createCommand('select sum(total_fee) as totalprice from tbl_third where createTime between :begintime and :endtime');
            $command->bindParam(':begintime', $begintime);
            $command->bindParam(':endtime', $endtime);
        }
        else{
            $temp=$channel.'%';
            $command = $connection->createCommand("select sum(total_fee) as totalprice from tbl_third where attach like :channel and createTime between :begintime and :endtime");
            $command->bindParam(':begintime', $begintime);
            $command->bindParam(':endtime', $endtime);
            $command->bindParam(':channel',$temp);
        }
        $result=$command->query();
        $totalfee=$result->read();
        $totalfee=$totalfee['totalprice'];
        if($totalfee==null)
            $totalfee=0;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'daytime'=> $daytime,
            'totalfee'=>$totalfee,
            'enddaytime' =>$enddaytime
        ]);
    }

    /**
     * Displays a single Third model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Third model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Third();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orderId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Third model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orderId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Third model.
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
     * Finds the Third model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Third the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Third::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function getPower(){
        $connection = \Yii::$app->db;
        $username = Yii::$app->user->identity->username;
        $usecommand = $connection->createCommand('SELECT * FROM user WHERE username=:username ');
        $usecommand->bindParam(':username',$username);
        $useresult = $usecommand->queryOne();
        $powercommand = $connection->createCommand('SELECT * FROM auth_assignment WHERE user_id=:user_id ');
        $powercommand->bindParam(':user_id', $useresult["id"]);
        $powerresult=$powercommand->queryOne();
        return $powerresult["item_name"];
    }
}
