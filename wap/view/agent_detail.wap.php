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
<title>订单详情</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg">
    <section class="indent-show-wrap">
        <div class="indent-show-item">
            <ul class="ident-show-item-part">
                <li>
                    <em>订单状态：</em><i><?php echo $order_list_array[$order_id]['state_desc']?></i>
                </li>
                <li>
                    <em>订单编号：</em><?php echo $order_list_array[$order_id]['order_sn']?>
                </li>
                <li>
                    <em>下单时间：</em><?php echo date("Y-m-d H:i:s",$order_list_array[$order_id]['add_time']);?>
                </li>
                <li>
                    <em>订单金额：</em>￥<?php echo $order_list_array[$order_id]['goods_amount']?>
                </li>

                <li>
                    <em>配送运费：</em> ￥0
                </li>
                <li>
                    <em>实付款：</em><i>￥<?php echo $order_list_array[$order_id]['order_amount']?></i>
                </li>
                
                <?php if($order_list_array[$order_id]['order_state']>=20){?>
      			<li>
                    <em>佣金收入：</em><i>￥<?php echo $commission;?></i>
                </li>
    			<?php }?>
                
				 <?php if($order_list_array[$order_id]['order_state']==10){?>
                   <li>
                    <em>预计佣金：</em><i>￥<?php echo ($order_list_array[$order_id]['order_amount']*$lv['sale_rate']/100);?></i>
                  </li>
                 <?php }?>
                <?php if($order_list_array[$order_id]['order_state']>=20){?>
  				 <li><em>支付方式：</em><?php echo $order_list_array[$order_id]['payment_name']?></li>
                <?php }?>
                <?php if($order_list_array[$order_id]['order_state']>=30){?>
                 <li class="has-right-btn">
                    <a href="index.php?act=deliver&order_id=<?php echo $order_id;?>">
                        <em>物流信息：</em>顺丰速运 <br/><br/>
                        <em>快递单号：</em><?php echo $order_list_array[$order_id]['shipping_code']?>
                    </a>
                 </li>
                <?php }?>

            </ul>
        </div>
        <div class="indent-show-item">
            <ul class="ident-show-item-info">
                <li>
                    联系人：<?php echo $order_list_array[$order_id]['extend_order_common']['reciver_name'];?>
                </li>
                <li>
                    电话：<?php echo substr_replace($phone,'*****',3,5)?>
                </li>
                <li>
                    收货地址：<?php echo $order_list_array[$order_id]['extend_order_common']['reciver_info']['address']?>
                </li>
            </ul>
        </div>
        <?php if(!empty($order_list_array[$order_id]['extend_order_common']['invoice_info'])){?>
            <div class="indent-show-item">
                <ul class="ident-show-item-info">
                    <li>
                        发票类型：<?php echo $order_list_array[$order_id]['extend_order_common']['invoice_info']['类型']?>
                    </li>
                    <li>
                        发票抬头：<?php echo $order_list_array[$order_id]['extend_order_common']['invoice_info']['抬头']?>
                    </li>
                    <li>
                        明细：<?php echo $order_list_array[$order_id]['extend_order_common']['invoice_info']['内容']?>
                    </li>
                </ul>
            </div>
        <?php }?>
        <div class="indent-show-item">
            <ul class="indent-item-list">
            <?php foreach($order_list_array[$order_id]['extend_order_goods'] as $v){?>
                <li>
                    <div class="indent-item-pic">
                        <img src="<?php echo $v['goods_image_url']?>"/>
                    </div>
                    <div class="c-item">
                    <h3>
                        <?php echo $v['goods_name']?>
                    </h3>
                      <p>
                            规格：<i><?php echo $v['norms']?></i>
                        </p>
                    </div>
                    <div class="r-price">
                    <p>
                        <i>￥<?php echo $v['goods_price']?></i>
                    </p>
                    <p>
                        <i>×<?php echo $v['goods_num']?></i>
                    </p>
                    </div>
                </li>
            <?php }?>
            </ul>
        </div>
        <footer class="foot">
            易享科技出品
        </footer>
    </section>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>