<?php
defined('InShopNC') or exit('Access Invalid!');
/**
 * 测试页
 */
class listControl extends mobileHomeControl {
	public function __construct () {
		parent::__construct();
	}

	public function listOp () {
		$u = "http://".rtrim($_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"],"act=list&op=list");
		//修复
		$where = "order_supervisory.check_status='1' and order.order_state='10'";
		$field_list = 'order_supervisory.*';
		$agent_info = Model()->table('order_supervisory,order')
			->field($field_list)
			->join('LEFT')
			->on('order_supervisory.pay_sn = order.pay_sn')
			->where($where)
			->limit("0,100")
			->select();
		
		//修复
		$where = "order_supervisory.check_status='1' and order.order_state='0'";
		$field_list = 'order_supervisory.*';
		$agent_info1 = Model()->table('order_supervisory,order')
		->field($field_list)
		->join('LEFT')
		->on('order_supervisory.pay_sn = order.pay_sn')
		->where($where)
		->limit("0,100")
		->select();
		
		include tools('test');
			
		}

}
