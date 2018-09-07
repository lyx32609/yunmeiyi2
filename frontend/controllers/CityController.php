<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ContactForm;
use common\models\City;
class CityController extends Controller
{
	public $enableCsrfValidation = false;
	public function actionIndex(){
//		echo "这里是获取城市代码接口";exit();
		$pcitys1=City::find()->select(['ZoneID','ZoneType','ZoneName','ParentID','PopularLevel'])->where(['zoneType' =>'2'])->andWhere(['>','PopularLevel','0'])->asArray()->all();
		$pcitys2=City::find()->select(['ZoneID','ZoneType','ZoneName','ParentID','PopularLevel'])->where(['zoneType' =>'3'])->andWhere(['>','PopularLevel','0'])->asArray()->all();
		$pcitys3=City::find()->select(['ZoneID','ZoneType','ZoneName','ParentID','PopularLevel'])->where(['zoneType' =>'2','PopularLevel'=>'1'])->asArray()->all();
		$pcitys4=City::find()->select(['ZoneID','ZoneType','ZoneName','ParentID','PopularLevel'])->where(['zoneType' =>'3','PopularLevel'=>'0'])->asArray()->all();
		$pcityss=yii\helpers\ArrayHelper::merge($pcitys1,$pcitys2);
		$pcitysss=yii\helpers\ArrayHelper::merge($pcitys3,$pcitys4);
		//$pcitysss=$pcitys4;
		$pcitys=array();
		//p($pcityss);
		if(isMobile())
		{
			if($pcityss || $pcitysss)
			{
				$pcitys['code']="10001";
				$pcitys['msg']="请求成功";
				$pcitys['data']['hotcity']=$pcityss;
				$pcitys['data']['city']=$pcitysss;
			}else{
				$pcitys['code']="10002";
				$pcitys['msg']="请求失败";
				$pcitys['data']=array();
			}
			//移动端
			return \yii\helpers\Json::encode($pcitys);
		}else{
			//web端
			$pcitys['code']="10001";
			$pcitys['msg']="请求成功";
			$pcitys['data']['hotcity']=$pcityss;
			$pcitys['data']['city']=$pcitysss;
			return \yii\helpers\Json::encode($pcitys);
			//p(getArrSet($pcitys));
			//return \yii\helpers\Json::encode($pcitys);
			//return $this->render('index',['pcitys'=>$pcitys]);
			//return \yii\helpers\Json::encode($pcitys);
		}
	}

}
?>