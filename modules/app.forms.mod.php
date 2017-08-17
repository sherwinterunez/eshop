<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* App Module
*
* Date: November 13, 2015
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

//$forms['app']['newpatient'] = '<h1>New Patient</h1>';
//$forms['app']['patienthistory'] = '<h1>Patient History</h1>';
//$forms['app']['schedules'] = '<h1>Schedules</h1>';
//$forms['app']['patients'] = '<h1>Patients</h1>';
//$forms['app']['newopen'] = '<h1>New Open</h1>';
//$forms['app']['newfile'] = '<h1>New File</h1>';

$forms['app']['dashboardcontrol'] = '<div id="dashboardcontrol">&nbsp;#dashboardcontrol</div>';

$forms['app']['loadmain'] = '<div id="loadmain"></div>';
$forms['app']['loaddetail'] = '<div id="loaddetail"></div>';

$forms['app']['encashmentmain'] = '<div id="encashmentmain"></div>';
$forms['app']['encashmentdetail'] = '<div id="encashmentdetail"></div>';

$forms['app']['discountmain'] = '<div id="discountmain"></div>';
$forms['app']['discountdetail'] = '<div id="discountdetail"></div>';

$forms['app']['inventorymain'] = '<div id="inventorymain"></div>';
$forms['app']['inventorydetail'] = '<div id="inventorydetail"></div>';

$forms['app']['payablesmain'] = '<div id="payablesmain"></div>';
$forms['app']['payablesdetail'] = '<div id="payablesdetail"></div>';

$forms['app']['receivablesmain'] = '<div id="receivablesmain"></div>';
$forms['app']['receivablesdetail'] = '<div id="receivablesdetail"></div>';

$forms['app']['remittancemain'] = '<div id="remittancemain"></div>';
$forms['app']['remittancedetail'] = '<div id="remittancedetail"></div>';

$forms['app']['smartmoneymain'] = '<div id="smartmoneymain"></div>';
$forms['app']['smartmoneydetail'] = '<div id="smartmoneydetail"></div>';

$forms['app']['reportsmain'] = '<div id="reportsmain"></div>';
$forms['app']['reportsdetail'] = '<div id="reportsdetail"></div>';

$forms['app']['settingmain'] = '<div id="settingmain"></div>';
$forms['app']['settingdetail'] = '<div id="settingdetail"></div>';

$forms['app']['toolsmain'] = '<div id="toolsmain"></div>';
$forms['app']['toolsdetail'] = '<div id="toolsdetail"></div>';

$forms['app']['contactmain'] = '<div id="contactmain"></div>';
$forms['app']['contactdetail'] = '<div id="contactdetail"></div>';

//$forms['app']['samplecontrol'] = '<div id="samplecontrol">&nbsp;#samplecontrol</div>';
$forms['app']['samplemain'] = '<div id="samplemain">&nbsp;#samplemain</div>';
$forms['app']['sampledetail'] = '<div id="sampledetail">&nbsp;#sampledetail</div>';
