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
use frontend\models\City;
use frontend\models\FlightList;

/**
 * Site controller
 */
class FlightController extends Controller
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
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
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//		$indexarr=Airline::find()->limit(5)->all();
//		print_r($indexarr);
		$flightarrs=array();
		$searchModel = new FlightList();
        $isPost = \Yii::$app->request->isPost;
        if($isPost){
            $queryParams = \Yii::$app->request->post();
        }else{
            $queryParams = Yii::$app->request->queryParams;
        }
		if($queryParams)
		{
			$departcity=City::find()->where(['zonename' =>$queryParams['departcity']]) ->one();
			$arrivecity=City::find()->where(['zonename' =>$queryParams['departcity']]) ->one();
			$departcity2=City::find()->where(['zonename' =>$queryParams['departcity2']]) ->one();
			$arrivecity2=City::find()->where(['zonename' =>$queryParams['arrivecity2']]) ->one();
			$queryParams['DzoneID']=$departcity['ZoneID'];
			$queryParams['AzoneID']=$arrivecity['ZoneID'];
			$queryParams['DzoneID2']=$departcity2['ZoneID'];
			$queryParams['AzoneID2']=$arrivecity2['ZoneID'];
			//print_r($queryParams);exit();
			if(!array_key_exists("DepartTime1",$queryParams) && !in_array("DepartTime1",$queryParams))
			{
				$queryParams['DepartTime1']="";
			}
			if(!array_key_exists("DepartTime2",$queryParams) && !in_array("DepartTime2",$queryParams))
			{
				$queryParams['DepartTime2']="";
			}
			if(!array_key_exists("trale_type",$queryParams) && !in_array("trale_type",$queryParams))
			{
				$queryParams['trale_type']="D";
			}
			if($queryParams['trale_type']=="S")
			{//往返接口
				$flightarr=$this->actionWfone($queryParams);
				if(isMobile()){//移动端
					return \yii\helpers\Json::encode($flightarr);
				}else{
					return $this->render('wfone',['flights'=>$flightarr['data'],'serars'=>$queryParams]);
				}
			}elseif($queryParams['trale_type']=="H"){//多程
				//往返接口
				$flightarr=$this->actionWfone($queryParams);
				if(isMobile()){//移动端
					return \yii\helpers\Json::encode($flightarr);
				}else{
					return $this->render('dcone',['flights'=>$flightarr['data'],'serars'=>$queryParams]);
				}
				
			}else{
				//单程接口
				
				if($queryParams['DepartTime1']=="")
				{
					$start_date=date("Y-m-d 00:00:00",time());
				}else{
					$stime=strtotime($queryParams['DepartTime1']);
					$start_date=date("Y-m-d H:i:s",$stime);
				}
				if($departcity['ZoneID']=="" || $arrivecity['ZoneID']=="")
				{
					$flightarrs['code']="10002";
					$flightarrs['msg']="请求失败，参数错误";
					$flightarrs['data']=array();
				}else{
					$flightarr=FlightList::find()->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'=>$arrivecity['ZoneID'],'DepartDate'=>$start_date])->limit(10)->asArray()->all();
				
					if(is_array($flightarr) && count($flightarr)>0)
					{
						foreach($flightarr as $k=>$v){
							$rdt=explode(':', $v['RealDepartTime']);
							$rat=explode(':', $v['RealArriveTime']);
							$dt=explode(':', $v['DepartTime']);
							$at=explode(':', $v['ArriveTime']);
							$flightarr[$k]["RealDepartTime"]=$rdt[0].":".$rdt[1];
							$flightarr[$k]["RealArriveTime"]=$rat[0].":".$rat[1];
							$flightarr[$k]["DepartTime"]=$dt[0].":".$dt[1];
							$flightarr[$k]["ArriveTime"]=$at[0].":".$at[1];
						}
						$flightarrs['code']="10001";
						$flightarrs['msg']="请求成功";
						$flightarrs['data']=$flightarr;
					}else{
						$flightarrs['code']="10003";
						$flightarrs['msg']="请求成功,数据为空";
						$flightarrs['data']=array();
					}
				}
					
			}	
		}else{
			$flightarrs['code']="10002";
			$flightarrs['msg']="请求失败，参数错误";
			$flightarrs['data']=array();
			$queryParams['trale_type']="D";
			$queryParams['departcity']="";
			$queryParams['arrivecity']="";
			$queryParams['DepartTime1']="";
			$queryParams['DepartTime2']="";
		}
		if(isMobile())
		{
			//移动端
			return \yii\helpers\Json::encode($flightarrs);
		}else{
			//web端
			//p(getArrSet($flightarr));
			//p($flightarrs);
			//return \yii\helpers\Json::encode($flightarrs);
			return $this->render('index',['flights'=>$flightarrs['data'],'serars'=>$queryParams]);
			//return \yii\helpers\Json::encode($flightarr);
		}
		
    }
	public function actionWfone($arr)
	{
		$zhongjian=array();
		$flightarr=array();
		if($arr){//p($arr);die;
			if (time()>strtotime($arr['DepartTime1'])) {//判断时间是否为过去时间
				$arr['DepartTime1']=date("Y-m-d",time());//去程开始时间
			}else{
				$arr['DepartTime1']=date("Y-m-d",$arr['DepartTime1']);//去程开始时间
			}
			//p($arr);die();
			$flight1arr=FlightList::find()->where(['DepartCityID'=>$arr['DzoneID'],'ArriveCityID'=>$arr['AzoneID']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime1']])->limit(10)->asArray()->all();//去程最好是数据库操作
			$flight2arr=FlightList::find()->where(['DepartCityID'=>$arr['AzoneID'],'ArriveCityID'=>$arr['DzoneID']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime2']])->orderBy("DepartTime asc")->asArray()->one();//返程最低价
			$flight3arr['FlightWfid']=$flight2arr['FlightDynamicID'];
			$flight3arr['FlightWfprice']=77;
			foreach ($flight1arr as $v){
				$v['FlightWfid']=$flight2arr['FlightDynamicID'];
				$v['FlightWfprice']=890;
				$v['FlightWftime']=$arr['DepartTime2'];
				$v['Wfgoid']=$arr['AzoneID'];
				$v['Wftoid']=$arr['DzoneID'];
				$zhongjian[]=$v;
			}
			if(is_array($zhongjian) && count($zhongjian)>0){
				$endarr['data']=$zhongjian;//p($endarr);die;
				$endarr['code']="10001";
				$endarr['msg']="请求成功";
			}else{
				$endarr['data']=$zhongjian;//p($endarr);die;
				$endarr['code']="10002";
				$endarr['msg']="请求失败,数据为空";
			}
			
			return $endarr;
	
		}
	}
	/**
	 *wangfan jiekou lyx
	 *
	 * @return mixed
	 */
	public function actionWftwo()
	{
		$flightarr=array();
		/* if($arr['type']){//返程
	
		} */
		$isGet = \Yii::$app->request->isGet;
		if($isGet){//Yii::app->request->get()
			$arr = \Yii::$app->request->get();//p(Yii::$app->request->queryParams);echo 11;die;
		}else{
			$arr = Yii::$app->request->queryParams;
		}
		if($arr){//p($arr);die;
			$start_date=date("Y-m-d H:i:s",strtotime($arr[1]['wftime']));//去程开始时间
			$quarr=FlightList::find()->where(['FlightDynamicID'=>$arr[1]['qid']])->asArray()->one();//去程数据
			//p($quarr);die;
			$fanarr=FlightList::find()->where(['DepartCityID'=>$arr[1]['Wfgoid'],'ArriveCityID'=>$arr[1]['Wftoid']])
			->andFilterWhere(['=','DepartDate',$start_date])
			->andFilterWhere(['!=','FlightDynamicID',$arr[1]['fid']])->limit(10)->asArray()->all();
			$fanone=FlightList::find()->where(['FlightDynamicID'=>$arr[1]['fid']])
			->asArray()->one();//p($fanone);die;
			array_unshift($fanarr,$fanone);//p($fanarr);die;
			foreach ($fanarr as $v){
				$v['FlightWfprice']=890;
				$endarr[]=$v;
			}
			//p($quarr);die;
		}
		if(is_array($endarr) && count($endarr)>0)
		{
			$flightarr['data']=$endarr;//p($endarr);die;
			$flightarr['code']="10001";
			$flightarr['msg']="请求成功";
		}else{
			$flightarr['data']=array();//p($endarr);die;
			$flightarr['code']="10002";
			$flightarr['msg']="请求失败，数据为空";
		}
		
		//p($flightarr);
		if(isMobile())
		{//移动端
			return \yii\helpers\Json::encode($flightarr);
		}else{
			//web端
			return $this->render('wftwo',['flights'=>$flightarr['data'],'wfafter'=>$quarr]);
		}
	}
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
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
     * @return mixed
     */
    public function actionSignup()
    {
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
	//支付信息页面
	public function actionOrder(){
        $isGet = \Yii::$app->request->get();
		$flights=array();
        if($isGet){
            $flights = \Yii::$app->request->get();
        }else{
            $flights = Yii::$app->request->queryParams;
        }
		if($flights){
			$flightarr=FlightList::find()->where(['FlightDynamicID'=>$flights[1]['FlightDynamicID']])->asArray()->one();
			$s=getdate(strtotime($flightarr['DepartDate']));
			$flightarr['Week']=week($s['weekday']);
			if (count($flightarr) == count($flightarr, 1)) {
			    $flightarr['trale_type']="D";//一维数组表示单程
			} else {
			    $flightarr['trale_type']="S";//二维数组表示往返或多城
			}
			return $this->render('order',['flightarr'=>$flightarr]);
		}
		
	}
	//支付页面
	public function actionPay(){
		$isPost = \Yii::$app->request->isPost;
        if($isPost){
            $queryParams = \Yii::$app->request->post();
        }else{
            $queryParams = Yii::$app->request->queryParams;
        }
		//p($queryParams);die;
		//return $this->render('pay');
		return \yii\helpers\Json::encode($queryParams);
	}
	//支付完成页面
	public function actionOver(){
		return $this->render('over');
	}
}
