<?php
namespace frontend\models;

use Yii;
use frontend\models\FlightList;
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
class Passenger extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_passenger';
    }
	
	/* public function getPassengers(){
		return $this->hasMany(FlightList::className(),['UserID'=>'id']);
	} */
}
