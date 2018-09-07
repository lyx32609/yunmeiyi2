<?php
function getonearr($array2D)
{
	$temp=array();
	 foreach ($array2D as $v){
	  $v=join(',',$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
	  $temp[]=$v;
	 }
	 $temp=array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
	 foreach ($temp as $k => $v){
	  $temp[$k]=explode(',',$v); //再将拆开的数组重新组装
	 }
	 return $temp;
 
}
//订单号
function createOrderNm($type)
{
	return date("Ymd").$type.substr(uniqid(rand(10000000,99999999)),0,8);	
}
//获取周几
function week($w)
{
  $week="";
  switch($w){
  	case 'Monday':
		$week="周一";
		break;
	case 'Tuesday':
		$week="周二";
		break;
	case 'Wednesday':
		$week="周三";
		break;
	case 'Thursday':
		$week="周四";
		break;
	case 'Friday':
		$week="周五";
		break;
	case 'Saturday':
		$week="周六";
		break;
	case 'Sunday':
		$week="周天";
		break;						
  }
  return $week;
}
/*字符串截取*/
function truncate_utf8_string($string, $length, $etc = '...')  
        {  
            $result = '';  
            $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');  
            $strlen = strlen($string);  
            for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)  
                {  
                if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))  
                        {  
                    if ($length < 1.0)  
                                {  
                        break;  
                    }  
                    $result .= substr($string, $i, $number);  
                    $length -= 1.0;  
                    $i += $number - 1;  
                }  
                        else  
                        {  
                    $result .= substr($string, $i, 1);  
                    $length -= 0.5;  
                }  
            }  
            $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');  
            if ($i < $strlen)  
                {  
                        $result .= $etc;  
            }  
            return $result;  
        }
/*移动端判断*/
//function isMobile() 
//{ 
//	$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : ''; 
//	$mobile_browser = '0'; 
//	if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) 
//	 $mobile_browser++; 
//	if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false)) 
//	 $mobile_browser++; 
//	if(isset($_SERVER['HTTP_X_WAP_PROFILE'])) 
//	 $mobile_browser++; 
//	if(isset($_SERVER['HTTP_PROFILE'])) 
//	 $mobile_browser++; 
//	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4)); 
//	$mobile_agents = array( 
//	   'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac', 
//	   'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno', 
//	   'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-', 
//	   'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-', 
//	   'newt','noki','oper','palm','pana','pant','phil','play','port','prox', 
//	   'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar', 
//	   'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-', 
//	   'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp', 
//	   'wapr','webc','winw','winw','xda','xda-'
//	   ); 
//	if(in_array($mobile_ua, $mobile_agents)) 
//	 $mobile_browser++; 
//	if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false) 
//	 $mobile_browser++; 
//	// Pre-final check to reset everything if the user is on Windows 
//	if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false) 
//	 $mobile_browser=0; 
//	// But WP7 is also Windows, with a slightly different characteristic 
//	if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false) 
//	 $mobile_browser++; 
//	if($mobile_browser>0) 
//	 return true; 
//	else
//	 return false; 
//}
function isMobile(){
	$useragent  = strtolower($_SERVER["HTTP_USER_AGENT"]);
	// pc电脑
	$is_pc = strripos($useragent,'windows nt');
	if($is_pc){
		return false;
	}else{
		return true;
	}
	
}
function p($arr){
    echo '<pre>';
    print_r($arr);
    echo '<pre>';
}
/*数组组合*/
function getArrSet($arrs,$_current_index=-1) {
     //总数组
     static $_total_arr;
     //总数组下标计数
     static $_total_arr_index;
     //输入的数组长度
     static $_total_count;
     //临时拼凑数组
     static $_temp_arr;
     //进入输入数组的第一层，清空静态数组，并初始化输入数组长度
     if($_current_index<0){
	         $_total_arr=array();
	         $_total_arr_index=0;
	         $_temp_arr=array();
	         $_total_count=count($arrs)-1;
	         getArrSet($arrs,0);
	 } else{
         //循环第$_current_index层数组
         foreach($arrs[$_current_index] as $v){
	             //如果当前的循环的数组少于输入数组长度
	             if($_current_index<$_total_count){
		                 //将当前数组循环出的值放入临时数组
		                 $_temp_arr[$_current_index]=$v;
		                 //继续循环下一个数组
		                 getArrSet($arrs,$_current_index+1);
		 		} 
		 		//如果当前的循环的数组等于输入数组长度(这个数组就是最后的数组)
	           else if($_current_index==$_total_count) {
			                 //将当前数组循环出的值放入临时数组
			                 $_temp_arr[$_current_index]=$v;
			                 //将临时数组加入总数组
			                 $_total_arr[$_total_arr_index]=$_temp_arr;
			                 //总数组下标计数+1
			                 $_total_arr_index++;
			    }
			}
		}
		return $_total_arr;
}
function generate_code($length = 6) {
	return rand(pow(10,($length-1)), pow(10,$length)-1);
}
function sendmsg($tel,$code){
	set_time_limit(0);
	$response = SmsDemo::sendSms(
			"今启航旅游", // 短信签名
			"SMS_109430377", // 短信模板编号
			$tel, // 短信接收者13181730156。17686955520/15615610629/18611367150
			Array(// 短信模板中字段的值
					"code"=>$code,
					//"product"=>"dsd"
			)
			//"123"   // 流水号,选填
	);
	return $response;
	echo "发送短信(sendSms)接口返回的结果:\n";
	print_r($response);
}
//线路编号
function getRouteNo($time,$num,$code){
	return $time.substr($num, -6).$code;
}
//判断是哪家银行的包括什么卡     例'621098' => '邮储银行-绿卡通-借记卡',
function bankInfo($card,$bankList)
{
	$card_8 = substr($card, 0, 8);
	if (isset($bankList[$card_8])) {
		$end['key']=$card_8;
		$end['val']=$bankList[$card_8];
		return $end;
	}
	$card_6 = substr($card, 0, 6);
	if (isset($bankList[$card_6])) {
		$end['key']=$card_6;
		$end['val']=$bankList[$card_6];
		return $end;
	}
	$card_5 = substr($card, 0, 5);
	if (isset($bankList[$card_5])) {
		$end['key']=$card_5;
		$end['val']=$bankList[$card_5];
		return $end;
	}
	$card_4 = substr($card, 0, 4);
	if (isset($bankList[$card_4])) {
		$end['key']=$card_4;
		$end['val']=$bankList[$card_4];
		return $end;
	}
	//echo '该卡号信息暂未录入';
	$end['key']=substr($card, 0, 6);
	$end['val']='该卡号信息暂未录入';
	return $end;
}

?>