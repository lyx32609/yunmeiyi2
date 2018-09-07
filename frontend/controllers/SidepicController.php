<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\SidePic;

/**
 * Site controller
 */
class SidepicController extends Controller
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
    	$SidePic=array();
    	if(!$passes){
    		//无请求参数
    		$SidePic['code']="10002";
    		$SidePic['msg']="请求参数错误";
    		$SidePic['data']=array();
    	}else{
    		$SidePicone=SidePic::find()->where(['status'=>0])->asArray()->all();
    		if(is_array($SidePicone) && count($SidePicone)>0)
    		{
    			$SidePic['code']="10001";
    			$SidePic['msg']="请求成功";
    			$SidePic['data']=$SidePicone;
    		}else{
    			$SidePic['code']="10003";
    			$SidePic['msg']="请求失败,数据为空";
    			$SidePic['data']=array();
    		}
    	}
    	return \yii\helpers\Json::encode($SidePic);
		
    }
   	//添加
    public function actionEdit(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$SidePic=array();
    	if(!$passes){
    		$SidePic['code']="10002";
    		$SidePic['msg']="请求参数错误";
    		$SidePic['data']=array();
    		return \yii\helpers\Json::encode($SidePic);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$SidePicmodel=new SidePic();
    		if($SidePicmodel->load(yii::$app->getRequest()->post(),'')
    		&& $SidePicmodel->validate() && $SidePicmodel->save()){
    			$newps=SidePic::find()->where(['BankIDNumber'=>$passes['BankIDNumber'],'status'=>0])->asArray()->one();
    			$SidePic['code']="10001";
    			$SidePic['msg']="修改成功";
    			$SidePic['data']=$newps;
    		}else{
    			$msgarr=$SidePicmodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$newps=SidePic::find()->where(['BankIDNumber'=>$passes['BankIDNumber'],'status'=>0])->asArray()->one();
    			$SidePic['code']="10003";
    			$SidePic['msg']="修改失败,".$msg;
    			$SidePic['data']=$newps;
    		}
    		return \yii\helpers\Json::encode($SidePic);
    	}
    }
    
    //添加
    public function actionAdd(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$SidePic=array();
    	if(!$passes){
    		$SidePic['code']="10002";
    		$SidePic['msg']="请求参数错误";
    		$SidePic['data']=array();
    		return \yii\helpers\Json::encode($SidePic);
    	}else{
    		$SidePicmodel=new SidePic();
    		//$SidePicmodel->SidePicName=$passes['SidePicName'];银行编码名称注册姓名是用户的姓名
    		if(//$SidePicmodel->load(yii::$app->getRequest()->post(),'') &&
    		//$SidePicmodel->load($arr,'') &&
    		$SidePicmodel->validate() && $SidePicmodel->save()){
    			$SidePic['code']="10001";
    			$SidePic['msg']="添加成功";
    			$SidePic['data']=[];
    		}else{
    			$msgarr=$SidePicmodel->getErrors();
    			$msg=reset($msgarr)[0];//echo $msg;
    			$SidePic['code']="10003";
    			$SidePic['msg']=$msg;
    			$SidePic['data']=array();
    			return \yii\helpers\Json::encode($SidePic);
    		}
    		return \yii\helpers\Json::encode($SidePic);
    	}
    }
    //删除
    public function actionDel(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$SidePic=array();
    	if(!$passes){
    		$SidePic['code']="10002";
    		$SidePic['msg']="请求参数错误";
    		$SidePic['data']=array();
    		return \yii\helpers\Json::encode($SidePic);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$SidePicmodel=new SidePic();
    		$SidePicmodel->Status=1;//用户状态0正常1删除
    		$SidePicmodel->UpdateTime=date('Y-m-d H:i:s',time());
    		if($SidePicmodel->validate() && $SidePicmodel->save()){
    			$SidePic['code']="10001";
    			$SidePic['msg']="注销成功";
    			$SidePic['data']=array();
    		}else{
    			$msgarr=$SidePicmodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$SidePic['code']="10003";
    			$SidePic['msg']="注销失败,".$msg;
    			$SidePic['data']=array();
    		}
    		return \yii\helpers\Json::encode($SidePic);
    	}
    
    
    
    
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}else{
    		$passes = Yii::$app->request->queryParams;
    	}
    	$SidePic=array();
    	if(!$passes){
    		$SidePic['code']="10002";
    		$SidePic['msg']="参数有误";
    	}else{
    		$isdel=SidePic::deleteAll(['BankIDNumber'=>$passes['BankIDNumber']]);
    		if($isdel)
    		{
    			$SidePic['code']="10001";
    			$SidePic['msg']="删除成功";
    		}else{
    			$SidePic['code']="10003";
    			$SidePic['msg']="删除失败";
    		}
    	}
    	return \yii\helpers\Json::encode($SidePic);
    }
    
    
    public function actionImg(){//认证tup图片路径
    	//actionImg($name='img',$maxsize=2097152,$firstdir,$seconddir='',$filename)
    	$id=Yii::$app->user->identity->UserID;
    	$res=Yii::$app->runAction('file/img',['name'=>'img','dir'=>'/web/uploads/'.$id.'/sidepic','filename'=>'test']);
    	return \yii\helpers\Json::encode($res);
    }
    
}
