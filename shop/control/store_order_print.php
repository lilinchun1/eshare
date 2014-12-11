<?php
/**
 * 订单打印
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class store_order_printControl extends BaseSellerControl {
	public function __construct() {
		parent::__construct();
		Language::read('member_printorder');
	}

	/**
	 * 查看订单
	 */
	public function indexOp() {
		$order_id	= intval($_GET['order_id']);
		
		if ($order_id <= 0){
			showMessage(Language::get('wrong_argument'),'','html','error');
		}
		$order_model = Model('order');
		$condition['order_id'] = $order_id;	
		$condition['store_id'] = $_SESSION['store_id'];
		$order_info = $order_model->getOrderInfo($condition,array('order_common','order_goods'));
		if (empty($order_info)){
			showMessage(Language::get('member_printorder_ordererror'),'','html','error');
		}
		Tpl::output('order_info',$order_info);

		//卖家信息
		$model_store	= Model('store');
		$store_info		= $model_store->getStoreInfoByID($order_info['store_id']);
		/*
		$condition['store_id'] = $_SESSION['store_id'];
		$model_store	= Model('agent');
		$store_info		= $model_store->getAgentInfo($order_info['store_id']);
		*/
		if (!empty($store_info['store_label'])){
			if (file_exists(BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$store_info['store_label'])){
				$store_info['store_label'] = UPLOAD_SITE_URL.DS.ATTACH_STORE.DS.$store_info['store_label'];
			}else {
				$store_info['store_label'] = '';
			}
		}
		if (!empty($store_info['store_stamp'])){
			if (file_exists(BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$store_info['store_stamp'])){
				$store_info['store_stamp'] = UPLOAD_SITE_URL.DS.ATTACH_STORE.DS.$store_info['store_stamp'];
			}else {
				$store_info['store_stamp'] = '';
			}
		}
		//获取订单打印次数
		$sql_point_num = "SELECT point_num FROM shopnc_order_point WHERE order_id = $order_id";
		$que_point_num = $model_store->query($sql_point_num);
		$store_info['point_num'] = $que_point_num[0]['point_num']?$que_point_num[0]['point_num']:0;
		$store_info['order_id'] = $order_id;
		Tpl::output('store_info',$store_info);

		//订单商品
		$model_order = Model('order');
		//============================无用
		$condition = array();
		$condition['order_id'] = $order_id;
		$condition['store_id'] = $_SESSION['store_id'];	
		//============================
		$goods_new_list = array();
		//商品数量
		$goods_all_num = 0;
		$goods_total_price = 0;
		if (!empty($order_info['extend_order_goods'])){
			//$goods_count = count($order_goods_list);
			$i = 1;
			//沥遍订单商品
			foreach ($order_info['extend_order_goods'] as $k => $v){
				$v['goods_name'] = str_cut($v['goods_name'],100);
				$goods_all_num += $v['goods_num'];				
				$v['goods_all_price'] = ncPriceFormat($v['goods_num'] * $v['goods_price']);
				$goods_total_price += $v['goods_all_price'];
				$goods_new_list[ceil($i/4)][$i] = $v;
				$i++;
			}
		}
		//优惠金额
		$promotion_amount = $goods_total_price - $order_info['goods_amount'];
		
		/*
		//显示打印的店铺名称
		$agent_model = Model('agent');
		
		$agent_id = $order_info['agent_id'];
		
		$agent = $agent_model->info("agent_id = '$agent_id'");
		Tpl::output('agent',$agent);
		*/
		$img = $this->barcodegenOp($order_info['order_sn']);
		$img_64 = base64_encode($img);
		Tpl::output('img_64',$img_64);
		
		//运费
		$order_info['shipping_fee'] = $order_info['shipping_fee'];
		Tpl::output('promotion_amount',$promotion_amount);
		Tpl::output('goods_all_num',$goods_all_num);
		Tpl::output('goods_total_price',ncPriceFormat($goods_total_price));
		Tpl::output('goods_list',$goods_new_list);
		Tpl::showpage('store_order.print',"null_layout");
	}
	
	function pointNumAddOp(){
		$order_id = $_GET['order_id'];
		$order_point = Model('order_point');
		$order_point_que = $order_point->where(array('order_id'=>$order_id))->find();
		if($order_point_que){
			$point_num = $order_point_que['point_num'] + 1;
			$order_point->where(array('order_id'=>$order_id))->update(array('point_num'=>$point_num));
		}else{
			$order_point->insert(array('order_id'=>$order_id,'point_num'=>1));
		}
	}
	
	public function barcodegenOp($text) {
		// 引用class文件夹对应的类
		require_once BASE_RESOURCE_PATH.DS.'barcodegen'.DS.'class'.DS.'BCGFontFile.php';
		require_once BASE_RESOURCE_PATH.DS.'barcodegen'.DS.'class'.DS.'BCGColor.php';
		require_once BASE_RESOURCE_PATH.DS.'barcodegen'.DS.'class'.DS.'BCGDrawing.php';
		
		// 条形码的编码格式
		require_once BASE_RESOURCE_PATH.DS.'barcodegen'.DS.'class'.DS.'BCGcode39.barcode.php';
		
		// 条形码需要的数据内容
		//$text = isset($_GET['barcodegen']) ? $_GET['barcodegen'] : 'no date';
		
		//颜色条形码
		$color_black = new BCGColor(0, 0, 0);
		// 空白间隙颜色
		$color_white = new BCGColor(255, 255, 255);
		
		$drawException = null;
		try {
			$code = new BCGcode39();
			$code->setScale(2); //条形码整体大小
			$code->setThickness(30); // 条形码的厚度
			$code->setForegroundColor($color_black); // 条形码颜色
			$code->setBackgroundColor($color_white); // 空白间隙颜色
			$code->setFont(0); // Font ($font or 0) 0则条形码下面无字体
			$code->parse($text); // 条形码需要的数据内容
		} catch(Exception $exception) {
			$drawException = $exception;
		}
		
		//根据以上条件绘制条形码
		$drawing = new BCGDrawing('', $color_white);
		if($drawException) {
			$drawing->drawException($drawException);
		} else {
			$drawing->setBarcode($code);
			$drawing->draw();
		}
		
		// 生成PNG格式的图片
		header('Content-Type: image/png');
		header('Content-Disposition: inline; filename="barcode.png"');
		
		// Draw (or save) the image into PNG format.
		return $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
	}
}
