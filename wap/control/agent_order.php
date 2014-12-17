<?php
/**
 * 代理商订单
 *
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.0
 */
defined('InShopNC') or exit('Access Invalid!');
class agent_orderControl extends mobileAgentControl{
	public function __construct() {
        parent::__construct();
    }
    /**
     * 订单列表
    */
    public function indexOp() {
	    $state = intval($_GET['state']);
		$model = Model();
		$this->page = PAGE_SIZE;
		$model_order = Model('order');
        $condition = array();
        $condition['agent_id'] = $this->agent_id;
		$condition['cancel'] = 0;
		if(intval($_GET['state'])){
			$condition['order_state'] = intval($_GET['state']);
		}
		$count_sum = $model->table('order')->where($condition)->count();
		$count_0  = $model->table('order')->where('agent_id ='.$this->agent_id.' and cancel!="1"')->count();
		$count_10 = $model->table('order')->where('agent_id ='.$this->agent_id.' and order_state="10"')->count();
		$count_20 = $model->table('order')->where('agent_id ='.$this->agent_id.' and order_state="20"')->count();
		$count_30 = $model->table('order')->where('agent_id ='.$this->agent_id.' and order_state="30"')->count();
		$count_40 = $model->table('order')->where('agent_id ='.$this->agent_id.' and order_state="40" and cancel!="1"')->count();

//         $order_list_array = $model_order->getOrderList($condition, $this->page, '*', 'order_id desc','', array('order_goods','order_common'));
		
//         $order_group_list = array();
//         $order_pay_sn_array = array();
//         foreach ($order_list_array as $value) {
//         	//双12添加代码 zyt 活动结束即可删除
//         	$goods_id = $value['extend_order_goods'][0]['goods_id'];
// 		 	$value['phone'] = explode(",",$value['extend_order_common']['reciver_info']['phone']);
// 			$value['phone'] = $value['phone'][0];
// 			if($value['order_state']==0){
// 				$value['class'] = '已取消';
// 			}elseif($value['order_state']==10){
// 				$value['class'] = '待付款';
// 			}elseif($value['order_state']==20){
// 				//双12添加代码 zyt 活动结束即可删除
// 				if($goods_id == "298"){
// 					$value['class'] = '已付定金';
// 				}else{
// 					$value['class'] = '待发货';
// 				}
				
// 			}elseif($value['order_state']==30){
// 				$value['class'] = '已发货';
// 			}elseif($value['order_state']==40){
// 				$value['class'] = '已完成';
// 			}

//             //显示取消订单
//             $value['if_cancel'] = $model_order->getOrderOperateState('buyer_cancel',$value);
//             //显示收货
//             $value['if_receive'] = $model_order->getOrderOperateState('receive',$value);
//             //显示锁定中
//             $value['if_lock'] = $model_order->getOrderOperateState('lock',$value);
//             //显示物流跟踪
//             $value['if_deliver'] = $model_order->getOrderOperateState('deliver',$value);

//             $order_group_list[$value['pay_sn']]['order_list'][] = $value;

//             //如果有在线支付且未付款的订单则显示合并付款链接
//             if ($value['order_state'] == ORDER_STATE_NEW) {
//                 $order_group_list[$value['pay_sn']]['pay_amount'] += $value['order_amount'];
//             }
//             $order_group_list[$value['pay_sn']]['add_time'] = $value['add_time'];

//             //记录一下pay_sn，后面需要查询支付单表
//             $order_pay_sn_array[] = $value['pay_sn'];
//         }

//         $new_order_group_list = array();
//         foreach ($order_group_list as $key => $value) {
//             $value['pay_sn'] = strval($key);
//             $new_order_group_list[] = $value;
//         }
		
//  		$curpage = isset($_GET['curpage']) ? $_GET['curpage'] : 1;
// 		$curpage = intval($curpage);
// 		if($curpage<=1){
// 			$curpage = 1;
// 		}
		
//         $page_count = $model_order->where($condition)->gettotalpage();
		//print_r($new_order_group_list);
        
		include wap('agent_order');
    }
	
   /**
    * 加载更多
    */
    public function moreOp() {
    	$this->page = PAGE_SIZE; 	    	
		$model_order = Model('order');
        $condition = array();
        $condition['agent_id'] = $this->agent_id;
		$condition['cancel'] = 0;
		if(intval($_GET['state'])){
			$condition['order_state'] = intval($_GET['state']);
		}
		
        $order_list_array = $model_order->getOrderList($condition, $this->page, '*', 'order_id desc','', array('order_goods','order_common'));
	
        $order_group_list = array();
        $order_pay_sn_array = array();
        foreach ($order_list_array as $value) {

		 	$value['phone'] = explode(",",$value['extend_order_common']['reciver_info']['phone']);
			$value['phone'] = $value['phone'][0];
			if($value['order_state']==0){
				$value['class'] = '已取消';
			}elseif($value['order_state']==10){
				$value['class'] = '待付款';
			}elseif($value['order_state']==20){
				$value['class'] = '待发货';
			}elseif($value['order_state']==30){
				$value['class'] = '已发货';
			}elseif($value['order_state']==40){
				$value['class'] = '已完成';
			}

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
        $curpage = isset($_GET['curpage']) ? $_GET['curpage'] : 1;
        $curpage = intval($curpage);
        if($curpage<=1){
        	$curpage = 1;
        }
        
        $page_count = $model_order->where($condition)->gettotalpage();
        if(!empty($new_order_group_list)){
        	 output_data(array ('status' => 1, 'new_order_group_list' => $new_order_group_list,'page_count'=>$page_count,'curpage'=>$curpage));
        }else{
        	output_data(array('status'=>0));
        }
    	//echo json_encode($new_order_group_list);
    }
	
	public function cancel_orderOp() {
		$order_id = intval($_GET['order_id']);
		$model = Model();
		$data = array(
    		'cancel'=>'1',
		);
		$date = $model->table('order')->where('agent_id ='.$this->agent_id.' and order_id ='.$order_id)->update($data);
		echo json_encode($date);
	}

} 