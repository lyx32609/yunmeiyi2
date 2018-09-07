<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 21:54
 */

namespace frontend\controllers;

use yii;
use  frontend\models\RoleRight;

class UserAccessController extends \yii\web\Controller
{
	public function actionIndex()//展示所有
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

}