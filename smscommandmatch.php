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

require_once(ABS_PATH.'includes/index.php');

date_default_timezone_set('Asia/Manila');


/*
            [smsinbox] => Array
                (
                    [smsinbox_contactsid] => 5
                    [smsinbox_contactnumber] => 09493621618
                    [smsinbox_simnumber] => 09088853095
                    [smsinbox_message] => eshop rl 5 09493621618
                    [smsinbox_unread] => 1
                )

*/


$content = array();
$content['smsinbox_contactsid'] = 5;
$content['smsinbox_contactnumber'] = '09493621618';
$content['smsinbox_simnumber'] = '09088853095';
//$content['smsinbox_message'] = '1/2 19-Jul 14:03:639397599095 has loaded SMARTLoad All Text 10 (P9.55) to 09493621618. Your new Load Wallet Balance is P1018.31.';
//$content['smsinbox_message'] = '19Jul 1742: 09397599095 has loaded LOAD 5 (P4.77) to 09493621618. New Load Wallet Balance:P999.23. Ref:071068076269';
//$content['smsinbox_message'] = '2/2 Maari ring ibenta ang Big Bytes 50 w/ 700 MB valid for 3 days! Text BIG50 to 2477. Ref:800011271612';
//$content['smsinbox_message'] = '19Jul 1904: 09397599095 has loaded LOAD 5 (P4.77) to 09493621618. New Load Wallet Balance:P989.69. Ref:071068117401';
$content['smsinbox_message'] = '19Jul 1934: 09397599095 has loaded LOAD 5 (P4.77) to 09493621618. New Load Wallet Balance:P984.92. Ref:071068133097';


/*$ret = smsExpressionsMatched($content);

pre(array('$ret'=>$ret));

if(!empty($ret['regx'])) {
	if(preg_match('/'.$ret['regx'].'/si', $ret['smsinbox']['smsinbox_message'], $matches)) {
		pre(array('$matches'=>$matches));
	}
}
*/

processSMS($content);








// eof