<?php

namespace backend\controllers;

use Yii;
use backend\models\Hfive;
use backend\models\HfiveSearch;
use backend\models\LinkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HfiveController implements the CRUD actions for Hfive model.
 */
class HfiveController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Hfive models.
     * @return mixed
     */
    public function actionIndex($daytime=0,$enddaytime=0)
    {
        $power = $this->getPower();
        if(!$daytime)
            $daytime=date("Y-m-d",strtotime("-3 day"));
        if(!$enddaytime)
            $enddaytime=date("Y-m-d",strtotime("-1 day"));
        $searchModel = new HfiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$daytime,$enddaytime,$power);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'daytime' => $daytime,
            'enddaytime' => $enddaytime,
        ]);
    }

    public function actionLink() {
        $power = $this->getPower();
        $searchModel = new LinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$power);

        return $this->render('link', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Hfive model.
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
     * Creates a new Hfive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hfive();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hfive model.
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
     * Deletes an existing Hfive model.
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
     * Finds the Hfive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hfive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hfive::findOne($id)) !== null) {
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
