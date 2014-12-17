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
<title>WEKA</title>
<link href="../../_view/css/style_product.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="min">

<div class="topBox">
	<div class="top">
    	<img src="../../_view/images/img_logo.png">
        <div class="characterBox">
        	<div class="character">TAKIYAS SHOP  志洋小店</div>
            <div><samp class="pink">啊啊啊啊啊</samp><samp class="gren">已售：254</samp></div>
        </div>
    </div>
</div>
		<div id="product_list"></div>


<div class="strip margin" ></div>
	<a class="pro_product strip_top" href="#">查看更多商品（12件）</a>
<div class="strip height"></div>

<div class="strip_top position topBox ">
    	<ul class="ul">
        	<li class="right">
            <a href="#">
            	<div class="pro_sea"></div>
                <div class="pro_sea_1">搜索</div>
            </a>
            </li>
            <li class="left right">
            <a href="#">
            	<div class="pro_pen"></div>
                <div class="pro_sea_1">用户中心</div>
            </a>
            </li>
            <li class="left">
            <a href="#">
            	<div class="pro_car"></div>
                <div class="pro_sea_1">购物车</div>
            </a>
            </li>
        </ul>
</div>
<!--<div class="topBox strip_top">
	<div class="top">
    	<div class="search_1">
        	<img src="../../_view/images/img_pro_sea.png">
            <input type="search" placeholder="请输入搜索内容" class="search_2"/> 
        </div>
        <div class="search_3"><a href="#">取消</a></div>
    </div>-->
</div>
</div>

	<input type="hidden" name="key" value="4">
	<input type="hidden" name="order" value="1">
	<input type="hidden" name="page" value="10">
	<input type="hidden" name="curpage" value="1">
	<input type="hidden" name="hasmore">
	<input type="hidden" name="gc_id" value="">
	<input type="hidden" name="keyword">
	<input type="hidden" name="agent_id" value="<?php echo $_GET['agent_id'];?>">
		
</body>
	
	
	<script type="text/html" id="home_body">
	<% if(goods_list.length >0 && err==0){%>	
	
			<%for(i=0;i<goods_list.length;i++){%>
				
				
				
				
				
				
				<div class="strip"></div>
<div class="strip margin"></div>
<div class="topBox strip_top">
	<div class="top width">
    	<div class="recom">推荐商品   
        </div>
        <div class="bottom"></div>
        <div class="top_1"></div>
        <div class="pro_img">
            <a  href="product_detail.html?goods_id=<%=goods_list[i].goods_id;%>"><img src="<%=goods_list[i].goods_image_url;%>"></a>
        </div>
        <div class="pro_chara"><%=goods_list[i].goods_name;%></div>
        <div class="pro_price">
        	<div class="price">￥&nbsp;<%=goods_list[i].goods_price;%>元/&nbsp;盒</div>
            <div class="price_1">市场价：<%=goods_list[i].goods_marketprice;%>元/盒</div>
        </div>
        <a class="pro_apply" href="product_detail.html?goods_id=<%=goods_list[i].goods_id;%>">立即购买</a>
        <div class="pro_chara_1"><%=goods_list[i].evaluation_count;%>人已购买</div>
    </div>
</div>
	
			<%}%>
	
	<%
	   }else {
	%>
		<div class="no-record">
            暂无记录
        </div>
	<%
	   }
	%>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/zepto.min.js"></script>
<script type="text/javascript" src="../js/touch.js"></script>
<script type="text/javascript" src="../js/template.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/common-top.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../js/tmpl/product_list.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
</html>
