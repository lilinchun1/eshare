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
<title>佣金详情</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg">
    <section class="balance-wrap">
        <div class="indent-tool">
            <ul class="indent-tool-list balance-tool-list" id="sign">
                <li class="active" data-sign="0" ontouchstart="li(this)" >个 人<span>(<?php echo intval($my_count);?>)</span></li>
                <li class="" data-sign="1" ontouchstart="li(this)">直属团队<span>(<?php echo intval($s1_count);?>)</span></li>
                <li class="" data-sign="2" ontouchstart="li(this)">扩展团队<span>(<?php echo intval($s2_count);?>)</span></li>
            </ul>
        </div>
        <ul class="faq-list balance-list">
            <div id="more_goods"></div>
            <div id="next" class="add-more-order w100p" style="display:none">查看更多</div>
        </ul>
        <footer class="foot">
            易享科技出品
        </footer>
    </section>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript">
var itemHtml = "";
var more = 0;
var sign = 0;
var pageCount=1;
//获取sign值
function li(list){
	$(list).addClass("active").siblings().removeClass("active");
	$("#more_goods li").hide();
	sign=$(list).data('sign');
	getPageList(1,sign);
}
//滑动加载更多
$(window).scroll(function () {
	
	
	var scrollTop = $(this).scrollTop();
    var scrollHeight = $(document).height();
    var windowHeight = $(this).height();
     if (scrollTop + windowHeight >= scrollHeight && more<=pageCount) {
 	   getPageList(more,sign);
     }
});
$(function(){
	//初始加载
	getPageList(1,0);
})
//ajax加载
 function getPageList(page,state){
	  var url='index.php?act=agent_balance&op=ajax&state='+state;
	 	$.get(url, {'curpage':page}, function (result) {
	 		var data = result.datas;
	 		if(data.status){
				$.each(data.list_array,function(key,val){
	 			    var ctime = val['payment_time'];
					var itemHtml='';
					itemHtml='<li><a href="?act=agent_detail_balance&order_id='+val['order_id']+'"><p class="balance-list-p">订单编号：'+val['order_sn']+'<em>+'+val['bill_amount']+'</em></p><p>'+ctime+'</p></a></li>';
					$('#more_goods').append(itemHtml);
			    });
		    	pageCount=data.page_count;
// 			    if(page >= data.page_count || data.page_count==0){
// 					$("#next").hide();
// 			    }else{
// 					$("#next").show();
// 			    }   
			}else{
				itemHtml='<li><div class="indent-state indent-show-none">暂无佣金</div></li>';
			    $('#more_goods').append(itemHtml);
			    $("#next").hide();
		    }
		    more = page+1;
	 	},'json');
	 	

 }	 
</script>
<!-- 站长统计功能 -->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>