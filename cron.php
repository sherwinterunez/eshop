<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Date Created: March 1, 2017
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

$sql = "update tbl_loadtransaction set loadtransaction_status=".TRN_RECEIVED." where loadtransaction_id in (select loadtransaction_id from (select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_smartmoneytype='RECEIVED' and loadtransaction_status=".TRN_LOCKED.") a where elapsedtime>300);";

if(!($result = $appdb->query($sql))) {
  print_r(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
  die;
}

if(!($result = $appdb->query("select * from tbl_customer order by customer_id asc"))) {
  print_r(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
  die;
}

if(!empty($result['rows'][0]['customer_id'])) {
  foreach($result['rows'] as $k=>$v) {
    //print_r(array('customer_id'=>$v['customer_id']));

    $customer_id = $v['customer_id'];

    $currentunixdate = intval(getDbUnixDate());

    if(empty($v['customer_creditnotiafterduenotified'])&&!empty($v['customer_creditnotiafterdueunix'])&&$currentunixdate>=$v['customer_creditnotiafterdueunix']) {

      if(!empty(($gateways = getGateways($v['customer_mobileno'])))) {
        foreach($gateways as $g=>$h) {
          $noti = explode(',',$v['customer_creditnotiafterduemsg']);

          foreach($noti as $n) {
            sendToGateway($v['customer_mobileno'],$g,getNotificationByID($n));
          }
          break;
        }
      }

      $content = array();
      $content['customer_creditnotiafterduenotified'] = 1;

      if(!($result = $appdb->update('tbl_customer',$content,"customer_id=$customer_id"))) {
				return false;
			}

    } else
    if(empty($v['customer_creditduenotified'])&&!empty($v['customer_creditdueunix'])&&$currentunixdate>=$v['customer_creditdueunix']) {

      if(!empty(($gateways = getGateways($v['customer_mobileno'])))) {
        foreach($gateways as $g=>$h) {
          $noti = explode(',',$v['customer_creditnotiafterduemsg']);

          foreach($noti as $n) {
            sendToGateway($v['customer_mobileno'],$g,getNotificationByID($n));
          }
          break;
        }
      }

      $content = array();
      $content['customer_creditduenotified'] = 1;

      if(!($result = $appdb->update('tbl_customer',$content,"customer_id=$customer_id"))) {
				return false;
			}

    } else
    if(empty($v['customer_creditnotibeforeduenotified'])&&!empty($v['customer_creditnotibeforedueunix'])&&$currentunixdate>=$v['customer_creditnotibeforedueunix']) {

      if(!empty(($gateways = getGateways($v['customer_mobileno'])))) {
        foreach($gateways as $g=>$h) {
          $noti = explode(',',$v['customer_creditnotibeforeduemsg']);

          foreach($noti as $n) {
            sendToGateway($v['customer_mobileno'],$g,getNotificationByID($n));
          }
          break;
        }
      }

      $content = array();
      $content['customer_creditnotibeforeduenotified'] = 1;

      if(!($result = $appdb->update('tbl_customer',$content,"customer_id=$customer_id"))) {
				return false;
			}

    }

		$customer_type = getCustomerType($customer_id);

		if($customer_type=='STAFF') {
			computeStaffCreditDue($customer_id);
		} else {
			computeCustomerCreditDue($customer_id);
		}

  }
}


//
