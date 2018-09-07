<?php
namespace common\models;
use Yii;
class Organization extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_organization';
    }
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['OrganizationType', 'OrganizationID', 'AdminUserID','CheckState'], 'integer'],
    	[['CreateTime','UpdateTime'], 'safe'],
    	[['LegalRepresentative','OrganizationName','StateType'], 'string', 'max' => 50,'message'=>'输入的字符过长'],
    	[['Phone'],'string', 'max' => 20,'message'=>'手机号码错误，请输入正确手机号码'],
    	[['Address','BusinessLicenseUrl'],'string', 'max' => 255,'message'=>'输入的字符过长'],
    	];
    }
	
	
	
}