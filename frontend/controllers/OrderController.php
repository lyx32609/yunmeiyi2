<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Passenger;
use frontend\models\Airticket;
class OrderController extends Controller
{
	public function actionIndex()
	{
		$str='';
		$module = Yii::$app->controller->module->id;
		$controller = Yii::$app->controller->id;
		$action = Yii::$app->controller->action->id;
		if(\Yii::$app->request->isGet){
			$queryParams = \Yii::$app->request->get();
		}else{
			$queryParams = Yii::$app->request->queryParams;
		}//p($queryParams);die;
		ksort($queryParams);
		foreach ($queryParams as $k=>$v){
			$str .="$k=$v&";
		}
		
		$str=substr($str, 0,-1);
		//api=order/list&t=1425954916&p=1&appid=666666
		$url="api=$controller/$action/".$str;//p($url);die;
		$appkey='228bf094169a40a3bd188ba37ebe8723';//+&
		$hash=hash_hmac('md5', $url, $appkey);//$algo:"md5"，"sha256"，"haval160,4" 
		p(base64_encode($hash));
		p($hash);die;
		p($queryParams);die;
		$url=urlencode('http://www.cnblogs.com/wpclw/p/6141793.html');
		p($url);
		$url=urldecode($url);
		p($url);
		die;
	}
	
	public function actionBindcard()
	{
		//$departcity=City::find()->where(['zonename' =>$queryParams['departcity']]) ->one();
		if(\Yii::$app->request->isPost){
			$queryParams = \Yii::$app->request->post();
		}else{
			$queryParams = Yii::$app->request->queryParams;
		}
		$passengers=Passenger::find()->where(['UserID' =>$queryParams['userid']]) ->all();//用户对应乘客信息
		//list_cabin舱位类型编码表
		//tb_airticket机票信息表
		//
		$airtickets=Airticket::find()->where(['in','TicketID',$queryParams['ticketID']]) ->all();//机票信息
		$data['data']=array($passengers,$airtickets);
		if(isMobile())
		{//移动端
			return \yii\helpers\Json::encode($data);
		}else{
			//web端
			//p(getArrSet($flightarr));
			//p($flightarrs);
			//return \yii\helpers\Json::encode($flightarrs);
			return $this->render('bindcard',['passengers'=>$passengers,'airtickets'=>$airtickets]);
			//return \yii\helpers\Json::encode($flightarr);
		}
	
	}
	
}
?>