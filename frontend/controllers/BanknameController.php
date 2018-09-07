<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\BankName;

/**
 * Site controller
 */
class BanknameController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    public function behaviors()
    {
    	return [
	    	[
		    	'class' => TimestampBehavior::className(),
		    	'attributes' => [
			    	# 创建之前
			    	ActiveRecord::EVENT_BEFORE_INSERT => ['CreateTime', 'UpdateTime'],
			    	# 修改之前
			    	ActiveRecord::EVENT_BEFORE_UPDATE => ['UpdateTime']
		    	],
		    	#设置默认值
		    	'value' => date('Y-m-d H:i:s',time())
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
    	$BankName=array();
    	if(!$passes){
    		//无请求参数
    		$BankName['code']="10002";
    		$BankName['msg']="请求参数错误";
    		$BankName['data']=array();
    	}else{
    		$BankNameone=BankName::find()->asArray()->all();
    		if(is_array($BankNameone) && count($BankNameone)>0)
    		{
    			$BankName['code']="10001";
    			$BankName['msg']="请求成功";
    			$BankName['data']=$BankNameone;
    		}else{
    			$BankName['code']="10003";
    			$BankName['msg']="请求失败,数据为空";
    			$BankName['data']=array();
    		}
    	}
    	return \yii\helpers\Json::encode($BankName);
		
    }
    
    public function actionEdit(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$BankName=array();
    	if(!$passes){
    		$BankName['code']="10002";
    		$BankName['msg']="请求参数错误";
    		$BankName['data']=array();
    		return \yii\helpers\Json::encode($BankName);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$BankNamemodel=new BankName();
    		if($BankNamemodel->load(yii::$app->getRequest()->post(),'')
    		&& $BankNamemodel->validate() && $BankNamemodel->save()){
    			$newps=BankName::find()->where(['BankNoPrefix'=>$passes['BankNoPrefix']])->asArray()->one();
    			$BankName['code']="10001";
    			$BankName['msg']="修改成功";
    			$BankName['data']=$newps;
    		}else{
    			$msgarr=$BankNamemodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$newps=BankName::find()->where(['BankNoPrefix'=>$passes['BankNoPrefix']])->asArray()->one();
    			$BankName['code']="10003";
    			$BankName['msg']="修改失败,".$msg;
    			$BankName['data']=$newps;
    		}
    		return \yii\helpers\Json::encode($BankName);
    	}
    }
    
    //银行编码名称增加
    public function actionAdd(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$BankName=array();
    	if(!$passes){
    		$BankName['code']="10002";
    		$BankName['msg']="请求参数错误";
    		$BankName['data']=array();
    		return \yii\helpers\Json::encode($BankName);
    	}else{
    		$BankNamemodel=new BankName();
    		//$BankNamemodel->BankNameName=$passes['BankNameName'];银行编码名称注册姓名是用户的姓名
    			
    		if($BankNamemodel->load(yii::$app->getRequest()->post(),'') &&
	    		//$BankNamemodel->load($arr,'') &&
	    		$BankNamemodel->validate() && $BankNamemodel->save()){
    			$BankName['code']="10001";
    			$BankName['msg']="注册成功";
    			$BankName['data']=[];
    			
    		}else{
    			$msgarr=$BankNamemodel->getErrors();
    			$msg=reset($msgarr)[0];//echo $msg;
    			$BankName['code']="10003";
    			$BankName['msg']=$msg;
    			$BankName['data']=array();
    			return \yii\helpers\Json::encode($BankName);
    		}
    		return \yii\helpers\Json::encode($BankName);
    	}
    }
    //删除银行编码名称    没删除功能
    public function actionDel(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$BankName=array();
    	if(!$passes){
    		$BankName['code']="10002";
    		$BankName['msg']="请求参数错误";
    		$BankName['data']=array();
    		return \yii\helpers\Json::encode($BankName);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$BankNamemodel=new BankName();
    		$BankNamemodel->StateType=1;//用户状态1正常2停用3用户自己注销
    		$BankNamemodel->UpdateTime=date('Y-m-d H:i:s',time());
    		if($BankNamemodel->validate() && $BankNamemodel->save()){
    			$BankName['code']="10001";
    			$BankName['msg']="注销成功";
    			$BankName['data']=array();
    		}else{
    			$msgarr=$BankNamemodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$BankName['code']="10003";
    			$BankName['msg']="注销失败,".$msg;
    			$BankName['data']=array();
    		}
    		return \yii\helpers\Json::encode($BankName);
    	}
    
    }
    
    public function actionNeed(){//需要的数据
    	$BankNamemodel=new BankName();
    	$Bankarr=BankName::find()->asArray()->all();//全部
    	//bankInfo('6228481552887309119',$Bankarr['']);
    	$endarr=[];
//     	$Bankarr = [
//     		['BankNoPrefix'=>'621298','BankName' => '邮储银行-绿卡1通-借记卡'],
//     		['BankNoPrefix'=>'621398','BankName' => '邮储银行-绿2卡通-借记卡'],
//     		['BankNoPrefix'=>'621498','BankName' => '邮储银行-绿卡3通-借记卡'],
//     		['BankNoPrefix'=>'621598','BankName' => '邮储银行-绿卡4通-借记卡']
//     	];
    	foreach ($Bankarr as $v){
    		$midone=$v['BankNoPrefix'];
    		$midtwo=$v['BankName'];
    		$endarr[$midone]=$midtwo;
    	}
    	//;
    	//p(bankInfo('6212981552887309119',$endarr));die;
    	return \yii\helpers\Json::encode($endarr);
    }
    
}