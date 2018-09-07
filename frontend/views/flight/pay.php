<link rel="stylesheet" href="/frontend/web/css/pay.css" />
<?php
$this->title = '旅乐行旅游网-航班订单';	
?>
	<div class="container_dingdan">
	    <div class="order_header">
	    	<div class="order_header_top">
	    		<div class="order_header_logo">
	    			<a href="#" class="logo_orader_poto"></a>
	    		</div>
	    		<div class="order_custom">
	    			<span class="respect">温馨提示</span>
	    			<a href="#" target="_blank" class="respect_center">建议与反馈</a>	
	    		</div>
	    	</div>
	    </div>	
	</div>
	<!-- 头部区域结束 -->
	<div class="container order_information">
		<div class="row information_con">
			<div class="col-md-4"><span class="jine">订单金额：<span class="c">¥ <span class="j">750.00</span></span></span></div>
			<div class="col-md-6">
				<div class="col-md-10 address"><span>单程机票  <?=$flight['DepartCity']?> - <?=$flight['ArriveCity']?></span></div>
				<div class="col-md-12"><span>飞机 &nbsp;&nbsp; <?=$flight['DepartAirport']?> - <?=$flight['ArriveAirport']?> &nbsp;&nbsp; 出发时间：<?=$flight['DepartTime']?></span></div>
				<div class="col-md-10"><span>乘机人：<?=$message['UserName']?> &nbsp;&nbsp; 乘机证件：身份证 <?=$message['Identity1']?></span></div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row information_prompt">
			<div class="col-md-12">
				<span>航班价格变动频繁，请在30分钟内完成支付以免耽误出行</span>
			</div>
		</div>
	</div>
	<div class="container" style="padding-bottom: 50px;">
		<div class="row">
			<div class="col-md-12">
				<p style="margin-top:10px;padding: 20px 0;border-top: 1px solid #e1e1e1"><span class="jine">需支付：<span class="c">¥ <span class="j">750</span></span>  </span> </p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="iconfont icon-umidd16"></i> 微信支付</a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="iconfont icon-bank-card"></i> 储蓄卡</a></li>
					<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="iconfont icon-xinyongqia"></i> 信用卡</a></li>
					<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="iconfont icon-cloud-zhi"></i> 支付宝</a></li>
					<li role="presentation"><a href="#web" aria-controls="web" role="tab" data-toggle="tab"><i class="iconfont icon-kong"></i> 网上支付</a></li>
					<li role="presentation"><a href="#three" aria-controls="three" role="tab" data-toggle="tab"><i class="iconfont icon-disanfangzhifupeizhi"></i> 第三方支付</a></li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						<div class="weixin">
							<p>提示：点击“下一步”后，请打开手机微信的“扫一扫”，扫描二维码</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="profile">
						<div class="card_con">
							<div class="card_team">
								<span class="card_title">储蓄卡卡号：</span>
								<div class="card_from">
									<input type="text" value="请输入银行卡号" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999">
									<div class="hint">
										<span>支持百余家全国及地方银行</span>
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
												支持银行的列表
										</button>
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">支持储蓄卡银行列表</h4>
													</div>
													<div class="modal-body">
														<img src="images/yh.png" alt="" width="560">
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
														<button type="button" class="btn btn-primary">选择</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="messages">
						<div class="card_con">
							<div class="card_team">
								<span class="card_title">信用卡卡号：</span>
								<div class="card_from">
									<input type="text" value="请输入卡号" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999">
									<div class="hint">
										<span>支持百余家银行，4家境外银行组织</span>
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalq">
												支持银行的列表
										</button>
										<div class="modal fade" id="myModalq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">支持信用卡银行列表</h4>
													</div>
													<div class="modal-body">
														<img src="images/yh.png" alt="" width="560">
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
														<button type="button" class="btn btn-primary">选择</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="settings">
						<div class="bank_list alone">
							<ul class="bank_items">
								<li class="act">
									<i class="more_alipay"></i>
								</li>
							</ul>
						</div>
						<div class="clear"></div>	
					</div>
					<div role="tabpanel" class="tab-pane" id="web">
						<div class="bank_list alone">
							<div class="ti">
								<span class="bank_type"><em class="hint ml0">需跳转银行页面，无法享受携程支付的快捷便利</em></span>
							</div>
							<ul class="bank_items">
								<li class="act">
									<i class="creditcard_comm"></i>
								</li>
								<li>
									<i class="creditcard_ccb"></i>
								</li>
								<li>
									<i class="creditcard_icbc"></i>
								</li>
								<li>
									<i class="creditcard_boc"></i>
								</li>
								<li>
									<i class="creditcard_abc"></i>
								</li>
								<li>
									<i class="creditcard_cmb"></i>
								</li>
								<li>
									<i class="creditcard_spdb"></i>
								</li>
								<li>
									<i class="creditcard_psbc"></i>
								</li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
					<div role="tabpanel" class="tab-pane" id="three">
						<div class="bank_list alone">
							<ul class="bank_items">
								<li class="act">
									<i class="more_unionpay"></i>
								</li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="order_step">
					
					<a href="<?php  echo Yii::$app->urlManager->createUrl('flight/over') ?>" class="btn btn-success">下一步</a>
					
					<a href="" class="goback">返回修改订单</a>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		$(function(){		
			$('#myTabs a').click(function (e) {
				e.preventDefault()
				$(this).tab('show')
			  })
			$('#myTabs a[href="#profile"]').tab('show') // Select tab by name
			$('#myTabs a:first').tab('show') // Select first tab
			$('#myTabs a:last').tab('show') // Select last tab
			$('#myTabs li:eq(2) a').tab('show') // Select third tab (0-indexed)	
		})
	</script>
