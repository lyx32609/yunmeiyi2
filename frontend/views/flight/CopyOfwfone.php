<link href="/frontend/web/css/layout.css" rel="stylesheet">
<link href="/frontend/web/bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="/frontend/web/css/jp_liebiao.css" rel="stylesheet">
		 <div class="liebiao_container">
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
					  <li><a href="<?php  echo Yii::$app->urlManager->createUrl('site/index') ?>">首页</a></li>
					  <li class="active"><a href="<?php  echo Yii::$app->urlManager->createUrl('flight/index') ?>">机票</a></li>
					  <li><a href="#">酒店</a></li>
			    </ul>		    	
		    </div>
		    <div class="center-search">
		    	<div class="select_div">
		    		<form id="pic_search" method="post" action="<?php  echo Yii::$app->urlManager->createUrl('flight/index') ?>">
		    		<div class="x_xiala">
				    	<select class="l_xx">
						  <option <?php if(isset($serars['trale_type'])){ if($serars['trale_type']=="S") {?>selected="selected"<?php }}?>>往返</option>
						  <option <?php if(isset($serars['trale_type'])){if($serars['trale_type']=="D") {?>selected="selected"<?php }}?>>单程</option>
						  <option>多程</option>
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
							<div class="form-group div_from_01">
									<div class='input-group date' id='datetimepicker1' >
										<input type='text' name="DepartTime1" placeholder="出发日期" value="<?=$serars['DepartTime1']?>" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
						    </div>
							<div class="form-group div_from_01">
									<div class='input-group date' id='datetimepicker2' >
										<input type='text' name="DepartTime2" placeholder="返回日期" class="form-control" />
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
									<div class='input-group date' id='datetimepicker3' >
										<input type='text' name="DepartTime3" placeholder="出发日期" class="form-control" />
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
		    						<strong class="data_qifei"><?=$f['DepartTime']?></strong>
		    					</div>
		    					<div><?=$f['DepartAirport']?></div>
		    				</td>
		    				<td class="center_td">
		    					<div class="arrow"></div>
		    				</td>
		    				<td class="td_jiangluo">
		    					<div>
		    						<strong class="data_qifei"><?=$f['ArriveTime']?></strong>
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
		    					<button type="button" class="orange">选为去程</button>
		    				</td>
		    			</tr>
		    		</table>
		    	</div>
		    	<?php }?>
		    	
		    </div>
		 
		   </div>
		 	
		 </div>
	
