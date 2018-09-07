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
use frontend\models\City;
class SignController extends Controller
{
	public $enableCsrfValidation = false;
	public function actionIndex(){
		$str='';
		$module = Yii::$app->controller->module->id;
		$controller = Yii::$app->controller->id;
		$action = Yii::$app->controller->action->id;
		if(\Yii::$app->request->isGet){
			$queryParams = \Yii::$app->request->get();
		}else{
			$queryParams = Yii::$app->request->queryParams;
		}
		foreach ($queryParams as $k=>$v){
			$str .="$k=$v&";
		}
		$str=substr($str, 0,-1);
		//api=order/list&t=1425954916&p=1&appid=666666
		$url="api=$controller/$action/".$str;
		$appkey='228bf094169a40a3bd188ba37ebe8723';//+&
		$hash=hash_hmac('md5', $url, $appkey);//$algo:"md5"，"sha256"，"haval160,4" 
		p($hash);die;
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>