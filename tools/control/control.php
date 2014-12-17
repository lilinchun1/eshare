<?php
/**
 * mobile父类
 *
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.0
 */
defined('InShopNC') or exit('Access Invalid!');

/**
 * control基类
 *
 */
class mobileControl{

    //客户端类型
    protected $client_type_array = array('android', 'wap', 'wechat', 'ios');
    //列表默认分页数
    protected $page = 100;
    //代理商信息
    protected $agent_info = array();

    /*!!! 准备废弃-开始 !!!*/
    protected $agent_lv   = array();   //等级
    /*!!! 准备废弃-结束 !!!*/

    protected $agent_id   = 0;

	public function __construct() {
        Language::read('tools');

		//获取代理商信息
		session_start();
		if($_GET['agent_id']){
			$this->agent_id = intval($_GET['agent_id']);
			$_SESSION['agent_id'] = $this->agent_id;
		}
		if($_SESSION['agent_id']){
			$this->agent_id = intval($_SESSION['agent_id']);
		}
    }

	/**
	 *	初始化代理商信息
	 *
	 *	@param string $type 初始化信息级别：simple, normal, full
	 */
    public function initAgent(){
    	if($this->agent_id){
			$this->agent_info = Model('agent')->getAgentInfoByID($this->agent_id);
			/*!!! 准备废弃-开始 !!!*/
			$this->agent_lv = Model('agent')->getAgentLv($this->agent_info['level_id']);
			/*!!! 准备废弃-结束 !!!*/
			if($this->agent_info){
				$_SESSION['agent_id'] = $this->agent_info['agent_id'];
			}else{
				$this->agent_id = 0;
				unset($_SESSION['agent_id']);
			}
		}
    }
    
    /**
     * @join_in
     * @author zhangyating
     * @param string $openid
     * @2014-11-4
     * 跳到过度页面
     */
    public function overdo($openid,$id){
    	$member_info = Model()->table('member')->where(array ('member_wxopenid' => $openid,'is_agent'=>1))->find();
    	if($member_info){
    		unset($_SESSION["hanshenInfo"]['joinFrom']);
    		$agent_info = Model()->table('agent')->where(array('agent_id'=>$member_info['member_id']))->find();
    		$teamName = $member_info['member_truename'];
    		if($agent_info['parent_id']){
    			$father = Model()->table('member')->where(array ('member_id' => $agent_info['parent_id']))->find();
    			$teamName = $father['member_truename'];
    		}
    		if($id){$message = "恭喜您，已成功加入". $teamName."的团队！";}else{$message = "您已经是". $teamName."团队的成员了<br>无法重复加入此团队或加入其他团队";}
    		
    		include wap('hint');exit();
    	}
    }

	public function __destruct() {}
}

/**
 * 前台父类
 *
 */
class mobileHomeControl extends mobileControl{
	public function __construct() {
        parent::__construct();
    }
}


/**
 * 前台会员（买家）父类
 *
 */
class mobileMemberControl extends mobileControl{

    protected $member_info = array();

	public function __construct() {
        parent::__construct();

        $model_mb_user_token = Model('mb_user_token');
		if(empty($key)) {
            $key = $_GET['key'];
        }
		 if(empty($key)) {
            $key = $_COOKIE['key'];
        }
        $token_info = Model('mb_user_token')->getMbUserTokenInfoByToken($key);
        if(empty($token_info)) {
        	redirect(WAP_SITE_URL.'/tmpl/member/login.html');
        }

        $model_member = Model('member');
        $this->member_info = $model_member->getMemberInfo(array('member_id' => $token_info['member_id']));

        if(empty($this->member_info)) {
        	redirect(WAP_SITE_URL.'/tmpl/member/login.html');
        }
    }
}

/**
 * 前台代理商（卖家）父类
 *
 */
class mobileAgentControl extends mobileControl{

    protected $agent_info = array();

	public function __construct() {
        parent::__construct();

		$token_info = array();
        $key = $_COOKIE['mb_user_token'];
		if($key){
	        $token_info = Model('mb_user_token')->getMbUserTokenInfoByToken($key);
     	    $this->agent_id   = $token_info['member_id'];
	    }else{
	    	$this->agent_id   = 0;
	    }
	    $this->initAgent();

        if(empty($this->agent_id)) {
           	redirect('index.php?act=front&op=agent_login');
        }
    }
}
