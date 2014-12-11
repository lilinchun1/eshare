<?php
defined('InShopNC') or exit('Access Invalid!');
$config = array();
$config['shop_site_url'] 		= 'http://localhost/eshare/shop';
$config['cms_site_url'] 		= 'http://localhost/eshare/cms';
$config['microshop_site_url'] 	= 'http://localhost/eshare/microshop';
$config['circle_site_url'] 		= 'http://localhost/eshare/circle';
$config['admin_site_url'] 		= 'http://localhost/eshare/admin';
$config['mobile_site_url'] 		= 'http://localhost/eshare/mobile';
$config['wap_site_url'] 		= 'http://localhost/eshare/wap';
$config['upload_site_url']		= 'http://localhost/eshare/data/upload';
$config['resource_site_url']	= 'http://localhost/eshare/data/resource';
$config['version'] 		= '201401162490';
$config['setup_date'] 	= '2014-12-09 10:44:01';
$config['gip'] 			= 0;
$config['dbdriver'] 	= 'mysqli';
$config['tablepre']		= 'shopnc_';
$config['db'][1]['dbhost']  	= 'localhost';
$config['db'][1]['dbport']		= '3306';
$config['db'][1]['dbuser']  	= 'root';
$config['db'][1]['dbpwd'] 	 	= 'root';
$config['db'][1]['dbname']  	= 'eshare';
$config['db'][1]['dbcharset']   = 'UTF-8';
$config['db']['slave'] 		= array();
$config['session_expire'] 	= 3600;
$config['lang_type'] 		= 'zh_cn';
$config['cookie_pre'] 		= '96F3_';
$config['tpl_name'] 		= 'default';
$config['thumb']['cut_type'] = 'gd';
$config['thumb']['impath'] = '';
$config['cache']['type'] 			= 'memcache';
$config['memcache']['prefix']      	= 'nc_';
$config['memcache'][1]['port']     	= 11211;
$config['memcache'][1]['host']     	= '192.168.1.19';
$config['memcache'][1]['pconnect'] 	= 0;
$config['redis']['prefix']      	= 'nc_';
$config['redis']['master']['port']     	= 6379;
$config['redis']['master']['host']     	= '127.0.0.1';
$config['redis']['master']['pconnect'] 	= 0;
$config['redis']['slave']      	    = array();
$config['fullindexer']['open']      = false;
$config['fullindexer']['appname']   = 'shopnc';
$config['debug'] 			= true;
$config['default_store_id'] = '1';
// 是否开启伪静态
$config['url_model'] = false;
// 二级域名后缀
$config['subdomain_suffix'] = '';
$config['wxpay']['appid']	      	= 'wxebe886ccba20b5ce';//正式的:
$config['wxpay']['appsecret']      	= '5be8ae5cd56c2c9d33d2bac3c7173600';
//分页每页数
$config['page']['pagesize']    = 50;
$config['img_cdn_url'] 	 = 'http://localhost/eshare/_template';
$config['js_cdn_url']   = 'http://js-loc.excdn.net';
$config['debug'] 			= true;
$config['default_store_id'] = '1';
// 是否开启伪静态
$config['url_model'] = false;
// 二级域名后缀
$config['subdomain_suffix'] = '';