<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\City;
use common\models\AirticketOrder;
use common\models\Mailaddress;
use common\models\AirticketRefund;
/**
 * Site controller
 */
class AirticketorderController extends Controller
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
		/*$orderarr=Array
			(
			    'Contract' => '',
			    'CouponID' => '',
			    'CouponMoney' => '',
			    'Email' =>'',
			    'FlightDate' => '2017-11-16 00:00:00',
			    'FlightID' => '404,396,',
			    'GoodsPrice' => 1770,
			    'InsurancePrice' => '0',
			    'MailItinerary' => 1,
			    'MailPrice' => 0,
			    'Mobile' => '183 9686 0752',
			    'OrderMailID' => 3,
			    'OrderType' => '01',
			    'PassengerID' => '28,29',
			    'PayType' => 0,
			    'TicketID' => '28240,28202',
			    'TotalPay' => '',
			    'TotalPrice' => 1770,
			    'UserID' => 29
			);*/
	//添加机票订单接口
	public function actionAdd(){
		$orderModel = new AirticketOrder();
		$mailModel=new Mailaddress();
		$orders=array();
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $orderarr = \Yii::$app->request->post();//p($orderarr);die;
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
		//p($orderarr);die;
		if($orderarr)
		{
			$orderFlightDate=array_filter(explode(',',$orderarr['FlightDate']));
			$ordertype=array_filter(explode(',',$orderarr['TicketID']));
			$orderFlightID=array_filter(explode(',',$orderarr['FlightID']));
			//array_filter($ordertype);
			if(!empty($ordertype) && isset($ordertype[1])){//多程
				$end=array();//p($ordertype);die;
				foreach($ordertype as $k=>$v){
					$orderarr['FlightDate']=$orderFlightDate[$k];
					$orderarr['FlightID']=$orderFlightID[$k];
					$orderarr['TicketID']=$v;
					$orderarr['OrderID']=createOrderNm($orderarr['OrderType']);
					$orderarr['OrderTime']=date('Y-m-d H:i:s',time());
					$_orderModel=clone $orderModel;
					$_orderModel->load($orderarr,'');//p($orderarr);die;
					if($_orderModel->validate() && $_orderModel->save())
					{
//						OrderID	varchar(50)		NO		订单id
//						Phone	varchar(32)		YES		手机号
//						Address	varchar(64)		YES		邮寄地址
//						Contact	varchar(32)		YES		联系人
//						CreateTime	datetime		NO		
//						UserID	int(11)		NO		
//						Status	tinyint(4)	0	YES		状态 0正常 1删除
						//$orderarr['OrderID']=Yii::$app->db->getLastInsertID();p($orderarr);die;
						//$mailModel->load($orderarr,'');
						$end[]=1;//p($end);die;
					}else{
						$end[]=0;
					}
				}//p($end);die;
				if($end[0] && $end[1]){
					$orders['code']="10001";
					$orders['msg']="添加订单成功";
				}else{
					$orders['code']="10003";
					$orders['msg']='添加失败';
				}
			}else{
				$orderarr['OrderID']=createOrderNm($orderarr['OrderType']);
				$orderarr['OrderTime']=date('Y-m-d H:i:s',time());
				$orderModel->load($orderarr,'');
				if($orderModel->save())
				{
					$orders['code']="10001";
					$orders['msg']="添加订单成功";
				}else{
					$msgarr=$passengerInfo->getErrors();
					$msg=reset($msgarr)[0];//echo $msg;
					$orders['code']="10003";
					$orders['msg']=$msg;
				}
			}
			
		}else{
			$orders['code']="10002";
			$orders['msg']="参数错误";
		}
		//$flights = explode(',', $arr['FlightDynamicID']);//p($flights);die;
		//$flights['trale_type']=
		
		return \yii\helpers\Json::encode($orders);
	}
	//获取机票订单接口
	public function actionIndex(){
		$orderModel = new AirticketOrder();
		$orders=array();
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $orderarr = \Yii::$app->request->post();
        }else{
            $orderarr = Yii::$app->request->queryParams;
        }
		if($orderarr){
			$orderlist=AirticketOrder::find()->where(['UserID'=>$orderarr['UserID']])->asArray()->all();
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
			$orderdetail=AirticketOrder::find()->with('airticketmails')->where(['OrderID'=>$orderarr['OrderID']])->asArray()->one();
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
			$refundmodel=new AirticketRefund();
			$refundmodel->OrderID=$orderarr['OrderID'];
			$refundmodel->Phone=$orderarr['Phone'];
			$refundmodel->RefundType=$orderarr['RefundType'];
			$refundmodel->Passengers=$orderarr['Passengers'];
			$refundmodel->BackMoney=$orderarr['BackMoney'];
			$refundmodel->PoundageFee=$orderarr['PoundageFee'];
			$refundmodel->RealBackMoney=$orderarr['RealBackMoney'];
			$refundmodel->CreateTime=date('Y-m-d H:i:s');
			$refundmodel->Remark=$orderarr['Remark'];
			if($refundmodel->save()){
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
