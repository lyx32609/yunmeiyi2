<?php
namespace common\models;
use common\models\Airline;
use common\models\FlightDynamic;
use common\models\FlightSearch;

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
class PlaneModel extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_plane_model';
    }
	public function getFlightdynamic(){
		return $this->hasMany(FlightDynamic::className(),['PlaneModelID'=>'PlaneModel']);
	}

}
