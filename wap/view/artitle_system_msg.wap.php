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
<title>系统消息</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<div class="box-wrap wrap-bg">
    <section class="balance-wrap message-wrap">
        <ul class="faq-list balance-list message-list">
        </ul>
    </section>
    <div class="add-more" style="display:none">
       查看更多
    </div>
    <footer class="foot">
        易享科技出品
    </footer>
</div>
<script id="T_artItem" type="text/html">
<% for (i in article_list) { %>
<li data-id="<%=article_list[i].article_id %>">
    <a data-url="?act=document&op=detail_default&article_id=<%=article_list[i].article_id %>">
        <span class="message-date <%=viewdClass(article_list[i].article_id)%>"><%=article_list[i].article_time %></span>
        <p class="balance-list-p"><%=article_list[i].article_title %></p>
        <p><%=article_list[i].article_content %></p>
    </a>
</li>
<% } %>
</script>

<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/template.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- 分页加载 -->
<script type="text/javascript">
var notice = getstorage("notice"), viewIds = [], more = 1;
try{
	notice  = JSON.parse(notice);
	viewIds = notice.view_msgid.split(",");
}catch(e){
	notice  = {};
	viewIds = [];
}
template.helper("viewdClass", function(artid){
	if(contains(viewIds, artid)){
		return "";
	}else{
		return " message-date2";
	}
});
</script>

<script type="text/javascript">
$(function(){
	getPageList(1);

	$(".add-more").on(touchMethod, function(){
		getPageList(more);
	});

	$(".message-list").on(touchMethod, "a", function(e){
		e.preventDefault();
	});

	$(".message-list").on(touchMethod, "li", function(e){
		var aid = $(this).data("id"), href = $(this).find("a").data("url");

		if($(this).find("span").hasClass('message-date2')){
			viewIds[viewIds.length] = aid;
			viewIds = unique(viewIds);
			notice.view_msgid = viewIds.join(",");

			$.post("?act=statist&op=setNotice&uid=<?php echo $agent_id;?>", {"view_msgid":aid}, function(result){
				var json = result.datas;
				if(json.status){
					setstorage("notice", JSON.stringify(notice));
				}
				location.href = href;
			}, 'json');
		}else{
			location.href = href;
		}
	});
});
/* 分页加载 */
function getPageList(page){
	$.get("?act=document&op=articleAjax&ac_code=<?php echo $_GET['ac_code']?>&curpage="+page, function(result){
		var data = result.datas;
		if(data.status){
			$(".message-list").append(template("T_artItem",data));

			more = page+1;
			if(page == data.totalPage){
				$(".add-more").hide();
			}else{
				$(".add-more").show();
			}
		}else{
			$(".message-list").append('<center style="padding:20px 0">系统错误，请重试</center>');
		}

	}, 'json');
}
/* 数组唯一性 */
function unique(arr) {
    var result = [], hash = {};
    for (var i = 0, elem; (elem = arr[i]) != null; i++) {
        if (elem && !hash[elem]) {
            result.push(elem);
            hash[elem] = true;
        }
    }
    return result;
}
</script>

<!-- 站长统计 -->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>
