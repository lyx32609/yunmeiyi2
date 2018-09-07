<?php
namespace frontend\models;
use frontend\models\Airline;
use frontend\models\FlightDynamic;
use frontend\models\PlaneModel;
use frontend\models\Airport;
use Yii;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class FlightSearch extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_flight_static';
    }
	
//	public static function getCity(){
//		return $this->hasOne(Flight::className(),['DepartCityID'=>'ZoneID','ArriveCityID'=>'ZoneID']);
//	}
	//关联航空公司
	public function getAirline0(){
		return $this->hasOne(Airline::className(),['AirlineID'=>'AirlineID'])->select('AirlineID,AirlineFullName');
	}
	//关联查询起飞机场
	public function getDepartairport0(){
		return $this->hasOne(Airport::className(),['AirportID'=>'DepartAirportID'])->select('AirportID,AirportshortName');
	}
	
	//关联动态航班
	public function getFlightdynamic(){
		return $this->hasOne(FlightDynamic::className(),['FlightID'=>'FlightID']);
	}
	//关联查询抵达机场
//	public function getAirport1(){
//		return $this->hasOne(Airport::className(),['AirportID'=>'ArriveAirportID'])->select('AirportID,AirportshortName');
//	}
//	
	
	
}
