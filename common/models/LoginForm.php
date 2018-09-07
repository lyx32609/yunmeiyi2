<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\captcha\Captcha;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $UserPhone;
    public $PasswordMD5;
    public $rememberMe = true;
    public $verifyCode;
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['UserPhone', 'PasswordMD5'], 'required'],
            ['verifyCode', 'required','message'=>'请输入验证码！'],
            ['verifyCode', 'captcha','message'=>'验证码错误！'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['PasswordMD5', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function attributeLabels()
    {
        return [
            'UserPhone' => '手机号',
            'PasswordMD5' => '密码' ,
            'rememberMe' => '记住密码',
            'verifyCode' => '验证码',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getPhone();
            //echo  ($user->validatePassword($this->PasswordMD5));die;
            if (!$user || !$user->validatePassword($this->PasswordMD5)) {
                $this->addError($attribute, 'Incorrect LoginName or password.');
            }
        }
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getPhone(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
   /* protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->LoginName);
        }
        return $this->_user;
    }*/
    protected function getPhone()
    {
        if ($this->_user === null) {
            $this->_user = User::findByPhone($this->UserPhone);
        }
        return $this->_user;
    }
}
