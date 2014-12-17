<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>商品详情</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/hd1212/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div id="welcome" style="display:none">
    <div id="welcome_close" style="position: absolute; top:55%; right: 45%">
        <a href="javascript:;" style=" width: 100%; height:100%;" onclick="document.getElementById('welcome').style.visibility = 'hidden';">
            <div style=" width:100%; height:100%; position:fixed; top:0px; left:0px;z-index:999999999; background:url(<?php echo IMG_CDN_URL;?>/hd1212/img/1212tan2.png)no-repeat rgba(0,0,0,0.7); background-size:100%;"></div>
        </a>
    </div>
</div>

<svg display="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <symbol id="icon-bq" viewBox="0 0 1024 1024">
            <title>bq</title>
            <path class="path1" d="M592.6 759.3c0 20.4-7.4 38-22.2 52.8s-32.4 22.2-52.8 22.2c-21.1 0-39-7.3-53.6-21.9s-21.9-32.4-21.9-53.6c0-20.4 7.4-38 22.2-52.8s32.4-22.2 52.7-22.2c21.1 0 39 7.3 53.6 21.9 14.7 14.7 22 32.5 22 53.6zM782.1 17.9l-0.5 738.3-250.7 250.6c-3.5 3.5-7.9 5.3-13.2 5.3s-9.7-1.8-13.2-5.3l-250.1-250.1v-738.8h527.7zM570.5 812.1c14.8-14.8 22.2-32.4 22.2-52.8 0-21.1-7.3-39-21.9-53.6s-32.4-21.9-53.6-21.9c-20.4 0-38 7.4-52.7 22.2-14.8 14.8-22.2 32.4-22.2 52.8 0 21.2 7.3 39 21.9 53.6s32.4 21.9 53.6 21.9c20.3 0 37.9-7.4 52.7-22.2z"></path>
        </symbol>
        <symbol id="icon-iconfont-iconfontshop" viewBox="0 0 1024 1024">
            <title>iconfont-iconfontshop</title>
            <path class="path1" d="M952.832 364.768c-0.064-0.48-0.16-0.928-0.256-1.312-0.384-1.856-0.896-3.648-1.632-5.376l-75.008-186.72c-12.992-38.72-50.304-62.464-93.952-62.56h-526.496c-44.224 0-78.592 23.52-91.040 60.704l-80.64 190.528c-0.384 1.12-0.8 2.784-1.152 4.48-5.856 17.984-8.8 36.448-8.8 54.976 0.064 65.152 35.808 124.64 93.248 155.264 0 0 0 0.032 0.032 0.032s0.032 0 0.032 0.032v0c0 0 0.032 0 0.032 0.032 23.648 12.608 51.456 19.008 82.784 19.008 52.512-0.16 101.152-23.232 134.304-62.72 32.992 39.168 81.248 62.080 133.664 62.4 52-0.416 100.128-23.424 132.96-62.56 33.152 39.488 81.856 62.464 134.624 62.464 31.936-0.16 60.288-6.88 84.16-19.968 56.576-30.912 91.68-90.176 91.648-154.656 0.096-18.528-2.944-37.12-8.512-54.048zM839.072 517.312c-14.496 7.936-32.576 12-53.6 12.128-38.976 0-74.496-19.776-95.232-53.344-1.472-3.168-3.936-8.416-8.544-13.472-5.28-5.92-14.88-12.928-30.688-12.928-12.736 0-24.288 5.216-30.816 13.216-4.32 4.864-6.688 9.696-8.384 13.216-20.48 33.152-55.712 53.12-93.888 53.408-38.656-0.224-73.984-20.128-94.592-53.536-1.44-2.944-3.84-7.904-7.584-12.096-15.040-17.952-48.704-17.024-61.824-1.376-4.832 5.28-7.36 10.592-8.992 14.208-20.672 33.152-56.224 53.024-95.008 53.152-20.672 0-38.368-3.872-52.64-11.488 0 0-0.032 0-0.032 0s0 0-0.032 0c-36.608-19.488-59.36-57.376-59.392-98.848 0-12.256 2.048-24.608 6.144-36.64 0.288-0.864 0.544-1.824 0.768-2.816l79.424-187.776c1.632-4.8 6.56-19.424 31.264-19.424h526.656c10.144 0.608 27.616 2.4 33.824 20.672l74.368 185.184c0.288 1.344 0.64 2.624 0.96 3.68 4.128 12.064 6.176 24.32 6.176 36.48 0.064 40.992-22.304 78.688-58.336 98.4zM863.072 620c-17.696 0-32 14.304-32 32l0.064 174.592c0 9.92-8.096 17.984-17.984 18.016l-602.080 0.384c-9.92 0-17.984-8-17.984-17.856l-0.224-171.584c-0.032-17.664-14.368-31.936-32-31.936 0 0-0.032 0-0.064 0-17.664 0.032-31.968 14.368-31.936 32.064l0.224 171.488c0 45.12 36.768 81.824 81.984 81.824l602.176-0.384c45.152-0.096 81.888-36.896 81.888-82.048l-0.064-174.56c0-17.696-14.336-32-32-32zM768 396h-512c-17.664 0-32-14.336-32-32s14.336-32 32-32h512c17.696 0 32 14.336 32 32s-14.304 32-32 32z"></path>
        </symbol>
        <symbol id="icon-iconfont-right" viewBox="0 0 1024 1024">
            <title>iconfont-right</title>
            <path class="path1" d="M347.123 898.088l364.061-367.142c9.489-9.558 9.489-25.055 0-34.613l-364.061-367.142c-9.491-9.558-24.841-9.558-34.334 0-9.455 9.557-9.455 25.041 0 34.613l346.914 349.843-346.914 349.824c-9.455 9.575-9.455 25.059 0 34.616 4.73 4.777 10.958 7.176 17.183 7.176 6.194 0 12.388-2.4 17.151-7.176z"></path>
        </symbol>
    </defs>
</svg>
<div class="body-wrap" id="D_mobile">
    <header class="header">
        <div class="countdown">
            <div class="countdown-tt">
                <h2>距离活动结束还有</h2>
            </div>
			<div class="countdown-hui" style="display:none">
                <h2></h2>
            </div>
            <div class="countdown-con">
                <ul class="clock" id="colockbox1">
                    <li class="date day">00</li>
                    <li class="date-wz">天</li>
                    <li class="date hour">00</li>
                    <li class="date-wz">小时</li>
                    <li class="date minute">00</li>
                    <li class="date-wz">分钟</li>
                    <li class="date second">00</li>
                    <li class="date-wz">秒</li>
                </ul>
            </div>
			<input type="hidden" value="<?php echo $surplusTime;?>" id="surplusTime"/>
        </div>
        <div class="head-pic">
            <img src="<?php echo IMG_CDN_URL;?>/hd1212/img/hd-bg.jpg" alt=""/>
        </div>
    </header>
    <section class="slider" style="height: auto">
        <h2 class="slider-tt"><em>［团购］</em><?php echo $goods_detail['goods_info']['goods_name']?></h2>
        <div class="imgbox">
            <ul>
	  			<?php
				foreach($goods_image as $v){?>
				<li>
					<img src="<?php echo $v;?>"/>
				</li>
				<?php }?>
            </ul>
            <div class="slider-info">
                <em>已售：<?php echo $volume;?>件</em>
                <i>发票</i>
                <span><img src="<?php echo IMG_CDN_URL;?>/hd1212/img/iconfont-hxright.png" alt=""/></span>
                <i>正品</i>
                <span><img src="<?php echo IMG_CDN_URL;?>/hd1212/img/iconfont-hxright.png" alt=""/></span>
                <i>包邮</i>
                <span><img src="<?php echo IMG_CDN_URL;?>/hd1212/img/iconfont-hxright.png" alt=""/></span>
            </div>
        </div>
    </section>
    <section class="price">
        <ul class="price-class">
            <li>
                <p>原价</p>
                <p class="c333">￥<?php echo $goods_detail['goods_info']['goods_marketprice'];?></p>
            </li>
            <li>
                <p>当前价</p>
                <p class="cf57520">￥<?php echo $discountArr['discountPrice'];?></p>
            </li>
            <li>
                <p>极限价</p>
                <p class="cred">￥<?php echo $goods_detail['goods_info']['goods_price'];?></p>
            </li>
        </ul>
        <ul class="level">
            <li class="level-left">
                原价
            </li>
            <li class="">
                <svg class="icon-bq"><use xlink:href="#icon-bq"></use></svg>
                <span>
                    9折
                </span>
            </li>
            <li>
                <svg class="icon-bq"><use xlink:href="#icon-bq"></use></svg>
                 <span>
                    8折
                </span>
            </li>
            <li>
                <svg class="icon-bq"><use xlink:href="#icon-bq"></use></svg>
                 <span>
                    7折
                </span>
            </li>
            <li>
                <svg class="icon-bq"><use xlink:href="#icon-bq"></use></svg>
                 <span>
                    6折
                </span>
            </li>
            <li>
                <svg class="icon-bq"><use xlink:href="#icon-bq"></use></svg>
                 <span>
                    5折
                </span>
            </li>
            <li class="level-right">
                极限价
            </li>
        </ul>
        <ul class="progress">
            <li></li>
        </ul>
        <div class="level-info">
            已有<?php echo $volume;?>人参团，
			<span class="last">
			距 <em>
			<?php echo $discountArr['discount']-1 == 4?'极限价':($discountArr['discount']-1).'折';?>
			</em> 
			
			还差<?php echo $discountArr['dPersonNum'];?>人
			</span>
        </div>
		<input type="hidden" value="<?php echo $discountArr['contrast'];?>" class="discount_avg"/>
		<input type="hidden" value="<?php echo $discountArr['discount']-1;?>" class="discount"/>
    </section>
    <section class="statistics">
        <div class="statistics-number">
            <span class="statistics-number-left">数量：</span>
            <div class="select-number">
                <span class="left" id="teambuy_num_left">-</span>
                <input class="select-number-input buy-num" type="text" name="" id="teambuy_num_input"  value="1" oninput="teambuy_num_input(this)" readonly="true"/>
                <span class="right" id="teambuy_num_right">+</span>
            </div>
            <span class="statistics-number-right">供应量：<span id="stock_num"><?php echo $goods_detail['goods_info']['goods_storage'];?></span>件</span>
        </div>
        <p>
            <input type="checkbox" name="" id="clause_check"  checked="checked" /><label>
			<a href="javascript:void(0);" class="font-yellow" id="J_openterm">《团购条款》已阅读，同意</a></label>
        </p>
    </section>
    <section class="enter-shop">
        <a href="index.php?agent_id=<?php echo $agent_id;?>">
            <svg class="icon-iconfont-iconfontshop"><use xlink:href="#icon-iconfont-iconfontshop"></use></svg><?php echo $agent_info['agent_name'];?> <span>进入店铺 <svg class="icon-iconfont-right"><use xlink:href="#icon-iconfont-right"></use></svg></span>
        </a>
    </section>
    <section class="introduce">
        <h2>商品介绍</h2>
        <p>
            <?php echo $goods_detail['goods_info']['goods_body'];?>
        </p>
    </section>
    <footer class="footer">
        易享科技出品
    </footer>
    <div class="pay">
        <span>定 金 :</span><em>￥<?php echo $goods_detail['goods_info']['goods_price'];?></em>
        <button class="pay-btn" value="true">支付定金</button>
    </div>
    <ul class="aside-item">
        <li onclick="$('#welcome').attr('style','display:block');">

        </li>
        <li>

        </li>
    </ul>
</div>
<!--条款开始-->
<div class="register-item" id="D_term" style="display:none; padding:0 15px 0 15px">
<h2>团购条款</h2>
1.在团购中没有以极限价成交的用户可申请退款；如最终以极限价成交，订金支付成功视为购买成功，不可退款。<br>

2.本活动最终解释权归新玉麟所有。<br>
<p>
	<button type="button" class="register-btn" id="J_closeterm">确定</button>
</p>
</div>
<!--条款结束-->
</body>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>"></script>

<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>

<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>">"></script>

<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!--倒计时-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/hd1212/js/countdown.js<?php echo STATIC_VER;?>"></script>
<!--轮播图js-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/hd1212/js/zepto_mggscrollimg.js<?php echo STATIC_VER;?>"></script>
<!--数量-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/hd1212/js/teambuy_num.js<?php echo STATIC_VER;?>"></script>
<!--折扣-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/hd1212/js/discount.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="js/config.js<?php echo STATIC_VER;?>"></script>





<script>

//分享begin
var mobileUrl = WapSiteUrl+"/index.php?act=wxCap&op=detailCap&agent_id="+<?php echo $agent_id;?>+"&goods_id="+<?php echo $goods_id;?>;
var agent_id = <?php echo $agent_id;?>;
var title = "新玉麟海参购物节团购进行时！";
var Tcontent = "<?php echo $friendsCircle;?>";//朋友圈
var Fcontent = "<?php echo $friends;?>";//好友
var img = "<?php echo WAP_SITE_URL;?>/images/sharep.jpg";
	window.shareData = {
			"imgUrl": img,
			"timeLineLink": mobileUrl,
			"sendFriendLink": mobileUrl,
			"weiboLink": mobileUrl,
			"tTitle": title,
			"tContent": Tcontent,
			"fTitle": title,
			"fContent": Fcontent,
			"wContent": Fcontent
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
				"desc": "",
				"title": window.shareData.tContent
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
//分享end


	var goods_id = <?php echo $goods_id;?>;
    $(function(){
        var scrollImg = $.mggScrollImg('.imgbox ul',{
            loop : true,//循环切换
            auto : true,//自动切换
            auto_wait_time:3000000,//时间
            callback : function(ind){//这里传过来的是索引值
                $('#page').text(ind+1);
            }
        });
        //自适应宽度
		$(".imgbox ul li").css('width', $(".imgbox").css("width"));

		$("#clause_check").change(function(){
			$(this).attr("checked","");
			var check=$(this).attr("checked");
			var time=$("#surplusTime").val();
			if(check==true&&time!="-1"){
				$(".pay-btn").attr("style","background:#e02d2a");
				$(".pay-btn").attr("value","true");
			}else{
				$(".pay-btn").attr("style","background:#cccccc");
				$(".pay-btn").attr("value","clause_false");
			}
		});

		$(".aside-item").css("top",window.screen.availHeight/2-100+"px");
		$(window).scroll(function() {		
			if($(window).scrollTop() >= 500){
				$('.aside-item').fadeIn(300); 
			}else{    
				$('.aside-item').fadeOut(300);    
			}  
		});
		$('.aside-item li').eq(1).click(function(){
			$("html,body").scrollTop(0);
		});

})
function button_color_fun(){
	var button_color=$(".pay-btn").val();
	return button_color;
}
</script>
</html>