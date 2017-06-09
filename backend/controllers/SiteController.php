<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\log\FileTarget;
use yii\behaviors\NoCsrf;
use backend\models\Upload;
use backend\models\Change;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','test','recordsms','recordthird','qzweixin','console','recordsmsandthird','channelinfo','apkchange','createchannel'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'csrf' => [
                'class' => NoCsrf::className(),
                'controller' => $this,
                'actions' => [
                    'test','recordsms','recordthird','qzweixin','console','recordsmsandthird','channelinfo'
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         return Yii::$app->getResponse()->redirect("/molecp/backend/web/admin/user/index");
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            // return $this->goHome();
             return Yii::$app->getResponse()->redirect("/molecp/backend/web/channeladd/index");
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // return $this->goBack();
            if ($this->getPower()=='发行商') {
                return Yii::$app->getResponse()->redirect("/molecp/backend/web/channel/index");
            }else {
                return $this->goHome();
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

     //记录支付宝微信收入
    public function actionRecordthird(){
        $out_trade_no=$this->getValue("out_trade_no");
        $attach=$this->getValue("attach");
        $total_fee=$this->getValue("total_fee");
        $out_transaction_id=$this->getValue("out_transaction_id");
        $createTime=$this->getValue("createTime");
        $type=$this->getValue("type");

        //插入第三方支付记录
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('INSERT INTO tbl_third (out_trade_no,attach,total_fee,out_transaction_id,createTime,type) values(:out_trade_no,:attach,:total_fee,:out_transaction_id,:createTime,:type)');
        $command->bindParam(':out_trade_no', $out_trade_no);
        $command->bindParam(':attach', $attach);
        $command->bindParam(':total_fee',intval($total_fee));
        $command->bindParam(':out_transaction_id', $out_transaction_id);
        $command->bindParam(':createTime', $createTime);
        $command->bindParam(':type', $type);

        $result=$command->query();
        if($result){
            echo 'success';
        }
    }

    //全真微信支付请求拉取
    public function actionQzweixin(){
        $cpId = "10169";   //提供的cpid
        $key = "8699ba3075a39aca06e011642e083838";// 提供的key
       
        $imsi = "460002860109432";
        $imei = "359901053935801";
        $price = "1000";
        $cpChannelId = "";
        $customParam = "";
        $payCodeName = "jifeidian1";
        $appName = "游戏1";
        $signKey = $cpId . $imsi . $imei  . $price . $customParam  . $payCodeName . $appName . $key;
        $sign =  md5($signKey);

        $client_ip = "218.21.128.31";
        $mac = "08:00:20:0A:8C:6D";
        $phone = "";
        $hsman = null;
        $hstype = null;
        $osVer = null;
        $hsman = $hsman == null ? "" : $hsman;
        $hstype = $hstype == null ? "" : $hstype;
        $osVer = $osVer == null ? "" : $osVer;
        $phone = $phone == null ? "" : $phone;


        $reqPath = "http://114.55.249.11:8700/spApi/wechatApiReq.do?cp_id=" . rawurlencode($cpId) . "&imsi=" . rawurlencode($imsi) . "&imei="
                . rawurlencode($imei) . "&price=" . rawurlencode($price) . "&custom_param=" . rawurlencode($customParam) 
                . "&pay_code_name=" . rawurlencode($payCodeName). "&app_name=" . rawurlencode($appName). "&sign=" . rawurlencode($sign)
                ."&client_ip=".  rawurlencode($client_ip) . "&phone=" . rawurlencode($phone). "&mac=" . rawurlencode($mac) 
                . "&hsman=" . rawurlencode($hsman) . "&hstype="  . rawurlencode($hstype) . "&cp_channel_id=". rawurlencode($cpChannelId)  
                . "&os_ver=" . rawurlencode($osVer);

        echo $reqPath;
    }

    public function actionConsole(){
        $today=date("Y-m-d",strtotime("-1 day"));
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
    }

    //记录短信收入
    public function actionRecordsms($price,$channel){
        date_default_timezone_set('PRC'); 
        //插入短信记录
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('INSERT INTO tbl_sms (price,channel,ctime) values(:price,:channel,:ctime)');
        $command->bindParam(':price', intval($price));
        $command->bindParam(':channel', $channel);
        $command->bindParam(':ctime', date('Y-m-d H:i:s',time()));
        $result=$command->query();

        echo date('Y-m-d H:i:s',time());
    }

    public function getValue($key){
        if($_POST)
            if(array_key_exists($key,$_POST))
                return $_POST[$key];
        if(array_key_exists($key,$_GET))
            return $_GET[$key];
        return "null";
    }

    //海豚云支付纪录
    public function actionRecordthird_gd($Sjt_MerchantID,$Sjt_UserName,$Sjt_TransID,$Sjt_Return,$Sjt_Error,$Sjt_factMoney,$Sjt_SuccTime,$Sjt_BType,$Sjt_Sign){
        date_default_timezone_set('PRC'); 
        //插入第三方支付记录
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('INSERT INTO tbl_third (out_trade_no,attach,total_fee,out_transaction_id,createTime,type) values(:out_trade_no,:attach,:total_fee,:out_transaction_id,:createTime,:type)');
        $command->bindParam(':out_trade_no', $Sjt_TransID);
        $command->bindParam(':attach', $Sjt_UserName);
        $command->bindParam(':total_fee',intval($Sjt_factMoney));
        $command->bindParam(':out_transaction_id', $Sjt_TransID);
        $command->bindParam(':createTime', date('Y-m-d H:i:s', $Sit_SuccTime));
        $command->bindParam(':type', $Sjt_BType);

        $result=$command->query();
        if($result){
            echo 'success';
        }
    }

    public function actionRecordsmsandthird(){
        date_default_timezone_set('PRC');
//        $tt = $this->getValue();
        $str = json_encode($_GET);

        Yii::info($str);
        $str = json_encode($_POST);
        Yii::info($str);

        $result = $this->getValue('state');
        if ($result=='success') {
            $connection = \Yii::$app->db;

            $synType = $this->getValue('synType');
            $price = $this->getValue('price');
//        $date=$this->getValue('date');
            $channel = $this->getValue('channelCode');

            if ($synType == 'wiipay') {
                $command = $connection->createCommand('INSERT INTO tbl_sms (price,channel,ctime) values(:price,:channel,:ctime)');
                $command->bindParam(':price', intval($price));
                $command->bindParam(':channel', $channel);
                $command->bindParam(':ctime', date('Y-m-d H:i:s', time()));
                $result = $command->query();

                if ($result) {
                    echo 'success';
                }


            } else if ($synType == 'alipay' || $synType == 'wxpay') {
                $bookNo = $this->getValue('bookNo');
                $Sjt_TransID = "";
                $type = ($synType == "alipay" ? 2 : 1);
                $command = $connection->createCommand('INSERT INTO tbl_third (out_trade_no,attach,total_fee,out_transaction_id,createTime,type) values(:out_trade_no,:attach,:total_fee,:out_transaction_id,:createTime,:type)');
                $command->bindParam(':out_trade_no', $bookNo);
                $command->bindParam(':attach', $channel);
                $command->bindParam(':total_fee', intval($price));
                $command->bindParam(':out_transaction_id', $Sjt_TransID);
                $command->bindParam(':createTime', date('Y-m-d H:i:s', time()));
                $command->bindParam(':type', $type);
                $result = $command->query();

                if ($result) {
                    echo 'success';
                }
            }
        }else {
            echo 'false';
        }
    }

    public function actionChannelinfo($gamename,$channel,$third){
        //数据库查询
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM tbl_channel where gamename=:gamename and name=:channel and third=:third');
        $command->bindParam(':gamename', $gamename);
        $command->bindParam(':channel', $channel);
        $command->bindParam(':third', $third);
        $result=$command->queryAll();
        if(count($result)>0){
            echo json_encode(["clear"=>intval($result[0]["clear"]),"second"=>intval($result[0]["second"])]);
        }
        else{
            echo json_encode(["clear"=>0,"second"=>0]);
        }
    }

    public function actionCreatechannel(){
        $model = new LoginForm();
        if (Yii::$app->request->isPost) {

        }
        return $this->render('createchannel', [
            'model'=> $model,
        ]);
    }

    public function actionTest(){
//        echo Yii::$app->security->generatePasswordHash("123456");

        $downdir = '../../public/apk/new.apk';
//                    echo $downdir;
        Yii::$app->response->sendFile($downdir);
    }

    public function actionApkchange(){
        $model = new Upload();
        $changemodel=new Change();
        $uploadSuccessPath = "";
        if (Yii::$app->request->isPost) {
            $locale='en_US.UTF-8';
            setlocale(LC_ALL,$locale);
            putenv('LC_ALL='.$locale);

            $p = 'sudo rm  -rf ../../public/apk/*';
            exec($p);
            $p = 'sudo rm  -rf ../../public/unzip/*';
            exec($p);
            //文件上传存放的目录
            $basedir = "../../public/apk/";
            if ($model->validate()) {
                $model->file = UploadedFile::getInstance($model, "file");
                if ($model->file==NULL) {
                }else {
                    $fileName = "myapk." . $model->file->extension;
                    $dir = $basedir. $fileName;
                    $model->file->saveAs($dir);
                    $uploadSuccessPath = "../../public/apk/".$fileName;

                    $iconname='null';
                    $name='null';
                    $package='null';
                    $version='null';
                    if ($changemodel->load(Yii::$app->request->post()) && $changemodel->validate()) {
                        $changemodel->icon=UploadedFile::getInstance($changemodel, "icon");
                        if ($changemodel->icon==NULL) {
                        }else {
                            $iconname = "icon." . $changemodel->icon->extension;
                            $dir = $basedir.$iconname;
                            $changemodel->icon->saveAs($dir);
                        }
                        if ($changemodel->name==NULL) {
                        }else {
                            $name = $changemodel->name;
                        }
                        if ($changemodel->package==NULL) {
                        }else {
                            $package = $changemodel->package;
                        }
                        if ($changemodel->version==NULL) {
                        }else {
                            $version = $changemodel->version;
                        }
                    }
                    $program="python3 ../../public/tool.py ".$fileName." ".$package." ".$name." ".$version." ".$iconname;
                    echo $program;
                    $data = exec($program,$a,$b);

                    $downdir = '../../public/apk/'.$data;
//                    echo $downdir;
                    Yii::$app->response->sendFile($downdir);
                }
            }
//            Yii::$app->response->sendFile($dir);
//            echo "apkchange";
//
//

        }

        return $this->render('apkchange', [
            "model" => $model,
            "changemodel"=>$changemodel,
            "uploadSuccessPath" => $uploadSuccessPath,
        ]);

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
