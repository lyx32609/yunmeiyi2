<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\City;
use common\models\TourRoute;
use common\models\TourRouteday;
use common\models\TourRouteDaily;
use common\models\TourSpot;
use common\models\Organization;
/**
 * 线路
 */
class TourSpotController extends Controller
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
    	$tourRoute=new TourRoute();
    	$data=$tourRoute->getRouteAll();
    	p($data);die;
    }
	
	//tianjia添加
	public function actionAdd(){
        if(\Yii::$app->request->isPost()){
            $posts = \Yii::$app->request->post();
        }
		if($posts){
			$tourroutemodel=new TourRoute();//
			/* $tourroutemodel->RouteName=$posts;
			TourSpotID	int(11)		NO	是	
			TourAreaID	int(11)		NO		所属景区ID
			Address	varchar(255)		NO		景区地址
			Longitude	double		NO		经度
			Latitude	double		NO		纬度
			Content	longtext		YES		景点介绍
			RecommendLevel	int(11)		NO		推荐指数，越大越好
			PicUrl	varchar(255)		YES		景点首页图片URL
			CreateTime	datetime		NO		
			$tourroutemodel->save(); */
			if ($tourroutemodel->load($posts,'') && $tourroutemodel->validate($posts,'') 
				&& $tourroutemodel->save()) {
				//添加成功
			}
			$routedaymodel=new TourRouteday();//旅游线路日程安排
			$routedaymodel->load($posts,'');
			$routedaymodel->RouteID=$posts;//添加线路主键id
			if ($routedaymodel->validate($posts,'')
			&& $routedaymodel->save()) {
				//添加成功
			}
			$routedaymodel->RouteID=$posts;//	线路id	varchar(50)	是
			$routedaymodel->RouteDay=$posts;//	线路日期	varchar(20)	否	由英文字母、数字和下划线组成
			$routedaymodel->OriginalPrice=$posts;//	成人线路原价	int	否	单位分
			$routedaymodel->AdultPrice=$posts;//	成人价格	Int	否	单位分
			$routedaymodel->ChildPrice=$posts;//	儿童价格	Int	否	单位分
			$routedaymodel->SingleRoomPrice=$posts;//	单房价	Int	否	单位分
			$routedaymodel->RefPrice=$posts;//	批量价格	Text	否	批量价格参考值（新增字段）?
			$routedaymodel->PushFee=$posts;//	分销商回扣	Double	否	单位分
			$routedaymodel->AdultStock=$posts;//	成人票库存	Int	否	成人票库存(新增字段)
			$routedaymodel->AdultSaleNumber=$posts;//	已卖出成人票	Int	否	已卖出的成人票(新增字段)
			$routedaymodel->ChildStock=$posts;//	儿童票库存	Int	否	儿童票库存(新增字段)
			$routedaymodel->ChildSaleNumber;//	已卖出儿童票	Int	否	已卖出的儿童票(新增字段)
			$routedaymodel->StockTip;//	库存提示	Int	否	没有注释，猜测是设置库存提示（当低于设置的这个数字会出现库存提示信息）（新增字段）
			$routedaymodel->GroupbuyDiscount;//	团购折扣	Double	否	团购折扣(新增字段)
			$routedaymodel->CouponMoney;//	优惠券价格	Int	否	优惠券价格（新增字段）
			$routedaymodel->CouponDay;//	优惠券日期	datetime	否	优惠券日期（新增字段）
			$routedaymodel->CreateTime;//	创建时间	datetime
			$routedailymodel=new TourRoutedaily();//旅游线路每天线路详情
			$routedailymodel->load($posts,'');
			$routedailymodel->RouteID=$posts;//添加线路主键id
			if ($routedailymodel->validate($posts,'')
			&& $routedailymodel->save()) {
				//添加成功
			}
			$routedailymodel->RouteDayID;//	线路日程表ID	bigint	否
			$routedailymodel->RouteID;//	线路ID	Int	否	外键
			$routedailymodel->DayNo;//	第几天	Tinyint	否
			$routedailymodel->SpotInfo;//	游览景点	LongText	否
			$routedailymodel->CreateTime;//	创建时间	Date	否	默认getdate()
			if($routedailymodel->validate() && $routedailymodel->save()){
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
				$Organization['data']=array();
			}else{
				$msgarr=$routedailymodel->getErrors();
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
				$tourroutemodel=new TourRoute();//
				$isdelone=TourRoute::deleteAll(['OrganizationID'=>$tid]);
				$routedaymodel=new TourRouteday();//旅游线路日程安排
				$isdeltwo=TourRouteday::deleteAll(['OrganizationID'=>$tid]);
				$routedailymodel=new TourRoutedaily();//旅游线路
				$isdelthree=TourRoutedaily::deleteAll(['OrganizationID'=>$tid]);
				if($isdelone && $isdeltwo && $isdelthree){
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
			$tourroutemodel=new TourRoute();//
			$isdelone=TourRoute::deleteAll(['OrganizationID'=>$tid]);
			$routedaymodel=new TourRouteday();//旅游线路日程安排
			$isdeltwo=TourRouteday::deleteAll(['OrganizationID'=>$tid]);
			$routedailymodel=new TourRoutedaily();//旅游线路
			$isdelthree=TourRoutedaily::deleteAll(['OrganizationID'=>$tid]);
			if($isdelone && $isdeltwo && $isdelthree){
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
				$Organization['data']=array();
			}else{
				$msgarr=$routedailymodel->getErrors();
				$msg=reset($msgarr)[0];
				$Organization['code']="10003";
				$Organization['msg']="删除失败,".$msg;
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
	//修改
	public function actionEdit($tid){
        if(\Yii::$app->request->isPost() && $posts = \Yii::$app->request->post()){
            
        }
		if($posts){
			$tourroutemodel=new TourRoute();//
			$tourroutemodel->tid=$tid;
			if ($tourroutemodel->load($posts,'') && $tourroutemodel->validate($posts,'') 
				&& $tourroutemodel->save()) {
				//添加成功
			}
			$routedaymodel=new TourRouteday();//旅游线路日程安排
			$routedaymodel->tid=$tid;
			$routedaymodel->load($posts,'');
			$routedaymodel->RouteID=$posts;//添加线路主键id
			if ($routedaymodel->validate($posts,'') && $routedaymodel->save()) {
				//添加成功
			}
			$routedailymodel=new TourRoutedaily();//旅游线路每天线路详情
			$routedailymodel->tid=$tid;
			$routedailymodel->load($posts,'');
			$routedailymodel->RouteID=$posts;//添加线路主键id
			if ($routedailymodel->validate($posts,'') && $routedailymodel->save()) {
				//添加成功
			}
			$routedailymodel->RouteDayID;//	线路日程表ID	bigint	否
			$routedailymodel->RouteID;//	线路ID	Int	否	外键
			$routedailymodel->DayNo;//	第几天	Tinyint	否
			$routedailymodel->SpotInfo;//	游览景点	LongText	否
			$routedailymodel->CreateTime;//	创建时间	Date	否	默认getdate()
			if($routedailymodel->validate() && $routedailymodel->save()){
				$Organization['code']="10001";
				$Organization['msg']="删除成功";
				$Organization['data']=array();
			}else{
				$msgarr=$routedailymodel->getErrors();
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
	public function actionDailyEdit($tid){//旅行日程详情修改
		if(\Yii::$app->request->isPost() && $posts = \Yii::$app->request->post()){
			$routedailymodel=new TourRoutedaily();//旅游线路每天线路详情
			$routedailymodel->tid=$tid;
			$routedailymodel->load($posts,'');
			$routedailymodel->RouteID=$posts;//添加线路主键id
			if ($routedailymodel->validate($posts,'') && $routedailymodel->save()) {
				//添加成功
			}else{
				$msgarr=$routedailymodel->getErrors();
				$msg=reset($msgarr)[0];
				$Organization['code']="10003";
				$Organization['msg']="修改失败,".$msg;
				$Organization['data']=array();
			}
		}else{
			$msgarr=$routedailymodel->getErrors();
			$msg=reset($msgarr)[0];
			$Organization['code']="10003";
			$Organization['msg']="修改失败,".$msg;
			$Organization['data']=array();
		}
	}
	public function actionDayEdit($tid){//旅游每天价格详情修改
		if(\Yii::$app->request->isPost() && $posts = \Yii::$app->request->post()){
			$routedaymodel=new TourRouteday();//旅游线路每天线路详情
			$routedaymodel->tid=$tid;
			$routedaymodel->load($posts,'');
			$routedaymodel->RouteID=$posts;//添加线路主键id
			if ($routedaymodel->validate($posts,'') && $routedaymodel->save()) {
				//添加成功
			}else{
				$msgarr=$routedaymodel->getErrors();
				$msg=reset($msgarr)[0];
				$Organization['code']="10003";
				$Organization['msg']="修改失败,".$msg;
				$Organization['data']=array();
			}
		}else{
			$msgarr=$routedaymodel->getErrors();
			$msg=reset($msgarr)[0];
			$Organization['code']="10003";
			$Organization['msg']="修改失败,".$msg;
			$Organization['data']=array();
		}
	}
}
