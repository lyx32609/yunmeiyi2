<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\User;
class UserController extends Controller
{
	public $enableCsrfValidation = false;
	//用户基本信息
	public function actionIndex(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$user=array();
		if(!$passes){
			//无请求参数
			$user['code']="10002";
			$user['msg']="请求参数错误";
			$user['data']=array();
		}else{
			$userone=User::find()->where(['UserID'=>$passes['UserID']])->asArray()->one();
			if(is_array($psone) && count($psone)>0)
			{
				$user['code']="10001";
				$user['msg']="请求成功";
				$user['data']=$userone;
			}else{
				$user['code']="10001";
				$user['msg']="请求成功,数据为空";
				$user['data']=array();
			}
		}
		if(isMobile())
		{
			//移动端
			return \yii\helpers\Json::encode($user);
		}else{
			//web端
			//p(getArrSet($pcitys));
			return $this->render('index',['user'=>$user]);
		}
	}
	//修改某一个用户
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
			if(isMobile())
			{
				//移动端
				return \yii\helpers\Json::encode($user);
			}else{
				//web端
				//p(getArrSet($pcitys));
				return $this->render('edit');
			}
		}else{
			$usermodel=new User();
			$usermodel->LoginName=$passes['LoginName'];
			$usermodel->UserPhone=$passes['UserPhone'];
			$usermodel->OrganizationID=$passes['OrganizationID'];
			$usermodel->NickName=$passes['NickName'];
			$usermodel->UpdateTime=date('Y-m-d H:i:s',time());
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
			if(isMobile())
			{
				//移动端
				return \yii\helpers\Json::encode($user);
			}else{
				//web端,修改完返回列表页
				//p(getArrSet($pcitys));
				return $this->render('index');
			}
		}
	}

	//用户增加
	public function actionAdd(){
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
			if(isMobile())
			{
				//移动端
				return \yii\helpers\Json::encode($user);
			}else{
				//web端
				//p(getArrSet($pcitys));
				return $this->render('add');
			}
		}else{
			$usermodel=new User();
			$usermodel->LoginName=$passes['LoginName'];
			$usermodel->UserPhone=$passes['UserPhone'];
			$usermodel->NickName=$passes['NickName'];
			$usermodel->UserRole=$passes['UserRole'];
			$usermodel->OrganizationID=$passes['OrganizationID'];
			$usermodel->StateType=$passes['StateType'];
			$usermodel->CreateTime=date('Y-m-d H:i:s',time());
			$usermodel->UpdateTime=date('Y-m-d H:i:s',time());
			if($usermodel->save())
			{
				$UserID = $usermodel->attributes['UserID'];
				$newps=User::find()->where(['UserID'=>$UserID])->asArray()->one();
				$user['code']="10001";
				$user['msg']="添加成功";
				$user['data']=$newps;	
			}else{
				$user['code']="10003";
				$user['msg']="添加失败";
				$user['data']=array();
			}
			if(isMobile())
			{
				//移动端
				return \yii\helpers\Json::encode($user);
			}else{
				//web端,修改完返回列表页
				//p(getArrSet($pcitys));
				return $this->render('index');
			}
		}
	}
	//删除用户
	public function actionDel(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$user=array();
		if(!$passes)
		{
			$user['code']="10002";
			$user['msg']="参数有误";
		}else{
			$isdel=User::deleteAll(['UserID'=>$passes['UserID']]);
			if($isdel)
			{
				$user['code']="10001";
				$user['msg']="删除成功";
			}else{
				$user['code']="10003";
				$user['msg']="删除失败";
			}
		}
		if(isMobile())
		{
			//移动端
			return \yii\helpers\Json::encode($user);
		}else{
			//web端,删除完返回列表页
			//p(getArrSet($pcitys));
			return $this->render('index');
		}
	}

}
?>