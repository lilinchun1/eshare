<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<!-- js -->
<script src="<?php echo MOBILE_SITE_URL;?>/templates/default/js/jquery-1.8.0.min.js"></script>
<!-- js -->
<title>WEKA</title>
<link href="<?php echo MOBILE_SITE_URL;?>/templates/default/css/style.css" rel="stylesheet" type="text/css">
<!-- verification code -->
<script type="text/javascript">
var t = 11;
var settime ="";
var apiurl = "<?php echo MOBILE_SITE_URL;?>";
	// verification code 
	function checkPhone(){
		//验证手机号是否有效
		var member_mobile = $("input[name=member_mobile]").val();
		var regMobile=/^0?1(3|5|8)\d{9}$/;
		if(member_mobile == "请输入您的手机号"){
			show_message("请输入您的手机号");
			
		}else if(!regMobile.test(member_mobile)){
			show_message("手机号格式错误");
		}else{
			$('#checkPhone').removeAttr("onclick");

			$.ajax({
				type:'post',
				url:apiurl+"/index.php?act=agent&op=checkPhone",	
				data:{'member_mobile':member_mobile},
				dataType:'json',
				//jsonp:'callback',
				success:function(result){
					$('#checkPhone').attr("onclick","checkPhone();");
					if(result.datas.status == 1){
						
					}else{
						//失效
						$('#checkPhone').removeAttr("onclick");
						show_message(result.datas.error);
						//倒数计时
						many_seconds();

						
					}
					
					
				}
			});
			
		}
	}

	function many_seconds(){ 
		    t -= 1;  
		    document.getElementById('showtimes').innerHTML= t;  
		    if(t==0){  
		    	clearTimeout(settime);
		    	 document.getElementById('showtimes').innerHTML= "";  
		    	 t=11;
		    	$('#checkPhone').attr("onclick","checkPhone();");
		    }else{
		    	  //每秒执行一次,showTime()  
			    settime = setTimeout("many_seconds()",1000);  
			    
		    }  
		  
		}  

	

	function show_message(msg){
		$('.hhhh').html(msg);
		$('.hhhh').show();
		$('.hhhh').animate({top:50},500,function(){
			window.setTimeout("hide_message()",2000);
		});
	}

	function hide_message(){
		$('.hhhh').animate({top:-80},300).hide();
	}

	function check(vi){

		
	if(vi.checked){

		$("#step").removeClass("S006_but5");
		$("#step").addClass("S006_but6");
		$('#step').attr("onclick","submitForm();");
		
	}else{

		$("#step").removeClass("S006_but6");
		$("#step").addClass("S006_but5");
		$('#step').removeAttr("onclick");
	}
		
	}

	function submitForm(){
		
		var member_passwd = $("input[name=member_passwd]").val();
		var rpasswd = $("input[name=rpasswd]").val();

		if(member_passwd == "请设置6-16位密码"){
			show_message("请填写密码");
			
		}else if(member_passwd.length < 6){

			show_message("密码不能短");
			
		}else if(member_passwd.length > 16){
			
			show_message("密码不能太长");

			}else if(member_passwd != rpasswd){
				
				show_message("两次密码必须一致！");

				}else{


					$("#form1").submit();
					}
		


		}

</script>
<!-- 弹框样式 -->
<style>
.hhhh{ position:fixed; top:-80px; left:5%; z-index:9999; width: 90%; padding: 15px 0px; background-color: #ff5f6e; border: 1px solid #b10000; margin: auto; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -ms-border-radius: 8px; -o-border-radius: 8px; box-shadow: 0px 0px 2px #999999; -ms-box-shadow: 0px 0px 2px #999999; -webkit-box-shadow: 0px 0px 2px #999999; -moz-box-shadow: 0px 0px 2px #999999; -o-box-shadow: 0px 0px 2px #999999; margin-top: 20px; color: #fff; font-size: 14px; font-weight: bold; text-align: center; border: 2px solid #fff; }
</style>

</head>

<body>
<div class="hhhh" style="display:none;"></div>
<form id="form1" name="form1" method="post" action="<?php echo MOBILE_SITE_URL;?>/index.php?act=agent&op=do_phone_passwd">
<input  value="请输入您的手机号" type="tel" class="S007_text"  name="member_mobile" id="member_mobile"   onmouseout="this.style.borderColor=''" onFocus="if (value =='请输入您的手机号'){value =''}" onBlur="if (value ==''){value='请输入您的手机号'}"/>
<input type="hidden" value="<?php echo $output['channel_qrcode'];?>" name="channel_qrcode"/>
<input type="hidden" value="<?php echo $output['store_id'];?>" name="store_id"/>
<input type="hidden" value="<?php echo $output['is_agent'];?>" name="is_agent"/>
<input type="text" class="S006_text2" name="mobileCode"/>
 <a data-toggle="modal" href="javascript:;" onclick="checkPhone();" id="checkPhone"><input type="button" class="S006_but1" value="获取验证码" /></a><div id="showtimes"></div>
 
 <input  value="请设置6-16位密码" type="text" class="S006_text"  name="member_passwd" id="member_passwd"   onmouseout="this.style.borderColor=''" onFocus="if (value =='请设置6-16位密码'){value =''}" onBlur="if (value ==''){value='请设置6-16位密码'}"/>
  <input  value="请重新输入一遍" type="text"class="S006_text"  name="rpasswd" id="rpasswd"   onmouseout="this.style.borderColor=''" onFocus="if (value =='请重新输入一遍'){value =''}" onBlur="if (value ==''){value='请重新输入一遍'}"/>
  <h6  class="S002_h6">设置密码后，可以使用手机号+密码登录</h6>
   <input type="button" class="S006_but5" value="下一步"  id="step" /><br />
   <!--   <input type="button" class="S006_but6" value="下一步" /><br />-->
<div class="S002_service">
  
    <p>
      <label>
        <input type="checkbox" name="service" value="复选框" id="service" onclick="check(this)" />
        阅读并同意<a href="">服务协议</a></label>
    </p>
  </form>
</div>
