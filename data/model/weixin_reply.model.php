<?php
/**
 * 微信回复模型
 *litianzhuo
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.1.4
 */
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
class weixin_replyModel extends Model {
	
	
	/**
	 * 获取回复信息
	 * @param unknown $condition 数组
	 * @param unknown $page  分页数
	 * @param unknown $order  排序
	 */
	public function getReplyList($condition,$page,$group,$order){
		$field="weixin_keyword.*,weixin_reply.*";
		$on="weixin_keyword.keyword_id=weixin_reply.keyword_id";
		return $this->table('weixin_keyword,weixin_reply')->field($field)->join('inner')->on($on)->where($condition)->group($group)->page($page)->order($order)->select();
	}
	/**
	 * 获取回复详细信息
	 * @param unknown $condition 数组
	 */
	public function getReplyInfo($condition){
		$field="weixin_keyword.*,weixin_reply.*";
		$on="weixin_keyword.keyword_id=weixin_reply.keyword_id";
		return $this->table('weixin_keyword,weixin_reply')->field($field)->join('inner')->on($on)->where($condition)->find();
	}
	
	
}