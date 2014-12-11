<?php
/**
 * 代理管理模型
 *
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.0
 */
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
class agent_nameModel extends Model {
	/**
	 * 代理商列表
	 * 
	 * @param unknown $extend
	 *        	追加返回那些表的信息,如array('order_common','order_goods','store')
	 */
	public function getAgentList($condition, $page = '', $field = 'member.*,agent.*', $order = 'member.member_time desc', $limit = '', $extend = array()) {
		$on = 'member.member_id=agent.agent_id';
		$list = $this->table ( 'member,agent' )->field ( $field )->join ( 'inner' )->on ( $on )->where ( $condition )->page ( $page )->order ( $order )->limit ( $limit )->select ();
		
		if (empty ( $list ))
			return array ();
		$agent_list = array ();
		foreach ( $list as $value ) {
			if (! empty ( $extend ))
				$agent_list [$value ['agent_id']] = $value;
		}
		if (empty ( $agent_list ))
			$agent_list = $list;
			
			// 追加所属机构表信息
		if (in_array ( 'channel', $extend )) {
			$channel_id_array = array ();
			foreach ( $agent_list as $value ) {
				if (! in_array ( $value ['channel_id'], $channel_id_array ))
					$channel_id_array [] = $value ['channel_id'];
			}
			$channel_list = $this->getChannelList ( array (
					'channel_id' => array (
							'in',
							$channel_id_array 
					) 
			) );
			
			
			foreach ( $channel_list as $value ) {
				$channel_new_list [$value ['channel_id']] = $value;
			}
			foreach ( $agent_list as $agent_id => $agent ) {
				$agent_list [$agent_id] ['extend_channel'] = $channel_new_list [$agent ['channel_id']];
			}
		}
		
		// 追加级别表信息
		if (in_array ( 'store_reward', $extend )) {
			$level_id_array = array ();
			foreach ( $agent_list as $value ) {
				if (! in_array ( $value ['level_id'], $level_id_array ))
					$level_id_array [] = $value ['level_id'];
			}
			$level_list = $this->getStoreRewardList ( array (
					'level_id' => array (
							'in',
							$level_id_array 
					) 
			) );
			
			foreach ( $level_list as $value ) {
				$level_new_list [$value ['level_id']] = $value;
			}
			foreach ( $agent_list as $agent_id => $agent ) {
				$agent_list [$agent_id] ['extend_store_reward'] = $level_new_list [$agent ['level_id']];
			}
		}
		
		
		//追加直属团队人数信息
		if(in_array('person',$extend)){
		$person_id_array = array();
		foreach ($agent_list as $value) {
		if (!in_array($value['agent_id'],$person_id_array)) $person_id_array[] = $value['agent_id'];
		
		}
		
		$person_list=$this->agentPersonInfo(array('agent_id'=>array('in',$person_id_array)));
	  
		foreach ($person_list as $value){
		$person_new_list[$value['agent_id']]=$value;
		
		}
		foreach ($agent_list as $agent_id => $agent) {
		$agent_list[$agent_id]['extend_person'] = $person_new_list[$agent['agent_id']];
		}
		}
		//追加扩展团队人数
		if(in_array('son',$extend)){
		$son_id_array = array();
		foreach ($agent_list as $value) {
		if (!in_array($value['agent_id'],$son_id_array)) $son_id_array[] = $value['agent_id'];
		
		}
		$son_list=$this->agentSonInfo(array('agent_id'=>array('in',$son_id_array)));
		
		foreach ($son_list as $value){
		$son_new_list[$value['agent_id']]=$value;
		
		}
		foreach ($agent_list as $agent_id => $agent) {
		$agent_list[$agent_id]['extend_son'] = $son_new_list[$agent['agent_id']];
		}
		}
		
		return $agent_list;
	}
	
	/**
	 * 单条信息列表
	 */
	public function getAgentInfo($condition, $extend = array(), $fields = '*', $order = '', $group = '') {
		$agent_info = $this->table ( 'agent' )->field ( $fields )->where ( $condition )->group ( $group )->order ( $order )->find ();
		
		if (empty ( $agent_info )) {
			return array ();
		}
		// 追加机构表信息
		if (in_array ( 'channel', $extend )) {
			$agent_info ['extend_channel'] = Model ( 'channel' )->where ( array (
					'channel_id' => $agent_info ['channel_id'] 
			) )->find ();
		}
		
		// 追加返回店铺信息
		if (in_array ( 'member', $extend )) {
			$agent_info ['extend_member'] = Model ( 'member' )->getMemberInfo ( array (
					'member_id' => $agent_info ['agent_id'] 
			) );
		}
		// 追加返回级别信息
		if (in_array ( 'store_reward', $extend )) {
			$agent_info ['extend_store_reward'] = Model ( 'store_reward' )->where( array (
					'level_id' => $agent_info ['level_id'] 
			) )->find();
		}
		// 追加直属团队人数信息
		if (in_array ( 'store_reward', $extend )) {
			$agent_info ['extend_person'] = Model ( 'agent_inheritance' )->field('count(child_id),agent_id')->where( array (
					'agent_id' => $agent_info ['agent_id'] ,'type'=>'p'
			) )->group('agent_id')->find();
		}
		// 追加扩展团队人数信息
		if (in_array ( 'store_reward', $extend )) {
			$agent_info ['extend_son'] = Model ( 'agent_inheritance' )->field('count(child_id),agent_id')->where( array (
					'agent_id' => $agent_info ['agent_id'] ,'type'=>'s'
			) )->group('agent_id')->find();
		}
		$agent_id=$agent_info ['agent_id'];
		// 追加直属团队业绩信息
		if (in_array ( 'store_reward', $extend )) {
			$agent_info ['extend_person_sum'] =Model('cache_agent')->field('sum(s1_order_amount),agent_id')->where(array (
					'agent_id' => $agent_info ['agent_id']))->group('agent_id')->find();
			//query("select sum(total_sales) from shopnc_agent as a where a.agent_id in (select child_id from shopnc_agent_inheritance as ai where ai.type='p' and ai.agent_id=$agent_id)");
		}
		// 追加扩展团队业绩信息
		if (in_array ( 'store_reward', $extend )) {
			$agent_info ['extend_son_sum'] = Model('cache_agent')->field('sum(s2_order_amount),agent_id')->where(array (
					'agent_id' => $agent_info ['agent_id']))->group('agent_id')->find();
		}
		
		return $agent_info;
	}
	
	/**
	 * 取得机构表列表
	 * 
	 * @param unknown $condition        	
	 * @param string $fields        	
	 * @param string $limit        	
	 */
	public function getChannelList($condition = array(), $fields = '*', $limit = null) {
		return $this->table ( 'channel' )->field ( $fields )->where ( $condition )->limit ( $limit )->select ();
	}
	/**
	 * 取得用户表列表
	 * 
	 * @param unknown $condition        	
	 * @param string $fields        	
	 * @param string $limit        	
	 */
	public function getMemberList($condition = array(), $fields = '*', $limit = null) {
		return $this->table ( 'member' )->field ( $fields )->where ( $condition )->limit ( $limit )->select ();
	}
	/**
	 * 取得级别表列表
	 * 
	 * @param unknown $condition        	
	 * @param string $fields        	
	 * @param string $limit        	
	 */
	public function getStoreRewardList($condition = array(), $fields = '*', $limit = null) {
		return $this->table ( 'store_reward' )->field ( $fields )->where ( $condition )->limit ( $limit )->select ();
	}
	
	/**
	 * 直属团队人数
	 * @param unknown $condition
	 */
	public function agentPersonInfo($condition = array()){
		$condition['type']='p';
		return $this->table('agent_inheritance')->field('count(child_id),agent_id')->where($condition)->group('agent_id')->select();
	}
	/**
	 * 扩展团队人数
	 * @param unknown $condition
	 */
	public function agentSonInfo($condition = array()){
		$condition['type']='s';
		return $this->table('agent_inheritance')->field('count(child_id),agent_id')->where($condition)->group('agent_id')->select();
	}
}
