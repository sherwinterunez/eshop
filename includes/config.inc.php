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

define('DB_USER', 'sherwint_sherwin');
define('DB_PASS', 'joshua04');
define('DB_NAME', 'sherwint_eshop');
define('DB_IP','127.0.0.1');
define('DB_PORT','5432');
define('DB_HOST', DB_IP.':'.DB_PORT);

define('APP_CODE', 'DEMO');

define('BASE_PATH', '/');

define('APP_NAME','Demo');

define('BACKTRACE', true);

define('MAX_USERACCOUNTS', 0); // 0 = unlimited, 1+ = limit

$toolbars = array();

$forms = array();

/* INCLUDES_END */

# eof includes/config/index.php