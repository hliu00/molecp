<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexchannel()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,2);

        return $this->render('indexchannel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            $connection = \Yii::$app->db;
            $h = Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->password_hash=$h;
            $model->auth_key="key";
            $model->password_reset_token="";
            $model->email="xx@xx.com";
            $model->role = 10;
            $model->status=10;
            $model->created_at=0;
            $model->updated_at=0;
            $model->save();

            $id = "".$model->id;
            $created_at = "".$model->created_at;
            $command=$connection->createCommand('INSERT INTO auth_assignment (item_name,user_id,created_at) values("发行商",:user_id,:created_at)');
            $command->bindParam(':user_id', $id);
            $command->bindParam(':created_at', $created_at);
            $result = $command->query();

            return $this->redirect(['view', 'id' => $model->id, 'type' =>1]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'type' => 1
            ]);
        }
    }

    public function actionCreatechannel()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $select = \Yii::$app->request->post('select');
            var_dump($select);
            $connection = \Yii::$app->db;
            $h = Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->password_hash=$h;
            $model->auth_key="key";
            $model->password_reset_token="";
            $model->email="xx@xx.com";
            $model->role = 10;
            $model->status=10;
            $model->created_at=0;
            $model->updated_at=0;
            $model->save();

            $id = "".$model->id;
            $created_at = "".$model->created_at;
            $command=$connection->createCommand('INSERT INTO auth_assignment (item_name,user_id,created_at) values(:select,:user_id,:created_at)');
            $command->bindParam(':user_id', $id);
            $command->bindParam(':created_at', $created_at);
            $command->bindParam(':select', $select);
            $result = $command->query();

            return $this->redirect(['view', 'id' => $model->id, 'type' =>2]);
        }else {
            return $this->render('create', [
                'model' => $model,
                'type' => 2
            ]);
        }
    }
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $h = Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->password_hash=$h;
            $model->auth_key="key";
            $model->password_reset_token="";
            $model->email="xx@xx.com";
            $model->role = 10;
            $model->status=10;
            $model->created_at=0;
            $model->updated_at=0;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        $connection = \Yii::$app->db;
        $connection->createCommand()->delete('auth_assignment', 'user_id = '.$id)->execute();;

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
