<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\TourOrder;
use common\models\TourRefund;
/**
 * Site controller
 */
class TourorderController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
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
		
    //获取线路订单接口
    public function actionIndex(){
    	$orderModel = new TourOrder();
    	$orders=array();
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$orderarr = \Yii::$app->request->post();
    	}else{
    		$orderarr = Yii::$app->request->queryParams;
    	}
    	if($orderarr){
    		$orderlist=TourOrder::find()->where(['UserID'=>$orderarr['UserID']])->asArray()->all();
    		if(is_array($orderarr) && count($orderlist)>0)
    		{
    			$orders['code']="10001";
    			$orders['msg']="请求成功";
    			$orders['data']=$orderlist;
    		}else{
    			$orders['code']="10001";
    			$orders['msg']="请求成功,数据为空";
    			$orders['data']=array(array());
    		}
    	}else{
    		$orders['code']="10002";
    		$orders['msg']="参数错误";
    	}
    	return \yii\helpers\Json::encode($orders);
    }
	//添加线路订单接口
	public function actionAdd(){
		$orderModel = new TourOrder();
		//$mailModel=new Mailaddress();
		$orders=array();
		$isPost = Yii::$app->request->isPost;
        if($isPost){
            $orderarr = Yii::$app->request->post();//p($orderarr);die;
        }else{
            $orderarr = Yii::$app->request->queryParams;
        }
//		p($orderarr);die;	
//		$orderarr=[
//			'OrderType'=>'01',
//			'UserID'=>'49',
//			'PassengerID'=>'17',
//			'Contract'=>'小张',
//			'Mobile'=>'18366666666',
//			'Email'=>'123.qq.com',
//			'FlightID'=>'341',
//			'FlightDate'=>'2017-11-20',
//			'TicketID'=>'30869',
//			'InsurancePrice'=>'0',
//			'MailPrice'=>'0',
//			'CouponID'=>'',
//			'CouponMoney'=>'',
//			'GoodsMoney'=>'1010',
//			'TotalPrice'=>'1010',
//			'TotalPay'=>'0',
//			'MailItinerary'=>'0',
//			'PayType'=>'0',
//			'OrderMailID'=>''
//		];
		if($orderarr){
			//$orderFlightDate=array_filter(explode(',',$orderarr['FlightDate']));
			//$ordertype=array_filter(explode(',',$orderarr['TicketID']));
			//$orderFlightID=array_filter(explode(',',$orderarr['FlightID']));
			//array_filter($ordertype);
			$orderarr['OrderID']=createOrderNm($orderarr['OrderType']);
			$orderarr['OrderTime']=date('Y-m-d H:i:s',time());
			
			if($orderModel->load($orderarr,'') && $orderModel->validate() && $orderModel->save())
			{
				$orders['code']="10001";
				$orders['msg']="添加订单成功";
			}else{
				$msgarr=$orderModel->getErrors();
				$msg=reset($msgarr)[0];//echo $msg;
				$orders['code']="10003";
				$orders['msg']=$msg;
			}
		}else{
			$orders['code']="10002";
			$orders['msg']="参数错误";
		}
		//$flights = explode(',', $arr['FlightDynamicID']);//p($flights);die;
		//$flights['trale_type']=
		
		return \yii\helpers\Json::encode($orders);
	}
	
	//订单付款接口
	public function actionPay(){
		$orderModel = new TourOrder();
		//$mailModel=new Mailaddress();
		$orders=array();
		$isPost = \Yii::$app->request->isPost;
		if($isPost){
			$orderarr = \Yii::$app->request->post();//p($orderarr);die;
		}else{
			$orderarr = Yii::$app->request->queryParams;
		}
		if($orderarr){
			//$orderFlightDate=array_filter(explode(',',$orderarr['FlightDate']));
			//$ordertype=array_filter(explode(',',$orderarr['TicketID']));
			//$orderFlightID=array_filter(explode(',',$orderarr['FlightID']));
			//array_filter($ordertype);
			$orderarr['OrderID']=createOrderNm($orderarr['OrderType']);
			$orderarr['OrderTime']=date('Y-m-d H:i:s',time());
			$orderModel->load($orderarr,'');
			if($orderModel->save())
			{
				$orders['code']="10001";
				$orders['msg']="添加订单成功";
			}else{
				$msgarr=$orderModel->getErrors();
				$msg=reset($msgarr)[0];//echo $msg;
				$orders['code']="10003";
				$orders['msg']=$msg;
			}
				
				
		}else{
			$orders['code']="10002";
			$orders['msg']="参数错误";
		}
		//$flights = explode(',', $arr['FlightDynamicID']);//p($flights);die;
		//$flights['trale_type']=
	
		return \yii\helpers\Json::encode($orders);
	}
	//获取订单详情
	public function actionDetail(){
		$orders=array();
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $orderarr = \Yii::$app->request->post();
        }else{
            $orderarr = Yii::$app->request->queryParams;
        }
		if($orderarr){
			$orderdetail=TourOrder::find()->where(['OrderID'=>$orderarr['OrderID']])->asArray()->one();
			if($orderdetail){
				$orders['code']="10001";
				$orders['msg']="请求成功";
				$orders['data']=array($orderdetail);
			}else{
				$orders['code']="10001";
				$orders['msg']="请求成功，数据为空";
				$orders['data']=array();
			}
		}else{
			$orders['code']="10002";
			$orders['msg']="参数有误";
			$orders['data']=array();
		}
		return \yii\helpers\Json::encode($orders);
	}
	//退单
	public function actionRefund(){
		$orders=array();
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $orderarr = \Yii::$app->request->post();
        }else{
            $orderarr = Yii::$app->request->queryParams;
        }
		if($orderarr){
			$refundmodel=new TourRefund();
			if($refundmodel->load($orderarr,'')
			&& $refundmodel->validate() && $refundmodel->save()){
				$orders['code']="10001";
				$orders['msg']="申请退单成功";
				$orders['data']=array();
			}else{
				$orders['code']="10003";
				$orders['msg']="申请退单失败";
				$orders['data']=array();
			}
		}else{
			$orders['code']="10002";
			$orders['msg']="参数错误";
			$orders['data']=array();
		}
		return \yii\helpers\Json::encode($orders);
	}
}
