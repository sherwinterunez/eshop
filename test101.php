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

define ("DEVICE_NOTSET", 0);
define ("DEVICE_SET", 1);
define ("DEVICE_OPENED", 2);

class APP_SMS extends SMS {

	public function deviceInit($device=false,$baudrate=115200) {

		if(!($this->deviceSet($device)&&$this->deviceOpen('w+')&&$this->setBaudRate($baudrate))) {
			return false;
		}

		return true;
	}

}

//echo "running...\n";
//sleep(10);
//echo date('l jS \of F Y h:i:s A')."\n";
//print_r($_SERVER);

//if(!empty($_GET)) {
//	print_r($_GET);
//}
//echo "done.\n";

/*if(!empty($_GET['q'])) {
	if($_GET['q']=='start') {
		$ch = new MyCurl;

		for($i=0;$i<10;$i++) {
			$url = 'http://0.0.0.0:8080/process_'.$i;
			$ch->get($url);
			sleep(5);
		}

	}
}*/

/*
$x = getSmartMoneyServiceFees();

pre(array('$x'=>$x));

$y = getSmartMoneyServiceFee('SMART PADALA SERVICE FEE',200);

pre(array('$y'=>$y));
*/

/*
$asims = getAllSims(11,false,'SMARTMONEY');

pre(array('$asims'=>$asims));

$asm = array();

foreach($asims as $k=>$v) {
	$sm = getSmartMoneyOfSim($v['simcard_id']);

	if(!empty($sm)) {
		//pre(array('$sm'=>$sm));

		foreach($sm as $n=>$m) {
			$m['simcard_number'] = $v['simcard_number'];
			$asm[] = $m;
		}
	}
}

pre(array('$asm'=>$asm));
*/

//$asm = getAllSmartMoney();

//pre(array('$asm'=>$asm));

/*
$mobileNo = '09477409000';
$dev = '/dev/ttyUSB0';
$ip = '192.168.1.200';

$sms = new APP_SMS;

$sms->dev = $dev;
$sms->mobileNo = $mobileNo;
$sms->ip = $ip;

doSMSCommands3($sms,$mobileNo,$ip);
*/


//$name = getRemitCustName(1);

//print_r(array('$name'=>$name));

//$masked = maskedSmartMoneyNumber('5577519462838104');

//print_r(array('$masked'=>$masked));

$asm = getAllSmartMoney();

print_r(array('$asm'=>$asm));


////
