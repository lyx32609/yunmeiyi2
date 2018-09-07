<?php
namespace frontend\models;
use frontend\models\Airport;
use frontend\models\AirticketCabin;
use Yii;

class FlightList extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_flight_detail';
    }

	//关联机票
	public function getAirticketcabin0(){
		return $this->hasOne(AirticketCabin::className(),['FlightID'=>'FlightID']);
	}
	public function getTickets(){
    	return $this->hasMany(TicketCabin::className(),['FlightID'=>'FlightID','FlightDate'=>'DepartDate']);//->onCondition(['vw_flight_detail.DepartDate' => $time]);
    }
}
