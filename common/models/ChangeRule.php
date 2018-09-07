<?php
namespace common\models;
use Yii;
class ChangeRule extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_change_rule';
    }
	
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['RuleName','RuleDetail'], 'required','message'=>'不能为空'],
    	[['ddd'], 'string', 'max' => 2,'message'=>'不能为空'],
    	//[['RouteNo'], 'safe'],
    	/* [['LoginName', 'PasswordMD5', 'NickName'], 'string', 'max' => 2],
    	 [['UserPhone'], 'string', 'max' => 11,'message'=>'请输入正确手机号'],
    	['UserPhone','unique','message'=>'手机号已被注册，请登录'],
    	[['IDCardNo'], 'string', 'max' => 18],
    	[['auth_key'], 'string', 'max' => 32],
    	[['password_reset_token'], 'string', 'max' => 255], */
    	];
    }
	
	
}