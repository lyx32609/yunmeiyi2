<?php
	use yii\helpers\Url;
	use yii\helpers\Html;	
?>

<link href="/frontend/web/css/layout.css" rel="stylesheet">
<link href="/frontend/web/bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="/frontend/web/css/jp_liebiao.css" rel="stylesheet">
<style>
	.on{display: block;}
</style>
<?php
/* @var $this yii\web\View */
$this->title = '旅乐行旅游网-航班列表';
?>
<div class="chakan_container">
		 	<div id="top-cont">
					<div id="top-min">
						<div id="min-left"></div>
		                <!--<form id="s_form">
		                     <input type="text" id="s_input"placeholder="搜索城市/酒店/旅游/景点门票/机票"/>
		                    <button class="button_01">搜索</button>
		                </form>-->
						<div id="min-right">
		                     <ul class="s_right">
		                         <li class="index_li">Global Sites<span class="l_sj"></span>
		                             <img class="lan_yu" src="/frontend/web/images/lan.png" alt=""/>
		                         </li>
		                         <li class="center_li"><a class="ke_fu">客服中心</a></li>
		                         <li class="last_li">国内电话：<span>400-830-6666</span><span class="s_sj"></span></li>
		                     </ul>
		                    <div class="er_right">
		                         <div class="er_left">
		                             <img src="/frontend/web/images/phone.png" />
		                             <div class="phone_er">
		                                 <img src="/frontend/web/images/phone_er.png" />
		                             </div>
		                         </div>
		                        <div class="er_left">
		                            <img src="/frontend/web/images/weixin.png" />
		                            <div class="phone_er">
		                                <img src="/frontend/web/images/weixin_er.png" />
		                            </div>
		                        </div>
		                    </div>
		                </div>
					</div>
		    </div>
		    <div class="dao_hang">
		    	<ul class="nav">
					  <li><a href="<?=Url::to(['site/index']) ?>">首页</a></li>
					  <li class="active"><a href="<?=Url::to(['flight/index']) ?>">机票</a></li>
					  <li><a href="#">酒店</a></li>
			    </ul>		    	
		    </div>
		    <div class="center-search">
		    	<div class="select_div">
		    		<form id="pic_search" method="post" action="<?=Url::to(['flight/index']) ?>">
		    			
		    		<div class="x_xiala">
				    	<select class="l_xx" name="trale_type">
						  <option <?php if($serars['trale_type']=="S") {?>selected="selected"<?php }?> value="S">往返</option>
						  <option <?php if($serars['trale_type']=="D") {?>selected="selected"<?php }?> value="D">单程</option>
						  <option <?php if($serars['trale_type']=="M") {?>selected="selected"<?php }?> value="M">多程</option>
						</select>
					</div>
					<div class="wangfan">
						<div class="one_line">
							<span class="span_01" id="span01">第一程</span>
							<div class="cf_city">
								 <span class="iconfont icon-qifei1 qifei_span"></span>
								 <input type="text" name="departcity" placeholder="出发城市" value='<?=$serars['departcity']?>' class="input_chufa"/>								
							</div>
							<div class="cf_city">
								 <span class="iconfont icon-jiangla qifei_span"></span>
								 <input type="text" name="arrivecity" placeholder="到达城市" value='<?=$serars['arrivecity']?>'  class="input_chufa"/>								
							</div>
							<div class="div_from_01">
									<div class='input-group date' id='datetimepicker1' >
										<input type='text' name="DepartTime1" placeholder="出发日期" value="<?=$serars['DepartTime1']?>" class="form-control chufa_date_dat" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
						    </div>
							<div class="div_from_01" id="last_input">
									<div class='input-group date' id='datetimepicker2' >
										<input type='text' name="DepartTime11" placeholder="返回日期" class="form-control chufa_date_dat" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
						    </div>
						</div>
						<div class="one_line two_line">
							<span class="span_01">第二程</span>
							<div class="cf_city">
								 <span class="iconfont icon-qifei1 qifei_span"></span>
								 <input type="text" name="departcity2" placeholder="出发城市"  class="input_chufa"/>								
							</div>
							<div class="cf_city">
								 <span class="iconfont icon-jiangla qifei_span"></span>
								 <input type="text" name="arrivecity2" placeholder="到达城市"  class="input_chufa"/>								
							</div>
							<div class="div_from_01">
									<div class='input-group date' id='datetimepicker2' >
										<input type='text' name="DepartTime2" placeholder="出发日期" class="form-control chufa_date_dat" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
						    </div>
						</div>
						<div class="one_line three_line">
							<span class="span_01"></span>
							<div class="cf_city">
								 <span class="iconfont icon-naihai qifei_span"></span>
								 <input type="text" placeholder="带儿童"  class="input_chufa"/>								
							</div>
							<div class="cf_city">
								 <span class="iconfont icon-yinger qifei_span"></span>
								 <input type="text" placeholder="带婴儿"  class="input_chufa"/>								
							</div>
							<div class="cf_city">
								 <span class="iconfont icon-zuoweishu qifei_span"></span>
								 <input type="text" placeholder="经济舱"  class="input_chufa"/>								
							</div>
						</div>
				    </div>
				    <div class="search_titck">
				    	<button type="submit" class="btn btn-success">重新搜索</button>
				    	<a class="gj_search">高级搜索<span class="caret"></span></a>
				    </div>
				    </form>
				</div>	    	
		    </div>
		    <div class="main">
		    	<div class="row">
			    	<div class="col-md-12 col-xs-12">
			    		<div class="div_h4">
			    		   <h4>筛选<small class="s_xiao">(共<span><?=count($flights)?></span>条数据)</small></h4>
			    		</div>
			    		<div class="sx_dh">
			    			<ul class="list-group">
							  <li class="list-group-item">起飞时段
							  	<span class="qf_time">
								  	 <label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1">上午（6-12点）
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2"> 下午（13-18点）
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox3" value="option3"> 晚上（18-24点）
									</label>
								</span>
							  </li>
							  <li class="list-group-item">航空公司
							  	  <span class="qf_time">
							  	  	<?php foreach($airlinenames as $vv){?>
								  	<label class="checkbox-inline">
									  <input type="checkbox" checked="checked" onclick="checkbox()" name="airlineids" id="inlineCheckbox1" value="<?=$vv['1']?>"><?=$vv['0']?>
									</label>
									<?php }?>
								</span>
							  </li>
							  <li class="list-group-item">报销凭证
							  	  <span class="qf_time">
								  	 <label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1">行程单
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2">发票
									</label>
								</span>
							  </li>
							  <li class="list-group-item">到达机场
							  	  <span class="qf_time">
								  	 <label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1">浦东机场
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2">虹桥机场
									</label>
								  </span>
							  </li>
							  <li class="list-group-item">舱位类型
							  	    <span class="qf_time">
								  	 <label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1">经济舱
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2">公务/经济舱
									</label>
								  </span>
							  </li>
							</ul>	    			
			    		</div>

			    	</div>
		        </div>
		    </div>
		   <div class="jp_center">
		   	<div class="jp_center_h4 ">
		   		<ul class="bi_ti">
		   			<li class="bi_ti_li">航班信息</li>
		   			<li class="qifei_time">
		   				<a>起飞时间</a>
		   			</li>
		   			<li class="daoda_time"><a>到达时间</a></li>
		   			<li class="zhundian">准点率</li>
		   			<li class="youhui">优惠</li>
		   			<li class="jiage">价格</li>
		   		</ul>		   		
		   	</div>
		    <div class="div_xinxi">
		    	<?php foreach ($flights as $f) {?> 
		    	<div class="li_div">
		    		<ul class="table_01">
		    				<li class="logo">
		    					<div class="logo_samll">
		    						<img class="img_name" src="/frontend/web/<?=$f['PicUrl']?>"/>
		    						<span class="c_name"><?=$f['AirlineShortName']?></span>
		    						<span class="hk_name"><?=$f['FlightCode']?></span>
		    					</div>
		    					<div class="logo_footer">
		    						<span class=""><?=$f['PlaneModelName']?></span>
		    					</div>
		    				</li>
		    				<li class="li_qifei">
		    					<div>
		    						<strong class="data_qifei"><?=$f['DepartTime']?></strong>
		    					</div>
		    					<div><?=$f['DepartAirport']?></div>
		    				</li>
		    				<li class="center_li_wai">
		    					<div class="arrow"></div>
		    				</li>
		    				<li class="li_jiangluo">
		    					<div>
		    						<strong class="data_qifei"><?=$f['ArriveTime']?></strong>
		    					</div>
		    					<div><?=$f['ArriveAirport']?></div>
		    				</li>
		    				<li class="z_d_lv">
		    					<div>
		    						准点率
		    					</div>
		    					<div><?=$f['Accuracy']/10?>%</div>
		    				</li>
		    				<li class="preferential">
		    					<div>
		    						
		    					</div>
		    				</li>
		    				<li class="price">
		    					<div>
		    						<span class="number">
		    							<dfn>￥</dfn>
		    							700
		    						</span>
		    						<span class="up">
		    							起
		    						</span>
		    					</div>
		    				</li>
		    				<li class="orange_button">
		    					<a href="javascript:;"><button type="button" class="orange two_second">订票</button></a>
		    				</li>
		    		</ul>
		    		<div class="wai_button dan_cheng_button">
		    			<button type="button" class="shouqi_button orange_dancheng">收起</button>
		    		</div>
		    		<div class="row jp_list" style="background: #f6f6f6;height: 200px;">
						<div class="col-md-2" style="">
							<span>快速出票</span>
						</div>
						<div class="col-md-10">
							<div class="row">
								<div class="col-md-4">
									<span style="color: #01ae5e;">行程单</span>
									<span class="shu">|</span>
									<a href="#" style="color: #2b94ff;">退改￥138起</a>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-7">
									<div class="col-md-6"><span style="color: rgba(0, 0, 0, 0.3);">经济舱 4.2折</span><span class="jp_jg">¥550</span></div>
									<div class="col-md-6 jp_gs-l">
										<div class="col-md-12 jp_gs" style="border-bottom: 1px dashed rgba(0, 0, 0, 0.22);">
											<span>普通预订</span><a href="<?=Url::to(['flight/order','FlightDynamicID'=>$f['FlightDynamicID']]) ?>" onclick="return checkuser()"><div class="btn btn-danger">预订</div></a>
										</div>
										<div class="col-md-12 jp_gs">
											<span>普通预订</span><a href="<?=Url::to(['flight/order','FlightDynamicID'=>$f['FlightDynamicID']]) ?>"><div class="btn btn-danger">预订</div></a>
										</div>
									</div>
								</div>
		                  </div>
		                </div>
		              </div>
		            </div>
		    	<?php }?>
		    	
		    </div>
		 
		   </div>
		 	
		 </div>
		
	<script type="text/javascript" src="/frontend/web/js/jquery-v2.1.1.min.js" ></script>
	<script>
		$(function(){
			var picker1=$('#datetimepicker1,#datetimepicker1>input').datetimepicker({
			 format: 'YYYY-MM-DD',
			 locale: moment.locale('zh-cn') 
			});
			var picker2=$('#datetimepicker2,#datetimepicker2>input').datetimepicker({
		     format: 'YYYY-MM-DD',
			 locale: moment.locale('zh-cn') 
			});
			var picker3=$('#datetimepicker3,#datetimepicker3>input').datetimepicker({
			 format: 'YYYY-MM-DD',
			 locale: moment.locale('zh-cn') 
			});
			picker1.on('dp.change', function (e) {  
		        picker1.data('DateTimePicker').minDate(e.date);  
		    });  
		    //动态设置最大值  
		    picker2.on('dp.change', function (e) {  
		        picker2.data('DateTimePicker').minDate(e.date);  
		    });  
		     picker3.on('dp.change', function (e) {  
		        picker3.data('DateTimePicker').minDate(e.date);  
		    });
		    
		    $("#span01").text("");
		 	$(".l_xx").change(function(){
		 	var aa=$(".l_xx").val();
			 	if(aa=="S"){
			 		$("#span01").text();
			 		$(".two_line").hide();
			 		$(".three_line").hide();
			 		$("#last_input").show();
			 		$(".search_titck").css("margin-right","0px");W
			 	}else if(aa=="D"){
			 		$("#span01").text();
			 		$(".two_line").hide();
			 		$(".three_line").hide();
			 		$("#last_input").show();
			 		$(".search_titck").css("margin-right","0px");
			 	}else{
			 		$("#span01").text("第一程");
			 		$(".two_line").show();
			 		$("#last_input").hide();
			 		$(".search_titck").css("margin-right","225px");
			 	}
		 	})
//		 	$(".btn-success").click(function(){
//		 		 var bb=$(".l_xx").val();
//		 		 if(aa="M"){
//		 		 	$("#span01").text("第一程");
//			 		$(".two_line").show();
//			 		$("#last_input").hide();
//			 		$(".search_titck").css("margin-right","225px");
//		 		 }
//		 	})
			$(".gj_search").click(function(){
	                 if($(".three_line").css("display")=="none"){
	                 	$(".three_line").show()
	                 }else{
	                 	$(".three_line").hide()
	                 }
			});
	        $(".table_display_none").css("display","none");
			$(".two_second").on("click",function(){
	 		  var aa=$(this).parents().parents().siblings(".jp_list");
			   if(aa.css("display")=="none"){
				aa.css("display","block");
				$(this).parents().parents().siblings(".table_display_none").css("display","block");
				$(this).parents().parents().siblings(".table_display_none").find(".one_first").css("display","none");
				$(this).css("display","none");
				$(this).parents().parents().siblings(".wai_button").css("display","block");
			   }
		 	});
		 	$(".wai_button").click(function(){
		 		$(this).siblings(".table_display_none").css("display","none");
		 		$(this).siblings("ul").find(".two_second").css("display","block");
		 		$(this).css("display","none");
		 		$(this).siblings(".jp_list").css("display","none");
		 	})
		})
	</script>
	<link href="/frontend/web/css/tanchuangcss/dialog.css" rel="stylesheet">
	<script>
		function checkbox(){
			var obj=document.getElementsByName('airlineids');
			var check_val=[];
			for(k in obj){
				if(obj[k].checked){
					check_val.push(obj[k].value);
				}
			}
			$.post("<?=Url::to(['flight/nindex'])?>",{checkval:check_val},function(){

        	},"json");
		}
		function checkuser(){
			var islogin="<?=Yii::$app->user->isGuest?>";
			if(islogin=="1")
			{
				$.dialog({
			       type : 'confirm',
			       onClickOk : function(){
			           window.location.href='<?=Url::to(['site/login'])?>'
			       },
			       onClickCancel : function(){        		
			           return false;
			       },
			       contentHtml : '<p>您还没有登录，请登录后购买~</p> '
			   });
			   return false;
			}
			
		}
	</script>
