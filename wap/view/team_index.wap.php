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
<title>我的团队</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="management-my-wrap">
    <section class="management-team-item my-wrap-item">
        <h2 class="team-item-tt">
            团队人数
            <span class="font-yellow"><?php echo $totalNum['totalCount'];?></span>
            <span class="wenhao" onclick="location.href='<?php echo WAP_SITE_URL ?>/index.php?act=document&op=setting&doc_code=team_about'">?</span>
        </h2>
        <div class="team-item-data">
            <section class="team-item-data-left">
                <h2>
                    直属团队
                </h2>
                <p>
                    <span class="font-yellow"><?php echo $totalNum['fatherCount'];?></span>
                </p>
            </section>
            <section class="team-item-data-right">
                <h2>扩展团队</h2>
                <p>
                    <span class="font-green"><?php echo $totalNum['grandFatherCount'];?></span>
                </p>
            </section>
        </div>
    </section>
    <section class="management-team-item my-wrap-item">
        <h2 class="team-item-tt">
            团队业绩(￥)
            <span class="font-yellow"><?php echo number_format($totalNum['totalNum'],2);?></span>
        </h2>
        <div class="team-item-data">
            <section class="team-item-data-left">
                <h2>
                    直属团队业绩
                </h2>
                <p>
                    <span class="font-yellow"><?php echo number_format($totalNum['father_sales'],2);?></span>
                </p>
            </section>
            <section class="team-item-data-right">
                <h2>扩展团队业绩</h2>
                <p>
                    <span class="font-green"><?php echo number_format($totalNum['grand_sales'],2);?></span>
                </p>
            </section>
        </div>
    </section>
    <div class="management-my-btns"><?php ?>
        <button type="button" class="left-btn" onclick="location.href='<?php echo WAP_SITE_URL ?>/index.php?act=document&op=join_in_out&agent_id=<?php echo $agent_id;?>'">邀请加盟</button>
        <a href="<?php echo WAP_SITE_URL ?>/index.php?act=agent&op=team_manage"><button type="button" class="right-btn">团队管理</button></a>
    </div>
    <h2 class="my-team-tt">直属团队明细</h2>
    <ul class="my-team-list">
    <!--  
        <li>
            <div class="my-team-list-pic">
                <img src="<?php echo IMG_CDN_URL;?>/v12/img/head-pic.jpg" alt=""/>
            </div>
            <p>
                <span>张某</span>
                <span class="level-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level1.jpg" alt=""/>
                </span>
            </p>
            <p class="mgt4">
                业绩(￥) 1000.00
            </p>
            <div class="team-list-right-btn">
                &gt;
            </div>
        </li>
        <li>
            <div class="my-team-list-pic">
                <img src="<?php echo IMG_CDN_URL;?>/v12/img/head-pic.jpg" alt=""/>
            </div>
            <p>
                <span>张某</span>
                <span class="level-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level2.jpg" alt=""/>
                </span>
            </p>
            <p class="mgt4">
                业绩(￥) 1000.00
            </p>
        </li>
        <li>
            <div class="my-team-list-pic">
                <img src="<?php echo IMG_CDN_URL;?>/v12/img/head-pic.jpg" alt=""/>
            </div>
            <p>
                <span>张某</span>
                <span class="level-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level3.jpg" alt=""/>
                </span>
            </p>
            <p class="mgt4">
                业绩(￥) 1000.00
            </p>
            <div class="left-btn">
                &gt;
            </div>
        </li>
        <li>
            <div class="my-team-list-pic">
                <img src="<?php echo IMG_CDN_URL;?>/v12/img/head-pic.jpg" alt=""/>
            </div>
            <p>
                <span>张某</span>
                <span class="level-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level4.jpg" alt=""/>
                </span>
            </p>
            <p class="mgt4">
                业绩(￥) 1000.00
            </p>
        </li>
        <li>
            <div class="my-team-list-pic">
                <img src="<?php echo IMG_CDN_URL;?>/v12/img/head-pic.jpg" alt=""/>
            </div>
            <p>
                <span>张某</span>
                <span class="level-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level5.jpg" alt=""/>
                </span>
            </p>
            <p class="mgt4">
                业绩(￥) 1000.00
            </p>
        </li>
        <li>
            <div class="my-team-list-pic">
                <img src="<?php echo IMG_CDN_URL;?>/v12/img/head-pic.jpg" alt=""/>
            </div>
            <p>
                <span>张某</span>
                <span class="level-icon">
                    <img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level6.jpg" alt=""/>
                </span>
            </p>
            <p class="mgt4">
                业绩(￥) 1000.00
            </p>
        </li>
        -->
        
    </ul>
   	<div class="add-more w100p" style="display:none">
      		 查看更多
   			 </div>
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
<script type="text/javascript">
var html = "";
var more = 0;
getPageList(1);

$(".add-more").on(touchMethod, function(){
	getPageList(more);
});

function getPageList(page){
	$(".add-more").hide();
	$.get("?act=agent&op=dir_detail&curpage="+page, function(result){
		var data = result.datas;
		if(data.status){
			var len = data.agent_info.length;
			for(var i=0;i<len;i++){
				html +='<li><a href="<?php echo WAP_SITE_URL ?>/index.php?act=agent&op=team_detail&agent_id='+data.agent_info[i]['agent_id']+'"><div class="my-team-list-pic"><img src="'+data.agent_info[i]['member_avatar']+'" alt=""/></div><p><span>'+data.agent_info[i]['member_truename']+'</span><span class="level-icon"><img src="<?php echo IMG_CDN_URL;?>/v12/img/level/level'+data.agent_info[i]['level_id']+'.png" alt=""/></span></p><p class="mgt4"> 业绩(￥) '+data.agent_info[i]['total_sales']+'</p><div class="team-list-right-btn"></div><a></li>';
			}
		}
	if(data.agent_info.length == 0){
			html = '<div class="my-team-list my-team-list-none"></div>';
		}
	$(".my-team-list").append(html);
	html = "";
	more = page+1;
	if(page >= data.totalPage || data.totalPage==0){
		$(".add-more").hide();
		}else{
		$(".add-more").show();
			}
		
	}, 'json');
}


</script>
</body>
</html>