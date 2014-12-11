<?php
/**
 * 短信接口
 *
 * @package    library
 * @copyright  Copyright (c) 2007-2014 易享科技
 * @link       http://www.exweixin.net
 * @author	   秦涛
 * @since      v1.0
 */
defined('InShopNC') or exit('Access Invalid!');
class Sms{

	/**
	 * 发送短信
	 * 接口文档 http://www.ihuyi.com/upload/file/cu-fa-jie-kou.rar
	 *
	 * @param string $mobile 手机号码
	 * @param string $message 短信内容
	 * @param array  $error 引用，错误信息
	 * @return bool 布尔形式的返回结果
	 */
	public static function send($mobile, $content, &$error){
		$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
		if(preg_match("/1\d{10}/", $mobile)){
			//$data   = "account=cf_yxkj&password=eshare39588708&mobile=".$mobile."&content=".rawurlencode($content);
			$data   = "account=cf_dlxyl&password=dlxyl123&mobile=".$mobile."&content=".rawurlencode($content);
			$error  = self::xml_to_array(self::curl_post($data, $target));
			if($error){
				$error = $error['SubmitResult'];
			}else{
				$error = array(
					'code'  => 0,
					'smsid' => 0,
					'msg'   => '未知错误',
				);
			}
		}else{
			$error    = array(
				'code'  => 403,
				'smsid' => 0,
				'msg'   => '手机号码不能为空',
			);
		}

		if($error['code'] == 2){
			$arr = array(
				'mobile'    => $mobile,
				'message'   => $content,
				'send_time' => time(),
			);
			Model('sms_log')->insert($arr);

			return true;
		}else{
			return false;
		}
	}

	/**
	 * CURL POST方法
	 *
	 * @param string $data
	 * @param string $url
	 * @param string
	 */
	private static function curl_post($data, $url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$return_str = curl_exec($curl);
		curl_close($curl);
		return $return_str;
	}

	/**
	 * 解析短信返回信息数组
	 *
	 * @param string $xml
	 * @param array
	 */
	private static function xml_to_array($xml){
		$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
		if(preg_match_all($reg, $xml, $matches)){
			$count = count($matches[0]);
			for($i = 0; $i < $count; $i++){
			$subxml= $matches[2][$i];
			$key = $matches[1][$i];
				if(preg_match( $reg, $subxml )){
					$arr[$key] = self::xml_to_array( $subxml );
				}else{
					$arr[$key] = $subxml;
				}
			}
		}
		return $arr;
	}
}
