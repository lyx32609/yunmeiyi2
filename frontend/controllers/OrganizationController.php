<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\UploadForm;
use common\models\Organization;
use common\models\Organizationcheck;
use common\models\User;
class OrganizationController extends Controller
{
	public $enableCsrfValidation = false;
	//公司基本信息
	public function actionIndex(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$Organization=array();
		if(!$passes){
			//无请求参数
			$Organization['code']="10002";
			$Organization['msg']="请求参数错误";
			$Organization['data']=array();
		}else{
			$Organizationone=Organization::find()->where(['OrganizationID'=>$passes['OrganizationID']])->asArray()->one();
			if(is_array($Organizationone) && count($Organizationone)>0)
			{
				$Organization['code']="10001";
				$Organization['msg']="请求成功";
				$Organization['data']=$Organizationone;
			}else{
				$Organization['code']="10003";
				$Organization['msg']="请求失败,数据为空";
				$Organization['data']=array();
			}
		}
		return \yii\helpers\Json::encode($Organization);
	}
	//修改某一个公司
	public function actionEdit(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }
		$Organization=array();
		if(!$passes){
			$Organization['code']="10002";
			$Organization['msg']="请求参数错误";
			$Organization['data']=array();
			return \yii\helpers\Json::encode($Organization);
		}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
			$Organizationmodel=new Organization();
			/* $Organizationmodel->LoginName=$passes['LoginName'];
			$Organizationmodel->OrganizationPhone=$passes['OrganizationPhone'];
			$Organizationmodel->OrganizationID=$passes['OrganizationID'];
			$Organizationmodel->NickName=$passes['NickName'];
			$Organizationmodel->UpdateTime=date('Y-m-d H:i:s',time()); */
			/* OrganizationID	int(11)		NO	是
			OrganizationName	varchar(255)		NO		公司机构名称
			LegalRepresentative	varchar(255)		NO		法人代表姓名
			Phone	varchar(20)		NO		联系电话
			Address	varchar(255)		YES		地址
			OrganizationType	varchar(16)		NO		机构类型
			BusinessLicenseID	varchar(20)		YES		公司统一社会信用代码
			BusinessLicenseUrl	varchar(255)		YES		营业执照照片
			AdminUserID	int(11)		YES		创建机构的用户，通过审核，拥有这个机构的最高权限
			CheckState	tinyint(4)		NO		审查状态
			StateType	int(11)		NO		用户状态1正常2停用3用户自己注销
			CreateTime	datetime		NO */
			if($Organizationmodel->load(yii::$app->getRequest()->post(),'')
			&& $Organizationmodel->validate() && $Organizationmodel->save()){
				$newps=Organization::find()->where(['OrganizationID'=>$passes['OrganizationID']])->asArray()->one();
				$Organization['code']="10001";
				$Organization['msg']="修改成功";
				$Organization['data']=$newps;	
			}else{
				$msgarr=$Organizationmodel->getErrors();
				$msg=reset($msgarr)[0];
				$newps=Organization::find()->where(['OrganizationID'=>$passes['OrganizationID']])->asArray()->one();
				$Organization['code']="10003";
				$Organization['msg']="修改失败,".$msg;
				$Organization['data']=$newps;
			}
			return \yii\helpers\Json::encode($Organization);
		}
	}

	//公司机构增加注册
	public function actionSignup(){
		/* $arr=[
		'OrganizationName' => '吴fdf昊原',
		'LegalRepresentative' =>'朱祥' ,
		'Phone' => '17686955520',
		'Address' => '山东省济南市',
		'OrganizationType' => 1,
		'StateType' => '28df7,',
		'CreateTime' => '0',
		'BusinessLicenseUrl' => 'dfsadfasd',
		'BusinessLicenseID' => 1212121212,
		'AdminUserID' => 5,//CheckState
		'CheckState' => 1,
		];
		$Organizationmodel=new Organization();
		p($Organizationmodel->load($arr,'') );
		p($Organizationmodel->validate() );
		p($Organizationmodel->save());die; */
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }
		$Organization=array();
		if(!$passes){
			$Organization['code']="10002";
			$Organization['msg']="请求参数错误";
			$Organization['data']=array();
			return \yii\helpers\Json::encode($Organization);
		}else{
			$session = Yii::$app->session;
			$tel=$passes['tel'];
			$yzm=$session["msg_$tel"];
			if (!$yzm) {
				$Organization['code']="10002";
				$Organization['msg']="短信验证码已过期";
				$Organization['data']=array();
				return \yii\helpers\Json::encode($Organization);
			}
			if ($passes['yzm']!=$yzm) {
				$Organization['code']="10002";
				$Organization['msg']="短信验证码错误";
				$Organization['data']=array();
				return \yii\helpers\Json::encode($Organization);
			}
			$Organizationmodel=new Organization();
			//$Organizationmodel->OrganizationName=$passes['OrganizationName'];公司机构注册姓名是用户的姓名
			
			if(//$Organizationmodel->load(yii::$app->getRequest()->post(),'') &&
				//$Organizationmodel->load($arr,'') &&
			    $Organizationmodel->validate() && $Organizationmodel->save()){
				$OrganizationID = $Organizationmodel->attributes['OrganizationID'];
				$user=new User();
				$user->UserPhone=$passes['UserPhone'];
				$user->PasswordMD5=$passes['PasswordMD5'];
				$user->OrganizationID=$OrganizationID;
				$user->NickName=$passes['NickName'];
				$user->UpdateTime=date('Y-m-d H:i:s',time());
				$user->CreateTime=date('Y-m-d H:i:s',time());
				$organizations=Organization::find()->where(['OrganizationID'=>$OrganizationID])->asArray()->one();
				$saveres=$user->save();//添加用户
				$userid=$user->attributes['UserID'];
				$Organization = $Organizationmodel->findByPk($OrganizationID);
				$Organization->AdminUserID = $userid;
				$count = $Organization->update(array('AdminUserID'));
				if ($count>0 && $saveres) {
					$Organization['code']="10001";
					$Organization['msg']="注册成功";
					$Organization['data']=$organizations;
				}else {
					$Organization['code']="10003";
					$Organization['msg']="注册失败";
					$Organization['data']=array();
				}
			}else{
				$msgarr=$Organizationmodel->getErrors();
				$msg=reset($msgarr)[0];//echo $msg;
				$Organization['code']="10003";
				$Organization['msg']=$msg;
				$Organization['data']=array();
				return \yii\helpers\Json::encode($Organization);
			}
			return \yii\helpers\Json::encode($Organization);
		}
	}
	//删除公司机构
	public function actionDel(){
		$isPost = \Yii::$app->request->isPost;
		if($isPost){
			$passes = \Yii::$app->request->post();
		}
		$Organization=array();
		if(!$passes){
			$Organization['code']="10002";
			$Organization['msg']="请求参数错误";
			$Organization['data']=array();
			return \yii\helpers\Json::encode($Organization);
		}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
			$Organizationmodel=new Organization();
			$Organizationmodel->StateType=2;//用户状态1正常2停用3用户自己注销
			$Organizationmodel->UpdateTime=date('Y-m-d H:i:s',time()); 
			if($Organizationmodel->validate() && $Organizationmodel->save()){
				$Organization['code']="10001";
				$Organization['msg']="注销成功";
				$Organization['data']=array();
			}else{
				$msgarr=$Organizationmodel->getErrors();
				$msg=reset($msgarr)[0];
				$Organization['code']="10003";
				$Organization['msg']="注销失败,".$msg;
				$Organization['data']=array();
			}
			return \yii\helpers\Json::encode($Organization);
		}
		
		
		
		
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $passes = \Yii::$app->request->post();
        }else{
            $passes = Yii::$app->request->queryParams;
        }
		$Organization=array();
		if(!$passes){
			$Organization['code']="10002";
			$Organization['msg']="参数有误";
		}else{
			$isdel=Organization::deleteAll(['OrganizationID'=>$passes['OrganizationID']]);
			if($isdel)
			{
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
			}else{
				$Organization['code']="10003";
				$Organization['msg']="删除失败";
			}
		}
		return \yii\helpers\Json::encode($Organization);
	}
	
	public function actionAddrole(){
		$isPost = \Yii::$app->request->isPost;
		if($isPost){
			$passes = \Yii::$app->request->post();
		}else{
			$passes = Yii::$app->request->queryParams;
		}
		$Organization=array();
		if(!$passes)
		{
			$Organization['code']="10002";
			$Organization['msg']="参数有误";
		}else{
			$isdel=Organization::deleteAll(['OrganizationID'=>$passes['OrganizationID']]);
			if($isdel)
			{
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
			}else{
				$Organization['code']="10003";
				$Organization['msg']="删除失败";
			}
		}
		return \yii\helpers\Json::encode($Organization);
	}
	
	public function actionImg(){//认证tup图片路径
		//actionImg($name='img',$maxsize=2097152,$firstdir,$seconddir='',$filename)
		$res=Yii::$app->runAction('file/img',['name'=>'img','dir'=>'/web/uploads/222','filename'=>'test']);
		return \yii\helpers\Json::encode($res);
	}
	public function actionAudit(){//认证
		
		$organization = new Organization();
		if(\Yii::$app->request->isPost){
			$post = \Yii::$app->request->post();
			if($organization->load($post,'') && $organization->validate() && $organization->save())
			{
				$user['code']="10001";
				$user['msg']="认证成功，等待审核";
				$user['data']=array();
			}else{
				$user['code']="10003";
				$user['msg']="认证失败";
				$user['data']=array();
			}
		}
		$end['code']="10003";
		$end['msg']="参数为空";
		return \yii\helpers\Json::encode($end);
	}
	
	public function actionAdduser(){//添加公司机构用户
		$organization = new Organization();
		if(\Yii::$app->request->isPost){
			$post = \Yii::$app->request->post();
			$usermodel=new User();
			if($usermodel->load($post,'') &&$usermodel->validate() && $usermodel->save())
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
			return $user;
		}
		$end['code']="10003";
		$end['msg']="添加失败";
		return \yii\helpers\Json::encode($end);
	}
	
	public function actionEdituser(){//更新公司机构用户
		$organization = new Organization();
		if(\Yii::$app->request->isPost){
			$post = \Yii::$app->request->post();
			$usermodel=new User();
			if($usermodel->load($post,'') &&$usermodel->validate() && $usermodel->save())
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
		}
		$end['code']="10003";
		$end['msg']="添加失败";
		return \yii\helpers\Json::encode($end);
	}
	
	public function actionCheck($id){//审核
		//$organization = new Organization();
		
		if(\Yii::$app->request->isPost){
			$post = \Yii::$app->request->post();
			$model = Organization::model()->findByPk($id);
			$model->CheckState = 1;//0
			$count = $model->update(array('CheckState'));
			if($count)
			{
				$user['code']="10001";
				$user['msg']="审核成功";
				$user['data']=array();
			}else{
				$user['code']="10003";
				$user['msg']="审核失败";
				$user['data']=array();
			}
		}
		$end['code']="10003";
		$end['msg']="参数为空";
		return \yii\helpers\Json::encode($end);
	}
	
	public function actionCheckexplain(){//审核原因
		$organizationcheck = new Organizationcheck();
		$organization = new Organization();
		if(\Yii::$app->request->isPost){
			$post = \Yii::$app->request->post();
			if($organizationcheck->load($post,'') && $organizationcheck->validate() && $organizationcheck->save())
			{
				$user['code']="10001";
				$user['msg']="审核成功";
				$user['data']=array();
			}else{
				$user['code']="10003";
				$user['msg']="审核失败";
				$user['data']=array();
			}
		}
		$end['code']="10003";
		$end['msg']="参数为空";
		return \yii\helpers\Json::encode($end);
	}
	

}
?>