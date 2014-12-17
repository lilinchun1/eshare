<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title></title>
</head>
<body>
取消订单异常
<table>
<tr><td>订单id</td><td>商户订单号-out_trade_no</td><td>订单号-trade_no</td><td>支付方式</td><td>操作</td></tr>
<?php
if($agent_info1){
 foreach($agent_info1 as $v){
 ?>
<tr><td><?php echo $v['order_id'];?></td><td><?php echo $v['pay_sn'];?></td><td><?php echo $v['trade_no'];?></td><td><?php if($v['is_wxpay']){$payment_code="wxpay";echo "微信支付";}else{$payment_code="alipay";echo "支付宝支付";}?></td><td style="color: red;">不可修复</td></tr>
<?php }}else{?>
<tr><td>没有记录</td></tr>
<?php }?>
</table>
未支付异常
<table>
<tr><td>订单id</td><td>商户订单号-out_trade_no</td><td>订单号-trade_no</td><td>支付方式</td><td>操作</td></tr>
<?php
if($agent_info){
 foreach($agent_info as $v){
 ?>
<tr><td><?php echo $v['order_id'];?></td><td><?php echo $v['pay_sn'];?></td><td><?php echo $v['trade_no'];?></td><td><?php if($v['is_wxpay']){$payment_code="wxpay";echo "微信支付";}else{$payment_code="alipay";echo "支付宝支付";}?></td><td><button onclick="location.href='<?php echo $u;?>act=request&op=list&payment_code=<?php echo $payment_code;?>&trade_no=<?php echo $v['trade_no']?>&pay_sn=<?php echo $v['pay_sn']?>'">修复</button></td></tr>
<?php }}else{?>
<tr><td>没有记录</td></tr>
<?php }?>
</table>
</body>
</html>