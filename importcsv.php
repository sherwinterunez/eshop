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

$lines = file('linuxeshop.csv');

//pre(array('$lines'=>$lines));

/*
[$rows] => Array
    (
        [0] => contact
        [1] => lastname ok
        [2] => firstname ok
        [3] => middlename ok
        [4] => name
        [5] => creditlimit
        [6] => balance
        [7] => phonenumber
        [8] => loadprovider
        [9] => housenoandstreet
        [10] => barangay
        [11] => citymunicipality
        [12] => province
        [13] => zipcode

    )
*/

foreach($lines as $k=>$v) {
  $post = explode(',',$v);

  if($k===0) continue;

//  pre(array('$post'=>$post));

  $content = array();
  $content['customer_firstname'] = !empty($post[2]) ? trim($post[2]) : '';
  $content['customer_lastname'] = !empty($post[1]) ? trim($post[1]) : '';
  $content['customer_middlename'] = !empty($post[3]) ? trim($post[3]) : '';
  //$content['customer_suffix'] = !empty($post['customer_suffix']) ? $post['customer_suffix'] : '';
  //$content['customer_birthdate'] = !empty($post['customer_birthdate']) ? $post['customer_birthdate'] : '';
  //$content['customer_gender'] = !empty($post['customer_gender']) ? $post['customer_gender'] : '';
  //$content['customer_civilstatus'] = !empty($post['customer_civilstatus']) ? $post['customer_civilstatus'] : '';
  $content['customer_accounttype'] = 'CASH';
  //$content['customer_company'] = !empty($post['customer_company']) ? $post['customer_company'] : '';
  $content['customer_pahouseno'] = !empty($post[9]) ? trim($post[9]) : '';
  $content['customer_pabarangay'] = !empty($post[10]) ? trim($post[10]) : '';
  $content['customer_pamunicipality'] = !empty($post[11]) ? trim($post[11]) : '';
  $content['customer_paprovince'] = !empty($post[12]) ? trim($post[12]) : '';
  $content['customer_pazipcode'] = !empty($post[13]) ? trim($post[13]) : '';
  //$content['customer_aahouseno'] = !empty($post['customer_aahouseno']) ? $post['customer_aahouseno'] : '';
  //$content['customer_aabarangay'] = !empty($post['customer_aabarangay']) ? $post['customer_aabarangay'] : '';
  //$content['customer_aamunicipality'] = !empty($post['customer_aamunicipality']) ? $post['customer_aamunicipality'] : '';
  //$content['customer_aaprovince'] = !empty($post['customer_aaprovince']) ? $post['customer_aaprovince'] : '';
  //$content['customer_aazipcode'] = !empty($post['customer_aazipcode']) ? $post['customer_aazipcode'] : '';
  //$content['customer_creditlimit'] = !empty($post['customer_creditlimit']) ? floatval($post['customer_creditlimit']) : 0;
  //$content['customer_criticallevel'] = !empty($post['customer_criticallevel']) ? floatval($post['customer_criticallevel']) : 0;
  //$content['customer_parent'] = !empty($post['customer_parent']) ? $post['customer_parent'] : 0;
  //$content['customer_accounttype'] = !empty($post['customer_accounttype']) ? $post['customer_accounttype'] : '';
  $content['customer_type'] = $customer_type = 'REGULAR';
  //$content['customer_freezelevel'] = !empty($post['customer_freezelevel']) ? $post['customer_freezelevel'] : 0;
  //$content['customer_terms'] = !empty($post['customer_terms']) ? $post['customer_terms'] : '';
  //$content['customer_paymentpercentage'] = !empty($post['customer_paymentpercentage']) ? $post['customer_paymentpercentage'] : 100;
  //$content['customer_freezed'] = !empty($post['customer_freezed']) ? 1 : 0;
  //$content['customer_discountfundtransfer'] = !empty($post['customer_discountfundtransfer']) ? $post['customer_discountfundtransfer'] : '';

  $content['customer_ymd'] = date('Ymd');

  if(!($result = $appdb->insert("tbl_customer",$content,"customer_id"))) {
    pre(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
    die;
  }

  pre(array('$content'=>$content));

  if(!empty($result['returning'][0]['customer_id'])) {
    $customer_id = $result['returning'][0]['customer_id'];
  }

  if(($res=parseMobileNo($post[7]))) {
		$number = '0'.$res[2].$res[3];
  }

  if(!empty($number)) {
    $vcontent = array();
    $vcontent['virtualnumber_customerid'] = $customer_id;
    $vcontent['virtualnumber_mobileno'] = $number;


    $vcontent['virtualnumber_provider'] = getNetworkName($number);
    $vcontent['virtualnumber_default'] = 1;
    $vcontent['virtualnumber_active'] = 1;

    pre(array('$vcontent'=>$vcontent));

    if(!($result = $appdb->insert("tbl_virtualnumber",$vcontent,"virtualnumber_id"))) {
      pre(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
      //die;
      continue;
    }

    $mcontent = array();
    $mcontent['customer_mobileno'] = $number;

    pre(array('$mcontent'=>$mcontent));

    if(!($result = $appdb->update("tbl_customer",$mcontent,"customer_id=".$customer_id))) {
      pre(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
      die;
    }

  }

  $staffId = 22;

  $content = array();
  $content['fund_ymd'] = $fund_ymd = date('Ymd');
  $content['fund_type'] = 'customerreload';
  $content['fund_amount'] = !empty($post[5]) ? $post[5] : 0;
  $content['fund_amountdue'] = $fund_amountdue = !empty($content['fund_amount']) ? $content['fund_amount'] : 0;
  //$content['fund_discount'] = !empty($post['fund_discount']) ? $post['fund_discount'] : 0;
  //$content['fund_processingfee'] = !empty($post['fund_processingfee']) ? $post['fund_processingfee'] : 0;
  $content['fund_datetimeunix'] = $fund_datetimeunix = time();
  $content['fund_datetime'] = pgDateUnix($content['fund_datetimeunix']);
  $content['fund_userid'] = $fund_userid = $staffId;
  $content['fund_username'] = getCustomerNameByID($content['fund_userid']);
  $content['fund_usernumber'] = getCustomerNumber($content['fund_userid']);
  //$content['fund_userpaymentterm'] = !empty($post['fund_userpaymentterm']) ? $post['fund_userpaymentterm'] : '';
  $content['fund_recepientid'] = $fund_recepientid = $customer_id;
  $content['fund_recepientname'] = getCustomerNameByID($content['fund_recepientid']);
  $content['fund_recepientnumber'] = getCustomerNumber($content['fund_recepientid']);
  //$content['fund_recepientpaymentterm'] = !empty($post['fund_recepientpaymentterm']) ? $post['fund_recepientpaymentterm'] : '';
  $content['fund_status'] = 1;
  $content['fund_staffid'] = $staffId;

  if(!($result = $appdb->insert("tbl_fund",$content,"fund_id"))) {
    pre(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
    die;
  }

  if(!empty($result['returning'][0]['fund_id'])) {
    $fund_id = $result['returning'][0]['fund_id'];
  }

  if(!empty($fund_id)) {

    if(!($result = $appdb->query("delete from tbl_ledger where ledger_fundid=".$fund_id))) {
      pre(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
      die;
    }

    $receiptno = $fund_ymd . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', $fund_id);

    $content = array();
    $content['ledger_fundid'] = $fund_id;
    $content['ledger_credit'] = $fund_amountdue;
    $content['ledger_type'] = 'CUSTOMERRELOAD '.$fund_amountdue;
    $content['ledger_datetimeunix'] = $fund_datetimeunix;
    $content['ledger_datetime'] = pgDateUnix($fund_datetimeunix);
    $content['ledger_user'] = $fund_recepientid;
    $content['ledger_seq'] = '0';
    $content['ledger_receiptno'] = $receiptno;

    if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
      pre(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
      die;
    }

    computeCustomerBalance($fund_recepientid);

    $content['ledger_user'] = $staffId;

    if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
      json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
      die;
    }

    computeStaffBalance($staffId);
  }

}

pre(array('completed'=>'finished!'));

/*
$content = array();
$content['customer_firstname'] = !empty($post['customer_firstname']) ? $post['customer_firstname'] : '';
$content['customer_lastname'] = !empty($post['customer_lastname']) ? $post['customer_lastname'] : '';
$content['customer_middlename'] = !empty($post['customer_middlename']) ? $post['customer_middlename'] : '';
$content['customer_suffix'] = !empty($post['customer_suffix']) ? $post['customer_suffix'] : '';
$content['customer_birthdate'] = !empty($post['customer_birthdate']) ? $post['customer_birthdate'] : '';
$content['customer_gender'] = !empty($post['customer_gender']) ? $post['customer_gender'] : '';
$content['customer_civilstatus'] = !empty($post['customer_civilstatus']) ? $post['customer_civilstatus'] : '';
$content['customer_accounttype'] = !empty($post['customer_accounttype']) ? $post['customer_accounttype'] : '';
$content['customer_company'] = !empty($post['customer_company']) ? $post['customer_company'] : '';
$content['customer_pahouseno'] = !empty($post['customer_pahouseno']) ? $post['customer_pahouseno'] : '';
$content['customer_pabarangay'] = !empty($post['customer_pabarangay']) ? $post['customer_pabarangay'] : '';
$content['customer_pamunicipality'] = !empty($post['customer_pamunicipality']) ? $post['customer_pamunicipality'] : '';
$content['customer_paprovince'] = !empty($post['customer_paprovince']) ? $post['customer_paprovince'] : '';
$content['customer_pazipcode'] = !empty($post['customer_pazipcode']) ? $post['customer_pazipcode'] : '';
$content['customer_aahouseno'] = !empty($post['customer_aahouseno']) ? $post['customer_aahouseno'] : '';
$content['customer_aabarangay'] = !empty($post['customer_aabarangay']) ? $post['customer_aabarangay'] : '';
$content['customer_aamunicipality'] = !empty($post['customer_aamunicipality']) ? $post['customer_aamunicipality'] : '';
$content['customer_aaprovince'] = !empty($post['customer_aaprovince']) ? $post['customer_aaprovince'] : '';
$content['customer_aazipcode'] = !empty($post['customer_aazipcode']) ? $post['customer_aazipcode'] : '';
$content['customer_creditlimit'] = !empty($post['customer_creditlimit']) ? floatval($post['customer_creditlimit']) : 0;
$content['customer_criticallevel'] = !empty($post['customer_criticallevel']) ? floatval($post['customer_criticallevel']) : 0;
$content['customer_parent'] = !empty($post['customer_parent']) ? $post['customer_parent'] : 0;
$content['customer_accounttype'] = !empty($post['customer_accounttype']) ? $post['customer_accounttype'] : '';
$content['customer_type'] = $customer_type = !empty($post['customer_type']) ? $post['customer_type'] : '';
$content['customer_freezelevel'] = !empty($post['customer_freezelevel']) ? $post['customer_freezelevel'] : 0;
$content['customer_terms'] = !empty($post['customer_terms']) ? $post['customer_terms'] : '';
$content['customer_paymentpercentage'] = !empty($post['customer_paymentpercentage']) ? $post['customer_paymentpercentage'] : 100;
$content['customer_freezed'] = !empty($post['customer_freezed']) ? 1 : 0;
$content['customer_discountfundtransfer'] = !empty($post['customer_discountfundtransfer']) ? $post['customer_discountfundtransfer'] : '';

if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

  $retval['rowid'] = $post['rowid'];

  $content['customer_updatestamp'] = 'now()';

  if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$post['rowid']))) {
    json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
    die;
  }

} else {

  $content['customer_ymd'] = date('Ymd');

  if(!($result = $appdb->insert("tbl_customer",$content,"customer_id"))) {
    json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
    die;
  }

  if(!empty($result['returning'][0]['customer_id'])) {
    $retval['rowid'] = $result['returning'][0]['customer_id'];
  }

}
*/

//
