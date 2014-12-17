<script type="text/javascript">
//var mobileUrl = "http://115.28.104.209/b2b2c/wap";
var WapSiteUrl = "<?php echo WAP_SITE_URL;?>";
var agent_id = <?php echo $agent_info['agent_id'];?>;
var title = "<?php echo $share['wxs_title']?>";
var content = "<?php echo $share['wxs_content']?>";
var img = "<?php echo $share['wxs_picture']?>";
var goods_id = <?php echo $goods_id;?>;
var urlShare = WapSiteUrl+"/index.php?act=wxCap&op=detailCap&agent_id="+agent_id+"&goods_id="+goods_id;
//zhangyating 2014-10-14 特定产品的分享
if(goods_id == 261){
	//alert("250");
	title = "198元7支新玉麟即食海参正在<?php echo $agent_info['member_truename'];?>的小店热销";
	content = "爆款海参就在<?php echo $agent_info['member_truename'];?>的小店！只要198，七日进补不能停！快来抢购吧！";
	img = "<?php echo $agent_info['member_avatar'];?>";
	urlShare = WapSiteUrl+"/index.php?act=transit&op=transit&agent_id="+agent_id+"&goods_id="+goods_id;
}

window.shareData = {
			"imgUrl": img,
			"timeLineLink": urlShare,
			"sendFriendLink": urlShare,
			"weiboLink": urlShare,
			"tTitle": title,
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
		
		if((s=="send_app_msg:ok")||(s=="send_app_msg:confirm")){
			
			$.get(mobileUrl+"/index.php?act=state&op=addState&agent_id="+agent_id+"&page=goods&page_id="+goods_id+"&event=share_message",function(data){
			
				var sjon_data = data.status;
				if(sjon_data){
				//	alert("分享成功！");
				}
			}, 'json')
		}
		
		if((s=="share_timeline:ok")||(s=="share_timeline:confirm")){
			$.get(mobileUrl+"/index.php?act=state&op=addState&agent_id="+agent_id+"&page=goods&page_id="+goods_id+"&event=share_timeline",function(data){
				var sjon_data = data.status;
				if(sjon_data){
					//alert("分享成功！");
				}
			}, 'json')
		}
		
		if((s=="share_weibo:ok")||(s=="share_weibo:confirm")){
			$.get(mobileUrl+"/index.php?act=state&op=addState&agent_id="+agent_id+"&page=goods&page_id="+goods_id+"&event=share_weibo",function(data){
				var sjon_data = data.status;
				if(sjon_data){
					//alert("分享成功！");
				}
			}, 'json')
		}
	}
</script>