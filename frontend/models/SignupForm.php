<?php
namespace frontend\models;

use yii;
use yii\base\Model;
use common\models\User;
use yii\captcha\Captcha;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $LoginName;
    public $UserPhone;
    public $PasswordMD5;
    public $verifyCode;
    public $rePasswordMD5;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['verifyCode', 'required','message'=>'请输入验证码！'],
            ['verifyCode', 'captcha','message'=>'验证码错误！'],

            ['UserPhone', 'filter', 'filter' => 'trim'],
            ['UserPhone', 'required','message'=>'手机号不能为空！'],
            ['UserPhone', 'string', 'max' => 50],
            ['UserPhone', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机号已被使用！'],

            ['PasswordMD5', 'required','message'=>'密码不能为空！'],
            ['PasswordMD5', 'string', 'min' => 6],

            ['rePasswordMD5', 'required','message'=>'请再次输入密码！'],
            ['rePasswordMD5', 'string', 'min' => 6],

            ['PasswordMD5', 'compare', 'compareAttribute'=>'rePasswordMD5', 'message'=>'两次输入密码不一致，请检查所输入的密码！']
        ];
    }
    public function attributeLabels()
    {
        return [
            'LoginName' => '用户名',
            'UserPhone' => '手机号',
            'PasswordMD5' => '密码' ,
            'verifyCode' => '验证码',
            'rePasswordMD5' => '请确认密码' ,
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()//web端
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->LoginName = $this->LoginName;
        $user->UserPhone = $this->UserPhone;
        $user->PasswordMD5 = md5($this->PasswordMD5);
        $user->generateAuthKey();
        //p($user);
        return $user->save() ? $user : null;
    }
    public function m_signup() //移动端
    {
        $user = new User();
        $user->LoginName ="aaaaaa";
        $user->UserPhone = $this->UserPhone;
        $user->PasswordMD5 = md5($this->PasswordMD5);
        $user->generateAuthKey();
        //p($user);
        return $user->save() ? $user : null;
    }
}
