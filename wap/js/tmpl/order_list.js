var page = pagesize;
var curpage = 1;
var hasMore = true;
var type_load = 0;


	var key = getcookie('key');
	if(key==''){
		//zhangyating 2014-9-17 判断是否是微信浏览器
		if(isWeiXin()){
			location.href = WapSiteUrl+'/index.php?act=wxCap&op=memberLogin';
		}else{
			window.location.href = WapSiteUrl+'/tmpl/member/login.html';
		}
	}
	
	function initPage(page,curpage,type){
		type_load = type;
		//alert(type_load);
		$(".check-more-btn").hide();
		$(".add-more").show();
		page = pagesize;
		$.ajax({
			type:'post',
			url:ApiUrl+"/index.php?act=member_order&op=order_list&page="+page+"&curpage="+curpage,	
			data:{key:key,order_state:type},
			dataType:'json',
			success:function(result){
				checklogin(result.login);//检测是否登录了
				var data = result.datas;
				//console.log(data.count_num);
				var count_num = data.count_num;
				data.hasmore = result.hasmore;//是不是可以用下一页的功能，传到页面里去判断下一页是否可以用
				data.WapSiteUrl = WapSiteUrl;//页面地址
				data.curpage = curpage;//当前页，判断是否上一页的disabled是否显示
				data.type = type;//判断分类
				data.ApiUrl = ApiUrl;
				data.key = getcookie('key');
				$("#all-order a span").html(count_num.count_0);
				$("#no-payment a span").html(count_num.count_10);
				$("#no-delivery a span").html(count_num.count_20);
				$("#realy-delivery a span").html(count_num.count_30);
				template.helper('$getLocalTime', function (nS) {
														  
					return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');  
				});
				var html = template.render('order-list-tmpl', data);
				if(curpage == 1){
					$("#order-list").html(html);
				}else{
					$("#order-list").append(html);
				}
				
				//js^V
				 var leng=$(".order-l-b").length;
				   $('.order-l-b').find(".shopping-listing").hide();
				  for(var i=0;i<=leng;i++){
				        $('.order-l-b').eq(i).find(".shopping-listing").first().show();
				    }
				//js^V
				//取消订单
				$(".cancel-order").click(cancelOrder);
				//删除订单
				$(".delete-order").click(deleteOrder);
				//下一页
				$(".next-page").click(nextPage);
				//上一页
				//$(".pre-page").click(prePage);
				//确认订单
				$(".sure-order").click(sureOrder);
				hasMore = data.hasmore;
				
				
			}
		});
	}
	//
	$("#all-order").click(
			function(){
			     $("#all-order").addClass("r-h");
			     $("#no-payment").removeClass("r-h");
			     $("#no-delivery").removeClass("r-h");
			     $("#realy-delivery").removeClass("r-h");
			     initPage(0,1,0);
				}
			);
	$("#no-payment").click(
			function(){
				 $("#no-payment").addClass("r-h");
			     $("#all-order").removeClass("r-h");
			     $("#no-delivery").removeClass("r-h");
			     $("#realy-delivery").removeClass("r-h");
				initPage(0,1,10);
				}
			);
	$("#no-delivery").click(
			function(){
				 $("#no-delivery").addClass("r-h");
			     $("#all-order").removeClass("r-h");
			     $("#no-payment").removeClass("r-h");
			     $("#realy-delivery").removeClass("r-h");
				initPage(0,1,20);
				}
			);
	$("#realy-delivery").click(
			function(){
				 $("#realy-delivery").addClass("r-h");
			     $("#all-order").removeClass("r-h");
			     $("#no-payment").removeClass("r-h");
			     $("#no-delivery").removeClass("r-h");
				initPage(0,1,30);
				}
			);
	//
	//初始化页面
	initPage(page,curpage,0);
	//取消订单
	function cancelOrder(){
		var self = $(this);
		var order_id = self.attr("order_id");
		type = self.attr("order_type");
		$.ajax({
			type:"post",
			url:ApiUrl+"/index.php?act=member_order&op=order_cancel",
			data:{order_id:order_id,key:key},
			dataType:"json",
			success:function(result){
				if(result.datas && result.datas == 1){
					initPage(page,curpage,type);
				}
			}
		});
	}
	//删除订单(假)
	function deleteOrder(){
		
		var self = $(this);
		var order_id = self.attr("order_id");
		type = self.attr("order_type");
		$.ajax({
			type:"post",
			url:ApiUrl+"/index.php?act=member_order&op=order_delete",
			data:{order_id:order_id,key:key},
			dataType:"json",
			success:function(result){
				if(result.datas && result.datas == 1){
					initPage(page,curpage,type);
				}
			}
		});
	}
	//下一页
	function nextPage (){
		var self = $(this);
		var hasMore = self.attr("has_more");
		type = self.attr("order_type");
		if(hasMore == "true"){
			curpage = curpage+1;
			alert(type);
			initPage(page,curpage,type);
		}
	}
	//上一页
	function prePage (){
		var self = $(this);
		type = self.attr("order_type");
		if(curpage >1){
			self.removeClass("disabled");
			curpage = curpage-1;
			alert(type);
			initPage(page,curpage,type);
		}
	}
	//确认订单
	function sureOrder(){
		var self = $(this);
		var order_id = self.attr("order_id");
		type = self.attr("order_type");
		$.ajax({
			type:"post",
			url:ApiUrl+"/index.php?act=member_order&op=order_receive",
			data:{order_id:order_id,key:key},
			dataType:"json",
			success:function(result){
				if(result.datas && result.datas == 1){
					initPage(page,curpage,type);
				}
			}
		});
	}

function drop_down(list) {
    var classes = $(list).parent().attr('class');
    if (classes == "order-dd-button1") {
        $(list).parent().parent().find(".shopping-listing").show();
        $(list).parent().removeClass();
        $(list).parent().addClass("order-dd-button2");
    }else if(classes == "order-dd-button2"){
        $(list).parent().parent().find(".shopping-listing").hide();
        $(list).parent().parent().find(".shopping-listing").first().show();
        $(list).parent().removeClass();
        $(list).parent().addClass("order-dd-button1");
    }
}

$(window).scroll(function () {
    var scrollTop = $(this).scrollTop();
    var scrollHeight = $(document).height();
    var windowHeight = $(this).height();
    if (scrollTop + windowHeight >= scrollHeight&&hasMore==true) {
    	curpage = curpage+1;
    	//alert(type_load);
    	initPage(page,curpage,type_load);
    }
    if(hasMore==false){
        $(".add-more").html("全部加载完毕");
    }
});