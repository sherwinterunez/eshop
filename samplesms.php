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

function sampleSMS() {
	global $appdb;

	echo "\nsampleSMS starting.\n";

	//$message = 'QLOAD PASALOAD15 09493621255a';

	//$message = 'QLOAD S10 09493621618';

	//$message = 'KEYLIST';

	$randint = rand (1,10000);

	//$message = "AIRTIME DEALER 09182799988 F".$randint."\r\n";

	//$message = "AIRTIME DEALERTRANSFER 09182799988 F".$randint."\r\n";

	//$message = "AIRTIME SMART 50 09182799988 F".$randint."\r\n";

	//$message = "29Apr 1030: Transfer of P500.00 from Dealer TOP MOBILE D to Load Wallet 09397889394 completed. Avail Bal:P73,820.00 Ref:060213437377";

	//$message = "28Apr 19:17: P3000.00 is loaded to Load Wallet of 09216119988 from TOP MOBILE D 639397602109.New Balance:P5780.76 Ref:870057848198";

	//$message = "AIRTIME SMART 20 09216119988 F".$randint."\r\n";

/*
	$content = array();
	//$content['smsinbox_contactsid'] = 138;
	//$content['smsinbox_contactnumber'] = getCustomerNumber($content['smsinbox_contactsid']);
	//$content['smsinbox_contactnumber'] = 'SMARTMoney';
	$content['smsinbox_contactnumber'] = 'SMARTLoad';
	$content['smsinbox_simnumber'] = '09397602109';
	$content['smsinbox_message'] = $message;
	$content['smsinbox_unread'] = 1;

	processSMS($content);

	$result = $appdb->insert('tbl_smsinbox',$content,'smsinbox_id');

	$tstop = timer_stop();

	echo "\nsampleSMS done (".$tstop." secs).\n";
*/

/*
	//$message = "LOADRETAIL AT10 09483621618 DRAFT\r\n";
	$message = "LOADRETAIL AT10 09483621618 APPROVED\r\n";

	$content = array();
	$content['smsinbox_contactsid'] = 138;
	$content['smsinbox_contactnumber'] = getCustomerNumber($content['smsinbox_contactsid']);
	//$content['smsinbox_contactnumber'] = 'SMARTMoney';
	//$content['smsinbox_contactnumber'] = 'SMARTLoad';
	$content['smsinbox_simnumber'] = '09197708008';
	$content['smsinbox_message'] = $message;
	$content['smsinbox_unread'] = 1;

	processSMS($content);

	//$result = $appdb->insert('tbl_smsinbox',$content,'smsinbox_id');

	$tstop = timer_stop();

	echo "\nsampleSMS done (".$tstop." secs).\n";
*/

/*
	$message = "LOADRETAIL AT10 09483621618 APPROVED\r\n";

	$content = array();
	$content['smsinbox_message'] = $message;
	$content['smsinbox_contactsid'] = 138;
	$content['smsinbox_contactnumber'] = getCustomerNumber($content['smsinbox_contactsid']);
	$content['smsinbox_simnumber'] = '09197708008';

	if(!($matched=smsLoadCommandMatched($content))) {
		//return false;
		$matched = false;
	}

	//$out = prebuf(array('$matched'=>$matched));
	//$out = printrbuf(array('$matched'=>$matched));

	//$aout = explode("\n",$out);

	$aout = arrayprintrbuf($matched);

	print_r(array('$aout'=>$aout));

	//echo $out;
*/

/*
$message = "CONFIRM Ref:8ce57d66c530\nCustomer Cellphone#:09493621255\nReceiver Cellphone#:09088853095";

sendToOutBox('8890','09477409000',$message);
*/

//$message = "SMARTMONEY PADALA 5577519462838104 500 09088853095 09493621255 APPROVED <LOADTRANSACTIONID>\r\n";

/*
$message = "SMARTMONEY PADALA 5577519462838104 500 09088853095 09493621255 APPROVED 12345\r\n";

$content = array();
$content['smsinbox_contactsid'] = 138;
$content['smsinbox_contactnumber'] = getCustomerNumber($content['smsinbox_contactsid']);
//$content['smsinbox_contactnumber'] = 'SMARTMoney';
//$content['smsinbox_contactnumber'] = 'SMARTLoad';
$content['smsinbox_simnumber'] = '09197708008';
$content['smsinbox_message'] = $message;
$content['smsinbox_unread'] = 1;

processSMS($content);
*/

//$message = "1/2 26Aug 1558:Remittance of PHP600.00 & commission of PHP11.50 was received from 639477409000.LIBRE ang pag-claim ng iyong customer.Ref:a1e65ae6793a\r\n";

/*
$message = "01Oct 1004: Received P500.00 with P11.50 commission from 09282573535 to LOADING.LIBRE ang pag-claim! Ref:3152f53eeab6 Bal:P9,459.00\r\n";

$content = array();
//$content['smsinbox_contactsid'] = 138;
//$content['smsinbox_contactnumber'] = getCustomerNumber($content['smsinbox_contactsid']);
//$content['smsinbox_contactnumber'] = 'SMARTMoney';
$content['smsinbox_contactnumber'] = 'SmartPadala';
$content['smsinbox_simnumber'] = '09092701100';
$content['smsinbox_message'] = $message;
$content['smsinbox_unread'] = 1;

processSMS($content);

//$result = $appdb->insert('tbl_smsinbox',$content,'smsinbox_id');

$tstop = timer_stop();

echo "\nsampleSMS done (".$tstop." secs).\n";
*/

//$message = "AIRTIME GOSURF99 09173621234\r\n";

$message = "17Jan 1221:Sent P500.00 from LOADING to ****1105 at 09287860079. Also deducted P18.50 from your account.Bal:P11,428.75.Ref:71a86777319c";

$content = array();
$content['smsinbox_contactsid'] = 0; //138;
$content['smsinbox_contactnumber'] = 'SmartPadala'; //getCustomerNumber($content['smsinbox_contactsid']);
//$content['smsinbox_contactnumber'] = 'SMARTMoney';
//$content['smsinbox_contactnumber'] = 'SMARTLoad';
$content['smsinbox_simnumber'] = '09477409000'; //'09197708008';
$content['smsinbox_message'] = $message;
$content['smsinbox_unread'] = 1;

processSMS($content);

//$result = $appdb->insert('tbl_smsinbox',$content,'smsinbox_id');

$tstop = timer_stop();

echo "\nsampleSMS done (".$tstop." secs).\n";

}

sampleSMS();
