<?php if (!@include('../member_config.php')) exit('member_config.php isn\'t exists!');?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>意见反馈</title>
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css" >
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/gl-index.css" >
</head>
<body class="user-bg">
<div class="feedback-box">
    <h4>意见反馈</h4>
    <textarea cols=40 rows=3 name=text id="content" placeholder="有什么想说的，尽管来吐槽吧~" ></textarea>

    <p>* 请准确输入手机号</p>
    <input type="tel" placeholder="请留下您的手机号以便我们可以尽快联系您" placehodler id="phone">

    <p>* 请准确输入手机号</p>
</div>
<input type="button" value="提 交" class="user-b" id="submitBt">
<footer class="footer">
    易享科技出品
</footer>
<!--侧边栏 开始-->
<ul class="aside-item">
    <li>
        <img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontmessage.png" alt=""/>
    </li>
    <li>
        <img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontphone.png" alt=""/>
    </li>
    <li>
        <img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-up.png" alt=""/>
    </li>
</ul>
<!--侧边栏 结束-->
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	$("#submitBt").on(touchMethod, function(){
	 	var content = $("#content").val(), phone=$('#phone').val(), regMobile=/^0?1(3|5|8)\d{9}$/;
	 	if(content==""||content==null){
	 		floatNotify.simple("请填写您的反馈意见");
	 	}else if(content.length>201){
	 		floatNotify.simple("反馈意见仅限200字");
		}else if(phone==""){
	 		floatNotify.simple("请您留下手机号，方便我们及时联系您");
	 	}else if(!regMobile.test(phone)){
	 		floatNotify.simple("手机号格式错误");
	 	}else{
			$.post(WapSiteUrl+"/index.php?act=document&op=addFeedback", {'content':content,'phone':phone,'feedback_type':4}, function(data){
				$("#content").val("");
				floatNotify.simple(data.datas.success);
	  		},'json');
		}
	});
});
</script>
</body>
</html>