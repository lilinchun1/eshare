<?php
/**
 * 微信自动回复模型
 *litianzhuo
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.1.4
 */
defined ( 'InShopNC' ) or exit ( 'Access Invalid!' );
class weixin_autoControl extends BaseSellerControl {
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * 首页面
	 */
	public function indexOp() {
		$model_auto = Model ( 'weixin_reply' );
		$where ['store_id'] = $_SESSION ['store_id'];
		$where ['reply_type'] = 'auto';
		$result = $model_auto->getReplyList ( $where, 10, 'weixin_reply.keyword_id', '' );
		Tpl::output ( 'auto_list', $result );
		Tpl::output ( 'show_page', $model_auto->showpage () );
		$this->profile_menu ( 'index' );
		Tpl::showpage ( 'weixin_auto.index' );
	}
	/**
	 * 增加回复页面
	 */
	// 单图文
	public function auto_add1Op() {
		$this->profile_menu ( 'auto_add' );
		Tpl::showpage ( 'weixin_auto.add1' );
	}
	// 多图文
	public function auto_add2Op() {
		$model_auto = Model ( 'weixin_reply' );
		$id = $_GET ['keyword_id'];
		if ($id) {
			$this->profile_menu ( 'auto_edit' );
		} else {
			$this->profile_menu ( 'auto_add' );
		}
		Tpl::output ( 'keyword_id', $id );
		$where ['store_id'] = $_SESSION ['store_id'];
		$where ['reply_type'] = 'auto';
		$where ['event_type'] = 'many';
		$result = $model_auto->getReplyList ( $where, 10, '' );
		Tpl::output ( 'auto_list', $result );
		Tpl::output ( 'show_page', $model_auto->showpage () );
		Tpl::showpage ( 'weixin_auto.add2' );
	}
	// 文本
	public function auto_add3Op() {
		$this->profile_menu ( 'auto_add' );
		Tpl::showpage ( 'weixin_auto.add3' );
	}
	// 音乐
	public function auto_add4Op() {
		$this->profile_menu ( 'auto_add' );
		Tpl::showpage ( 'weixin_auto.add4' );
	}
	/**
	 * 增加|修改操作 (单图文,文本,音乐)
	 */
	public function auto_saveOp() {
		// 图片上传
		$upload = new UploadFile ();
		
		// 上传路径
		if ($_SESSION ['store_id']) {
			
			$upload->set ( 'default_dir', 'shop/store/' . $_SESSION ['store_id'] );
		}
		// //宽度
		$upload->set ( 'thumb_width', "200" );
		
		// //高度
		$upload->set ( 'thumb_height', "200" );
		
		// 后缀名
		$upload->set ( 'thumb_ext', '_small' );
		
		$upload->set ( 'ifremove', true );
		
		// 判断旧图片是否为空
		if ($_POST ['old_pic_url'] != '') {
			
			$upload->set ( 'thumb_image', $_POST ['old_pic_url'] );
		}
		
		$input = $_POST ['old_pic_url'];
		
		// 判断图片名字是否为空
		if (! empty ( $_FILES ['pic_url'] ['name'] )) {
			
			$result = $upload->upfile ( 'pic_url' );
			
			if ($result) {
				
				$_POST ['pic_url'] = $upload->thumb_image;
				
				$input = $_POST ['pic_url'];
			} else {
				
				showDialog ( $upload->error );
			}
		}
		
		$keyword_id = intval ( $_POST ['keyword_id'] );
		$model_key = Model ( 'weixin_keyword' );
		if (empty ( $keyword_id )) {
			$where ['store_id'] = $_SESSION ['store_id'];
			$where ['reply_type'] = 'auto';
			$where ['event_type'] = trim ( $_POST ['type'] );
			$where ['ctime'] = TIMESTAMP;
			// 开启事务
			// $model_key->beginTransaction();
			// 插入回复类型
			$result = $model_key->insert ( $where );
			if ($result) {
				// $model_key->commit();
				// 查询keyword_id
				$find = $model_key->where ( $where )->order ( 'ctime desc' )->find ();
				$data ['keyword_id'] = $find ['keyword_id'];
				switch ($where ['event_type']) {
					case 'single' :
						$data ['content'] = $_POST ['content'];
						$data ['pic_url'] = $input;
						$data ['page_url'] = $_POST ['page_url'];
						$data ['title'] = $_POST ['title'];
						break;
					case 'text' :
						$data ['content'] = $_POST ['content'];
						break;
					case 'music' :
						$data ['content'] = trim ( $_POST ['content'] );
						$data ['title'] = trim ( $_POST ['title'] );
						$data ['music_url'] = trim ( $_POST ['music_url'] );
						$data ['hqmusic_url'] = trim ( $_POST ['hqmusic_url'] );
						break;
				}
				
				$results = Model ()->table ( 'weixin_reply' )->insert ( $data );
				// 插入回复信息
				if ($results) {
					showDialog ( '添加成功', urlShop ( 'weixin_auto', 'index' ), 'succ' );
				} else {
					showDialog ( '添加失败' );
				}
			} else {
				showDialog ( '添加失败' );
			}
		} else {
			$data ['keyword_id'] = $keyword_id;
			$where ['event_type'] = trim ( $_POST ['type'] );
			switch ($where ['event_type']) {
				case 'single' :
					$data ['content'] = $_POST ['content'];
					$data ['pic_url'] = $input;
					$data ['page_url'] = $_POST ['page_url'];
					$data ['title'] = $_POST ['title'];
					break;
				case 'text' :
					$data ['content'] = $_POST ['content'];
					break;
				case 'music' :
					$data ['content'] = trim ( $_POST ['content'] );
					$data ['title'] = trim ( $_POST ['title'] );
					$data ['music_url'] = trim ( $_POST ['music_url'] );
					$data ['hqmusic_url'] = trim ( $_POST ['hqmusic_url'] );
					break;
			}
			$update = Model ()->table ( 'weixin_keyword' )->where ( array (
					'keyword_id' => $data ['keyword_id'] 
			) )->update ( $where );
			$results = Model ()->table ( 'weixin_reply' )->where ( array (
					'keyword_id' => $data ['keyword_id'] 
			) )->update ( $data );
			// 插入回复信息
			if ($results && $update) {
				showDialog ( '修改成功', urlShop ( 'weixin_auto', 'index' ), 'succ' );
			} else {
				showDialog ( '修改失败' );
			}
		}
	}
	/**
	 * 修改页面 (单图文,多图文,文本,音乐)
	 */
	public function auto_editOp() {
		$data ['event_type'] = trim ( $_GET ['event_type'] );
		$where ['keyword_id'] = intval ( $_GET ['keyword_id'] );
		switch ($data ['event_type']) {
			case 'single' :
				$result = Model ()->table ( 'weixin_reply' )->where ( $where )->find ();
				$this->profile_menu ( 'auto_edit' );
				$id = $_GET ['keyword_id'];
				Tpl::output ( 'keyword_id', $id );
				Tpl::output ( 'auto_info', $result );
				Tpl::showpage ( 'weixin_auto.edit1' );
				break;
			case 'many' :
				$model_auto = Model ( 'weixin_reply' );
				$wheres ['weixin_keyword.keyword_id'] = $_GET ['keyword_id'];
				$result = $model_auto->getReplyList ( $wheres, 10 );
				Tpl::output ( 'show_page', $model_auto->showpage () );
				Tpl::output ( 'auto_list', $result );
				$this->profile_menu ( 'auto_edit' );
				$id = $_GET ['keyword_id'];
				Tpl::output ( 'keyword_id', $id );
				Tpl::showpage ( 'weixin_auto.edit2' );
				break;
			case 'text' :
				$result = Model ()->table ( 'weixin_reply' )->where ( $where )->find ();
				$this->profile_menu ( 'auto_edit' );
				$id = $_GET ['keyword_id'];
				Tpl::output ( 'keyword_id', $id );
				Tpl::output ( 'auto_info', $result );
				Tpl::showpage ( 'weixin_auto.edit3' );
				break;
			case 'music' :
				$result = Model ()->table ( 'weixin_reply' )->where ( $where )->find ();
				$this->profile_menu ( 'auto_edit' );
				$id = $_GET ['keyword_id'];
				Tpl::output ( 'keyword_id', $id );
				Tpl::output ( 'auto_info', $result );
				Tpl::showpage ( 'weixin_auto.edit4' );
				break;
		}
	}
	
	/**
	 * 删除操作
	 */
	public function auto_delOp() {
		$keyword_id = $_POST ['keyword_id'];
		// 删除weixin_reply表信息
		$delr = Model ()->table ( 'weixin_reply' )->where ( array (
				'keyword_id' => $keyword_id 
		) )->delete ();
		// 删除weixin_keyword表信息
		$delk = Model ()->table ( 'weixin_keyword' )->where ( array (
				'keyword_id' => $keyword_id 
		) )->delete ();
		if ($delr && $delk) {
			showDialog ( '删除成功', urlShop ( 'weixin_auto', 'index' ), 'succ' );
		} else {
			showDialog ( '删除失败' );
		}
	}
	
	/**
	 * 添加多图文
	 */
	public function auto_addsOp() {
		Tpl::showpage ( 'weixin_auto.add2_1', 'null_layout' );
	}
	/**
	 * 修改添加多图文
	 */
	public function auto_addasOp() {
		Tpl::showpage ( 'weixin_auto.edit2_1', 'null_layout' );
	}
	/**
	 * 添加修改多图文
	 */
	public function auto_editsOp() {
		$where ['reply_id'] = intval ( $_GET ['reply_id'] );
		$result = Model ()->table ( 'weixin_reply' )->where ( $where )->find ();
		Tpl::output ( 'auto_info', $result );
		Tpl::showpage ( 'weixin_auto.add2_1', 'null_layout' );
	}
	/**
	 * 修改多图文
	 */
	public function auto_editasOp() {
		$where ['reply_id'] = intval ( $_GET ['reply_id'] );
		$result = Model ()->table ( 'weixin_reply' )->where ( $where )->find ();
		Tpl::output ( 'auto_info', $result );
		Tpl::showpage ( 'weixin_auto.edit2_1', 'null_layout' );
	}
	
	/**
	 * 添加多图文操作
	 */
	public function auto_savesOp() {
		// 图片上传
		$upload = new UploadFile ();
		
		// 上传路径
		if ($_SESSION ['store_id']) {
			
			$upload->set ( 'default_dir', 'shop/store/' . $_SESSION ['store_id'] );
		}
		// //宽度
		$upload->set ( 'thumb_width', "200" );
		
		// //高度
		$upload->set ( 'thumb_height', "200" );
		
		// 后缀名
		$upload->set ( 'thumb_ext', '_small' );
		
		$upload->set ( 'ifremove', true );
		
		// 判断旧图片是否为空
		if ($_POST ['old_pic_url'] != '') {
			
			$upload->set ( 'thumb_image', $_POST ['old_pic_url'] );
		}
		
		$input = $_POST ['old_pic_url'];
		
		// 判断图片名字是否为空
		if (! empty ( $_FILES ['pic_url'] ['name'] )) {
			
			$result = $upload->upfile ( 'pic_url' );
			
			if ($result) {
				
				$_POST ['pic_url'] = $upload->thumb_image;
				
				$input = $_POST ['pic_url'];
			} else {
				
				showDialog ( $upload->error );
			}
		}
		//
		$where ['store_id'] = $_SESSION ['store_id'];
		$where ['reply_type'] = 'auto';
		$where ['event_type'] = trim ( $_POST ['type'] );
		
		$reply_id = intval ( $_POST ['reply_id'] );
		$keyword_id = $_GET ['keyword_id'];
		$model_key = Model ( 'weixin_keyword' );
		if (empty ( $reply_id ) && empty ( $keyword_id )) {
			$find_key = $model_key->where ( $where )->order ( 'ctime desc' )->find ();
			// 第一次添加
			if (empty ( $find_key )) {
				// 开启事务
				// $model_key->beginTransaction();
				// 插入回复类型
				$where ['ctime'] = TIMESTAMP;
				$result = $model_key->insert ( $where );
				if ($result) {
					// $model_key->commit();
					$wheres ['store_id'] = $_SESSION ['store_id'];
					$wheres ['reply_type'] = 'auto';
					$wheres ['event_type'] = trim ( $_POST ['type'] );
					// 查询keyword_id
					$find = $model_key->where ( $wheres )->order ( 'ctime desc' )->find ();
					
					$data ['keyword_id'] = $find ['keyword_id'];
					$data ['content'] = $_POST ['content'];
					$data ['pic_url'] = $input;
					$data ['page_url'] = $_POST ['page_url'];
					$data ['title'] = $_POST ['title'];
					$data ['order_num'] = $_POST ['order_num'];
					$results = Model ()->table ( 'weixin_reply' )->insert ( $data );
					// 插入回复信息
					if ($results) {
						showDialog ( '添加成功', urlShop ( 'weixin_auto', 'auto_add2' ), 'succ' );
					} else {
						showDialog ( '添加失败' );
					}
				} else {
					showDialog ( '添加失败' );
				}
			} else {
				// 第二次添加
				$data ['keyword_id'] = $find_key ['keyword_id'];
				$data ['content'] = $_POST ['content'];
				$data ['pic_url'] = $input;
				$data ['page_url'] = $_POST ['page_url'];
				$data ['title'] = $_POST ['title'];
				$data ['order_num'] = $_POST ['order_num'];
				$results = Model ()->table ( 'weixin_reply' )->insert ( $data );
				// 插入回复信息
				if ($results) {
					showDialog ( '添加成功', urlShop ( 'weixin_auto', 'auto_add2' ), 'succ' );
				} else {
					showDialog ( '添加失败' );
				}
			}
		} else {
			$data ['reply_id'] = $reply_id;
			$data ['content'] = $_POST ['content'];
			$data ['pic_url'] = $input;
			$data ['page_url'] = $_POST ['page_url'];
			$data ['title'] = $_POST ['title'];
			$data ['order_num'] = $_POST ['order_num'];
			$results = Model ()->table ( 'weixin_reply' )->where ( array (
					'reply_id' => $data ['reply_id'] 
			) )->update ( $data );
			// 插入回复信息
			if ($results) {
				showDialog ( '修改成功', urlShop ( 'weixin_auto', 'auto_add2' ), 'succ' );
			} else {
				showDialog ( '修改失败' );
			}
		}
	}
	/**
	 * 修改多图文操作
	 */
	public function auto_saveasOp() {
		// 图片上传
		$upload = new UploadFile ();
		
		// 上传路径
		if ($_SESSION ['store_id']) {
			
			$upload->set ( 'default_dir', 'shop/store/' . $_SESSION ['store_id'] );
		}
		// //宽度
		$upload->set ( 'thumb_width', "200" );
		
		// //高度
		$upload->set ( 'thumb_height', "200" );
		
		// 后缀名
		$upload->set ( 'thumb_ext', '_small' );
		
		$upload->set ( 'ifremove', true );
		
		// 判断旧图片是否为空
		if ($_POST ['old_pic_url'] != '') {
			
			$upload->set ( 'thumb_image', $_POST ['old_pic_url'] );
		}
		
		$input = $_POST ['old_pic_url'];
		
		// 判断图片名字是否为空
		if (! empty ( $_FILES ['pic_url'] ['name'] )) {
			
			$result = $upload->upfile ( 'pic_url' );
			
			if ($result) {
				
				$_POST ['pic_url'] = $upload->thumb_image;
				
				$input = $_POST ['pic_url'];
			} else {
				
				showDialog ( $upload->error );
			}
		}
		//
		$where ['store_id'] = $_SESSION ['store_id'];
		$where ['reply_type'] = 'auto';
		$where ['event_type'] = trim ( $_POST ['type'] );
		
		$reply_id = intval ( $_POST ['reply_id'] );
		$keyword_id = $_GET ['keyword_id'];
		$model_key = Model ( 'weixin_keyword' );
		if (empty ( $reply_id ) && empty ( $keyword_id )) {
			$find_key = $model_key->where ( $where )->order ( 'ctime desc' )->find ();
			// 第一次添加
			if (empty ( $find_key )) {
				// 开启事务
				// $model_key->beginTransaction();
				// 插入回复类型
				$where ['ctime'] = TIMESTAMP;
				$result = $model_key->insert ( $where );
				if ($result) {
					// $model_key->commit();
					$wheres ['store_id'] = $_SESSION ['store_id'];
					$wheres ['reply_type'] = 'auto';
					$wheres ['event_type'] = trim ( $_POST ['type'] );
					// 查询keyword_id
					$find = $model_key->where ( $wheres )->order ( 'ctime desc' )->find ();
					
					$data ['keyword_id'] = $find ['keyword_id'];
					$data ['content'] = $_POST ['content'];
					$data ['pic_url'] = $input;
					$data ['page_url'] = $_POST ['page_url'];
					$data ['title'] = $_POST ['title'];
					$data ['order_num'] = $_POST ['order_num'];
					$results = Model ()->table ( 'weixin_reply' )->insert ( $data );
					// 插入回复信息
					if ($results) {
						showDialog ( '添加成功', urlShop ( 'weixin_auto',  'auto_add2' ), 'succ' );
					} else {
						showDialog ( '添加失败' );
					}
				} else {
					showDialog ( '添加失败' );
				}
			} else {
				// 第二次添加
				$data ['keyword_id'] = $find_key ['keyword_id'];
				$data ['content'] = $_POST ['content'];
				$data ['pic_url'] = $input;
				$data ['page_url'] = $_POST ['page_url'];
				$data ['title'] = $_POST ['title'];
				$data ['order_num'] = $_POST ['order_num'];
				$results = Model ()->table ( 'weixin_reply' )->insert ( $data );
				// 插入回复信息
				if ($results) {
					showDialog ( '添加成功', urlShop ( 'weixin_auto','auto_edit',array('keyword_id'=>$data['keyword_id'],'event_type'=>'many')), 'succ' );
				} else {
					showDialog ( '添加失败' );
				}
			}
		} else if(!empty ( $reply_id )) {
			$keyword_id=$_POST['keyword_id'];
			$data ['reply_id'] = $reply_id;
			$data ['content'] = $_POST ['content'];
			$data ['pic_url'] = $input;
			$data ['page_url'] = $_POST ['page_url'];
			$data ['title'] = $_POST ['title'];
			$data ['order_num'] = $_POST ['order_num'];
			$results = Model ()->table ( 'weixin_reply' )->where ( array (
					'reply_id' => $data ['reply_id'] 
			) )->update ( $data );
			// 插入回复信息
			if ($results) {
				showDialog ( '修改成功', urlShop ( 'weixin_auto', 'auto_edit',array('keyword_id'=>$keyword_id,'event_type'=>'many') ), 'succ' );
			} else {
				showDialog ( '修改失败' );
			}
		}
	}
	/**
	 * 删除多图文操作
	 */
	public function auto_delsOp() {
		$reply_id = $_GET ['reply_id'];
		$keyword_id = $_GET ['keyword_id'];
		// 判断最后一条
		$model_key = Model ( 'weixin_reply' );
		$where ['store_id'] = $_SESSION ['store_id'];
		$where ['reply_type'] = 'auto';
		$where ['event_type'] = 'many';
		$result = $model_key->getReplyList ( $where );
		if (count ( $result ) == 1) {
			// 删除weixin_reply,weixin_keyword表表信息
			$delr = Model ()->table ( 'weixin_reply' )->where ( array (
					'reply_id' => $reply_id 
			) )->delete ();
			$delk = Model ()->table ( 'weixin_keyword' )->where ( array (
					'keyword_id' => $keyword_id 
			) )->delete ();
			if ($delr && $delk) {
				showDialog ( '删除成功', urlShop ( 'weixin_auto', 'auto_edit',array('keyword_id'=>$keyword_id,'event_type'=>'many') ), 'succ' );
			} else {
				showDialog ( '删除失败' );
			}
		} else {
			// 删除weixin_reply表信息
			$delr = Model ()->table ( 'weixin_reply' )->where ( array (
					'reply_id' => $reply_id 
			) )->delete ();
			if ($delr) {
				showDialog ( '删除成功', urlShop ( 'weixin_auto', 'auto_edit',array('keyword_id'=>$keyword_id,'event_type'=>'many') ), 'succ' );
			} else {
				showDialog ( '删除失败' );
			}
		}
	}
	/**
	 * 删除多图文操作
	 */
	public function auto_delasOp() {
		$reply_id = $_GET ['reply_id'];
		$keyword_id = $_GET ['keyword_id'];
		// 判断最后一条
		$model_key = Model ( 'weixin_reply' );
		$where ['store_id'] = $_SESSION ['store_id'];
		$where ['reply_type'] = 'auto';
		$where ['event_type'] = 'many';
		$result = $model_key->getReplyList ( $where );
		if (count ( $result ) == 1) {
			// 删除weixin_reply,weixin_keyword表表信息
			$delr = Model ()->table ( 'weixin_reply' )->where ( array (
					'reply_id' => $reply_id
			) )->delete ();
			$delk = Model ()->table ( 'weixin_keyword' )->where ( array (
					'keyword_id' => $keyword_id
			) )->delete ();
			if ($delr && $delk) {
				showDialog ( '删除成功', urlShop ( 'weixin_auto', 'auto_add2' ), 'succ' );
			} else {
				showDialog ( '删除失败' );
			}
		} else {
			// 删除weixin_reply表信息
			$delr = Model ()->table ( 'weixin_reply' )->where ( array (
					'reply_id' => $reply_id
			) )->delete ();
			if ($delr) {
				showDialog ( '删除成功', urlShop ( 'weixin_auto', 'auto_add2' ), 'succ' );
			} else {
				showDialog ( '删除失败' );
			}
		}
	}
	/**
	 * 用户中心右边，小导航
	 *
	 * @param string $menu_key        	
	 * @return
	 *
	 */
	private function profile_menu($menu_key = '') {
		$menu_array = array ();
		$menu_array [] = array (
				'menu_key' => 'index',
				'menu_name' => '回复列表',
				'menu_url' => urlShop ( 'weixin_auto', 'index' ) 
		);
		if ($menu_key === 'auto_add') {
			$menu_array [] = array (
					'menu_key' => 'auto_add',
					'menu_name' => '添加回复',
					'menu_url' => urlShop ( 'weixin_auto', 'auto_add1' ) 
			);
		}
		if ($menu_key === 'auto_edit') {
			$menu_array [] = array (
					'menu_key' => 'auto_edit',
					'menu_name' => '编辑回复',
					'menu_url' => urlShop ( 'weixin_auto', 'auto_edit' ) 
			);
		}
		
		Tpl::output ( 'member_menu', $menu_array );
		Tpl::output ( 'menu_key', $menu_key );
	}
}	