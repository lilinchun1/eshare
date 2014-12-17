$(function(){
		var key = getcookie('key');
		if(key==''){
			//zhangyating 2014-9-17 判断是否是微信浏览器
			if(isWeiXin()){
				location.href = WapSiteUrl+'/index.php?act=wxCap&op=memberLogin';
			}else{
				location.href = 'login.html';
			}
			
		}
		$.ajax({
			type:'post',
			url:ApiUrl+"/index.php?act=member_index",	
			data:{key:key},
			dataType:'json',
			//jsonp:'callback',
			success:function(result){
				checklogin(result.login);
				$('#order_count').html(result.datas.member_info.order_count);
				$('#adress_count').html(result.datas.member_info.adress_count);
				$('#username').html(result.datas.member_info.member_truename);
				$('#point').html(result.datas.member_info.point);
				$('#predepoit').html(result.datas.member_info.predepoit);
				$('#avatar').attr("src",result.datas.member_info.avator);
				//2014-9-16 zhangyating 判断是否在微信浏览器来的
				if(result.datas.member_info.isWechat == 1){
					$('.logoutbtn').hide();
				}
				return false;
			}
		});
});