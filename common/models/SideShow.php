<?php
namespace common\models;
use Yii;

class SideShow extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_side_show';
    }
    public function rules()
    {
// SideShowID	int(11)		NO	是	
// SideShowName	varchar(255)		YES		轮播图名称
// PageID	int(11)		YES		页面ID
// PicCount	tinyint(4)		YES		
// CreateTime	datetime		YES		
// Status	tinyint(4)		YES	
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['SideShowID', 'PageID','PicCount','Status'], 'integer'],
    	[['CreateTime'], 'safe'],
    	[['SideShowName'], 'string'],
    	];
    }
    
}
