<?php
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
/**
 * 佣金管理模型
 *
 * @copyright Copyright (c) 2013-2014 易享科技
 * @link http://www.exweixin.com
 * @since v1.0
 */
class commissionModel extends Model{	
	/**
	 * 佣金列表
	 * 查询条件：查询条件：
     * agent.agent_status=1
     * 并且
	 * agent.apply_sn=当前批次如201409	
	 * 并且
	 * agent.apply_status=0
	 * 并且
	 * agent.bankcard_status=1
	 */
	public function getAgentList($condition,$start,$pageSize) {	
		$date=date('Y').date('m')-1;
	    $lastmonthbegin=mktime(0,0,0,date("m")-1,date("d"),date("Y"));	
	    $lastmonthend=mktime(0,0,0,date("m"),date("d"),date("Y"));
	    $sql="select * from (SELECT sum(bill_amount) as bill_amount,sum(order_amount) as order_amount,agent_id,bill_time FROM `shopnc`.`shopnc_agent_bill` 
      		GROUP BY agent_id HAVING bill_time between $lastmonthbegin and $lastmonthend and bill_amount>0 ) 
      		as ab Left JOIN shopnc_agent as a on a.agent_id = ab.agent_id
      		 Left JOIN shopnc_channel as c on a.channel_id = c.channel_id 
      		Left JOIN shopnc_member as m on m.member_id = a.agent_id where a.apply_sn=$date and a.agent_status=1 and a.bankcard_status=1 and a.apply_status=0";
	    $cn= $condition['channel_name'];
	    if($cn!=''){
	    	$sql.=" and c.channel_name like '%$cn%'";	    	 		
	    }
	    $cm=$condition['member_truename'];
	    if($cm!=''){
	    	$sql.=" and m.member_truename='%$cm%' ";	    	 		
	    }
	    $ba=$condition['bill_amount'];
	    if($ba!=''){
	    	$sql.=" and ab.bill_amount=$ba ";
	    }	           	   
	    $sql.=" order by ab.bill_amount desc LIMIT $start,$pageSize";
	    $list=$this->query($sql);
	    return $list;
	
		
     }
	/**
	 * 
	 * @return 待结算总金额
	 */
	public function totalSalesCount(){
		$lastmonthbegin=mktime(0,0,0,date("m")-1,date("d"),date("Y"));
		$lastmonthend=mktime(0,0,0,date("m"),date("d"),date("Y"));
		$on="agent.agent_id=agent_bill.agent_id";
		$sales=$this->table('agent,agent_bill')->field('sum(agent_bill.bill_amount)')->join('inner')->on($on)->where('agent_bill.bill_time between '.$lastmonthbegin .' and '.$lastmonthend.' and agent.apply_status=0')->find();
		
		return $sales;
	}
	/**
	 * 
	 * 追加佣金表信息
	 * @return unknown
	 */
	public function getApplyList(){
		$lastmonthbegin=mktime(0,0,0,date("m")-1,date("d"),date("Y"));
		$lastmonthend=mktime(0,0,0,date("m"),date("d"),date("Y"));
		$applyList=$this->table('agent_bill')->field('sum(bill_amount),sum(order_amount),agent_id,bill_time')->group('agent_id')->having('bill_time between '.$lastmonthbegin .' and '.$lastmonthend.' and sum(bill_amount)>0')->order('sum(bill_amount) desc')->select();		
		return $applyList;
	}
		/**
		 * 单条信息列表
		 */
   public function getAgentInfo($condition, $extend = array(), $field = 'member.*,agent.*,channel.*', $order = '') {
   	       $lastmonthbegin=mktime(0,0,0,date("m")-1,date("d"),date("Y"));	
	        $lastmonthend=mktime(0,0,0,date("m"),date("d"),date("Y"));
		    $on = 'channel.channel_id=agent.channel_id,member.member_id=agent.agent_id';
		    $agent_info  = $this->table ('channel,agent,member' )->field ( $field )->join ( 'inner,inner' )->on ( $on )->where($condition)->order ( $order )->find ();	    		
		
			if (empty ( $agent_info )) {
				return array ();
			}
			// 追加佣金表信息
			if (in_array ( 'agent_bill', $extend )) {
				$agent_info ['extend_bill'] = Model ( 'agent_bill' )->field('sum(bill_amount),agent_id,bill_time')->where(array('agent_id'=>$condition['agent.agent_id']))->group('agent_id')->having('bill_time between '.$lastmonthbegin .' and '.$lastmonthend.'')->find ();
			}								
			return $agent_info;				
	}	
	/**
	 * 订单表信息
	 * @param unknown $condition  数组
	 * @param string $page 页数
	 * @param string $field 查询数据
	 * @param string $order 排序
	 * @param string $limit 条数
	 * @return unknown  订单表信息数组
	 */
	public function orderInfo($condition,$page='',$field = '*', $order = 'order.payment_time desc',$limit=''){
		$on="order.order_id=agent_bill.order_id";
		$orderInfo=$this->table('order,agent_bill')->field($field)->join('inner')->on($on)->where($condition)->page($page)->order($order)->limit()->select();		
		return $orderInfo;		
	}    
	/**
	 * 完结，标记，冻结列表信息
	 * @param unknown $condition
	 * @param string $page
	 * @param string $field
	 * @param string $order
	 * @param string $limit
	 * @param unknown $extend
	 * @return multitype:|Ambigous <multitype:unknown , unknown>
	 */
	public function getBillApplyList($condition, $page = '', $field = 'member.*,agent.*,channel.*,agent_bill_apply.*', $order = '', $limit = '',$extend = array()) {
		$lastmonthbegin=mktime(0,0,0,date("m")-1,date("d"),date("Y"));
		$lastmonthend=mktime(0,0,0,date("m"),date("d"),date("Y"));
		$on = 'channel.channel_id=agent.channel_id,member.member_id=agent.agent_id,agent.agent_id=agent_bill_apply.agent_id';
		$list = $this->table ('channel,agent,member,agent_bill_apply' )->field ( $field )->join ( 'inner,inner,inner' )->on ( $on )->where($condition)->page($page)->order ( $order )->limit ( $limit )->select ();
	
		if (empty ( $list ))
			return array ();
		$agent_list = array ();
		foreach ( $list as $value ) {
			if (! empty ( $extend ))
				$agent_list [$value ['agent_id']] = $value;
		}
		if (empty ( $agent_list ))
			$agent_list = $list;
			
		// 追加佣金表信息
		if (in_array ( 'agent_bill', $extend )) {
			$bill_array = array ();
			foreach ( $agent_list as $value ) {
				if (! in_array ( $value ['agent_id'], $bill_array ))
					$bill_array [] = $value ['agent_id'];
			}
			$bill_list = $this->getApplyList ( array (
					'agent_id' => array (
							'in',
							$bill_array
					)
			) );
	
			foreach ( $bill_list as $value ) {
				$bill_new_list [$value ['agent_id']] = $value;
			}
			foreach ( $agent_list as $agent_id => $agent ) {
				$agent_list [$agent_id] ['extend_bill'] = $bill_new_list [$agent ['agent_id']];
			}
		}
	
		return $agent_list;
	
	
	}	
	/**
	 *结算中，已完结，已冻结，已标记的本月待结算金额 
	 */
	public function totalCount(){
		$date=date('Y').date('m')-1;
		$where=array(
				'apply_status'=>'0',
				'apply_sn'=>$date				
		);		
	$totalCount=$this->table('agent_bill_apply')->field('sum(apply_money)')->where($where)->find();
	return $totalCount;
	}
	/**
	 *结算中，已完结，已冻结，已标记的本月已完结金额 
	 */
	public function totalCountFinish(){
		$date=date('Y').date('m')-1;
		$where=array(
				'apply_status'=>'1',
				'apply_sn'=>$date				
		);
		
	$totalCount=$this->table('agent_bill_apply')->field('sum(apply_money)')->where($where)->find();
	return $totalCount;
	}
	/**
	 *本月总金额 
	 */
	public function totalCounts(){
		$date=date('Y').date('m')-1;
		$where=array(
				'apply_sn'=>$date				
		);		
	$totalCount=$this->table('agent_bill_apply')->field('sum(apply_money)')->where($where)->find();
	return $totalCount;
	}	
	/**
	 * 总提现金额
	 * @param unknown $data
	 * @return unknown
	 */
	public function counts($count){	
		$totalCount=$this->table('agent_bill_apply')->field('sum(apply_money)')->where($count)->find();
		return $totalCount;
	}			
}