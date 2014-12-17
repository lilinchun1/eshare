<?php
include_once("WxPayHelper.php");


$commonUtil = new CommonUtil();
$wxPayHelper = new WxPayHelper();

$body =  str_replace(array(" ","　","\t","\n","\r"), "", trim($_GET['body']));

$wxPayHelper->setParameter("bank_type", "WX");
$wxPayHelper->setParameter("body",iconv_substr($body, 0, 16, 'utf-8'));
$wxPayHelper->setParameter("partner", "1220820201");
$wxPayHelper->setParameter("out_trade_no", $_GET['out_trade_no']);//$commonUtil->create_noncestr()
$wxPayHelper->setParameter("total_fee", $_GET['total_fee']);
$wxPayHelper->setParameter("fee_type", "1");
$wxPayHelper->setParameter("notify_url", "http://o2o.exweixin.com/weka/mobile/api/payment/wxpay/notify_url.php");
$wxPayHelper->setParameter("spbill_create_ip", "127.0.0.1");
$wxPayHelper->setParameter("input_charset", "UTF-8");
$wOpt = array();

$wOpt = $wxPayHelper->create_biz_package();
//print_r($wOpt);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<style type="text/css">
#loading{position:fixed; bottom:45%; width:100%; text-align:center; color:#666;}
</style>
<script language="javascript">
var pay_sn = "<?php echo $_GET['out_trade_no'];?>";

setTimeout(function(){
	document.getElementById("loading").style.display ='none';
	checkCookie(pay_sn);
},2000);

function checkCookie(sn){
	if(getCookie("pay_sn_wx")){
		if(getCookie("pay_sn_wx")!=sn){
			//alert("order is different");
			delCookie("pay_sn_wx");
			addCookie("pay_sn_wx",sn,1);
			//alert("请在安全地点支付");
			callpay();
			}else{
				delCookie("pay_sn_wx");
				//alert("order is the same");
				history.back();
			}
	}else{
		addCookie("pay_sn_wx",pay_sn,1);
		//alert("请在安全地点支付");
		callpay();
	}
}


function addCookie(objName,objValue,objHours){
	var str = objName + "=" + escape(objValue);
	if(objHours > 0){
	var date = new Date();
	var ms = objHours*3600*1000;
	date.setTime(date.getTime() + ms);
	str += "; expires=" + date.toGMTString();
	}
	document.cookie = str;
	//alert("addcookie is success");
}


function getCookie(objName){
	var arrStr = document.cookie.split("; ");
	for(var i = 0;i < arrStr.length;i ++){
	var temp = arrStr[i].split("=");
	if(temp[0] == objName) return unescape(temp[1]);
	}
}


function delCookie(name){
	var date = new Date();
	date.setTime(date.getTime() - 10000);
	document.cookie = name + "=a; expires=" + date.toGMTString();
}

function callpay(){
	WeixinJSBridge.invoke('getBrandWCPayRequest',{
		 	'appId' : "<?php echo $wOpt['appId'];?>",
	        'timeStamp': "<?php echo $wOpt['timeStamp'];?>",
	        'nonceStr' : "<?php echo $wOpt['nonceStr'];?>",
	        'package' : "<?php echo $wOpt['package'];?>",
	        'signType' : "<?php echo $wOpt['signType'];?>",
	        'paySign' : "<?php echo $wOpt['paySign'];?>"
		},function(res){
			var mobile_url = "http://o2o.exweixin.com/weka/mobile";


			var pay_sn = "<?php echo $_GET['out_trade_no'];?>";

			var result = "";

			   if(res.err_msg == 'get_brand_wcpay_request:ok') {
				   result = 'success';
				   window.location.href = mobile_url+"/index.php?act=payment_wx&op=wxShow&result="+result+"&pay_sn="+pay_sn;
		        }else if(res.err_msg == 'get_brand_wcpay_request:fail'){
		        	result = 'fail';
		        	window.location.href = mobile_url+"/index.php?act=payment_wx&op=wxShow&result="+result+"&pay_sn="+pay_sn;
		        }else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
		        			delCookie("pay_sn_wx");
							history.back();
			        }



		});
}

</script>
</head>

<body>
<div class="loading" id="loading" style="display:block;">
   Loading... ...
</div>

<div class="payment" style="display: none;" onclick="callpay();">
<button>点击按钮支付</button>
</div>

</body>
</html>
