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

//require_once('gsmsms.class.inc.php');
//require_once('Pdu/Pdu.php');
//require_once('Pdu/PduFactory.php');
//require_once('Utf8/Utf8.php');

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

function portCheck($dev=false,$localIP=false) {
	global $appdb;

	//$dev = '/dev/ttyS3';

	if(!empty($dev)&&!empty($localIP)) {
	} else return false;

	//echo "\nportCheck starting ($dev).\n";

	$sms = new APP_SMS;

	//$portdevice = "/dev/cu.usbserial";

	//echo "\nInitializing port ($dev).\n";

	if(!@$sms->deviceInit($dev)) {
		//echo "\nError initializing device ($dev)!\n";
		return false;
	}

	//echo "\nInitializing done.\n";

	//echo "\nSending AT Command.\n";

	$mobileNo = false;

	/*if($sms->sendMessageOk("AT\r\n",10)) {
		//print_r($sms->history);
		$sms->clearHistory();
	} else {
		//print_r($sms->history);
		return false;
		//die('An error has occured!');
	}*/

	$ctr=0;
	$success=false;

	do {

		//echo "\ndo loop ($ctr) $dev ....";

		$sms->resetCMEError();

		if($sms->at()) {
			//$sms->clearHistory();
			$success=true;
			break;
		}

		if($sms->isCMEError()) {
			$sms->sendMessageOk("AT+CFUN=1\r\n",1);
		}

		$ctr++;

	} while($ctr<10);

	if(!$success) return false;

	//echo "success!";

	$sms->clearHistory();

	/*if($sms->at()) {
		$sms->clearHistory();
	} else {
		return false;
	}*/

	if(!($result=$appdb->query('select * from tbl_port where port_device=\''.$dev.'\''))) {
		return false;
	}

	if(!empty($result['rows'][0]['port_id'])) {
		$content = array();
		$content['port_device'] = $dev;
		$content['port_updatestamp'] = 'now()';

		$appdb->update('tbl_port',$content,'port_id='.$result['rows'][0]['port_id']);

		$portid = $result['rows'][0]['port_id'];
	} else {
		$content = array();
		$content['port_device'] = $dev;
		$content['port_name'] = 'PORT'.str_replace('/','_',$dev);

		$result = $appdb->insert('tbl_port',$content,'port_id');

		if(!empty($result['returning'][0]['port_id'])) {
			$portid = $result['returning'][0]['port_id'];
		}
	}

	// [0] => +CNUM: "","639465937842",129
	// [0] => +CNUM: " ","639287710253",129

	//if($sms->sendMessageReadPort("AT+CNUM\r\n", "\+CNUM\:\s+\".+?\"\,\"(.+?)\"\,.+?\r\nOK\r\n")) {

	//if($sms->sendMessageReadPort("AT+CNUM\r\n", "\+CNUM\:\s+.+?(\d+).+?\r\nOK\r\n")) {

	//if($sms->sendMessageReadPort("AT+CNUM\r\n", "\+CNUM\:\s+(.+?)\r\nOK\r\n")) {
	if($sms->sendMessageReadPort("AT+CNUM\r\n", "\+CNUM\:\s+(.+?)\r\n")) {
		$result = $sms->getResult();
		//print_r(array('$result'=>$result));
		$sms->clearHistory();

		$cnum = explode(',', $result[1]);

		foreach($cnum as $v) {
			$v = str_replace('"', '', $v);
			if(($res=parseMobileNo($v))) {
				//print_r(array('$res'=>$res));
				$mobileNo = '0'.$res[2].$res[3];
				$mobileNetwork = getNetworkName($mobileNo);
				break;
			}
		}

		//if(preg_match()) {

		//}

	} else
	if($sms->sendMessageReadPort("AT+CNUM\r\n", "OK\r\n")) {
		$result = $sms->getResult();
		//print_r(array('$result'=>$result));
		$sms->clearHistory();
		$mobileNo = 'UNKNOWN';
	} else {
		//print_r($sms->history);
		$sms->clearHistory();
		$mobileNo = 'UNKNOWN';
		//return false;
		//die('An error has occured!');
	}

	/*if($sms->sendMessageOk("AT+COPS?\r\n")) {
		print_r($sms->history);
		$sms->clearHistory();
	} else {
		print_r($sms->history);
		return false;
		//die('An error has occured!');
	}

	if($sms->sendMessageOk("AT+COPS=?\r\n")) {
		print_r($sms->history);
		$sms->clearHistory();
	} else {
		print_r($sms->history);
		return false;
		//die('An error has occured!');
	}*/

	$mobileNetwork = getNetworkName($mobileNo);

	//print_r(array('$mobileNo'=>$mobileNo,'$mobileNetwork'=>$mobileNetwork));

/*
	if(!($result=$appdb->query('select * from tbl_sim where sim_number=\''.$mobileNo.'\''))) {
		return false;
	}

	if(!empty($result['rows'][0]['sim_id'])) {
		$content = array();
		$content['sim_device'] = $dev;
		$content['sim_updatestamp'] = 'now()';
		$content['sim_network'] = $mobileNetwork;
		$content['sim_online'] = 1;
		$content['sim_ip'] = $localIP;

		$appdb->update('tbl_sim',$content,'sim_id='.$result['rows'][0]['sim_id']);
	} else {
		$content = array();
		$content['sim_device'] = $dev;
		$content['sim_name'] = 'SIM'.$mobileNo;
		$content['sim_number'] = $mobileNo;
		$content['sim_network'] = $mobileNetwork;
		$content['sim_online'] = 1;
		$content['sim_ip'] = $localIP;

		$result = $appdb->insert('tbl_sim',$content,'sim_id');

		setSetting('TIME_MODEMINIT_'.$dev,1);

		//if(!empty($result['returning'][0]['sim_id'])) {
		//}
	}
*/

	if($mobileNo=='UNKNOWN') {
		$sql = "select * from tbl_simcard where simcard_number='$mobileNo' and simcard_linuxport='$dev'";
	} else {
		$sql = "select * from tbl_simcard where simcard_number='$mobileNo'";
	}

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	//trigger_error($this->dev." ".$this->mobileNo." ".$this->ip." $v",E_USER_NOTICE);

	trigger_error($sql,E_USER_NOTICE);

	$comport = '';

	if(preg_match('/.+?(\d+)/si',$dev,$match)) {
		$portno = intval($match[1])+1;

		if($portno<10) {
			$comport = 'COM0'.$portno;
		} else {
			$comport = 'COM'.$portno;
		}
	}

	if(!empty($result['rows'][0]['simcard_id'])) {
		$content = array();
		$content['simcard_linuxport'] = $dev;
		$content['simcard_comport'] = $comport;
		$content['simcard_updatestamp'] = 'now()';
		$content['simcard_provider'] = $mobileNetwork;
		$content['simcard_online'] = 1;
		$content['simcard_ipaddress'] = $localIP;

		$appdb->update('tbl_simcard',$content,'simcard_id='.$result['rows'][0]['simcard_id']);

		trigger_error($appdb->lastquery,E_USER_NOTICE);

	} else {
		$content = array();
		$content['simcard_ymd'] = date('Ymd');
		$content['simcard_linuxport'] = $dev;
		$content['simcard_comport'] = $comport;
		$content['simcard_name'] = 'SIM'.$mobileNo;
		$content['simcard_number'] = $mobileNo;
		$content['simcard_provider'] = $mobileNetwork;
		$content['simcard_online'] = 1;
		$content['simcard_ipaddress'] = $localIP;

		$result = $appdb->insert('tbl_simcard',$content,'simcard_id');

		trigger_error($appdb->lastquery,E_USER_NOTICE);

		setSetting('TIME_MODEMINIT_'.$dev,1);

		//if(!empty($result['returning'][0]['simcard_id'])) {
		//}
	}

	if(!empty($portid)) {
		$appdb->update('tbl_port',array('port_simnumber'=>$mobileNo),'port_id='.$portid);
	}

	//echo "\nSending done.\n";

	$sms->deviceClose();

	//$tstop = timer_stop();

	//echo "\nportCheck done. (".$tstop." secs).\n";

	if($mobileNo=='UNKNOWN') {
		return false;
	}

	return $mobileNo;
}

$ports = array();
/*$ports[] = '/dev/ttyS0';
$ports[] = '/dev/ttyS1';
$ports[] = '/dev/ttyS2';
$ports[] = '/dev/ttyS3';
$ports[] = '/dev/ttyUSB0';
$ports[] = '/dev/ttyUSB1';
$ports[] = '/dev/ttyUSB2';
$ports[] = '/dev/ttyUSB3';
$ports[] = '/dev/ttyUSB4';
$ports[] = '/dev/ttyUSB5';*/

$files = scandir('/dev');

//print_r(array('$files'=>$files));

if(!empty($files)&&is_array($files)) {
	foreach($files as $file) {
		if(preg_match('/ttyD|ttyS|ttyU|cu\.usb/s',$file)) {
		//if(preg_match('/ttyU|cu\.usb/s',$file)) {
			$ports[] = '/dev/'.$file;
		}
	}
}

//print_r(array('$ports'=>$ports));

$localIP = getMyLocalIP();

if(trim($localIP)=='') {
	$localIP = '127.0.0.1';
}

$timeout = 120;

$timeoutat = time() + $timeout;

$flag = false;

do {

	$localIP = getMyLocalIP();

	if(trim($localIP)=='') {
		$localIP = '127.0.0.1';
	} else
	if(trim($localIP)=='0.0.0.0'||trim($localIP)=='127.0.0.1') {
	} else {
		break;
	}

	sleep(1);

} while ($timeoutat > time());

$appdb->query('delete from tbl_port');

$okport = array();
$mobileNos = array();
$devices = array();

//$appdb->update('tbl_simcard',array('simcard_online'=>0));

$appdb->update('tbl_simcard',array('simcard_online'=>0,'simcard_comport'=>'','simcard_linuxport'=>'','simcard_ipaddress'=>''));

foreach($ports as $dev) {
	if($mno=portCheck($dev,$localIP)) {

		setSetting('TIME_MODEMINIT_'.$mno,1);

		$devices[] = array('port'=>$dev,'sim'=>$mno,'ip'=>$localIP);
		$mobileNos[] = "'".$mno."'";
		$okport[] = $dev;
	}
}

//$appdb->update('tbl_sim',array('sim_online'=>0),'sim_number not in ('.implode(',', $mobileNos).')');

$tstop = timer_stop();

setSetting('STATUS_SIMERROR','0');

echo json_encode(array('ports'=>$okport,'devices'=>$devices,'time'=>$tstop));

//print_r(array('$okport '=>$okport ));

//echo "\nportCheck done. (".$tstop." secs).\n";
