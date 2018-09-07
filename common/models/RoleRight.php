<?php
namespace common\models;
use Yii;
class RoleRight extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_role_right';
    }
    /*
     * RoleID	int(11)		NO	是	
RoleName	varchar(32)		NO		角色名称
RoleRights	varchar(50)		NO		可访问模块ID串，半角逗号隔开
OrganizationID	int(11)	0	YES		机构id
StateType	tinyint(1)	0	NO		用户状态0正常1停用
CreateTime	datetime		NO		  */
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['RoleID', 'OrganizationID', 'StateType'], 'integer'],
    	[['CreateTime'], 'safe'],
    	['StateType', 'default', 'value' => 0],
    	[['RoleName','RoleRights'], 'string'],//, 'max' => 50,'message'=>'输入的字符过长'
    	];
    }
	
	
}