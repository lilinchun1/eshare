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
<title>系统提示</title>
<link href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>" rel="stylesheet" type="text/css" />
</head>
<body>
 <div class="box-wrap wrap-bg">
    <div class="contact-us-item">
      <p class="" style="text-align: center; width: 20%;"><img src="<?php echo IMG_CDN_URL;?>/v12/img/iconfont-<?php if($id){echo "check";}else{echo "warn";}?>.png<?php echo STATIC_VER;?>" /></p>
      <p style="text-align: center; font-weight:bold;"><?php echo $message;?></p>
      <p></p>

      <p style="text-align: center;"> 关注新玉麟海参微信公众号可对店铺进行高效管理。 </p>
      <div>
        <p style="text-align: center;">点击关注公众号:<a href="http://mp.weixin.qq.com/s?__biz=MzA5Mzg3MTYzNw==&mid=200945758&idx=1&sn=d5dfaf5b91a5a9278897d48c47869bed#rd" style="color: #016cc6;">xinyulinhs</a></p>
        <p style="text-align: center;" ><a href="<?php echo WAP_SITE_URL?>/index.php?act=agent" style="color: #016cc6;">进入店铺管理中心</a></p>
      </div>
    </div>
    <footer class="foot">
      易享科技出品
    </footer>
    </div>
    
</body>
</html>