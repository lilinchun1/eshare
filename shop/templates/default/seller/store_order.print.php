<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <?php defined('InShopNC') or exit('Access Invalid!');?>
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/seller_center.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        body {
            background-color: #FFF;
            background-image: none;
        }
    </style>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.printarea.js" charset="utf-8"></script>
    <title><?php echo $output['store_info']['store_name'];?>发货单</title>
</head>

<body>
<?php if (!empty($output['order_info'])){?>

<div class="print-btn" id="printbtn" title="<?php echo $lang['member_printorder_print_tip'];?>"><i></i><a href="javascript:void(0);"><?php echo $lang['member_printorder_print'];?></a></div>
    <dl class="a5-tip">
        <dt>
        <h1>A5</h1>
        <em>Size: 210mm x 148mm</em></dt>
        <dd><?php echo $lang['member_printorder_print_tip_A5'];?></dd>
    </dl>
<div class="print-area" id="printarea">

	<?php foreach ($output['goods_list'] as $item_k =>$item_v){?>
    <div class="head-print">
        <img class="logo-print" src="<?php echo $output['store_info']['store_stamp'];?>" alt=""/>
        <img class="code-2-print" src="data:image/png;base64,<?php echo $output['img_64'];?>" alt=""/>
        <i class="code-wz"><?php echo $output['order_info']['order_sn'];?></i>
    </div>
    <div class="contact-info">
        <p>
            <span>收货人：<?php echo $output['order_info']['extend_order_common']['reciver_name'];?></span>
            <span class="fr tar">电话：<?php echo @$output['order_info']['extend_order_common']['reciver_info']['phone'];?></span>
        </p>
        <p>地址：<?php echo @$output['order_info']['extend_order_common']['reciver_info']['address'];?></p>
        <p>
            <span>订单号：<?php echo $output['order_info']['order_sn'];?></span>
            <span class="fr tar">下单时间：<?php echo @date('Y-m-d',$output['order_info']['add_time']);?></span>
        </p>
    </div>
    <ul class="dd-item-info">
        <li class="dd-item-info-tt">
            <span class="span-1">序号</span>
            <span class="span-2">商品名称</span>
            <span class="span-3">单价(元)</span>
            <span class="span-3">数量</span>
            <span class="span-3">小计(元)</span>
        </li>
        <?php foreach ($item_v as $k=>$v){?>
        <li>
            <span class="span-1"><?php echo $k;?></span>
            <span class="span-2"><?php echo $v['goods_name'];?></span>
            <span class="span-3"><?php echo $lang['currency'].$v['goods_price'];?></span>
            <span class="span-3"><?php echo $v['goods_num'];?></span>
            <span class="span-3"><?php echo $lang['currency'].$v['goods_all_price'];?></span>
        </li>
        <?php }?>
        <li class="heji">
            <span class="span-1"></span>
            <span class="span-4">合计</span>
            <span class="span-3"></span>
            <span class="span-3"><?php echo $output['goods_all_num'];?></span>
            <span class="span-3 fwb"><?php echo $lang['currency'].$output['goods_total_price'];?></span>
        </li>
    </ul>
    <div class="total">
        <p>
            <span>总计：<?php echo $lang['currency'].$output['goods_total_price'];?></span>
            <span>运费：<?php echo $lang['currency'].$output['order_info']['shipping_fee'];?></span>
            <span>优惠：<?php echo $lang['currency'].$output['promotion_amount'];?></span>
            <span class="fz16">订单总额：<b><?php echo $lang['currency'].$output['order_info']['order_amount'];?></b></span>
        </p>
    </div>
    <div class="xyl-phone">
		<?php echo $output['store_info']['store_printdesc'];?>
    </div>
    <?php }?>
</div>
<?php }?>
<input type="hidden" class="point_num_hid" value="<?php echo $output['store_info']['point_num'];?>">
<input type="hidden" class="order_id_hid" value="<?php echo $output['store_info']['order_id'];?>">
</body>
<script>
	$(function(){
		$("#printbtn").click(function(){
			//已打印次数
			var point_num = $(".point_num_hid").val();
			//是否确定打印
			var is_point = 0;
			if(point_num != 0){
				if(confirm("已打印 "+point_num+" 次，继续打印？")){
					is_point = 1;
				}
			}else if(point_num == 0){
				is_point = 1;
			}
			if(is_point == 1){
				var order_id = $(".order_id_hid").val();
				$.get("index.php?act=store_order_print&op=pointNumAdd",{'order_id':order_id},function(jieShou){
					$(".point_num_hid").val($(".point_num_hid").val()*1 + 1);
					$("#printarea").printArea();
				},"json");
			}
		});
	});

    //打印提示
    $('#printbtn').poshytip({
        className: 'tip-yellowsimple',
        showTimeout: 1,
        alignTo: 'target',
        alignX: 'center',
        alignY: 'bottom',
        offsetY: 5,
        allowTipHover: false
    });
</script>
</html>