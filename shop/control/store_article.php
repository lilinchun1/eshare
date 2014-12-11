<?php
/**
 * 店铺帮助信息
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
class store_articleControl extends BaseSellerControl {
	public function __construct() {
		parent::__construct();
		Language::read('member_store_index');//调用语言包

		$this->art_cats = array(
			'1'=>'商城1',
			'2'=>'商城2',
			'3'=>'商城3',
			'4'=>'商城4'
		);
		Tpl::output('art_catid', $this->art_cats);
	}

	/**
	 * 显示信息列表
	 */
	public function article_listOp() {
		$model_store_article = Model('store_article');
		$page	= new Page();
		
		$article_list = $model_store_article->getStoreArticleList(array('art_store_id' => $_SESSION['store_id']),2);			
		Tpl::output('show_page',$model_store_article->showpage());//分页显示输出				
		Tpl::output('article_list', $article_list);
		self::profile_menu('store_article');
		Tpl::showpage('article_list');
	}

	/**
	 * 增加信息列表
	 */
	public function article_addOp() {
		$this->profile_menu('article_add');
		Tpl::showpage('article_form');
	}

	/**
	 * 查询信息
	 */
	public function article_editOp() {
		$art_id = intval($_GET['art_id']);
		if($art_id <= 0) {
			showMessage(L('wrong_argument'), urlShop('store_article', 'article_list'), '', 'error');
		}
		$model_store_article = Model('store_article');
		$art_info = $model_store_article->getStoreArticleInfo(array('art_id' => $art_id));
		if(empty($art_info) || intval($art_info['art_store_id']) !== intval($_SESSION['store_id'])) {
			showMessage(L('wrong_argument'), urlShop('store_article', 'article_list'), '', 'error');
		}
		Tpl::output('art_info', $art_info);
		$this->profile_menu('article_edit');
		Tpl::showpage('article_form');
	}

	/**
	 *增加和修改信息
	 */
	public function article_saveOp() {
		
		
		//图片上传
			$upload = new UploadFile();
			$upload->set('default_dir',ATTACH_BRAND);
			$upload->set('thumb_width',	200);
			$upload->set('thumb_height',200);
			$upload->set('thumb_ext',	'_small');
			$upload->set('ifremove',	true);
		if ($_POST['old_art_picture'] != ''){
				$upload->set('thumb_image', $_POST['old_art_picture']);
			}
		$input=	$_POST['old_art_picture'];
		if (!empty($_FILES['art_picture']['name'])){
			
			
			$result = $upload->upfile('art_picture');
			
			if ($result){
				$_POST['art_picture'] = $upload->thumb_image;
				$input=$_POST['art_picture'];

			}else {
				showDialog($upload->error);
			}
		}	
		

		$art_catid1=$_POST['art_catid'];//查找数组中的key值
       
		$art_info = array(
				'art_title' => $_POST['art_title'],
				'art_info' =>$_POST['art_info'],
				'art_catid' =>$art_catid1,
				'art_content' => $_POST['art_content'],
				'art_picture'=>$input,
				//'art_sort' => empty($_POST['art_sort'])?255:$_POST['art_sort'],
				'art_sort' => $_POST['art_sort'],
				'art_url' => $_POST['art_url'],
				'art_store_id' => $_SESSION['store_id'],
				'art_edittime' => TIMESTAMP,
				'art_addtime' => TIMESTAMP
		);

		$model_store_article = Model('store_article');
		if(!empty($_POST['art_id']) && intval($_POST['art_id']) > 0) {
			$this->recordSellerLog('编辑店铺信息，信息编号'.$_POST['art_id']);
			$condition = array('art_id' => $_POST['art_id']);
			$result = $model_store_article->editStoreArticle($art_info, $condition);

		} else {
			$result = $model_store_article->addStoreArticle($art_info);
			$this->recordSellerLog('新增店铺信息，信息编号'.$result);
		}
		showDialog(L('nc_common_op_succ'), urlShop('store_article', 'article_list'), 'succ');
	}

	/**
	 *删除信息
	 */
	public function article_delOp() {
		$art_id = intval($_POST['art_id']);
		if($art_id > 0) {
			$condition = array(
					'art_id' => $art_id,
					'art_store_id' => $_SESSION['store_id']
			);
			$model_store_article = Model('store_article');
			$model_store_article->delStoreArticle($condition);
			$this->recordSellerLog('删除店铺信息，信息编号'.$art_id);
			showDialog(L('nc_common_op_succ'), urlShop('store_article', 'article_list'), 'succ');
		} else {
			showDialog(L('nc_common_op_fail'), urlShop('store_article', 'article_list'), 'error');
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
				'menu_key' => 'store_article',
				'menu_name' => '信息列表',
				'menu_url' => urlShop('store_article', 'article_list')
		);
		if($menu_key == 'article_add') {
			$menu_array[] = array(
					'menu_key' => 'article_add',
					'menu_name' => '添加信息',
					'menu_url' => urlShop('store_article', 'article_add')
			);
		}
		if($menu_key == 'article_edit') {
			$menu_array[] = array(
					'menu_key' => 'article_edit',
					'menu_name' => '编辑信息',
					'menu_url' => urlShop('store_article', 'article_edit',array('art_id' => $_GET['art_id']))
			);
		}
		Tpl::output('member_menu', $menu_array);
		Tpl::output('menu_key', $menu_key);
	}

}
?>