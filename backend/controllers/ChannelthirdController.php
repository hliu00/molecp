<?php

namespace backend\controllers;

use Yii;
use backend\models\Channelthird;
use backend\models\ChannelthirdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;

/**
 * ChannelthirdController implements the CRUD actions for Channelthird model.
 */
class ChannelthirdController extends Controller
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
     * Lists all Channelthird models.
     * @return mixed
     */
    public function actionIndex()
    {

        $power = $this->getPower();
        $searchModel = new ChannelthirdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$power);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Channelthird model.
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
     * Creates a new Channelthird model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $power = $this->getPower();
        $model = new Channelthird();

        if ($model->load(Yii::$app->request->post()) ) {

            $connection = \Yii::$app->db;

            $usermodel = new User();
            $h = Yii::$app->security->generatePasswordHash($model->password);

            $usermodel->username=$model->channel;
            $usermodel->password_hash=$h;
            $usermodel->auth_key="key";
            $usermodel->password_reset_token="";
            $usermodel->email="xx@xx.com";
            $usermodel->role = 10;
            $usermodel->status=10;
            $usermodel->created_at=0;
            $usermodel->updated_at=0;
            $usermodel->save();

            $third =$model->third;
            $thirdcommand=$connection->createCommand('SELECT * FROM user WHERE username=:username');
            $thirdcommand->bindParam(':username', $third);
            $result=$thirdcommand->queryOne();

            $model->id = $usermodel->id;
            $model->password=$h;

            $select = \Yii::$app->request->post('select');


            $model->link='118.184.179.44/'.$result["id"].'/'.$usermodel->id.'/cp.html';
            $model->save();


            $id = "".$usermodel->id;
            $created_at = "".$usermodel->created_at;
            $command=$connection->createCommand('INSERT INTO auth_assignment (item_name,user_id,created_at) values(:select,:user_id,:created_at)');
            $command->bindParam(':user_id', $id);
            $command->bindParam(':created_at', $created_at);
            $command->bindParam(':select', $select);
            $result = $command->query();

            return $this->redirect(['view', 'id' => $model->id , 'type'=>$select]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'power' => $power,
            ]);
        }
    }

    /**
     * Updates an existing Channelthird model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $power = $this->getPower();

        if ($model->load(Yii::$app->request->post()) ) {

            $usermodel =  User::findOne($model->id);
            if ($usermodel != null) {
                $usermodel->username=$model->channel;
                if ($usermodel->password_hash !== $model->password) {
                    $h = Yii::$app->security->generatePasswordHash($model->password);
                    $usermodel->password_hash=$h;
                    $model->password=$h;
                }
                $usermodel->save();

                $select = \Yii::$app->request->post('select');
                $connection = \Yii::$app->db;
                $id = "".$usermodel->id;
                $created_at = "".$usermodel->created_at;
                $command=$connection->createCommand()->update('auth_assignment', array(
                    'created_at'=>$created_at,
                    'item_name'=>$select,
                ), "user_id='{$id}'")->execute();

            }
            $third =$model->third;
            $thirdcommand=$connection->createCommand('SELECT * FROM user WHERE username=:username');
            $thirdcommand->bindParam(':username', $third);
            $result=$thirdcommand->queryOne();

            $model->link='118.184.179.44/'.$result["id"].'/'.$usermodel->id.'/cp.html';
            $model->save();

            return $this->redirect(['view', 'id' => $model->id, 'type'=>$select]);
        } else {
            $usermodel =  User::findOne($model->id);
            if ($usermodel != null) {
                $connection = \Yii::$app->db;
                $id = "".$usermodel->id;
                $command=$connection->createCommand('SELECT * FROM auth_assignment WHERE user_id=:user_id');
                $command->bindParam(':user_id', $id);
                $result=$command->queryOne();

            }
            return $this->render('update', [
                'model' => $model,
                'power' => $power,
                'type' => $result['item_name'],
            ]);
        }
    }

    /**
     * Deletes an existing Channelthird model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if (($model = User::findOne($id)) !== null) {
            $model->delete();
        }
        $connection = \Yii::$app->db;
        $command = $connection->createCommand()
        ->delete('auth_assignment', "user_id=:user_id", array(
            ':user_id' => $id,
        ))->execute();

        $command = $connection->createCommand()
            ->delete('tbl_channelthird', "id=:id", array(
                ':id' => $id,
            ))->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Channelthird model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Channelthird the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Channelthird::findOne($id)) !== null) {
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
