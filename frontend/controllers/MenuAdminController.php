<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\MenuAdmin;
use common\models\User;
use common\models\Organization;
class MenuAdminController extends Controller
{
	public $enableCsrfValidation = false;
	//用户基本信息
	public function actionIndex(){
		$user=new  User();
		if(\Yii::$app->request->isPost){
			$data=\Yii::$app->request->post();}
			
		$data['UserID'] = 29;
		$res=User::find()->with('organization')->where(['UserID'=>$data['UserID']])->asArray()->one();
		//p($res);die;
		if ($res['OrganizationID']== 1000) {//系统管理员
			echo 1;die;
		}elseif ($res['OrganizationID']){//公司机构管理人员
			echo 11;die;
		}else{//游客
			echo 221;die;
		}
		$authRule=new MenuAdmin();
		if(\Yii::$app->request->isPost){
			$sorts=\Yii::$app->request->post();
			foreach ($sorts as $k => $v) {
				$authRule->update(['id'=>$k,'sort'=>$v]);
			}
			//$this->success('更新排序成功！',url('lst'));
			return;
		}
		$authRuleRes=$authRule->authRuleTree();//权限树形菜单
		//p($authRuleRes);die;
	}
	
	public function actionAdd(){
		if(\Yii::$app->request->isPost()){
			$data = \Yii::$app->request->post();
			$MenuAdmin=new MenuAdmin();
			$plevel=$MenuAdmin->where(['MenuID' =>$data['ParentMenuID']])->field('Menulevel')->find();
			if($plevel){
				$data['Menulevel']=$plevel['Menulevel']+1;
			}else{
				$data['Menulevel']=0;
			}
			if ($MenuAdmin->load($data,'') && $MenuAdmin->save()) {//添加成功
				$authRule=new MenuAdmin();
				$authRuleRes=$authRule->authRuleTree();
				$res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$authRuleRes;
				return \yii\helpers\Json::encode($res);
			}else{//保存失败
				$msgarr=$MenuAdmin->getErrors();
				$msg=reset($msgarr)[0];
				$res['code']="10003";
				$res['msg']="请求失败".$msg;
				$res['data']=array();
				return \yii\helpers\Json::encode($res);
			}
		}
		$res['code']="10003";
		$res['msg']="请求失败";
		$res['data']=array();
		return \yii\helpers\Json::encode($res);
		
	}
	
	public function actionEdit(){
		if(\Yii::$app->request->isPost()){
			$data = \Yii::$app->request->post();
			$MenuAdmin=new MenuAdmin();
			$plevel=$MenuAdmin->where('MenuID',$data['ParentMenuID'])->field('MenuLevel')->find();
			if($plevel){
				$data['MenuLevel']=$plevel['MenuLevel']+1;
			}else{
				$data['MenuLevel']=0;
			}
			if ($MenuAdmin->load($data,'') && $MenuAdmin->save()) {//添加成功
				$authRule=new MenuAdmin();
				$authRuleRes=$authRule->authRuleTree();
				$res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$authRuleRes;
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
	
	
	public function actionDel(){
		if(\Yii::$app->request->isPost()){
			$data = \Yii::$app->request->post();
			//$MenuAdmin=new MenuAdmin();
			$MenuAdmin=MenuAdmin::find()->where(['p_id'=>$data['p_id']])->one();
			//$MenuAdmin=$MenuAdmin->findByPk($data['MenuID']);
			$MenuAdmin->MenuStatus = 1;
			$count = $MenuAdmin->save();
			if ($count) {//添加成功
				$authRule=new MenuAdmin();
				$authRuleRes=$authRule->authRuleTree();
				$res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$authRuleRes;
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
?>