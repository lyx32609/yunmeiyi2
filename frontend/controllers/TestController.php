<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\City;
use frontend\models\FlightList;
use common\models\Passenger;
use common\models\AirticketOrder;
/**
 * Site controller
 */
class TestController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
   
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
    	return $this->render('index');
    	
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
			$arrivecity=City::find()->where(['zonename' =>$queryParams['arrivecity']]) ->one();
			$queryParams['DzoneID']=$departcity['ZoneID'];
			$queryParams['AzoneID']=$arrivecity['ZoneID'];
			//print_r($queryParams);exit();
			if(!array_key_exists("DepartTime1",$queryParams) && !in_array("DepartTime1",$queryParams))
			{
				$queryParams['DepartTime1']="";
			}
			if(!array_key_exists("DepartTime11",$queryParams) && !in_array("DepartTime11",$queryParams))
			{
				$queryParams['DepartTime11']="";
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
			{
				//往返接口
				$flightarr=$this->actionWfone($queryParams);
				if(isMobile())
				{
					//移动端
					return \yii\helpers\Json::encode($flightarr);
				}else{
					//web端
					//p(getArrSet($flightarr));
					//p($flightarrs);
					//return \yii\helpers\Json::encode($flightarrs);
					return $this->render('wfone',['flights'=>$flightarr['data'],'serars'=>$queryParams]);
					//return \yii\helpers\Json::encode($flightarr);
				}
			}elseif($queryParams['trale_type']=="M"){
				//多程接口
				$departcity2=City::find()->where(['zonename' =>$queryParams['departcity2']]) ->one();
				$arrivecity2=City::find()->where(['zonename' =>$queryParams['arrivecity2']]) ->one();
				$queryParams['DzoneID2']=$departcity2['ZoneID'];
				$queryParams['AzoneID2']=$arrivecity2['ZoneID'];
				$flightarr=$this->actionMultone($queryParams);//p($flightarr);die;
				if(isMobile()){//移动端
					return \yii\helpers\Json::encode($flightarr);
				}else{
					return $this->render('multone',['flights'=>$flightarr['data'],'serars'=>$queryParams,'wfafter'=>$queryParams]);
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
					$flightarrs['data']=array(array());
				}else{
					$flightarr=FlightList::find()->with('tickets')->where(['DepartCityID'=>$departcity['ZoneID'],'ArriveCityID'=>$arrivecity['ZoneID'],'DepartDate'=>$start_date])->limit(10)->asArray()->all();
					
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
						$flightarrs['data']=array($flightarr);
					}else{
						$flightarrs['code']="10003";
						$flightarrs['msg']="请求成功,数据为空";
						$flightarrs['data']=array(array());
					}
				}
					
			}	
		}else{
			$flightarrs['code']="10002";
			$flightarrs['msg']="请求失败，参数错误";
			$flightarrs['data']=array(array());
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
			//p($flightarrs['data']['0']);die;
			$airlinenames=array();
			foreach($flightarrs['data']['0'] as $k=>$v){
				$airlinenames[$k]['airlinename']=$v['AirlineShortName'];
				$airlinenames[$k]['airlineid']=$v['AirlineID'];
			}
			//得到航空公司
			//p($flightarrs['data']['0']);die;
			$airlinenames=getonearr($airlinenames);
			return $this->render('index',['flights'=>$flightarrs['data']['0'],'serars'=>$queryParams,'airlinenames'=>$airlinenames]);
		}
    }
	public function actionWfone($arr)
	{
		if(isMobile())
		{
			//移动端
			$endarr[]=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr['DzoneID'],'ArriveCityID'=>$arr['AzoneID']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime1']])->limit(10)->asArray()->all();
			foreach($endarr[0] as $k=>$v){
				$rdt=explode(':', $v['RealDepartTime']);
				$rat=explode(':', $v['RealArriveTime']);
				$dt=explode(':', $v['DepartTime']);
				$at=explode(':', $v['ArriveTime']);
				$endarr[0][$k]["RealDepartTime"]=$rdt[0].":".$rdt[1];
				$endarr[0][$k]["RealArriveTime"]=$rat[0].":".$rat[1];
				$endarr[0][$k]["DepartTime"]=$dt[0].":".$dt[1];
				$endarr[0][$k]["ArriveTime"]=$at[0].":".$at[1];
			}
			$endarr[]=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr['AzoneID'],'ArriveCityID'=>$arr['DzoneID']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime11']])->limit(10)->asArray()->all();
			if(is_array($endarr) && count($endarr)>0){
				$end['data']=$endarr;//p($endarr);die;
				$end['code']="10001";
				$end['msg']="请求成功";
			}else{
				$end['data']=$endarr;//p($endarr);die;
				$end['code']="10002";
				$end['msg']="请求失败,数据为空";
			}
			return $end;
		}
		$zhongjian=array();
		$flightarr=array();
		if($arr){//p($arr);die;
			if (time()>strtotime($arr['DepartTime1'])) {//判断时间是否为过去时间
				$arr['DepartTime1']=date("Y-m-d",time());//去程开始时间
			}else{
				$arr['DepartTime1']=date("Y-m-d",strtotime($arr['DepartTime1']));//去程开始时间
			}
			//p($arr);die();
			$flight1arr=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr['DzoneID'],'ArriveCityID'=>$arr['AzoneID']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime1']])->limit(10)->asArray()->all();//去程最好是数据库操作
			$flight2arr=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr['AzoneID'],'ArriveCityID'=>$arr['DzoneID']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime11']])->orderBy("DepartTime asc")->asArray()->one();//返程最低价
			$flight3arr['FlightWfid']=$flight2arr['FlightDynamicID'];
			$flight3arr['FlightWfprice']=77;
			
			foreach ($flight1arr as $v){
				$v['FlightWfid']=$flight2arr['FlightDynamicID'];
				$v['FlightWfprice']=890;
				$v['FlightWftime']=$arr['DepartTime11'];
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
		if($arr){
			$start_date=date("Y-m-d H:i:s",strtotime($arr[1]['wftime']));//去程开始时间
			$quarr=FlightList::find()->with('tickets')->where(['FlightDynamicID'=>$arr[1]['qid']])->asArray()->one();//去程数据
			//p($quarr);die;
			$fanarr=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr[1]['Wfgoid'],'ArriveCityID'=>$arr[1]['Wftoid']])
			->andFilterWhere(['=','DepartDate',$start_date])
			->andFilterWhere(['!=','FlightDynamicID',$arr[1]['fid']])->limit(10)->asArray()->all();
			$fanone=FlightList::find()->with('tickets')->where(['FlightDynamicID'=>$arr[1]['fid']])
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
			return $this->render('wftwo',['flights'=>$flightarr['data'],'wfafter'=>$quarr,'serars'=>$arr[1]['serars']]);
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
	//多程购票
	public function actionMultone($arr)
	{
		if(isMobile())
		{//移动端
			$flightarr[]=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr['DzoneID'],'ArriveCityID'=>$arr['AzoneID']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime1']])->limit(10)->asArray()->all();//第一程最好是数据库操作
			$flightarr[]=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr['DzoneID2'],'ArriveCityID'=>$arr['AzoneID2']])
			->andFilterWhere(['=','DepartDate',$arr['DepartTime1']])->limit(10)->asArray()->all();//第一程最好是数据库操作
			if (is_array($flightarr) && count($flightarr)>0) {
				$endarr['data']=$flightarr;//p($endarr);die;
				$endarr['code']="10001";
				$endarr['msg']="请求成功";
			}else{
				$endarr['data']='';//p($endarr);die;
				$endarr['code']="10002";
				$endarr['msg']="请求失败,数据为空";
			}	
			return \yii\helpers\Json::encode($flightarr);
		}
		$flightarr=array();
		$duoc['DzoneID2']=$arr['DzoneID2'];
		$duoc['AzoneID2']=$arr['AzoneID2'];
		$duoc['DepartTime']=$arr['DepartTime2'];
		$flightarr=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr['DzoneID'],'ArriveCityID'=>$arr['AzoneID']])
		->andFilterWhere(['=','DepartDate',$arr['DepartTime1']])->limit(10)->asArray()->all();//第一程最好是数据库操作
		
		if(is_array($flightarr) && count($flightarr)>0){
			$endarr['data']=$flightarr;//p($endarr);die;
			$endarr['code']="10001";
			$endarr['msg']="请求成功";
		}else{
			$endarr['data']=$flightarr;//p($endarr);die;
			$endarr['code']="10002";
			$endarr['msg']="请求失败,数据为空";
		}
		return $endarr;
	}
	//多程购票
	public function actionMulttwo()
	{
		$flightarr=array();
		$isGet = \Yii::$app->request->isGet;
		if($isGet){//Yii::app->request->get()
			$arr = \Yii::$app->request->get();//p(Yii::$app->request->queryParams);echo 11;die;
		}else{
			$arr = Yii::$app->request->queryParams;
		}
		//p($arr);die;
		if($arr){
			$start_date=date("Y-m-d H:i:s",strtotime($arr[1]['dctime']));//去程开始时间
			$quarr=FlightList::find()->with('tickets')->where(['FlightDynamicID'=>$arr[1]['qid']])->asArray()->one();//第一程数据
			//p($quarr);die;
			$dcarr=FlightList::find()->with('tickets')->where(['DepartCityID'=>$arr[1]['dcgoid'],'ArriveCityID'=>$arr[1]['dctoid']])
			->andFilterWhere(['=','DepartDate',$start_date])
			->andFilterWhere(['!=','FlightDynamicID',$arr[1]['qid']])->limit(10)->asArray()->all();//p($dcarr);die;
			$fanone=FlightList::find()->with('tickets')->where(['FlightDynamicID'=>$arr[1]['qid']])
			->asArray()->one();//p($fanone);die;
			//array_unshift($fanarr,$fanone);//p($fanarr);die;
			/*foreach ($fanarr as $v){
				$v['FlightWfprice']=890;
				$endarr[]=$v;
			}*/
			//p($quarr);die;
		}
		if(is_array($dcarr) && count($dcarr)>0)
		{
			$flightarr['data']=$dcarr;//p($endarr);die;
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
			return $this->render('multtwo',['flights'=>$flightarr['data'],'wfafter'=>$quarr,'serars'=>$arr[1]['serars']]);
		}
	}
	//往返、多程订单
	public function actionOrders(){
		if (!\Yii::$app->user) {//用户是否登录
			return $this->redirect('/frontend/web/site/login');
			return $this->goHome();
		}
		$userid=\Yii::$app->user->identity->UserID;
		$isGet = \Yii::$app->request->get();
		$flights=array();
		if($isGet){
			$arr = \Yii::$app->request->get();
		}else{
			$arr = Yii::$app->request->queryParams;
		}//p($flights);die;
		$flights = explode(',', $arr['FlightDynamicID']);//p($flights);die;
		//$flights['trale_type']=
		if($flights){
			if(\Yii::$app->request->isPost){
				$pos = \Yii::$app->request->post();//添加常用联系人
				$res=Yii::$app->dbName->createCommand()->insert('tb_passenger',$pos);//添加常用联系人
			}
			$flightone = FlightList::find()->where(['FlightDynamicID'=>$flights[0]])->asArray()->one();
			$s=getdate(strtotime($flightone['DepartDate']));
			$flightone['Week']=week($s['weekday']);
			$flighttwo = FlightList::find()->where(['FlightDynamicID'=>$flights[1]])->asArray()->one();
			$s=getdate(strtotime($flighttwo['DepartDate']));
			$flighttwo['Week']=week($s['weekday']);
			$passenger=Passenger::find()->where(['UserID'=>$userid])->asArray()->all();//常用联系人
			return $this->render('orders',['flightone'=>$flightone,'flighttwo'=>$flighttwo,'userp'=>$passenger,'type'=>$arr['type']]);
			//return $this->render('order',['flightarr'=>$flightarr]);
		}
	}
	//支付信息页面
	public function actionOrder(){
		if (Yii::$app->user->isGuest=="1") {
            return $this->redirect(['site/login']);
        }
		$userid=\Yii::$app->user->identity->UserID;
		$isPost = \Yii::$app->request->isPost;
		$flights=array();
        if($isPost){
            $flights = \Yii::$app->request->post();
        }else{
            $flights = Yii::$app->request->queryParams;
        }
		if($flights){
			//获取用户常用联系人
			$user_passenger=Passenger::find()->where(['UserID'=>$userid])->asArray()->all();
			$flightarr=FlightList::find()->where(['FlightDynamicID'=>$flights['FlightDynamicID']])->asArray()->one();
			$s=getdate(strtotime($flightarr['DepartDate']));
			$flightarr['Week']=week($s['weekday']);
			if (count($flightarr) == count($flightarr, 1)) {
			    $flightarr['trale_type']="D";//一维数组表示单程
			} else {
			    $flightarr['trale_type']="S";//二维数组表示往返或多城
			}
			return $this->render('order',['flightarr'=>$flightarr,'userp'=>$user_passenger]);
		}
	}
	//支付页面
	public function actionPay(){
		if (Yii::$app->user->isGuest=="1") {
            return $this->goHome();
        }
		$isPost = \Yii::$app->request->isPost;
		$flights=array();
		$flightarr=array();
        if($isPost){
            $flights = \Yii::$app->request->post();
        }else{
            $flights = Yii::$app->request->queryParams;
        }
		if($flights){
			$UserID=\Yii::$app->user->identity->UserID;
			$pmodel = new Passenger();
			$pmodel->UserID=$UserID;
			$pmodel->IDType1="1";
			$pmodel->Identity1=$flights['Identity1'];
			$pmodel->PassengerName=$flights['UserName'];
			$pmodel->PassengerPhone=$flights['Mobile'];
			$pmodel->CreateTime=date('Y-m-d H:i:s',time());
			$pmodel->save();
			$PassengerID = $pmodel->attributes['PassengerID'];//获取新添加乘客id
			$flightarr=FlightList::find()->where(['FlightDynamicID'=>$flights['FlightDynamicID']])->asArray()->one();
			$s=getdate(strtotime($flightarr['DepartDate']));
			$flightarr['Week']=week($s['weekday']);
			$omodel=new AirticketOrder();
			$ordertype="01";//机票订单
			$omodel->OrderID=createOrderNm($ordertype);
			$omodel->UserID=$UserID;
			$omodel->PassengerID=$PassengerID;
			$omodel->Mobile=$flights['OrderMobile'];
			$omodel->Email=$flights['OrderEmail'];
			$omodel->FlightID=$flightarr['FlightID'];
			$omodel->FlightDate=$flightarr['DepartDate'];
			$omodel->OrderTime=date("Y-m-d H:i:s",time());
			$omodel->save();
		}
		//p($queryParams);
		return $this->render('pay',['flight'=>$flightarr,'message'=>$flights]);
		//return \yii\helpers\Json::encode($queryParams);
	}
	//支付完成页面
	public function actionOver(){
		
		return $this->render('over');
	}
}
