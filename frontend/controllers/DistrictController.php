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

/**
 * Site controller
 */
class DistrictController extends Controller
{
	public function actionIndex()
	{
		$isPost = \Yii::$app->request->isPost;
		if($isPost){
			$queryParams = \Yii::$app->request->post();
		}else{
			$queryParams = Yii::$app->request->queryParams;
		}$queryParams['ZoneName']='中国';
		$city=City::find()->where(['ZoneName' =>$queryParams['ZoneName']])->one();
		//$arrivecity=City::find()->where(['zonename' =>$queryParams['arrivecity']]) ->one();
		//$flightarr=FlightList::find()->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'
		//=>$arrivecity['ZoneID']])->andFilterWhere(['between','DepartDate',$start_date, $end_date])
		//->limit(10)->asArray()->all();
		$citys=City::find()->where(['ParentId' =>$city['ZoneID']])->asArray()->all();//p($citys);die;
		return \yii\helpers\Json::encode($citys);
		if(isMobile())
		{//移动端
			return \yii\helpers\Json::encode($citys);
		}else{//web端
			//p($flightarr);
			return $this->render('index',['flights'=>$citys]);
		}
			
	}
	public function actionIndex1()
	{
	
	}
}
