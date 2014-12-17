<?php
/**
 * 支付
 *
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class member_paymentControl extends mobileMemberControl {

	public function __construct() {
		parent::__construct();
	}

	
    /**
     * 支付
     */
    public function payOp() {
	    $pay_sn = $_GET['pay_sn'];
        $payment_code = 'alipay';

        $model_payment = Model('payment');
        $result = $model_payment->productBuy($pay_sn, $payment_code, $this->member_info['member_id']);

        if(!empty($result['error'])) {
            output_error($result['error']);
        }
		
        
       
        
        if($_GET['type'] == "1"){
        	//die();
        	//第三方API支付
        	$flag = $this->testSF($result['order_pay_info'],$result['payment_info']);
        	if($flag){
        		$this->_api_pay($result['order_pay_info'], $result['payment_info']);
        	}else{
        		exit("risk is fail");
        	}
        	
        	//$this->testSF($result['order_pay_info'],$result['payment_info']);
        	
        }else if($_GET['type'] == "2"){
        	
        	
        	$out_trade_no = $result['order_pay_info']['pay_sn'];
        	$total_fee = strval($result['order_pay_info']['pay_amount']*100);
        	$order_id = Model()->table("order")->where(array('pay_sn'=>$out_trade_no))->find();
        	$goodsName = Model()->table("order_goods")->where(array('order_id'=>$order_id['order_id']))->find();
        	$boby = $goodsName['goods_name'];
        	$body = urlencode($boby);
        	redirect("api/payment/wxpay/jsapicall.php?out_trade_no=".$out_trade_no."&total_fee=".$total_fee."&body=".$body."&showwxpaytitle=1");
        	
        }
       
        
     
    }
   //---------------------------------------------------------------------------------------------------- 
    
    /**
     * 风险检测服务接口
     */
    public function testSF($order_pay_info,$payment_info){
    	$path_s = BASE_PATH.DS."api".DS."payment".DS."risk".DS;
    	require_once($path_s."alipay_s.config.php");
    	require_once($path_s."lib/alipay_submit_s.class.php");
    	
    	$config = unserialize($payment_info['payment_config']);
    	$order_info = Model()->table('order')->field('buyer_id,add_time,agent_id')->where(array('pay_sn'=>$order_pay_info['pay_sn']))->find();
    	$buyer_info = Model()->table('member')->field('member_time')->where(array('member_id'=>$order_info['buyer_id']))->find();
    	//$agent_info = Model()->table('member')->field('member_time')->where(array('member_id'=>$order_info['agent_id']))->find();
    	//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "alipay.security.risk.detect",
				"partner" => trim($config['alipay_partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> MOBILE_SITE_URL."/api/payment/risk/notify_url_s.php",
				"return_url"	=> MOBILE_SITE_URL."/api/payment/risk/return_url_s.php",
				"seller_email"	=> $config['alipay_account'],
				"timestamp"	=> date('Y-m-d H:i:s',time()),
				"terminal_type"	=> "WAP",
				"terminal_info"	=> "win7^1.0",
				"order_no"	=> $order_pay_info['pay_sn'],
				"order_credate_time"	=> $order_info['add_time'],
				"order_category"	=> "食品饮料^生鲜食品^海鲜水产",
				"order_item_name"	=> $order_pay_info['subject'],
				"order_amount"=>$order_pay_info['pay_amount'],
		        "scene_code"=>"PAYMENT",
				"buyer_account_no"=>$order_info['buyer_id'],
				"buyer_reg_date"=>$buyer_info['member_time'],
				"_input_charset"	=> trim(strtolower($alipay_config_s['input_charset']))
		);
		
		//建立请求
		$alipaySubmit = new AlipaySubmit_s($alipay_config_s);
		$html_text = $alipaySubmit->buildRequestHttp_s($parameter);
		return $html_text;
    	
    }
    
    /**
     * @zhangyating 2014-11-12
     * 支付宝签名
     *
     * @param array $para sign需要的参数
     * @return string sign 签名
     */
    private function _verify_result_alipay ($para,$private_key_path) {
    	$para_filter = array ();
    	while (list ($key, $val) = each($para)) {
    		if ($key == "sign" || $key == "sign_type" || $val == "")
    			continue;
    		else
    			$para_filter[$key] = $para[$key];
    	}
    	ksort($para_filter);
    	reset($para_filter);
    	$arg = "";
    	while (list ($key, $val) = each($para_filter)) {
    		$arg .= $key . "=" . $val . "&";
    	}
    	// 去掉最后一个&字符
    	$arg = substr($arg, 0, count($arg) - 2);
    
    	// 如果存在转义字符，那么去掉转义
    	if (get_magic_quotes_gpc()) {
    		$arg = stripslashes($arg);
    	}
    	
    	$priKey = $private_key_path;
    	//$res = openssl_get_privatekey($priKey);
    	
    	openssl_sign($arg, $sign, $priKey);
    	echo $sign;
    	openssl_free_key($priKey);
		//base64编码
    	$sign = base64_encode($sign);
    	echo $sign;die();
    	return $sign;
    }
    
    /**
     * 模拟get请求
     *
     * @param string $url
     * @return XML
     */
    private function GetHttpResponseGET ($url) {
    	$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // SSL证书认证
    	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 不认证
    	curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
    	$responseText = curl_exec($curl);
    	curl_close($curl);
    	return $responseText;
    }
//-------------------------------------------------------------------------------------------------------
	/**
	 * 第三方在线支付接口
	 *
	 */
	private function _api_pay($order_pay_info, $payment_info) {
    	$inc_file = BASE_PATH.DS.'api'.DS.'payment'.DS.$payment_info['payment_code'].DS.$payment_info['payment_code'].'.php';
    	if(!file_exists($inc_file)){
            output_error('支付接口不存在');
    	}
    	require_once($inc_file);
        $param = array();
    	$param = unserialize($payment_info['payment_config']);
        $param['order_sn'] = $order_pay_info['pay_sn'];
        $param['order_amount'] = $order_pay_info['pay_amount'];
        $param['sign_type'] = 'MD5';
    	$payment_api = new $payment_info['payment_code']($param);
        $return = $payment_api->submit();
        echo $return;
    	exit;
	}
	
	
}
