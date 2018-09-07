<?php
namespace common\models;
use Yii;
class TourRouteDaily extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_tour_route_daily';
    }
	
	
	
}