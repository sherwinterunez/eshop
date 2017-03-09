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

function processOutbox($dev=false,$mobileNo=false,$ip='') {
	global $appdb;

	if(!empty($dev)&&!empty($mobileNo)&&!empty($ip)) {
	} else return false;

	//echo "\nprocessOutbox started: ($dev) ($mobileNo).\n";

	//atLog('processOutbox starting','processoutbox',$dev,$mobileNo,$ip,logdt());

	$sms = new APP_SMS;

	$sms->dev = $dev;
	$sms->mobileNo = $mobileNo;
	$sms->ip = $ip;

	if(!$sms->deviceInit($dev)) {
		$em = 'Error initializing device!';
		atLog($em,'processoutbox',$dev,$mobileNo,$ip,logdt());
		trigger_error("$dev $mobileNo $ip $em",E_USER_NOTICE);
		setSetting('STATUS_SIMERROR','1');
		return false;
	}

	if(!$sms->at()) {
		$em = 'processOutbox failed (AT)';
		atLog($em,'processoutbox',$dev,$mobileNo,$ip,logdt());
		trigger_error("$dev $mobileNo $ip $em",E_USER_NOTICE);

		$ctr = getOption('STATUS_AT_ERROR_'.$mobileNo,0);

		$ctr++;

		setSetting('STATUS_AT_ERROR_'.$mobileNo,$ctr);

		$sms->deviceClose();
		return false;
	}

	setSetting('STATUS_AT_ERROR_'.$mobileNo,'0');

	$sms->clearHistory();


/////

	$delaysms = false;

	if(!($result = $appdb->query("select *,(extract(epoch from now()) - extract(epoch from smsoutbox_createstamp)) as elapsedtime from tbl_smsoutbox where smsoutbox_simnumber='$mobileNo' and smsoutbox_deleted=0 and smsoutbox_delay>0 and smsoutbox_status=1 order by smsoutbox_id asc limit 5"))) {
		//echo "\n0 message. processOutbox done.\n";
		return false;
	}

	if(!empty($result['rows'][0]['smsoutbox_id'])) {

		print_r(array('$rows'=>$result['rows']));

		$delaysms = $result['rows'];

		if(!empty($delaysms)&&is_array($delaysms)) {
			foreach($delaysms as $k=>$v) {
				if($v['elapsedtime']>$v['smsoutbox_delay']) {

					if(!($result = $appdb->update("tbl_smsoutbox",array('smsoutbox_status'=>1,'smsoutbox_delay'=>0),"smsoutbox_id=".$v['smsoutbox_id']))) {
						return false;
					}

				}
			}
		}

	}

/////

	$agw = getAllGateways(2);

	//print_r(array('getAllGateways(2)'=>$agw));

	$resetGateways = array();

	foreach($agw as $k=>$v) {
		//if($v>120) {  // 2 minutes
		if($v>10) {  // 10 seconds
			if(isSimEnabled($k)&&isSimOnline($k)&&isGatewayFailed($k)) {
				$resetGateways[] = $k;
				setGatewayFailedToFalse($k);
			}
		}
	}

/////

	// resend failed messages by moving to other gateways

	$sendsms = false;

	$limit = 1;

	//$sql = "select * from tbl_smsoutbox where smsoutbox_simnumber='$mobileNo' and smsoutbox_deleted=0 and smsoutbox_delay=0 and smsoutbox_status=5 order by smsoutbox_id asc limit $limit";

	$sql = "select *,(extract(epoch from now()) - extract(epoch from smsoutbox_failedstamp)) as elapsedtime from tbl_smsoutbox where smsoutbox_deleted=0 and smsoutbox_delay=0 and smsoutbox_status in (1,3,5) order by smsoutbox_id asc limit $limit";

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		//echo "\n0 message. processOutbox done.\n";
		return false;
	}

	if(!empty($result['rows'][0]['smsoutbox_id'])) {

		//pre($result['rows']);

		$sendsms = $result['rows'];

		if(!empty($sendsms)&&is_array($sendsms)) {

			foreach($sendsms as $k=>$smsoutbox) {

				if(!empty($smsoutbox['smsoutbox_failed'])&&$smsoutbox['elapsedtime']>180) { // 3 minutes
					print_r(array('MOVING SMS SEND FAILED 1'=>array('$smsoutbox'=>$smsoutbox)));

					if(!in_array($smsoutbox['smsoutbox_simnumber'],$resetGateways)) {
						if(isGateway($smsoutbox['smsoutbox_simnumber'])) {
							if(!isGatewayFailed($smsoutbox['smsoutbox_simnumber'])) {
								setGatewayFailedToTrue($smsoutbox['smsoutbox_simnumber']);
							}
						}
					}

					moveToGateway($smsoutbox['smsoutbox_id']);
				} else
				if(($smsoutbox['smsoutbox_status']==1||$smsoutbox['smsoutbox_status']==3||$smsoutbox['smsoutbox_status']==5)&&$smsoutbox['elapsedtime']>180) {
					print_r(array('MOVING SMS SEND FAILED 2'=>array('$smsoutbox'=>$smsoutbox)));

					//if(isGateway($smsoutbox['smsoutbox_simnumber'])) {
					//	setGatewayFailedToTrue($smsoutbox['smsoutbox_simnumber']);
					//}

					//if(isGateway($smsoutbox['smsoutbox_simnumber'])) {
					//	if(!isGatewayFailed($smsoutbox['smsoutbox_simnumber'])) {
					//		setGatewayFailedToTrue($smsoutbox['smsoutbox_simnumber']);
					//	}
					//}

					if(!in_array($smsoutbox['smsoutbox_simnumber'],$resetGateways)) {
						if(isGateway($smsoutbox['smsoutbox_simnumber'])) {
							if(!isGatewayFailed($smsoutbox['smsoutbox_simnumber'])) {
								setGatewayFailedToTrue($smsoutbox['smsoutbox_simnumber']);
							}
						}
					}

					moveToGateway($smsoutbox['smsoutbox_id']);
				}
			}
		}
	}


/////

	//pre(array('$agw'=>$agw));

	$sendsms = false;

	$limit = 1;

	//$sql = "select * from tbl_smsoutbox where smsoutbox_simnumber='$mobileNo' and smsoutbox_deleted=0 and smsoutbox_delay=0 and smsoutbox_status=1 order by smsoutbox_id asc limit 5";

	$sql = "select * from tbl_smsoutbox where smsoutbox_simnumber='$mobileNo' and smsoutbox_deleted=0 and smsoutbox_delay=0 and smsoutbox_status=1 order by smsoutbox_id asc limit $limit";

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		//echo "\n0 message. processOutbox done.\n";
		return false;
	}

	if(!empty($result['rows'][0]['smsoutbox_id'])) {

		//print_r(array('$sql'=>$sql));

		//print_r(array('$results here'=>$result['rows']));

		$sendsms = $result['rows'];

		//echo "\nstarted sending.\n";

		//atLog('processOutbox started sending sms','processoutbox',$dev,$mobileNo,$ip,logdt());

		if(!empty($sendsms)&&is_array($sendsms)) {

			$total = 0;

			foreach($sendsms as $k=>$v) {
				//if($v['smsoutbox_total']==1) {

					//if(sendSMS($v['smsoutbox_portdevice'],$v['smsoutbox_contactnumber'],$v['smsoutbox_message'])) {

					$appdb->update("tbl_smsoutbox",array('smsoutbox_status'=>3,'smsoutbox_sentstamp'=>'now()'),'smsoutbox_status=1 and smsoutbox_id='.$v['smsoutbox_id']);

					//if(!empty($v['smsoutbox_promossentid'])) {
					//	$appdb->update("tbl_promossent",array('promossent_status'=>3,'promossent_sentstamp'=>'now()'),'promossent_id='.$v['smsoutbox_promossentid']);
					//}

					//if(!empty($v['smsoutbox_schedulersentid'])) {
					//	$appdb->update("tbl_schedulersent",array('schedulersent_status'=>3,'schedulersent_sentstamp'=>'now()'),'schedulersent_id='.$v['smsoutbox_schedulersentid']);
					//}

					//if(!empty($v['smsoutbox_referralsentid'])) {
					//	$appdb->update("tbl_referralsent",array('referralsent_status'=>3,'referralsent_sentstamp'=>'now()'),'referralsent_id='.$v['smsoutbox_referralsentid']);
					//}

					if(($count=sendSMS($sms,$v['smsoutbox_contactnumber'],$v['smsoutbox_message']))) {

						$appdb->update("tbl_smsoutbox",array('smsoutbox_status'=>4,'smsoutbox_sentstamp'=>'now()'),'smsoutbox_id='.$v['smsoutbox_id']);

						//if(!empty($v['smsoutbox_promossentid'])) {
						//	$appdb->update("tbl_promossent",array('promossent_status'=>4,'promossent_sentstamp'=>'now()'),'promossent_id='.$v['smsoutbox_promossentid']);
						//}

						//if(!empty($v['smsoutbox_schedulersentid'])) {
						//	$appdb->update("tbl_schedulersent",array('schedulersent_status'=>4,'schedulersent_sentstamp'=>'now()'),'schedulersent_id='.$v['smsoutbox_schedulersentid']);
						//}

						//if(!empty($v['smsoutbox_referralsentid'])) {
						//	$appdb->update("tbl_referralsent",array('referralsent_status'=>4,'referralsent_sentstamp'=>'now()'),'referralsent_id='.$v['smsoutbox_referralsentid']);
						//}

						$total+=$count;

						if($total>2) {
							break;
						}

					} else {

						$smsoutbox_failed = $v['smsoutbox_failed'] + 1;

						$appdb->update("tbl_smsoutbox",array('smsoutbox_status'=>5,'smsoutbox_failed'=>$smsoutbox_failed,'smsoutbox_failedstamp'=>'now()'),'smsoutbox_id='.$v['smsoutbox_id']);

						$smsoutbox = $v;

						print_r(array('SMS SEND FAILED'=>array('$smsoutbox'=>$smsoutbox)));

						if(isGateway($smsoutbox['smsoutbox_simnumber'])) {
							setGatewayFailedToTrue($smsoutbox['smsoutbox_simnumber']);

							moveToGateway($smsoutbox['smsoutbox_id']);
						}

						//if(!empty($v['smsoutbox_promossentid'])) {
						//	$appdb->update("tbl_promossent",array('promossent_status'=>5),'promossent_id='.$v['smsoutbox_promossentid']);
						//}

						//if(!empty($v['smsoutbox_schedulersentid'])) {
						//	$appdb->update("tbl_schedulersent",array('schedulersent_status'=>5,'schedulersent_sentstamp'=>'now()'),'schedulersent_id='.$v['smsoutbox_schedulersentid']);
						//}

						//if(!empty($v['smsoutbox_referralsentid'])) {
						//	$appdb->update("tbl_referralsent",array('referralsent_status'=>5,'referralsent_sentstamp'=>'now()'),'referralsent_id='.$v['smsoutbox_referralsentid']);
						//}
					}

				//} else
				//if($v['smsoutbox_total']>1) {
				//}
			}
		}

		//atLog('processOutbox done sending sms','processoutbox',$dev,$mobileNo,$ip,logdt());

		//echo "\ndone sending.\n";

	}

	$history = $sms->getHistory();

	if(!empty($history)) {
		foreach($history as $a=>$b) {
			foreach($b as $k=>$v) {
				if($k=='timestamp') continue;
				$dt = logdt($b['timestamp']);
				trigger_error("$dev $mobileNo $ip $v",E_USER_NOTICE);
				doLog("PROCESSOUTBOX $dt $dev $mobileNo $ip $v",$mobileNo);
				//atLog($v,'processoutbox',$dev,$mobileNo,$ip,$dt);
			}
		}
	}

	$sms->deviceClose();

	$tstop = timer_stop();

	//print_r(array('$mobileNo'=>$mobileNo));

	//echo "\nprocessOutbox (".$tstop." secs).\n";

	atLog('processOutbox done ('.$tstop.' secs)','processoutbox',$dev,$mobileNo,$ip,logdt());

	return true;
}

if(getOption('$MAINTENANCE',false)) {
	die("\nprocessOutbox: Server under maintenance.\n");
}

if(!empty($_GET['dev'])&&!empty($_GET['sim'])&&!empty($_GET['ip'])&&isSimEnabled($_GET['sim'])) {

	setSetting('STATUS_PROCESSOUTBOX_'.$_GET['sim'],'1');

	if(processOutbox($_GET['dev'],$_GET['sim'],$_GET['ip'])) {
		setSetting('STATUS_PROCESSOUTBOX_'.$_GET['sim'],'0');
	}

}
