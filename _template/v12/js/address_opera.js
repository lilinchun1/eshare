$(function(){
	var key = getcookie('key');
	$.ajax({
		type:'post',
		url:ApiUrl+'/index.php?act=member_address&op=area_list',
		data:{key:key},
		dataType:'json',
		success:function(result){
			checklogin(result.login);
			var data = result.datas;
			var prov_html = '';
			for(var i=0;i<data.area_list.length;i++){
				if($("input[name=prov_hid]").val() && $("input[name=prov_hid]").val() == data.area_list[i].area_name){
					prov_html+='<option value="'+data.area_list[i].area_id+'" selected="selected">'+data.area_list[i].area_name+'</option>';
				}else{
					prov_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
				}
			}
			$("select[name=prov]").append(prov_html);
			if($("input[name=prov_hid]").val()){
				provChenge();
			}
		}
	});

	$("select[name=prov]").change(function(){
		provChenge()
	});

	$("select[name=city]").change(function(){
		cityChenge()
	});
	
	function provChenge(){
		var prov_id = $("select[name=prov]").val();
		$.ajax({
			type:'post',
			url:ApiUrl+'/index.php?act=member_address&op=area_list',
			data:{key:key,area_id:prov_id},
			dataType:'json',
			success:function(result){
				checklogin(result.login);
				var data = result.datas;
				var city_html = '<option value="">请选择...</option>';
				for(var i=0;i<data.area_list.length;i++){
					if($("input[name=city_hid]").val() && $("input[name=city_hid]").val() == data.area_list[i].area_name){
						city_html+='<option value="'+data.area_list[i].area_id+'" selected="selected">'+data.area_list[i].area_name+'</option>';
					}else{
						city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
					}
					
				}
				$("select[name=city]").html(city_html);
				$("select[name=region]").html('<option value="">请选择...</option>');
				if($("input[name=city_hid]").val()){
					cityChenge();
				}
			}
		});
	}

	function cityChenge(){
		var city_id = $("select[name=city]").val();
		$.ajax({
			type:'post',
			url:ApiUrl+'/index.php?act=member_address&op=area_list',
			data:{key:key,area_id:city_id},
			dataType:'json',
			success:function(result){
				checklogin(result.login);
				var data = result.datas;
				var region_html = '<option value="">请选择...</option>';
				for(var i=0;i<data.area_list.length;i++){
					if($("input[name=region_hid]").val() && $("input[name=region_hid]").val() == data.area_list[i].area_name){
						region_html+='<option value="'+data.area_list[i].area_id+'" selected="selected">'+data.area_list[i].area_name+'</option>';
					}else{
						region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
					}
					
				}
				$("select[name=region]").html(region_html);
			}
		});
	}
	/*
	$.sValid.init({
        rules:{
            true_name:"required",
            mob_phone:{"required":true,"phone":true},
            prov_select:"required",
            city_select:"required",
            region_select:"required",
            address:"required"
        },
        messages:{
            true_name:"姓名必填！",
            mob_phone:"手机格式错误！",
            prov_select:"省份必填！",
            city_select:"城市必填！",
            region_select:"区县必填！",
            address:"详细地址必填！"
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                $(".error-tips").html(errorHtml).show();
            }else{
                 $(".error-tips").html("").hide();
            }
        }
    });
    
	$('.add_address').click(function(){
        if($.sValid()){
			var index = $('select[name=prov]')[0].selectedIndex;
            var aa = $('select[name=prov]')[0].options[index].innerHTML;


			var true_name = $('input[name=true_name]').val();
			var mob_phone = $('input[name=mob_phone]').val();
			var tel_phone = $('input[name=tel_phone]').val();
			var city_id = $('select[name=city]').val();
			var area_id = $('select[name=region]').val();
			var address = $('input[name=address]').val();

			var prov_index = $('select[name=prov]')[0].selectedIndex;
			var city_index = $('select[name=city]')[0].selectedIndex;
			var region_index = $('select[name=region]')[0].selectedIndex;
			var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;

			$.ajax({
				type:'post',
				url:ApiUrl+"/index.php?act=member_address&op=address_add",
				data:{key:key,true_name:true_name,mob_phone:mob_phone,tel_phone:tel_phone,city_id:city_id,area_id:area_id,address:address,area_info:area_info},
				dataType:'json',
				success:function(result){
					if(result){
						location.href = WapSiteUrl+'/tmpl/member/address_list.html';
					}else{
						location.href = WapSiteUrl;
					}
				}
			});
        }
	});
	*/
});
function setAreaInfo(){
	var prov_index   = $('select[name=prov]')[0].selectedIndex;
	var city_index   = $('select[name=city]')[0].selectedIndex;
	var region_index = $('select[name=region]')[0].selectedIndex;
	var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
	$('input[name=area_info]').val(area_info);
}


