<?php
/**
 * 代理商订单详情
 *
 * @copyright  Copyright (c) 2013-2014 易享科技
 * @link       http://www.exweixin.com
 * @since      v1.0
 */
defined('InShopNC') or exit('Access Invalid!');
class textControl {
    public function test1OP(){
    	$model=Model('data_statistics');
     	
        $biao=$model->checkCache();
        //
         $biao1=unserialize($biao['channel_count']);
         //最近十天销量
         $biao2=unserialize($biao['order_sales']);
         //最近15天微代数
         $biao3=unserialize($biao['member_count']);
        
        
         //输出日期        
         $dw = '';
         for ($i = 9; $i >=0; $i --) {
         	if ($i == 0) {
         		$dw .= date('Ymd', time() - 86400 * $i);
         	} else {
         		$dw .= date('Ymd', time() - 86400 * $i) . ',';
         	}
         }
         //输出销量数据
         $result_clicknum_str = '';
         $request_date_array = explode(',', $dw);
         if(empty($biao2)){
         	for($i = 1;$i<=10;$i++){
         		$result_clicknum_str .= '0,';
         	}
         	$result_clicknum_str = trim($result_clicknum_str,',');
         }else{
         	foreach ($request_date_array as $val){
         		$find = false;
         		foreach ($biao2 as $fk=>$fv){
         			if($fv['a'] == $val){
         				$result_clicknum_str .= $fv['sum(order_amount)'].',';
         				$find = true;
         				break;
         			}
         		}
         		if(!$find){
         			$result_clicknum_str .= '0,';
         		}
         	}
         	$result_clicknum_str = trim($result_clicknum_str,',');
         }
         //输出日期
         $dwe = '';
         for ($i = 14; $i >=0; $i --) {
         	if ($i == 0) {
         		$dwe .= date('Ymd', time() - 86400 * $i);
         	} else {
         		$dwe .= date('Ymd', time() - 86400 * $i) . ',';
         	}
         }
         
         //输出微代数
         $result_clicknum_str1 = '';
         $request_date_array = explode(',', $dwe);
         if(empty($biao3)){
         	for($i = 1;$i<=15;$i++){
         		$result_clicknum_str1 .= '0,';
         	}
         	$result_clicknum_str1 = trim($result_clicknum_str1,',');
         }else{
         	foreach ($request_date_array as $val){
         		$find = false;
         		foreach ($biao3 as $fk=>$fv){
         			if($fv['b'] == $val){
         				$result_clicknum_str1 .= $fv['count(member.member_id)'].',';
         				$find = true;
         				break;
         			}
         		}
         		if(!$find){
         			$result_clicknum_str1 .= '0,';
         		}
         	}
         	$result_clicknum_str1 = trim($result_clicknum_str1,',');
         }
         $dws = '';
         for ($i = 9; $i >=0; $i --) {
         	if ($i == 0) {
         		$dws .= date('d', time() - 86400 * $i);
         	} else {
         		$dws .= date('d', time() - 86400 * $i) . ',';
         	}
         }
         $dwv = '';
         for ($i = 14; $i >=0; $i --) {
         	if ($i == 0) {
         		$dwv .= date('d', time() - 86400 * $i);
         	} else {
         		$dwv .= date('d', time() - 86400 * $i) . ',';
         	}
         }
         
          $authorization = false;
          if($_SERVER['PHP_AUTH_USER'] == "admin" && $_SERVER['PHP_AUTH_PW'] == "eshare123"){
         	
         	$authorization = true;
    	    include tools('form_red');
         	exit;
         }
         if(!$authorization){
         	header("WWW-Authenticate:Basic realm='login'");
         	header('HTTP/1.0 401 Unauthorized');
         	print "访问失败";
        
         }
    }
    public function test2Op(){
    	$model=Model('data_statistics');
     	$biao=$model->checkCache();
      	$biao1=unserialize($biao['order_count']);
      	$authorization = false;
      	if($_SERVER['PHP_AUTH_USER'] == "admin" && $_SERVER['PHP_AUTH_PW'] == "eshare123"){
      	
      		$authorization = true;
    	    include tools('ins');
      		exit;
      	}
      	if(!$authorization){
      		header("WWW-Authenticate:Basic realm='Private'");
      		header('HTTP/1.0 401 Unauthorized');
      		print "访问失败";
      	
      	}
    }
    public function test3Op(){
    	$model=Model('data_statistics');
    	$biao=$model->checkCache();
    	$biao2=unserialize($biao['order_sales']);
    	var_dump($biao2);die();
    }
    
}    