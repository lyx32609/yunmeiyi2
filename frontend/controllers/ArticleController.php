<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\Article;


/**
 * Site controller
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$passes = \Yii::$app->request->post();
    	}
    	$res=array();
    	if(!$passes){
    		$Routeall=Article::find()->asArray()->all();
    		//->where(['RouteTypeID'=>$passes['RouteTypeID']])
    		if(is_array($Routeall) && count($Routeall)>0)
    		{
    			$res['code']="10001";
    			$res['msg']="请求成功";
    			$res['data']=$Routeall;
    		}else{
    			$res['code']="10003";
    			$res['msg']="请求失败,数据为空";
    			$res['data']=array();
    		}
    	}else{
    		$passes=array_filter($passes);//删除为false的元素
    		$Routeall=Article::find()->where($passes)->asArray()->all();
    		//->where(['RouteTypeID'=>$passes['RouteTypeID']])
    		if(is_array($Routeall) && count($Routeall)>0)
    		{
    			$res['code']="10001";
    			$res['msg']="请求成功";
    			$res['data']=$Routeall;
    		}else{
    			$res['code']="10003";
    			$res['msg']="请求失败,数据为空";
    			$res['data']=array();
    		}
    	}
    	return \yii\helpers\Json::encode($res);
    }
    
    public function actionAdd(){
    	if(\Yii::$app->request->isPost()){
    		$posts = \Yii::$app->request->post();
    	}
    	if($posts){
    		$Articlemodel=new Article();//
    		if ($Articlemodel->load($posts,'') && $Articlemodel->validate($posts,'')
    		&& $Articlemodel->save()) {
    			//添加成功
    			$res['code']="10001";
    			$res['msg']="添加成功";
    			$res['data']=array();
    		}else{
    			$msgarr=$Articlemodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$res['code']="10003";
    			$res['msg']="添加失败,".$msg;
    			$res['data']=array();
    		}
    	}else{
    		$res['code']="10003";
    		$res['msg']="添加失败";
    		$res['data']=array();
    	}
    	return \yii\helpers\Json::encode($res);
    }
    
    public function actionDel($tid){
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$posts = \Yii::$app->request->post();
    	}
    	$Organization=array();
    	if(!$posts){
    		$Organization['code']="10002";
    		$Organization['msg']="请求参数错误";
    		$Organization['data']=array();
    		return \yii\helpers\Json::encode($Organization);
    	}else{//$usermodel->load(yii::$app->getRequest()->post(),'')
    		//开启事务
    		$tr = Yii::$app->db->beginTransaction();
    		$Articlemodel=new Article();//
    		$isdelone=Article::deleteAll(['RouteTypeID'=>$tid]);
    		if($isdelone){
    			$res['code']="10001";
    			$res['msg']="删除成功";
    			$res['data']=array();
    		}else{
    			$msgarr=$Articlemodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$res['code']="10003";
    			$res['msg']="删除失败,".$msg;
    			$res['data']=array();
    		}
    		return \yii\helpers\Json::encode($Organization);
    	}
    }
    //修改
    public function actionEdit($tid){
    	if(\Yii::$app->request->isPost() && $posts = \Yii::$app->request->post()){
    		$Articlemodel=new Article();//旅游线路每天线路详情
    		$Articlemodel->RouteTypeID=$tid;
    		if ($Articlemodel->load($posts,'') && $Articlemodel->validate($posts,'') && $Articlemodel->save()) {
    			$res['code']="10001";
    			$res['msg']="删除成功";
    			$res['data']=array();
    		}else{
    			$msgarr=$Articlemodel->getErrors();
    			$msg=reset($msgarr)[0];
    			$res['code']="10003";
    			$res['msg']="删除失败,".$msg;
    			$res['data']=array();
    		}
    	}
    	return \yii\helpers\Json::encode($res);
    }
    
    
    
    
    
    
    
    
    
    
}