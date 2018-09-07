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
/**
 * Site controller
 */
class AirticketOrder00Controller extends Controller
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
	//保存order数据
	public function actionAdd(){
		$orderModel = new AirticketOrder();
		$mailModel=new Mailaddress();
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $orderarr = \Yii::$app->request->post();
        }else{
            $orderarr = Yii::$app->request->queryParams;
        }
		if(!$orderarr)
		{
			$orderarr=[
				'Contract' => '吴fdf昊原',
				'CouponID' =>'' ,
				'CouponMoney' => '',
				'Email' => 'qw761754627@163.com',
				'FlightDate' => '2017-11-15 00:00:00',
				'FlightID' => '28df7,',
				'InsurancePrice' => '0',
				'MailItinerary' => '1',
				'Mobile' => '183 df9686 0752',
				'OrderMailID' => '12',
				'OrderType' => '01',
				'PassengerID' => '28,',
				'PayType' =>'0',
				'MailPrice' =>'',
				'DiscountPrice'=>'',
				'TicketID' => '26780',
				'UserID' => '46'
			];
			$orderarr['OrderID']=createOrderNm('01');//echo 1;
			p($orderModel->load($orderarr,''));
			p($orderModel->validate());
			p($orderModel->save());die;
			$orderModel->OrderNo=$orderarr['orderNo'];
			$orderModel->UserID=$orderarr['UserID'];
			$orderModel->PassengerID=$orderarr['PassengerID'];
			$orderModel->Contract=$orderarr['Contract'];
			$orderModel->Mobile=$orderarr['Mobile'];
			$orderModel->FlightID=$orderarr['FlightID'];
			$orderModel->FlightDate=$orderarr['FlightDate'];
			$orderModel->TicketID=$orderarr['TicketID'];
			$orderModel->InsurancePrice=$orderarr['InsurancePrice'];
			$orderModel->PostPrice=$orderarr['PostPrice'];
			$orderModel->TotalPay=$orderarr['TotalPay'];
			$orderModel->MailItinerary=$orderarr['MailItinerary'];
			$orderModel->OrderTime=$orderarr['OrderTime'];
			$orderModel->Paytime=$orderarr['Paytime'];
			$orderModel->PayType=$orderarr['PayType'];
			$orderModel->Status=$orderarr['Status'];
			if($orderModel->insert())
			{
				echo "购买成功";
				if($orderarr['MailItinerary']=="1")
				{
					//如果邮寄则添加邮寄数据
					$orderid=$orderModel->attributes['OrderID'];
					$mailModel->orderID=$orderid;
					$mailModel->Phone=$orderarr['Mobile'];
					$mailModel->Address=$orderarr['Address'];
					$mailModel->Contact=$orderarr['Contact'];
					$mailModel->CreateTime=date('Y-m-d H:i:s',time());
					$mailModel->insert();
				}
			}else{
				echo "购买失败";
			}
		}else{
			echo "信息错误";
		}
	}
}
