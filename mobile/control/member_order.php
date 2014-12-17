<?php
/**
 * 我的订单
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
class member_orderControl extends mobileMemberControl {
	public function __construct(){
		parent::__construct();
	
	}
    /**
     * 订单列表
     */
    public function order_listOp() {
		
		$model_order = Model('order');
		$order_id = intval($_GET['order_id']);

        $condition = array();
		$condition['buyer_id'] = $this->member_info['member_id'];
		$condition['buyer_cancel'] = 0;
		if($order_id){
			$condition['order_id'] = $_GET['order_id'];
		}
		
		$count_0  = $model_order->table('order')->where('buyer_id ='.$this->member_info['member_id'].' and buyer_cancel="0"')->count();
		$count_10 = $model_order->table('order')->where('buyer_id ='.$this->member_info['member_id'].' and order_state="10" and buyer_cancel="0"')->count();
		$count_20 = $model_order->table('order')->where('buyer_id ='.$this->member_info['member_id'].' and order_state="20" and buyer_cancel="0"')->count();
		$count_30 = $model_order->table('order')->where('buyer_id ='.$this->member_info['member_id'].' and order_state="30" and buyer_cancel="0"')->count();
		$count_40 = $model_order->table('order')->where('buyer_id ='.$this->member_info['member_id'].' and order_state="40" and buyer_cancel="0"')->count();
		//个个类型的总数
		$count_num = array(
				'count_0'=>$count_0,
				'count_10'=>$count_10,
				'count_20'=>$count_20,
				'count_30'=>$count_30,
				'count_40'=>$count_40
		);
		//个个类型的总数结束
		//$condition['order_state'] = array('egt',10);
		//订单分类
		if($_POST['order_state']){
			$condition['order_state'] = $_POST['order_state'];
		}
		
		//订单分类结束
        $order_list_array = $model_order->getOrderList($condition, $this->page, '*', 'order_id desc','', array('order_goods'));
		foreach($order_list_array as $k=>$v){
			//echo $v['agent_id'];
			$data = $model_order->getAgentName($v['agent_id']);
			$order_list_array[$k]['agent_name'] = $data['agent_name'];
			$order_list_array[$k]['agent_time'] = date("Y/m/d H:i:s",$v['add_time']);
		}
        $order_group_list = array();
        $order_pay_sn_array = array();
        foreach ($order_list_array as $value) {
            //显示取消订单
            $value['if_cancel'] = $model_order->getOrderOperateState('buyer_cancel',$value);
            //显示收货
            $value['if_receive'] = $model_order->getOrderOperateState('receive',$value);
            //显示锁定中
            $value['if_lock'] = $model_order->getOrderOperateState('lock',$value);
            //显示物流跟踪
            $value['if_deliver'] = $model_order->getOrderOperateState('deliver',$value);

            $order_group_list[$value['pay_sn']]['order_list'][] = $value;

            //如果有在线支付且未付款的订单则显示合并付款链接
            if ($value['order_state'] == ORDER_STATE_NEW) {
                $order_group_list[$value['pay_sn']]['pay_amount'] += $value['order_amount'];
            }
            $order_group_list[$value['pay_sn']]['add_time'] = $value['add_time'];

            //记录一下pay_sn，后面需要查询支付单表
            $order_pay_sn_array[] = $value['pay_sn'];
        }

        $new_order_group_list = array();
        foreach ($order_group_list as $key => $value) {
            $value['pay_sn'] = strval($key);
            $new_order_group_list[] = $value;
        }
		
        $page_count = $model_order->gettotalpage();
		
        output_data(array('order_group_list' => $new_order_group_list,'count_num'=>$count_num), mobile_page($page_count));
    }
	
	 /**
     * 订单详情 
	 * qinwei 2014-9-1
     */
    public function order_list_detailOp() {
		$model_order = Model('order');
		$order_id = intval($_GET['order_id']);
		if(!$order_id){
			output_error('参数错误');
		}
		
 
        $condition = array();
        $condition['buyer_id'] = $this->member_info['member_id'];
		$condition['order_id'] = $_GET['order_id'];
		
        $order_list_array = $model_order->getOrderList($condition, $this->page, '*', 'order_id desc','', array('order_goods','order_common'));
		foreach($order_list_array as $k=>$v){
			$data = $model_order->getAgentName($v['agent_id']);
			$order_list_array[$k]['agent_name'] = $data['agent_name'];
			$order_list_array[$k]['agent_time'] = date("Y/m/d H:i:s",$v['add_time']);
		}
        $order_group_list = array();
        $order_pay_sn_array = array();
        foreach ($order_list_array as $value) {
            //显示取消订单
            $value['if_cancel'] = $model_order->getOrderOperateState('buyer_cancel',$value);
            //显示收货
            $value['if_receive'] = $model_order->getOrderOperateState('receive',$value);
            //显示锁定中
            $value['if_lock'] = $model_order->getOrderOperateState('lock',$value);
            //显示物流跟踪
            $value['if_deliver'] = $model_order->getOrderOperateState('deliver',$value);

            $order_group_list[$value['pay_sn']]['order_list'][] = $value;

            //如果有在线支付且未付款的订单则显示合并付款链接
            if ($value['order_state'] == ORDER_STATE_NEW) {
                $order_group_list[$value['pay_sn']]['pay_amount'] += $value['order_amount'];
            }
            $order_group_list[$value['pay_sn']]['add_time'] = $value['add_time'];

            //记录一下pay_sn，后面需要查询支付单表
            $order_pay_sn_array[] = $value['pay_sn'];
        }

        $new_order_group_list = array();
        foreach ($order_group_list as $key => $value) {
            $value['pay_sn'] = strval($key);
            $new_order_group_list[] = $value;
        }
		
        $page_count = $model_order->gettotalpage();
	
        output_data(array('order_group_list' => $new_order_group_list,'order_id' => $order_id,'agent_info' => $this->agent_info), mobile_page($page_count));
    }


    /**
     * 取消订单
     */
    public function order_cancelOp() {
        $extend_msg = '其它原因';
		
        $this->change_order_state('order_cancel', $extend_msg);
    }
    
    /**
     * 删除订单 zhangyating
     */
    public function order_deleteOp(){
    	$order_id = $_POST['order_id'];
    	$condition = array();
    	$condition['order_id'] = $order_id;
    	$condition['buyer_id'] = $this->member_info['member_id'];
    	$data = array(
    			'buyer_cancel'=>1
    	);
    	$result = Model()->table('order')->where($condition)->update($data);
    	output_data('1');
    }

    /**
     * 订单确认收货
     */
    public function order_receiveOp() {
        $this->change_order_state('order_receive');
    }

    /**
     * 修改订单状态
     */
	private function change_order_state($state_type, $extend_msg = '') {
        $order_id = intval($_POST['order_id']);

        $model_order = Model('order');

		$condition = array();
		$condition['order_id'] = $order_id;
        $condition['buyer_id'] = $this->member_info['member_id'];
		$order_info	= $model_order->getOrderInfo($condition);

        $result = $model_order->memberChangeState($state_type, $order_info, $this->member_info['member_id'], $this->member_info['member_name'], $extend_msg);
	
        if(empty($result['error'])) {
            output_data('1');
        } else {
            output_error($result['error']);
        }
    }


}
