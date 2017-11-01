<?php
//--HEADSTART
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* Config file
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

/* INCLUDES_START */

//--HEADEND

//define('DB_USER', 'sherwint_sherwin');
//define('DB_PASS', 'joshua04');
//define('DB_NAME', 'sherwint_eshop');
//define('DB_IP','127.0.0.1');
//define('DB_PORT','5432');
//define('DB_HOST', DB_IP.':'.DB_PORT);

global $_CONSTANTS;

define('TRN_APPROVED',1);
define('TRN_PROCESSING',2);
define('TRN_SENT',4);
define('TRN_COMPLETED',8);
define('TRN_PENDING',16);
define('TRN_CANCELLED',32);
define('TRN_COMPLETED_MANUALLY',64);
define('TRN_HOLD',128);
define('TRN_FAILED',256);
define('TRN_QUEUED',512);
define('TRN_INVALID_SIM_COMMANDS',1024);
define('TRN_CLAIMED',2048);
define('TRN_DRAFT',4096);
define('TRN_WAITING',8192);
define('TRN_POSTED',16384);
define('TRN_RECEIVED',32768);
define('TRN_LOCKED',65536);

define('TRNS_APPROVED','APPROVED');
define('TRNS_PROCESSING','PROCESSING');
define('TRNS_SENT','SENT');
define('TRNS_COMPLETED','COMPLETED');
define('TRNS_PENDING','PENDING');
define('TRNS_CANCELLED','CANCELLED');
define('TRNS_COMPLETED_MANUALLY','COMPLETED MANUALLY');
define('TRNS_HOLD','HOLD');
define('TRNS_FAILED','FAILED');
define('TRNS_QUEUED','QUEUED');
define('TRNS_INVALID_SIM_COMMANDS','INVALID SIM COMMANDS');
define('TRNS_CLAIMED','CLAIMED');
define('TRNS_DRAFT','DRAFT');
define('TRNS_WAITING','WAITING');
define('TRNS_POSTED','POSTED');
define('TRNS_RECEIVED','RECEIVED');
define('TRNS_LOCKED','LOCKED');

$_CONSTANTS['STATUS'] = array(
		TRN_APPROVED => TRNS_APPROVED,
		TRN_PROCESSING => TRNS_PROCESSING,
		TRN_SENT => TRNS_SENT,
		TRN_COMPLETED => TRNS_COMPLETED,
		TRN_PENDING => TRNS_PENDING,
		TRN_CANCELLED => TRNS_CANCELLED,
		TRN_COMPLETED_MANUALLY => TRNS_COMPLETED_MANUALLY,
		TRN_HOLD => TRNS_HOLD,
		TRN_FAILED => TRNS_FAILED,
		TRN_QUEUED => TRNS_QUEUED,
		TRN_INVALID_SIM_COMMANDS => TRNS_INVALID_SIM_COMMANDS,
		TRN_CLAIMED => TRNS_CLAIMED,
		TRN_DRAFT => TRNS_DRAFT,
		TRN_WAITING => TRNS_WAITING,
    TRN_POSTED => TRNS_POSTED,
		TRN_RECEIVED => TRNS_RECEIVED,
		TRN_LOCKED => TRNS_LOCKED,
	);

/* INCLUDES_END */

# eof includes/config/index.php
