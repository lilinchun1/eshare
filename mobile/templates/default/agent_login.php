<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>WEKA</title>

<link href="<?php echo MOBILE_SITE_URL;?>/templates/default/css/style_ragister.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="min">
<div class="input_white input margin_top">
    <div class="input_gren">
        <div class="input_white">
            <div class="input_1">
                <input type="text"  placeholder="用户名"  name="member_name" class="input_0"> 
            </div>
            <div class="input_2">
                <input type="password"  placeholder="密码"  name="member_passwd" class="input_0">
            </div>
        </div>
    </div>
</div>
<div class="width">
    	<a class="red" href="#">登陆</a>
    	<a class="green" href="<?php echo MOBILE_SITE_URL;?>/index.php?act=agent&op=agent_phonecheck&channel_qrcode=<?php echo $output['channel_qrcode']?>&store_id=<?php echo $output['store_id'];?>&is_agent=<?php echo $output['is_agent'];?>">申请开店</a>  
</div> 
<div class="yixiangBox">
  <div class="yixiang">易享科技出品</div>
</div>
</div>
</body>
</html>

