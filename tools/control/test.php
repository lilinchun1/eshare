<?php
defined('InShopNC') or exit('Access Invalid!');
/**
 * 测试页
 */
class testControl extends mobileHomeControl {
	protected $openid = "";
	protected $appid;
	protected $appsecret;

	public function __construct () {
		parent::__construct();
		$this->appid = WXPAY_APPID;
		$this->appsecret = WXPAY_APPSECRET;
		$this->wap_url = WAP_SITE_URL;
	}

	public function testOp () {
		echo $this->appid;
		
		include tools('test');
			
		}

}
