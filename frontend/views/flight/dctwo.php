<link rel="stylesheet" href="/frontend/web/css/jp_liebiao.css" />
<link rel="stylesheet" href="/frontend/web/css/layout.css" />
		 <div class="chakan_container">
		 	<div id="top-cont">
					<div id="top-min">
						<div id="min-left"></div>
		                <form id="s_form">
		                     <!--<input type="text" id="s_input"placeholder="搜索城市/酒店/旅游/景点门票/机票"/>
		                    <button class="button_01">搜索</button>-->
		                </form>
						<div id="min-right">
		                     <ul class="s_right">
		                         <li class="index_li">Global Sites<span class="l_sj"></span>
		                             <img class="lan_yu" src="./images/lan.png" alt=""/>
		                         </li>
		                         <li class="center_li"><a class="ke_fu">客服中心</a></li>
		                         <li class="last_li">国内电话：<span>400-830-6666</span><span class="s_sj"></span></li>
		                     </ul>
		                    <div class="er_right">
		                         <div class="er_left">
		                             <img src="./images/phone.png" />
		                             <div class="phone_er">
		                                 <img src="./images/phone_er.png" />
		                             </div>
		                         </div>
		                        <div class="er_left">
		                            <img src="./images/weixin.png" />
		                            <div class="phone_er">
		                                <img src="./images/weixin_er.png" />
		                            </div>
		                        </div>
		                    </div>
		                </div>
					</div>
		    </div>
		    <div class="dao_hang">
		    	<ul class="nav">
					  <li><a href="<?php  echo Yii::$app->urlManager->createUrl('site/index') ?>">首页</a></li>
					  <li class="active"><a href="<?php  echo Yii::$app->urlManager->createUrl('flight/index') ?>">机票</a></li>
					  <li><a href="#">酒店</a></li>
			    </ul>		    	
		    </div>
		    <div class="center-search">
		    	<div class="select_div">
		    		<form id="pic_search" method="post" action="<?php  echo Yii::$app->urlManager->createUrl('flight/index') ?>">
		    		<div class="x_xiala">
				    	<select class="l_xx" name="trale_type">
						  <option  value="S">往返</option>
						  <option  value="D">单程</option>
						  <option>多程</option>
						</select>
					</div>
					<div class="wangfan">
						<div class="one_line">
							<span class="span_01" id="span01">第一程</span>
							<div class="cf_city">
								 <span class="iconfont icon-qifei1 qifei_span"></span>
								 <input type="text" name="departcity" placeholder="出发城市" value='' class="input_chufa"/>								
							</div>
							<div class="cf_city">
								 <span class="iconfont icon-jiangla qifei_span"></span>
								 <input type="text" name="arrivecity" placeholder="到达城市" value=''  class="input_chufa"/>								
							</div>
							<div class="form-group div_from_01">
									<div class='input-group date' id='datetimepicker1' >
										<input type='text' name="DepartTime1" placeholder="出发日期" value="" class="form-control chufa_date_dat" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
						    </div>
							<div class="form-group div_from_01">
									<div class='input-group date' id='datetimepicker2' >
										<input type='text' name="DepartTime2" placeholder="返回日期" class="form-control chufa_date_dat" />
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
							<div class="form-group div_from_01">
									<div class='input-group date' id='datetimepicker2' >
										<input type='text' name="DepartTime3" placeholder="出发日期" class="form-control chufa_date_dat" />
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
			    		   <h4>筛选<small class="s_xiao">(共<span>2</span>条数据)</small></h4>
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
								  	 <label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1">东方航空
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2">山东航空
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="inlineCheckbox3" value="option3">海南航空
									</label>
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
		    		<table class="table_01 table_display_none">
		    			<tr>
		    				<td class="logo">
		    					<div class="logo_samll">
		    						<span class="c_name"><?=$wfafter['AirlineShortName']?></span>
		    						<span class="hk_name"><?=$wfafter['FlightCode']?></span>
		    					</div>
		    					<div class="logo_footer">
		    						<span class=""><?=$wfafter['PlaneModelName']?></span>
		    					</div>
		    				</td>
		    				<td class="td_qifei">
		    					<div>
		    						<strong class="data_qifei"><?=substr($wfafter['DepartTime'], 0,5)?></strong>
		    					</div>
		    					<div><?=$wfafter['DepartAirport']?></div>
		    				</td>
		    				<td class="center_td">
		    					<div class="arrow"></div>
		    				</td>
		    				<td class="td_jiangluo">
		    					<div>
		    						<strong class="data_qifei"><?=substr($wfafter['ArriveTime'], 0,5)?></strong>
		    					</div>
		    					<div><?=$wfafter['ArriveAirport']?></div>
		    				</td>
		    				<td class="z_d_lv">
		    					<div>
		    						准点率
		    					</div>
		    					<div><?=$wfafter['Accuracy']/10?>%</div>
		    				</td>
		    				<td class="preferential">
		    					<div>
		    						
		    					</div>
		    				</td>
		    				<td class="price">
		    					<div>
		    						<span class="number">
		    							<dfn>￥</dfn>
		    							700
		    						</span>
		    						<span class="up">
		    							起
		    						</span>
		    					</div>
		    				</td>
		    				<td class="orange_button">
		    					<button type="button" class="orange one_first">预订</button>
		    				</td>
		    			</tr>
		    		</table>
		    		<table class="table_01">
		    			<tr>
		    				<td class="logo">
		    					<div class="logo_samll">
		    						<span class="c_name"><?=$f['AirlineShortName']?></span>
		    						<span class="hk_name"><?=$f['FlightCode']?></span>
		    					</div>
		    					<div class="logo_footer">
		    						<span class=""><?=$f['PlaneModelName']?></span>
		    					</div>
		    				</td>
		    				<td class="td_qifei">
		    					<div>
		    						<strong class="data_qifei"><?=substr($f['DepartTime'], 0,5)?></strong>
		    					</div>
		    					<div><?=$f['DepartAirport']?></div>
		    				</td>
		    				<td class="center_td">
		    					<div class="arrow"></div>
		    				</td>
		    				<td class="td_jiangluo">
		    					<div>
		    						<strong class="data_qifei"><?=substr($f['ArriveTime'], 0,5)?></strong>
		    					</div>
		    					<div><?=$f['ArriveAirport']?></div>
		    				</td>
		    				<td class="z_d_lv">
		    					<div>
		    						准点率
		    					</div>
		    					<div><?=$f['Accuracy']/10?>%</div>
		    				</td>
		    				<td class="preferential">
		    					<div>
		    						
		    					</div>
		    				</td>
		    				<td class="price">
		    					<div>
		    						<span class="number">
		    							<dfn>￥</dfn>
		    							700
		    						</span>
		    						<span class="up">
		    							起
		    						</span>
		    					</div>
		    				</td>
		    				<td class="orange_button">
		    					<button type="button" class="orange two_second">预订</button>
		    				</td>
		    			</tr>
		    		</table>
		    		<div class="wai_button">
		    			<button type="button" class="shouqi_button">收起</button>
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
											<span>普通预订</span><div class="btn btn-danger" 
											onclick="lyxyuding(this,'去程机票id','返程机票id','PriorityPackage')">预订</div>
										</div>
										<div class="col-md-12 jp_gs">
											<span>普通预订</span><div class="btn btn-danger">预订</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		    	</div>
		    	  
		    	<?php } ?>
		    </div>
		   </div>
		 </div>
		 <script src="/frontend/web/js/jquery-v2.1.1.min.js"></script>
		 <script>
		 $(function(){	
		 	$("#span01").text("");
		 	$(".l_xx").change(function(){
		 		var aa=$(".l_xx").val();
		 	if(aa=="往返"){
		 		$("#span01").text();
		 		$(".two_line").hide();
		 		$(".three_line").hide();
		 		$("#last_input").show();
		 	}else if(aa=="单程"){
		 		$("#span01").text();
		 		$(".two_line").hide();
		 		$(".three_line").hide();
		 		$("#last_input").show();
		 	}else{
		 		$("#span01").text("第一程");
		 		$(".two_line").show();
		 		$("#last_input").hide();
		 	}
		 	})

		  	$(".gj_search").click(function(){
			//		 		  $(".caret").css("transform","rotate(180deg)");
			                 if($(".three_line").css("display")=="none"){
			                 	$(".three_line").show()
			                 }else{
			                 	$(".three_line").hide()
			                 }
					 	});
					 	$(".table_display_none").css("display","none");
						$(".two_second").on("click",function(){
				 		  var aa=$(this).parents().parents().parents().parents().siblings(".jp_list");
						   if(aa.css("display")=="none"){
							aa.css("display","block");
							$(this).parents().parents().parents().parents().siblings(".table_display_none").css("display","block");
							$(this).parents().parents().parents().parents().siblings(".table_display_none").find(".one_first").css("display","none");
							$(this).css("display","none");
							$(this).parents().parents().parents().parents().siblings(".wai_button").css("display","block");
						   }
					 	});
					 	$(".wai_button").click(function(){
					 		$(this).siblings(".table_display_none").css("display","none");
					 		$(this).siblings("table").find(".two_second").css("display","block");
					 		$(this).css("display","none");
					 		$(this).siblings(".jp_list").css("display","none");
					 	})
		 })
	</script>
		 <script type="text/javascript">
					function yuding(){
						$.ajax({
						    url:'/comm/test1.php',
						    type:'POST', //GET
						    async:true,    //或false,是否异步
						    data:{
						        name:'yang',age:25
						    },
						    timeout:5000,    //超时时间
						    dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
						    beforeSend:function(xhr){
						        console.log(xhr)
						        console.log('发送前')
						    },
						    success:function(data,textStatus,jqXHR){
						        console.log(data)
						        console.log(textStatus)
						        console.log(jqXHR)
						    },
						    error:function(xhr,textStatus){
						        console.log('错误')
						        console.log(xhr)
						        console.log(textStatus)
						    },
						    complete:function(){
						        console.log('结束')
						    }
						})
						}
					
		    	</script>
		    	
