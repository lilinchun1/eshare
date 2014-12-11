<?php
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
/**
 * 佣金管理模型
 * 李天卓
 * @copyright Copyright (c) 2013-2014 易享科技
 * @link http://www.exweixin.com
 * @since v1.0
 */
class brokerageModel extends Model{	
	/**
	 * 待结算查询/结算中查询
	 * @param unknown $condition 条件
	 * @param string $page 分页
	 * @return 待结算数据
	 */
	public function getApplyList($condition,$page='',$order=''){
		$field='member.*,agent.*,channel.*,agent_apply.*,agent_bank.*';
		$on = 'channel.channel_id=agent.channel_id,member.member_id=agent.agent_id,agent.agent_id=agent_apply.agent_id,agent.bankcard_type=agent_bank.bank_id';
		$list = $this->table ('channel,agent,member,agent_apply,agent_bank' )->field ( $field )->join ( 'inner,inner,inner,inner' )->on ( $on )->where($condition)->page($page)->order($order)->select ();
		return $list;		
	}
	/**
	 * 结算中查询
	 * @param unknown $condition 条件
	 * @param string $page 分页
	 * @return 结算中数据
	 */
	public function getSettleList($condition,$page=''){
        $list=$this->table('agent_apply')->where($condition)->page($page)->select();
        return $list;		
	}
	
	
	public function getBatchSn(){
		//上月25号时间戳
		$last=mktime(0,0,0,date('m')-1,25,date('Y'));
		//今天时间戳
		$now=TIMESTAMP;
		//本月15号时间戳
		$day=mktime(0,0,0,date('m'),15,date('Y'));
		//本月25号时间戳
		$end=mktime(0,0,0,date('m'),25,date('Y'));
		//下月15号时间戳
		$begin=mktime(0,0,0,date('m')+1,15,date('Y'));
		$batch_sn='';
		if($now>=$last && $now<$day){
			$batch_sn=intval(date('Y') . date('m')-1 . '02');
		}else if($now>=$day && $now<$end){
			$batch_sn=intval(date('Y') . date('m') . '01');
		}else if($now>=$end && $now<$begin){
			$batch_sn=intval(date('Y') . date('m') . '02');
		}
		
		return $batch_sn;
	}
// 	/**
// 	 * 订单表信息
// 	 * @param unknown $condition  数组
// 	 * @param string $page 页数
// 	 * @param string $field 查询数据
// 	 * @param string $order 排序
// 	 * @param string $limit 条数
// 	 * @return unknown  订单表信息数组
// 	 */
// 	public function orderInfo($condition,$page='',$field = 'order.*,agent_bill.*', $order = 'payment_time desc'){
// 		$on="order.order_id=agent_bill.order_id";
// 		$orderInfo=$this->table('order,agent_bill')->field($field)->join('inner')->on($on)->where($condition)->page($page)->order($order)->select();
// 		return $orderInfo;
// 	}
}