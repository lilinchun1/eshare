<?php
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
/**
 * 机构管理模型
 *
 * @copyright Copyright (c) 2013-2014 易享科技
 * @link http://www.exweixin.com
 * @since v1.0
 */
class channelModel extends Model {
	public function __construct() {
		parent::__construct ( 'channel' );
	}
	/**
	 * 查询机构列表
	 *
	 * @param array $condition
	 *        	查询条件
	 * @param int $page
	 *        	分页数
	 * @param string $order
	 *        	排序
	 * @param string $field
	 *        	字段
	 *        	$order = 'channel_expire_time'
	 * @return array
	 */
	public function getChannelList($condition, $page = '', $order = '', $field = '*') {
		$result = $this->field ( $field )->where ( $condition )->order ( $order )->page ( $page )->select ();
		return $result;
	}
	/**
	 * 读取单条记录
	 */
	public function getChannelInfo($id) {
		$result = $this->where ( array (
				'channel_id' => $id 
		) )->find ();
		return $result;
	}
	
	/*
	 * 添加机构 @param array $param 店铺信息 @return bool
	 */
	public function addChannel($param) {
		return $this->insert ( $param );
	}
	
	/*
	 * 编辑机构 @param array $update 更新信息 @param array $condition 条件 @return bool
	 */
	public function editChannel($update, $id) {
		return $this->where ( array (
				'channel_id' => $id 
		) )->update ( $update );
	}
	
	/*
	 * 删除机构 @param array $condition 条件 @return bool
	 */
	public function delChannel($id) {
		
		// $channel_info = $this->getChannelInfo($id);
		// 删除店铺相关图片
		// @unlink(BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$channel_info['channel_logo']);
		return $this->where ( array (
				'channel_id' => $id 
		) )->delete ();
	}
}
	