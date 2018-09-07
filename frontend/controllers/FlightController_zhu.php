tb_user用户平台表
	UserID	
	LoginName	用户名
	PasswordMD5	密码
	UserPhone	用户联系电话
	IDCardNo	身份证号
	NickName	昵称
	RoleID		角色id ^…^
	UserRole	用户类型，1游客2导游3计划调度员4旅行社管理员5票务公司管理员6票务公司业务员7旅行社司机100系统管理员
	OrganizationID	所在机构id，默认0不属于任何机构
	StateType	1正常2停用3用户自己注销
	CreateTime	NO		
	UpdateTime	NO		
	auth_key	NO		
	password_reset_token	varchar(255)		YES		
tb_organization公司机构表
	OrganizationID		
	OrganizationName	公司机构名称
	LegalRepresentative	法人代表姓名
	Phone	联系电话
	Address	地址
	OrganizationType	机构类型
	BusinessLicenseUrl	营业执照照片
	CheckState	审查状态
	StateType	用户状态1正常2停用3用户自己注销
	CreateTime		
tb_role_right角色权限表
	RoleID	int(11)		
	RoleName	varchar(32) 角色名称^…^
	RoleRights		可访问模块ID串，半角逗号隔开
	OrganizationID	机构id
	StateType	用户状态1正常2停用
	CreateTime	
tb_passenger乘客信息表
	PassengerID 主键id
	UserID		用户id
	IDType			证件类型编号
	Identity	证件号码
	PassengerName	乘客姓名
	FristName	名
	LastName	姓
	BirthPlace	出生地点
	IssueDate	签发日期
	ExpiryDate	有效期至
	PassengerPhone			乘客联系方式
	Birthdate			乘客出生日期
	Sex	性别		
	Nationality	国籍，一般为英文
	Country	国家
	Province	省份		
	City	城市
	Address	地址	
	CreateTime 创建时间
	
public function actionSignup()
    {
    	$usermodel=new User();
		$user=array();
    	$isPost = \Yii::$app->request->isPost;
		$users=array();
        if($isPost){
            $users = \Yii::$app->request->post();
        }else{
            $users = Yii::$app->request->queryParams;
        }
		if($usermodel->load(yii::$app->getRequest()->post(),'')&& $usermodel->validate()){
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
					$user["msg"]="注册成功";
					$user["data"]=array($us);
				}else{
					$user["code"]="10002";
					$user["msg"]="注册失败";
					$user["data"]=array();
				}
			}
    	}else{
    		$msgarr=$usermodel->getErrors();
    		$msg=reset($msgarr)[0];
			$user["code"]="10002";
			$user["msg"]=$msg;
			$user["data"]=array();
    	}
		return \yii\helpers\Json::encode($user);
      
    }