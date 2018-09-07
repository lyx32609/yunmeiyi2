<?php
namespace common\models;
use Yii;
use common\models\TourRouteDaily;
use common\models\TourRouteDay;
class TourRoute extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * 
RouteID				线路id
RouteName			线路名称
RouteNo				线路编号
RouteType			线路类型
Days				天数
Nights				过夜数
OrganizationID		所属单位ID
StartCityID			出发城市ID
DestinationCityID			目的城市ID
EndCityID			离团城市ID
MinPassengerCount		最少成团人数
MaxPassengerCount		最多成团人数
AheadDays			最晚提前预订天数
Period				出发日期，周1,3,5表示周一三五，月1,11表示每月1、11号，日表示每天
AdultPrice			成人价格
ChildPrice			儿童价格
SingleRoomPrice		单房价
AdditionalCount			额外服务数
AdditionalService1			额外服务内容1
AdditionalPrice1			额外服务收费1
AdditionalService2			额外服务内容2
AdditionalPrice2		额外服务收费2
AdditionalService3			额外服务内容3
AdditionalPrice3		额外服务收费3
AdditionalService4			额外服务内容4
AdditionalPrice4			额外服务收费4
AdditionalService5			额外服务内容5
AdditionalPrice5			额外服务收费5
Feature					行程特色
PriceInclude			报价已包含
PriceExclude			报价未包含
SpecialAttention		预定须知/特别提醒
CreateTime		
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_tour_route';
    }
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['RouteName','RouteNo'], 'required','message'=>'不能为空'],
    	//[['RouteNo'], 'safe'],
    	/* [['LoginName', 'PasswordMD5', 'NickName'], 'string', 'max' => 2],
    	[['UserPhone'], 'string', 'max' => 11,'message'=>'请输入正确手机号'],
    	['UserPhone','unique','message'=>'手机号已被注册，请登录'],
    	[['IDCardNo'], 'string', 'max' => 18],
    	[['auth_key'], 'string', 'max' => 32],
    	[['password_reset_token'], 'string', 'max' => 255], */
    	];
    }
    public function getRouteAll()
    {
    	return $this->hasMany(TourRouteDaily::className(), ['RouteID' => 'RouteID'])
    	->viaTable(TourRouteDay::tableName(), ['RouteID' => 'RouteID']);
    }
	
}