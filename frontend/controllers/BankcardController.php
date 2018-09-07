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
use common\models\Bankcard;

/**
 * Site controller
 */
class BankcardController extends Controller
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
    	$Bankcard=array();
    	if(!$passes){
    		//无请求参数
    		$Bankcard['code']="10002";
    		$Bankcard['msg']="请求参数错误";
    		$Bankcard['data']=array();
    	}else{
    		$Bankcardone=Bankcard::find()->where('status=0')->asArray()->all();
    		if(is_array($Bankcardone) && count($Bankcardone)>0)
    		{
    			$Bankcard['code']="10001";
    			$Bankcard['msg']="请求成功";
    			$Bankcard['data']=$Bankcardone;
    		}else{
    			$Bankcard['code']="10003";
    			$Bankcard['msg']="请求失败,数据为空";
    			$Bankcard['data']=array();
    		}
    	}
    	return \yii\helpers\Json::encode($Bankcard);
		
    }
    
    public function actionEdit($id){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
//     	BankCardID	int(11)		NO	是	银行卡ID
//     	UserID	int(11)		YES
//     	BankCardNo	varchar(32)		YES		银行卡号
//     	BankCardType	tinyint(4)		YES		卡号类型
//     	BankCard	varchar(255)		YES
//     	IssueDate	datetime		YES		开户日期
//     	ValidDate	datetime		YES		截止日期
//     	PinCode	varchar(5)		YES		验证码
//     	BankCardName	varchar(50)		YES		开户名
//     	Status	tinyint(4)	0	NO		状态0正常1删除
//     	CreateTime
    	//$passes['BankCardID']=1;
//     	$passes['UserID']=1000;
//     	$passes['BankCardNo']='6228481552887309119';
//     	$passes['BankCardType']=1;
//     	$passes['BankCardName']='邮储银行-绿卡银联标准卡-借记卡';
//     	$passes['Status']=1;
    	$Bankcard=array();
//     	$bank=Bankcard::find()->where(['BankCardID' =>1]) ->one();
//     	if($bank->load($passes,'') && $bank->save()){
//     		echo 1;die;
//     	}echo 2;die;
//     	p($bank);die;
    	$Bankcardmodel = Bankcard::find()->where(['BankCardID' =>$id]) ->one();
    	if($Bankcardmodel->load(Yii::$app->request->post()) && $Bankcardmodel->validate()
    		&& $Bankcardmodel->save()){
    		$Bankcard['code']="10001";
    		$Bankcard['msg']="更新成功";
    		$Bankcard['data']=array();
    		return \yii\helpers\Json::encode($Bankcard);
    	}
    	if(!$passes){
    		$Bankcard['code']="10002";
    		$Bankcard['msg']="请求参数错误";
    		$Bankcard['data']=array();
    		return \yii\helpers\Json::encode($Bankcard);
    	}else{
    		$Bankcardmodel=new Bankcard();
    		//$Bankcardmodel->BankcardName=$passes['BankcardName'];银行编码名称注册姓名是用户的姓名
    		if($Bankcardmodel->load(yii::$app->getRequest()->post(),'') &&
    		//$Bankcardmodel->load($arr,'') &&
    		//$Bankcardmodel->load($passes,'') &&
    		$Bankcardmodel->validate() && $Bankcardmodel->save()){
    			$Bankcard['code']="10001";
    			$Bankcard['msg']="添加成功";
    			$Bankcard['data']=[];
    		}else{
    			$msgarr=$Bankcardmodel->getErrors();//p($msgarr);die;
    			$msg=reset($msgarr)[0];//echo $msg;
    			$Bankcard['code']="10003";
    			$Bankcard['msg']=$msg;
    			$Bankcard['data']=array();
    			return \yii\helpers\Json::encode($Bankcard);
    		}p($Bankcard);die;
    		return \yii\helpers\Json::encode($Bankcard);
    	}
    }
    
    //银行卡添加
    public function actionAdd(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$post = \Yii::$app->request->post();
    	}
//     	BankCardID	int(11)		NO	是	银行卡ID
//     	UserID	int(11)		YES
//     	BankCardNo	varchar(32)		YES		银行卡号
//     	BankCardType	tinyint(4)		YES		卡号类型
//     	BankCard	varchar(255)		YES
//     	IssueDate	datetime		YES		开户日期
//     	ValidDate	datetime		YES		截止日期
//     	PinCode	varchar(5)		YES		验证码
//     	BankCardName	varchar(50)		YES		开户名
//     	Status	tinyint(4)	0	NO		状态0正常1删除
//     	CreateTime
    	$Bankcard=array();
    	if(!$post){
    		$Bankcard['code']="10002";
    		$Bankcard['msg']="请求参数错误";
    		$Bankcard['data']=array();
    		return \yii\helpers\Json::encode($Bankcard);
    	}else{
    		$Bankcardmodel=new Bankcard();
    		//$Bankcardmodel->BankcardName=$passes['BankcardName'];银行编码名称注册姓名是用户的姓名
    		//获取银行卡前几位标识
    		$mid=bankInfo($post['BankCardNumber'],Yii::$app->runAction('bankname/need'));
    		$post['BankNoPrefix']=$mid['key'];
    		if($Bankcardmodel->load($post,'') &&
    		//$Bankcardmodel->load($arr,'') &&
    		$Bankcardmodel->validate() && $Bankcardmodel->save()){
    			$Bankcard['code']="10001";
    			$Bankcard['msg']="添加成功";
    			$Bankcard['data']=[];
    		}else{
    			$msgarr=$Bankcardmodel->getErrors();
    			$msg=reset($msgarr)[0];//echo $msg;
    			$Bankcard['code']="10003";
    			$Bankcard['msg']=$msg;
    			$Bankcard['data']=array();
    			return \yii\helpers\Json::encode($Bankcard);
    		}
    		return \yii\helpers\Json::encode($Bankcard);
    	}
    }
    //删除银行编码名称
    public function actionDel(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$Bankcard=array();
    	if(!$passes){
    		$Bankcard['code']="10002";
    		$Bankcard['msg']="请求参数错误";
    		$Bankcard['data']=array();
    		return \yii\helpers\Json::encode($Bankcard);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$Bankcardmodel=new Bankcard();
    		$Bankcardmodel->Status=1;//用户状态1正常2停用3用户自己注销
    		$Bankcardmodel->UpdateTime=date('Y-m-d H:i:s',time());
    		if($Bankcardmodel->validate() && $Bankcardmodel->save()){
    			$Bankcard['code']="10001";
    			$Bankcard['msg']="注销成功";
    			$Bankcard['data']=array();
    		}else{
    			$msgarr=$Bankcardmodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$Bankcard['code']="10003";
    			$Bankcard['msg']="注销失败,".$msg;
    			$Bankcard['data']=array();
    		}
    		return \yii\helpers\Json::encode($Bankcard);
    	}
    }
    
    
    public function actionImg(){//认证tup图片路径
    	//actionImg($name='img',$maxsize=2097152,$firstdir,$seconddir='',$filename)
    	$id=Yii::$app->user->identity->UserID;
    	$res=Yii::$app->runAction('file/img',['name'=>'img','dir'=>'/web/uploads/'.$id.'/bankcard','filename'=>'test']);
    	return \yii\helpers\Json::encode($res);
    }
    
    
    
}
