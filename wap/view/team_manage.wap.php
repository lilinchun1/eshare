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
<title>团队管理</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="management-team-wrap">
    <section class="management-team-item">
        <h2 class="team-item-tt">今日</h2>
        <div class="team-item-data">
            <section class="team-item-data-left">
                <h2>团队人数</h2>
                <p><em>直属团队</em> <span class="font-yellow"><?php echo $father['count']?></span></p>
                <p><em>扩展团队</em> <span class="font-green"><?php echo $grand_father['count']?></span></p>
            </section>
            <section class="team-item-data-right">
                <h2>团队业绩 (￥)</h2>
                <p><em>直属团队</em><span class="font-yellow"><?php echo number_format($father['totalSales'],2);?></span></p>
                <p><em>扩展团队</em><span class="font-green"><?php echo number_format($grand_father['totalSales'],2);?></span></p>
            </section>
        </div>
    </section>
    <section class="management-team-item">
        <h2 class="team-item-tt">本周</h2>
        <div class="team-item-data">
            <section class="team-item-data-left">
                <h2>团队人数</h2>
                <p><em>直属团队</em> <span class="font-yellow"><?php echo $s1_agent_num_week?></span></p>
                <p><em>扩展团队</em> <span class="font-green"><?php echo $s2_agent_num_week?></span></p>
            </section>
            <section class="team-item-data-right">
                <h2>团队业绩 (￥)</h2>
                <p><em>直属团队</em><span class="font-yellow"><?php echo number_format($s1_order_amount_week,2);?></span></p>
                <p><em>扩展团队</em><span class="font-green"><?php echo number_format($s2_order_amount_week,2);?></span></p>
            </section>
        </div>
    </section>
    <section class="management-team-item">
        <h2 class="team-item-tt">本月</h2>
        <div class="team-item-data">
            <section class="team-item-data-left">
                <h2>团队人数</h2>
                <p><em>直属团队</em> <span class="font-yellow"><?php echo $s1_agent_num_month?></span></p>
                <p><em>扩展团队</em> <span class="font-green"><?php echo $s2_agent_num_month?></span></p>
            </section>
            <section class="team-item-data-right">
                <h2>团队业绩 (￥)</h2>
                <p><em>直属团队</em><span class="font-yellow"><?php echo number_format($s1_order_amount_month,2);?></span></p>
                <p><em>扩展团队</em><span class="font-green"><?php echo number_format($s2_order_amount_month,2);?></span></p>
            </section>
        </div>
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