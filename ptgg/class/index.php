<?php

header('Content-type:text/html;charset=utf-8');

define('DEFPAY', 'pay');

//报错设置
define('ENVIRONMENT', 'development');
if (defined('ENVIRONMENT')){
	switch (ENVIRONMENT){
		case 'development':
			error_reporting(E_ALL);
		break;
		case 'production':
			error_reporting(0);
		break;
		default:
			exit('The application environment is not set correctly.');
	}
}

//加载支付核心类
require_once 'core/pay.php';

PAY::get_instance()->init();

?>