<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\City;
use common\models\TourArea;
use common\models\TourAreaday;
use common\models\TourAreaDaily;
use common\models\TourSpot;
use common\models\Organization;
/**
 * 线路
 */
class TourAreaController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	$TourArea=new TourArea();
    	$data=$TourArea->getRouteAll();
    	p($data);die;
    }
	
	//tianjia添加
	public function actionAdd(){
        if(\Yii::$app->request->isPost()){
            $posts = \Yii::$app->request->post();
        }
		if($posts){
			$TourAreamodel=new TourArea();//
			/* $TourAreamodel->RouteName=$posts;
			TourSpotID	int(11)		NO	是	
			TourAreaID	int(11)		NO		所属景区ID
			Address	varchar(255)		NO		景区地址
			Longitude	double		NO		经度
			Latitude	double		NO		纬度
			Content	longtext		YES		景点介绍
			RecommendLevel	int(11)		NO		推荐指数，越大越好
			PicUrl	varchar(255)		YES		景点首页图片URL
			CreateTime	datetime		NO		
			$TourAreamodel->save(); */
			if ($TourAreamodel->load($posts,'') && $TourAreamodel->validate($posts,'') 
				&& $TourAreamodel->save()) {
				//添加成功
			}
			
			if($TourAreamodel->validate() && $TourAreamodel->save()){
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
				$Organization['data']=array();
			}else{
				$msgarr=$TourAreamodel->getErrors();
				$msg=reset($msgarr)[0];
				$Organization['code']="10003";
				$Organization['msg']="删除失败,".$msg;
				$Organization['data']=array();
			}
			$res['code']="10003";
			$res['msg']="添加失败";
			$res['data']=array();
		}
		return \yii\helpers\Json::encode($res);
	}
	//删除
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
			try {
				$TourAreamodel=new TourArea();//
				$isdelone=TourArea::deleteAll(['OrganizationID'=>$tid]);
				
				if($isdelone ){//&& $isdeltwo && $isdelthree
						throw new \yii\db\Exception(); //手动抛出异常,再由下面捕获。
					}
				//事务提交成功
				$tr->commit();
			} catch (\yii\db\Exception $e) {
				//事务回滚失败
				$tr->rollBack();
				$Organization['code']="10003";
				$Organization['msg']="删除失败";
				$Organization['data']=array();
			}
			if($isdelone ){//&& $isdeltwo && $isdelthree
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
				$Organization['data']=array();
			}else{
				$msgarr=$TourAreamodel->getErrors();
				$msg=reset($msgarr)[0];
				$Organization['code']="10003";
				$Organization['msg']="删除失败,".$msg;
				$Organization['data']=array();
			}
			return \yii\helpers\Json::encode($Organization);
		}
		
		return \yii\helpers\Json::encode($Organization);
	}
	//修改
	public function actionEdit($tid){
        if(\Yii::$app->request->isPost() && $posts = \Yii::$app->request->post()){
            
        }
		if($posts){
			$TourAreamodel=new TourArea();//
			$TourAreamodel->tid=$tid;
			if ($TourAreamodel->load($posts,'') && $TourAreamodel->validate($posts,'') 
				&& $TourAreamodel->save()) {
				//添加成功
			}
			if($TourAreamodel->validate() && $TourAreamodel->save()){
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
				$Organization['data']=array();
			}else{
				$msgarr=$TourAreamodel->getErrors();
				$msg=reset($msgarr)[0];
				$Organization['code']="10003";
				$Organization['msg']="删除失败,".$msg;
				$Organization['data']=array();
			}
			$res['code']="10003";
			$res['msg']="添加失败";
			$res['data']=array();
		}
		return \yii\helpers\Json::encode($res);
	}
}
