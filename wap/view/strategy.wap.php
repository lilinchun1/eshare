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
<title>新手宝典</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg">
    <section class="faq-wrap">
<ul class="faq-list">
</ul>
<div class="add-more w100p" style="display:none">
      		 查看更多
   			 </div>
    </section>
</div>
<!-- zhangyating 2014-10-22 修改 通用的分享功能-->
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-10-22 修改 end -->
	<script type="text/javascript"
		src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>"
		charset="utf-8"></script>
	<script type="text/javascript"
		src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>"
		charset="utf-8"></script>
	<script type="text/javascript">
var html = "";
var more = 0;
getPageList(1);

$(".add-more").on(touchMethod, function(){
	getPageList(more);
});
function getPageList(page){
	var dateFormat = "";
	$(".add-more").hide();
	$.get("?act=document&op=articleAjax&ac_code=<?php echo $_GET['ac_code']?>&curpage="+page, function(result){
		var data = result.datas;
		if(data.status){
			var len = data.article_list.length;
			for(var i=0;i<len;i++){
				html += '<li><a href="index.php?act=document&op=detail_default&article_id='+data.article_list[i]['article_id']+'">'+data.article_list[i]['article_title']+'</a></li>'
				}
		}
	$(".faq-list").append(html);
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
