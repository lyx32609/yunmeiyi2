<?php
namespace common\models;
use Yii;

class Article extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_article';
    }
    /*ArticleID	int(11)		NO	是	图文消息id
AuthorName	varchar(255)		YES		作者名称
CoverPicUrl	varchar(255)		NO		图文消息图片地址
ArticleTitle	varchar(255)		NO		图文消息标题
BriefContent	varchar(255)		YES		图文消息简介
ArticleContent	longtext		NO		内容
ReadCount	int(11)		YES		阅读量
UserID	int(11)		NO		创建者id
IsDelete	tinyint(1)	0	NO		是否删除默认0，删除为1
DeleteUserID	int(11)		YES		删除用户id
UpdateTime	datetime		NO		更新时间
DeleteTime	datetime		NO		删除时间  */
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	[['ArticleID', 'ReadCount', 'UserID','DeleteUserID','IsDelete'], 'integer'],
    	[['DeleteTime','UpdateTime'], 'safe'],
    	[['AuthorName','CoverPicUrl','ArticleTitle','BriefContent','ArticleContent'], 'string'],
    	];
    }
}
