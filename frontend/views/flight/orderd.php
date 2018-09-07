
	    <link rel="stylesheet" href="/frontend/web/css/order.css" />
<?php
$this->title = '旅乐行旅游网-航班订单信息';	
?>
		<div class="container_dingdan">
		    <div class="order_header">
		    	<div class="order_header_top">
		    		<div class="order_header_logo">
		    			<a href="#" class="logo_orader_poto"></a>
		    		</div>
		    		<div class="order_nav">
		    			<div class="pro_step orangr_order">
		    				<h4>
		    					<i class="iconfont icon-feiji"></i>
		    					乘机信息
		    				</h4>		    				
		    			</div>
		    			<!--<div class="pro_step" >
		    				<h4>
		    					<i class="iconfont icon-feiji"></i>
		    					增值服务
		    				</h4>
		    			</div>-->
		    			<div class="pro_step" >
		    				<h4>
		    					<i class="iconfont icon-feiji"></i>
		    					支付
		    				</h4>
		    			</div>
		    			<div class="pro_step pro_step_last" >
		    				<h4>
		    					<i class="iconfont icon-feiji"></i>
		    					完成
		    				</h4>
		    			</div>
		    		</div>
		    		<div class="order_custom">
		    			<span class="respect">尊敬的会员</span>
		    			<a href="#" target="_blank" class="respect_center">客服中心</a>
		    			
		    		</div>
		    	</div>
		    </div>
		    <div class="main_container">
		    	<div class="order_left_main">
		    		<div id="order_div01">
		    			<div id="order_top_div01">
		    				<div class="top_order_header">
		    					<div class="active_01">
		    						<i class="iconfont icon-tanhao green_cont"></i>
		    						 您预订的产品仅限预订成人、儿童票，不可使用港澳通行证预订。
		    					</div>
		    					<div class="active_01">
		    						<i class="iconfont icon-tanhao green_cont"></i>
		    						  去程航班预计在扣款成功后20分钟内完成出票，保障出行；返程航班预计在扣款成功后80分钟内完成出票，保障出行。
		    					</div>
		    				</div>
		    				
		    			</div>
		    			<div id="order_left_center">
		    				<div class="order_info">
		    					<div class="order_top_info">
		    						<h2>乘客</h2>
		    						<div class="pass_name">
		    							<ul class="passenger_name_ul">
		    								<li>
		    									<a href="#" class="paddes_name">倪浩</a>
		    								</li>
		    								<li>
		    									<a href="#" class="paddes_name">倪妮</a>
		    								</li>
		    							</ul>
		    						</div>
		    					</div>
		    				</div>
		    			</div>
		    			<div id="r_zhm">
		    				<div class="r_zhm_info">
		    					<div class="r_zhm_info_left">
		    						<div class="r_zhm_top">
		    							<input id="p_inputr_name" type="text"  class="input_name"/>
		    							<label for="p_inputr_name" class="oreder_label">姓名，请与登记证件姓名保持一致</label>
		    							<!--<div class="div_languarg">
		    								<div class="china">中</div>
		    								<div class="china">英</div>
		    							</div>-->
		    						</div>
		    						<div class="r_zhm_top">
		    							<div class="r_zhm_top_right dropdown">
		    								<a href="#" class="dropdown-toggle zhm_a" data-toggle="dropdown">身份证 <b class="caret b_sanjiao"></b></a>
		    								<ul class="dropdown-menu ul_zhengjian">
												<li><a id="action-1" href="#">身份证</a></li>
												<li><a href="#">护照</a></li>
												<li><a href="#">军人证</a></li>
												<li><a href="#">回乡证</a></li>
												<li><a href="#">台胞证</a></li>
												<li><a href="#">户口簿</a></li>
				                            </ul>
		    							</div>
		    							<div class="zhm_number">
		    								<input id="p_inputr_name" type="text"  class="input_name input_zhm_number"/>
		    							    <label for="p_inputr_name" class="oreder_label dengji_zhm">登记证件号码</label>
		    							</div>
		    						</div>
		    						<div class="r_zhm_top">
		    							<div class="r_zhm_top_right dropdown div_zhm_phone">
		    								<a href="#" class="dropdown-toggle zhm_a" data-toggle="dropdown">中国大陆区号（86） <b class="caret"></b></a>
		    								<ul class="dropdown-menu ul_zhengjian">
												<li><a id="action-1" href="#">加大拿1</a></li>
												<li><a href="#">法国33</a></li>
												<li><a href="#">美国1</a></li>
												<li><a href="#">中国香港852</a></li>
												<li><a href="#">中国澳门853</a></li>
												<li><a href="#">中国台湾886</a></li>
				                            </ul>
		    							</div>
		    							<div class="zhm_number">
		    								<input id="p_inputr_name" type="text"  class="input_name input_zhm_number"/>
		    							    <label for="p_inputr_name" class="oreder_label dengji_zhm">乘机人手机，用于接收航班信息</label>
		    							</div>
		    						</div>
		    					</div>
		    					<div class="div_zhm_info_right">
		    					     <div id="count">
		    					     	
		    					     </div>
		    				    </div>
		    				   <button type="button" class="btn btn-danger delete_button">删除</button>
		    				</div>
		    			    <div class="add_div">
		    			    	<a href="#" class="add_ck"> + 添加乘客</a>
		    			    </div>
		    			</div>
		    			<div id="phone-people">
		    				<div class="phone_people_container">
		    					<div class="phone_people_h4">
		    						<h4>联系人</h4>
		    					</div>
		    					<div class="phone_people_info">
		    						<div class="r_zhm_top_right dropdown div_zhm_phone  people_info">
		    								<a href="#" class="dropdown-toggle zhm_a" data-toggle="dropdown">中国大陆区号（86） <b class="caret"></b></a>
		    								<ul class="dropdown-menu ul_zhengjian">
												<li><a id="action-1" href="#">加大拿1</a></li>
												<li><a href="#">法国33</a></li>
												<li><a href="#">美国1</a></li>
												<li><a href="#">中国香港852</a></li>
												<li><a href="#">中国澳门853</a></li>
												<li><a href="#">中国台湾886</a></li>
				                            </ul>
				                            <input id="p_inputr_name" type="text"  class="input_name input_zhm_number qita_info"/>
		    							    <label for="p_inputr_name" class="qita_info_label">手机号(接收航班的变化信息)</label>
		    						</div>
		    						<div class="zhm_number">
		    								<input id="p_inputr_name" type="text"  class="input_name input_zhm_number people_info_qita"/>
		    							    <label for="p_inputr_name" class="oreder_label dengji_zhm emaill_info">Emaill(接收航班的变化信息)</label>
		    						</div>
		    					</div>
		    				</div>
		    				
		    			</div>
		    			<div class="people_info_button">
		    				<a href="<?php  echo Yii::$app->urlManager->createUrl('flight/pay') ?>" class="btn btn-success btn_aa">下一步</a>
		    			</div>
		    		</div>
		    		
		    	</div>
		    	<div class="main_oreder-right">
		    	<?php foreach ($flightarr as $k=> $flight) {?> 
		    		<div class="main_right_content">
		    			<div id="journey">
		    				<div class="journey_info">
		    					<div class="j_info_top">
		    						<span class="order_go">
		    						第<?=$k+1?>程</span>
		    						<div class="order_data_time">
		    							<?=substr($flight['DepartDate'],5,5)?>
		    							<span class="oreder_week public">
		    								<?=$flight['Week']?>
		    							</span>
		    						</div>
		    						<div class="take_off_city public">
		    							<?=$flight['DepartCity']?>
		    						</div>
		    						<div class="icon_take public">
		    							<i class="iconfont icon-chufadaodaxiao"></i>
		    						</div>
		    						<div class="Arrive_city public">
		    							<?=$flight['ArriveCity']?>
		    						</div>
		    						
		    					</div>
		    					<div class="fli_tit">
		    						<span class="public fli_tit_span fli_01">
		    							<img src="images/cr.png" width="16px" height="16px" />
		    							 <?=$flight['AirlineShortName']?>
		    						</span>
		    						<span class="public fli_tit_span fli_02">
		    							<?=$flight['PlaneModelName']?>
		    						</span>
		    						<span class="public fli_tit_span fli_03">经济舱</span>
		    					</div>
		    					<div class="fli_det">
		    						<div class="row update_row">
		    							<div class="col-xs-4 public">
		    								<div class="text_align_right"><?=substr($flight['DepartTime'],0,5)?></div>
		    								<div  class="text_align_right"><?=$flight['DepartAirport']?></div>
		    							</div>
		    							<div class="col-xs-4 fli_tit_span">
		    								<div>
		    								<i class="iconfont icon-shijian"></i>
		    								<?=$flight['RealDuration']?>m
		    								</div>
		    								<div class="icon-qifei">
			    								<i class="iconfont icon-lianjiexuxian"></i>
			    								<i class="iconfont icon-qifei"></i>
		    								</div>
		    							</div>
		    							<div class="col-xs-4 public">
		    								<div class="text-align_left"><?=substr($flight['ArriveTime'],0,5)?></div>
		    								<div class="text-align_left"><?=$flight['ArriveAirport']?></div>
		    							</div>
		    						</div>
		    					</div>
		    			</div>
		    			
		    		</div>
		    		<div id="dingdan_info">
		    			<div class="dingdan_footer_info">
		    				<div class="cos_det">
		    					<div class="cos_det_top">
		    						<div class="cos_top_content">
		    							<span>
		    								去程成人套餐
		    								<i class="iconfont icon-xiala"></i>
		    							</span>
		    							<span class="up_da" data-toggle="popover" data-placement="top" data-content="<img src='images/gaiqi.png' width='340px' height='170px'/>">
		    								免费改期
		    							</span>
		    							<span class="up_da" data-toggle="popover" data-placement="top" data-content="<img src='images/xingli.png' />">
		    								行李额
		    							</span>
		    						</div>
		    						<div class="cos_top-right">
				    						<span class="dfn_color">
				    							<dfn>￥</dfn>
				    							700
				    						</span>
				    						<span class="ling_color">
				    							x 1
				    						</span>
		    					   </div>
		    					 </div>
	    					   <ul class="roder_ul_info">
	    					   	   <li class="roder_ul_info_li">
		    					   	   	  <div class="cheng_people">
		    					   	   	  	   成人
		    					   	   	  </div>
		    					   	   	  <div class="cos_top-right">
				    						<span class="dfn_color">
				    							<dfn>￥</dfn>
				    							700
				    						</span>
				    						<span class="ling_color">
				    							x 1
				    						</span>
		    					         </div>
	    					   	   </li>
	    					   	   <li class="roder_ul_info_li">
	    					   	   	   <div class="cheng_people">
		    					   	   	  	   儿童
		    					   	   	  </div>
		    					   	   	  <div class="cos_top-right">
				    						<span class="dfn_color">
				    							<dfn>￥</dfn>
				    							0
				    						</span>
				    						<span class="ling_color">
				    							x 0
				    						</span>
		    					         </div>
	    					   	   </li>
	    					   </ul>
	    					   <div class="cos_det_top">
		    						<div class="cos_top_content">
		    							<span class="jijian">
		    								机建
		    							</span>
		    							
		    						</div>
		    						<div class="cos_top-right">
				    						<span class="dfn_color">
				    							<dfn>￥</dfn>
				    							50
				    						</span>
				    						<span class="ling_color">
				    							x 1
				    						</span>
		    					   </div>
		    					 </div>
		    					 <div class="cos_det_top">
		    						<div class="cos_top_content">
		    							<span class="ranyou">
		    								燃油税
		    							</span>
		    						</div>
		    						<div class="cos_top-right">
				    						<span class="dfn_color">
				    							<dfn>￥</dfn>
				    							免费
				    						</span>
				    						<!--<span class="ling_color">
				    							x 1
				    						</span>-->
		    					   </div>
		    					 </div>
		    				</div>
		    				<div class="order_zuihou">
		    					<span class="heji_money">
		    						<dfn class="orange_color_dfn">￥</dfn>
		    						750
		    					</span>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    	<?php }?>
		    </div>
		  </div>
	</div>
	<script src="/frontend/web/js/jquery-v2.1.1.min.js"></script>
	<script>
		$(function(){		

          	$(".add_ck").click(function(){
				var aa=$(".r_zhm_info").html();
				var bb=$(this).parent().before("<div class='r_zhm_info'></div>");
				$(this).parent().prev().html(aa);
				$(this).parent().prev().find(".delete_button").addClass("add_num");
				$(".add_num").click(function(){
				       $(this).parent().remove();							
				})
			});							
			$('.up_da').popover({
				        trigger : 'hover',//鼠标以上时触发弹出提示框
				        html:true,//开启html 为true的话，data-content里就能放html代码了
				    });
				    
		    $(".input_name").focus(function(){
		    	$(this).siblings("label").hide();
		    }).blur(function(){
		    	$(this).siblings("label").show();
		    })
		})
	</script>
	</script>

