<?php
namespace common\models;
use common\models\FlightSearch;
use common\models\PlanModel;

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
class FlightDynamic extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_flight_dynamic';
    }
	public function getFlightsearch(){
		return $this->hasOne(FlightSearch::className(),['FlightDynamicID'=>'FlightID']);
	}
	//关联机型
	public function getPlanemodel(){
		return $this->hasOne(PlaneModel::className(),['PlaneModelID'=>'PlaneModel']);
	}
}
