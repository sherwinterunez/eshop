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

define('APPLICATION_RUNNING', true);

define('ABS_PATH', dirname(__FILE__) . '/');

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

define('INCLUDE_PATH', ABS_PATH . 'includes/');

//require_once(ABS_PATH.'includes/index.php');
//require_once(ABS_PATH.'modules/index.php');

//require_once(INCLUDE_PATH.'pdu.inc.php');
//require_once(INCLUDE_PATH.'pdufactory.inc.php');
//require_once(INCLUDE_PATH.'utf8.inc.php');
//require_once(INCLUDE_PATH.'sms.inc.php');

require_once(INCLUDE_PATH.'functions.inc.php');
require_once(INCLUDE_PATH.'curl.inc.php');

//echo "running...\n";
//sleep(10);
//echo date('l jS \of F Y h:i:s A')."\n";
//print_r($_SERVER);

//if(!empty($_GET)) {
//	print_r($_GET);
//}
//echo "done.\n";

if(!empty($_GET['q'])) {
	if($_GET['q']=='start') {
		$ch = new MyCurl;

		for($i=0;$i<10;$i++) {
			$url = 'http://0.0.0.0:8080/process_'.$i;
			$ch->get($url);
			sleep(5);
		}

		/*if(($cont = $ch->get($url))&&!empty($cont['content'])) {
		
			//pre($cont['content']);
		
			$ret = extractbingimages($cont['content'],$param);
					
			if(!empty($ret)&&is_array($ret)) return $ret;
			
		}*/

	}
}