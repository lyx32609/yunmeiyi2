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
use common\models\WebPage;

/**
 * Site controller
 */
class WebpageController extends Controller
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
    	$WebPage=array();
    	if(!$passes){
    		//无请求参数
    		$WebPage['code']="10002";
    		$WebPage['msg']="请求参数错误";
    		$WebPage['data']=array();
    	}else{
    		$WebPageone=WebPage::find()->where(['status'=>0])->asArray()->all();
    		if(is_array($WebPageone) && count($WebPageone)>0)
    		{
    			$WebPage['code']="10001";
    			$WebPage['msg']="请求成功";
    			$WebPage['data']=$WebPageone;
    		}else{
    			$WebPage['code']="10003";
    			$WebPage['msg']="请求失败,数据为空";
    			$WebPage['data']=array();
    		}
    	}
    	return \yii\helpers\Json::encode($WebPage);
		
    }
   	//添加
	public function actionEdit($id){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$WebPage=array();
    	$WebPagemodel = WebPage::find()->where(['WebPageID' =>$id]) ->one();
    	if($WebPagemodel->load(Yii::$app->request->post()) && $WebPagemodel->validate()
    		&& $WebPagemodel->save()){
    		$WebPage['code']="10001";
    		$WebPage['msg']="更新成功";
    		$WebPage['data']=array();
    		return \yii\helpers\Json::encode($WebPage);
    	}
    	if(!$passes){
    		$WebPage['code']="10002";
    		$WebPage['msg']="请求参数错误";
    		$WebPage['data']=array();
    		return \yii\helpers\Json::encode($WebPage);
    	}else{
    		$WebPagemodel=new WebPage();
    		//$WebPagemodel->WebPageName=$passes['WebPageName'];银行编码名称注册姓名是用户的姓名
    		if($WebPagemodel->load(yii::$app->getRequest()->post(),'') &&
    		//$WebPagemodel->load($arr,'') &&
    		//$WebPagemodel->load($passes,'') &&
    		$WebPagemodel->validate() && $WebPagemodel->save()){
    			$WebPage['code']="10001";
    			$WebPage['msg']="添加成功";
    			$WebPage['data']=[];
    		}else{
    			$msgarr=$WebPagemodel->getErrors();//p($msgarr);die;
    			$msg=reset($msgarr)[0];//echo $msg;
    			$WebPage['code']="10003";
    			$WebPage['msg']=$msg;
    			$WebPage['data']=array();
    			return \yii\helpers\Json::encode($WebPage);
    		}p($WebPage);die;
    		return \yii\helpers\Json::encode($WebPage);
    	}
    }
    
    //添加
    public function actionAdd(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$WebPage=array();
    	if(!$passes){
    		$WebPage['code']="10002";
    		$WebPage['msg']="请求参数错误";
    		$WebPage['data']=array();
    		return \yii\helpers\Json::encode($WebPage);
    	}else{
    		$WebPagemodel=new WebPage();
    		//$WebPagemodel->WebPageName=$passes['WebPageName'];银行编码名称注册姓名是用户的姓名
    		if(//$WebPagemodel->load(yii::$app->getRequest()->post(),'') &&
    		//$WebPagemodel->load($arr,'') &&
    		$WebPagemodel->validate() && $WebPagemodel->save()){
    			$WebPage['code']="10001";
    			$WebPage['msg']="添加成功";
    			$WebPage['data']=[];
    		}else{
    			$msgarr=$WebPagemodel->getErrors();
    			$msg=reset($msgarr)[0];//echo $msg;
    			$WebPage['code']="10003";
    			$WebPage['msg']=$msg;
    			$WebPage['data']=array();
    			return \yii\helpers\Json::encode($WebPage);
    		}
    		return \yii\helpers\Json::encode($WebPage);
    	}
    }
    //删除
    public function actionDel(){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$WebPage=array();
    	if(!$passes){
    		$WebPage['code']="10002";
    		$WebPage['msg']="请求参数错误";
    		$WebPage['data']=array();
    		return \yii\helpers\Json::encode($WebPage);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		$WebPagemodel=new WebPage();
    		$WebPagemodel->Status=1;//用户状态0正常1删除
    		$WebPagemodel->UpdateTime=date('Y-m-d H:i:s',time());
    		if($WebPagemodel->validate() && $WebPagemodel->save()){
    			$WebPage['code']="10001";
    			$WebPage['msg']="注销成功";
    			$WebPage['data']=array();
    		}else{
    			$msgarr=$WebPagemodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$WebPage['code']="10003";
    			$WebPage['msg']="注销失败,".$msg;
    			$WebPage['data']=array();
    		}
    		return \yii\helpers\Json::encode($WebPage);
    	}
    }
    
    
    public function actionImg(){//认证tup图片路径
    	//actionImg($name='img',$maxsize=2097152,$firstdir,$seconddir='',$filename)
    	$id=Yii::$app->user->identity->UserID;
    	$res=Yii::$app->runAction('file/img',['name'=>'img','dir'=>'/web/uploads/'.$id.'/WebPage','filename'=>'test']);
    	return \yii\helpers\Json::encode($res);
    }
    
}
