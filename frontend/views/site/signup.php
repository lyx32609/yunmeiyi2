	    <link rel="stylesheet" href="/frontend/web/css/user_login.css" />
		<link rel="stylesheet" href="/frontend/web/css/font_yjd4l717y51giudi/iconfont.css" />
		<script type="text/javascript" src="/frontend/web/js/jquery-v2.1.1.min.js" ></script>
        <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use yii\captcha\Captcha;
            $this->title='注册'
        ?>
		 <div class="login_container">
		 		<div class="login_shade">
			 	</div>
			 	<div class="login_shade_info">
			 		<div class="login_shade_info_title">
			 			<h3>讯猫注册服务协议和隐私政策</h3>
			 			<a href="<?php  echo Yii::$app->urlManager->createUrl('site/index') ?>" style="position: absolute;top: 20px;right: 36px;">X</a>
			 		</div>
			 		<div class="login-content">
			 			<div class="login_arite">
			 				<p class="p_arite">
			 					<b>
			 					亲爱的用户，在您注册为讯猫用户的过程中，您需要完成我们的注册流程并通过点击同意的形式在线签署以下协议，请您务必仔细阅读、充分理解协议中的条款内容后再点击同意，由其是加粗字体。
			 				    </b>
			 				</p>
			 				<div class="clause_content">
				 				<div class="clause_title">
				 					<a href="#" target="_blank" class="fuwu_content">服务协议</a>
				 				</div>
				 				<div class="tiaokuan_content">
				 					<ol>
				 						<li>总则</li>
				 						<li>服务简介</li>
				 						<li>服务条款的修改</li>
				 						<li>服务变更、中断、终止</li>
				 						<li>使用规则</li>
				 						<li>版权声明</li>
				 						<li>用户隐私制度</li>
				 						<li>用户的账号、密码和安全性</li>
				 						<li>拒绝提供担保	</li>
				 						<li>有限责任</li>
				 						<li>讯猫网络会员服务信息的存储及限制</li>
				 						<li>用户管理</li>
				 						<li>保障</li>
				 						<li>结束服务</li>
				 						<li>通告</li>
				 						<li>参与广告策划</li>
				 						<li>邮件内容的所有权</li>
				 						<li>法律</li>
				 					</ol>
				 				</div>
			 			   </div> 
			 			   <div class="clause_content">
				 				<div class="clause_title">
				 					<a href="#" target="_blank" class="fuwu_content">隐私政策</a>
				 				</div>
				 				<p>
				 					<b>隐私政策明确了我们产品与/或服务所收集、使用及共享个人信息的类型和方式及用途；明确了用户查询、更正和删除个人信息的方式，</b>
				 					具体提纲如下:
				 				</p>
				 				<div class="tiaokuan_content">
				 					<ol>
				 						<li>总则</li>
				 						<li>服务简介</li>
				 						<li>服务条款的修改</li>
				 						<li>服务变更、中断、终止</li>
				 						<li>使用规则</li>
				 						<li>版权声明</li>
				 						<li>用户隐私制度</li>
				 						<li>用户的账号、密码和安全性</li>
				 						<li>拒绝提供担保	</li>
				 						<li>有限责任</li>
				 						<li>讯猫网络会员服务信息的存储及限制</li>
				 						<li>用户管理</li>
				 						<li>保障</li>
				 						<li>结束服务</li>
				 						<li>通告</li>
				 						<li>参与广告策划</li>
				 						<li>邮件内容的所有权</li>
				 						<li>法律</li>
				 					</ol>
				 				</div>
			 			   </div>
			 			   <p class="p_arite">
			 					【审慎阅读】您在申请注册流程中点击同意前，请您务必审慎阅读、充分理解协议中相关条款内容，尤其是与您约定免除或限制责任的条款，以及字体加粗标识的重要条款。
			 				</p>
			 				<p class="p_arite">
                                 <b>
                                 	【请您注意】如果您不同意上述协议或其中任何条款约定，请您停止注册。如果您按照注册流程提示填写信息、阅读并点击同意上述协议且完成全部注册流程后，即表示您已充分阅读、理解并接受协议的全部内容。
                                 </b>
                                                                                     如果您对以上内容有疑问，请联系：
                                 <a href="#" class="content_a">www.baidu.com</a>                                                   
			 				</p>
			 				<p class="p_arite">
                                点击同意即代表您已阅读并同意携程《服务协议》和《隐私政策》，并同意我们将您的订单信息共享给为完成此订单所必须的第三方合作方。                                                                                                                            
			 				</p>
			 			</div>			 			
			 		</div>
			 		<div class="pop_footer">
			 			 <a href="<?php  echo Yii::$app->urlManager->createUrl('site/index') ?>" class="login_button_shadow not_tongyi">不同意</a>
			 			 <a href="javascript:;" class="login_button_shadow orange_tongyi">同意并继续</a>
			 		</div>
			 	</div>
		 	<div class="login_header">
		 		<div class="login_header_logo">
		 			<a href="<?php  echo Yii::$app->urlManager->createUrl('site/index') ?>"></a>
		 		</div>
		 		<ul class="login_header_right">
		 			<li>
		 				<a href="<?php  echo Yii::$app->urlManager->createUrl('site/login') ?>" class="login_a">登录</a>
		 			</li>|
		 			<li>
		 				<a href="#" class="custom_service">客服中心</a>
		 			</li>
		 		</ul>
		 	</div>
		 	<div class="login_main">
		 		<div id="main_title">
			 		<ul>
			 			<li class="thick">
			 				<span class="weight_bold orange_bg"></span>
			 				<span class="bag_text orange_border" >填写</span>
			 			</li>
			 			<li>
			 				<span class="weight_bold"></span>
			 				<span class="bag_text">验证</span>
			 			</li>
			 			<li>
			 				<span class="weight_bold"></span>
			 				<span class="bag_text">成功</span>
			 			</li>
			 		</ul>
			 	</div>	
		 		<div class="main_login_content">
		 		    <h2>会员注册</h2>		 		
		 	    </div>
		 	    <!--<div class="form_input_login">
		 	    	<from>
		 	    		<div class="phone_number">
		 	    			<label>手机号</label>
		 	    			<input type="text" placeholder="可用作登录名" maxlength="11" class="input_sr" id="phone_n"/>
		 	    	   </div>
		 	    	   <div class="div_error hidden_shoji">
		 	    	   	   <i class="iconfont icon-tanhao"></i>
		 	    	   	   请输入正确的手机号码
		 	    	   </div>
		 	    	   <div class="phone_number">
		 	    			<label>密码</label>
		 	    			<input type="text" placeholder="8-20位字母、数字和符号" maxlength="20" minlength="8" class="input_sr" id="password" />
		 	    			<ul class="password_ul">
		 	    				<li class="xianshi">弱</li>
		 	    				<li class="xianshi">中</li>
		 	    				<li class="xianshi">强</li>
		 	    			</ul>
		 	    	   </div>
		 	    	   <div class="div_error">
		 	    	   	   <i class="iconfont icon-tanhao"></i>
		 	    	   	   请设置登录密码
		 	    	   </div>
		 	    	   <div class="phone_number hidden_input">
		 	    			<label>请确认密码</label>
		 	    			<input type="text" placeholder="再次输入密码" maxlength="11" class="input_sr" />
		 	    	   </div>
		 	    	    <div class="div_error">
		 	    	   	   <i class="iconfont icon-tanhao"></i>
		 	    	   	   请再次输入密码
		 	    	   </div>
		 	    	   <div class="phone_number">
		 	    			<label>验证码</label>
		 	    			<input type="text"  maxlength="11" class="input_sr" />
		 	    			<img src="../../images/yanzhengma_img.png" class="proving_img" width="104px" height="32px"/>
		 	    			<a href="#">换一张</a>
		 	    	   </div>
		 	    	    <div class="phone_number submit_button">
		 	    			<span>
		 	    				  注册即代表您同意我们的
		 	    				  <a href="#">服务协议</a>和
		 	    				  <a href="#">隐私政策</a>
		 	    			</span>
		 	    	   </div>
		 	    	    <div class="phone_number submit_button">
		 	    			<span>
		 	    				 <button class="next_buttton">下一步，验证</button>
		 	    				 <br  />
		 	    				 <a href="#">注册遇到问题？</a>
		 	    			</span>
		 	    	   </div>
		 	    	</from>	
		 	    </div>-->
                <div class="row">
                    <div class="col-lg-5">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'UserPhone')->textInput(['placeholder'=>'请输入手机号！']) ?>

                        <?= $form->field($model, 'PasswordMD5')->passwordInput(['id'=>'password','placeholder'=>'请输入密码！']) ?>

                        <?= $form->field($model, 'rePasswordMD5')->passwordInput(['placeholder'=>'请再次输入密码！']) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction'=>'site/captcha','template' =>'<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-3">{image}</div></div>',
                            'imageOptions'=>['id'=>'captcha-img','alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer']
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <ul class="password_ul">
                        <li class="xianshi weak">弱</li>
                        <li class="xianshi centre">中</li>
                        <li class="xianshi strong">强</li>
                    </ul>
                </div>
		 	</div>		 			 	
		 </div>
	<script>
            //刷新验证码
            $(function () {
                //解决验证码不刷新的问题
                changeVerifyCode();
                $('#captcha-img').click(function () {
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
                    $("#captcha-img").attr('src', data['url']);
                }
            });
        }
		$(function(){
			$("#password").focus(function(){
				$(".hidden_input").show();
			});
            $(".orange_tongyi").click(function(){
                $(".login_shade").hide();
                $(".login_shade_info").hide();
            });

            $('#password').keyup(function(){    //input发生改变就会触发事件
                var $test1 = /^(?:\d+|[a-zA-Z]+|[!@#$%^&*]+){6,12}$/;   //  弱：纯数字，纯字母，纯特殊字符
                var $test2 = /^(?![a-zA-z]+$)(?!\d+$)(?![!@#$%^&*]+$)[a-zA-Z\d!@#$%^&*]+$/;   //中：字母+数字，字母+特殊字符，数字+特殊字符
                var $test3 = /^(?![a-zA-z]+$)(?!\d+$)(?![!@#$%^&*]+$)(?![a-zA-z\d]+$)(?![a-zA-z!@#$%^&*]+$)(?![\d!@#$%^&*]+$)[a-zA-Z\d!@#$%^&*]+$/;   //：字母+数字+特殊字符
                if($test1.test($('#password').val())){    //必须先要满足第一个if才能进行下一个if    满足  弱  条件表示为红色
                    console.log($('#password').val());
                    if($test2.test($('#password').val())){    //必须先要满足  弱  条件  才能进行这个if    满足  中  条件表示为黄色
                        $('.weak').css('background-color','#f1d0b9');
                        $('.centre').css('background-color','orangered');
                        if($test3.test($('#password').val())){   //必须先要满足  中  条件才能进行这个if    满足  强  条件表示为绿色
                            $('.weak').css('background-color','#f1d0b9');
                            $('.centre').css('background-color','#f1d0b9');
                            $('.strong').css('background-color','green');
                        }else{         //没满足  强  条件   但满足了  中条件   就显示   黄色
                            $('.weak').css('background-color','#f1d0b9');
                            $('.centre').css('background-color','orangered');
                            $('.strong').css('background-color','#f1d0b9');
                        };
                    }else{//没满足  中  条件就依旧显示红色
                        $('.weak').css('background-color','red');
                        $('.centre').css('background-color','#f1d0b9');
                        $('.strong').css('background-color','#f1d0b9');
                    };
                }else{//没满足  弱  条件就依旧显示红色
                    $('.weak').css('background-color','red');
                    $('.centre').css('background-color','#f1d0b9');
                    $('.strong').css('background-color','#f1d0b9');
                }
            })
		})


    </script>

