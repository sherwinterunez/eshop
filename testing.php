<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Date Created: February 23, 2011
*
* Description:
*
* Application entry point.
*
*/

//define('ANNOUNCE', true);

error_reporting(E_ALL);

ini_set("max_execution_time", 300);

define('APPLICATION_RUNNING', true);

define('ABS_PATH', dirname(__FILE__) . '/');

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

//define('INCLUDE_PATH', ABS_PATH . 'includes/');

require_once(ABS_PATH.'includes/index.php');
//require_once(ABS_PATH.'modules/index.php');

/*require_once(INCLUDE_PATH.'config.inc.php');
require_once(INCLUDE_PATH.'miscfunctions.inc.php');
require_once(INCLUDE_PATH.'functions.inc.php');
require_once(INCLUDE_PATH.'errors.inc.php');
require_once(INCLUDE_PATH.'error.inc.php');
require_once(INCLUDE_PATH.'db.inc.php');
require_once(INCLUDE_PATH.'pdu.inc.php');
require_once(INCLUDE_PATH.'pdufactory.inc.php');
require_once(INCLUDE_PATH.'utf8.inc.php');
require_once(INCLUDE_PATH.'sms.inc.php');
require_once(INCLUDE_PATH.'userfuncs.inc.php');*/

date_default_timezone_set('Asia/Manila');

//print_r(array('STATUS_RETRIEVESMS'=>setOption('STATUS_RETRIEVESMS','1','SETTING',true)));

//print_r(array('hello'=>'world'));

/*$str = 'ESHOP  RL  AT10     09493621618'."\r\r\r\r\r\r\r\r\n\n\n\n\n\n\r\n\r\n\r\n\r\n\r\n"."f1";

$str = clearDoubleSpace($str);

$str = clearcrlf2($str);

//$str = str_replace(' ','*',$str);

pre(array('$str'=>'['.$str.']'));*/

//$num = '1,234,344.00554564';

//pre(array('toFloat'=>toFloat($num,3)));

//$appsession->start();

//pre(array('$_SESSION'=>$_SESSION));

//$smsinbox_contactsid = 135;

//computeStaffCreditDue2($smsinbox_contactsid);

//$fund_recepientid = 73;

//$discountSchemes = getStaffCustomerReloadDiscountScheme2($fund_recepientid);

//pre(array('$discountSchemes'=>$discountSchemes));

$no = '09091224234';

$customer_id = getCustomerIDByDefaultNumber($no);

$customer_type = getCustomerType($customer_id);

$retailersimassigned = getRetailerSimAssign($customer_id);

print_r(array('$customer_id'=>$customer_id,'$customer_type'=>$customer_type,'$retailersimassigned'=>$retailersimassigned));

$dt = getDbDate(2);

print_r(array('$dt'=>$dt));

///
