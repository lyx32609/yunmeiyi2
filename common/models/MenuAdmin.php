<?php
namespace common\models;
use Yii;
use common\models\TourRouteDaily;
use common\models\TourRouteDay;
class MenuAdmin extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * 
     * @inherLYX
     */
    public static function tableName()
    {
        return 'list_menu_admin';
    }
    public function rules()
    {
    	return [
    	//[['LoginName', 'PasswordMD5', 'UserPhone', 'MenuIDCardNo', 'NickName', 'UserRole', 'OrganizationMenuID', 'StateType', 'CreateTime', 'auth_key'], 'required'],
    	//[['RouteName','RouteNo'], 'required','message'=>'不能为空'],
    	//[['RouteNo'], 'safe'],
    	/* [['LoginName', 'PasswordMD5', 'NickName'], 'string', 'max' => 2],
    	[['UserPhone'], 'string', 'max' => 11,'message'=>'请输入正确手机号'],
    	['UserPhone','unique','message'=>'手机号已被注册，请登录'],
    	[['MenuIDCardNo'], 'string', 'max' => 18],
    	[['auth_key'], 'string', 'max' => 32],
    	[['password_reset_token'], 'string', 'max' => 255], */
    	];
    }
    
    public function authRuleTree(){
    	$authRuleres=self::find()->where(['MenuStatus'=>0])->orderBy('MenuSort desc')->asArray()->all();//$this->order('sort desc')->select();
    	return $this->sort($authRuleres);//$authRuleres;//
    }
    
    public function sort($data,$ParentMenuID=0){
    	static $arr=array();
    	foreach ($data as $k => $v) {
    		if($v['ParentMenuID']==$ParentMenuID){
    			//$v['dataMenuID']=$this->getchilrenMenuID($v['MenuID']);
    			$arr[]=$v;
    			$this->sort($data,$v['MenuID']);
    		}
    	}
    	return $arr;
    }
    
    
    public function getchilrenMenuID($authRuleMenuID){
    	$AuthRuleRes=self::find()->orderBy('MenuSort desc')->asArray()->all();
    	return $this->_getchilrenMenuID($AuthRuleRes,$authRuleMenuID);
    }
    
    public function _getchilrenMenuID($AuthRuleRes,$authRuleMenuID){
    	static $arr=array();
    	foreach ($AuthRuleRes as $k => $v) {
    		if($v['ParentMenuID'] == $authRuleMenuID){
    			$arr[]=$v['MenuID'];
    			$this->_getchilrenMenuID($AuthRuleRes,$v['MenuID']);
    		}
    	}
    	//p($authRuleMenuID);
    	return $arr;
    }
    
    
    public function getparentMenuID($authRuleMenuID){
    	$AuthRuleRes=self::find()->orderBy('MenuSort desc')->asArray()->all();
    	//p($this->_getparentMenuID($AuthRuleRes,$authRuleMenuID,True));
    	return $this->_getparentMenuID($AuthRuleRes,$authRuleMenuID,True);
    }
    
    public function _getparentMenuID($AuthRuleRes,$authRuleMenuID,$clear=False){
    	static $arr=array();
    	if($clear){
    		$arr=array();
    	}
    	foreach ($AuthRuleRes as $k => $v) {
    		if($v['MenuID'] == $authRuleMenuID){
    			$arr[]=$v['MenuID'];
    			$this->_getparentMenuID($AuthRuleRes,$v['ParentMenuID'],False);
    		}
    	}
    	asort($arr);
    	$arrStr=implode('-', $arr);
    	return $arrStr;
    }
    
    
	
}