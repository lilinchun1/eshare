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
    <title>升级规则</title>
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="schedule-wrap">
    <section class="schedule-item">
        <h2 class="schedule-item-tt">
            <em>当前等级：</em><span class="logo-v"><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level<?php echo $agent_info['level_id'];?>.png" alt=""/></span>
        </h2>
        <ul class="s-leve-list">
            <li><span><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/s-leve1.png" alt=""/></span></li>
            <li><span><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/s-leve2.png" alt=""/></span></li>
            <li><span><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/s-leve3.png" alt=""/></span></li>
            <li><span><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/s-leve4.png" alt=""/></span></li>
            <li><span><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/s-leve5.png" alt=""/></span></li>
            <li><span><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/s-leve6.png" alt=""/></span></li>
        </ul>
        <ul class="leve-bar">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li class="progress-bar" style="width: <?php echo $scale;?>%"></li>
        </ul>
        <div class="alert-con pz<?php echo $agent_info['level_id']==6?5:$agent_info['level_id'];?>">
            <?php echo $say;?>
        </div>
    </section>
    <section class="schedule-item">
        <h2 class="schedule-item-tt bdbn">
            <em>升级收益</em>
        </h2>
        <ul class="level-rule">
             <li>
                <span class="col-1">V1</span>
                <span class="col-2">个人营业额的20%</span>
                <span class="col-2">－－</span>
                <span class="col-3">－－</span>
            </li>
             <li>
                <span class="col-1">V2</span>
                <span class="col-2">个人营业额的21%</span>
                <span class="col-2">直属团队营业额的3%</span>
                <span class="col-3">－－</span>
            </li>
            <li>
                <span class="col-1">V3</span>
                <span class="col-2">个人营业额的22%</span>
                <span class="col-2">直属团队营业额的4%</span>
                <span class="col-3">扩展团队营业额的2％</span>
            </li>
            <li>
                <span class="col-1">V4</span>
                <span class="col-2">个人营业额的23%</span>
                <span class="col-2">直属团队营业额的5%</span>
                <span class="col-3">扩展团队营业额的3％</span>
            </li>
             <li>
                <span class="col-1">V5</span>
                <span class="col-2">个人营业额的23%</span>
                <span class="col-2">直属团队营业额的6%</span>
                <span class="col-3">扩展团队营业额的4％</span>
            </li>
            <li>
                <span class="col-1">V6</span>
                <span class="col-2">个人营业额的23%</span>
                <span class="col-2">直属团队营业额的7%</span>
                <span class="col-3">扩展团队营业额的5％</span>
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