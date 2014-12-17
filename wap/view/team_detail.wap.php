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
<title>直属团队个人主页</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="management-show-wrap">
    <header class="head management-head">
        <div class="head-left">
            <div class="pic-wrap">
                <a href="">
                    <img src="<?php echo getWxImg($agent_info['member_avatar'],"132");?>" alt=""/>
                </a>
            </div>
        </div>
        <div class="head-right">
            <h1 class="head-shop-tt">
                <em><?php echo $agent_info['member_truename'];?></em>
                	<span class="gl-shop-tt"  >
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level<?php echo $agent_info['level_id'];?>.png<?php echo STATIC_VER;?>"   alt=""/>
                </span>
               
            </h1>
            <!--  
            <h2 class="class">
                类别：生鲜
            </h2>
            -->
        </div>
    </header>
    <div class="mod-line"></div>
    <section class="management-con">
        <ul class="management-list">
            <li>
                <em>手机号</em>
                <i><?php echo $agent_info['member_mobile'];?></i>
            </li>
    <!--          <li>
                <em>所属机构</em>
                <i><?php echo $channel_name;?></i>
            </li>
     -->
            <li>
                <em>直属团队</em>
                <i class="font-yellow"><?php echo $totalNum['fatherCount'];?></i>
            </li>
   <!--           <li>
                <em>扩展团队</em>
                <i class="font-green"><?php echo $totalNum['grandFatherCount'];?></i>
            </li>
   -->
            <li>
                <em>个人业绩(￥)</em>
                <i class="font-yellow"><?php echo $agent_info['total_sales'];?></i>
            </li>
            <li>
                <em>直属团队业绩(￥)</em>
                <i class="font-yellow"><?php echo $totalNum['father_sales'];?></i>
            </li>
          <li>
                <em>成员加入时间</em>
                <i class="font-green"><?php echo date("Y-m-d H:i:s",$agent_info['member_time']);?></i>
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