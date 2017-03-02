<?php
/*
* 
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* App User Module
*
* Date: June 9, 2016
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

if(!class_exists('APP_app_encashment')) {

	class APP_app_encashment extends APP_Base_Ajax {
	
		var $desc = 'Encashment';

		var $pathid = 'encashment';
		var $parent = false;

		/*function __construct($mypathid,$myparent) {
			$this->pathid = $mypathid;
			$this->parent = $myparent;
			$this->init();
		}*/

		function __construct() {
			$this->init();
		}
		
		function __destruct() {
		}

		function init() {
			$this->add_rules();
		}

		function add_rules() {
			global $appaccess;

			$appaccess->rules($this->desc,'Encashment Module');

			//$appaccess->rules($this->desc,'User Account');
			/*$appaccess->rules($this->desc,'User Account New Role');
			$appaccess->rules($this->desc,'User Account Edit Role');
			$appaccess->rules($this->desc,'User Account Delete Role');
			$appaccess->rules($this->desc,'User Account New User');
			$appaccess->rules($this->desc,'User Account Edit User');
			$appaccess->rules($this->desc,'User Account Delete User');
			$appaccess->rules($this->desc,'User Account Manage All');
			$appaccess->rules($this->desc,'User Account Change Role');
			$appaccess->rules($this->desc,'User Account Change User Login');*/
		}

		function _form_encashmentmainsmartencash($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_encashmentmainsmartencash

		function _form_encashmentmainglobeencash($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_encashmentmainglobeencash

		function _form_encashmentmainvirtualencash($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_encashmentmainvirtualencash

		function _form_encashmentmainsmartpickup($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_encashmentmainsmartpickup

		function _form_encashmentmainsmarttransfast($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_encashmentmainsmarttransfast

		function _form_encashmentmaingcashdomestic($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_encashmentmaingcashdomestic

		function _form_encashmentdetailsmartencash($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='loadnew'||$this->vars['post']['method']=='loadedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'virtualremit_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'virtualremit_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO.',
					'name' => 'virtualremit_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'virtualremit_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SERVICE CHARGE',
					'name' => 'virtualremit_servicecharge',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'virtualremit_amountdue',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT NAME',
					'name' => 'virtualremit_recipientname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT MOBILE NUMBER',
					'name' => 'virtualremit_recipientmobilenumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT ADDRESS',
					'name' => 'virtualremit_address',
					'readonly' => $readonly,
					'required' => !$readonly,
					'rows' => 3,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT TERM',
					'name' => 'fundreload_paymentterm',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUND',
					'name' => 'fundreload_fund',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);



				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				*/

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'TRANSFER FEE',
					'name' => 'smartpadala_transferfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'smartpadala_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'virtualremit_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'virtualremit_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'virtualremit_customername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'virtualremit_customernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID PRESENTED',
					'name' => 'smartpadala_idpresented',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID NUMBER',
					'name' => 'smartpadala_idnumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'VALID UNTIL',
					'name' => 'smartpadala_validuntil',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NAME',
					'name' => 'smartpadala_sendername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NUMBER',
					'name' => 'smartpadala_sendernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER ADDRESS',
					'name' => 'smartpadala_senderaddress',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'label',
					'label' => 'MANUALLY COMPLETED',
					'labelWidth' => 200,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'datetime',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'DATE',
							'name' => 'smartpadala_date',
							'readonly' => $readonly,
							'required' => !$readonly,
							'value' => '',
							'labelWidth' => 40,
							'inputWidth' => 100,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 45,
						),
						array(
							'type' => 'input',
							'label' => 'TIME',
							'name' => 'smartpadala_time',
							'readonly' => $readonly,
							'required' => !$readonly,
							'value' => '',
							'labelWidth' => 40,
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO',
					'name' => 'smartpadala_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SIMCARD BALANCE',
					'name' => 'smartpadala_simcardbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RUNNING BALANCE',
					'name' => 'smartpadala_runningbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
		} // _form_encashmentdetailsmartencash

		function _form_encashmentdetailglobeencash($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='loadnew'||$this->vars['post']['method']=='loadedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'virtualremit_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'virtualremit_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REMITTANCE/REFERENCE CODE',
					'name' => 'virtualremit_referencecode',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'virtualremit_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SERVICE CHARGE',
					'name' => 'virtualremit_servicecharge',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'virtualremit_amountdue',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT NAME',
					'name' => 'virtualremit_recipientname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT MOBILE NUMBER',
					'name' => 'virtualremit_recipientmobilenumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT ADDRESS',
					'name' => 'virtualremit_address',
					'readonly' => $readonly,
					'required' => !$readonly,
					'rows' => 3,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT TERM',
					'name' => 'fundreload_paymentterm',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUND',
					'name' => 'fundreload_fund',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);



				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				*/

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'TRANSFER FEE',
					'name' => 'smartpadala_transferfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'smartpadala_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'virtualremit_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'virtualremit_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'virtualremit_customername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'virtualremit_customernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID PRESENTED',
					'name' => 'smartpadala_idpresented',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID NUMBER',
					'name' => 'smartpadala_idnumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'VALID UNTIL',
					'name' => 'smartpadala_validuntil',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NAME',
					'name' => 'smartpadala_sendername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NUMBER',
					'name' => 'smartpadala_sendernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER ADDRESS',
					'name' => 'smartpadala_senderaddress',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'label',
					'label' => 'MANUALLY COMPLETED',
					'labelWidth' => 200,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'datetime',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'DATE',
							'name' => 'smartpadala_date',
							'readonly' => $readonly,
							'required' => !$readonly,
							'value' => '',
							'labelWidth' => 40,
							'inputWidth' => 100,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 45,
						),
						array(
							'type' => 'input',
							'label' => 'TIME',
							'name' => 'smartpadala_time',
							'readonly' => $readonly,
							'required' => !$readonly,
							'value' => '',
							'labelWidth' => 40,
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO',
					'name' => 'smartpadala_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SIMCARD BALANCE',
					'name' => 'smartpadala_simcardbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RUNNING BALANCE',
					'name' => 'smartpadala_runningbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
		} // _form_encashmentdetailglobeencash

		function _form_encashmentdetailvirtualencash($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='loadnew'||$this->vars['post']['method']=='loadedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'virtualremit_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'virtualremit_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO.',
					'name' => 'virtualremit_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'virtualremit_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SERVICE CHARGE',
					'name' => 'virtualremit_servicecharge',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'virtualremit_amountdue',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT NAME',
					'name' => 'virtualremit_recipientname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT MOBILE NUMBER',
					'name' => 'virtualremit_recipientmobilenumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECIPIENT ADDRESS',
					'name' => 'virtualremit_address',
					'readonly' => $readonly,
					'required' => !$readonly,
					'rows' => 3,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'label',
					'label' => 'SENDER DETAILS',
					'labelWidth' => 200,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER LAST NAME',
					'name' => 'virtualremit_senderlastname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER FIRST NAME',
					'name' => 'virtualremit_senderfirstname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER MIDDLE NAME',
					'name' => 'virtualremit_sendermiddlename',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT TERM',
					'name' => 'fundreload_paymentterm',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUND',
					'name' => 'fundreload_fund',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);



				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				*/

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'TRANSFER FEE',
					'name' => 'smartpadala_transferfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'smartpadala_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'virtualremit_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'virtualremit_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'virtualremit_customername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'virtualremit_customernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID PRESENTED',
					'name' => 'smartpadala_idpresented',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID NUMBER',
					'name' => 'smartpadala_idnumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'VALID UNTIL',
					'name' => 'smartpadala_validuntil',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NAME',
					'name' => 'smartpadala_sendername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NUMBER',
					'name' => 'smartpadala_sendernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER ADDRESS',
					'name' => 'smartpadala_senderaddress',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'label',
					'label' => 'MANUALLY COMPLETED',
					'labelWidth' => 200,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'datetime',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'DATE',
							'name' => 'smartpadala_date',
							'readonly' => $readonly,
							'required' => !$readonly,
							'value' => '',
							'labelWidth' => 40,
							'inputWidth' => 100,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 45,
						),
						array(
							'type' => 'input',
							'label' => 'TIME',
							'name' => 'smartpadala_time',
							'readonly' => $readonly,
							'required' => !$readonly,
							'value' => '',
							'labelWidth' => 40,
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO',
					'name' => 'smartpadala_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SIMCARD BALANCE',
					'name' => 'smartpadala_simcardbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RUNNING BALANCE',
					'name' => 'smartpadala_runningbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
		} // _form_encashmentdetailvirtualencash

		function _form_encashmentdetailsmartpickup($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='loadnew'||$this->vars['post']['method']=='loadedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'virtualremit_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'virtualremit_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO.',
					'name' => 'virtualremit_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PLEASE ENTER THE ONE-TIME PIN',
					'name' => 'virtualremit_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'smartpadala_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'virtualremit_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'virtualremit_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'virtualremit_customername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'virtualremit_customernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
		} // _form_encashmentdetailsmartpickup

		function _form_encashmentdetailsmarttransfast($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='loadnew'||$this->vars['post']['method']=='loadedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'virtualremit_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'virtualremit_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO.',
					'name' => 'virtualremit_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PLEASE ENTER MOBILE NUMBER',
					'name' => 'virtualremit_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'smartpadala_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'virtualremit_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'virtualremit_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'virtualremit_customername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'virtualremit_customernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
		} // _form_encashmentdetailsmarttransfast

		function _form_encashmentdetailgcashdomestic($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='loadnew'||$this->vars['post']['method']=='loadedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'virtualremit_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'virtualremit_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REMITTANCE/REFERENCE CODE',
					'name' => 'virtualremit_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'smartpadala_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'virtualremit_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'virtualremit_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'virtualremit_customername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'virtualremit_customernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
		} // _form_encashmentdetailgcashdomestic

		function router() {
			global $applogin, $toolbars, $forms, $apptemplate;

			$retflag=false;

			header_json();

			if(!empty($this->post['routerid'])&&!empty($this->post['action'])) {

				if( $this->post['action']=='toolbar' && !empty($this->post['toolbarid']) ) {

					if(!empty($toolbar = $this->_toolbar($this->post['routerid'], $this->post['toolbarid']))) {
						$jsonval = json_encode($toolbar,JSON_OBJECT_AS_ARRAY);
						if($retflag===false) {
							die($jsonval);
						} else
						if($retflag==1) {
							return $toolbar;
						} else
						if($retflag==2) {
							return $jsonval;
						}
					}
				} else
				if( $this->post['action']=='form' && !empty($this->post['buttonid']) ) {

					if(!empty($form = $this->_form($this->post['routerid'], $this->post['buttonid']))) {

						$jsontoolbar = $this->_toolbar($this->post['routerid'], $this->post['buttonid']);

						$formid = $this->post['buttonid'];

						if(!empty($this->post['tabid'])) {
							$formid = $this->post['tabid'];
						}

						$formval = sha1($this->post['routerid'].$form.$formid);

						$sform = str_replace('%formval%',$formval,$form);

						$sform = '<div class="srt_cell_cont_tabbar">'.$sform.'</div>';

						$retval = array('html'=>$sform,'formval'=>$formval);

						$_SESSION['FORMS'][$formval] = array('since'=>time(),'formid'=>(!empty($this->post['tabid']) ? $this->post['tabid'] : $this->post['buttonid']),'routerid'=>$this->post['routerid']);

						//$prebuf = prebuf($_SESSION);

						//$retval['html'] .= '<br /><br />' . $prebuf;;

						if(!empty($jsontoolbar)) {
							$retval['toolbar'] = $jsontoolbar;
						}

						$jsonval = json_encode($retval,JSON_OBJECT_AS_ARRAY);

						if($retflag===false) {
							die($jsonval);
						} else
						if($retflag==1) {
							return $form;
						} else
						if($retflag==2) {
							return $jsonval;
						}
					} 

				} else
				if( $this->post['action']=='form' && !empty($this->post['formid']) ) {

					$form = $this->_form($this->post['routerid'], $this->post['formid']);

					$jsontoolbar = $this->_toolbar($this->post['routerid'], $this->post['formid']);

					$jsonlayout = $this->_layout($this->post['routerid'], $this->post['formid']);

					$jsonxml = $this->_xml($this->post['routerid'], $this->post['formid']);

					if(empty($form)&&empty($jsontoolbar)&&empty($jsonlayout)) return false;

					$formid = $this->post['formid'];

					if(!empty($this->post['tabid'])) {
						$formid = $this->post['tabid'];
					}

					if(!empty($form)) {
						$formval = sha1($this->post['routerid'].$form.$formid);

						$sform = str_replace('%formval%',$formval,$form);

						$sform = '<div class="srt_cell_cont_tabbar">'.$sform.'</div>';

						$retval = array('html'=>$sform,'formval'=>$formval);

						$_SESSION['FORMS'][$formval] = array('since'=>time(),'formid'=>(!empty($this->post['tabid']) ? $this->post['tabid'] : $this->post['formid']),'routerid'=>$this->post['routerid']);
					} else {
						$retval = array();
					}

					if(!empty($jsontoolbar)) {
						$retval['toolbar'] = $jsontoolbar;
					}

					if(!empty($jsonxml)) {
						$retval['xml'] = $jsonxml;
					}

					if(!empty($jsonlayout)) {

						$formval = sha1($this->post['routerid'].json_encode($jsonlayout).$formid);

						$_SESSION['FORMS'][$formval] = array('since'=>time(),'formid'=>(!empty($this->post['tabid']) ? $this->post['tabid'] : $this->post['formid']),'routerid'=>$this->post['routerid']);

						$retval['formval'] = $formval;
						$retval['layout'] = $jsonlayout;
					}

					$jsonval = json_encode($retval,JSON_OBJECT_AS_ARRAY);

					if($retflag===false) {
						die($jsonval);
					} else
					if($retflag==1) {
						return $form;
					} else
					if($retflag==2) {
						return $jsonval;
					}
				} else
				if( $this->post['action']=='formonly' && !empty($this->post['formid']) ) {

					//pre(array('post'=>$this->post));

					$form = $this->_form($this->post['routerid'], $this->post['formid']);

					$jsonxml = $this->_xml($this->post['routerid'], $this->post['formid']);

					if(!empty($this->post['formval'])) {
						$form = str_replace('%formval%',$this->post['formval'],$form);
					}

					$retval = array('html'=>$form);

					if(!empty($jsonxml)) {
						$retval['xml'] = $jsonxml;
					}

					//pre(array('$retval'=>$retval));

					$jsonval = json_encode($retval,JSON_OBJECT_AS_ARRAY);

					if($retflag===false) {
						die($jsonval);
					} else
					if($retflag==1) {
						return $form;
					} else
					if($retflag==2) {
						return $jsonval;
					}
				} else
				if( $this->post['action']=='grid' && !empty($this->post['formid']) && !empty($this->post['table']) ) {

					$retval = array();

					if($this->post['table']=='modemcommands') {
						if(!($result = $appdb->query("select * from tbl_modemcommands order by modemcommands_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['modemcommands_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['modemcommands_id'],'data'=>array(0,$v['modemcommands_id'],$v['modemcommands_name'],$v['modemcommands_desc']));
							}

							$retval = array('rows'=>$rows);
						}

					}

					$jsonval = json_encode($retval,JSON_OBJECT_AS_ARRAY);

					if($retflag===false) {
						die($jsonval);
					} else
					if($retflag==1) {
						return $form;
					} else
					if($retflag==2) {
						return $jsonval;
					}

				}
			}

			return false;
		} // router($vars=false,$retflag=false)
		
	}

	$appappencashment = new APP_app_encashment;
}

# eof modules/app.user