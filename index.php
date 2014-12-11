<?php
/**
 * 入口
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
$site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')).'/wap/index.php');
$site_urll = "http://o2o.exweixin.com/weka/shop/index.php?act=seller_login&op=show_login";
@header('Location: '.$site_urll);

