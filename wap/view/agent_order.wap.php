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
<title>订单管理</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>

<div class="box-wrap wrap-bg">
  <section class="indent-wrap">
    <div class="indent-tool">
      <ul class="indent-tool-list" id="sign">
        <li class="active" data-sign="0" ontouchstart="li(this)">全 部<span>(<?php echo $count_0;?>)</span></li>
        <li class="" data-sign="10" ontouchstart="li(this)">待付款<span>(<?php echo $count_10;?>)</span></li>
        <li class="" data-sign="20" ontouchstart="li(this)">待发货<span>(<?php echo $count_20;?>)</span></li>
        <li class="" data-sign="30" ontouchstart="li(this)">已发货<span>(<?php echo $count_30;?>)</span></li> 
      </ul>
    </div>
    <div id="more_goods"></div>
    <div id="next" class="add-more-order w100p" style="display:none" >
查看更多
    </div>
    <footer class="foot"> 易享科技出品 </footer>
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

	$(function(){
		$(".indent-wrap").on("click", ".add-more", function(){
		  
		  if($(this).hasClass("up-btn")){
			$(this).removeClass("up-btn");
			$(this).parent().find('ul').addClass('list-min-heigit')
		   
		  }else{
			$(this).addClass("up-btn");
			$(this).addClass("list-min-heigit");
			$(this).parent().find('ul').removeClass('list-min-heigit')
		  }
		  
		});
	});
	
	//var pagecounts='<?php echo $count_sum?>';
	//var pagecount='<?php echo $page_count?>';
// 	if(pagecount<2){
// 		$("#next").hide();
// 	}
// 	var page='1';
	//qinwei
	function cancel_order(id){
		var url='index.php?act=agent_order&op=cancel_order&order_id='+id;
		$.getJSON(url,function (data) {
			$("#_"+id).hide("slow"); 
		})										 
	}
	//qinwei
	function getPageList(page,state){
		//$("#next").hide();
		var url='index.php?act=agent_order&op=more&state='+state;
		$.get(url, {'curpage':page}, function (result) {	
			//$("#next").show();
			var data = result.datas;
		if(data.status){
			$.each(data.new_order_group_list,function(key,val){
				$.each(val['order_list'],function(m_key,m_val){
					var count_num = 0;
					var count_order = 0;
					itemHtml='<li><div class="indent-state" id="_'+m_val['order_id']+'">';
					itemHtml +='<h2 class="indent-number">';
					itemHtml +='<em>订单编号 ：</em><i>'+m_val['order_sn']+'</i> <span>'+m_val['class']+'</span></h2>';
					itemHtml +='<a href="?act=agent_detail&order_id='+m_val['order_id']+'"><ul class="indent-item-list list-min-heigit">';
						$.each(m_val['extend_order_goods'],function(v_key,v_val){
							count_num = parseInt(v_val['goods_num'])+parseInt(count_num);
							count_order = parseInt(count_order)+1;
							itemHtml +='<li><div class="indent-item-pic"><img src="'+v_val['goods_image_url']+'"/></div><div class="c-item"><h3>'+v_val['goods_name']+'</h3><p>规格：<i>'+v_val['norms']+'</i></p></div><div class="r-price"><p><i>￥'+v_val['goods_price']+'</i> </p><p><i>×'+v_val['goods_num']+'</i></p></div></li>';
						 })
					itemHtml +='</ul></a><div class="total">共计'+count_num+'件 <em>实付款：<i>￥'+m_val['order_amount']+'</i></em></div>';
					
					if(count_order>1){
						itemHtml +='<div class="add-more"><span></span></div>';
					}
					
					if(m_val['order_state'] ==0 || +m_val['order_state']  >= 30){
						itemHtml +='<div class="indent-btns">';
					}else{
						itemHtml +='<div>';
					}
					
					if(m_val['order_state'] == 0 || m_val['order_state'] == 40){
						itemHtml +='<button  class="left-btn" onClick="cancel_order('+m_val['order_id']+')">删除订单</button>';    
					}
					if(m_val['order_state'] >= 30){
						itemHtml +='<a href="index.php?act=deliver&order_id='+m_val['order_id']+'"><button type="button" class="right-btn">查看物流</button></a>';    
					}
				   itemHtml +='</div></div></li>'
					   	
				})
				$('#more_goods').append(itemHtml);	
// 				if(page >= data.page_count || data.page_count==0){
// 					$("#next").hide();
// 			    }else{
// 					$("#next").show();
// 			    }  
			});
		}else{
			itemHtml='<li><div class="indent-state indent-show-none">暂无内容</div></li>';
		    $('#more_goods').append(itemHtml);
		    $("#next").hide();
		} 
		pageCount=data.page_count;
	    more = page+1;
			
	},'json');
}

</script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</body>
</html>
