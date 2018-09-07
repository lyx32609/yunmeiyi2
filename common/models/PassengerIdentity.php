<?php
namespace common\models;
use Yii;
/**
 * User model
 *
 PassengerKeyID	int(11)		NO		主键
PassengerID	int(11)		YES		乘客ID，外键
IDType	tinyint(4)		YES		证件类型，外键
IDNumber	varchar(32)		YES		证件号码
IssueDate	date		YES		签发日期
ExpiryDate	date		YES		过期日期
CreateTime	datetime		YES		创建时间
Status	tinyint(4)		YES		状态 0正常1删除
 */
class PassengerIdentity extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_passenger_identity';
    }
	
	public function rules()
    {
        return [ 
            [['PassengerKeyID', 'PassengerID', 'IDType','Status'], 'integer'],
            [['IDNumber'], 'string'],
            [['IssueDate','ExpiryDate','CreateTime'], 'string'],
            ['Status', 'default', 'value' => 0],
        ];
    }
}
