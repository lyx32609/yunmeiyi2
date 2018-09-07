<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 * This is the model class for table "tb_user".
 *
 * @property integer $UserID
 * @property string $LoginName
 * @property string $PasswordMD5
 * @property string $UserPhone
 * @property string $IDCardNo
 * @property string $NickName
 * @property integer $UserRole
 * @property integer $OrganizationID
 * @property integer $StateType
 * @property string $CreateTime
 * @property string $auth_key
 * @property string $password_reset_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [[
            'class' => TimestampBehavior::className(),
            /*'createdAtAttribute' => 'CreateTime',// 自己根据数据库字段修改
            'updatedAtAttribute' => 'UpdateTime', // 自己根据数据库字段修改, // 自己根据数据库字段修改
            //'value'   => new Expression('NOW()'),
            'value'   => function(){return date('Y-m-d H:i:s',time());},*/
           ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['LoginName', 'PasswordMD5', 'UserPhone', 'IDCardNo', 'NickName', 'UserRole', 'OrganizationID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
            [['UserRole', 'OrganizationID', 'StateType'], 'integer'],
            [['CreateTime'], 'safe'],
            [['LoginName', 'PasswordMD5', 'NickName'], 'string', 'max' => 2],
            [['UserPhone'], 'string', 'max' => 11,'message'=>'请输入正确手机号'],
            ['UserPhone','unique','message'=>'手机号已被注册，请登录'],
            [['IDCardNo'], 'string', 'max' => 18],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'LoginName' => 'Login Name',
            'PasswordMD5' => 'Password Md5',
            'UserPhone' => 'User Phone',
            'IDCardNo' => 'Idcard No',
            'NickName' => 'Nick Name',
            'UserRole' => 'User Role',
            'OrganizationID' => 'Organization ID',
            'StateType' => 'State Type',
            'CreateTime' => 'Create Time',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['UserID' => $id]);
    }
    public function getOrganization()
    {
    	//第一个参数为要关联的子表模型类名，
    	//第二个参数指定 通过子表的customer_id，关联主表的id字段
    	return $this->hasOne(Organization::className(), ['AdminUserID' => 'UserID']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['LoginName' => $username]);
    }

    public static function findByPhone($phone)
    {
        return static::findOne(['UserPhone' => $phone]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            //'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //echo Yii::$app->security->validatePassword($password, $this->PasswordMD5);
        return md5($password)==$this->PasswordMD5;
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
