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

class payment_wxControl extends mobileControl {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 张亚婷 2014-9-14
	 *为微信支付成功添加一个跳转页面
	 */
	
	public function wxShowOp(){
		
		 $model_order = Model('order');
		$order_list = $model_order->getOrderList(array('pay_sn'=>$_GET['pay_sn'],'order_state'=>ORDER_STATE_PAY));
		
		//print_r($order_list);
		
		if($_GET['result'] == 'success'){
			
			Tpl::output('order_list', $order_list);
			Tpl::output('result', 'success');
			Tpl::output('message', '支付成功');
		}else{
			
			Tpl::output('result', 'fail');
         	Tpl::output('message', '支付失败');
			
		}
		
		Tpl::showpage('payment_message');
		 
	}
}
