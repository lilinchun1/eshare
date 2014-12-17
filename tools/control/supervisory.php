<?php
/**
 * 代理商升级页面
 *
 * @copyright Copyright (c) 2013-2014 易享科技
 * @link http://www.exweixin.com
 * @since v1.0
 */
defined('InShopNC') or exit('Access Invalid!');
class supervisoryControl {
	
	public function indexOp () {
		$model = Model();
		$model_supervisory = Model('order_supervisory');
	    //wcache('order_supervisory',0,'insert');
		
		//捞数据
	    $id = rcache('order_supervisory','insert');

		$max_order_id = intval($id);

		//查询order表 10条记录 录入 order_supervisory表
		$res = $model->query("select `order_id`,`pay_sn`,`order_state`,`add_time` from `shopnc_order` where `order_state` <= '10' and `order_id` > '$max_order_id' and `add_time` < (unix_timestamp(now())-600) order by order_id asc limit 20");
		if(count($res)>0){
			foreach($res as $v){
				$int_order_id = $v['order_id'];
				$data = array(
						'order_id'=>$v['order_id'],
						'pay_sn'=>$v['pay_sn'],
						'add_time'=>$v['add_time'],
						'cancel_state'=>$v['order_state'],
				);
				$is_super = $model_supervisory->where(array('order_id'=>$v['order_id']))->count();
				if($is_super){
					$id = $v['order_id'];					
				}else{
					$id = $v['order_id'];
					$model_supervisory->insert($data);
				}			
			}
			wcache('order_supervisory',$id,'insert');
		}
		
		//-----------------------------
		//校验数据

	    $id = rcache('order_supervisory','check');

		$res = $model->query("select `order_id` from `shopnc_order_supervisory` where `order_status`='0' and `order_id`< '$id' order by `order_id` desc limit 30");
		$model->query("UPDATE `shopnc_order_supervisory` SET `order_status` = '2' WHERE `add_time` < (unix_timestamp(now())-(60*60*24*15))");
		if(count($res)>0){
			$data = array();

			foreach($res as $k =>$v){
			   $data[$k] = $v['order_id'];
			   $id = $data[$k];
			}
			
		    $in = join(",",$data);
			$res = $model->query("select order_id from `shopnc_order` where `order_id` in ($in) and `order_state` > '10'");
			
			if(count($res)>0){
				
				$data = array();
				foreach($res as $k =>$v){
					$data[$k] = $v['order_id'];
				}
				$in = join(",",$data);
				$model->query("UPDATE `shopnc_order_supervisory` SET `order_status` = '1' WHERE `order_id` in ($in)");
			}
			wcache('order_supervisory',$id,'check');
		}else{
			$ids = $model_supervisory->field('order_id')->where('order_status = "0"')->order('order_id desc')->find();
			wcache('order_supervisory',$ids['order_id']+1,'check');		
		}	
	}
}



