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
<title>修改密码</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap   h100p">
  <section class="change-bank-wrap">
    <p></p>
    <p><input class="apply-cash-input change-bank-btn" type="password" name="password" id="password" placeholder="请填写当前密码" /></p>
    <p><input class="apply-cash-input change-bank-btn" type="password" name="pwd1" id="pwd1" placeholder="请设置6-16位新密码" /></p>
    <p><input class="apply-cash-input change-bank-btn" type="password" name="pwd2" id="pwd2" placeholder="请重新输入一遍新密码" /></p>
    <button type="button" class="draw-money-btn change-bank-btn-qd disabled" id="J_submit">确 定</button>
  </section>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	$("#password,#pwd1,#pwd2").on('input',function(e) {
        var pwd=$("#password").val(),pwd1=$("#pwd1").val(),pwd2=$("#pwd2").val();
		if(pwd && pwd1 && pwd2){
			$("#J_submit").prop("disabled", false).removeClass("disabled");
		}else{
			$("#J_submit").prop("disabled", true).addClass("disabled");
		}
    });

	$("#J_submit").on(touchMethod, function(e){
		if($(this).hasClass("disabled")){
			return;
		}

		var newpwd=$("#password").val(),pwd1=$("#pwd1").val(),pwd2=$("#pwd2").val();
		if(pwd1.length<6 || pwd1.length>16){
			floatNotify.simple("新密码长度不在6~16位之间");
		}else if(pwd1!=pwd2){
			floatNotify.simple("新密码两次填写不一致");
		}else{
			$.post("index.php?act=personal_center&op=updatePwd", {'password':newpwd,'pwd1':pwd1,'pwd2':pwd2}, function(result){
				var data = result.datas;
				if(data.error){
					floatNotify.simple(data.error);
				}else{
				  floatNotify.simple("密码修改成功");
				  setTimeout('window.location.href="index.php?act=personal_center&op=index";', 1000);
				}
			}, 'json');
		}
	});
})
</script>
</body>
</html>