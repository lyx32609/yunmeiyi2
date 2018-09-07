<?php
namespace common\models;
use Yii;
class OrganizationCheck extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_organization_check';
    }
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['CheckID', 'OrganizationID', 'AdminUserID'], 'integer'],
    	[['CreateTime'], 'safe'],
    	[['Explain'], 'string']
    	];
    }
	
	
	
}