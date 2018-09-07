<?php
namespace common\models;
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
class Passenger extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_passenger';
    }
	
	public function rules()
    {
        return [ 
            [['PassengerID', 'UserID', 'IDType','Sex','Country','Province','City'], 'integer'],
            [['Identity', 'PassengerName', 'FirstName','LastName','BirthPlace','Nationality','Address','PassengerPhone'], 'string'],
            [['IssueDate','ExpiryDate','BirthDate'], 'string'],
            ['Status', 'default', 'value' => 0],
        ];
    }
}
