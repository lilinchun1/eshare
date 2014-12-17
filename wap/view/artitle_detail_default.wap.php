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
<?php if($data['ac_id']=='8'){?>
<title>新手宝典</title>
<?php }else{?>
<title>系统设置</title>	
<?php }?>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css"/>
</head>
<body>
<div class="box-wrap">
    <section class="show-wrap">
        <h1><?php echo $data['article_title']?></h1>
        <time>发布日期：<?php echo date('Y-m-d H:i:s',$data['article_time'])?></time>
       <?php echo $data['article_content']?>
        <footer class="foot">
            易享科技出品
        </footer>
    </section>
</div>

<!-- zhangyating 2014-10-22 修改 通用的分享功能-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 end -->

<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>
