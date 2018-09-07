
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312" />
<meta name="applicable-device" content="pc">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="Cache-Control" content="no-transform" />
<title>form表单只提交数据而不进行页面跳转的解决方案_jquery_脚本之家</title>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<meta name="keywords" content="form表单,提交数据,页面跳转" />
<meta name="description" content="将数据提交到saveReport（form的action指向）页面，但是页面又不进行跳转，即保持当前页面不变呢？利用jquery的ajaxSubmit函数以及form的onsubmit函数完成" />
<meta http-equiv="mobile-agent" content="format=html5; url=http://m.jb51.net/article/41490.htm" />
<meta http-equiv="mobile-agent" content="format=xhtml; url=http://m.jb51.net/article/41490.htm" />
 
</head>
<body>
<form action="http://127.0.0.1/frontend/web/site/signup" method="post">
  <p>First RouteName: <input type="text" name="RouteName" /></p>
  <p>Last RouteNo: <input type="text" name="RouteNo" /></p>
  <input type="submit" value="Submit" />
</form>
</body>
</html>
<!-- published at 2017/10/11 8:59:56By dxycms qq:461478385  -->