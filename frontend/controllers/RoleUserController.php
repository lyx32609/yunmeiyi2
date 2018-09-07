<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 21:54
 */
namespace frontend\controllers;

use yii;
use common\models\User;
use yii\data\ActiveDataProvider;
class RoleUserController extends \yii\web\Controller
{
    public function actionEdit(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$user=array();
		if(!$passes){
			$user['code']="10002";
			$user['msg']="请求参数错误";
			$user['data']=array();
			return \yii\helpers\Json::encode($user);
		}else{
			$usermodel=new User();
			$usermodel->OrganizationID=$passes['OrganizationID'];
			if($usermodel->save())
			{
				$newps=User::find()->where(['UserID'=>$passes['UserID']])->asArray()->one();
				$user['code']="10001";
				$user['msg']="修改成功";
				$user['data']=$newps;	
			}else{
				$newps=User::find()->where(['UserID'=>$passes['UserID']])->asArray()->one();
				$user['code']="10003";
				$user['msg']="修改失败";
				$user['data']=$newps;
			}
		}
	
    }

    public function actionDel(){
    	if(\Yii::$app->request->isPost()){
    		$data = \Yii::$app->request->post();
        	$MenuAdmin=User::find()->where(['RoleID'=>$data['RoleID']])->one();
			//$MenuAdmin=$MenuAdmin->findByPk($data['MenuID']);
			$MenuAdmin->StateType = 1;
			$count = $MenuAdmin->save();
			if ($count) {//添加成功
				//$authRule=new User();
				//$authRuleRes=$authRule->authRuleTree();
				$res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$count;
				return \yii\helpers\Json::encode($res);
			}else{//保存失败
				$msgarr=$MenuAdmin->getErrors();
				$msg=reset($msgarr)[0];
				$res['code']="10003";
				$res['msg']="请求失败".$msg;
				$res['data']=array();
				return \yii\helpers\Json::encode($res);
			}
			return;
		}
		$res['code']="10003";
		$res['msg']="请求失败";
		$res['data']=array();
		return \yii\helpers\Json::encode($res);
    }

}