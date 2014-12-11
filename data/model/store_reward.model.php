<?php
/**
 * 升级奖励模型
 * @author Administrator
 *
 */
defined('InShopNC') or exit('Access Invalid!');

class store_rewardModel extends Model {
    public function __construct(){
        parent::__construct('store_reward');
    }
    
    public function getRewardList( $page = null, $order = '', $field = '*', $limit = ''){
    	
    		$result = $this->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
    		return $result;
    	
    	
    }
}