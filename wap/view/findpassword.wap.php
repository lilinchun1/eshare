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
<title>找回密码</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap h100p">
    <section class="change-bank-wrap">
         <input name="nchash" type="hidden" id="nchash" value="<?php echo $nchash;?>" />
        <p></p>
        <p>
            <input class="apply-cash-input change-bank-btn" type="tel" id="phone" placeholder="请填写手机号"/>
        </p>
        <p>
            <input class="apply-cash-input change-bank-btn w60p" type="text" id="captcha" placeholder="请输入验证码"/>
            <!-- 验证码 -->
           <button type="button" class="draw-money-btn3 change-bank-btn w36p" id="codebtn">
           <img src="index.php?act=seccode&op=makecode&admin=1&nchash=<?php echo getNchash();?>" id="codeimage" border="0"/>
           </button>
           <!-- 验证码 -->
        </p>
        <button type="button" class="draw-money-btn change-bank-btn-qd disabled" id="J_submit" >下一步</button>
    </section>
    <footer class="foot">
        易享科技出品
    </footer>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript">
function codeimage(){
	$("#codeimage").attr("src", "index.php?act=seccode&op=makecode&admin=1&nchash=<?php echo getNchash();?>&t=" + Math.random());
}

$(function(){
 $("#phone,#captcha").on('input',function(e) {
	var captcha=$('#captcha').val();
	var nchash=$('#nchash').val();
	var member_mobile=$('#phone').val();
	if(member_mobile && captcha){
		$("#J_submit").prop("disabled", false).removeClass("disabled");
	}else{
		$("#J_submit").prop("disabled", true).addClass("disabled");
	}
 });

 $("#codebtn").on(touchMethod, function(e){
	codeimage();
 });

 $("#J_submit").on(touchMethod, function(e){
	 if($(this).hasClass("disabled")){
		return;
	 }

	 var captcha=$('#captcha').val();
	 var nchash=$('#nchash').val();
	 var member_mobile=$('#phone').val();
	 $.post("index.php?act=password_recover&op=check_code", {'member_mobile':member_mobile,'nchash':nchash,'captcha':captcha}, function(result){
		var data = result.datas;
		if(data.error){
			floatNotify.simple(data.error);
			codeimage();
		}else{
			window.location.href="index.php?act=password_recover&op=check_phones&member_mobile="+data.member_mobile;
		}
	}, 'json');
  });
});
</script>
</body>
</html>