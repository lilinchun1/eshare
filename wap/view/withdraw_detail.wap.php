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
<title>提现明细</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg">
    <section class="draw-money-show-wrap">
        <ul class="draw-money-show-list">
            <li>
                <em>申请人：</em>
                <span><?php echo $apply_info['apply_name']?></span>
            </li>
            <li>
                <em>申请金额(￥)：</em>
                <span><?php echo $apply_info['apply_money']?></span>
            </li>
            <li>
                <em>提现银行卡：</em>
                <span>广发银行  储蓄卡 <?php echo $apply_info['apply_name']?></span>
                <span> <?php echo '***************'.substr($apply_info['apply_bankcard'],strlen($apply_info['apply_bankcard'])-4,strlen($apply_info['apply_bankcard']));?></span>
            </li>
            <li>
                <em>申请时间：</em>
                <span><?php echo date("Y-m-d H:i:s",$apply_info['apply_time']);?></span>
            </li>
            <li>
                <em>结束时间：</em>
                <span><?php echo date("Y-m-d H:i:s",$apply_info['return_time']);?></span>
            </li>
            <li>
                <em>提现状态：</em>
                <span class="<?php if($apply_info['apply_status'] == 2){echo 'red-font';}else{echo '';}?>"><?php if($apply_info['apply_status'] == 1){echo "提现成功";}else if($apply_info['apply_status'] == 2){echo "提现失败";}?></span>
                <span class="red-font draw-info"><?php if($apply_info['apply_status'] == 2){echo $apply_info['apply_result'];}?></span>
            </li>
        </ul>
    </section>
      <footer class="foot">
        易享科技出品
    </footer>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 通用的分享功能-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 end -->
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>