<?php
/**
*模块名称：微信分享
*创建者：赵昕
*创建时间：2014-9-16
*
* @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
* @license    http://www.shopnc.net
* @link       http://www.shopnc.net
* @since      File available since Release v1.1
*/
defined('InShopNC') or exit('Access Invalid!');
class store_shareModel extends Model{

	public function __construct(){
		parent::__construct('store_wxshare');
	}

	/**
	 * 读取列表
	 * @param array $condition
	 *
	 */
	public function getStoreShareList($condition, $page='', $order='createtime', $field='*') {
		$result = $this->field($field)->where($condition)->page($page)->order($order)->select();
		return $result;
	}

	/**
	 * 读取单条记录
	 * @param array $condition
	 *
	 */
	public function getStoreShareInfo($condition) {
		$result = $this->where($condition)->find();
		return $result;
	}

	/**
	 * 增加
	 * @param array $param
	 * @return bool
	 */
	public function addStoreShare($param){
		return $this->insert($param);
	}

	/**
	 * 更新
	 * @param array $update
	 * @param array $condition
	 * @return bool
	 */
	public function editStoreShare($update, $condition){
		return $this->where($condition)->update($update);
	}

	/**
	 * 删除
	 * @param array $condition
	 * @return bool
	 */
	public function delStoreShare($condition){
		return $this->where($condition)->delete();
	}

}