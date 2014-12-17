<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title></title>
<link rel="stylesheet" href="http://cdn.staticfile.org/normalize/1.0.2/normalize.min.css">
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/2014/7day/css/simple-app.css<?php echo STATIC_VER;?>">
</head>
<body>
<div class="box-wrap">
<div class="slide-btn">
    <div class="slide-btn-con">
        <a class="left-btn" id="J_code" href="<?php echo WAP_SITE_URL;?>/index.php?act=wxCap&op=detailCap&agent_id=<?php echo $_GET['agent_id'];?>&goods_id=<?php echo $_GET['goods_id'];?>&from=<?php echo $_GET['from'];?>">立即购买</a>
        <a class="right-btn" onclick="$('#pop-up').show();">分享好友</a>
    </div>
</div>
<div class="swiper-pages swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="swiper-container scroll-container swiper-gallery">
                <div class="swiper-scrollbar"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo IMG_CDN_URL;?>/2014/7day/img/1-1.jpg" alt=""></div>

                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="swiper-container scroll-container swiper-gallery">
                <div class="swiper-scrollbar"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo IMG_CDN_URL;?>/2014/7day/img/2-1.jpg" alt=""></div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="swiper-container scroll-container swiper-gallery">
                <div class="swiper-scrollbar"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo IMG_CDN_URL;?>/2014/7day/img/3-1.jpg" alt=""></div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="swiper-container scroll-container swiper-gallery">
                <div class="swiper-scrollbar"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo IMG_CDN_URL;?>/2014/7day/img/4-1.jpg" alt=""></div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="swiper-container scroll-container swiper-gallery">
                <div class="swiper-scrollbar"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo IMG_CDN_URL;?>/2014/7day/img/5-1.jpg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div id="pop-up" style="display:none;" onclick="$('#pop-up').hide();">
    <div class="pop"></div>
</div>
<script src="http://cdn.staticfile.org/zepto/1.1.4/zepto.min.js"></script>
<script src="<?php echo IMG_CDN_URL;?>/2014/7day/js/idangerous.swiper-2.0.min.js<?php echo STATIC_VER;?>"></script>
<script>
$(function(){
	setTimeout(function(){
		$(".box-wrap").css("height", document.body.clientHeight);
	}, 2000);
});

var pages = $('.swiper-pages').swiper();
document.body.addEventListener('touchmove', function (event) {
    event.preventDefault();
}, false);
</script>

<script type="text/javascript">
var WapSiteUrl = "<?php echo WAP_SITE_URL;?>";
var agent_id = "<?php echo $agentMesg['member_id'];?>";
var title = "198元7支新玉麟即食海参正在<?php echo $agentMesg['member_truename'];?>的小店热销";
var content = "爆款海参就在<?php echo $agentMesg['member_truename'];?>的小店！只要198，七日进补不能停！快来抢购吧！";
var img = "<?php echo $agentMesg['member_avatar']?>";
var goods_id = "<?php echo $_GET['goods_id'];?>";
var urlShare =  WapSiteUrl+"/index.php?act=transit&op=transit&agent_id="+agent_id+"&goods_id="+goods_id;
window.shareData = {
	"imgUrl": img,
	"timeLineLink": urlShare,
	"sendFriendLink": urlShare,
	"weiboLink": urlShare,
	"tTitle": content,
	"tContent": content,
	"fTitle": title,
	"fContent": content,
	"wContent": content
};

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	// 发送给好友
	WeixinJSBridge.on('menu:share:appmessage', function (argv) {
		WeixinJSBridge.invoke('sendAppMessage', {
			"img_url": window.shareData.imgUrl,
			"img_width": "640",
			"img_height": "640",
			"link": window.shareData.sendFriendLink,
			"desc": window.shareData.fContent,
			"title": window.shareData.fTitle
		}, function (res) {
			_report('send_msg', res.err_msg);
		})
	});

	// 分享到朋友圈
	WeixinJSBridge.on('menu:share:timeline', function (argv) {
		WeixinJSBridge.invoke('shareTimeline', {
			"img_url": window.shareData.imgUrl,
			"img_width": "640",
			"img_height": "640",
			"link": window.shareData.timeLineLink,
			"desc": window.shareData.tContent,
			"title": window.shareData.tTitle
		}, function (res) {
			_report('timeline', res.err_msg);
		});
	});

	// 分享到微博
	WeixinJSBridge.on('menu:share:weibo', function (argv) {
		WeixinJSBridge.invoke('shareWeibo', {
			"content": window.shareData.wContent,
			"url": window.shareData.weiboLink,
		}, function (res) {
			_report('weibo', res.err_msg);
		});
	});
}, false)

function _report(v,s){
	$('#pop-up').hide();
}
</script>
</body>
</html>