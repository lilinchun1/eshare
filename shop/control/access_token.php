<?php
/**
 * 微信配置控制器
 *litianzhuo
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.1.4
 */ 
defined('InShopNC') or exit ('Access Invalid!');
class access_tokenControl extends BaseSellerControl {
    public function __construct() {
        parent::__construct ();
   
    }
    
    /**
     *维信配置首页 
     */
    public function indexOp(){
    	$model_token=Model('access_token');
    	$data['store_id']=$_SESSION['store_id'];
    	$result=$model_token->getTokenList($data,10,'');
    	$this->profile_menu('index');
    	Tpl::output('show_page',$model_token->showpage());
    	Tpl::output('token_list',$result);
    	Tpl::showpage('access_token.list');
    }
    /**
     *添加配置 
     */
    public function token_addOp() {
    	$this->profile_menu('token_add');
    	Tpl::showpage('access_token.add');
    }
    /**
     *添加操作 
     */
    public function token_saveOp(){
    	$where=array(
    		'store_id'=>$_SESSION['store_id'],	
    		'appid'=>trim($_POST['appid']),	
    		'appsecret'=>trim($_POST['appsecret']),	
    		'EncodingAESKey'=>trim($_POST['EncodingAESKey']),	
    	);
    	$result=Model()->table('access_token')->insert($where);
    	if($result){
    		 showDialog('添加成功', urlShop('access_token', 'index'), 'succ');
    	}else{
    		 showDialog('添加失败', urlShop('access_token', 'token_add'), 'error');
    	}
    }
    /**
     *修改配置 
     */
    public function token_editOp() {
    	$model_token=Model('access_token');
    	$data['store_id']=$_SESSION['store_id'];
    	$result=$model_token->getTokenInfo($data);
    	Tpl::output('token_info',$result);
    	$this->profile_menu('token_edit');
    	Tpl::showpage('access_token.edit');
    }
    /**
     *修改操作 
     */
    public function token_modifyOp(){
    	$where=array(
    			'store_id'=>$_SESSION['store_id'],
    			'appid'=>trim($_POST['appid']),
    			'appsecret'=>trim($_POST['appsecret']),
    			'EncodingAESKey'=>trim($_POST['EncodingAESKey']),
    	);
    	$result=Model()->table('access_token')->where(array('store_id'=>$_SESSION['store_id']))->update($where);
    	if($result){
    		showDialog('修改成功', urlShop('access_token', 'index'), 'succ');
    	}else{
    		showDialog('修改失败', urlShop('access_token', 'token_edit'), 'error');
    	}
    }
    
    /**
     * 用户中心右边，小导航
     *
     * @param string 	$menu_key	当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_key = '') {
    	$menu_array = array();
    	$menu_array[] = array(
    			'menu_key' => 'index',
    			'menu_name' => '配置列表',
    			'menu_url' => urlShop('access_token', 'index')
    	);
    	if($menu_key === 'token_add') {
    		$menu_array[] = array(
    				'menu_key'=>'token_add',
    				'menu_name' => '添加配置',
    				'menu_url' => urlShop('access_token', 'token_add')
    		);
    	}
    	if($menu_key === 'token_edit') {
    		$menu_array[] = array(
    				'menu_key'=>'token_edit',
    				'menu_name' => '编辑配置',
    				'menu_url' => urlShop('access_token', 'token_edit')
    		);
    	}
    
    	Tpl::output('member_menu', $menu_array);
    	Tpl::output('menu_key', $menu_key);
    }
    
}   