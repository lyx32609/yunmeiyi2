<?php
namespace common\models;
use Yii;

class SidePic extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_side_pic';
    }
    public function rules()
    {
//     	SidePicID	int(11)		NO
//     	SideshowID	int(11)		NO
//     	SidePicUrl	varchar(255)		YES		图片路径
//     	SideName	varchar(255)		YES		轮播图名称
//     	LinkUrl	varchar(255)		YES		链接地址
//     	Status	tinyint(4)		YES
//     	CreateTime	datetime		YES
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['SidePicID', 'Status'], 'integer'],
    	[['CreateTime'], 'safe'],
    	[['SidePicUrl','LinkUrl','SideName'], 'string'],
    	];
    }
    
}
