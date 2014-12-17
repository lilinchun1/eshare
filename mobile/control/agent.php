<?php
/**
 * 2014-9-1
 * 代理商注册 微信端的路线
 */
defined('InShopNC') or exit('Access Invalid!');

class agentControl extends wechatSellHomeControl {

	public function __construct(){
		parent::__construct();
		
		Tpl::output('openid', $this->openid);
		
		//二维码逻辑
		if($_GET['channel_qrcode'] && $_GET['store_id']){
				
			Tpl::output('channel_qrcode', $_GET['channel_qrcode']);
			Tpl::output('store_id', $_GET['store_id']);
				
			//分享逻辑
		}else if($_GET['agent_id']){
				
			Tpl::output('agent_id', $_GET['agent_id']);
		
		}
		
	}
	
	
	/**
	 * 注册页面的第一步
	 */
	public function do_phone_passwd(){
		//插入会员信息表
		$data['member_mobile'] = trim($_POST['member_mobile']);
		$data['member_passwd'] = md5(trim($_POST['member_passwd']));
		
		$data['store_id'] = $_POST['store_id'];
		$data['channel_qrcode'] = $_POST['channel_qrcode'];
		$data['is_agent'] = $_POST['is_agent'];
		
		
		$_SESSION[$this->openid] = $data;
		
		
		
		
	}
	
	/**
	 * 获得用户基本信息
	 */
	
	private function getUserInfo($openid){
	
	
			
		$s = file_get_contents("http://115.28.104.209/index.php?app=Dream&mod=GetAccessToken&act=getAccess&uid=214");
	
	
	
		$obj =  json_decode($s);
	
		$access_token = $obj->access_token;
	
		$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
	
		$jsonUser = $this->GetHttpResponseGET($url);
		$objUser = json_decode($jsonUser);
	
		return get_object_vars($objUser);
	}
	
	
	
	/**
	 * 获取手机验证码
	 */
	public function checkPhoneOp(){
		$data = array();
		//获取手机验证
		$data['mobile'] = trim($_POST['member_mobile']);
		$data['type'] = "mobile_code";
		$data['info'] = $this->create_password();
		$data['message'] = "顾客您的验证码是".$data['info'];
		$data['send_time'] = time();
		$send_sms = Model("send_sms");
		
		$flag = $send_sms->insert($data);
		
		$boolean = send_sms_phone($data['mobile'], $data['message']);
		
		
		if($boolean){
			output_data(array('status'=>1));
		}else{
			output_error('获取失败，10秒钟后重新获取！');
		}
		
	}
	
	/**
	 * 2014-9-2
	 * 数字验证码
	 * @param number $pw_length 随机码的长度
	 * @return string
	 */
	private function create_password($pw_length = 6)
	{
		$randpwd = '';
		for ($i = 0; $i < $pw_length; $i++)
		{
		$randpwd .= mt_rand(0, 9);
		}
		return $randpwd;
	}
	
	public function indexOp(){
		
		
		
		//会员模型
		$model_member = Model('member');
		
		//会员信息
		$member_info = $model_member->where(array('member_wxopenid'=>$this->openid))->find();
			
			//判断是否注册过
			if($member_info['is_agent']){
				
				Tpl::showpage("agent_info");//个人主页
				
			}else{
				Tpl::showpage("agent_select");//注册选择页面
			}
			
			

	}
	
	/**
	 * 2014-9-1
	 * 开店注册方法
	 */
	public function agent_registerOp(){
			
		//注册页面
		Tpl::showpage("agent_register");
		
	}
	
	
	/**
	 * 2014-9-1
	 * 手机号验证
	 */
	
	public function agent_phonecheckOp(){
		
		//手机验证
		Tpl::showpage("agent_phonecheck");
		
	}
	
	
	
	/**
	 * 2014-9-1
	 * 执行注册表单逻辑
	 */
	public function do_agent_registerOp(){
		
		
		
	}
	
	
	/**
	 * 2014-9-1
	 * 登入方法
	 */
	public function agent_loginOp(){
		
		//登入页面
		Tpl::showpage("agent_login");
		
		
	}
	

}
