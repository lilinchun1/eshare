 <?php
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
define('PATH_NOTICE',str_replace('/mobile/api/payment/wxpay','',BASE_PATH));
if (!@include(PATH_NOTICE.'/global.php')) exit('global.php isn\'t exists!');
if (!@include(BASE_CORE_PATH.'/shopnc.php')) exit('shopnc.php isn\'t exists!');
 Base::init();
 include_once("WxPayHelper.php");
 //1. 获取access token
 $access_token = getUserAccessToken($_GET['openid']);

 //2.准备参数
 $deliver_timestamp = time();
 //2.1构造最麻烦的app_signature
 $obj['appid']               = APPID;
 $obj['appkey']              = APPKEY;
 $obj['openid']              = $_GET['openid'];
 $obj['transid']             = $_GET['transid'];
 $obj['out_trade_no']        = $_GET['out_trade_no'];
 $obj['deliver_timestamp']   = $deliver_timestamp;
 $obj['deliver_status']      = "1";
 $obj['deliver_msg']         = "ok";
 
 $WxPayHelper = new WxPayHelper();
 //get_biz_sign函数受保护，需要先取消一下，否则会报错
 $app_signature  = $WxPayHelper->get_biz_sign($obj);
 


 //3. 将构造的json提交给微信服务器，查询
 $jsonmenu = '
 {
     "appid" : "'.$obj['appid'].'",
     "openid" : "'.$obj['openid'].'",
     "transid" : "'.$obj['transid'].'",
     "out_trade_no" : "'.$obj['out_trade_no'].'",
     "deliver_timestamp" : "'.$deliver_timestamp.'",
     "deliver_status" : "'.$obj['deliver_status'].'",
     "deliver_msg" : "'.$obj['deliver_msg'].'",
     "app_signature" : "'.$app_signature.'",
     "sign_method" : "sha1"
 }';



 $url = "https://api.weixin.qq.com/pay/delivernotify?access_token=".$access_token;
 $result = https_request($url, $jsonmenu);
 //var_dump($result);
 
 echo $result;

 function https_request($url, $data = null){
     $curl = curl_init();
     curl_setopt($curl, CURLOPT_URL, $url);
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
     if (!empty($data)){
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
     }
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     $output = curl_exec($curl);
     curl_close($curl);
     return $output;
 }
 
 /**
  * 获得accessToken
  * @param $openid String 用户对应公共平台的唯一标识
  */
 
 function getUserAccessToken($openid){
 	$access_token = Model('weixin')->getACCESS_TOKEN(1);
 	$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN'; 
 	$jsonUser = GetHttpResponseGET($url);
 	$objUser = json_decode($jsonUser);
 	$wechatInfo = get_object_vars($objUser);
 	//这个地方有个异常处理
 	if($wechatInfo["errcode"] == "40001" ){
 		$access_token = Model('weixin')->setACCESS_TOKEN(1);
 	}
 	
 	return $access_token;
 }

  function GetHttpResponseGET($url) {
 	$curl = curl_init($url);
 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //SSL证书认证
 	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); //不认证
 	curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
 	$responseText = curl_exec($curl);
 	curl_close($curl);
 	return $responseText;
 }

