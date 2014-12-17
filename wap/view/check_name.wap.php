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
    <title>修改店名</title>
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap   h100p">
    <section class="change-bank-wrap">
        <p></p>
        <p>
            <input class="apply-cash-input change-bank-btn" type="text" name="checkname" id="checkname"   placeholder="<?php echo $list['agent_name']; ?>"/>
        </p>
        <p class="revise-shop-ps">以英文字母或汉字开头,限2-8个字。</p>
        <section class="change-bank-attention">
            <p>注意：店铺名称只可以修改一次，审核通过后无法再次修改，请谨慎填写！审核时间为2个工作日。</p>
        </section>


        <button type="button" class="draw-money-btn change-bank-btn-qd " id="J_submit" >确 定</button>
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
		var check_name=$('#checkname').val();
		   var reg=/^[a-zA-Z\u4e00-\u9fa5]+$/;
		   var error="";
		   if(check_name==null||check_name==""){
			   setTimeout('window.location.href="index.php?act=personal_center&op=index";', 1000 );
		   }else if(!reg.test(check_name)){
			   floatNotify.simple("请按要求填写店名");
		   }else if(check_name.length<2 || check_name.length>8){
			   floatNotify.simple("请按要求填写店名");
		   }else{
				$.post("index.php?act=personal_center&op=insert_name", {'check_name':check_name}, function(result){
					var data = result.datas;
					if(data.error){
						floatNotify.simple(data.error);
					}else{
						floatNotify.simple('已提交审核，请等待...');
						setTimeout('window.location.href="index.php?act=personal_center&op=index";', 1000 );
					}
				}, 'json');
			}
    });
});
</script>
</body>
</html>