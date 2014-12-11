<?php
/**
 * 佣金结算
 *
 * @copyright Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license http://www.shopnc.net
 * @link http://www.shopnc.net
 * @since File available since Release v1.1
 * @version SVN: $Id: agent_bill.model.php 2014-10-10 14:03:53 zhangyating $
 */
defined('InShopNC') or exit('Access Invalid!');
class agent_billModel extends Model {

	public function __construct () {
		parent::__construct('agent_bill');
	}

	/**
	 * 佣金流水记录和升级计算
	 *
	 * @param int $agent_id 代理商id
	 * @param int $order_id 订单id
	 * @param float $order_amount 订单money
	 */
	public function setAgentBill ($out_trade_no, $from = '') {
		$model_bill = Model("agent_bill");
		$info = $this->table('order')->where(array ('pay_sn' => $out_trade_no))->find();
		$bill_money = $this->table('agent_bill')->where(array ('order_id' => $info['order_id']))->select();
		if (empty($bill_money)) {
			// 开启事务
			$model_bill->beginTransaction();
			$flag = $this->agentMe($info);
			// 写成select() 是因为find()有缓存 查出的数据为之前未更新数据
			$agentinfo = $this->table("agent")->where("agent_id = " . $info['agent_id'])->select();
			$agentinfo = $agentinfo[0];
			if ($flag) {
				$this->getHighLevel($agentinfo);
				if ($agentinfo['parent_id']) {
					// 1---第一部分计算直属团队佣金并且记录在agent_bill表
					// 判断父代理商level_id:
					$parentinfo = $this->table('agent')->where(array ('agent_id' => $agentinfo['parent_id']))->find();
					$flag = $this->agentFather($info, $parentinfo);
					if ($flag) {
						$this->getHighLevel($parentinfo);
						// 判断父代理商是否有parent_id
						if ($parentinfo['parent_id']) {
							// 1---第一部分计算扩展团队佣金并且记录在agent_bill表
							// 判断爷代理商level_id:
							$grandfatherinfo = $this->table('agent')->where(array ('agent_id' => $parentinfo['parent_id']))->find();
							$flag = $this->agentGrandFather($info, $grandfatherinfo);
							if ($flag) {
								$this->getHighLevel($grandfatherinfo);
							} else {
								$model_bill->rollback();
								exit("my grandfather");
							}
						}
					} else {
						$model_bill->rollback();
						exit("my father");
					}
				}
				$model_bill->commit();
			} else {
				$model_bill->rollback();
				exit("my mine");
			}
		} else {
			exit("is exit");
		}
	}

	/**
	 * 当前代理商佣金结算和升级的逻辑
	 *
	 * @param array $info 基本信息
	 */
	public function agentMe ($info) {
		$data = array ();
		// 代理人id
		$data['agent_id'] = $info['agent_id'];
		// 订单id
		$data['order_id'] = $info['order_id'];
		// 订单总额
		$data['order_amount'] = $info['order_amount'];
		
		// *代理商级别
		$agent_level = $this->table("agent")->where(array ("agent_id" => $info['agent_id']))->find();
		// print_r($agent_level);die();
		// *佣金比例来源表
		$bill_type = $this->table("store_reward")->where(array ("level_id" => $agent_level['level_id']))->find();
		
		// 佣金比例
		$data['bill_rate'] = $bill_type['sale_rate']; // 销售提成
		                                              // 收入类型
		$data['bill_type'] = "INCOME_SALE";
		// 佣金值
		$data['bill_amount'] = floatval($info['order_amount'] * floatval($bill_type['sale_rate']) / 100.00);
		
		$data['bill_time'] = time();
		
		$bill_id = $this->table("agent_bill")->insert($data);
		
		// $map = array(
		// 'agent_id' => $info['agent_id'],
		// 'total_orders' =>array('exp','total_orders+1'),
		// 'total_sales' =>array('exp','total_sales+'.floatval($info['order_amount'])),
		// 'total_income' =>array('exp','total_income+'.$data['bill_amount'])
		// );
		// //var_dump($map);
		// $this->table('agent')->update($map);
		
		$thisFlag1 = $this->table('agent')->where(array ("agent_id" => $info['agent_id']))->setInc('total_orders', 1);
		$thisFlag2 = $this->table('agent')->where(array ("agent_id" => $info['agent_id']))->setInc('total_sales', floatval($info['order_amount']));
		$thisFlag3 = $this->table('agent')->where(array ("agent_id" => $info['agent_id']))->setInc('total_income', $data['bill_amount']);
		// 添加账户余额
		$thisFlag4 = $this->table('agent')->where(array ("agent_id" => $info['agent_id']))->setInc('total_balance', $data['bill_amount']);
		// file_put_contents(dirname(__FILE__)."/Me.txt","自己里面的内容没有走！");
		if ($bill_id && $thisFlag1 && $thisFlag2 && $thisFlag3 && $thisFlag4) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 二代代理商佣金结算和升级逻辑
	 *
	 * @param array $info 当前agent基本信息
	 * @param array $parentinfo 二代agent基本信息
	 */
	public function agentGrandFather ($info, $grandfatherinfo) {
		$dataG = array ();
		// 爷代理人id
		$dataG['agent_id'] = $grandfatherinfo['agent_id'];
		// 订单id
		$dataG['order_id'] = $info['order_id'];
		// 订单总额
		$dataG['order_amount'] = $info['order_amount'];
		
		// 根据爷代理商的等级查询等级表中扩展团队提成比例
		$rewardGrandfather = $this->table('store_reward')->where(array ('level_id' => $grandfatherinfo['level_id']))->find();
		// *计算当前代理商佣金收入并且记录
		// 佣金比例
		$dataG['bill_rate'] = $rewardGrandfather['s2_rate']; // 扩展团队
		                                                     // 收入类型 扩展团队提成
		$dataG['bill_type'] = "INCOME_S2";
		// 佣金值
		$dataG['bill_amount'] = floatval($info['order_amount'] * floatval($dataG['bill_rate']) / 100.00);
		$dataG['bill_time'] = time();
		$bill_id = $this->table("agent_bill")->insert($dataG);
		
		// 2---第二部分 更新agent表
		$thisFlag = $this->table('agent')->where(array ("agent_id" => $dataG['agent_id']))->setInc('total_income', $dataG['bill_amount']);
		// 添加账户余额
		// file_put_contents(dirname(__FILE__)."/grandfather.txt","爷爷里面的内容没有走！");
		$thisFlag1 = $this->table('agent')->where(array ("agent_id" => $dataG['agent_id']))->setInc('total_balance', $dataG['bill_amount']);
		// file_put_contents(dirname(__FILE__)."/grandfather1.txt","爷爷里面的内容没有走");
		if ($bill_id && $thisFlag && $thisFlag1) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 一代代理商佣金结算和升级的逻辑
	 *
	 * @param array $info 当前agent基本信息
	 * @param array $parentinfo 一代agent基本信息
	 */
	public function agentFather ($info, $parentinfo) {
		// print_r($parentinfo);die();
		$dataP = array ();
		// 父代理人id
		$dataP['agent_id'] = $parentinfo['agent_id'];
		// 订单id
		$dataP['order_id'] = $info['order_id'];
		// 订单总额
		$dataP['order_amount'] = $info['order_amount'];
		
		// 根据父代理商的等级查询等级表中直属团队提成比例
		$rewardParent = $this->table('store_reward')->where(array ('level_id' => $parentinfo['level_id']))->find();
		
		// *计算当前代理商佣金收入并且记录
		// 佣金比例
		$dataP['bill_rate'] = $rewardParent['s1_rate']; // 直属团队
		                                                // 收入类型 直属团队提成
		$dataP['bill_type'] = "INCOME_S1";
		// 佣金值
		$dataP['bill_amount'] = floatval($info['order_amount'] * floatval($dataP['bill_rate']) / 100.00);
		$dataP['bill_time'] = time();
		
		$bill_id = $this->table("agent_bill")->insert($dataP);
		// print_r($dataP);
		// 2---第二部分 更新agent表
		$thisFlag = $this->table('agent')->where(array ("agent_id" => $dataP['agent_id']))->setInc('total_income', $dataP['bill_amount']);
		// 添加账户余额
		// file_put_contents(dirname(__FILE__)."/father.txt","爸爸里面的内容没有走！");
		$thisFlag1 = $this->table('agent')->where(array ("agent_id" => $dataP['agent_id']))->setInc('total_balance', $dataP['bill_amount']);
		// echo $thisFlag;die();
		// file_put_contents(dirname(__FILE__)."/father1.txt","爸爸里面的内容没有走！");
		/**
		 * 父代理商的逻辑 end
		 */
		if ($bill_id && $thisFlag && $thisFlag1) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 注册时 一级升二级的情况
	 *
	 * @param int $parent_id
	 */
	public function getLevelTwo ($parent_id) {
		$limitNum = 5;
		$agentinfo = $this->table("agent")->where(array ('agent_id' => $parent_id))->select();
		$agentinfo = $agentinfo[0];
		$store_reward = $this->table("store_reward")->where(array ("level_id" => $agentinfo['level_id']))->find();
		if ($agentinfo['level_id'] == 1) {
			$total_sales = $agentinfo['total_sales'];
			$count = count($this->table("agent")->where(array ("parent_id" => $agentinfo["agent_id"]))->select());
			if ($total_sales >= $store_reward['upgrade_sale'] && $count >= $limitNum) {
				$this->table('agent')->where(array ("agent_id" => $agentinfo['agent_id']))->setInc('level_id', 1);
			}
		}
	}

	/**
	 *
	 * @param array $agentinfo 代理商的基本信息
	 *        升级逻辑
	 */
	public function getHighLevel ($agentinfo) {
		$store_reward = $this->table("store_reward")->where(array ("level_id" => $agentinfo['level_id']))->find();
		$limitNum = 5;
		switch ($agentinfo['level_id']) {
			case 1 :
				
				// /*
				// 升V2条件：销售额 1元、5个直属代理商
				// 判断条件：
				// 1. $agentinfo[‘total_sales’]（交易总金额）>=1
				// 2. count(parent_id == $INFO['agent_id'])>=5
				// count($this->table(“agent”)->where(array(”parent_id”=>$INFO['agent_id']))->findAll());
				// */
				//
				$total_sales = $agentinfo['total_sales'];
				// echo "ddd";die;
				$count = count($this->table("agent")->where(array ("parent_id" => $agentinfo["agent_id"]))->select());
				if ($total_sales >= $store_reward['upgrade_sale'] && $count >= $limitNum) {
					$this->table('agent')->where(array ("agent_id" => $agentinfo['agent_id']))->setInc('level_id', 1);
				}
				break;
			case 2:
				/*
				 升V3条件：销售额 9000元
				 判断条件：
				 1.$agentinfo[‘total_sales’]（交易总金额）>=9000
				 */
				$total_sales = $agentinfo['total_sales'];
				// echo $total_sales;die();
				if ($total_sales >= $store_reward['upgrade_sale']) {
					$this->table('agent')->where(array ("agent_id" => $agentinfo['agent_id']))->setInc('level_id', 1);
				}
				
				break;
			case 3:
				/*
				 升V4条件：销售额 105000元
				 判断条件：
				 1.$agentinfo[‘total_sales’]（交易总金额）>=105000
				 */
				$total_sales = $agentinfo['total_sales'];
				if ($total_sales >= $store_reward['upgrade_sale']) {
					$this->table('agent')->where(array ("agent_id" => $agentinfo['agent_id']))->setInc('level_id', 1);
				}
				
				break;
			case 4:
				/*
				 升V5条件：培养5个V4代理商
				 判断条件：
				 1.	count($this->table(“agent”)->
				 where(‘parent_id = ’. $INFO['agent_id'].’ And level_id >= 4’)->
				 findAll())>=5;
				 */
				$count = count($this->table("agent")->where("parent_id = " . $agentinfo['agent_id'] . " and level_id >=" . $agentinfo['level_id'])->select());
				if ($count >= $limitNum) {
					$this->table('agent')->where(array ("agent_id" => $agentinfo['agent_id']))->setInc('level_id', 1);
				}
				break;
			case 5:
				/*
				 升V6条件：培养5个V5代理商
				 判断条件：
				 1.	count($this->table(“agent”)->
				 array(”parent_id”=>$INFO['agent_id'],”level_id”=>5)
				 where(‘parent_id = ’. $INFO['agent_id'].’’)->
				 findAll())>=5;
				 */
				$count = count($this->table("agent")->where("parent_id = " . $agentinfo['agent_id'] . " and level_id >=" . $agentinfo['level_id'])->select());
				if ($count >= $limitNum) {
					$this->table('agent')->where(array ("agent_id" => $agentinfo['agent_id']))->setInc('level_id', 1);
				}
				break;
			// 当等级为V6时不执行升级逻辑
			default :
				break;
		}
	}
}
