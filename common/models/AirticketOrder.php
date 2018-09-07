<?php
namespace common\models;
use Yii;
use common\models\AirticketMail;

class AirticketOrder extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_airticket_order';
    }
	public function rules()
    {
        return [ 
        	[['OrderID','UserID','OrderMailID','TicketID','GoodsPrice','InsurancePrice','MailPrice','CouponID','CouponMoney','TotalPrice','TotalPay','MailItinerary','PayType'],'integer'],
            [['OrderNo','PassengerID', 'Contract','Mobile','Email','FlightID','FlightDate','OrderTime','Paytime'], 'string'],
            ['Status', 'default', 'value' => 0],
            ['Paytime','default'],
        ];
    }
	//关联订单邮寄地址
	public function getAirticketmails(){
		return $this->hasOne(AirticketMail::className(),['OrderMailID'=>'OrderMailID']);
	}
}
