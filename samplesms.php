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

	$message = "28Apr 19:17: P100.00 is loaded to Load Wallet of 09216119988 from TOP MOBILE D 639397602109.New Balance:P2780.76 Ref:870057848198";

	//$message = "AIRTIME SMART 20 09216119988 F".$randint."\r\n";

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

}

sampleSMS();
