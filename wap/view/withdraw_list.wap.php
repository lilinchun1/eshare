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
<title>提现记录</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg">
    <section class="draw-money-list-wrap">
        <section class="draw-money-form">
            <div class="select-wrap">
                <select class="select-draw-con" id="year">
                <?php for ($i = 2014; $i < 2031; $i++) {?>
                    <option value="<?php echo $i;?>" <?php if($i == $year){echo 'selected="selected"';}?>><?php echo $i."年";?></option>
                    <?php }?>
                </select>
                <div class="logo">
                    <span></span>
                </div>
            </div>
            <div class="select-wrap">
                <select class="select-draw-con" id="month">
                    <option value="0">请选择月份</option>
                    <?php for ($i = 1; $i < 13; $i++) {?>
                    <option value="<?php echo $i;?>"><?php echo $i."月";?></option>
                    <?php }?>
                </select>
                <div class="logo">
                    <span></span>
                </div>
            </div>
            <button class="draw-money-btn" onclick="getPageList(1,1);">查 询</button>
        </section>
        <ul class="draw-money-list">
        </ul>
        <div class="add-more w100p" style="display:none">
      		 查看更多
   			 </div>
        <footer class="foot">
            易享科技出品
        </footer>
    </section>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 通用的分享功能-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 end -->
<script type="text/javascript">
var html = "";
var more = 0;
getPageList(1,0);
$(".add-more").on(touchMethod, function(){
	getPageList(more);
});
function getPageList(page,count){
	if(count == 1){
		$(".draw-money-list").html("");
	}
	var year = $("#year").val();
	var month = $("#month").val();
	$(".add-more").hide();
	$.get("?act=agent_income&op=withdraw_list_ajax&year="+year+"&month="+month+"&curpage="+page, function(result){
		var data = result.datas;
		if(data.status){
			var len = data.withdraw_list.length;
			for(var i=0;i<len;i++){
				var type = data.withdraw_list[i]['apply_status'];
				var say = "";
				var classs = ""
				if(type == 1){
					say = "提现成功";
					classs ="draw-money-true";
				}
				
				if(type == 2){
					say = "提现失败";
					classs ="draw-money-false";
					}
				html += '<li><a href="?act=agent_income&op=withdraw_detail&apply_id='+data.withdraw_list[i]['apply_id']+'"><p><span class='+classs+'>'+say+'</span><i>'+data.withdraw_list[i]['apply_money']+'元</i></p><p>'+data.withdraw_list[i]['apply_time']+'</p></a></li>';
				}
		}
		if(data.withdraw_list.length == 0){
			html = '<div class="indent-state indent-show-none">暂无记录</div>';
		}
	$(".draw-money-list").append(html);
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
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>