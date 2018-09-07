<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 21:54
 */
namespace frontend\controllers;

use yii;
use common\models\RoleRight;
use yii\data\ActiveDataProvider;
use common\models\MenuAdmin;
use common\models\User;
use common\models\Organization;

class RoleUserController extends \yii\web\Controller
{

		
	public function init(){//zui最先
		
	}
	public function beforeaction($action){//dier第二
		//do something
		return true;
	}
	public function actionIndex(){
		//$RoleRight=new RoleRight();
		if(\Yii::$app->request->isPost()){
			$data = \Yii::$app->request->post();
		}else {
			$res['code']="10003";
			$res['msg']="请求失败";
			$res['data']=array();
			return \yii\helpers\Json::encode($res);
		}
		$res=User::find()->with('organization')->where(['UserID'=>$data['UserID']])->asArray()->one();
		//p($res);die;
		if ($res['OrganizationID']== 1000) {//系统管理员
			echo 1;die;
		}elseif ($res['OrganizationID']){//公司机构管理人员
			echo 11;die;
		}else{//游客
			echo 221;die;///uploads/business/33/news/170516221422.png
		}
		$res=RoleRight::find()->asArray()->all();
		if ($res) {
			$res['code']="10001";
			$res['msg']="请求成功";
			$res['data']=$res;
			return \yii\helpers\Json::encode($res);
		}else{
			$msgarr=$res->getErrors();
			$msg=reset($msgarr)[0];
			$res['code']="10003";
			$res['msg']="请求失败".$msg;
			$res['data']=array();
			return \yii\helpers\Json::encode($res);}
			/* for (int i = 0; i < images.size(); i++) {
				com.lzy.ninegrid.ImageInfo info = new com.lzy.ninegrid.ImageInfo();
				String url = "http://192.168.1.171" + images.get(i)['newsimg'];
				info.setBigImageUrl(url);
				info.setThumbnailUrl(url);
				imageInfo.add(info);
			} */
    }

    public function actionAdd(){//给角色赋予权限
    	$RoleRight=new RoleRight();
        if(\Yii::$app->request->isPost()){
			$data = \Yii::$app->request->post();
            if($data['RoleRights']){
                $data['RoleRights']=implode(',', $data['RoleRights']);
            }
            if ($RoleRight->load($data,'') && $RoleRight->save()) {//添加成功
                $res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$RoleRight;
				return \yii\helpers\Json::encode($res);
            }else{
            	$msgarr=$RoleRight->getErrors();
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

    public function actionEdit(){
    	$MenuAdmin=new RoleRight();
        if(\Yii::$app->request->isPost()){
			$data = \Yii::$app->request->post();
            if($data['RoleRights']){
                $data['RoleRights']=implode(',', $data['RoleRights']);
            }
            $_data=array();
            foreach ($data as $k => $v) {
                $_data[]=$k;
            }
            if(!in_array('StateType', $_data)){
                $data['StateType']=0;
            }
            if ($MenuAdmin->load($data,'') && $MenuAdmin->save()) {//添加成功
                $res['code']="10001";
				$res['msg']="请求成功";
				$res['data']=$MenuAdmin;
				return \yii\helpers\Json::encode($res);
            }else{
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

    public function actionDel(){
    	if(\Yii::$app->request->isPost()){
    		$data = \Yii::$app->request->post();
        	$MenuAdmin=RoleRight::find()->where(['RoleID'=>$data['RoleID']])->one();
			//$MenuAdmin=$MenuAdmin->findByPk($data['MenuID']);
			$MenuAdmin->StateType = 1;
			$count = $MenuAdmin->save();
			if ($count) {//添加成功
				//$authRule=new RoleRight();
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