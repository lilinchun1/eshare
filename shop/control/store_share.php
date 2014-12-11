<?php
/**
 * 作者：赵昕
 * 创建时间：2014-9-16
 * 模块名称：微信分享
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.0
 */
 defined('InShopNC') or exit('Access Invalid!');
 	
 class store_shareControl extends BaseSellerControl {
 		
	public function __construct() {
		
		parent::__construct();
		
		Language::read('member_store_index');//调用语言包
	}

	/**
	 * 显示信息列表
	 */
	public function share_listOp() {
		
		$model_store_share = Model('store_share');
		
		$page	= new Page();
		
		//查询
		$share_list = $model_store_share->getStoreShareList(array('store_id' => $_SESSION['store_id']),10);			
		
		//存入分页
		Tpl::output('show_page',$model_store_share->showpage());//分页显示输出				
		
		//存入列表集合以便在前台页面调用
		Tpl::output('share_list', $share_list);
		
		self::profile_menu('store_share');
		
		//跳转到share_list页面
		Tpl::showpage('store_share_list');
	}

	/**
	 * 增加信息列表
	 */
	public function share_addOp() {
		
		$this->profile_menu('share_add');
		
		//跳转到share_form页面
		Tpl::showpage('store_share_form');
	}

	/**
	 * 跳转到修改页面
	 */
	public function share_editOp() {
		
		//获取ID
		$wxs_id = intval($_GET['wxs_id']);
		
		//判断ID值如果ID小于等于0报错
		if($wxs_id <= 0) {
			showMessage(L('wrong_argument'), urlShop('store_share', 'share_list'), '', 'error');
		}
		
		$model_store_share = Model('store_share');
		
		//获取这一条数据 进行判断
		$share_info = $model_store_share->getStoreShareInfo(array('wxs_id' => $wxs_id));
		
		if(empty($share_info) || intval($share_info['store_id']) !== intval($_SESSION['store_id'])) {

			showMessage(L('wrong_argument'), urlShop('store_share', 'share_list'), '', 'error');
		
		}
		
		Tpl::output('share_info', $share_info);
		
		$this->profile_menu('share_edit');
		
		//跳转到article_form页面
		Tpl::showpage('store_share_form');
	}

	/**
	 *增加和修改信息
	 */
	public function share_saveOp() {
			
			//图片上传
			$upload = new UploadFile();
			
			//上传路径
			if($_SESSION['store_id']){
				
			$upload->set('default_dir','shop/store/'.$_SESSION['store_id']);
			
			}
			//宽度
			$upload->set('thumb_width',	"200");
			
			//高度
			$upload->set('thumb_height',"200");
			
			//后缀名
			$upload->set('thumb_ext',	'_small');
			
			$upload->set('ifremove',	true);
			
			//判断旧图片是否为空
			if ($_POST['old_wxs_picture'] != ''){

				$upload->set('thumb_image', $_POST['old_wxs_picture']);
			
			}
			
			$input=	$_POST['old_wxs_picture'];
			
			//判断图片名字是否为空
			if (!empty($_FILES['wxs_picture']['name'])){
			
				$result = $upload->upfile('wxs_picture');
			
			if ($result){
				
				$_POST['wxs_picture'] = $upload->thumb_image;
					
				$input=$_POST['wxs_picture'];
				
			}else {
				
			showDialog($upload->error);
			}
		}	
		
		//添加或修改的数据集合
		$share_info = array(
			'wxs_title' => $_POST['wxs_title'],
			'wxs_content' =>$_POST['wxs_content'],
			'store_id' =>1,
			'wxs_picture'=>$input,
			'createtime' => TIMESTAMP,
		);
		
		$model_store_share = Model('store_share');
		
		//判断取出的id为空并且是否大于0、如果是就执行修改操作、 否则执行添加功能
		if(!empty($_POST['wxs_id']) && intval($_POST['wxs_id']) > 0) {
			
			$this->recordSellerLog('编辑店铺信息，信息编号'.$_POST['wxs_id']);
			
			$condition = array('wxs_id' => $_POST['wxs_id']);
			
			$result = $model_store_share->editStoreShare($share_info, $condition);

		} else {
			$result = $model_store_share->addStoreShare($share_info);
			
			$this->recordSellerLog('新增店铺信息，信息编号'.$result);
		}
		showDialog(L('nc_common_op_succ'), urlShop('store_share', 'share_list'), 'succ');
	}

	
	/**
	 *删除信息
	 */
	public function share_delOp() {
		
		//获取ID
		$share_id = intval($_POST['wxs_id']);
		
		//判断ID是否大于0 如果大于0封装微信Id和店铺Id作为删除的条件
		if($share_id > 0) {
			
			$condition = array(
				'wxs_id' => $share_id,
				'store_id' => $_SESSION['store_id']
			
			);
			
			$model_store_share = Model('store_share');
			
			//通过微信id和店铺id对数据进行删除
			$model_store_share->delStoreShare($condition);
			
			$this->recordSellerLog('删除店铺信息，信息编号'.$share_id);
			
			showDialog(L('nc_common_op_succ'), urlShop('store_share', 'share_list'), 'succ');
			
		} else {
			
			showDialog(L('nc_common_op_fail'), urlShop('store_share', 'share_list'), 'error');
			
		}
	}

	/**
	 * 用户中心右边，小信息
	 *
	 * @param string 	$menu_key	当前信息的menu_key
	 * @return
	 */
	private function profile_menu($menu_key = '') {
		$menu_array = array();
		$menu_array[] = array(
				'menu_key' => 'store_share',
				'menu_name' => '信息列表',
				'menu_url' => urlShop('store_share', 'share_list')
		);
		
		if($menu_key == 'share_add') {
			$menu_array[] = array(
					'menu_key' => 'share_add',
					'menu_name' => '添加信息',
					'menu_url' => urlShop('store_share', 'share_add')
			);
		}
		
		if($menu_key == 'share_edit') {
			$menu_array[] = array(
					'menu_key' => 'share_edit',
					'menu_name' => '编辑信息',
					'menu_url' => urlShop('store_share','share_edit',array('wxs_id' => $_GET['wxs_id']))
			);
		}
		
		Tpl::output('member_menu', $menu_array);
		Tpl::output('menu_key', $menu_key);
	}

}
?>