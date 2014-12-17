<script type="text/javascript">
//var mobileUrl = "http://115.28.104.209/b2b2c/wap";
var mobileUrl = "<?php echo WAP_SITE_URL;?>";
var agent_id = <?php echo $agent_info['agent_id'];?>;
var title = "<?php echo $share['wxs_title']?>";
var content = "<?php echo $share['wxs_content']?>";
var img = "<?php echo $share['wxs_picture']?>";
	window.shareData = {
			"imgUrl": img,
			"timeLineLink": mobileUrl+"/index.php?act=wxCap&op=listCap&agent_id="+agent_id,
			"sendFriendLink": mobileUrl+"/index.php?act=wxCap&op=listCap&agent_id="+agent_id,
			"weiboLink": mobileUrl+"/index.php?act=wxCap&op=listCap&agent_id="+agent_id,
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
			
			$.get(mobileUrl+"/index.php?act=state&op=addState&agent_id="+agent_id+"&page=list&page_id=1&event=share_message",function(data){
			
				var sjon_data = data.status;
				if(sjon_data){
					//alert("分享成功！");
				}
			}, 'json')
		}
		
		if((s=="share_timeline:ok")||(s=="share_timeline:confirm")){
			$.get(mobileUrl+"/index.php?act=state&op=addState&agent_id="+agent_id+"&page=list&page_id=1&event=share_timeline",function(data){
				var sjon_data = data.status;
				if(sjon_data){
					//alert("分享成功！");
				}
			}, 'json')
		}
		
		if((s=="share_weibo:ok")||(s=="share_weibo:confirm")){
			$.get(mobileUrl+"/index.php?act=state&op=addState&agent_id="+agent_id+"&page=list&page_id=1&event=share_weibo",function(data){
				var sjon_data = data.status;
				if(sjon_data){
					//alert("分享成功！");
				}
			}, 'json')
		}
	}
</script>