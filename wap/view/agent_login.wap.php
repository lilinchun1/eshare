<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>登录</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap h100p">
   <section class="login-wrap">
       <div class="login-xyl-logo">

       </div>
       <input type="text" name="account" class="login-input"  id="account" placeholder="请输入手机号"/>
       <input type="password" name="password" class="login-input2" id="password" placeholder="请输入密码"/>
       <button type="button" class="register-btn" id="J_login">确认登录</button>
       <div class="find-password" style=" float:left;"><a href="http://mp.weixin.qq.com/s?__biz=MzA5Mzg3MTYzNw==&mid=201795890&idx=2&sn=3a5f70291df30531e4321c5a64ac0777#rd"> 我要参加</a></div>
       <div class="find-password"><a href="?act=password_recover&op=find_pwd"> 找回密码</a></div>
       <footer class="foot fixb">
           易享科技出品
       </footer>
   </section>
</div>     
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 通用的分享功能-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 end -->
<script type="text/javascript">
$(function(){
	$("#J_login").click(function(){
		$.post("?act=front&op=agent_dologin",
			{"mobile" : $("#account").val(), "password" : $("#password").val(), "client": "wap"},
			function(result){
				var data = result.datas; //console.log(data);
				if(data.error){
					//alert(data.error);
					floatNotify.simple(data.error,"",2000);
					$("#password").val("");
					delcookie("mb_user_token");
					delcookie("mb_user_agent");
				}else{
					//alert($("#account").val());
					addcookie("mb_user_token", data.key, 99999);
					addcookie("mb_user_agent", data.member_id, 99999);

					location.href="?act=agent";
				}
			}, 'json'
		)
	});
});
</script>
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>
