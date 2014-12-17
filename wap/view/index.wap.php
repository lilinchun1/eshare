<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>新玉麟</title>
<link href="css/style_product.css<?php echo STATIC_VER;?>" rel="stylesheet" type="text/css">
<script type="text/javascript">
var l = location.href;
if(l.indexOf("agent_id=") < 0){
  location.href += (l.indexOf("?")>0 ? '&' : '?') + "agent_id=<?php echo $_SESSION['agent_id'];?>";
}
</script>
</head>
<body>
<div class="min">
  <div class="topBox">
    <div class="top"> <img src="<?php echo $agent_info['member_avatar']?>" class="head">
      <div class="characterBox">
        <div class="character"><?php echo $agent_info['agent_name'];?></div>
        <div><samp class="pink">级别 : <?php echo $lv['name'];?></samp><!--<samp class="gren">已售：254</samp>--></div>
      </div>
    </div>
  </div>
<?php foreach($goods_list as $k => $v){?>
  <div class="strip"></div>
  <div class="strip margin"></div>
  <div class="topBox strip_top">
    <div class="top width">
    <?php if($k == 0 ){?>
      <div class="recom">热销商品</div>
    <?php } ?>
      <div class="bottom"></div>
      <div class="top_1"></div>
      <div class="pro_img">
      	<a  href="index.php?act=product&goods_id=<?php echo $v['goods_id'];?>&agent_id=<?php echo $agent_id;?>">
      		<img src="<?php echo $v['goods_image_url'];?>">
      	</a>
      	 <?php if($v['goods_commend']){?>
            <div class="img_1">
            	<img src="../_view/images/img_1.png">
            </div>
         <?php } ?>

       </div>
      <div class="pro_chara"><?php echo $v['goods_name'];?></div>
      <div class="pro_price">
        <div class="price">￥&nbsp;<?php echo $v['goods_price'];?>元</div>
        <div class="price_1">市场价<?php echo $v['goods_marketprice'];?>元</div>
      </div>
      <a class="pro_apply" href="<?php echo WAP_SITE_URL;?>/tmpl/order/buy_step1.html?goods_id=<?php echo $v['goods_id'];?>&buynum=1">立即购买</a>
      <div class="pro_chara_1">已售出<?php echo $v['volume'];?>件</div>
    </div>
  </div>
<?php }?>
  <div class="strip margin" ></div>
  <div class="footer3">
      <ul>
        <li class="footer3_border iadd-hight"><a href="<?php echo WAP_SITE_URL;?>/index.php?act=wxCap&op=agentRegist&channel_id=<?php echo $agent_info['channel_id'];?>&parent_id=<?php echo $agent_info['agent_id'];?>">我要开店</a></li>
      </ul>
    </div>
     <?php if($_GET['shared']){?>
    <div id="pop-up" onclick="document.getElementById('pop-up').style.display='none';">
        <div class="pop"></div>
    </div>
    <?php }?>
<!--  <a class="pro_product strip_top" href="#">查看更多商品（12件）</a>-->
  <div class="strip height"></div>
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
</div>
<!-- 添加分享的js -->
<script type="text/javascript" src="js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<?php if($from){?>
	<script type="text/javascript" src="<?php echo WAP_SITE_URL;?>/index.php?act=state&op=addState&agent_id=<?php echo $agent_id;?>&page=list&page_id=1&event=<?php echo $from;?>"></script>
<?php }?>
<?php include "share_list.php";?>

<!-- 添加分享的js -->
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->

</body>
</html>