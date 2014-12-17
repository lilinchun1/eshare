<?php defined('InShopNC') or exit('Access Invalid!');?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>新玉麟</title>
<link href="<?php echo WAP_SITE_URL;?>/css/style-b.css<?php echo STATIC_VER;?>" rel="stylesheet" type="text/css">
</head>

<body>
<div class="min">
<div class="B002_zf dd_news border_">
	 <div class="border_g">
     <h3><img src="<?php echo WAP_SITE_URL;?>/images/<?php if($output['result']=='success'){ echo 'b002_icon2.png';}else{ echo 'b002_icon1.png';}?>"  class="img"/><span><?php echo $output['message'];?></span></h3>
     <a href="http://mp.weixin.qq.com/s?__biz=MzA5Mzg3MTYzNw==&mid=200945736&idx=1&sn=cc010f559941cda1724b9818008a799e#rd"><input type="button" value="点此关注公众号管理订单"  class="S006_but7" /></a>
     <ul>
    	<li>订单编号：<span class="dd_news_s1"><?php echo $output['order_list'][0]['order_sn'];?></span></li>
        <li>订单日期：<span class="dd_news_s1"><?php echo date("Y-m-d H:i",$output['order_list'][0]['add_time']);?></span></li>
        <li  style="border:0">已付金额：<span class="dd_news_s1">￥<?php echo $output['order_list'][0]['order_amount'];?></span></li>
    </ul>
     </div>
</div>
  <a href="<?php echo WAP_SITE_URL;?>/tmpl/member/order_detail.php?order_id=<?php echo $output['order_list'][0]['order_id'];?>"><input type="button" class="S006_but6 w_b" value="查看订单" /></a>
<div class="strip_top position topBox ">
    	<ul class="ul">
            <li class="left right">
            <a href="<?php echo WAP_SITE_URL;?>/tmpl/member/member.html?act=member">
            	<div class="pro_pen"></div>
                <div class="pro_sea_1">用户中心</div>
            </a>
            </li>
            <li class="left">
            <a href="<?php echo WAP_SITE_URL;?>/tmpl/cart_list.html">
            	<div class="pro_car"></div>
                <div class="pro_sea_1">购物车</div>
            </a>
            </li>
        </ul>
</div>
<!--<div class="topBox strip_top position">
	<div class="top">
    	<div class="search_1">
        	<img src="images/img_pro_sea.png">
            <input type="search" placeholder="请输入搜索内容" class="search_2"/> 
        </div>
        <div class="search_3"><a href="#">取消</a></div>
    </div>
</div>-->
</div>
</body>
</html>
