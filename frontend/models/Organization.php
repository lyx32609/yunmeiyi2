<?php
namespace frontend\models;

use Yii;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class Organization extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_organization';//tb_organization公司机构表
    }
    public function rules()
    {
    	return [
    	[['OrganizationType', 'OrganizationID', 'StateType'], 'integer'],
    	[['CreateTime'], 'safe'],
    	[['OrganizationName', 'LegalRepresentative', 'Address'], 'string', 'max' => 50],
    	[['Phone'], 'string', 'max' => 20],
    	[['IDCardNo'], 'string', 'max' => 18],
    	[['auth_key'], 'string', 'max' => 32],
    	[['password_reset_token'], 'string', 'max' => 255],
    	];
    }
    public function attributeLabels()
    {
    	return [
    	'OrganizationName' => '公司机构名称',
    	'LegalRepresentative' => '法人代表姓名',
    	'Phone' => '联系电话',
    	'Address' => '地址',
    	'OrganizationType' => '机构类型',
    	'BusinessLicenseUrl' => '营业执照照片',
    	];
    }
    public static function findIdentity($id)
    {
    	return static::findOne(['OrganizationID' => $id]);
    }
    public static function findByUsername($username)
    {
    	return static::findOne(['OrganizationName' => $username]);
    }
    
    public static function findByPhone($phone)
    {
    	return static::findOne(['Phone' => $phone]);
    }
    
    public function getId()
    {
    	return $this->getPrimaryKey();
    }
    
    public function validateAuthKey($authKey)
    {
    	return $this->getAuthKey() === $authKey;
    }
    
    public function validatePassword($password)
    {
    	//echo Yii::$app->security->validatePassword($password, $this->PasswordMD5);
    	return md5($password)==$this->PasswordMD5;
    }
	
	
}
