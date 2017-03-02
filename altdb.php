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

//require_once(INCLUDE_PATH.'config.inc.php');
//require_once(INCLUDE_PATH.'miscfunctions.inc.php');
//require_once(INCLUDE_PATH.'functions.inc.php');
//require_once(INCLUDE_PATH.'errors.inc.php');
//require_once(INCLUDE_PATH.'error.inc.php');
//require_once(INCLUDE_PATH.'db.inc.php');
//require_once(INCLUDE_PATH.'pdu.inc.php');
//require_once(INCLUDE_PATH.'pdufactory.inc.php');
//require_once(INCLUDE_PATH.'utf8.inc.php');
//require_once(INCLUDE_PATH.'sms.inc.php');
//require_once(INCLUDE_PATH.'userfuncs.inc.php');

date_default_timezone_set('Asia/Manila');

define ("DEVICE_NOTSET", 0);
define ("DEVICE_SET", 1);
define ("DEVICE_OPENED", 2);

$db_user = getOption('$DB_USER',DB_USER);
$db_pass = getOption('$DB_PASS',DB_PASS);
$db_name = getOption('$DB_NAME',DB_NAME);
$db_ip = getOption('$DB_IP',DB_IP);
$db_port = getOption('$DB_PORT',DB_PORT);
$db_host = $db_ip.':'.$db_port;

$appdb->close();

$appdb = new APP_Db($db_host, $db_name, $db_user, $db_pass);

if(!($result = $appdb->query("select * from tbl_options"))) {
	json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
	die;				
}

pre($result);




