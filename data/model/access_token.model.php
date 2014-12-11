<?php
/**
 * 微信配置模型
 *litianzhuo
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.1.4
 */
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
class access_tokenModel extends Model {
	
	
	/**
	 * 获取appid和appserect
	 * @param unknown $condition 数组
	 * @param unknown $page  分页数
	 * @param unknown $order  排序
	 */
	public function getTokenList($condition,$page,$order){
		return $this->table('access_token')->where($condition)->page($page)->order($order)->select();
	}
	/**
	 * 获取appid和appserect
	 * @param unknown $condition 数组
	 */
	public function getTokenInfo($condition){
		return $this->table('access_token')->where($condition)->find();
	}
	
	
}