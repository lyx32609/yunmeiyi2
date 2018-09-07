<?php
	use yii\helpers\Url;
	use yii\helpers\Html;	
?>

<link href="/frontend/web/css/mian.css" rel="stylesheet">
<script src="/frontend/web/js/lazyload-min.js"></script>	
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
							<li><a href="#" style="display: inline"><img src="/frontend/web/images/che.jpg" alt=""></a></li>
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
	                                echo Html::encode(yii::$app->user->identity->UserPhone);
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
							<span class="hb_title">航程类型：</span>
						</div>
						<div class="col-md-3">
							<input type="radio" name="trale_type" value="D">单程
						</div>
						<div class="col-md-3">
							<input type="radio" name="trale_type" value="S">往返
						</div>
					</div>
					<div class="col-md-6 dz-con">
						<div class="row dz-con-i">
							<div class='col-md-12 dz-list'>
								<div class="form-group city_01">
									<div class='input-group date'>
										<label id="start" for=""  style="width: 220px;">
											<span class="city">出发城市</span> 
											<input type="text" class="form-control chufa_city_one" name="departcity"  style="margin-left: 6px" placeholder="请输入城市名" id="inputTest" />
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-map-marker"></span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<a class="change_button"><img src="" alt=""></a>
							<div class='col-md-6 dz-list'>
								<div class="form-group city_01">
									<div class='input-group date'>
										<label id="end" for=""  style="width: 220px;">
											<span class="city">到达城市</span>
											<input type="text" class="form-control daoda_city_one" style="margin-left: 6px" name="arrivecity"  placeholder="请输入城市名" id="inputTest2" />
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-map-marker"></span>
											</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 time-con">
						<div class="row">
							<div class='col-md-12 time-list'>
								<div class="form-group city_01">
									<div class='input-group date' id='datetimepicker6'>
										<label for=""  style="width: 220px;">
											<span style="line-height: 34px;float: left;">出发日期</span>
											<input type='text' class="form-control" name="DepartTime1" style="margin-left: 6px"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class='col-md-12 time-list'>
								<div class="form-group city_01">
									<div class='input-group date' id='datetimepicker7'>
										<label for=""  style="width: 220px;">
											<span style="line-height: 34px;float: left;">返程日期</span>
											<input type='text' name="DepartTime11" class="form-control" style="margin-left: 6px"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12" style="padding: 0;margin-left: 65px;">
						<div class="col-md-2" style="padding: 0;">
							<div class="input-group">
								<span class="input-group-addon input_scorp">
									<input type="checkbox" aria-label="...">带儿童
								</span>
							</div>
						</div>
						<div class="col-md-2"  style="padding: 0;">
							<div class="input-group">
								<span class="input-group-addon input_scorp">
									<input type="checkbox" aria-label="...">带婴儿
								</span>
							</div>
						</div>
						<div class="col-md-2"  style="padding: 0;">
							<div class="input-group show_ertong_con">
								<span class="input-group-addon input_scorp" id="show_ertong">儿童/婴儿票</span></span>
								<img  id="show_ertong_img"src="/frontend/web/images/children.png" alt="">
							</div>
						</div>
						<div class="col-md-3">
							<div id="search"class="col-md-4">
								<a style="width: 56px;display: block;">高级搜索</a>
							</div>
						</div>
					</div>					
					<div class="col-md-12" id="show_search">
						<div class="col-md-12">
							<span class="hb_title">航空公司</span>
							<select name="" style="width: 70%">
								<option value="">不限</option>
								<option value="">中国国航</option>
								<option value="">东方航空</option>
							</select>
						</div>
						<div class="col-md-12 hb_cw">
							<span class="hb_title">舱位</span>
							<lable style="margin-left: 28px;"><input type="radio" name="" id="" value="" />经济舱</lable>
							<lable style="margin-left: 28px;"><input type="radio" name="" id="" value="" />头等舱</lable>
							<lable style="margin-left: 28px;"><input type="radio" name="" id="" value="" />商务舱</lable>
						</div>
					</div>
					<div class="col-md-12 btn-z">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<button class="btn-success btn-lg btn-position">立即搜索</button>
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
<script type="text/javascript" src="\frontend\web\js\jQuery.js" ></script>
<script type="text/javascript">
	$(function () {
		
				
				$("input[name='trale_type'][value='D']").attr("checked",true);
				$('#datetimepicker6').datetimepicker({
					locale: moment.locale('zh-cn'),
					format: 'YYYY-MM-DD'
				}
				);
				$('#datetimepicker6>input').datetimepicker({
					locale: moment.locale('zh-cn'),
					format: 'YYYY-MM-DD'
				}
				);
				$('#datetimepicker7').datetimepicker({
					useCurrent: false, //Important! See issue #1075
					locale: moment.locale('zh-cn'),
					format: 'YYYY-MM-DD'
				});
				$('#datetimepicker7>input').datetimepicker({
					useCurrent: false, //Important! See issue #1075
					locale: moment.locale('zh-cn'),
					format: 'YYYY-MM-DD'
				});
				$("#datetimepicker6").on("dp.change", function (e) {
					$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
				});
				$("#datetimepicker7").on("dp.change", function (e) {
					$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
					$("input[name='trale_type'][value='S']").attr("checked",true);
				});
				var show_C = document.getElementById('show_ertong');
		var show_I = document.getElementById('show_ertong_img');
		show_C.onmouseover=function()
		{
			if(show_I.style.display=='block')
			{
				show_I.style.display='none';
			}
			else
			{
				show_I.style.display='block';
			}
		}
		show_C.onmouseout=function()
		{
			if(show_I.style.display=='block')
			{
				show_I.style.display='none';
			}
			else
			{
				show_I.style.display='block';
			}
		}
		var search = document.getElementById('search');
		var show_S = document.getElementById('show_search');

		search.onclick=function()
		{
			if(show_search.style.display=='block')
			{
				show_S.style.display='none';
			}
			else
			{
				show_S.style.display='block';
			}
		};

		$(".change_button").click(function(){
			var val_01=$(".chufa_city_one").val();
			var val_02=$(".daoda_city_one").val();
			$(".chufa_city_one").val(val_02);
			$(".daoda_city_one").val(val_01);

			 
		})  
	});
</script>
<script type="text/javascript">
	LazyLoad.css(["/frontend/web/css/cityStyle.css"], function () {
		LazyLoad.js(["/frontend/web/js/cityScript.js"], function () {
			var test = new citySelector.cityInit("inputTest");
			var test2 = new citySelector.cityInit("inputTest2");
		});
	});
</script>
