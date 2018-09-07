<script src="/frontend/web/js/jquery-v2.1.1.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
        	url='<?php  echo Yii::$app->urlManager->createUrl('flight/test1');?>';
            
            $("#btn").click(function(){
            	//alert(url);
                var val1=$("#txt1").val();
                $.ajax({  
	                type: 'POST',
	                url: '/frontend/web/index.php/flight/test1',
	                data: {
                		val1:$("#txt1").val()                
                },
//                 dataType: "json",
                success: function (data) { //返回json结果
                    alert(data);
                },
                error: function (request) { //返回json结果
                	var str = JSON.stringify(request);
                	alert(str);
                    //alert(request);
                },
            });
            });
        });  
</script>
<input id="btn" type="button" value="click" />
<input id="txt1" type="text" value="" />
<input id="txt2" type="text" value="" />
<input id="txt3" type="text" value="" />
<input id="txt4" type="text" value="" />