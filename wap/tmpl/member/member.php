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
<title>用户中心</title>
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css" >
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/gl-index.css" >
</head>
<body class="user-bg">
<div class="user-top">
    <h1>
        <p><span id="username"></span></p>

        <div class="user-photo"><div class="top_photo"><img src="" id="avatar"/></div></div>
    </h1>

</div>
<ul class="user-list">
    <li><a href="order_list.php" id="J_center"> <img src="<?php echo IMG_CDN_URL;?>/v12/img/user3.png">我的订单<span id="order_count"></span> </a></li>
    <li><a href="address_list.html"> <img src="<?php echo IMG_CDN_URL;?>/v12/img/user4.png">我的地址 </a></li>
    <li><a href=""> <img src="<?php echo IMG_CDN_URL;?>/v12/img/user5.png">我的发票 </a></li>
    <li><a href="index.php?act=member_favorites&op=favorites_list&fav_type=agent"> <img src="<?php echo IMG_CDN_URL;?>/v12/img/user2.png">我的收藏 </a></li>
    <li><a href="feedback.php"> <img src="<?php echo IMG_CDN_URL;?>/v12/img/user1.png">意见反馈 </a></li>
</ul>
<footer class="footer">
    易享科技出品
</footer>
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
    <script type="text/javascript" src="../../js/config.js"></script>
    <script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js"></script>
    <script type="text/javascript" src="../../js/template.js"></script>
    <script type="text/javascript" src="../../js/common.js"></script>
    <script type="text/javascript" src="../../js/tmpl/common-top.js"></script>
    <script type="text/javascript" src="../../js/tmpl/member.js"></script>
    <script type="text/javascript" src="../../js/tmpl/footer.js"></script>
        <!-- zhangyating 2014-9-22 修改 通用的分享功能-->
<script type="text/javascript" src="../../js/tmpl/shareWx.js"></script>
<!-- zhangyating 2014-9-22 修改 end -->
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
<script type="text/javascript" src="../../js/red_point.js?12222"></script>
</body>
</html>