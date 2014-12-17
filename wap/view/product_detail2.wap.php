<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>Document</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/llc-index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="index-show-wrap">
	<header class="index-show-head">
		<img src="<?php echo $agent_info['member_avatar']?><?php echo STATIC_VER;?>" class="index-show-head-pic" alt=""/>

		<h1><?php echo $agent_info['agent_name']?></h1>
	</header>
	<section class="show-slider">
		<div class="slide" id="slide3">
			<ul>
				<?php foreach($goods_image as $v){?>
				<li>
					<a href="">
						<img src="<?php echo $v;?><?php echo STATIC_VER;?>" alt="">
					</a>
				</li>
				<?php }?>
			</ul>
			<div class="dot">
				<?php foreach($goods_image as $v){?>
				<span></span>
				<?php }?>
			</div>
			<?php if($goods_detail['goods_info']['goods_commend']){?>
			<div class="tejia">特价</div>
			<?php } ?>
		</div>
	</section>
	<section class="product-tt">
		<span></span>

		<h2><?php echo $goods_detail['goods_info']['goods_name']?></h2>
		<div class="product-tt-logo-star">
			<img src="<?php echo IMG_CDN_URL;?>/v12/img/star-k.png<?php echo STATIC_VER;?>" alt=""/>
		</div>
		<!--<img src="<?php echo IMG_CDN_URL;?>/v12/img/star-s.png<?php echo STATIC_VER;?>" alt=""/> 点击后变实心的图片-->
	</section>
	<section class="choose-number">
		<div class="jiage">
			<span class="label-info">现价：</span>
			<em>￥<?php echo $goods_detail['goods_info']['goods_price'];?> </em>
			<i>原价：￥<?php echo $goods_detail['goods_info']['goods_marketprice'];?></i>
		</div>
		<div class="choose-standard">
			<span class="label-info">规格：</span>
			<ul class="choose-standard-list">
				<?php foreach($goods_detail['goods_info']['spec_name'] as $k => $v){?>
				<?php foreach($goods_detail['goods_info']['spec_value'][$k] as $m =>$n){?>
				<li <?php if($goods_detail['goods_info']['goods_spec'][$m]){echo 'class="choose-active"';};?>>
					<b></b>
					<a href="?act=product&goods_id=<?php echo $goods_detail['spec_list'][$m];?>" >
						<?php echo $n?>
					</a>
				</li>
				<?php } ?>
				
				<?php }?>
			</ul>
		</div>
		<div class="choose-number-item">
			<span class="label-info">数量：</span>

			<div class="select-number">
				<span class="left" id="teambuy_num_left">-</span>
				<input class="select-number-input" type="text" name="" id="teambuy_num_input" value="1"
					   oninput="teambuy_num_input(this)"/>
				<span class="right" id="teambuy_num_right">+</span>
			</div>
			<i>剩余：<?php echo $goods_detail['goods_info']['goods_storage'];?>件</i>
		</div>
	</section>
	<section class="enter-shop wrap95">
		<a href="index.php?agent_id=<?php echo $agent_id;?>">
			<svg class="icon-iconfont-iconfontshop">
				<use xlink:href="<?php echo IMG_CDN_URL;?>/v12/img/svg/svgdefs.svg#icon-iconfont-iconfontshop<?php echo STATIC_VER;?>"></use>
			</svg>
			<?php echo $agent_info['agent_name']?>
			<span>进入店铺 <svg class="icon-iconfont-right">
			<use xlink:href="<?php echo IMG_CDN_URL;?>/v12/img/svg/svgdefs.svg#icon-iconfont-right<?php echo STATIC_VER;?>"></use>
		</svg></span>
		</a>
	</section>
	<section class="tab-show">
		<ul class="tab-nav js-tab-header">
			<li class="cur">商品介绍</li>
			<li>参数</li>
		</ul>
		<?php echo $goods_detail['goods_info']['goods_body'];?>
	</section>
	<footer class="footer">
		易享科技出品
	</footer>
</div>
<!--底部导航 开始-->
<div class="mod-foot-nav" id="ftsh">
	<ul class="foot-nav-list show-foot-nav" id="ftsh1">
		<li>
			<a href="#ftsh">
				<div class="foot-nav-icon">
					<img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontsearch.png<?php echo STATIC_VER;?>">
				</div>
				<p class="foot-nav-tt">搜 索</p>
			</a>
		</li>
		<li>
			<a href="<?php echo WAP_SITE_URL;?>/tmpl/ordery_step1.html?goods_id=<?php echo $goods_id;?>&buynum=1">
			<button type="button" class="show-foot-nav-btn disable">立即购买</button>
			</a>
		</li>
		<li>
			<button type="button" class="show-foot-nav-btn color-yellow">加入购物车</button>
		</li>
		<li>
			<a href="">
				<div class="foot-nav-icon">
					<img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontcart.png<?php echo STATIC_VER;?>">
				</div>
				<p class="foot-nav-tt">购物车</p>
			</a>
			<span>12</span>
		</li>
	</ul>
	<div class="search" id="ftsh1">
		<a href="#ftsh1">
			<a href="#ftsh1"><span class="icon-iconfont-left"><img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-left.png<?php echo STATIC_VER;?>"
																   alt=""/></span></a>
		</a>

		<div class="search-input-wrap">
			<input class="search-input" placeholder="搜索您想要的商品" type="text"/>
			<svg class="search-log">
				<use xlink:href="<?php echo IMG_CDN_URL;?>/v12/img/svg/svgdefs.svg#icon-iconfont-iconfontsearch<?php echo STATIC_VER;?>"></use>
			</svg>
		</div>
		<button class="search-btn">搜索</button>
	</div>
</div>
<!--底部导航 结束-->
<!--侧边栏 开始-->
<ul class="aside-item">
	<li>
		<img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontmessage.png<?php echo STATIC_VER;?>" alt=""/>
	</li>
	<li>
		<img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontphone.png<?php echo STATIC_VER;?>" alt=""/>
	</li>
	<li>
		<img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-up.png<?php echo STATIC_VER;?>" alt=""/>
	</li>
</ul>
<!--侧边栏 结束-->
<!--顶部提示框 开始-->
<div class="my-bank-alert" id="J-my-bank-alert">
	<p>无货，或此商品不支持配送</p>

	<div class="close">×</div>
</div>
<!--顶部提示框 结束-->
<script src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>"></script>
<script src="<?php echo IMG_CDN_URL;?>/v12/js/swipeSlide.min.js<?php echo STATIC_VER;?>"></script>
<!--<script src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.tab-min.js<?php echo STATIC_VER;?>"></script>
<script>
	$(function () {
		$(".tab-show").tab({
			touchAnimation: true
		});
	});
</script>-->
<script>
	$(function () {
		$('#slide3').swipeSlide({
			continuousScroll: true,
			speed: 3000,
			transitionType: 'cubic-bezier(0.22, 0.69, 0.72, 0.88)'
		}, function (i) {
			$('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
		});
	});
</script>
</body>
</html>