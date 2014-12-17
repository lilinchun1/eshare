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
<div class="index-wrap">
	<header class="wd-shop-head">
		<img class="wd-shop-head-img" src="<?php echo $agent_info['member_avatar']?><?php echo STATIC_VER;?>" alt=""/>

		<h1><?php echo $agent_info['agent_name'];?></h1>
		<i>访客：352</i>
		<?php
		if($is_favorites){
		?>
		<div class="logo-star logo-star-off" ontouchstart="collect('agent',<?php echo $_SESSION['agent_id'];?>,0)" style="display:none">
			<img src="<?php echo IMG_CDN_URL;?>/v12/img/star-k.png<?php echo STATIC_VER;?>" alt=""/>
		</div>
		<div class="logo-star logo-star-on" ontouchstart="collect('agent',<?php echo $_SESSION['agent_id'];?>,1)">
			<img src="<?php echo IMG_CDN_URL;?>/v12/img/star-s.png<?php echo STATIC_VER;?>" alt=""/>
		</div>
		<?php
		}else{
		?>
		<div class="logo-star logo-star-off" ontouchstart="collect('agent',<?php echo $_SESSION['agent_id'];?>,0)">
			<img src="<?php echo IMG_CDN_URL;?>/v12/img/star-k.png<?php echo STATIC_VER;?>" alt=""/>
		</div>
		<div class="logo-star logo-star-on" ontouchstart="collect('agent',<?php echo $_SESSION['agent_id'];?>,1)" style="display:none">
			<img src="<?php echo IMG_CDN_URL;?>/v12/img/star-s.png<?php echo STATIC_VER;?>" alt=""/>
		</div>
		<?php
		}
		?>
		
		
	</header>
	<ul class="shop-lab">
		<li>
			<span><img src="<?php echo IMG_CDN_URL;?>/v12/img/you.png<?php echo STATIC_VER;?>" alt=""/></span>
			<i>正品保优</i>
		</li>
		<li>
			<span><img src="<?php echo IMG_CDN_URL;?>/v12/img/piao.png<?php echo STATIC_VER;?>" alt=""/></span>
			<i>正规发票</i>
		</li>
		<li>
			<span><img src="<?php echo IMG_CDN_URL;?>/v12/img/shan.png<?php echo STATIC_VER;?>" alt=""/></span>
			<i>闪电发货</i>
		</li>
		<li>
			<span><img src="<?php echo IMG_CDN_URL;?>/v12/img/kuai.png<?php echo STATIC_VER;?>" alt=""/></span>
			<i>快捷售后</i>
		</li>
	</ul>
	
	
	
	
	<section class="shop-item-wrap">
		<?php foreach($goods_list as $k => $v){?>
		<div class="shop-item">
			<div class="shop-item-pic">
				<a  href="index.php?act=product&goods_id=<?php echo $v['goods_id'];?>&agent_id=<?php echo $agent_id;?>">
					<img src="<?php echo $v['goods_image_url'];?>" alt=""/>
				</a>
				<?php if($v['goods_commend']){?>
				<span class="tj-logo">特价</span>
				<?php } ?>
			</div>
			<h2 class="shop-item-tt">
				<span></span>
				<?php echo $v['goods_name'];?>
			</h2>

			<div class="shop-item-buy">
				<em><span>￥</span><?php echo $v['goods_price'];?></em> <i>原价：￥<?php echo $v['goods_marketprice'];?></i>
				<a href="<?php echo WAP_SITE_URL;?>/tmpl/order/buy_step1.html?goods_id=<?php echo $v['goods_id'];?>&buynum=1"><button class="shop-item-btn">立即购买</button></a>
			</div>
		</div>
		<?php }?>
		<button class="check-more-btn">
			查看更多
			<input type="text" class="ajax_url" value="index.php?op=ajGetPageGoods&agent_id=<?php echo $_SESSION['agent_id'];?>&shared=<?php echo $_GET['shared'];?>"/>
		</button>
	</section>
	
	
	
	
	
	<div class="add-more">
		正在加载...
	</div>
	<footer class="footer">
		易享科技出品
	</footer>

</div>
<!--底部导航 开始-->
<div class="mod-foot-nav" id="ftsh">
	<ul class="foot-nav-list" id="ftsh1">
		<li>
			<a href="#ftsh">
				<div class="foot-nav-icon">
					<img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontsearch.png<?php echo STATIC_VER;?>">
				</div>
				<p class="foot-nav-tt">搜 索</p>
			</a>
		</li>
		<li class="flg-icon">
			<a href="">
				<div class="foot-nav-icon">
					<img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfonthome-r.png<?php echo STATIC_VER;?>">
				</div>
				<p class="foot-nav-tt">首 页</p>
			</a>
		</li>
		<li>
			<a href="">
				<div class="foot-nav-icon">
					<img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontmy.png<?php echo STATIC_VER;?>">
				</div>
				<p class="foot-nav-tt">用户中心</p>
			</a>
			<span>77</span>
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

<!--弹出层 开始-->
<div class="enshrine">
	<p>
		<span>1</span>点击右上角 <em class="heng"><img src="<?php echo IMG_CDN_URL;?>/v12/img/hengdian.png<?php echo STATIC_VER;?>" alt=""/></em>或 <em class="shu"><img
			src="<?php echo IMG_CDN_URL;?>/v12/img/shudian.png<?php echo STATIC_VER;?>" alt=""/></em>
	</p>

	<p>
		<span>2</span>点击收藏按钮 <img class="fx-btn" src="<?php echo IMG_CDN_URL;?>/v12/img/cs-btn.png<?php echo STATIC_VER;?>" alt=""/>
	</p>

	<p>
		<span class="bgtr"></span>点击分享按钮 <img class="fx-btn" src="<?php echo IMG_CDN_URL;?>/v12/img/fx-btn.png<?php echo STATIC_VER;?>" alt=""/>
	</p>

	<p>
		<span class="bgtr"></span>进行收藏与分享
	</p>
	<button class="enshrine-btn">知道了</button>
</div>
<!--弹出层 结束-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="js/config.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/ajax_page.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/ajax_collect.js<?php echo STATIC_VER;?>" charset="utf-8"></script>

</body>

</html>