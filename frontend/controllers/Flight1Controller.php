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
class Flight1Controller extends Controller
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
    


    public function actionTest()
    {
    	$arr=City::find()->one();//p($arr);
    	//$_SERVER['HTTP_USER_AGENT']="okhttp/3.4.1";
    	
    	if(isPc())
    	{
    		//pc端
    		return \yii\helpers\Json::encode($arr);
    	
    	}else{
    		echo $_SERVER['HTTP_USER_AGENT'];die;	}
    	
    	if(isApp())
    	{
    		//移动端
    		return \yii\helpers\Json::encode($arr);
    		
    	}else{
    		echo $_SERVER['HTTP_USER_AGENT'];die;	}
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
		$flightarr=array();
		//$searchModel = new FlightList();
        $isPost = \Yii::$app->request->isPost;
        if($isPost){
            $queryParams = \Yii::$app->request->post();
        }else{
            $queryParams = Yii::$app->request->queryParams;
        }
		if($queryParams)
		{
			$stime=strtotime($queryParams['DepartTime1']);//string(10) "2017-09-28"
			$start_date=date("Y-m-d H:i:s",$stime);//结束时间
			$stime1=strtotime($queryParams['DepartTime2']);//string(10) "2017-09-28"
			$end_date=date("Y-m-d H:i:s",$stime1);//结束时间
			$departcity=City::find()->where(['zonename' =>$queryParams['departcity']]) ->one();
			$arrivecity=City::find()->where(['zonename' =>$queryParams['arrivecity']]) ->one();
			$flightarr=FlightList::find()->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'=>$arrivecity['ZoneID']])->andFilterWhere(['between','DepartDate',$start_date, $end_date])->limit(10)->asArray()->all();
			$flight2arr=FlightList::find()->where(['DepartCityID'=>$arrivecity['ZoneID'],'ArriveCityID'=>$departcity['ZoneID']])
    		->andFilterWhere(['between','DepartDate',$start_date, $end_date])->orderBy("DepartTime asc")->asArray()->one();//返程
    		//p($flight2arr);die;
			$cookies = Yii::$app->response->cookies;
			$cookies->add(new \yii\web\Cookie([
					'name' => 'wfarr',
					'value' => 1 ]));
			$cookie = Yii::$app->request->getCookies();
			//echo $cookie['wfarr'];die;
			/* $arrs=array(
					array('A','B'),
					array('1','2'),);
			p(getArrSet($arrs));die; */
			
			
			$stime=strtotime($queryParams['DepartTime1']);//string(10) "2017-09-28"
			$stime1=strtotime($queryParams['DepartTime1'])+86400;//开始时间
			$start_date=date("Y-m-d H:i:s",$stime1);//结束时间
			//p($start_date);die;
			$where['DepartCityID']=array('='=>$departcity['ZoneID']);
			$where['ArriveCityID']=array('='=>$arrivecity['ZoneID']);
			$where['DepartDate']=array('>'=>$start_date);
			$flight1arr=FlightList::find()->where($where)->limit(10)->asArray()->all();//p($flight1arr);
			//$flightarr=FlightList::find()->where([['=','DepartCityID',$departcity['ZoneID']],['=','ArriveCityID',$arrivecity['ZoneID']],['>','DepartDate',$start_date]])->limit(10)->asArray()->all();
			$where['ArriveCityID']=array('='=>$departcity['ZoneID']);
			$where['DepartCityID']=array('='=>$arrivecity['ZoneID']);
			//$flight1arr=FlightList::find()->where($where)->limit(10)->asArray()->all();
			$flight2arr=FlightList::find()->where($where)->limit(10)->asArray()->all();//p($flight2arr);die;
			$endarr=array($flight1arr,$flight2arr);//p($flight1arr);p($flight2arr);
			//p(getArrSet($endarr));die;
			
			
			
			if($queryParams['DepartTime1']=="" && $queryParams['DepartTime2']=="")
			{
				$flightarr=FlightList::find()->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'=>$arrivecity['ZoneID']])->limit(10)->asArray()->all();
			}elseif($queryParams['DepartTime1']!="" && $queryParams['DepartTime2']==""){
				$stime=strtotime($queryParams['DepartTime1']);//string(10) "2017-09-28"
				$start_date=date("Y-m-d H:i:s",$stime);//var_dump($start_date);die;
				$where['DepartCityID']=array('='=>$departcity['ZoneID']);
				$where['ArriveCityID']=array('='=>$arrivecity['ZoneID']);
				$where['DepartDate']=array('>'=>$start_date);
				
				$flightarr=FlightList::find()->where([['=','DepartCityID',$departcity['ZoneID']],['=','ArriveCityID',$arrivecity['ZoneID']],['>','DepartDate',$start_date]])->limit(10)->asArray()->all();
				$where['ArriveCityID']=array('='=>$departcity['ZoneID']);
				$where['DepartCityID']=array('='=>$arrivecity['ZoneID']);
				$flight1arr=FlightList::find()->where($where)->limit(10)->asArray()->all();
				$flight2arr=FlightList::find()->where($where)->limit(10)->asArray()->all();
				$endarr=array($flight1arr,$flight2arr);
				p(getArrSet($endarr));die;
				var_dump($flightarr);die;
				
				$flightarr=FlightList::find()->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'=>$arrivecity['ZoneID'],['>','DepartDate',$start_date]])->limit(10)->asArray()->all();
				var_dump($flightarr);die;
			}elseif($queryParams['DepartTime1']=="" && $queryParams['DepartTime2']!="")
			{
				$stime=strtotime($queryParams['DepartTime2']);
				$start_date=date("Y-m-d H:i:s",$stime);
				$flightarr=FlightList::find()->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'=>$arrivecity['ZoneID'],['>','DepartDate',$queryParams['DepartTime2']]])->limit(10)->asArray()->all();
			}else{
				$endarr=$this->actionWfone($queryParams);
				return $this->render('wfone',['flights'=>$endarr]);
				
				$stime=strtotime($queryParams['DepartTime1']);
				$etime=strtotime($queryParams['DepartTime2']);
				
				$start_date=date("Y-m-d H:i:s",$stime);
				$end_date=date("Y-m-d H:i:s",$etime);
				$flightarr=FlightList::find()->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'=>$arrivecity['ZoneID']])->andFilterWhere(['between','DepartDate',$start_date, $end_date])->limit(10)->asArray()->all();
			}
			//echo $flightarr->airline0->AirlineFullName;
//			foreach($flightarr as $v)
//			{
//				$v->airline0->AirlineFullName;
//			}
			//print_r($flightarr);
			
		}
		//p($flightarr);
		if(isMobile())
		{
			//移动端
			return \yii\helpers\Json::encode($flightarr);
		}else{
			//web端
			//p($flightarr);
			return $this->render('index',['flights'=>$flightarr]);
		}
        
    }
    
    
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionWfone($arr)
    {
    	$flightarr=array();
    	if($arr){//p($arr);die;
	    	if (time()>strtotime($arr['DepartTime1'])) {//判断时间是否为过去时间
	    		$start_date=date("Y-m-d H:i:s",strtotime(time()));//去程开始时间
	    	}else{
	    		$start_date=date("Y-m-d H:i:s",strtotime($arr['DepartTime1']));//去程开始时间
	    	}
	    	
	    	
	    	
	    	//$end_date=date("Y-m-d H:i:s",strtotime($arr['DepartTime1'])+86400);//去程结束时间
    		$cookies = Yii::$app->response->cookies;
    		$cookies->add(new \yii\web\Cookie([
    				'name' => 'wfarr',
    				'value' => $arr ]));
    		/* $where['DepartCityID']=array('='=>$departcity['ZoneID']);
    		$where['ArriveCityID']=array('='=>$arrivecity['ZoneID']);
    		$where['DepartDate']=array('>'=>$start_date);
    		$flightarr=FlightList::find()->where($where)->limit(10)->asArray()->all();
    		$where['ArriveCityID']=array('='=>$departcity['ZoneID']);
    		$where['DepartCityID']=array('='=>$arrivecity['ZoneID']);
    		$flight1arr=FlightList::find()->where($where)->limit(10)->asArray()->all();
    		$flight2arr=FlightList::find()->where($where)->limit(10)->asArray()->all();
    		$endarr=array($flight1arr,$flight2arr);
    		p(getArrSet($endarr));die; */
    		$flight1arr=FlightList::find()->where(['DepartCityID'=>$arr['ZoneID'],'ArriveCityID'=>$arr['ZoneID']])
    		->andFilterWhere(['=','DepartDate',$arr['qutime']])->asArray()->all();//去程最好是数据库操作
    		$flight2arr=FlightList::find()->where(['DepartCityID'=>$arr['ZoneID'],'ArriveCityID'=>$arr['ZoneID']])
    		->andFilterWhere(['=','DepartDate',$arr['DepartTime2']])->orderBy("DepartTime asc")->asArray()->one();//返程最低价
    		$flight3arr['FlightDynamicIDwf']=$flight2arr['FlightDynamicID'];
    		$flight3arr['FlightDynamicprice']=$flight2arr['WeekDay'];
    		foreach ($flight1arr as $v){
    			$v['FlightWfid']=$flight2arr['FlightDynamicID'];
    			$v['FlightWfprice']=$flight2arr['WeekDay']+890;
    			$v['FlightWftime']=$arr['fantime'];
    			$v['Wfgoid']=$arr['ZoneID'];
    			$v['Wftoid']=$arr['ZoneID'];
    			$zhongjian[]=$v;
    		}
    		$endarr=$zhongjian;
    		return $endarr;
    		
    	}/* else{
    		$arr = Yii::$app->request->queryParams;
    		$arr=$arr[1];
    	}
    	if($arr){//p($arr);die;
    		$start_date=date("Y-m-d H:i:s",strtotime($arr['wftime']));//去程开始时间
    		$end_date=date("Y-m-d H:i:s",strtotime($arr['wftime'])+86400);//去程结束时间
    		$quarr=FlightList::find($arr['qid'])->asArray()->one();//去程最好是数据库操作
    		$fanarr=FlightList::find($arr['qid'])->where(['DepartCityID'=>$arr['Wfgoid'],'ArriveCityID'=>$arr['Wftoid']])
    		->andFilterWhere(['between','DepartDate',$start_date, $end_date])
    		->andFilterWhere(['!=','FlightDynamicID',$arr['fid']])->asArray()->all();
    		$fanone=FlightList::find($arr['qid'])->where(['FlightDynamicID'=>$arr['fid']])
    		->asArray()->one();//p($fanone);die;
    		//$fanone['FlightWfprice']=$fanone['WeekDay']+890;
    		array_unshift($fanarr,$fanone);//p($fanarr);die;
    		foreach ($fanarr as $v){
    			$v['FlightWfprice']=$quarr['WeekDay']+890;
    			$endarr[]=$v;
    		}
    		if(isMobile()){
    			//移动端
    			return \yii\helpers\Json::encode($flightarr);
    		}else{
    			//web端//p($flightarr);
    			return $this->render('wftwo',['flights'=>$flight1arr,'wfone'=>$flight2arr]);
    		}
    		//p($endarr);die;
    	} */
    	//p($flightarr);
    	if(isMobile())
    	{
    		//移动端
    		return \yii\helpers\Json::encode($flightarr);
    	}else{
    		//web端
    		//p($flightarr);
    		return $this->render('wfone',['flights'=>$flight1arr,'wfone'=>$flight2arr]);
    	}
    }
    
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
    		$end_date=date("Y-m-d H:i:s",strtotime($arr[1]['wftime'])+86400);//去程结束时间
    		$quarr=FlightList::find($arr[1]['qid'])->asArray()->one();//去程最好是数据库操作
    		
    		$fanarr=FlightList::find($arr[1]['qid'])->where(['DepartCityID'=>$arr[1]['Wfgoid'],'ArriveCityID'=>$arr[1]['Wftoid']])
    		->andFilterWhere(['between','DepartDate',$start_date, $end_date])
    		->andFilterWhere(['!=','FlightDynamicID',$arr[1]['fid']])->asArray()->all();
    		$fanone=FlightList::find($arr[1]['qid'])->where(['FlightDynamicID'=>$arr[1]['fid']])
    		->asArray()->one();//p($fanone);die;
    		array_unshift($fanarr,$fanone);//p($fanarr);die;
    		foreach ($fanarr as $v){
    			$v['FlightWfprice']=$quarr['WeekDay']+890;
    			$endarr[]=$v;
    		}
    		//p($endarr);die;
    	}
    	
    	//p($flightarr);
    	if(isMobile())
    	{//移动端
    		return \yii\helpers\Json::encode($flightarr);
    	}else{
    		//web端
    		return $this->render('wftwo',['flights'=>$endarr,'wftwo'=>$quarr]);
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
}
