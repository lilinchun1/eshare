<?php
defined('InShopNC') or exit('Access Invalid!');
$config = array();
$config['shop_site_url'] 		= 'http://localhost/b2b2c/shop';
$config['cms_site_url'] 		= 'http://localhost/b2b2c/cms';
$config['microshop_site_url'] 	= 'http://localhost/b2b2c/microshop';
$config['circle_site_url'] 		= 'http://localhost/b2b2c/circle';
$config['admin_site_url'] 		= 'http://localhost/b2b2c/admin';
$config['mobile_site_url'] 		= 'http://localhost/b2b2c/mobile';
$config['wap_site_url'] 		= 'http://localhost/b2b2c/wap';
$config['upload_site_url']		= 'http://localhost/b2b2c/data/upload';
$config['resource_site_url']	= 'http://localhost/b2b2c/data/resource';
$config['version'] 		= '201401162490';
<<<<<<< .mine
$config['setup_date'] 	= '2014-08-21 15:10:01';
=======
$config['setup_date'] 	= '2014-08-27 11:25:43';
>>>>>>> .r14
$config['gip'] 			= 0;
$config['dbdriver'] 	= 'mysqli';
$config['tablepre']		= 'shopnc_';
$config['db'][1]['dbhost']  	= 'localhost';
$config['db'][1]['dbport']		= '3306';
$config['db'][1]['dbuser']  	= 'root';
<<<<<<< .mine
$config['db'][1]['dbpwd'] 	 	= 'root';
$config['db'][1]['dbname']  	= 'db_shopnc';
=======
$config['db'][1]['dbpwd'] 	 	= 'root';
$config['db'][1]['dbname']  	= 'shopnc';
>>>>>>> .r14
$config['db'][1]['dbcharset']   = 'UTF-8';
$config['db']['slave'] 		= array();
$config['session_expire'] 	= 3600;
$config['lang_type'] 		= 'zh_cn';
<<<<<<< .mine
$config['cookie_pre'] 		= 'AA86_';
=======
$config['cookie_pre'] 		= '1253_';
>>>>>>> .r14
$config['tpl_name'] 		= 'default';
$config['thumb']['cut_type'] = 'gd';
$config['thumb']['impath'] = '';
$config['cache']['type'] 			= 'file';
//$config['memcache']['prefix']      	= 'nc_';
//$config['memcache'][1]['port']     	= 11211;
//$config['memcache'][1]['host']     	= '127.0.0.1';
//$config['memcache'][1]['pconnect'] 	= 0;
//$config['redis']['prefix']      	= 'nc_';
//$config['redis']['master']['port']     	= 6379;
//$config['redis']['master']['host']     	= '127.0.0.1';
//$config['redis']['master']['pconnect'] 	= 0;
//$config['redis']['slave']      	    = array();
//$config['fullindexer']['open']      = false;
//$config['fullindexer']['appname']   = 'shopnc';
$config['debug'] 			= true;
$config['default_store_id'] = '1';
// 是否开启伪静态
$config['url_model'] = false;
// 二级域名后缀
$config['subdomain_suffix'] = '';