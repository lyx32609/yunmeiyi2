<?php
use yii\helpers\Url;
use yii\helpers\Html;	
?>
<link href="/frontend/web/css/mian.css" rel="stylesheet">
<style type="text/css">
*{
	list-style: none;
}	
.xian{
	border-bottom: 1px solid #ccc;
}
</style>
<?php
/* @var $this yii\web\View */
$this->title = '旅乐行旅游网';
?>
	<!--logo加国旗-->
	<div class="container">
		<div class="row" style="">
			<div class="col-md-3">
				<div class="row" style="">
				<div class="col-md-2">
				</div>
					<div class="col-md-2">
						<img src="/frontend/web/images/logo.jpg"/>
					</div>
					<div class="col-md-8">
						
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-8">
				<div class="row" style="">
					<div class="col-md-4">
						<span></span>
					</div>
					<div class="col-md-6">
						<div class="row header-right" style="">
							<div class="col-md-3">
								<span>Global Sites</span>
							</div>
							<div class="col-md-3">
								<span>客服中心</span>
							</div>
							<div class="col-md-3 dd">
								<span>国内电话：400-830-6666 </span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="row icon-i">
							<div class="col-md-6">
								<img src="/frontend/web/images/tubiao/phone.png" alt="">
							</div>
							<div class="col-md-6">
								<img src="/frontend/web/images/tubiao/weixin.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--导航栏-->
	<div class="container-fluid">
		<div class="row tiao">
			<div class="container">
				<nav class="navbar navbar-default">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				    </div>
				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li class="active"><a href="<?php  echo Yii::$app->urlManager->createUrl('site/index') ?>">首页</a></li>
						<li><a href="<?php  echo Yii::$app->urlManager->createUrl('flight/index') ?>">机票</a></li>
						<li><a href="#">酒店</a></li>
						<li><a href="#">境内游</a></li>
						<li><a href="#">境外游</a></li>
						<li><a href="#">热门游</a></li>
						<li><a href="#">团购</a></li>
						<li><a href="#" style="display: inline"><img src="images/che.jpg" alt=""></a></li>
						<?php
                            if (yii::$app->user->isGuest) {
                        ?>
                            <a href="<?= Url::to(['site/login']) ?>" style="font-size: 14px;color: #FFF;position: absolute;top:10px;right:130px"><?= '登录/' ?></a>
                            <a href="<?= Url::to(['site/signup']) ?>" style="font-size: 14px;color: #FFF;position: absolute;top:10px;right:100px;"><?= '注册' ?></a>
                          <?php } else { ?>
                            <span ><a style="font-size: 14px;color: #FFF;position: absolute;top:10px;" href="<?= Url::to(['member/index']) ?>" id="show_name">欢迎,
                          <?php
                            if(yii::$app->user->identity->LoginName){
                                echo Html::encode(yii::$app->user->identity->LoginName);
                            }else{
                                echo '尊敬的会员';
                            }
                          ?>&nbsp;&nbsp;</a></span>
                              <a href="<?= Url::to(['site/logout']) ?>"class="new_signup" style="font-size: 14px;position: absolute;top:10px;right:0px"><?= '退出' ?></a>
                          <?php } ?>
				      </ul>
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
			</div>
		</div>
	</div>
	<br/>
	<!--产品详情部分-->
	<div class="container">
		<div class="row" style="">
			<div class="col-md-5" style="border:1px solid #000">
				<div class="row" style="">
					<div class="col-md-9">
						<h4>机票预订</h4>
					</div>
					<div class="col-md-3">
						<a href="" class="dingd">我的订单</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 hangban">
						<ul class="hb-list">
							<li>国内航班</li>
							<li>国际*港澳台航班</li>
						</ul>
					</div>
					<form id="pic_search" method="post" action="<?php  echo Yii::$app->urlManager->createUrl('flight/index') ?>">
					<div class="col-md-12 fx">
						<div class="col-md-3">
							<input name="trale_type" value="D" type="radio">单程
						</div>
						<div class="col-md-3">
							<input name="trale_type" value="S" type="radio">往返
						</div>
					</div>
					<div class="col-md-6 dz-con">
						<div class="row">
							<div class='col-md-12 dz-list'>
								<div class="form-group">
									<div class='input-group date'>
										<input type='text' class="form-control" name="departcity" value="从" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-map-marker"></span>
										</span>
									</div>
								</div>
							</div>
							<div class='col-md-12 dz-list'>
								<div class="form-group">
									<div class='input-group date'>
										<input type='text' class="form-control" value="到" name="arrivecity" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-map-marker"></span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 time-con">
						<div class="row">
							<div class='col-md-12 time-list'>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker6'>
										<input type='text' name="DepartTime1" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<div class='col-md-12 time-list'>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker7'>
										<input type='text' name="DepartTime2" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-12 btn-z">
							<div class="col-md-7">
								<span>
									可实时搜索 28万 条国内国际航线
								</span>
							</div>
							<div class="cpl-md-5">
								<button  type="submit" class="btn-success btn-lg btn-position">立即搜索</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-7" style="padding: 0 0 0 10px;">
				<img alt="" src="/frontend/web/images/7.jpg" class="images-responsive" style="margin:0 auto;width:100%;height: 334px;"/>
				
			</div>
		</div>
	</div><br/><br/><br/>
	
	<!-- 产品详情部分结束 -->
	

	<!-- 产品内页带产品列表部分 三列部分 -->
	<div class="container">
		<div class="row" style="border:1px solid red;">
			<div class="col-md-12" style="padding: 0;">
				<h4>航空公司促销</h4>
				<div class="col-md-12" style="padding: 0;">
					<ul class="row" style="padding: 0;">
						<li class="col-md-4">
							<div class="thumbnail">
								<img alt="300x200" src="/frontend/web/images/people.jpg" />
								<div class="caption">
									<h3>
										这是产品标题
									</h3>
									<p>
										这是产品介绍。这是产品介绍。
									</p>
									<p>
										<a class="btn btn-primary" href="#">浏览</a> <a class="btn" href="#">分享</a>
									</p>
								</div>
							</div>
						</li>
						<li class="col-md-4">
							<div class="thumbnail">
								<img alt="300x200" src="/frontend/web/images/city.jpg" />
								<div class="caption">
									<h3>
										这是产品标题
									</h3>
									<p>
										这是产品介绍。这是产品介绍。
									</p>
									<p>
										<a class="btn btn-primary" href="#">浏览</a> <a class="btn" href="#">分享</a>
									</p>
								</div>
							</div>
						</li>
						<li class="col-md-4">
							<div class="thumbnail">
								<img alt="300x200" src="/frontend/web/images/city.jpg" />
								<div class="caption">
									<h3>
										这是产品标题
									</h3>
									<p>
										这是产品介绍。这是产品介绍。
									</p>
									<p>
										<a class="btn btn-primary" href="#">浏览</a> <a class="btn" href="#">分享</a>
									</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div><br/><br/><br/>
	<!-- 产品内页带产品列表部分 三列部分结束 -->
</div>

