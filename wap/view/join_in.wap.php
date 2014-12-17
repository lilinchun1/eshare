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
<title>邀请加盟</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap">
    <section class="join-in">
        <header class="join-in-header">
            <div class="pic-wrap">
                <a href="">
                    <img src="<?php echo getWxImg($agent_info['member_avatar'],"96");?>" alt=""/>
                </a>
            </div>
            <h2>
                <i><?php echo $agent_info['member_truename'];?></i>
                <span class="level-icon"><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level<?php echo $agent_info['level_id']; ?>.png" alt=""/></span>
            </h2>
            <h3>
                <?php echo $data['doc_title'];?>
            </h3>
            <button type="button" class="join-in-header-btn" onclick="location.href='<?php echo WAP_SITE_URL;?>/index.php?act=wxCap&op=agentRegist&channel_id=<?php echo $agent_info['channel_id'];?>&parent_id=<?php echo $agent_info['agent_id'];?>&joinFrom=joinFrom'">立即加盟</button>
        </header>
        <section class="join-in-con">
            <?php echo $data['doc_content'];?>
            <button type="button" class="join-in-con-btn" onclick="location.href='<?php echo WAP_SITE_URL;?>/index.php?act=wxCap&op=agentRegist&channel_id=<?php echo $agent_info['channel_id'];?>&parent_id=<?php echo $agent_info['agent_id'];?>&joinFrom=joinFrom'">立即加盟</button>
        </section>
    </section>
    <footer class="foot">
        易享科技出品
    </footer>
    <?php if(empty($_GET['shared'])){?>
    <div id="pop-up" onclick="document.getElementById('pop-up').style.display='none';">
        <div class="pop"></div>
    </div>
    <?php }?>
</div>
<script type="text/javascript">
//var mobileUrl = "http://115.28.104.209/b2b2c/wap";
var WapSiteUrl = "<?php echo WAP_SITE_URL;?>";
var agent_id = "<?php echo $agent_info['agent_id'];?>";
var title = "<?php echo $agent_info['member_truename'];?>邀请您一起加入新玉麟金手指计划，成就辉煌梦想！";
var content = "分享创造价值，动动手指就能赚钱！新玉麟海参微电商平台诚招创业加盟！";
var img = "<?php echo $agent_info['member_avatar'];?>";
var urlShare = WapSiteUrl+"/index.php?act=document&op=join_in_out&agent_id="+agent_id+"&shared=111";

window.shareData = {
	"imgUrl": img,
	"timeLineLink": urlShare,
	"sendFriendLink": urlShare,
	"weiboLink": urlShare,
	"tTitle": title,
	"tContent": content,
	"fTitle": title,
	"fContent": content,
	"wContent": content
};
</script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>