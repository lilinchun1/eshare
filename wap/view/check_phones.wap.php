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
<title>安全验证</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap h100p">
    <section class="change-bank-wrap">
        <p></p>
        <p>
            <input class="apply-cash-input change-bank-btn w60p" type="text" readonly disabled value="<?php echo substr($member_mobile,0,3);?>****<?php echo substr($member_mobile,7);?>"/>
            <button type="button" class="draw-money-btn change-bank-btn w36p" id="J_smscode">获取验证码</button>
        </p>
        <p>
            <input class="apply-cash-input change-bank-btn" type="tel" id="smscode" placeholder="请输入手机验证码"/>
        </p>
        <button type="button" class="draw-money-btn change-bank-btn-qd disabled" id="J_submit" >验 证</button>
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
$(function(){

 	$("#J_smscode").on(touchMethod, function(e){
		if($(this).hasClass("disabled")){
 			floatNotify.simple("验证码已发送，请稍后再试");
 		}else{
 			sendSmsCode();
 		}
 	});

	$("#smscode").on('input',function(e) {
 		var smscode=$('#smscode').val();
		var phone="<?php echo $person['member_mobile']?>";
 		if(smscode){
 			$("#J_submit").prop("disabled", false).removeClass("disabled");
 		}else{
 			$("#J_submit").prop("disabled", true).addClass("disabled");//添加disabled的属性
 		}
    });

	/**
	 *	校验提交表单
	 */
	$("#J_submit").on(touchMethod, function(e){
		//有disabled直接返回不验证
		if($(this).hasClass("disabled")){
			return;
		}

		var smscode=$('#smscode').val();
		var phone="<?php echo $member_mobile?>";

		$.post("index.php?act=password_recover&op=checkSms", {'smscode':smscode,'mobile':phone}, function(result){
				var data = result.datas;
				if(data.error){
					floatNotify.simple(data.error);
				}else{
				    floatNotify.simple('修改成功');
			     	setTimeout('window.location.href="index.php?act=password_recover&op=check_pwds&member_mobile=<?php echo $_REQUEST['member_mobile']?>";', 1000 )
				}
			}, 'json');
		});
	});
 /**
  *	发送短信验证码
  */
 function sendSmsCode(){
    var phone="<?php echo $member_mobile?>";
    var  error="";
    var regMobile=/^0?1(3|5|8)\d{9}$/;
    if(!regMobile.test(phone)){
		floatNotify.simple("手机号格式错误");
    }
    if(smscode==""){
    	error = "验证码不能为空";
    }
	if(error){
		floatNotify.simple(error);
	}else{
		//防止重发
		$("#J_smscode").prop("disabled", true).addClass("disabled");

       //发送短信号码
	 	$.post("?act=password_recover&op=send_sms", {mobile:phone}, function(result){
	 		var data = result.datas;
	 		if(data.status){ //发送成功
	 			floatNotify.simple("发送成功请查收");
	 			$("#J_smscode").prop("disabled", true).addClass("disabled");

	 			var seed  = 60, timer = setInterval(function(){
					seed --;
	 				$("#J_smscode").html(seed + "秒后重发");
					if(seed<=0){
	 					$("#J_smscode").prop("disabled", false).removeClass("disabled").html("重获验证码");
						clearInterval(timer);
	 				}
	 			}, 1000);
	 		}else{
	 			$("#J_smscode").prop("disabled", false).removeClass("disabled");
				floatNotify.simple("发送失败请重试");
			}
		}, 'json');
    }
 }
</script>
</body>
</html>