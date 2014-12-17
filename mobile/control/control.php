<?php
/**
 * mobile父类
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

/********************************** 前台control父类 **********************************************/

class mobileControl{

    //客户端类型
    protected $client_type_array = array('android', 'wap', 'wechat', 'ios');
    //列表默认分页数
    protected $page = 5;


	public function __construct() {
        Language::read('mobile');

        //分页数处理
        $page = intval($_GET['page']);
        if($page > 0) {
            $this->page = $page;
        }
		
		session_start();
		if($_GET['agent_id']){
			$this->agent_id = intval($_GET['agent_id']);
			$_SESSION['agent_id'] = $this->agent_id;
		}
		if($_SESSION['agent_id']){
			$this->agent_id = intval($_SESSION['agent_id']);
		}
		$this->initAgent();
    }
	
	/**
	 *	初始化代理商信息
	 *
	 *	@param string $type 初始化信息级别：simple, normal, full
	 */
    public function initAgent(){
    	if($this->agent_id){
			$this->agent_info = Model('agent')->getAgentInfoByID($this->agent_id);
			$this->agent_lv = Model('agent')->getAgentLv($this->agent_info['level_id']);
			if(!$this->agent_info){
				$this->agent_id = 0;
				unset($_SESSION['agent_id']);
			}
		}
    }
}

class mobileHomeControl extends mobileControl{
	public function __construct() {
        parent::__construct();
    }
}

class mobileMemberControl extends mobileControl{

    protected $member_info = array();

	public function __construct() {
        parent::__construct();

        $model_mb_user_token = Model('mb_user_token');
        $key = $_POST['key'];
        if(empty($key)) {
            $key = $_GET['key'];
        }
        $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($key);
        if(empty($mb_user_token_info)) {
            output_error('请登陆', array('login' => '0'));
        }

        $model_member = Model('member');
        $this->member_info = $model_member->getMemberInfo(array('member_id' => $mb_user_token_info['member_id']));
        if(empty($this->member_info)) {
            output_error('请登陆', array('login' => '0'));
        } else {
            //读取卖家信息
            $seller_info = Model('seller')->getSellerInfo(array('member_id'=>$this->member_info['member_id']));
            $this->member_info['store_id'] = $seller_info['store_id'];
        }
    }
}
