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
<title>联系我们</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg">
<div class="hhhh" style="display:none;"></div>
    <section class="contact-us-wrap">
        <div class="contact-us-item">
            <p>提供系统故障等业务咨询</p>
            <p> 微信号：<i class="font-color-blue">xinyulinhs</i></p>
            <p> 提供产品，价格，功效等业务咨询</p>
            <p> 联系电话：<span class="font-yellow">400-050-9988</span></p>
        </div>
        <div class="contact-us-item">
            <h2>在线反馈</h2>
            <textarea name="" class="input-textarea" id="content" cols="30" rows="10" placeholder="用的不爽？吐吐槽吧！"></textarea>
            <input class="apply-cash-input contact-us-input " type="tel" name="" id="phone" placeholder="请留下您的手机号以便我们可以尽快联系您"/>
            <p class="font-color-red">* 请准确输入手机号</p>
            </div>
            <button type="button" class="draw-money-btn contact-us-btn" id="submitBt">确认提交</button>
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
	$("#submitBt").on(touchMethod, function(){
	 	var content = $("#content").val(), phone=$('#phone').val(), regMobile=/^0?1(3|5|8)\d{9}$/;
	 	if(content==""){
	 		floatNotify.simple("请填写您的反馈意见");
	 	}else if(phone==""){
	 		floatNotify.simple("请您留下手机号，方便我们及时联系您");
	 	}else if(!regMobile.test(phone)){
	 		floatNotify.simple("手机号格式错误");
	 	}else{
			$.post("?act=document&op=addFeedback", {'content':content,'phone':phone}, function(data){
				$("#content").val("");
				floatNotify.simple(data.datas.success);
	  		},'json');
		}
	});
});
</script>
<!-- 站长统计功能 -->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>
