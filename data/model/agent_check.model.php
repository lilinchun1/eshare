<?php
/**
 * 代理管理申请模型
 *
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.0
 */
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
class agent_checkModel extends Model {
	/**
	 * 获取申请信息表
	 * @param unknown $condition  数组查询条件
	 * @param unknown $page  分页
	 * @param unknown $order  排序
	 * @return unknown   信息表数组
	 */
	public function getAgentCheckList($condition,$page,$order){
		$on="agent_check.agent_id=agent.agent_id,agent.agent_id=member.member_id";
		$list=$this->table('agent_check,agent,member')->field('agent_check.*,agent.*,member.*')->join('inner,inner')->on($on)->where($condition)->page($page)->order($order)->select();
	    return $list;
	}
	
	/**
	 * 修改审核状态
	 * @param unknown $condition
	 */
	public function updateCheckData($condition){
	  return	$this->table('agent_check')->where(array('agent_id'=>$condition['agent_id']))->update($condition);
		 
	}
	/**
	 * 修改申请信息
	 * @param unknown $condition
	 */
	public function updateData($condition){
		
	 return   $this->table('agent')->where(array('agent_id'=>$condition['agent_id']))->update($condition);
	   
	}
	
}