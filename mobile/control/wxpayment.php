<?php


/**
 * 支付回调
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

class wxpaymentControl extends mobileHomeControl{

	public function __construct() {
		parent::__construct();
	}

    /**
     * 微信支付回调
     */

 public function notifyOp() {
    	
if (isset($_GET)){
 	
 $model_order = Model('order');
  $model_payment = Model('payment');
  //商户订单号
  $out_trade_no = $_GET['out_trade_no'];
  //微信交易号
  $trade_no = $_GET['transaction_id'];
  //交易商号
  $trade_partner = $_GET['partner'];
  //支付接口代码
  $payment_code = 'wxpay';
  
 file_put_contents("9.txt",print_r($_GET,1));
  
   $model_order = Model('order');
   $model_payment = Model('payment');
   $model_bill = Model('agent_bill');
   
   //zhangyating 2014-9-17
  // include_once(BASE_PATH.DS.'/api/payment/wxpay/WxPayHelper1.php');
   
  // $commonUtil = new CommonUtil();
 //  $wxPayHelper = new WxPayHelper1();

//    $wxPayHelper->setParameter("bank_type", $_GET['bank_type']);
//    $wxPayHelper->setParameter("discount", $_GET['discount']);
//    $wxPayHelper->setParameter("fee_type", $_GET['fee_type']);
//    $wxPayHelper->setParameter("input_charset", $_GET['input_charset']);
//    $wxPayHelper->setParameter("notify_id",$_GET['notify_id']);
//    $wxPayHelper->setParameter("out_trade_no", $_GET['out_trade_no']);//$commonUtil->create_noncestr()
//    $wxPayHelper->setParameter("partner", $_GET['partner']);
//    $wxPayHelper->setParameter("product_fee", $_GET['product_fee']);
//    $wxPayHelper->setParameter("sign", $_GET['sign']);
//    $wxPayHelper->setParameter("sign_type", $_GET['sign_type']);
//    $wxPayHelper->setParameter("time_end", $_GET['time_end']);
//    $wxPayHelper->setParameter("total_fee", $_GET['total_fee']);
//    $wxPayHelper->setParameter("trade_mode", $_GET['trade_mode']);
//    $wxPayHelper->setParameter("trade_state", $_GET['trade_state']);
//    $wxPayHelper->setParameter("transaction_id", $_GET['transaction_id']);
//    $wxPayHelper->setParameter("transport_fee", $_GET['transport_fee']);
//    $wOpt = array();
   
//    $wOpt = $wxPayHelper->create_biz_package();
//    //file_put_contents("sign.txt",print_r($wOpt,1) ."  ". print_r($_SERVER ,1));
//    //zhangyating 2014-9-17 end
//    print_r($_GET);
//    print_r($wOpt);
   
   $signs = $this->_verify_result();
  
  if($signs == $_GET['sign']) {
  	
  	$notify_end = Model()->table("order_pay")->where(array('pay_sn'=>$out_trade_no))->find();
  	
  	 if($notify_end['api_pay_state']){
  		echo "success";
  		exit();
  	 }else{
  	 
  	 	$order_list = $model_order->getOrderList(array('pay_sn'=>$out_trade_no,'order_state'=>ORDER_STATE_NEW));
  	 	$result = $model_payment->updateProductBuy($out_trade_no, $payment_code, $order_list, $trade_no);
  	 	
  	 	$mobile = $this->getMob($order_list[0]['order_id']);
  	 	$people = $this->getPeople($order_list[0]['order_id']);
  	 	
  	 	$message = "用户：".$people."，您好！感谢您在新玉麟电商平台消费".$order_list[0]['order_amount']."元，我们将尽快为您发货，请您耐心等候！有任何问题,请联系客服人员：400-050-9988";
  	 	Sms::send($mobile, $message,&$error);
  	 	Model('push_interface')->order_success($out_trade_no,$people); //下推接口 zhangyating 2014-11-16
  	 	$model_bill->setAgentBill($out_trade_no);
  	 	
  	 }

  		
  		
  	
  	if(empty($result['error'])) {
  		echo "error";

  	}else{
  		
  		 echo "success";
  	}
  	
  	
  }else{
  	
  	echo "fail";
  	
  }
 	
 }

    }
    
    
    /*
     * 微信回调验证
     */
	    private function _verify_result() {
	    	unset($_GET['act']);	//将系统的控制参数置空，防止因为加密验证出错
	    	unset($_GET['op']);	//将系统的控制参数置空，防止因为加密验证出错
	    	//排序$_GET
	    	// ksort($_GET);
	    	 
	    	 $buff = "";
	    	 ksort($_GET);
	    	 foreach ($_GET as $k => $v){
	    	 	if (null != $v && "null" != $v && "sign" != $k) {
	    	 		$buff .= $k . "=" . $v . "&";
	    	 	}
	    	 }
	    	 $reqPar="";
	    	 if (strlen($buff) > 0) {
	    	 	$reqPar = substr($buff, 0, strlen($buff)-1);
	    	 }
	    	 
	    	 
	    	// echo $reqPar."&key=55c44e387a1269603a8be3abf07dd572";
	    	 $result = strtoupper(md5($reqPar."&key=55c44e387a1269603a8be3abf07dd572"));
	    	 
	    	 return $result;
	    	 
	    }
	    
	    
	    /**
	     * 
	     * @param int $order_id 订单id
	     * @return 电话号码
	     */
	    function getMob($order_id){
	    	$model = Model();
	    	$order = $model->table('order')->where("order_id = ".$order_id)->find();
	    	//通过订单ID 查询电话号
	    	$obj = $model->table('order_common')->where("order_id = ".$order_id)->find();
	    	$obj = unserialize($obj['reciver_info']);
	    	$obj = explode(",",$obj['phone']);
	    	$mobile = $obj[0];
	    	return $mobile;
	    }
	    
	    
	    /**
	     * 
	     * @param int $order_id 订单id
	     * @return string 用户名称
	     */
	    function getPeople($order_id){
	    	$model = Model();
	    	$order = $model->table('order')->where("order_id = ".$order_id)->find();
	    	$obj = $model->table('order_common')->where("order_id = ".$order_id)->find();
	    	$obj =$obj['reciver_name'];
	    	return $obj;
	    }
    
}
