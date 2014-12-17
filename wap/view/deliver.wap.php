<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>新玉麟</title>
<link href="css/style-b.css<?php echo STATIC_VER;?>" rel="stylesheet" type="text/css">
</head>
<body>
<div class="sub_top border_w">
  <div class="border_g"> <a href="javascript:history.go(-1);">返回</a> <span>查看物流</span> </div>
</div>
<div class="dd_news border_w">
  <div class="logistics_text">
    <ul>
      <li>订单编号：<span class="dd_news_s1"><?php echo $order_info['order_sn'];?></span></li>
      <li>物流单号：<span class="dd_news_s1"><?php echo $order_info['shipping_code'];?></span></li>
      <li>下单时间：<span class="dd_news_s1"><?php echo date("Y-m-d H:i:s",$order_info['add_time']);?></span></li>
      <li>店铺名称：<span class="dd_news_s1"><?php echo $shop_name['agent_name'];?></span></li>
      <li>物流公司：<span class="dd_news_s1"><?php echo $e_name;?></span></li>
    </ul>
  </div>
</div>
<div class="dd_news border_w">
  <div class="border_g">
    <h4>物流动态 </h4>
    <ul class="logistics_text">
      <?php echo $msg;?>
    </ul>
  </div>
</div>
<div class="zs w_b">以上部分信息来自于第三方，仅供参考，如需准确信息可联系卖家或物流公司</div>
<br/>
<br/>
<br/>
<div class="strip_top position topBox ">
  <ul class="ul">
    <li class="left right"> <a href="tmpl/member/member.html?act=member">
      <div class="pro_pen"></div>
      <div class="pro_sea_1">用户中心</div>
      </a> </li>
    <li class="left"> <a href="tmpl/cart_list.html">
      <div class="pro_car"></div>
      <div class="pro_sea_1">购物车</div>
      </a> </li>
  </ul>
</div>
<!-- zhangyating 2014-9-22 修改 通用的分享功能-->
<script type="text/javascript" src="js/tmpl/shareWx.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-9-22 修改 end -->
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>
