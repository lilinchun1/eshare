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
<title>绑定手机</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap   h100p">
    <section class="change-bank-wrap">
        <p></p>
        <p>
            <input class="apply-cash-input change-bank-btn w60p" type="tel" name="" id="phone" placeholder="请输入11位新的手机号码"/>
            <button type="button" class="draw-money-btn change-bank-btn w36p" id="J_smscode">获取验证码</button>
        </p>
        <p>
            <input class="apply-cash-input change-bank-btn" type="tel" name="" id="smscode" placeholder="请输入手机验证码"/>
        </p>
        <button type="button" class="draw-money-btn change-bank-btn-qd disabled" id="J_submit" >确 定</button>
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
	$("#J_submit").on(touchMethod, function(e){
		submit();
	});
	$("#J_smscode").on(touchMethod, function(e){
		if($(this).hasClass("disabled")){
			floatNotify.simple("验证码已发送，请稍后再试");
		}else{
			sendSmsCode();
		}
	});
	$("#phone,#smscode").on('input',function(e) {
		var smscode=$('#smscode').val();
		var phone=$('#phone').val();
		if(smscode && phone){
			$("#J_submit").prop("disabled", false).removeClass("disabled");
		}else{
			$("#J_submit").prop("disabled", true).addClass("disabled");//添加disabled的属性
		}
    });
	$("#J_submit").on(touchMethod, function(e){
		//有disabled直接返回不验证
		if($(this).hasClass("disabled")){
			return;
		}
		var smscode=$('#smscode').val();
		var phone=$('#phone').val();
	    var  error="";
	    if(smscode==""){
	    	error = "验证码不能为空";
	    }
		if(error){
			floatNotify.simple(error);
		}else{
			$.post("index.php?act=personal_center&op=checkSmsTwo", {'smscode':smscode,'mobile':phone}, function(result){
				var data = result.datas;
				if(data.error){
					floatNotify.simple(data.error);
				}else{
				    floatNotify.simple('绑定成功');
			     	setTimeout('window.location.href="index.php?act=personal_center&op=index";', 1000 )
				}
			}, 'json');
		}
  });


});
/**
 *	发送短信验证码
 */
function sendSmsCode(){
    var phone=$('#phone').val();
    var error="";
    var regMobile=/^0?1(3|5|8)\d{9}$/;
    if(phone==""||phone==null){
    	floatNotify.simple("请输入新手机号");
    }else if(!regMobile.test(phone)){
		floatNotify.simple("手机号格式错误");
    }else{
		//防止重发
		$("#J_smscode").prop("disabled", true).addClass("disabled");

      	//发送短信号码
		$.post("?act=personal_center&op=send_smsTwo", {mobile:phone}, function(result){
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
				floatNotify.simple(data.error);
			}
		}, 'json');
    }
}
</script>
</body>
</html>