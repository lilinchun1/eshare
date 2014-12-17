<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>我的收藏-商品</title>
	<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/gl-index.css<?php echo STATIC_VER;?>" >
</head>
<body class="user-bg">
<ul class="collection-top">
	<li class="collection-top-lb"><a href="index.php?act=member_favorites&op=favorites_list&fav_type=agent">店铺<span>（<?php echo $favorites_agent_num;?>）</span></a></li>
	<li><a href="index.php?act=member_favorites&op=favorites_list&fav_type=goods" class="collection-top-color">商品<span>（<?php echo $favorites_goods_num;?>）</span></a></li>
</ul>
<ul class="collection-sp">
	<?php foreach($goods_list as $k => $v){?>
	<li>
		<a href="index.php?act=product&goods_id=<?php echo $v['goods_id'];?>" class="sp-photo">
			<img src="<?php echo $v['goods_image_url'];?><?php echo STATIC_VER;?>">
			<div class="sp-photo-name">
				<h4><?php echo $v['goods_name'];?></h4>

				<p>
					<?php
					foreach ($v['goods_spec'] as $spec_k=>$spec_v){
						echo $spec_v;
					}
					?>
				</p>

				<p>价格：￥<?php echo $v['goods_price'];?></p>
			</div>
		</a>
		<a href="" class="dp-stars"><img src="<?php echo IMG_CDN_URL;?>/v12/img/collection-1.png<?php echo STATIC_VER;?>"> </a>
	</li>
	<?php }?>
</ul>
<?php
if(!$goods_list){
?>
<div class="collection-none">
    <img src="<?php echo IMG_CDN_URL;?>/v12/img/collection-none.png">

    <p>您的收藏夹内还没有收藏！</p>
</div>
<?php
}
?>
<footer class="footer">
	易享科技出品
</footer>
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
</body>
</html>