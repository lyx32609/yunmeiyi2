<?php
namespace common\models;
use Yii;
class WebPage extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_web_page';
    }
    public function rules()
    {
//     	PageID	int(11)		NO
//     	PageName	varchar(50)		YES		网页名称
//     	PageUrl	varchar(255)		YES		网页地址
//     	Status	tinyint(4)		YES
//     	UpdateTime	datetime
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['PageID', 'Status'], 'integer'],
    	[['CreateTime','UpdateTime'], 'safe'],
    	[['PageName'], 'string', 'max' => 50,'message'=>'输入的字符过长'],
    	[['PageUrl'],'string']
    	];
    }
	
	
	
}