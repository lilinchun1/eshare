<?php
/**
 * 下推接口
 *
 * @copyright Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license http://www.shopnc.net
 * @link http://www.shopnc.net
 * @since File available since Release v1.1
 * @version SVN: $Id: agent_bill.model.php 2014-11-3 14:03:53 zhangyating $
 */
defined('InShopNC') or exit('Access Invalid!');
class push_interfaceModel extends Model {

	public function __construct () {
		parent::__construct('push_interface');
	}
	/**
	 * @author zhangyating 2014-11-14
	 * @param string $openid 发送下推接口的openid
	 * @param array $memberInfo 下推接口个人信息
	 * @param string $para 判断模板的不同
	 */
	public function invokeInferface($openid,$memberInfo,$para){
		$s = file_get_contents("http://o2ocs.exweixin.com/index.php?app=Dream&mod=GetAccessToken&act=getAccess&uid=367");
		$obj = json_decode($s);
		$access_token = $obj->access_token;
		if($_COOKIE[$openid]){
			//echo "cookie is here";
		}else{
		setcookie($openid, "invokeInferface", time() + 100, '/');
		$objUser = $this->push_member($openid, $memberInfo, $access_token,$para);
		if ($objUser["errcode"] == "40001" || $objUser["errcode"] == "42001") {
			$s = file_get_contents("http://o2ocs.exweixin.com/index.php?app=Dream&mod=GetAccessToken&act=setAccess&uid=367");
			$this->invokeInferface($openid,$memberInfo,$para);
			//echo "access_token is die";die();
		}
		}
	}
	
	/**
	 * 订单支付成功
	 * 给代理商发送支付成功的下推接口
	 * @param string $out_trade_no 订单的pay_sn
	 * @param string $name 下订单人的名字
	 * @author zhangyating 2014-11-17
	 */
	public function order_success($out_trade_no,$name){
		//订单信息
		$order = Model()->table('order')->where(array('pay_sn'=>$out_trade_no))->find();
		
		//下推者 代理商的openid
		$agent_info = Model()->table('member')->field('member_wxopenid')->where(array('member_id'=>$order['agent_id']))->find();
		//print_r($agent_info);die();
	  //买家信息 买家的名字
		//$buyer =  Model()->table('member')->field('member_truename')->where(array('member_id'=>$order['buyer_id']))->find();
		
		if($order['payment_code']=="wxpay"){$order['payment_code'] = "微信支付";}
		if($order['payment_code']=="alipay"){$order['payment_code'] = "支付宝支付";}
		
		$memberInfo = array(
				'title'=>"您好，".$name."的订单已支付成功",
				'order_id'=>$order['order_sn'],
				'payment_time'=>date("Y-m-d H:i:s",$order['payment_time']),
				'payment_code'=>$order['payment_code'],
				'order_amount'=>$order['order_amount'],
				'remark'=>"恭喜您又成交了一单！"
		);
		$this->invokeInferface($agent_info['member_wxopenid'], $memberInfo, "o");
		
	}
	
	/**
	 * 
	 * 下推接口模板
	 */
	public function push_member($openid,$memberInfo,$accesstoken,$para){
		switch ($para) {
			case "m":
				$temp = array(
						'touser'=>strval($openid),
						'template_id'=>"vC8RpUcUZR1t8hk9TGOhZZJh3Z1855pOoj19QhKdOcA",
						'url'=>WAP_SITE_URL."/index.php?act=wxCap&op=index",
						'topcolor'=>"#FF0000",
						'data'=>array(
								'first'=>array(
										'value'=>urlencode($memberInfo['title']),
										'color'=>"#173177",
								),
								'cardNumber'=>array(
										'value'=>urlencode($memberInfo['id']),
										'color'=>"#173177",
								),
								'type'=>array(
										'value'=>urlencode($memberInfo['type']),
										'color'=>"#173177",
								),
								'address'=>array(
										'value'=>urlencode($memberInfo['address']),
										'color'=>"#173177",
								),
								'VIPName'=>array(
										'value'=>urlencode($memberInfo['VIPName']),
										'color'=>"#173177",
								),
								'VIPPhone'=>array(
										'value'=>urlencode($memberInfo['VIPPhone']),
										'color'=>"#173177",
								),
								'expDate'=>array(
										'value'=>urlencode($memberInfo['expDate']),
										'color'=>"#173177",
								),
								'remark'=>array(
										'value'=>urlencode($memberInfo['remark']),
										'color'=>"#173177",
								),
						)
				);
				break;
			case "o":
				$temp = array(
						'touser'=>strval($openid),//发送者的openid
						'template_id'=>"Whx8P86suZEjJsUTQ_H3SiP-wjN1ZDdGP7eiyyu86_M",
						'url'=>WAP_SITE_URL."/index.php?act=wxCap&op=index",
						'topcolor'=>"#FF0000",
						'data'=>array(
								'first'=>array(
										'value'=>urlencode($memberInfo['title']),
										'color'=>"#173177",
								),
								'keyword1'=>array(
										'value'=>urlencode($memberInfo['order_id']),
										'color'=>"#173177",
								),
								'keyword2'=>array(
										'value'=>urlencode($memberInfo['payment_time']),
										'color'=>"#173177",
								),
								'keyword3'=>array(
										'value'=>urlencode($memberInfo['order_amount']),
										'color'=>"#173177",
								),
								'keyword4'=>array(
										'value'=>urlencode($memberInfo['payment_code']),
										'color'=>"#173177",
								),
								'remark'=>array(
										'value'=>urlencode($memberInfo['remark']),
										'color'=>"#173177",
								),
						)
				);
				break;
		}
		
		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $accesstoken;
		$l = urldecode(json_encode($temp));
		$jsonUser =$this->getHttpResponsePOST($url,$l);
		$objUser = json_decode($jsonUser);
		return get_object_vars($objUser);
	}
	
	/**
	 * 远程获取数据，POST模式
	 * 注意：
	 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
	 * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
	 *
	 * @param $url 指定URL完整路径地址
	 * @param $cacert_url 指定当前工作目录绝对路径
	 * @param $para 请求的数据
	 * @param $input_charset 编码格式。默认值：空值 return 远程输出的数据
	 */
	public function getHttpResponsePOST ($url, $para, $input_charset = '') {
		if (trim($input_charset) != '') {
			$url = $url . "_input_charset=" . $input_charset;
		}
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // SSL证书认证
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 严格认证
		curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
		curl_setopt($curl, CURLOPT_POST, true); // post传输数据
		curl_setopt($curl, CURLOPT_POSTFIELDS, $para); // post传输数据
		$responseText = curl_exec($curl);
		// var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
		curl_close($curl);
	
		return $responseText;
	}
}
