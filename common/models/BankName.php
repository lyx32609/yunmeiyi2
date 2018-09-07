<?php
namespace common\models;
use Yii;
class BankName extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_bank_name';
    }
//     BankNoPrefix	int(11)		YES		银行卡编码标识
//     BankName	varchar(255)		YES		银行名称
//     BankCardType	varchar(255)		YES		银行卡种类
	
    public function rules()
    {
    	return [
	    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
	    	[['BankNoPrefix'], 'integer'],
	    	[['BankName','BankCardType'], 'string'],
    	];
    }
	
}
