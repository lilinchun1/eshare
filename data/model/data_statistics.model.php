<?php
/**
 * 数据统计
 *
 *李天卓
 * @copyright Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license http://www.shopnc.net
 * @link http://www.shopnc.net
 * @since File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class data_statisticsModel extends Model {

	public function __construct () {
		parent::__construct();		
		$this->data = array ('sell_today' => '今日销售额', 
				             'sell_yesterday' => '昨日销售额',
				             'sell_sum' => '总销售额',
				             'sell_avg' => '日平均销售额', 
				             'deal_today' => '今日成交笔数',
				             'deal_yesterday' => '昨日成交笔数', 
				             'deal_sum' => '成交总数', 
				             'deal_avg' => '日平均成交数', 
				             'agent_today' => '今日微代人数', 
				             'agent_yesterday' => '昨日微代人数', 
			                 'agent_sum' => '微代总人数', 
				             'agent_avg' => '日平均微代人数', 
				             'salses_today' => '今日消费者数', 
				             'salses_yesterday' => '昨日消费者数', 
				             'salses_sum' => '消费者总数', 
				             'salses_avg' => '日消费者平均数', 
				             'agent_login_today' => '今日微代登录数',
				             'agent_login_yesterday' => '昨日微代登录数', 
				             'agent_login_sum' => '微代登陆总数', 
			                 'agent_login_avg' => '微代登陆日平均数', 
				             'share_sum' => '分享总数',
							 'share_avg' => '日平均分享数',
							 'goods_login_today' => '今日商品页访问数', 
							 'goods_login_yesterday' => '昨日商品页访问数', 
				 			 'goods_login_sum' => '商品页访问总数', 
							 'goods_login_avg' => '商品访问页日平均数', 
				             'order_sales' => '进15天销售额',
				             'member_count' => '近15天微代数', 
			                 'channel_count' => '热销商品top5', 
				             'order_count' => '机构统计',
			'share_yesterdays' => '昨日分享数',
			'share_todays' => '今日分享数'				
		);
	}

	/**
	 * 销售额、成交笔数
	 *
	 * @param string $condition 'sum'销售额
	 *        'num'成交笔数
	 * @param string $time 'yesterday'昨日
	 *        'today' 今日
	 *        'avg' 平均
	 *        'sum' 总额
	 */
	public function sale ($condition, $time) {
		if ($time == 'yesterday') {
			$star = strtotime(date("Y-m-d 0:0:0"))-(60*60*24);
			$end = strtotime(date("Y-m-d 23:59:59"))-(60*60*24);			
			$data['payment_time'] = array ('between', array ($star, $end));
		}
		if ($time == 'today') {
			$star = strtotime(date("Y-m-d 0:0:0"));
			$end = strtotime(date("Y-m-d 23:59:59"));
			$data['payment_time'] = array ('between', array ($star, $end));
		}
		if ($time == 'avg') {
			
			$day = ceil(time() - strtotime(date("2014-09-29 0:0:0")))/ (60 * 60 * 24);
		}
		$data['order_state'] = array ('in', '20,30,40');
		$data['order_amount']=array('gt','1');	
		if ($condition == 'sum') {
			$amount = $this->table('order')->where($data)->sum("goods_amount");
		}
		if ($condition == 'num') {
			$amount = $this->table('order')->where($data)->count("order_id");
		}
		
		if ($time == 'avg') {
			$amount = $amount / $day;
		}
		return round($amount, 3);
	}
  
	/**
	 *
	 * 微代人数/消费者数
	 *
	 * @param string $condition '1' 微代数
	 *        '0' 消费者数
	 * @param string $time 'yesterday'昨日
	 *        'today' 今日
	 *        'avg' 平均
	 *        'sum' 总额
	 */
	public function member ($condition, $time) {
		if ($time == 'yesterday') {
			
			$star = strtotime(date("Y-m-d 0:0:0"))-(60*60*24);
			$end = strtotime(date("Y-m-d 23:59:59"))-(60*60*24);			
			$data['member_time'] = array ('between', array ($star, $end));
		}
		if ($time == 'today') {
			$star = strtotime(date("Y-m-d 0:0:0"));
			$end = strtotime(date("Y-m-d 23:59:59"));
			$data['member_time'] = array ('between', array ($star, $end));
		}
		if ($time == 'avg') {
			//$order = $this->table('member')->order('member_time')->find();
			$day = ceil(time() - strtotime(date("2014-09-29 0:0:0")))/ (60 * 60 * 24);
		}		
		$data['is_agent'] = $condition;
		$amount = $this->table('member')->where($data)->count("member_id");
		
		if ($time == 'avg') {
			$amount = $amount / $day;
		}
		return round($amount, 3);
	}

	/**
	 *
	 * 微代登录数/分享数/商品页访问数
	 *
	 * @param string $condition 'agent' 微代登录数
	 *        'share' 分享数
	 *        'from' 商品页访问数
	 * @param string $time 'yesterday'昨日
	 *        'today' 今日
	 *        'avg' 平均
	 *        'sum' 总额
	 */
	public function agent_state ($condition, $time) {
		if ($time == 'yesterday') {
			$star = strtotime(date("Y-m-d 0:0:0"))-(60*60*24);
			$end = strtotime(date("Y-m-d 23:59:59"))-(60*60*24);			
			$data['state_time'] = array ('between', array ($star, $end));
		}
		if ($time == 'today') {
			$star = strtotime(date("Y-m-d 0:0:0"));
			$end = strtotime(date("Y-m-d 23:59:59"));
			$data['state_time'] = array ('between', array ($star, $end));
		}
		if ($time == 'avg') {
			$order = $this->table('agent_state')->order('state_time')->find();
			$day = ceil((time() - $order['state_time']) / (60 * 60 * 24));
		}
		
		if ($condition == 'agent') {
			$data['state_event'] = "agent_admin";
			$amount = $this->table('agent_state')->where($data)->count('DISTINCT agent_id')
			;
		}
		if ($condition == 'from') {
			$data['state_event'] = array ('in', 'from_timeline,from_groupmessage,from_singlemessage');
			$amount = $this->table('agent_state')->where($data)->count('state_id');
		}
		if ($condition == 'share') {
			$data['state_event'] = array ('in', 'share_timeline,share_message,share_weibo');
		    $amount = $this->table('agent_state')->where($data)->count('state_id');
			
		}
		
		if ($time == 'avg') {
			$amount = $amount / $day;
		}
		return round($amount, 3);
	}
	/**
	 * 商品访问量
	 */
	public function clickNum(){
		return $this->table('goods')->sum('goods_click');
	}
    /**
     * 商品日平均访问量
     * @return number
     */
    public function avgNum(){
    	$num=$this->table('goods')->sum('goods_click');
        $day = ceil(time() - strtotime(date("2014-09-29 0:0:0")))/ (60 * 60 * 24);
    	return $num / $day; 
    }
	/**
	 * 昨日分享数
	 * @return unknown
	 */
	public function shareYesterday(){
		$star = strtotime(date("Y-m-d 0:0:0"))-(60*60*24);
		$end = strtotime(date("Y-m-d 23:59:59"))-(60*60*24);
		$data['state_time'] = array ('between', array ($star, $end));
		$data['state_event'] = array ('in', 'share_timeline,share_message,share_weibo');
		$amount = $this->table('agent_state')->where($data)->count();
	    return $amount;
	}
	/**
	 * 查询商品名称、单价、今日、总销量排名前五的
	 */
	public function getGoodssSum ($extend = array()) {
		
		
		
		// 商品名称,商品单价,总销量前五条数据
		$sql="SELECT t1.goods_id,t1.goods_price,t1.goods_name, sum(t1.goods_num), t2.payment_time, t3.goods_click FROM shopnc_order_goods t1, shopnc_order t2, shopnc_goods t3 WHERE t1.order_id = t2.order_id and t2.order_state in ('20','30','40') and t1.goods_price>1 and t3.goods_id = t1.goods_id  group by t1.goods_id,t1.goods_price  order by  sum(t1.goods_num) desc limit 0,5";
		//$sql="select count(t1.order_id),t1.payment_time, count(t2.order_id), t2.goods_name, t2.goods_price, t3.goods_click ,t3.goods_id from shopnc_order t1, shopnc_order_goods t2, shopnc_goods t3 where t1.order_id = t2.order_id and t1.order_state in ('20','30','40') and t2.goods_id = t3.goods_id group by t2.goods_id order by count(t2.order_id) desc limit 0,5";
        // $ql="SELECT t1.goods_id,t1.goods_price,t1.goods_name, sum(t1.goods_num), t2.payment_time FROM shopnc_order_goods t1, shopnc_order t2 WHERE t1.order_id = t2.order_id and t2.order_state in  ('20','30','40') and t1.goods_price>1 and t2.payment_time  between 1413388800 and 1413475199 group by t1.goods_id ";;  
		$good=$this->query($sql);
// 		$good = $this->table('goods')
// 			->order('goods_salenum desc')
// 			->limit(5)
// 			->select();
		
		if (empty($good))
			return array ();
		$goods_list = array ();
		foreach ($good as $value) {
			if (! empty($extend))
				$goods_list[$value['goods_id']] = $value;
		}
		if (empty($goods_list))
			$goods_list = $good;
		
		$keys = "";
		foreach (array_keys($goods_list) as $value) {
			$keys .= $value . ',';
		}
		$keys = substr($keys, 0, strlen($keys) - 1);

        
		// 追加今日销量
		if (in_array('order_goods', $extend)) {
			$b = 't1.goods_id in (' . $keys . ')';
			
			$goods_common_list = $this->getTodayCount($b);
			
			foreach($good as $value){
				$data[$value['goods_price']]=$value['goods_price'];
			}
					
			if($goods_common_list){
				
			    foreach ($goods_common_list as $key=>$value) {
// 						if($goods_common_list=null){
// 							$goods_list[$value['goods_id']]['extend_goods'] = '0';
// 						}else{
                      
                       	  if(in_array($value['goods_price'],$data)){
				    	    $goods_list[$value['goods_id']]['extend_goods'] = $value;
							$goods_list[$value['goods_id']]['extend_goods']['sum(t1.goods_num)'] = $value['sum(t1.goods_num)'];
                       	  }
                       	 
// 			    		}
			       }
		      }
		}
		return $goods_list;
	}

	/**
	 * 今日销量
	 * 
	 * @return unknown
	 */
	public function getTodayCount ($condition) {

		// 开始时间
		$star = strtotime(date("Y-m-d 0:0:0"));//1413388800
		// 结束时间
		$end = strtotime(date("Y-m-d 23:59:59"));//1413475199

		$sql = "SELECT t1.goods_id,t1.goods_price, t1.goods_name, sum(t1.goods_num), t2.payment_time FROM shopnc_order_goods t1, shopnc_order t2 WHERE t1.order_id = t2.order_id and t2.order_state in  ('20','30','40') and t1.goods_price>1 and $condition and t2.payment_time  between $star and $end group by t1.goods_id,t1.goods_price";
		//echo $sql;die();
		//"SELECT t1.goods_id,t1.goods_price,t1.goods_name, sum(t1.goods_num), t2.payment_time FROM shopnc_order_goods t1, shopnc_order t2 WHERE t1.order_id = t2.order_id and t2.order_state in  ('20','30','40') and t1.goods_price>1 and t2.payment_time  between 1413388800 and 1413475199 group by t1.goods_id ";
		$list = $this->query($sql);

		
		
		return $list;
	}

	 
	// 查询机构名称、机构人数、成交笔数、成交金额
	public function getChannel () {
		$list = $this->table('channel')->select();
		foreach ($list as $key => $value) {
			$channel_list[$value['channel_name']] = $this->getChannelInfo($value['channel_id']);
		}		
		return $channel_list;
	}
	 
	/**
	 * 查询机构名称、机构人数、成交笔数、成交金额
	 * @param unknown $condition 机构的id
	 * @return multitype:机构人数，成交笔数，成交金额的数组 
	 */
	public function getChannelInfo ($condition) {
		//昨天
		$starl = strtotime(date("Y-m-d 0:0:0"))-(60*60*24);
		$endl = strtotime(date("Y-m-d 23:59:59"))-(60*60*24);
//         //今天
 		$star = strtotime(date("Y-m-d 0:0:0"));
  		$end = strtotime(date("Y-m-d 23:59:59"));
   		$tn = 'channel.channel_id=agent.channel_id,agent.agent_id=order.agent_id';
  		$on = 'channel.channel_id=agent.channel_id';
 		$ton = 'channel.channel_id=agent.channel_id,agent.agent_id=member.member_id';
		
		
		// 查询机构总人数
		$count['channel.channel_id'] = $condition;
		$list = $this->table('channel,agent')
			->join('inner')
			->on($on)
			->where($count)
			->count();
		// 查询今日机构人数
		$data['member_time'] = array ('between', array ($star, $end));
		$data['channel.channel_id'] = $condition;
		// 查询今日机构人数
		$todayc = $this->table('channel,agent,member')
			->join('inner,inner')
			->on($ton)
			->where($data)
			->count();
		
		$datal['member_time'] = array ('between', array ($starl, $endl));
		$datal['channel.channel_id'] = $condition;
		// 查询昨日机构人数
		$lastc = $this->table('channel,agent,member')
			->join('inner,inner')
			->on($ton)
			->where($datal)
			->count();
		

// 		// 成交笔数总数
		$countn['channel.channel_id'] = $condition;
		$countn['order.order_state'] =array('in','20,30,40');
		$countn['order.order_amount']=array('gt','1');
		// 查询成交笔数总数
		$sumorder = $this->table('agent,channel,order')
			->join('inner,inner')
			->on($tn)
			->where($countn)
			->count();
		
       
// 		// 今日成交数
		$datatg['order.payment_time'] = array ('between', array ($star, $end));
		$datatg['order.order_state'] =array('in','20,30,40');
		$datatg['channel.channel_id'] = $condition;
		$todayo = $this->table('channel,agent,order')
			->field('count(order_id)')
			->join('inner,inner')
			->on($tn)
			->where($datatg)
			->group('channel.channel_id')
			->find();
 		//昨 日成交数
		$datalg['order.payment_time'] = array ('between', array ($starl, $endl));
		$datalg['order.order_state'] =array('in','20,30,40');
		$datalg['channel.channel_id'] = $condition;
		$lasto = $this->table('channel,agent,order')
			->join('inner,inner')
			->on($tn)
			->where($datalg)
			->group('channel.channel_id')
			->count();
		
// 		// 成交总金额
		$counts['channel.channel_id'] = $condition;
		$counts['agent.total_sales']=array('gt','1');
		$summon = $this->table('channel,agent')
			->field('sum(total_sales)')
			->join('inner')
			->on($on)
			->where($counts)
			->group('channel.channel_id')
		    ->find();
		// 今日成交金额
 		$datast['order.payment_time'] = array ('between', array ($star, $end));
 		$datast['order.order_state'] =array('in','20,30,40');		
 		$datast['channel.channel_id'] = $condition;
 		$sumtodayorder = $this->table('channel,agent,order')
 		    ->field('sum(order_amount)')
 			->join('inner,inner')
 			->on($tn)
 			->where($datast)
			->group('channel.channel_id')
 			->find();
 		
 		// 昨日成交金额
 		$datasl['order.payment_time'] = array ('between', array ($starl, $endl));
 		$datasl['order.order_state'] =array('in','20,30,40');
 		$datasl['channel.channel_id'] = $condition;
 		$sumlastorder = $this->table('channel,agent,order')
 			->field('sum(order_amount)')
 			->join('inner,inner')
 			->on($tn)
 			->where($datasl)
 			->group('channel.channel_id')
 			->find();
 		//返回数组
 		$arry = array ($list, $todayc, $lastc, $sumorder, $todayo, $lasto, $summon, $sumtodayorder, $sumlastorder);		
 		return $arry;
	}

	/**
	 * 查询最近15天销量
	 *
	 * @return unknown array();
	 */
	public function dateSales () {
		$date = '';
		for ($i = 0; $i < 10; $i ++) {
			if ($i == 9) {
				$date .= date('Ymd', time() - 86400 * $i);
			} else {
				$date .= date('Ymd', time() - 86400 * $i) . ',';
			}
		}
		$list = $this->table('order')
			->field("DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d') as a,sum(order_amount),order_state")
			->where("DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d') in (" . $date . ") ")
			->group(" DATE_FORMAT(FROM_UNIXTIME(payment_time),'%Y%m%d') ")
			->select();
		// $sql="select DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d'),sum(order_amount) from shopnc_order where DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d')in (20141011,20141010,20141009,20141008,20141007,20141006,20141005,20141004,20141003,20141002,20141001,20140930,20140929,20140928,20140927) GROUP BY
		// DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d') ;";
		return $list;
	}

	/**
	 * 添加缓存方法
	 * 
	 * @return 字段：缓存表中sc_value的值;
	 */
	public function checkCache () {
		// 先查询所有的数据
		//$temp = $this->table('statis_cache')->select();
		$temp=$this->query("select * from shopnc_statis_cache");
		foreach ((array)$temp as $item) {
			// 遍历数组，获取数组中的值
			$list[$item['sc_key']] = $item;
			$data[$item['sc_key']] = $item['sc_value'];
		}
		unset($temp);
		
		foreach ($this->data as $key => $name) {
			
			// 判断是否存在key值(缓存表中：sc_key对应的值)
			if (!isset($list[$key])) {
				$data[$key] = $this->changeCache($key, true);
			} else{ 
 				// 存在key再判断是否过期
				if ($list[$key]['sc_time'] < time()) {
 					$data[$key] = $this->changeCache($key, false);
 				}
			}
			//echo $key . $name . " ;";
		}
		
		return $data;
	}

	/**
	 * 添加缓存数据方法
	 * 
	 * @param unknown $key 缓存表 sc_key对应的值
	 * @param unknown $value 缓存表 sc_value对应的值
	 */
	public function addCache ($key, $value) {
		$time = time() + (59); // 添加缓存延迟时间
		$array = array ('sc_key' => $key, 'sc_name' => $this->data[$key], 'sc_value' => $value, 'sc_time' => $time);
		return $this->table('statis_cache')->insert($array);
	}

	/**
	 * 更新缓存数据方法
	 * 
	 * @param unknown $key 缓存表 sc_key对应的值
	 * @param unknown $value 缓存表 sc_value对应的值
	 */
	public function updateCache ($key, $value) {
		$time = time() + (59);
		$array = array ('sc_key' => $key, 'sc_value' => $value, 'sc_time' => $time);
		return $this->table('statis_cache')->where(array ('sc_key' => $key))->update($array);
	}

	/**
	 * 是否进行更新或插入的方法
	 * 
	 * @param unknown $key 数组中的key值
	 * @param unknown $isadd 执行插入或更新的条件 true 为添加，false 为修改
	 * @return 查询到的所有数据的值
	 */
	public function changeCache ($key, $isadd) {
		switch ($key) {
			case 'sell_today' :
				$v = $this->sale('sum', 'today');
				break;
			case 'sell_yesterday' :
				$v = $this->sale('sum', 'yesterday');
				break;
			case 'sell_sum' :
				$v = $this->sale('sum', 'sum');
				break;
			case 'sell_avg' :
				$v = $this->sale('sum', 'avg');
				break;
			case 'deal_today' :
				$v = $this->sale('num', 'today');
				break;
			case 'deal_yesterday' :
				$v = $this->sale('num', 'yesterday');
				break;
			case 'deal_sum' :
				$v = $this->sale('num', 'sum');
				break;
			case 'deal_avg' :
				$v = $this->sale('num', 'avg');
				break;
			case 'agent_today' :
				$v = $this->member('1', 'today');
				break;
			case 'agent_yesterday' :
				$v = $this->member('1', 'yesterday');
				break;
			case 'agent_sum' :
				$v = $this->member('1', 'sum');
				break;
			case 'agent_avg' :
				$v = $this->member('1', 'avg');
				break;
			case 'salses_today' :
				$v = $this->member('0', 'today');
				break;
			case 'salses_yesterday' :
				$v = $this->member('0', 'yesterday');
				break;
			case 'salses_sum' :
				$v = $this->member('0', 'sum');
				break;
			case 'salses_avg' :
				$v = $this->member('0', 'avg');
				break;
			case 'agent_login_today' :
				$v = $this->agent_state('agent', 'today');
				break;
			case 'agent_login_yesterday' :
				$v = $this->agent_state('agent', 'yesterday');
				break;
			case 'agent_login_sum' :
				$v = $this->agent_state('agent', 'sum');
				break;
			case 'agent_login_avg' :
				$v = $this->agent_state('agent', 'avg');
				break;			
			case 'share_sum' :
				$v = $this->agent_state('share', 'sum');
				break;
			case 'share_avg' :
				$v = $this->agent_state('share', 'avg');
				break;
			case 'goods_login_today' :
				$v = $this->agent_state('from', 'today');
				break;
			case 'goods_login_yesterday' :
				$v = $this->agent_state('from', 'yesterday');
				break;
			case 'goods_login_sum' :
				$v = $this->clickNum();
				break;
			case 'goods_login_avg' :
				$v = $this->avgNum();
				break;
			case 'order_sales' :
				$v = serialize($this->dateSales());
				break;
			case 'member_count' :
				$v = serialize($this->datePerson());
				break;
			case 'channel_count' :
				$v = serialize($this->getGoodssSum(array ('order_goods')));
				break;
			case 'order_count' :
				$v = serialize($this->getChannel());
				break;
			case 'share_yesterdays' :
					$v = $this->shareYesterday();
					break;
			case 'share_todays' :
					$v = $this->agent_state('share', 'today');
					break;
		}
		
		 //echo "$key, $isadd<hr />";
		
		if ($isadd) {
			$this->addCache($key, $v);
		} else {
			$this->updateCache($key, $v);
		}
		return $v;
	}

	/**
	 * 查询最近15天微代数
	 *
	 * @return unknown array();
	 */
	public function datePerson () {
		$date = '';
		for ($i = 0; $i < 15; $i ++) {
			if ($i == 14) {
				$date .= date('Ymd', time() - 86400 * $i);
			} else {
				$date .= date('Ymd', time() - 86400 * $i) . ',';
			}
		}
		
		$on="member.member_id=agent.agent_id";
		$list = $this->table('member,agent')
			->field("DATE_FORMAT(FROM_UNIXTIME(member.member_time) ,'%Y%m%d') as b,count(member.member_id)")
			->join('inner')
			->on($on)
			->where("DATE_FORMAT(FROM_UNIXTIME(member.member_time) ,'%Y%m%d') in (" . $date . ")")
			->group(" DATE_FORMAT(FROM_UNIXTIME(member.member_time),'%Y%m%d') ")
			->select();
		
		// $sql="select DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d'),count(member_id) from shopnc_member where DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d')in (20141011,20141010,20141009,20141008,20141007,20141006,20141005,20141004,20141003,20141002,20141001,20140930,20140929,20140928,20140927) GROUP BY
		// DATE_FORMAT(FROM_UNIXTIME(payment_time) ,'%Y%m%d') ;";
		return $list;
	}

}	