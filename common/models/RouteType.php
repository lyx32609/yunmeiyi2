<?php
namespace common\models;
use Yii;
class RouteType extends \yii\db\ActiveRecord
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
        return 'list_route_type';
    }
	
	
	
}