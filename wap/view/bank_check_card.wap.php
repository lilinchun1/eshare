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
<title>我的银行卡</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg h100p">

    <section class="change-bank-wrap">
        <h2>请填写银行卡，用来收取佣金</h2>
        <?php if($agent_info['bankcard_name']==''&&$agent_info['member_truename']==''){
	    	$bankcard_name='';
		 }else if($agent_info['member_truename']!=''&&$agent_info['bankcard_name']==''){
		    $bankcard_name=$agent_info['member_truename'];
		 }else{
		    $bankcard_name=$agent_info['bankcard_name'];
		    $bankcard_number=$agent_info['bankcard_number'];
		 }?>
        <p>
        <div class="select-wrap" >
            <select class="select-draw-con" id="cardType">
                <option value="">请选择银行</option>
                <?php if(is_array($data)){ ?>
                <?php foreach($data as $k => $v){ ?>
                <option <?php if($agent_info['bankcard_type'] == $v['bank_id']){ ?>selected="selected"<?php } ?> value="<?php echo $v['bank_id']; ?>"><?php echo $v['bank_name']; ?></option>
               <?php } ?>
               <?php } ?>
            </select>
            <div class="logo">
                <span></span>
            </div>
        </div>
    </p>
        <p>
            <input class="apply-cash-input change-bank-btn" type="tel" value="<?php echo $bankcard_number;?>" name="cardNumber" id="cardNumber" maxlength="19" placeholder="请输入储蓄卡号"/>
        </p>
        <p>
            <input class="apply-cash-input change-bank-btn" type="tel" name="cardNumber2" id="cardNumber2" maxlength="19" placeholder="请重复输入一遍卡号"/>
        </p>
        <p>
            <input class="apply-cash-input change-bank-btn" type="text" name="" id="cardName" value="<?php echo $bankcard_name;?>" placeholder="请填写开户人姓名"/>
        </p>
        <p>
            <input class="apply-cash-input change-bank-btn w60p" type="tel" name="smscode" id="smscode" />
            <button type="button" class="draw-money-btn change-bank-btn w36p" id="J_smscode">获取验证码</button>
        </p>
        <section class="change-bank-attention">
            <p>注意：</p>
            <p>1、目前绑定银行账户仅支持储蓄卡，请不要绑定信用卡。</p>
            <p>2、填写的开户人姓名必须与实际银行卡开户人相符、开户银行、卡号必须准确无误，否则无法提现。</p>
            <p>3、验证码发送到您的手机<?php echo $agent_info['member_mobile']?>，请注意查收。</p>
        </section>
        <button type="button" class="draw-money-btn change-bank-btn-qd" id="J_submit" >确定</button>
        <footer class="foot">
            易享科技出品
        </footer>
    </section>
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

	/**
	 *	校验提交表单
	 */
	$("#J_submit").on(touchMethod, function(e){
		var cardType=$('#cardType').val();
		var cardName=$('#cardName').val();
		var cardNumber=$('#cardNumber').val();
		var cardNumber2=$('#cardNumber2').val();
		var phone="<?php echo $agent_info['member_mobile']?>";
		var smscode=$('#smscode').val();

		var reg=/^[0-9]{15,19}$/;//15~19位银行卡
	    var error="";

	    if(cardType==""||cardType==null){
	        error="请选择银行卡类型";
	    }else if(!reg.test(cardNumber)){
	    	error="银行卡格式不正确";
	    }else if(cardName==""||cardName=="请填写真实姓名"){
	        error="用户名不为空";
	    }else if(cardNumber==""||cardNumber=="请输入储蓄卡号"){
	        error="银行卡号不能为空";
	    }else if(cardNumber!=cardNumber2){
	    	error = "两次银行卡号不相同";
	    }else if(smscode==""){
	    	error = "验证码不能为空";
	    }else{
	        error ="";
	    }
		if(error){
			floatNotify.simple(error);
		}else{
			$.post("index.php?act=check_card&op=checkSms", {'smscode':smscode,'cardNumber':cardNumber,'mobile':phone,'cardName':cardName,'cardType':cardType}, function(result){
				var data = result.datas;
				if(data.error){
					floatNotify.simple(data.error);
				}else{
				    floatNotify.simple('绑定成功');
			     	setTimeout('window.location.href="index.php?act=agent_income&op=income";', 1000)
				}
			}, 'json');
		}
	});
});
/**
 *	发送短信验证码
 */
function sendSmsCode(){
    var phone="<?php echo $agent_info['member_mobile']?>";

	//防止重发
	$("#J_smscode").prop("disabled", true).addClass("disabled");

    //发送短信号码
	$.post("?act=check_card&op=send_sms", {mobile:phone}, function(result){
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



</script>
<!-- 站长统计功能 -->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>