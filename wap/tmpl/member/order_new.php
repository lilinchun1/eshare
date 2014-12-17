<?php 
$is_weixin = is_weixin();	
function is_weixin(){  
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {  
            return true;  
    }    
    return false;  
} ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新玉麟</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/member.css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <div class="sub_top border_w">
  <div class="border_g"> <a href="javascript:history.go(-1);">返回</a><div class="gy_top">订单支付</div> </div>
</div>
    <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']?>" />
    <div class="order-list-wp" id="order-list"></div>
    <script type="text/html" id="order-list-tmpl">
        <div class="order-list">
            <%if (order_group_list.length >0){%>
                <ul>
                    <%for(var i = 0;i<1;i++){
                        var orderlist = order_group_list[i].order_list;
                    %>
                        <li class="<%if(order_group_list[i].pay_amount){%>green-order-skin<%}else{%>gray-order-skin<%}%> <%if(i>0){%>mt10<%}%>">
                            
                            <% for(var j = 0;j<orderlist.length;j++){
                                var order_goods = orderlist[j].extend_order_goods;
                            %>
                            	<div class="order-ltlt iadd-hightadd">
                                <p>
                                    下单时间：
                                  <%=orderlist[j].agent_time%>
                                </p>
                            </div>
                                <div class="order-lcnt backbg">
                                    <div class="order-lcnt-shop">
                                        <p>店铺名称：<%=orderlist[j].agent_name%></p>
                                        <p>订单编号：<%=orderlist[j].order_sn%></p>
                                    </div>
                                    <div class="order-shop-pd">
                                        <%for (var k = 0;k<order_goods.length;k++){%>
                                        <a class="order-ldetail clearfix <%if(k>0){%>bd-t-de<%}%>" href="<%=WapSiteUrl%>/index.php?act=product&goods_id=<%=order_goods[k].goods_id%>&agent_id=<%=orderlist[j].agent_id%>">
                                            <span class="order-pdpic">
                                                <img src="<%=order_goods[k].goods_image_url%>"/>
                                            </span>
                                            <div class="order-pdinfor">
                                                <p><%=order_goods[k].goods_name%></p>
                                                <p>
                                                    单价：<span class="clr-d94">￥<%=order_goods[k].goods_price%></span>
                                                </p>
                                                 <p>
                                                    商品数量：<%=order_goods[k].goods_num%>
                                                </p>
                                            </div>
                                        </a>
                                        <%}%>
                                    </div>
                                    <div class="order-shop-total">
                                    
                                        <p class="clr-c07">合计：￥<%=orderlist[j].order_amount%> </p>
                                        <p class="mt5">
                                            <%
                                                var stateClass ="ot-finish";
                                                var orderstate = orderlist[j].order_state;
                                                if(orderstate == 20 || orderstate == 30 || orderstate == 40){
                                                    stateClass = stateClass;
                                                }else if(orderstate == 0) {
                                                    stateClass = "ot-cancel";
                                                }else {
                                                    stateClass = "ot-nofinish";
                                                }
                                            %>
                                    
                                        </p>
                                    </div>  		
                                </div>
                                			
                            <%}%>
                           <div class="zffs border_w iadd-hightadd" style=" background: none repeat scroll 0 0 #fffdf7">
	<div class="border_g ">
	<h4>支付方式</h4>
	<ul>
		<?php if($is_weixin){?>					
			<li><label class="mt5" id="offline"><input type="radio" name="buy-type" class="mr5" checked value="2"/>微信支付</label></li>
		<?php } ?>	
		<li><label id="online"><input type="radio" name="buy-type" class="mr5 rdo" value="1">支付宝</label></li>
	</ul>
	</div>
</div> 
                           <div> 
                            <%if(order_group_list[i].pay_amount && order_group_list[i].pay_amount>0){%>
                                <a class="l-btn-login iadd-hightadd" onclick="pay_('<%=ApiUrl %>','<%=key %>','<%=order_group_list[i].pay_sn %>')">订单支付</a>
                                <!-- 
                                <a href="<%=ApiUrl %>/index.php?act=member_payment&op=pay&key=<%=key %>&pay_sn=<%=order_group_list[i].pay_sn %>" class="l-btn-login iadd-hightadd">订单支付</a>
                                -->
                            <%}%>
                            		</div>
                        </li>
                    <%}%>
                </ul>
                <!--
                <div class="pagination mt10">
                    <a href="javascript:void(0);" class="pre-page <%if(curpage <=1 ){%>disabled<%}%>">上一页</a>
                    <a href="javascript:void(0);" has_more="<%if (hasmore){%>true<%}else{%>false<%}%>"  class="next-page <%if (!hasmore){%>disabled<%}%>">下一页</a>
                </div>
                -->
            <%}else {%>
                <div class="no-record">
                    暂无记录
                </div>
            <%}%>
        </div>
    </script>
    <br/><br/><br/>
        <div class="strip_top position topBox ">
    <ul class="ul">
      <li class="left right"> <a href="../../tmpl/member/member.php?act=member">
        <div class="pro_pen"></div>
        <div class="pro_sea_1">用户中心</div>
        </a> </li>
      <li class="left"> <a href="../../tmpl/cart_list.html">
        <div class="pro_car"></div>
        <div class="pro_sea_1">购物车</div>
        </a> </li>
    </ul>
  </div>
    <script type="text/javascript" src="../../js/zepto.min.js"></script>
    <script type="text/javascript" src="../../js/template.js"></script>
    <script type="text/javascript" src="../../js/config.js"></script>
    <script type="text/javascript" src="../../js/common.js"></script>
    <script type="text/javascript" src="../../js/tmpl/common-top.js"></script>
    <script type="text/javascript" src="../../js/tmpl/footer.js"></script>
    <script type="text/javascript" src="../../js/tmpl/order_new.js"></script>
<!-- zhangyating 2014-9-22 修改 通用的分享功能-->
<script type="text/javascript" src="../../js/tmpl/shareWx.js"></script>
<!-- zhangyating 2014-9-22 修改 end -->
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
<script type="text/javascript" src="../../js/red_point.js?41194945"></script>
</body>
</html>