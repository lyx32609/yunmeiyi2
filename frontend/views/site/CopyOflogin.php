<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Login';
?>
<link href="/frontend/web/css/layout.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="/frontend/web/js/jquery-v2.1.1.min.js"></script>-->
<?=Html::jsFile('@web/js/jquery-v2.1.1.min.js')?>
<script type="text/javascript" src="/frontend/web/js/login.js"></script>
	<body>
		<!--头部-->
		<div id="top-cont">
			<div id="top-min">
				<div id="min-left"></div>
				<div id="min-right"></div>
			</div>
		</div>
		<div id="menu">
			<div id="menu-m">
				<ul>
					<li>
						<a href="<?=Url::to(['site/index']) ?>">首页</a>
					</li>
                    <li style="width:8px;"><img src="/frontend/web/images/t1.jpg" width="8" height="42" /></li>
                    <li>
                        <a href="<?=Url::to(['flight/index']) ?>">机票</a>
                    </li>
                    <li style="width:8px;"><img src="/frontend/web/images/t1.jpg" width="8" height="42" /></li>
                    <li>
                        <a href="#">酒店</a>
                    </li>
					<li style="width:8px;"><img src="/frontend/web/images/t1.jpg" width="8" height="42" /></li>
					<li>
						<a href="#">境内游</a>
					</li>
					<li style="width:8px;"><img src="/frontend/web/images/t1.jpg" width="8" height="42" /></li>
					<li>
						<a href="#">境外游</a>
					</li>
					<li style="width:8px;"><img src="/frontend/web/images/t1.jpg" width="8" height="42" /></li>
					<li>
						<a href="#">热门游</a>
					</li>
					<li style="width:8px;"><img src="/frontend/web/images/t1.jpg" width="8" height="42" /></li>
					<li>
						<a href="#">团购</a>
					</li>
				</ul>
			</div>
		</div>

		<div id="login-bg">
			<img width="100%"src="/frontend/web/images/r-bg.jpg" alt="">
			<div id="login-m">
             <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'UserPhone')->textInput(['autofocus' => true,'placeholder'=>'请输入手机号！']) ?>

                <?= $form->field($model, 'PasswordMD5')->passwordInput(['placeholder'=>'请输入密码！']) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction'=>'site/captcha', 'template' =>'{input}{image}',
                    'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer']]) ?>
				
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <?= Html::a('忘记密码', ['site/request-password-reset'],['class' => 'wj_password'])  ?>

				<div class="btn_default">
                    <?= Html::button('注册', ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>

                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>
                </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <script type="text/javascript">
            //刷新验证码
            $(function () {
                //解决验证码不刷新的问题
                changeVerifyCode();
                $('#loginform-verifycode-image').click(function () {
                    changeVerifyCode();
                });
            });
            //更改或者重新加载验证码
            function changeVerifyCode() {
//项目URL
                //ar adminUrl = $('#admin-url').val();
                $.ajax({
                    //使用ajax请求site/captcha方法，加上refresh参数，接口返回json数据
                    url: "<?php  echo Yii::$app->urlManager->createUrl('site/captcha')?>?refresh",
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        //将验证码图片中的图片地址更换
                        $("#loginform-verifycode-image").attr('src', data['url']);
                    }
                });
            }
        </script>

        <!--底部-->
		<div id="foot">
			<div id="foot-t">
				<p>Copyright © 2015-2017 鄂ICP备16015628号 版权所有，保留一切权利。</p>
				<p>
					<a href="https://ceet-gov.top">隐私保护</a> |
					<a href="https://ceet-gov.top">诚聘英才</a> |
					<a href="https://ceet-gov.top">关于我们</a> |
					<a href="https://ceet-gov.top">网站地图</a> |
					<a href="https://ceet-gov.top">友情链接</a> |
					<a href="https://ceet-gov.top">商务合作</a>
				</p>
			</div>
		</div>
	</body>

</html>