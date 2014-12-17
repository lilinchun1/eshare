<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>新玉麟</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="css/reset.css<?php echo STATIC_VER;?>">
<link rel="stylesheet" type="text/css" href="css/main.css<?php echo STATIC_VER;?>">
<link rel="stylesheet" type="text/css" href="css/child.css<?php echo STATIC_VER;?>">
<link href="css/style.css<?php echo STATIC_VER;?>" rel="stylesheet" type="text/css">
<script type="text/javascript">
var l = location.href;
if(l.indexOf("agent_id=") < 0){
  location.href += (l.indexOf("?")>0 ? '&' : '?') + "agent_id=<?php echo $_SESSION['agent_id'];?>";
}
</script>
</head>
<body>
<div class="min">
<div class="sub_top border_w">
  <div class="border_g"> <a href="javascript:history.go(-1);">返回</a> <span>商品详情</span> </div>
</div>
<div id="product_detail_wp"></div>
<div class="content">
  <div class="pddetail-cnt">
    <div class="pddc-topwp"> <a href="javascript:void(0);" class="pddct-imgwp">
      <div id='mySwipe' class='swiper-container' style="position:absolute; z-index:-1;">
        <div class='swipe-wrap'>
          <?php
			 foreach($goods_image as $v){?>
          <div class="swipe-item"><img src="<?php echo $v;?>"/></div>
          <?php }?>
        </div>
      </div>
      <div class="pddct-shadow" ></div>
      <div class="pddct-name-wp"  >
        <div class="pddctnw-name" > 已售出：<?php echo $volume;?> 件 </div>
      </div>
      <span class="pdpic-size-bg"></span> <span class="pdpic-size"> <span class="pds-cursize">1</span> / <span class="pds-tsize"><?php echo count($goods_image);?></span> </span> </a> </div>
    <div class="top_img border_w">
      <div class="border_g">
        <div class="S004_title"> <?php echo $goods_detail['goods_info']['goods_name']?></div>
        <div class="S004_price"> ￥<?php echo $goods_detail['goods_info']['goods_price'];?>元 <span>市场价：<?php echo $goods_detail['goods_info']['goods_marketprice'];?>元</span> </div>
      </div>
      <div class="pddc-gray-warp">
        <ul class="pddc-stock ppdc-white-wrap">
          <li class="pddc-stock-title clearfix"> <span class="key">供应量：</span>
            <div class="price value"> <span class="stock-num"><?php echo $goods_detail['goods_info']['goods_storage'];?></span> 件 </div>
          </li>
          <?php if(count($goods_detail['goods_info']['spec_name'])>0){?>
          <?php foreach($goods_detail['goods_info']['spec_name'] as $k => $v){?>
          <li class="pddc-stock-spec bd-tdashed-dd"> <span class="key-no" spec_id=""> <?php echo $v;?> </span>
            <div class="value-no mt10">
              <?php foreach($goods_detail['goods_info']['spec_value'][$k] as $m =>$n){?>
              <a href="?act=product&goods_id=<?php echo $goods_detail['spec_list'][$m];?>"
              	<?php if($goods_detail['goods_info']['goods_spec'][$m]){echo 'class="current"';};?>> <?php echo $n?> <i class="pd-choice-icon"></i> </a>
              <?php } ?>
            </div>
          </li>
          <?php }?>
          <?php }?>
          <li class="bd-tdashed-dd"> <span class="key-no"> 数量： </span>
            <div class="value-no mt10 clearfix"> <span class="minus-wp fleft"> <span class="i-minus"></span> </span>
              <input type="text" class="buy-num fleft" id="buynum" value="1"/>
              <span class="add-wp fleft"> <span class="i-add"></span> </span> </div>
          </li>
          <li class="bd-tdashed-dd">
            <div class="S004_but">
              <?php if($goods_detail['goods_info']['promotion_type']!='groupbuy'){?>
              <input type="button" value="加入购物车" class="car add-to-cart" />
              <?php }?>
              <input type="button" value="立即购买"  class="pay buy-now"/>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div><a href="index.php?agent_id=<?php echo $agent_id;?>">
<div class="sub_shop border_w">
  <div class="border_g"> <div class="shopec">进入店铺</div><span><?php echo $agent_info['agent_name'];?></span> </div>
</div></a>
<div class="show border_w">
  <div class="border_g">
    <h4>商品介绍</h4>
    <div class="show_text"><?php echo $goods_detail['goods_info']['goods_body'];?></div>
    <br>
    <div class="footer3">
      <ul>
        <li class="footer3_border iadd-hight"><a href="<?php echo WAP_SITE_URL;?>/index.php?act=wxCap&op=agentRegist&channel_id=<?php echo $agent_info['channel_id'];?>&parent_id=<?php echo $agent_info['agent_id'];?>">我要开店</a></li>
      </ul>
    </div>
  </div>
  <div class="strip margin" ></div>
  <div class="strip margin" ></div>
  <div class="strip margin" ></div>
  <div class="strip_top position topBox ">
    <ul class="ul">
      <li class="left right"> <a href="tmpl/member/member.php?act=member">
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
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="js/config.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="js/template.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="js/swipe.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="js/simple-plugin.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="js/tmpl/common-top.js<?php echo STATIC_VER;?>"></script>
<script type="text/javascript" src="js/tmpl/footer.js<?php echo STATIC_VER;?>"></script>
<!-- 用户的小红点 -->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/red_point.js<?php echo STATIC_VER;?>"></script>
<!-- 用户的小红点 -->
<?php if($from){?>
<script type="text/javascript" src="<?php echo WAP_SITE_URL;?>/index.php?act=state&op=addState&agent_id=<?php echo $agent_id;?>&page=goods&page_id=<?php echo $goods_id;?>&event=<?php echo $from;?>"></script>
<?php }?>
<?php include "share_goods.php";?>
<script>
  var goods_id = <?php echo $goods_id;?>;
  var goods_storage = <?php echo $goods_detail['goods_info']['goods_storage'];?>;

  function picSwipe(){
	   var elem = $("#mySwipe")[0];
        window.mySwipe = Swipe(elem, {
        continuous: true,
        //disableScroll: true,
        stopPropagation: true,
        callback: function(index, element) {
          $(".pds-cursize").html(index+1);

		  $(".pddct-name-wp").css("z-index","1");
		  $(".pddct-name-wp").css("position","absolute");

		  $(".pddct-shadow").css("z-index","1");
		  $(".pddct-shadow").css("position","absolute");

		  $(".a1").css("z-index","-1");
		  $(".a1").css("position","absolute");

        }
      });

    }



		  $(".pddct-name-wp").css("z-index","1");
		  $(".pddct-name-wp").css("position","absolute");

		  $(".pddct-shadow").css("z-index","1");
		  $(".pddct-shadow").css("position","absolute");

 			picSwipe();
            //商品描述
            $(".pddcp-arrow").click(function (){
              $(this).parents(".pddcp-one-wp").toggleClass("current");
            });
$(".add-to-cart").click(function (){

  var key = getcookie('key');//登录标记
   if(key==''){
	  window.location.href = WapSiteUrl+'/tmpl/member/login.html';
   }else{
	  var quantity = parseInt($(".buy-num").val());
	  $.ajax({
		 url:ApiUrl+"/index.php?act=member_cart&op=cart_add",
		 data:{key:key,goods_id:goods_id,quantity:quantity},
		 type:"post",
		 success:function (result){
			var rData = $.parseJSON(result);
			if(checklogin(rData.login)){

			 if(!rData.datas.error){
                             $.sDialog({
                                skin:"block",
                                content:"添加购物车成功！",
                                "okBtnText": "&nbsp;&nbsp;再逛逛&nbsp;&nbsp;",
                                "cancelBtnText": "去购物车",
                                okFn:function (){},
                                cancelFn:function (){
                                  window.location.href = WapSiteUrl+'/tmpl/cart_list.html';
                                }
                              });
                         	//添加小红点
                       	  $.post(cart_url,{key:param_key},function(result){
                       			var json = result.datas;
                       				if(json.status && parseInt(json.data)){
                       					//alert(json.data);
                       					$(".pro_car").html(json.data).show();
                       				}
                       		}, 'json');
                       	//添加小红点
			  }else{
				$.sDialog({
				  skin:"red",
				  content:rData.datas.error,
				  okBtn:false,
				  cancelBtn:false
				});
			  }
			}
		 }
	  });

   }
});

 //立即购买
$(".buy-now").click(function (){

   var key = getcookie('key');//登录标记
   if(key==''){
	  window.location.href = WapSiteUrl+'/tmpl/member/login.html';
   }else{
	  var json = {};
	  var buynum = $('.buy-num').val();
	  json.key = key;
	  json.cart_id = goods_id+'|'+buynum;
	  $.ajax({
		  type:'post',
		  url:ApiUrl+'/index.php?act=member_buy&op=buy_step1',
		  data:json,
		  dataType:'json',
		  success:function(result){
			  if(typeof(result.datas.error) == 'undefined'){
				  location.href = WapSiteUrl+'/tmpl/order/buy_step1.html?goods_id='+goods_id+'&buynum='+buynum;
			  }else{
				  $.sDialog({
					  skin:"red",
					  content:result.datas.error,
					  okBtn:false,
					  cancelBtn:false
					});
			  }
		  }
	  });
   }
});


$(".minus-wp").click(function (){

   var buynum = $(".buy-num").val();
   if(buynum >1){
	  $(".buy-num").val(parseInt(buynum-1));
   }
});
//购买数量加
$(".add-wp").click(function (){
   var buynum = parseInt($(".buy-num").val());
   if(buynum < goods_storage){
	  $(".buy-num").val(parseInt(buynum+1));
   }
});
//收藏
$(".pd-collect").click(function (){
	var key = getcookie('key');//登录标记
	if(key==''){
	  window.location.href = WapSiteUrl+'/tmpl/member/login.html';
	}else {
	  $.ajax({
		url:ApiUrl+"/index.php?act=member_favorites&op=favorites_add",
		type:"post",
		dataType:"json",
		data:{goods_id:goods_id,key:key},
		success:function (fData){
		 if(checklogin(fData.login)){
			if(!fData.datas.error){
			  $.sDialog({
				skin:"green",
				content:"收藏成功！",
				okBtn:false,
				cancelBtn:false
			  });
			}else{
			  $.sDialog({
				skin:"red",
				content:fData.datas.error,
				okBtn:false,
				cancelBtn:false
			  });
			}
		  }
		}
	  });
	}
});


</script>
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>