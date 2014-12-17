<?php if (!@include('../member_config.php')) exit('member_config.php isn\'t exists!');?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>我的订单</title>
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css" >
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/gl-index.css" >
</head>
<body>
<ul class="order-top">
    <li class="r-b r-h" id="all-order"><a href="javascript:void(0);" onclick="initPage(0,1,0);">全部(<span></span>)</a></li>
    <li class="r-b" id="no-payment"><a href="javascript:void(0);" onclick="initPage(0,1,10);">待付款(<span></span>)</a></li>
    <li class="r-b" id="no-delivery"><a href="javascript:void(0);" onclick="initPage(0,1,20);">待发货(<span></span>)</a></li>
    <li id="realy-delivery"><a href="javascript:void(0);" onclick="initPage(0,1,30);">已发货(<span></span>)</a></li>
</ul>

<!-- 改写开始 -->
<div id="order-list"></div>
	<script type="text/html" id="order-list-tmpl"> 
 		<%if (order_group_list.length >0){%>
			<%for(var i = 0;i<order_group_list.length;i++){
 				var orderlist = order_group_list[i].order_list;
				
            %>
				 <% for(var j = 0;j<orderlist.length;j++){
                      var order_goods = orderlist[j].extend_order_goods;
					  var count_all = 0;
                 %>
				<div class="order-list-gl" style=" overflow: hidden; display: block;">
				<div class="order-l-b">
					<%
					if(orderlist[j].order_state == 0){orderlist[j].state_desc = "已关闭";}
					if(orderlist[j].order_state == 40){orderlist[j].state_desc = "已完成";}
					%>
				
					<h4><%=orderlist[j].agent_name%>微店<span><%=orderlist[j].state_desc%></span></h4>
					  <%for (var k = 0;k<order_goods.length;k++){
					  var goods_num = order_goods[k].goods_num;
					  count_all=goods_num*1+count_all;
					  %>
						<div class="shopping-listing" onclick="location.href='<%=WapSiteUrl%>/tmpl/member/order_detail.php?order_id=<%=orderlist[j].order_id%>'">
        					<div class="shopping-listing-box">
            					<div class="slb-l">
                					<img src="<%=order_goods[k].goods_image_url%>">
            					</div>
            						<div class="slb-c">
                						<p><span>【包邮】</span><%=order_goods[k].goods_name%></p>

                							<p>规格：<%=order_goods[k].norms%></p>
            						</div>
           								<div class="slb-r">
                							<p>￥<%=order_goods[k].goods_price%></p>

                								<p>×<%=order_goods[k].goods_num%></p>
            							</div>
       						</div>
    					</div>
					   <%}%>
					    <div class="order-payment">
       						 实付款:<span>￥<%=orderlist[j].order_amount%></span>
        						<i>共计<%=count_all%>件</i>
    					</div>
						 <%
						if(order_goods.length > 1){%>
    					<div class="order-dd-button1">
        						 <a href="javascript:void(0);" onclick="drop_down(this)">
   						</div>
						<%}%>
						   
				</div>
					<div>
					<%
					var orderstate = orderlist[j].order_state;
					if(orderstate == 10){%>
    					<input type="button" value="继续支付" onclick="location.href='<%=WapSiteUrl %>/tmpl/member/order_new.php?order_id=<%=orderlist[j].order_id%>'" class="gl-btn-k2">
						<input type="button" value="取消订单" order_id="<%=orderlist[j].order_id%>" order_type="<%=type%>" class="cancel-order gl-btn-k1">
					<%}%>
					<%
					if(orderstate == 30){%>
    					<input type="button" value="确认收货" order_id="<%=orderlist[j].order_id%>" order_type="<%=type%>" class="sure-order gl-btn-k2">
    					<input type="button" onclick="location.href='<%=WapSiteUrl%>/index.php?act=deliver_customer&order_id=<%=orderlist[j].order_id%>'" value="查看物流" class="gl-btn-k1">
					<%}%>
					<%
					if(orderstate == 40){%>
    					<input type="button" value="删除订单" order_type="<%=type%>" order_id="<%=orderlist[j].order_id%>" class="delete-order gl-btn-k1">
    					<input type="button" onclick="location.href='<%=WapSiteUrl%>/index.php?act=deliver_customer&order_id=<%=orderlist[j].order_id%>'" value="查看物流" class="gl-btn-k1">
					<%}%>
					<%
					if(orderstate == 0){%>
    					<input type="button" value="删除订单" order_type="<%=type%>" order_id="<%=orderlist[j].order_id%>" class="delete-order gl-btn-k1">
					<%}%>
					</div>
					</div>
				<%}%>

		    <%}%>
 		<%}else {%>
 			<div class="indent-state indent-show-none">
                  	  暂无记录
         	</div>
        <%}%>
	</script>
<!-- 改写结束 -->
<div class="order-button">
</div>
<button class="check-more-btn">
            查看更多
</button>
    <div class="add-more">
        正在加载...
    </div>
<footer class="footer">
    易享科技出品
</footer>
<!--底部导航 开始-->
<div class="mod-foot-nav" id="ftsh">
    <ul class="foot-nav-list" id="ftsh1">
        <li>
            <a href="#ftsh">
                <div class="foot-nav-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontsearch.png">
                </div>
                <p class="foot-nav-tt">搜 索</p>
            </a>
        </li>
        <li class="flg-icon">
            <a href="">
                <div class="foot-nav-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfonthome-r.png">
                </div>
                <p class="foot-nav-tt">首 页</p>
            </a>
        </li>
        <li>
            <a href="../../tmpl/member/member.php?act=member">
                <div class="foot-nav-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontmy.png">
                </div>
                <p class="foot-nav-tt">用户中心</p>
            </a>
            <span class="pro_pen" style="display: none;"></span>
        </li>
        <li>
            <a href="../../tmpl/cart_list.html">
                <div class="foot-nav-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontcart.png">
                </div>
                <p class="foot-nav-tt">购物车</p>
            </a>
            <span class="pro_car" style="display: none;"></span>
        </li>
    </ul>
    <div class="search" id="ftsh1">
        <a href="#ftsh1">
         <a href="#ftsh1"><span class="icon-iconfont-left"><img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-left.png" alt=""/></span></a>
        </a>

        <div class="search-input-wrap">
            <input class="search-input" placeholder="搜索您想要的商品" type="text"/>
            <svg class="search-log">
                <use xlink:href="<?php echo IMG_CDN_URL;?>/v12/img/svg/svgdefs.svg#icon-iconfont-iconfontsearch"></use>
            </svg>
        </div>
        <button class="search-btn">搜索</button>
    </div>
</div>
<!--底部导航 结束-->

<!--侧边栏 开始-->
<ul class="aside-item">
    <li>
        <img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontmessage.png" alt=""/>
    </li>
    <li>
        <img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-iconfontphone.png" alt=""/>
    </li>
    <li>
        <img class="aside-item-icon" src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-up.png" alt=""/>
    </li>
</ul>
<!--侧边栏 结束-->

<!-- js开始 -->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js"></script>
<script type="text/javascript" src="../../js/template.js"></script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/common-top.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/order_list.js"></script>
<!-- zhangyating 2014-9-22 修改 通用的分享功能-->
<script type="text/javascript" src="../../js/tmpl/shareWx.js"></script>
<!-- zhangyating 2014-9-22 修改 end -->
<!-- 红点js -->
<script type="text/javascript" src="../../js/red_point.js"></script>
<!-- 红点js -->
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
<!-- js结束 -->
</body>
</html>