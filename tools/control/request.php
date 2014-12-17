<?php
/**
 * 主动请求支付的功能
 *
 * @copyright Copyright (c) 2013-2014 易享科技
 * @link http://www.exweixin.com
 * @since v1.0
 */
defined('InShopNC') or exit('Access Invalid!');
class requestControl {
	public $setParam; // 支付宝
	private $wxParam; // 微信
	private $min; // 分钟

	public function __construct () {
		// 支付宝接口配置信息
		$model_payment = Model('payment');
		$condition = array ();
		$condition['payment_code'] = 'alipay';
		$payment_info = $model_payment->getPaymentOpenInfo($condition);
		$alipay_config = unserialize($payment_info['payment_config']);
		$this->setParam = $alipay_config;
		$this->min = 5 * 60;
		// 支付宝接口信息 end
		// 微信接口
		$this->wxParam = array ('partner' => "1220820201", 'key' => "55c44e387a1269603a8be3abf07dd572", 'appid' => "wx456c69e53f46bc79", 'appsecret' => "9ff9a17c35cd99c760837c9a8ddd654c", 
			'appkey' => "aXkV6ahN0g4QiPTJEw3YIFAtDD73Oq47m7bAJ02BjLY0TLtUCyz3ixnq48mFvOHOnzRCFHjrUAPLRgxsN08etHuvAdYQg3TXBXNcfRmxZTdjEsZyQ5NUPqUz4hR8F2Sx");
		// 微信接口 end
	}

	/**
	 * 测试支付宝单笔交易查询
	 *
	 * @param string $out_trade_no 商户订单号
	 * @return XML 支付宝返回信息
	 */
	public function alipayRequstOp ($out_trade_no) {
		// 支付宝主动请求功能
		// print_r($this->setParam);
		// die();
		$para = $this->setParam;
		$arr = array ('service' => "single_trade_query", 'partner' => $para['alipay_partner'], '_input_charset' => "utf-8", 'out_trade_no' => $out_trade_no);
		
		// print_r($arr);die();
		$sign = $this->_verify_result_alipay($arr);
		$url = "https://mapi.alipay.com/gateway.do?service=single_trade_query&sign=" . $sign . "&partner=" . $arr['partner'] . "&out_trade_no=" . $arr['out_trade_no'] . "&_input_charset=utf-8&sign_type=MD5";
		// echo $url;die();
		$A = $this->GetHttpResponseGET($url);
		$res = @simplexml_load_string($A, NULL, LIBXML_NOCDATA);
		$res = json_decode(json_encode($res), true);
		// print_r($res);
		return $res;
	}

	/**
	 * @zhangyating 2014-11-12
	 * 支付宝签名
	 *
	 * @param array $para sign需要的参数
	 * @return string sign 签名
	 */
	private function _verify_result_alipay ($para) {
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
		$key = $this->setParam['alipay_key'];
		$arg = $arg . $key;
		$mysgin = md5($arg);
		return $mysgin;
	}

	/**
	 * 微信未支付的订单
	 */
	public function fails_wxOp () {
		$para = "and cancel_state='10'";
		$this->wxInvoke($para);
	}

	/**
	 * 支付未支付的订单
	 */
	public function fails_aliOp () {
		$para = "and cancel_state='10'";
		$this->aliInvoke($para);
	}

	/**
	 * 微信取消的订单
	 */
	public function cancel_wxOp () {
		$para = "and cancel_state='0'";
		$this->wxInvoke($para);
	}

	/**
	 * 支付宝取消的订单
	 */
	public function cancel_aliOp () {
		$para = "and cancel_state='0'";
		$this->aliInvoke($para);
	}

	/**
	 * 微信主动请求返回
	 */
	public function wxInvoke ($para) {
		$time = TIMESTAMP - ($this->min);
		// --查询符合的条件 cancel_state
		// 组函数
		$sql = "select min(check_num_wxpay) as check_num from shopnc_order_supervisory where check_status=0 " . $para;
		$check_num = Model()->query($sql);
		// 组函数
		$check_num = $check_num[0]['check_num'];
		$where = "order_status='0' and check_status='0' and add_time<'" . $time . "' and check_num_wxpay='" . $check_num . "' " . $para;
		$info = Model()->table('order_supervisory')->where($where)->find();
		// echo $check_num;die();
		// print_r($info);die();
		// --查询符合的条件
		$out_trade_no = $info['pay_sn']; // "850469231784223714";390470068538429855//未支付成功
		                                 // if(!rcache($out_trade_no,"pre_")){
		                                 // wcache($out_trade_no,array('out_trade_no'=>$out_trade_no),"pre_",36);//添加mecache
		$obj = $this->wxRequst($out_trade_no);
		// echo $obj->errcode;
		$trade_no = $obj->order_info->transaction_id;
		$trade_status = $obj->order_info->trade_state; // 交易状态
		$errcode = $obj->errcode;
		// echo "<pre>";print_r($obj);echo "<pre>";echo $trade_status;
		$order_info_out_trade_no = $obj->order_info->out_trade_no;
		if ($errcode === 0 && $order_info_out_trade_no == $out_trade_no && ! empty($order_info_out_trade_no) && $trade_status === "0") {
			$data = array ('check_status' => 1, 'check_time' => time(), 'is_wxpay' => 1, 'check_num_wxpay' => $info['check_num_wxpay'] + 1, 'trade_no' => $trade_no);
			// 更改佣金表
			// $payment_code = "wxpay";
			// $this->repair($order_info_out_trade_no, $trade_no, $payment_code);
			echo '校验成功';
		} else {
			$data = array ('check_time' => time(), 'check_num_wxpay' => $info['check_num_wxpay'] + 1);
			echo "校验失败";
		}
		Model()->table('order_supervisory')->where(array ('pay_sn' => $out_trade_no))->update($data);
		$mes = '请求地址：http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . ';微信主动请求的内容：errcode->' . $errcode . ',trade_no->' . $trade_no . ',out_trade_no->' . $out_trade_no . ',trade_status->' . $trade_status;
		$this->log_file($mes, "wxInvoke");
		// }else{
		// exit("mecacade");
		// }
	}

	/**
	 * 支付宝主动请求返回
	 */
	public function aliInvoke ($para) {
		$time = TIMESTAMP - ($this->min);
		// --查询符合的条件
		// 组函数
		$sql = "select min(check_num_alipay) as check_num from shopnc_order_supervisory where check_status=0 " . $para;
		$check_num = Model()->query($sql);
		// 组函数
		$check_num = $check_num[0]['check_num'];
		$where = "order_status='0' and check_status='0' and add_time<'" . $time . "' and check_num_alipay='" . $check_num . "' " . $para;
		$info = Model()->table('order_supervisory')->where($where)->find();
		// print_r($info);die();
		// --查询符合的条件
		$out_trade_no = $info['pay_sn']; // $info['pay_sn']; // "850469231784223714";940469650786982576//未支付
		                                 // $out_trade_no = "740469555170468711";
		                                 // if(!rcache($out_trade_no,"pre_")){
		                                 // wcache($out_trade_no,array('out_trade_no'=>$out_trade_no),"pre_",36);//添加mecache
		$obj = $this->alipayRequstOp($out_trade_no);
		// print_r($obj);die();
		$trade_no = $obj['response']['trade']['trade_no'];
		$errcode = $obj['is_success'];
		$trade_status = $obj['response']['trade']['trade_status']; // 交易状态 TRADE_FINISHED
		$order_info_out_trade_no = $obj['response']['trade']['out_trade_no'];
		if ($errcode === "T" && $order_info_out_trade_no == $out_trade_no && ! empty($order_info_out_trade_no) && $trade_status === "TRADE_FINISHED") {
			$data = array ('check_status' => 1, 'check_time' => time(), 'is_alipay' => 1, 'check_num_alipay' => $info['check_num_alipay'] + 1, 'trade_no' => $trade_no);
			// 更改佣金表
			// $payment_code = "alipay";
			// $this->repair($order_info_out_trade_no, $trade_no, $payment_code);
			echo '校验成功';
		} else {
			$data = array ('check_time' => time(), 'check_num_alipay' => $info['check_num_alipay'] + 1);
			echo "校验失败";
		}
		Model()->table('order_supervisory')->where(array ('pay_sn' => $out_trade_no))->update($data);
		$mes = '请求地址：http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . ';支付宝主动请求的内容：errcode->' . $errcode . ',trade_no->' . $trade_no . ',out_trade_no->' . $out_trade_no . ',trade_status->' . $trade_status;
		$this->log_file($mes, "aliInvoke");
		// }else{
		// exit("mecacade");
		// }
	}

	/**
	 *
	 * @param string $mes 日志内容
	 * @param string $type 日志类型
	 */
	public function log_file ($mes, $type) {
		$data = array ('ctime' => TIMESTAMP, 'type' => $type, 'log_mes' => $mes);
		Model()->table('logs')->insert($data);
	}

	/**
	 * 获得买家的openid
	 * @data 2014-11-14
	 *
	 * @param string $out_trade_no 商户订单号 pay_sn
	 * @author zhangyating
	 * @return string openid 微信唯一标识
	 */
	public function get_seller_openid ($out_trade_no) {
		$info = Model()->table('order')
			->field('buyer_id')
			->where(array ('pay_sn' => $out_trade_no))
			->find();
		$member = Model()->table('member')
			->field('member_wxopenid')
			->where(array ('member_id' => $info['buyer_id']))
			->find();
		return $member['member_wxopenid'];
	}

	public function listOp () {
		$u = "http://" . rtrim($_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"], "act=request&op=list&payment_code=" . $_GET['payment_code'] . "&trade_no=" . $_GET['trade_no'] . "&pay_sn=" . $_GET['pay_sn']);
		$out_trade_no = $_GET['pay_sn'];
		$trade_no = $_GET['trade_no'];
		$payment_code = $_GET['payment_code'];
		$this->repair($out_trade_no, $trade_no, $payment_code);
		
		echo '
				<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title></title>
</head>
				<script>
				alert("修复成功");
				window.location.href="' . $u . 'act=list&op=list";
				</script>';
	}

	/**
	 * 修复功能
	 *
	 * @param string $out_trade_no 商户订单号
	 * @param string $trade_no 支付宝或微信返回的订单号
	 * @param string $payment_code 支付方式
	 */
	public function repair ($out_trade_no, $trade_no, $payment_code) {
		// 实例化model
		$model_order = Model('order');
		$model_payment = Model('payment');
		$model_bill = Model('agent_bill');
		$notify_end = Model()->table("order_pay")->where(array ('pay_sn' => $out_trade_no))->find();
		if ($notify_end['api_pay_state']) {
			echo "You have implemented again";
			// exit();
		} else {
			$order_list = $model_order->getOrderList(array ('pay_sn' => $out_trade_no, 'order_state' => ORDER_STATE_NEW));
			$result = $model_payment->updateProductBuy($out_trade_no, $payment_code, $order_list, $trade_no);
			
			$mobile = $this->getMob($order_list[0]['order_id']);
			$people = $this->getPeople($order_list[0]['order_id']);
			
			// $message = "用户：" . $people . "，您好！感谢您在新玉麟电商平台消费" . $order_list[0]['order_amount'] . "元，我们将尽快为您发货，请您耐心等候！有任何问题,请联系客服人员：400-050-9988";
			// Sms::send($mobile, $message, &$error);
			$model_bill->setAgentBill($out_trade_no);
			echo "success";
		}
	}

	function getMob ($order_id) {
		$model = Model();
		$order = $model->table('order')->where("order_id = " . $order_id)->find();
		// 通过订单ID 查询电话号
		$obj = $model->table('order_common')->where("order_id = " . $order_id)->find();
		$obj = unserialize($obj['reciver_info']);
		$obj = explode(",", $obj['phone']);
		$mobile = $obj[0];
		return $mobile;
	}

	function getPeople ($order_id) {
		$model = Model();
		$order = $model->table('order')->where("order_id = " . $order_id)->find();
		$obj = $model->table('order_common')->where("order_id = " . $order_id)->find();
		$obj = $obj['reciver_name'];
		return $obj;
	}

	/**
	 * 测试微信单笔交易查询
	 *
	 * @param string $out_trade_no 商户订单号
	 * @return XML 微信返回信息
	 */
	public function wxRequst ($out_trade_no) {
		// $openid = $this->get_seller_openid($out_trade_no);先注释掉 进行测试
		$path = str_replace('tools', 'mobile', BASE_PATH);
		include_once ($path . DS . '/api/payment/wxpay/WxPayHelper.php');
		$content = $this->wxParam; // 微信支付配置信息
		$arr = array ('out_trade_no' => $out_trade_no, 'partner' => $content['partner']);
		// 获得签名
		$sign = $this->_verify_result($arr);
		// 获得bag
		$package = "out_trade_no=" . $out_trade_no . "&partner=" . $content['partner'] . "&sign=" . $sign;
		// 获得时间
		$timestamp = time();
		// 获得app_signature
		$obj = array ('appid' => $content['appid'], 'appkey' => $content['appkey'], 'package' => $package, 'timestamp' => $timestamp);
		$WxPayHelper = new WxPayHelper();
		// get_biz_sign函数受保护，需要先取消一下，否则会报错
		$app_signature = $WxPayHelper->get_biz_sign($obj);
		
		// 3. 将构造的json提交给微信服务器，查询
		$jsonmenu = '{
		  "appid" : "' . $content['appid'] . '",
		  "package" : "' . $package . '",
		  "timestamp" : "' . $timestamp . '",
		  "app_signature" : "' . $app_signature . '",
		  "sign_method" : "sha1"
		 }';
		// echo $app_signature;die();
		$openid = $this->get_seller_openid($out_trade_no);
		// echo "woshi----------".$openid;die();
		// $openid = "oFbxouCTflWOP0GEfGTx1dNRTqtI";
		$access_token = $this->getUserAccessToken($openid); // 此openid还没存在 写方法时要注意//
		                                                    // echo $access_token;die();
		                                                    // echo $access_token;die();
		$url = "https://api.weixin.qq.com/pay/orderquery?access_token=" . $access_token;
		$result = $this->https_request($url, $jsonmenu);
		$objUser = json_decode($result);
		// $result = get_object_vars($objUser);
		// print_r($objUser);
		return $objUser;
	}

	/**
	 * @zhangyating 2014-11-12
	 *
	 * @param array $pram sign需要的参数
	 * @return string sign 签名
	 */
	private function _verify_result ($pram) {
		$buff = "";
		ksort($pram);
		foreach ($pram as $k => $v) {
			if (null != $v && "null" != $v && "sign" != $k) {
				$buff .= $k . "=" . $v . "&";
			}
		}
		$reqPar = "";
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff) - 1);
		}
		$key = $this->wxParam['key'];
		$result = strtoupper(md5($reqPar . "&key=" . $key));
		return $result;
	}

	/**
	 * 获得accessToken
	 *
	 * @param $openid String 用户对应公共平台的唯一标识
	 * @author zhangyating 2014-11-12
	 */
	private function getUserAccessToken ($openid) {
		$access_token = Model('weixin')->getACCESS_TOKEN(1);
		$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
		$jsonUser = $this->GetHttpResponseGET($url);
		$objUser = json_decode($jsonUser);
		$wechatInfo = get_object_vars($objUser);
		// 这个地方有个异常处理
		if ($wechatInfo["errcode"] == "40001") {
			$access_token = Model('weixin')->setACCESS_TOKEN(1);
			$obj = json_decode($s);
			$access_token = $obj->access_token;
		}
		
		return $access_token;
	}

	/**
	 * 模拟请求
	 *
	 * @author zhangyating 2014-11-12
	 * @param string $url
	 * @param string $data
	 * @return mixed
	 */
	private function https_request ($url, $data = null) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (! empty($data)) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
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
}
