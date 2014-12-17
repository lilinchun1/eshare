<?php
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
define('PATH_NOTICE',str_replace('/wap/tmpl','',BASE_PATH));
if (!@include(PATH_NOTICE.'/global.php')) exit('global.php isn\'t exists!');
if (!@include(BASE_CORE_PATH.'/shopnc.php')) exit('shopnc.php isn\'t exists!');
Base::init();

?>