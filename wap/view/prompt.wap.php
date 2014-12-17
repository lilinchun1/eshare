<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>系统提示</title>
<link href="css/style-b.css" rel="stylesheet" type="text/css">
<style>
.prompt_box{ background:#fff; margin:10px;border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px; -ms-border-radius:10px; -o-border-radius:10px; padding:10px; overflow:hidden; display:block;}
.prompt_box h3{ color:#f16d00; text-align:center; line-height:280%; font-size:22px;margin:0; padding:0;}
.prompt_box h4{ margin:0; padding:0 30px; line-height:240%;}
.prompt_box p{ line-height:180%;padding:0 30px;}
.prompt_boxbut{ background:#f16d00; border-radius:8px; -webkit-border-radius:8px; -moz-border-radius:8px; -ms-border-radius:8px; -o-border-radius:8px; width:44%; margin:0 3%; line-height:40px; color:#fff; float:left; border:0; font-size:16px;text-shadow:1px 1px 1px #898989; margin-top:15px;}
</style>

</head>
<body>

<div class="prompt_box">
<h3>系统提示</h3>
<h4>抱歉亲...网页禁止访问 ！</h4>
<p>可能的原因：</p>

<?php 
if($_GET['err_msg']){
	echo "<p>".htmlspecialchars($_GET['err_msg'])."</p>";
}else{
	echo "<p>非法操作</p>";
}?>

  <a href='../index.php?act=wxCap&op=index'><input type="button" class="prompt_boxbut " value="申请开店" /></a><a href="../tmpl/member/member.html?act=member"><input type="button" class="prompt_boxbut " value="用户中心" /></a>
</div>
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>
