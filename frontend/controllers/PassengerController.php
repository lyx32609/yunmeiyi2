<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Passenger;
use common\models\PassengerIdentity;
class PassengerController extends Controller
{
	public $enableCsrfValidation = false;
	//获取某一个用户下所有乘客
	public function actionIndex(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$ps=array();
		if(!$passes){
			//无请求参数
			$ps['code']="10002";
			$ps['msg']="请求参数错误";
			$ps['data']=array();
		}else{
			$psall=Passenger::find()->where(['UserID'=>$passes['UserID'],'Status'=>'0'])->asArray()->all();
			if(is_array($psall) && count($psall)>0)
			{
				$ps['code']="10001";
				$ps['msg']="请求成功";
				$ps['data']=$psall;
			}else{
				$ps['code']="10001";
				$ps['msg']="暂无数据";
				$ps['data']=array();
			}
		}
		return \yii\helpers\Json::encode($ps);
	}
	//修改某一个用户下的某一个乘客信息
	public function actionEdit(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$npasses=array_filter($passes);
		$ps=array();
		if(!$npasses){
			$ps['code']="10002";
			$ps['msg']="请求参数错误";
			$ps['data']=array();
			return \yii\helpers\Json::encode($ps);
		}else{
			$passengerInfo =Passenger::find()->where(['PassengerID'=>$npasses['PassengerID']])->one();
			$pimodel=new PassengerIdentity();//乘客证件信息表
			//$pimodel->load($npasses,'');
			$passengerInfo->load($npasses,'');
			if($passengerInfo->update() && $pimodel->load($npasses,'') 
				&& $pimodel->save($npasses,''))
			{
				$ps['code']="10001";
				$ps['msg']="修改成功";
				$ps['data']=array($passengerInfo);
			}else{
				$msgarr=$passengerInfo->getErrors();
				$msg=reset($msgarr)[0];//echo $msg;
				$ps['code']="10003";
				$ps['msg']=$msg;
				$ps['data']=array($passengerInfo);
			}
			return \yii\helpers\Json::encode($ps);
		}
	}
	//乘客增加
	public function actionAdd(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$ps=array();
		if(!$passes){
			$ps['code']="10002";
			$ps['msg']="请求参数错误";
			$ps['data']=array();
			return \yii\helpers\Json::encode($ps);
		}else{
			$pmodel=new Passenger();
			$pimodel=new PassengerIdentity();//乘客证件信息表
			
			$pmodel->UserID=$passes['UserID'];
			$pmodel->IDType=$passes['IDType'];
			$pmodel->Identity=$passes['Identity'];
			$pmodel->LastName=$passes['LastName'];
			$pmodel->FirstName=$passes['FirstName'];
			$pmodel->BirthDate=$passes['BirthDate'];
			$pmodel->PassengerName=$passes['PassengerName'];
			$pmodel->PassengerPhone=$passes['PassengerPhone'];
			$pmodel->CreateTime=date("Y-m-d H:i:s",time());
			if($pmodel->save() && $pimodel->load($passes,'')
				&& $pimodel->save())
			{
				$PassengerID = $pmodel->attributes['PassengerID'];
				$newps=Passenger::find()->where(['PassengerID'=>$PassengerID])->asArray()->one();
				$ps['code']="10001";
				$ps['msg']="添加成功";
				$ps['data']=array($newps);	
			}else{
				$ps['code']="10003";
				$ps['msg']="添加失败";
				$ps['data']=array();
			}
			return \yii\helpers\Json::encode($ps);

		}
	}
	//删除乘客
	public function actionDel(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$ps=array();
		if(!$passes)
		{
			$ps['code']="10002";
			$ps['msg']="参数有误";
			$ps['data']=array();
		}else{
			$passengerInfo =Passenger::find()->where(['PassengerID'=>$passes['PassengerID']])->one();
			$passengerInfo->load($passes,'');
			if($passengerInfo->update())
			{
				$ps['code']="10001";
				$ps['msg']="删除成功";
				$ps['data']=array();
			}else{
				$ps['code']="10003";
				$ps['msg']="删除失败";
				$ps['data']=array();
			}
		}
		return \yii\helpers\Json::encode($ps);
	}
}
?>