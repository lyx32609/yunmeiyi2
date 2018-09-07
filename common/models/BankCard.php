<?php
namespace common\models;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
class BankCard extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_bank_card';
    }
// BankCardID	int(11)		NO	是	银行卡ID
// UserID	int(11)		YES		
// BankNoPrefix	varchar(32)		YES		银行卡号
// BankCardType	tinyint(4)		YES		卡号类型
// BankCardNumber	varchar(255)		YES		
// IssueDate	datetime		YES		开户日期
// ValidDate	datetime		YES		截止日期
// PinCode	varchar(5)		YES		验证码
// BankCardName	varchar(50)		YES		开户名
// Status	tinyint(4)	0	NO		状态0正常1删除
// CreateTime	datetime		NO		
	
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['BankCardID','UserID','BankCardType','Status'], 'integer'],
    	[['BankNoPrefix','BankCardNumber','PinCode','BankCardName'], 'string'],
    	[['CreateTime','IssueDate','ValidDate'], 'safe'],
    	];
    }
    public function behaviors()
    {
    	return [
	    	[
		    	'class' => TimestampBehavior::className(),
		    	'attributes' => [
		    	# 创建之前
		    	ActiveRecord::EVENT_BEFORE_INSERT => ['CreateTime', 'UpdateTime'],
		    	# 修改之前
		    	ActiveRecord::EVENT_BEFORE_UPDATE => ['UpdateTime']
		    	],
		    	#设置默认值
		    	'value' => date('Y-m-d H:i:s',time())
	    	]
    	];
    }
    
	
}
