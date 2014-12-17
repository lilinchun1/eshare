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
<title>我的店铺</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>" />
</head>
<body>
<div class="box-wrap wrap-bg">
	<section class="shop-wrap">
		<header class="shop-header" onclick="location.href='<?php echo WAP_SITE_URL;?>/index.php?agent_id=<?php echo $agent_info['agent_id'];?>&shared=1'">
			<div class="pic-wrap">
				<a href=""> <img src="<?php echo getWxImg($agent_info['member_avatar'],"96");?>"
					alt="" />
				</a>
			</div>
			<h2>
				<i><?php echo $agent_info['agent_name'];?></i> <span
					class="level-icon"><img
					src="<?php echo IMG_CDN_URL;?>/v12/img/level/level<?php echo $agent_info['level_id'];?>.png"
					alt="" /></span>
			</h2>
			<h3>
				进入店铺首页 <span> > </span>
			</h3>
		</header>
		<div class="mod-line"></div>
		<ul class="shop-option" id="sign">
			<li
				class="active"
				 data-sign="1" ontouchstart="li(this)">上架时间</li>
			<li
				class=""
				data-sign="2" ontouchstart="li(this)">销量</li>
			<li
				class=""
				data-sign="4" ontouchstart="li(this)">价格</li>
			<li
				class=""
				data-sign="3" ontouchstart="li(this)">供应量</li>

		</ul>
		<div class="mod-line"></div>
		<ul class="indent-item-list shop-list-item" id="ajax">
		</ul>
		<div class="add-more w100p" style="display:none">
  		 查看更多
		 </div>
		<footer class="foot"> 易享科技出品 </footer>
	</section>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript">
var html = "";
var more = 0;
var sign ="1";
var pageCount=1;
//获取sign值
function li(list){
	$(list).addClass("active").siblings().removeClass("active");
	$("#ajax li").hide();
	sign=$(list).data('sign');
	getPageList(1,sign);	
}
//滑动加载更多
$(window).scroll(function () {
	var scrollTop = $(this).scrollTop();
    var scrollHeight = $(document).height();
    var windowHeight = $(this).height();
     if (scrollTop + windowHeight >= scrollHeight && more<=pageCount) {
 	   getPageList(more,sign);
     }
});
//默认首页
$(function(){
	getPageList(1);
});

function getPageList(page,sign){
	var dateFormat = "";
	$(".add-more").hide();
	$.get("?act=agent_index&op=goods_listAjax&sign="+sign+"&curpage="+page, function(result){
		var data = result.datas;
		if(data.status){
			var len = data.goods_list.length;
			for(var i=0;i<len;i++){
				var tj = "";//添加特价
				if(data.goods_list[i]['goods_commend'] == 1){
					tj = '<div class="tj-logo"></div>';
				}
				html += '<li><a href="<?php echo WAP_SITE_URL ?>/index.php?act=product&goods_id='+data.goods_list[i]['goods_id']+'"><div class="shop-list-item-info"><div class="indent-item-pic"><img src="'+data.goods_list[i]['goods_image_url']+'" alt=""/>'+tj+'</div><h3>'+data.goods_list[i]['goods_name']+'</h3><p>价格：<i>￥'+data.goods_list[i]['goods_price']+'</i></p><p>上架时间：<i>'+data.goods_list[i]['goods_addtime']+'</i></p></div></a><div class="shop-list-item-number"><span>销量：'+data.goods_list[i]['volume']+'</span><span>佣金：<i>'+data.lv['sale_rate']+'%</i></span><span> 供应量：'+data.goods_list[i]['goods_storage']+'</span></div></li>'
			}
		}
	$(".indent-item-list").append(html);
	html = "";
	pageCount=data.totalPage;
	more = page+1;
// 	if(page >= data.totalPage || data.totalPage==0){
// 		$(".add-more").hide();
// 		}else{
// 		$(".add-more").show();
// 			}
	}, 'json');
}
</script>
<?php include "share_list.php";?>

<!-- 站长统计功能 -->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>