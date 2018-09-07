<?php
namespace common\models;
use Yii;
class TourOrder extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_tour_order';
    }
	
    public function rules()
    {
//     	OrderID	int(11)		NO
//     	UserID	int(11)		NO		用户ID
//     	Contract	varchar(255)		NO		联系人
//     	Mobile	varchar(32)		YES		手机号
//     	RouteID	int(11)		NO		线路ID
//     	StartDate	date		NO		线路开始日期
//     	AdultCount	smallint(6)		NO		成人数
//     	ChildCount	smallint(6)		NO		儿童数
//     	InsurancePrice	int(11)	0	YES		保险费
//     	GoodsPrice	int(11)		NO		产品总价
//     	CouponID	int(11)		YES		优惠券ID
//     	CouponMoney	int(11)		YES		优惠券价格
//     	TotalPrice	int(11)		NO		订单总费用
//     	TotalPay	int(11)		NO		已支付费用
//     	OrderTime	date		NO		下单时间
//     	PayTime	date		NO		支付时间
//     	PayType	tinyint(4)		NO		支付类型
//     	Status	int(11)		NO		订单状态0正常2改签2已取消
    	return [
    	[['OrderID','UserID','OrderMailID','TicketID','GoodsPrice','InsurancePrice','MailPrice','CouponID','CouponMoney','TotalPrice','TotalPay','MailItinerary','PayType'],'integer'],
    	[['OrderNo','PassengerID', 'Contract','Mobile','Email','FlightID','FlightDate','OrderTime','Paytime'], 'string'],
    	['Status', 'default', 'value' => 0],
    	['Paytime','default'],
    	];
    }
	
	
}