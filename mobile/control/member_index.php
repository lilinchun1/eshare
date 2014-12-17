<?php
/**
 * 我的商城
 *
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class member_indexControl extends mobileMemberControl {

	public function __construct(){
		parent::__construct();
	}
    /**
     * 我的商城
     */
	public function indexOp() {
        $member_info = array();
		
		
		//该用户的订单数
		$order_count  = Model()->table("order")->where("buyer_id = ".$this->member_info['member_id']." and buyer_cancel = '0' ")->count();
		//该用户的地址数
		$adress_count = Model()->table("address")->where("member_id = ".$this->member_info['member_id'])->count();


		$member_info['order_count'] = $order_count;
		$member_info['adress_count'] = $adress_count;
        $member_info['user_name'] = $this->member_info['member_name'];
        $member_info['avator'] = getWxImg(getMemberAvatarForID($this->member_info['member_id']),"132");
        $member_info['point'] = $this->member_info['member_points'];
        $member_info['predepoit'] = $this->member_info['available_predeposit'];
		$member_info['member_truename'] = str_cut($this->member_info['member_truename'],16,'...');
		
		if (strpos ( $_SERVER ['HTTP_USER_AGENT'], "MicroMessenger" )) {
			$member_info['isWechat'] = 1; 
		}else{
			$member_info['isWechat'] = 0;			
		}
		//print_r($member_info);
        output_data(array('member_info' => $member_info));
	}	

}
