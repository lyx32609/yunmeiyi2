<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\City;
use common\models\Routetype;
use common\models\Routetypeday;
use common\models\RoutetypeDaily;
use common\models\ChangeRule;
use common\models\RouteType;
/**
 * 线路
 */
class RoutetypeController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
   
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
    
    public function actionTest()
    {
    	$session = Yii::$app->session;
			$tel=17686955520;
			$yzm=$session["msg_$tel"];//p($yzm);die;
    	$Routetype = new ChangeRule();
    	$res=ChangeRule::find()->where(['TicketRuleID'=>1])->one();
    	$data['RuleName']=333;
    	$data['RuleDetail']=100;
    	//     	$res->RuleName='000';
//     	$res->RuleDetail='00';//数组需要处理成字符串
    	$sign=$res->load($data,'');
    	$sign=$res->save();p($sign);die;
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){	$posts = \Yii::$app->request->post();  
	    	if ($Routetype->load($posts,'') && $Routetype->validate($posts,'') && $Routetype->save()) {//验证保存
	    		echo 11;die;
	    	}echo 22;die;
    	}echo 33;die;
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
        }
		$res=array();
		if(!$passes){
			$Routeall=RouteType::find()->asArray()->all();
			//->where(['RouteTypeID'=>$passes['RouteTypeID']])
			if(is_array($Routeall) && count($Routeall)>0)
			{
				$res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$Routeall;
			}else{
				$res['code']="10003";
				$res['msg']="请求失败,数据为空";
				$res['data']=array();
			}
		}else{
			$passes=array_filter($passes);//删除为false的元素
			$Routeall=RouteType::find()->where($passes)->asArray()->all();
			//->where(['RouteTypeID'=>$passes['RouteTypeID']])
			if(is_array($Routeall) && count($Routeall)>0)
			{
				$res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$Routeall;
			}else{
				$res['code']="10003";
				$res['msg']="请求失败,数据为空";
				$res['data']=array();
			}
		}
		return \yii\helpers\Json::encode($res);
    }
	
	//tianjia添加
	public function actionAdd(){
        if(\Yii::$app->request->isPost()){
            $posts = \Yii::$app->request->post();
        }
		if($posts){
			$Routetypemodel=new Routetype();//
			if ($Routetypemodel->load($posts,'') && $Routetypemodel->validate($posts,'') 
				&& $Routetypemodel->save()) {
				//添加成功
				$res['code']="10001";
				$res['msg']="添加成功";
				$res['data']=array();
			}else{
				$msgarr=$Routetypemodel->getErrors();
				$msg=reset($msgarr)[0];
				$res['code']="10003";
				$res['msg']="添加失败,".$msg;
				$res['data']=array();
			}
		}else{
			$res['code']="10003";
			$res['msg']="添加失败";
			$res['data']=array();
		}
		return \yii\helpers\Json::encode($res);
	}
	//删除
	public function actionDel($tid){
		$isPost = \Yii::$app->request->isPost;
		if($isPost){
			$posts = \Yii::$app->request->post();
		}
		$Organization=array();
		if(!$posts){
			$Organization['code']="10002";
			$Organization['msg']="请求参数错误";
			$Organization['data']=array();
			return \yii\helpers\Json::encode($Organization);
		}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
			//开启事务
			$tr = Yii::$app->db->beginTransaction();
			$Routetypemodel=new Routetype();//
			$isdelone=Routetype::deleteAll(['RouteTypeID'=>$tid]);
			if($isdelone){
				$res['code']="10001";
				$res['msg']="删除成功";
				$res['data']=array();
			}else{
				$msgarr=$Routetypemodel->getErrors();
				$msg=reset($msgarr)[0];
				$res['code']="10003";
				$res['msg']="删除失败,".$msg;
				$res['data']=array();
			}
			return \yii\helpers\Json::encode($Organization);
		}
	}
	//修改
	public function actionEdit($tid){
		if(\Yii::$app->request->isPost() && $posts = \Yii::$app->request->post()){
			$routemodel=new Routetype();//旅游线路每天线路详情
			$routedailymodel->RouteTypeID=$tid;
			if ($routemodel->load($posts,'') && $routemodel->validate($posts,'') && $routemodel->save()) {
				$res['code']="10001";
				$res['msg']="删除成功";
				$res['data']=array();
			}else{
				$msgarr=$routemodel->getErrors();
				$msg=reset($msgarr)[0];
				$res['code']="10003";
				$res['msg']="删除失败,".$msg;
				$res['data']=array();
			}
		}
		
		return \yii\helpers\Json::encode($res);
	}
	
}