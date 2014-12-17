	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		window.shareData = {
			"imgUrl": "http://o2o.exweixin.com/weka/wap/images/sharep.jpg",
			"timeLineLink": "http://mp.weixin.qq.com/s?__biz=MzA5Mzg3MTYzNw==&mid=200945758&idx=1&sn=d5dfaf5b91a5a9278897d48c47869bed#rd",
			"sendFriendLink": "http://mp.weixin.qq.com/s?__biz=MzA5Mzg3MTYzNw==&mid=200945758&idx=1&sn=d5dfaf5b91a5a9278897d48c47869bed#rd",
			"weiboLink": "http://mp.weixin.qq.com/s?__biz=MzA5Mzg3MTYzNw==&mid=200945758&idx=1&sn=d5dfaf5b91a5a9278897d48c47869bed#rd",
			"tTitle": "分享创造价值，动动手指就能赚钱！加入新玉麟金手指计划，成就你的辉煌梦想！",
			"tContent": "新玉麟海参微电商平台创业加盟，2014年10月正式启幕。",
			"fTitle": "分享创造价值，动动手指就能赚钱！加入新玉麟金手指计划，成就你的辉煌梦想！",
			"fContent": "新玉麟海参微电商平台创业加盟，2014年10月正式启幕。",
			"wContent": "新玉麟海参微电商平台创业加盟，2014年10月正式启幕。"
		};
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
	}, false);