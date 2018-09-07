<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Airline;
use common\models\FlightSearch;
use common\models\City;
use common\models\User;
use common\models\Msg;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'sign-up','captcha'],
                'rules' => [
                    [
                        'actions' => ['sign-up','captcha','login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
   
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
           /* 'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],*/
            'captcha' => [
            'class' => 'yii\captcha\CaptchaAction',
            //'class'=>'CCaptchaAction',
            'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            'backColor'=>0x000000,//背景颜色
            'maxLength' => 4, //最大显示个数
            'minLength' => 4,//最少显示个数
            'padding' => 7,//间距
            'height'=>35,//高度
            'width' => 120,  //宽度
            'foreColor'=>0xffffff,     //字体颜色
            'offset'=>12,        //设置字符偏移量 有效果
            //'controller'=>'login',        //拥有这个动作的controller
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionSendmsg(){//发送短信 调用示例：
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$post = \Yii::$app->request->post();
    	}else{
    		$post = Yii::$app->request->queryParams;
    	}
    	//$tel=$post['tel'];
    	$time=date('Y-m-d H:i:s',time());
    	$session = Yii::$app->session;
    	$tel=17686955520;//p($session["msg_$tel"]);die;13181730156
    	$code=generate_code();//无序验证码，
    	$res=sendmsg($tel, $code);//发送短信
    	$msg=new Msg();
    	$msg->Phone=$tel;
    	$msg->Msg=$code;//p(date('Y-m-d H:i:s',time()));die;
    	$msg->CreateTime=$time;//p(date('Y-m-d H:i:s',time()));die;
    	$session["msg_$tel"] = [
    	'Msg' => $code,
    	//'CreateTime' => date('Y-m-d H:i:s',time())
    	];
    	if($msg->save())
    	{
    		$end['data']='';//p($endarr);die;
    		$end['code']="10001";
    		$end['msg']="发送成功";
    	}else{
    		$end['data']='';//p($endarr);die;
    		$end['code']="10002";
    		$end['msg']="发送失败";
    	}
    	return \yii\helpers\Json::encode($end);
    	/* $response = \SmsDemo::sendSms(
    			"今启航旅游", // 短信签名
    			"SMS_109355114", // 短信模板编号
    			$tel, // 短信接收者13181730156。17686955520/15615610629/18611367150
    			Array(// 短信模板中字段的值
    					"code"=>$code,
    					//"product"=>"dsd"
    			)
    			//"123"   // 流水号,选填
    	); */
    	/* echo "发送短信(sendSms)接口返回的结果:\n";
    	print_r($response);
    	sleep(2);
    	$response = \SmsDemo::queryDetails(
    			"17686955520",  // phoneNumbers 电话号码
    			date('ymd',time()), // sendDate 发送时间
    			10, // pageSize 分页大小
    			1 // currentPage 当前页码
    			// "abcd" // bizId 短信发送流水号，选填
    	);
    	echo "查询短信发送情况(queryDetails)接口返回的结果:\n";
    	print_r($response); */
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
    	if(isMobile()){
			$isPost = \Yii::$app->request->isPost;
			$users=array();
	        if($isPost){
	            $users = \Yii::$app->request->post();
	        }else{
	            $users = Yii::$app->request->queryParams;
	        }
	        if(empty($users['code']))//验证码
	        {
	        	$user['code']="10004";
	        	$user['msg']="验证码为空";
	        	$user['data']=array();
	        }else{
	        	$session = Yii::$app->session;
	        	$tel=$users['UserPhone'];
	        	if ($session["msg_$tel"]['code'] !== $users['code']) {
	        		$user['code']="10004";
	        		$user['msg']="验证码错误";
	        		$user['data']=array();
	        	}
	        }
			$user=array();
			if(empty($users['UserPhone']))
			{
				$user['code']="10004";
				$user['msg']="账号为空";
				$user['data']=array();
			}elseif(empty($users['PasswordMD5']))
			{
				$user['code']="10005";
				$user['msg']="密码为空";
				$user['data']=array();
			}else{
				$mdpassword=md5($users['PasswordMD5']);
				$us=User::find()->where(['UserPhone'=>$users['UserPhone'],'PasswordMD5'=>$mdpassword])->asArray()->one();
				if(is_array($us) && count($us)>0)
				{
					$user['code']="10001";
					$user['msg']="登陆成功";
					$user['data']=$us;
				}else{
					$user['code']="10002";
					$user['msg']="没有该用户";
					$user['data']=array();
				}
			}
			return \yii\helpers\Json::encode($user);
        }else{
        	if (!Yii::$app->user->isGuest) 
        	{
            return $this->goHome();
        	}
	        $model = new LoginForm();
	        //p($model);die;
	        if ($model->load(Yii::$app->request->post()) && $model->login()) {
	            return $this->goBack();
	        } else {
	            return $this->renderPartial ('login', [ 'model' => $model]);//renderPartial
	        }
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     *$model->load(Yii::$app->getRequest()->post())
                && $model->validate()
                && $rolesModel->load(yii::$app->getRequest()->post())
                && $rolesModel->validate()
                && $model->save()
     *
     * @return mixed
     */
    public function actionSignup()
    {
    	$usermodel=new User();
    	$isPost = \Yii::$app->request->isPost;
    	if($isPost){
    		$users = \Yii::$app->request->post();
    	}else{
    		$users = Yii::$app->request->queryParams;
    	};//p(yii::$app->request->post());p(yii::$app->getRequest()->post());echo 111;
    	if($usermodel->load(yii::$app->getRequest()->post(),'')
    	&& $usermodel->validate()){
    		echo 1;
    	}else{
    		$msgarr=$usermodel->getErrors();
    		$msg=reset($msgarr)[0];echo $msg;
    		echo 22;
    	}echo 33;die;
    	//p($usermodel->load(yii::$app->request->post(),''));echo 1;die;
    	p(yii::$app->request->post());
    	p($usermodel->load(yii::$app->getRequest()->post(),''));echo 111;
    	if ($usermodel->validate()) {
    		echo 77;
    	}echo 88;p($usermodel->getErrors());$msgarr=$usermodel->getErrors();
    	$msg=reset($msgarr);p($msg);die;
    	echo $usermodel->getValidators()[1]->message;echo 20;die;
    	if ($usermodel->load(yii::$app->getRequest()->post(),'')
    	&& !$usermodel->validate()) {
    		echo $usermodel->getValidators()[1]->message;die;
    	}
    	echo 1;die;
    	$userarr=array();
        if(isMobile()){
        	$isPost = \Yii::$app->request->isPost;
			$users=array();
	        if($isPost){
	            $users = \Yii::$app->request->post();
	        }else{
	            $users = Yii::$app->request->queryParams;
	        }
	        
	        
	        
	        
	        
			$user=array();
	        $signps = md5($users['PasswordMD5']);
			if(empty($users['UserPhone']))
			{
				$user['code']="10004";
				$user['msg']="账号为空";
				$user['data']=array();
			}elseif(empty($users['PasswordMD5']))
			{
				$user['code']="10005";
				$user['msg']="密码为空";
				$user['data']=array();
			}else{
				$isuser=User::find()->where(['UserPhone'=>$users['UserPhone']])->asArray()->one();
				if(is_array($isuser) && count($isuser)>0)
				{
					$user['code']="10006";
					$user['msg']="用户已存在，请重新注册";
					$user['data']=array();
				}else{
					$usermodel=new User();
					$usermodel->UserPhone=$users['UserPhone'];
					$usermodel->PasswordMD5=$signps;
					$usermodel->CreateTime=date('Y-m-d H:i:s',time());
					$usermodel->UpdateTime=date('Y-m-d H:i:s',time());
					$usermodel->generateAuthKey();
					if($usermodel->save())
					{
						$UserID = $usermodel->attributes['UserID'];
						$us=User::find()->where(['UserID'=>$UserID])->asArray()->one();
		                $user["code"]="10001";
						$user["msg"]="添加成功";
						$user["data"]=$us;
					}else{
						$user["code"]="10002";
						$user["msg"]="添加失败";
						$user["data"]=array();
					}
				}
			}
			return \yii\helpers\Json::encode($user);
        }else{
            $model = new SignupForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            }

            return $this->render('signup', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
