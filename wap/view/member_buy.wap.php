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
<title>购物清单</title>
<link rel="stylesheet" href="v12/css/cy-index.css"/>
<link rel="stylesheet" href="v12/css/llc-index.css"/>

</head>
<body>

<div class="bill_top">
  <p>购物清单</p>
  <p>实付款：<span>￥<?php echo $store_cart_list[1]['store_goods_total'];?></span></p>
</div>
<div class="cart_char_0">
  <ul>
    <li class="cart_char_1"> <img src="<?php echo $single_cart['goods_image_url'];?>"></li>
    <li class="cart_char_2">
      <div>
        <p><span>【包邮】</span><?php echo $single_cart['goods_name'];?></p>
        <p>规格：<?php echo $single_cart['goods_spec'];?></p>
      </div>
    </li>
    <li class="cart_char_3" style="float: right; ">
      <div>
      <p>￥<?php echo $single_cart['goods_price'];?></p>
      <p>×<?php echo $single_cart['goods_num'];?></p>
    </li>
  </ul>
</div>
<div class="cart_char_0">
  <ul>
    <li class="cart_char_4 cart_char_4_1">购买数量</li>
    <li class="cart_char_4" style="float: right;">
      <div>-</div>
      <div><?php echo $single_cart['goods_num'];?></div>
      <div>+</div>
    </li>
    <li class="cart_char_4" style="float: right;">剩余：<?php echo $single_cart['goods_storage'];?>件</li>
  </ul>
</div>
<div class="cart_char_0">
  <ul>
    <li class="cart_char_4 cart_char_4_1">配送方式：</li>
    <li class="cart_char_4" >快递包邮</li>
  </ul>
</div>
<div class="cart_char_0">
  <div class="cart_char_7">收货地址:</div>
  <div class="cart_char_text">
    <div style="overflow:hidden; padding: 0;margin: 0; width: 100%;margin-bottom: 10px;"> <span class="cart_char_text_char_0">姓名:</span>
      <div class="cart_char_selBox_1">
        <input type="text" name="true_name" class="cart_char_text_1" placeholder=" 如:张先生">
      </div>
    </div>
  </div>
  <div style="overflow:hidden; padding: 0;margin: 0; width: 100%;margin-bottom: 10px;"> <span class="cart_char_text_char_0">电话:</span>
    <div class="cart_char_selBox_1">
      <input type="text"   name="mob_phone" class="cart_char_text_1" placeholder=" 请填写准确的号码">
    </div>
  </div>
  <div style="overflow:hidden; padding: 0;margin: 0;margin-bottom: 10px;">
    <div class="cart_char_text_char_0">省份:</div>
    <div class="cart_char_selBox_1">
     <select class="cart_char_sel" name="prov" id="vprov">
		<option value="">请选择...</option>
	</select>
	<img src="v12/img/arrow2.png"> </div>
  </div>
  <div style="overflow:hidden; padding: 0;margin: 0;margin-bottom: 10px;">
    <div class="cart_char_text_char_0">市区:</div>
    <div class="cart_char_selBox_1">
       <select class="cart_char_sel" name="city" id="vcity">
		<option value="">请选择...</option>
	</select>
      <img src="v12/img/arrow2.png"> </div>
  </div>
  <div style="overflow:hidden; padding: 0;margin: 0;margin-bottom: 10px;">
    <div class="cart_char_text_char_0">辖区:</div>
    <div class="cart_char_selBox_1">
      <select class="cart_char_sel" name="region" id="vregion">
		<option value="">请选择...</option>
	</select>
      <img src="v12/img/arrow2.png"> </div>
  </div>
  
   <div style="overflow:hidden; padding: 0;margin: 0; width: 100%;margin-bottom: 10px;"> <span class="cart_char_text_char_0">地址:</span>
    <div class="cart_char_selBox_1">
      <input type="text"   name="vaddress" id="vaddress" class="cart_char_text_1" placeholder="详细地址">
    </div>
  </div>
</div>
<div class="cart_char_0">
  <ul>
    <li class="cart_char_5">
      <p>收货地址</p>
      <p> <?php echo $buy_list['address_info']['true_name'];?> <?php echo $buy_list['address_info']['mob_phone'];?></p>
      <p class="shop_new"> <?php echo $buy_list['address_info']['area_info'];?> <?php echo $buy_list['address_info']['address'];?></p>
    </li>
    <li style="float: right;" class="cart_char_6"> <img src="../v12/img/arrow1.png"> </li>
  </ul>
</div>
<div class="cart_char_0">
  <div class="cart_char_7">发票</div>
  <div class="cart_char_text">
    <div class="cart_input">
      <input type="checkbox" name="a" checked>
      个人<br>
      <input type="checkbox" name="a" >
      企业<br>
    </div>
    <div style="overflow:hidden; padding: 0;margin: 0; width: 100%;margin-bottom: 10px;"> <span class="cart_char_text_char">企业名称:</span>
      <div class="cart_char_selBox">
        <input type="text" class="cart_char_text_1">
      </div>
    </div>
    <div style="overflow:hidden; padding: 0;margin: 0;margin-bottom: 10px;">
      <div class="cart_char_text_char">商品类型:</div>
      <div class="cart_char_selBox">
        <div class="select-wrap register-select" style="width: 99%;">
          <select name="unit" class="cart_char_sel">
            <option>请选择</option>
            <option>01单元</option>
            <option>02单元</option>
            <option>03单元</option>
          </select>
          <div class="logo"> <svg class="icon-arrow-down">
            <use xlink:href="v12/img/svg/svgdefs.svg#icon-arrow-down"></use>
            </svg> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div  class="cart_text"> <span class="cart_char_text_char">订单留言:</span>
  <div class="cart_char_text_2">
    <textarea placeholder="请包装好需要有包装" class="cart_char_text_2_1"></textarea>
  </div>
</div>
<div class="cart_button"> <a class="orange pay">支付宝安全支付</a> <a class="green pay">微信安全支付</a> </div>
<div style="text-align: center;font-size: 1em;color:#999;" class="botton">易享科技</div>
<!--底部导航 开始-->
<div class="mod-foot-nav" id="ftsh">
  <ul class="foot-nav-list"  id="ftsh1">
    <li> <a href="#ftsh"> <svg class="foot-nav-icon">
      <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-iconfontsearch"></use>
      </svg> 搜 索 </a> </li>
    <li> <a href=""> <svg class="foot-nav-icon">
      <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-iconfonthome"></use>
      </svg> 首 页 </a> </li>
    <li> <a href=""> <svg class="foot-nav-icon">
      <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-iconfontmy"></use>
      </svg> 用户中心 </a> <span>77</span> </li>
    <li> <a href=""> <svg class="foot-nav-icon">
      <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-iconfontcart"></use>
      </svg> 购物车 </a> <span>12</span> </li>
  </ul>
  <div class="search" id="ftsh1"> <a href="#ftsh1"><svg class="icon-iconfont-left">
    <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-left"></use>
    </svg></a>
    <div class="search-input-wrap">
      <input class="search-input" placeholder="搜索您想要的商品" type="text"/>
      <svg class="search-log">
      <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-iconfontsearch"></use>
      </svg> </div>
    <button class="search-btn">搜索</button>
  </div>
</div>
<ul class="aside-item">
  <li> <svg class="aside-item-icon">
    <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-iconfontmessage"></use>
    </svg> </li>
  <li> <svg class="aside-item-icon">
    <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-iconfontphone"></use>
    </svg> </li>
  <li> <svg class="aside-item-icon">
    <use xlink:href="v12/img/svg/svgdefs.svg#icon-iconfont-up"></use>
    </svg> </li>
</ul>

 	<input type="hidden" name="address_id">
    <input type="hidden" name="area_id">
    <input type="hidden" name="city_id">
    <input type="hidden" name="freight_hash">
    <input type="hidden" name="vat_hash">
    <input type="hidden" name="allow_offpay">
    <input type="hidden" name="offpay_hash">
	<input type="hidden" name="invoice_id">
	<input type="hidden" name="passwd_verify" value="0">
	<input type="hidden" name="total_price">
	<input type="hidden" name="available_predeposit">
    
<script type="text/javascript" src="js/common.js.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script>

var key = '<?php echo $_COOKIE['key']?>';
var ApiUrl = '<?php echo MOBILE_SITE_URL;?>';
var WapUrl = '<?php echo WAP_SITE_URL;?>';

//qinwei v1.2.1 2014-12-15 省市级选择 
$(function() {
	$.ajax({
		type:'post',
		url:ApiUrl+'/index.php?act=member_address&op=area_list',
		data:{key:key},
		dataType:'json',
		success:function(result){
			
			var data = result.datas;
			var prov_html = '';
			for(var i=0;i<data.area_list.length;i++){
				prov_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
			}
			$("select[name=prov]").append(prov_html);
		}
	});

	$("select[name=prov]").click(function(){
		var prov_id = $(this).val();
		$.ajax({
			type:'post',
			url:ApiUrl+'/index.php?act=member_address&op=area_list',
			data:{key:key,area_id:prov_id},
			dataType:'json',
			success:function(result){
				var data = result.datas;
				var city_html = '<option value="">请选择...</option>';
				for(var i=0;i<data.area_list.length;i++){
					city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
				}
				$("select[name=city]").html(city_html);
				$("select[name=region]").html('<option value="">请选择...</option>');
			}
		});
	});

	$("select[name=city]").click(function(){
		var city_id = $(this).val();
		$.ajax({
			type:'post',
			url:ApiUrl+'/index.php?act=member_address&op=area_list',
			data:{key:key,area_id:city_id},
			dataType:'json',
			success:function(result){
				var data = result.datas;
				var region_html = '<option value="">请选择...</option>';
				for(var i=0;i<data.area_list.length;i++){
					region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
				}
				$("select[name=region]").html(region_html);
			}
		});
	});
});
	
//qinwei v1.2.1 2014-12-15 新版支付 
$('.pay').click(function(){
	
	var goods_id = <?php echo $goods_id?>;
	var number =   <?php echo $number?>;
	var cart_id = goods_id+'|'+number;
		
	var true_name = $('input[name=true_name]').val();
	var mob_phone = $('input[name=mob_phone]').val();
	var tel_phone = $('input[name=tel_phone]').val();
	var city_id = $('select[name=city]').val();
	var area_id = $('select[name=region]').val();
	var address = $('input[name=vaddress]').val();

	var prov_index = $('select[name=prov]')[0].selectedIndex;
	var city_index = $('select[name=city]')[0].selectedIndex;
	var region_index = $('select[name=region]')[0].selectedIndex;
	var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
	
	$.ajax({
		type:'post',
		url:ApiUrl+'/index.php?act=member_address&op=address_add',
		data:{key:key,true_name:true_name,mob_phone:mob_phone,tel_phone:tel_phone,city_id:city_id,area_id:area_id,address:address,area_info:area_info},
		dataType:'json',
		success:function(result){
			if(result){
				if(result.datas.error){
					alert(result.datas.error);
        			return false;
        		}else{
					
					//sart 
					
					
					
	var data = {};
	data.key = key;
	
//	if(ifcart == 1){//购物车订单
//		data.ifcart = ifcart;
//	}

	data.cart_id = cart_id;

	var address_id = result.datas.address_id;
	data.address_id = address_id;

	var invoice_id = 521;
	data.invoice_id = invoice_id;


	
	//生成订单 支付
	$.ajax({
		type:'post',
		url:WapUrl+'/index.php?act=member_buy&op=topay',
		data:data,
		dataType:'json',
		success:function(result){
			var sn = result.datas.pay_sn['pay_sn'];
			
			var type = 1;
			if(type=='1'){
				window.location.href=ApiUrl+"/index.php?act=member_payment&op=pay&type=1&key="+key+"&pay_sn="+sn+">";	
			}
			if(type=='2'){
				window.location.href=ApiUrl+"/index.php?act=member_payment&op=pay&type=2&key="+key+"&pay_sn="+sn+">";	
			}
				return false;			
		}
	});
					
					
					
					
					
					
					
					//end 
					
					
				}
			}
		}
	});
	
	
				
	
});
</script>
</body>
</html>
