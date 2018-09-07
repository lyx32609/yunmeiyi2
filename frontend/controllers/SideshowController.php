<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\SideShow;

/**
 * Site controller
 */
class SideshowController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}else{
    		$passes = Yii::$app->request->queryParams;
    	}
    	$SideShow=array();
    	if(!$passes){
    		//无请求参数
    		$SideShow['code']="10002";
    		$SideShow['msg']="请求参数错误";
    		$SideShow['data']=array();
    	}else{
    		$SideShowone=SideShow::find()->asArray()->all();
    		if(is_array($SideShowone) && count($SideShowone)>0)
    		{
    			$SideShow['code']="10001";
    			$SideShow['msg']="请求成功";
    			$SideShow['data']=$SideShowone;
    		}else{
    			$SideShow['code']="10003";
    			$SideShow['msg']="请求失败,数据为空";
    			$SideShow['data']=array();
    		}
    	}
    	return \yii\helpers\Json::encode($SideShow);
		
    }
    
    public function actionEdit(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$SideShow=array();
    	if(!$passes){
    		$SideShow['code']="10002";
    		$SideShow['msg']="请求参数错误";
    		$SideShow['data']=array();
    		return \yii\helpers\Json::encode($SideShow);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$SideShowmodel=new SideShow();
    		if($SideShowmodel->load(yii::$app->getRequest()->post(),'')
    		&& $SideShowmodel->validate() && $SideShowmodel->save()){
    			$newps=SideShow::find()->where(['SideShowID'=>$passes['SideShowID']])->asArray()->one();
    			$SideShow['code']="10001";
    			$SideShow['msg']="修改成功";
    			$SideShow['data']=$newps;
    		}else{
    			$msgarr=$SideShowmodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$newps=SideShow::find()->where(['SideShowID'=>$passes['SideShowID']])->asArray()->one();
    			$SideShow['code']="10003";
    			$SideShow['msg']="修改失败,".$msg;
    			$SideShow['data']=$newps;
    		}
    		return \yii\helpers\Json::encode($SideShow);
    	}
    }

    //添加
    public function actionAdd(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$SideShow=array();
    	if(!$passes){
    		$SideShow['code']="10002";
    		$SideShow['msg']="请求参数错误";
    		$SideShow['data']=array();
    		return \yii\helpers\Json::encode($SideShow);
    	}else{
    		$SideShowmodel=new SideShow();
    		//$SideShowmodel->SideShowName=$passes['SideShowName'];银行编码名称注册姓名是用户的姓名
    		if(//$SideShowmodel->load(yii::$app->getRequest()->post(),'') &&
    		//$SideShowmodel->load($arr,'') &&
    		$SideShowmodel->validate() && $SideShowmodel->save()){
    			$SideShow['code']="10001";
    			$SideShow['msg']="添加成功";
    			$SideShow['data']=[];
    		}else{
    			$msgarr=$SideShowmodel->getErrors();
    			$msg=reset($msgarr)[0];//echo $msg;
    			$SideShow['code']="10003";
    			$SideShow['msg']=$msg;
    			$SideShow['data']=array();
    			return \yii\helpers\Json::encode($SideShow);
    		}
    		return \yii\helpers\Json::encode($SideShow);
    	}
    }
    //删除
    public function actionDel(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$SideShow=array();
    	if(!$passes){
    		$SideShow['code']="10002";
    		$SideShow['msg']="请求参数错误";
    		$SideShow['data']=array();
    		return \yii\helpers\Json::encode($SideShow);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$SideShowmodel=new SideShow();
    		$SideShowmodel->Status=1;//用户状态0正常1删除
    		$SideShowmodel->UpdateTime=date('Y-m-d H:i:s',time());
    		if($SideShowmodel->validate() && $SideShowmodel->save()){
    			$SideShow['code']="10001";
    			$SideShow['msg']="注销成功";
    			$SideShow['data']=array();
    		}else{
    			$msgarr=$SideShowmodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$SideShow['code']="10003";
    			$SideShow['msg']="注销失败,".$msg;
    			$SideShow['data']=array();
    		}
    		return \yii\helpers\Json::encode($SideShow);
    	}
    
    
    
    
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}else{
    		$passes = Yii::$app->request->queryParams;
    	}
    	$SideShow=array();
    	if(!$passes){
    		$SideShow['code']="10002";
    		$SideShow['msg']="参数有误";
    	}else{
    		$isdel=SideShow::deleteAll(['SideShowID'=>$passes['SideShowID']]);
    		if($isdel)
    		{
    			$SideShow['code']="10001";
    			$SideShow['msg']="删除成功";
    		}else{
    			$SideShow['code']="10003";
    			$SideShow['msg']="删除失败";
    		}
    	}
    	return \yii\helpers\Json::encode($SideShow);
    }
    
    
    public function actionImg(){//认证tup图片路径
    	//actionImg($name='img',$maxsize=2097152,$firstdir,$seconddir='',$filename)
    	$id=Yii::$app->user->identity->UserID;
    	$res=Yii::$app->runAction('file/img',['name'=>'img','dir'=>'/web/uploads/'.$id.'/sideshow','filename'=>'test']);
    	return \yii\helpers\Json::encode($res);
    }
    
}
