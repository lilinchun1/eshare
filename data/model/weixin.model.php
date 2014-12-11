<?php
/**
 * 微信功能模型管理
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class weixinModel{

    /**
     * 关键字回复
     * @param int $store_id 商户的唯一标示 
     * @param string $keyword 微信的发送的关键字 默认为空字符串
     * @param string $reply_type 回复的类型 默认为空字符串
     * @return array 连表查询取出各个类型回复的内容
     * @author zyt
     */
    public function get_keyword($store_id,$keyword ='',$reply_type=''){
 		if($keyword && !$reply_type){
 			$info = Model()->table('weixin_keyword')->where(array('keyword'=>$keyword))->find();
 			if($info){
 			$condition = array('weixin_keyword.reply_type'=>"keyword",'weixin_keyword.keyword'=>$keyword);
 			}else{
 			$condition = array('weixin_keyword.reply_type'=>"auto");
 			}
 		}
 		
 		if(!$keyword && $reply_type){
 			$condition = array('weixin_keyword.reply_type'=>$reply_type);
 		}
 		
 		$weixin_reply = Model()
 		->table('weixin_reply,weixin_keyword')
 		->join('LEFT')
 		->on('weixin_reply.keyword_id = weixin_keyword.keyword_id')
 		->where($condition)
 		->order('order_num ASC')
 		->select();
 		return $weixin_reply;
    	
    }
    
    /**
     * 获取微信凭证 ACCESS_TOKEN
     * @param int $store_id 商户id
     * @return String $access_token 微信凭证
     * @author zhangyating
     **/
    public function getACCESS_TOKEN($store_id){
    	$data = Model()->table('access_token')->where(array('store_id'=>$store_id))->find();
    	if(TIMESTAMP-$data['expire_time']>7200){
    		$ACCESS_TOKEN = $this->setACCESS_TOKEN($store_id);
    	}else{
    		$ACCESS_TOKEN = $data['access_token'];
    	}
    	return $ACCESS_TOKEN;
    }
    
    /**
     * 创建ACCESS_TOKEN
     * @param int $store_id 商户id
     * @return string $access_token 微信凭证
     * @author zhangyating
     * */
    public function setACCESS_TOKEN($store_id){
    	$data = Model()->table('access_token')->where(array('store_id'=>$store_id))->find();
    	$AppId = $data['appid'];
    	$AppSecret = $data['appsecret'];
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$AppId."&secret=".$AppSecret;
    	$info = $this->getHttpResponseGET($url);
    	$arr = json_decode($info,$assoc=true);
    	$ACCESS_TOKEN = $arr['access_token'];
    	$map = array(
    			'access_token'=>$ACCESS_TOKEN,
    			'expire_time'=>TIMESTAMP
    	);
		Model()->table('access_token')->where(array('store_id'=>$store_id))->update($map);
    	return $ACCESS_TOKEN;
    }
    
  
    
    /**
     * 客服接口（高级接口）
     * @author zhangyating
     * @param int $uid
     * @param array $data 需要传递的一系列数据 其中$data['openId']为openId,
     * $data['type']为1、2、3、4、5、6 ，分别表示 文本、图片、语音、视频、音乐、图文*/
    public function service_other($uid,$data){
    	switch($data['type']){
    		case 1: $json = '{
								    "touser":"'.strval($data['openId']).'",
								    "msgtype":"text",
								    "text":
								    {
								         "content":"'.$data['content'].'"
								    }
								}';
    		$this->Service($uid,$json);
    		break;
    		case 2: $json = '{
							    "touser":"OPENID",
							    "msgtype":"image",
							    "image":
							    {
							      "media_id":"MEDIA_ID"
							    }
							}';
    		$this->Service($uid,$json);
    		break;
    		case 3: $json = '{
							    "touser":"OPENID",
							    "msgtype":"voice",
							    "voice":
							    {
							      "media_id":"MEDIA_ID"
							    }
							}';
    		$this->Service($uid,$json);
    		break;
    		case 4: $json = '{
							    "touser":"OPENID",
							    "msgtype":"video",
							    "video":
							    {
							      "media_id":"MEDIA_ID",
							      "title":"TITLE",
							      "description":"DESCRIPTION"
							    }
							}';
    		$this->Service($uid,$json);
    		break;
    		case 5: $json = '{
							    "touser":"OPENID",
							    "msgtype":"music",
							    "music":
							    {
							      "title":"MUSIC_TITLE",
							      "description":"MUSIC_DESCRIPTION",
							      "musicurl":"MUSIC_URL",
							      "hqmusicurl":"HQ_MUSIC_URL",
							      "thumb_media_id":"THUMB_MEDIA_ID"
							    }
							}';
    		$this->Service($uid,$json);
    		break;
    		case 6: $json = '{
							    "touser":"OPENID",
							    "msgtype":"news",
							    "news":{
							        "articles": [
							         {
							             "title":"Happy Day",
							             "description":"Is Really A Happy Day",
							             "url":"URL",
							             "picurl":"PIC_URL"
							         },
							         {
							             "title":"Happy Day",
							             "description":"Is Really A Happy Day",
							             "url":"URL",
							             "picurl":"PIC_URL"
							         }
							         ]
							    }
							}';
    		$this->Service($uid,$json);
    		break;
    	}
    }
    
    /**
     * 48小时客服接口
     * @param int $store_id 商户唯一id
     * @param string $json 正确的json字符串
     * '{
     "touser":"'.$openid.'",
     "msgtype":"text",
     "text":
     {
     "content":"'.$param.'"
     }
     }' 文字连接
    
     '{
     "touser":"'.$openid.'",
     "msgtype":"news",
     "news":{
     "articles": [
     {
     "title":"'.$title.'",
     "description":"'.$instruction.'",
     "url":"'.$url.'",
     "picurl":"'.$imgurl.'"
     }
     ]
     }}' 图文连接
     */
    public function Service($store_id,$json){
    	$access_token = $this->getACCESS_TOKEN($store_id);
    	$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
    	$this->getHttpResponsePOST($url,$json);
    }

    /**
     * 远程获取数据，GET模式
     * 注意：
     * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
     * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
     * @param $url 指定URL完整路径地址
     * @param $cacert_url 指定当前工作目录绝对路径
     * return 远程输出的数据
     */
    public function getHttpResponseGET($url) {
    	$curl = curl_init($url);
    	//curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//SSL证书认证
    	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//不认证
    	curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
    	curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    	$responseText = curl_exec($curl);
    	//var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    	curl_close($curl);
    	return $responseText;
    
    }
    
    /**
     * 远程获取数据，POST模式
     * 注意：
     * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
     * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
     * @param $url 指定URL完整路径地址
     * @param $cacert_url 指定当前工作目录绝对路径
     * @param $para 请求的数据
     * @param $input_charset 编码格式。默认值：空值
     * return 远程输出的数据
     */
    function getHttpResponsePOST($url, $para, $input_charset = '') {
    	if (trim($input_charset) != '') {
    		$url = $url."_input_charset=".$input_charset;
    	}
    	$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//SSL证书认证
    	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//严格认证
    	curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
    	curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    	curl_setopt($curl,CURLOPT_POST,true); // post传输数据
    	curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
    	$responseText = curl_exec($curl);
    	//var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    	curl_close($curl);
    
    	return $responseText;
    }


}
