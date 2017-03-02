<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Date Created: March 1, 2017
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

/*pre($_GET);

if(!empty($_GET['id'])&&is_numeric($_GET['id'])&&intval($_GET['id'])>0) {
  $id = intval($_GET['id']);

  $customer_type = getCustomerType($id);

  pre(array('$customer_type'=>$customer_type,'$id'=>$id));

  if($customer_type=='STAFF') {
    computeStaffBalance($id);
  } else {
    computeCustomerBalance($id);
  }

}*/

$dt = getDbDate();

pre(array('$dt'=>$dt));
