<?php

namespace backend\controllers;

use Yii;
use backend\models\Sms;
use backend\models\SmsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SmsController implements the CRUD actions for Sms model.
 */
class SmsController extends Controller
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
     * Lists all Sms models.
     * @return mixed
     */
    public function actionIndex($daytime=0,$enddaytime=0)
    {
        $power=$this->getPower();
         date_default_timezone_set('PRC'); 
        if(!$daytime)
            $daytime=date("Y-m-d",time());
        if(!$enddaytime)
            $enddaytime=date("Y-m-d",time());
        $searchModel = new SmsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$daytime,$enddaytime,$power);
        $totalfee=0;
        foreach ($dataProvider->getModels() as $key => $value) {
            $totalfee+=$value->price;
        }

        $begintime=$daytime." 00:00:00";
        $endtime=$enddaytime." 23:59:59";
        $channel=Yii::$app->user->identity->username;
        // if(date("Y-m-d",time())==$daytime)
        //      $endtime=$daytime." 00:00:00";
        $connection = \Yii::$app->db;
        $command=null;
        if($channel=="admin"){
            $command = $connection->createCommand('select sum(price) as totalprice from tbl_sms where ctime between :begintime and :endtime');
            $command->bindParam(':begintime', $begintime);
            $command->bindParam(':endtime', $endtime);
        }
        else{
            $command = $connection->createCommand('select sum(price) as totalprice from tbl_sms where channel=:channel and ctime between :begintime and :endtime');
            $command->bindParam(':begintime', $begintime);
            $command->bindParam(':endtime', $endtime);
            $command->bindParam(':channel', $channel);
        }
        $result=$command->query();
        $totalfee=$result->read();
        $totalfee=$totalfee['totalprice'];
        if($totalfee==null)
            $totalfee=0;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'daytime'=>$daytime,
            'totalfee'=>$totalfee,
            'enddaytime'=>$enddaytime
        ]);
    }

    /**
     * Displays a single Sms model.
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
     * Creates a new Sms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sms();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sms model.
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
     * Finds the Sms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
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
