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

if(!class_exists('APP_app_payables')) {

	class APP_app_payables extends APP_Base_Ajax {

		var $desc = 'Payables';

		var $pathid = 'payables';
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

			$appaccess->rules($this->desc,'Payables Module');

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

		function _form_payablesmainsupplier($routerid=false,$formid=false) {
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

		} // _form_payablesmainsupplier

		function _form_payablesmainpurchaseorder($routerid=false,$formid=false) {
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

		} // _form_payablesmainpurchaseorder

		function _form_payablesmainreceivedstocks($routerid=false,$formid=false) {
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

		} // _form_payablesmainreceivedstocks

		function _form_payablesmaindisbursement($routerid=false,$formid=false) {
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

		} // _form_payablesmaindisbursement

		function _form_payablesmainvoucher($routerid=false,$formid=false) {
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

		} // _form_payablesmainvoucher

		function _form_payablesmainpayment($routerid=false,$formid=false) {
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

		} // _form_payablesmainpayment

		function _form_payablesdetailsupplier($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='payablesnew'||$this->vars['post']['method']=='payablesedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROVIDER',
					'name' => 'simcards_provider',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CATEGORY',
					'name' => 'simcards_category',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'BALANCE',
					'name' => 'simcards_balance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CRITICAL LEVEL',
					'name' => 'simcards_criticallevel',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FREEZE LEVEL',
					'name' => 'simcards_freezelevel',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PIN',
					'name' => 'simcards_pin',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'simcards_active',
					'readonly' => $readonly,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'COMPUTER NAME',
					'name' => 'simcards_computername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'IP ADDRESS',
					'name' => 'simcards_ipaddress',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'COM PORT',
					'name' => 'simcards_comport',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'LINUX PORT',
					'name' => 'simcards_linuxport',
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

		} // _form_payablesdetailsupplier

		function _form_payablesdetailpurchaseorder($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='payablesnew'||$post['method']=='payablesedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='payablesedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_purchaseorder where purchaseorder_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['purchaseorder_id'])) {
							$params['purchaseorderinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='payablessave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Purchase Order successfully saved!';


					// 11-03-2016 17:30

					/*
					if(!($result = $appdb->query("select *,(extract(epoch from '".$post['scheduler_schedule']."'::timestamptz) - extract(epoch from now())) as delaytime from tbl_scheduler where scheduler_id=".$post['rowid']))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}
					*/

					// select extract(epoch from '11-03-2016 17:30'::timestamptz);

					$content = array();
					$content['purchaseorder_ymd'] = date('Ymd');
					$content['purchaseorder_dateunix'] = !empty($post['purchaseorder_date']) ? date2timestamp($post['purchaseorder_date'],'m/d/Y H:i') : 0;
					$content['purchaseorder_supplier'] = !empty($post['purchaseorder_supplier']) ? $post['purchaseorder_supplier'] : 0;
					$content['purchaseorder_terms'] = !empty($post['purchaseorder_terms']) ? $post['purchaseorder_terms'] : '';
					$content['purchaseorder_user'] = !empty($post['purchaseorder_user']) ? $post['purchaseorder_user'] : '';
					$content['purchaseorder_status'] = !empty($post['purchaseorder_status']) ? $post['purchaseorder_status'] : '';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['purchaseorder_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_purchaseorder",$content,"purchaseorder_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_purchaseorder",$content,"purchaseorder_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['purchaseorder_id'])) {
							$retval['rowid'] = $result['returning'][0]['purchaseorder_id'];
						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='payablesdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Purchase Order successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_purchaseorder where purchaseorder_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_purchaseorder where purchaseorder_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();
				$params['tbSimCards'] = array();
				$params['tbProducts'] = array();
				$params['tbReceived'] = array();
				$params['tbHistory'] = array();

				$pono = '';

				if(!empty($params['purchaseorderinfo']['purchaseorder_id'])&&!empty($params['purchaseorderinfo']['purchaseorder_ymd'])) {
					$pono = $params['purchaseorderinfo']['purchaseorder_ymd'] . sprintf('%04d', intval($params['purchaseorderinfo']['purchaseorder_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'P.O. NO.',
					'name' => 'purchaseorder_number',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => $pono,
				);

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'DATE/TIME',
						'name' => 'purchaseorder_date',
						'readonly' => $readonly,
						'required' => !$readonly,
						'value' => !empty($params['purchaseorderinfo']['purchaseorder_dateunix']) ? pgDateUnix($params['purchaseorderinfo']['purchaseorder_dateunix']) : '',
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'calendar',
						'label' => 'DATE/TIME',
						'name' => 'purchaseorder_date',
						'enableTime' => true,
						'enableTodayButton' => true,
						'readonly' => true,
						'calendarPosition' => 'right',
						'dateFormat' => '%m-%d-%Y %H:%i',
						'validate' => "NotEmpty",
						'required' => !$readonly,
						'value' => !empty($params['purchaseorderinfo']['purchaseorder_dateunix']) ? pgDateUnix($params['purchaseorderinfo']['purchaseorder_dateunix']) : '',
					);
				}

/*
				$params['tbDetails'][] = array(
					'type' => 'calendar',
					//'label' => 'START DATE',
					'name' => 'scheduler_schedule',
					'readonly' => true,
					'required' => !$readonly,
					'enableTime' => true,
					'enableTodayButton' => true,
					'calendarPosition' => 'right',
					'dateFormat' => '%m-%d-%Y %H:%i',
					'validate' => "NotEmpty",
					//'value' => !empty($params['promosinfo']['promossent_startdate']) ? $params['promosinfo']['promossent_startdate'] : '',
				);

*/

				// getSupplierNameById

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'SUPPLIER',
						'name' => 'purchaseorder_supplier',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'value' => !empty($params['purchaseorderinfo']['purchaseorder_supplier']) ? getSupplierNameById($params['purchaseorderinfo']['purchaseorder_supplier']) : '',
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'SUPPLIER',
						'name' => 'purchaseorder_supplier',
						'readonly' => $readonly,
						'required' => !$readonly,
						//'value' => '',
						'options' => array(), //$opt,
					);
				}


				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$terms = array('TERM 1','TERM 2');

				foreach($terms as $v) {
					$selected = false;
					if(!empty($params['purchaseorderinfo']['purchaseorder_terms'])&&$params['purchaseorderinfo']['purchaseorder_terms']==$v) {
						$selected = true;
					}
					if($readonly) {
						if($selected) {
							$opt[] = array('text'=>$v,'value'=>$v,'selected'=>$selected);
						}
					} else {
						$opt[] = array('text'=>$v,'value'=>$v,'selected'=>$selected);
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'combo',
					'label' => 'TERMS',
					'name' => 'purchaseorder_terms',
					'readonly' => true,
					'inputWidth' => 200,
					'required' => !$readonly,
					'options' => $opt,
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'purchaseorder_user',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => '',
				);

				if($readonly) {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'purchaseorder_status',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString($params['purchaseorderinfo']['purchaseorder_status']),
					);

				} else {

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$allstatus = getAllStatus();

					foreach($allstatus as $k=>$v) {
						$selected = false;
						if(!empty($params['purchaseorderinfo']['purchaseorder_status'])&&$params['purchaseorderinfo']['purchaseorder_status']==$k) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$opt[] = array('text'=>$v,'value'=>$k,'selected'=>$selected);
							}
						} else {
							$opt[] = array('text'=>$v,'value'=>$k,'selected'=>$selected);
						}
					}

					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'STATUS',
						'name' => 'purchaseorder_status',
						'readonly' => true,
						'inputWidth' => 200,
						'required' => !$readonly,
						'options' => $opt,
					);

				}

				$params['tbSimCards'][] = array(
					'type' => 'container',
					'name' => 'purchaseorder_simcard',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'purchaseorder_simcard_'.$post['formval'],
				);

				$params['tbProducts'][] = array(
					'type' => 'container',
					'name' => 'purchaseorder_products',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'purchaseorder_products_'.$post['formval'],
				);

				$params['tbReceived'][] = array(
					'type' => 'container',
					'name' => 'purchaseorder_received',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'purchaseorder_received_'.$post['formval'],
				);

				$params['tbHistory'][] = array(
					'type' => 'container',
					'name' => 'purchaseorder_history',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'purchaseorder_history_'.$post['formval'],
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_payablesdetailpurchaseorder

		function _form_payablesdetailreceivedstocks($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='payablesnew'||$post['method']=='payablesedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='payablesedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_stock where stock_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['stock_id'])) {
							$params['stockinfo'] = $result['rows'][0];
						}
					}
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				$documentno = '';

				if(!empty($params['stockinfo']['stock_id'])&&!empty($params['stockinfo']['stock_ymd'])) {
					$documentno = $params['stockinfo']['stock_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['stockinfo']['stock_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DOCUMENT NO',
					'name' => 'stock_documentno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $documentno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DATE/TIME',
					'name' => 'stock_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['stockinfo']['stock_createstamp']) ? pgDate($params['stockinfo']['stock_createstamp']) : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PO NUMBER',
					'name' => 'stock_ponumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['stockinfo']['stock_ponumber']) ? $params['stockinfo']['stock_ponumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SUPPLIER',
					'name' => 'stock_supplier',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['stockinfo']['stock_supplier']) ? $params['stockinfo']['stock_supplier'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'TERMS',
					'name' => 'stock_terms',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['stockinfo']['stock_terms']) ? $params['stockinfo']['stock_terms'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'stock_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['stockinfo']['stock_user']) ? $params['stockinfo']['stock_user'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'stock_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['stockinfo']['stock_status']) ? getLoadTransactionStatusString($params['stockinfo']['stock_status']) : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'container',
					'name' => 'stock_simcards',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'stock_simcards_'.$post['formval'],
				);

				$params['tbProducts'][] = array(
					'type' => 'container',
					'name' => 'stock_products',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'stock_products_'.$post['formval'],
				);


				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_payablesdetailreceivedstocks

		function _form_payablesdetaildisbursement($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='payablesnew'||$this->vars['post']['method']=='payablesedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROVIDER',
					'name' => 'simcards_provider',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CATEGORY',
					'name' => 'simcards_category',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'BALANCE',
					'name' => 'simcards_balance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CRITICAL LEVEL',
					'name' => 'simcards_criticallevel',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FREEZE LEVEL',
					'name' => 'simcards_freezelevel',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PIN',
					'name' => 'simcards_pin',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'simcards_active',
					'readonly' => $readonly,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'COMPUTER NAME',
					'name' => 'simcards_computername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'IP ADDRESS',
					'name' => 'simcards_ipaddress',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'COM PORT',
					'name' => 'simcards_comport',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'LINUX PORT',
					'name' => 'simcards_linuxport',
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

		} // _form_payablesdetaildisbursement

		function _form_payablesdetailvoucher($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='payablesnew'||$this->vars['post']['method']=='payablesedit')) {
					$readonly = false;
				}

				$params = array();

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROVIDER',
					'name' => 'simcards_provider',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CATEGORY',
					'name' => 'simcards_category',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'BALANCE',
					'name' => 'simcards_balance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CRITICAL LEVEL',
					'name' => 'simcards_criticallevel',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FREEZE LEVEL',
					'name' => 'simcards_freezelevel',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PIN',
					'name' => 'simcards_pin',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'simcards_active',
					'readonly' => $readonly,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'COMPUTER NAME',
					'name' => 'simcards_computername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'IP ADDRESS',
					'name' => 'simcards_ipaddress',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'COM PORT',
					'name' => 'simcards_comport',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'LINUX PORT',
					'name' => 'simcards_linuxport',
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

		} // _form_payablesdetailvoucher

		function _form_payablesdetailpayment($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='payablesnew'||$post['method']=='payablesedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='payablesedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_payment where payment_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['payment_id'])) {
							$params['paymentinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='payablessave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Payment successfully saved!';

/*
sherwint_eshop=# \d tbl_payment
                                              Table "public.tbl_payment"
          Column           |           Type           |                           Modifiers
---------------------------+--------------------------+---------------------------------------------------------------
 payment_id                | bigint                   | not null default nextval(('tbl_payment_seq'::text)::regclass)
 payment_ymd               | text                     | not null default ''::text
 payment_dateunix          | integer                  | not null default 0
 payment_loadtransactionid | integer                  | not null default 0
 payment_customerid        | integer                  | not null default 0
 payment_customername      | text                     | not null default ''::text
 payment_customernumber    | text                     | not null default ''::text
 payment_totalamountdue    | numeric                  | not null default 0
 payment_totalamountpaid   | numeric                  | not null default 0
 payment_balance           | numeric                  | not null default 0
 payment_status            | integer                  | not null default 0
 payment_type              | text                     | not null default ''::text
 payment_branch            | text                     | not null default ''::text
 payment_active            | integer                  | not null default 0
 payment_deleted           | integer                  | not null default 0
 payment_flag              | integer                  | not null default 0
 payment_createstamp       | timestamp with time zone | default now()
 payment_updatestamp       | timestamp with time zone | default now()
Indexes:
    "tbl_payment_primary_key" PRIMARY KEY, btree (payment_id)

sherwint_eshop=#
*/

					$content = array();
					$content['payment_ymd'] = $payment_ymd = date('Ymd');
					//$content['payment_loadtransactionid'] = $loadtransaction_id;
					$content['payment_status'] = TRN_POSTED;
					$content['payment_customerid'] = $payment_customerid = !empty($post['payment_customer']) ? $post['payment_customer'] : 0;
					$content['payment_customername'] = !empty($content['payment_customerid']) ? getCustomerNameByID($content['payment_customerid']) : '';
					$content['payment_customernumber'] = !empty($content['payment_customerid']) ? getCustomerNumber($content['payment_customerid']) : '';
					$content['payment_totalamountdue'] = !empty($post['payment_totalamountdue']) ? floatval($post['payment_totalamountdue']) : 0;
					$content['payment_totalamountpaid'] = $payment_totalamountpaid = $totalamountpaid = !empty($post['payment_totalamountpaid']) ? floatval($post['payment_totalamountpaid']) : 0;
					$content['payment_balance'] = !empty($post['payment_balance']) ? floatval($post['payment_balance']) : 0;

					if(!empty($content['payment_totalamountpaid'])) {
					} else {
						$retval = array();
						$retval['error_code'] = 56786;
						$retval['error_message'] = 'Amount paid cannot be zero!';

						json_encode_return($retval);
						die;
					}

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						/*$retval['rowid'] = $post['rowid'];

						unset($content['payment_ymd']);

						$content['payment_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_payment",$content,"payment_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}*/

					} else {

						if(!($result = $appdb->insert("tbl_payment",$content,"payment_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['payment_id'])) {
							$retval['rowid'] = $sid = $result['returning'][0]['payment_id'];

							if(!($result=$appdb->query("select extract(epoch from payment_createstamp) as dateunix from tbl_payment where payment_id=".$sid))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['rows'][0]['dateunix'])) {

								$cupdate = array();
								$cupdate['payment_dateunix'] = intval($result['rows'][0]['dateunix']);

								if(!($appdb->update("tbl_payment",$cupdate,"payment_id=".$sid))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}
							}
						}

						if(!empty($payment_customerid)&&!empty($retval['rowid'])) {

							$customer_type = getCustomerType($payment_customerid);

							if($customer_type=='REGULAR') {
								if(!($result = $appdb->query("select a.*,b.* from tbl_ledger as a,tbl_fund as b where a.ledger_user=".$payment_customerid." and a.ledger_unpaid=1 and a.ledger_fundid=b.fund_id and b.fund_type='fundcredit' order by a.ledger_datetimeunix asc"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}
							} else
							if($customer_type=='STAFF') {

								//$sql = "select * from tbl_ledger where ledger_user=".$payment_customerid." and ledger_credit>0 and ledger_unpaid=1 and ledger_refunded=0 order by ledger_datetimeunix asc";

								//$sql = "select * from tbl_ledger where ledger_user=".$payment_customerid." and ledger_credit>=0 and ledger_unpaid=1 and ledger_refunded=0 and ledger_type not ilike '%REFUND%' and (ledger_type ilike '%DEALER%' or ledger_type ilike '%RETAIL%' or ledger_type ilike '%SMARTMONEY ENCASHMENT%' or ledger_type ilike '%SMARTMONEY PADALA%' or ledger_type ilike '%BEGINNING%' or ledger_type ilike '%ADDITIONAL%' or ledger_type ilike '%CUSTOMERRELOAD%') order by ledger_datetimeunix asc";

								//$sql = "select * from tbl_ledger where ledger_user=".$payment_customerid." and ledger_credit>=0 and ledger_unpaid=1 and ledger_refunded=0 and (ledger_type ilike '%DEALER%' or ledger_type ilike '%RETAIL%' or ledger_type ilike '%SMARTMONEY ENCASHMENT%' or ledger_type ilike '%SMARTMONEY PADALA%' or ledger_type ilike '%BEGINNING%' or ledger_type ilike '%ADDITIONAL%' or ledger_type ilike '%CUSTOMERRELOAD%') order by ledger_datetimeunix asc";

								$sql = "select * from tbl_ledger where ledger_user=".$payment_customerid." and ledger_credit>=0 and ledger_unpaid=1 and (ledger_type ilike '%DEALER%' or ledger_type ilike '%RETAIL%' or ledger_type ilike '%SMARTMONEY ENCASHMENT%' or ledger_type ilike '%SMARTMONEY PADALA%' or ledger_type ilike '%SMARTMONEY TOPUP%' or ledger_type ilike '%SMARTMONEY PAYMAYA%' or ledger_type ilike '%BEGINNING%' or ledger_type ilike '%ADDITIONAL%' or ledger_type ilike '%CUSTOMERRELOAD%' or ledger_type ilike '%REFUND%' or ledger_type ilike '%ADJUSTMENT%') order by ledger_datetimeunix asc";

								log_notice(array('$sql'=>$sql));

								if(!($result = $appdb->query($sql))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}
							}

							if(!empty($payment_totalamountpaid)&&!empty($result['rows'][0]['ledger_id'])) {

								$ledgerpaid = array();
								$paydocs = array();
								$totaldebit = $payment_totalamountpaid;

								//pre(array('$payment_totalamountpaid'=>$payment_totalamountpaid));

								foreach($result['rows'] as $k=>$v) {
									$ledger_debit = toFloat($v['ledger_debit'],2);

									if($ledger_debit>0) {
										$totaldebit = $totaldebit + $ledger_debit;
									}
								}

								log_notice(array('$payment_totalamountpaid'=>$payment_totalamountpaid,'$totaldebit'=>$totaldebit,'total'=>($payment_totalamountpaid+$totaldebit)));

								//$amountdue = 0;
								foreach($result['rows'] as $k=>$v) {
									//$amountdue = $amountdue + floatval($v['ledger_credit']);

									$ledger_debit = toFloat($v['ledger_debit'],2);
									$ledger_credit = toFloat($v['ledger_credit'],2);

									if($ledger_debit>0) {
										$paid = array();
										$paid['debit'] = true;
										$paid['unpaid'] = 0;
										$ledgerpaid[$v['ledger_id']] = $paid;
										continue;
									}

									if(!empty($v['ledger_paid'])) {
										$ledger_credit = $ledger_credit - toFloat($v['ledger_paid'],2);
									}

									//$tcompute = toFloat(($payment_totalamountpaid - $ledger_credit),2);

									$tcompute = toFloat(($totaldebit - $ledger_credit),2);

									if($tcompute>=0) {
										$paid = array();
										$paid['credit'] = toFloat($ledger_credit,2);

										if(!empty($v['ledger_paid'])) {
											$paid['ledger_paid'] = 1;
											$paid['paid'] = $paid['credit'] + toFloat($v['ledger_paid'],2);
											$paid['ipay'] = $paid['credit'];
										} else {
											$paid['paid'] = $paid['credit'];
										}

										$paid['unpaid'] = 0;
										//$paid['balance0'] = round($tcompute,2);
										$paid['balance'] = $tcompute;

										//$payment_totalamountpaid = $tcompute;
										$totaldebit = $tcompute;

										$ledgerpaid[$v['ledger_id']] = $paid;
										$paydocs[$v['ledger_id']] = $v;
									} else {
										$paid = array();
										$paid['credit'] = toFloat($ledger_credit,2);

										/*if(!empty($v['ledger_paid'])) {
											$paid['paid'] = toFloat($payment_totalamountpaid,2) + toFloat($v['ledger_paid'],2);
											$paid['ipay'] = toFloat($payment_totalamountpaid,2);
										} else {
											$paid['paid'] = toFloat($payment_totalamountpaid,2);
											//$paid['ipay'] = round(floatval($payment_totalamountpaid),2);
										}*/

										if(!empty($v['ledger_paid'])) {
											$paid['paid'] = toFloat($totaldebit,2) + toFloat($v['ledger_paid'],2);
											$paid['ipay'] = toFloat($totaldebit,2);
										} else {
											$paid['paid'] = toFloat($totaldebit,2);
											//$paid['ipay'] = round(floatval($payment_totalamountpaid),2);
										}

										$paid['unpaid'] = 1;
										//$paid['balance0'] = round($tcompute,2);
										$paid['balance'] = $tcompute;

										$ledgerpaid[$v['ledger_id']] = $paid;
										$paydocs[$v['ledger_id']] = $v;

										$totaldebit = $tcompute;

										//break;
									}

									//$rows[] = array('id'=>$v['ledger_id'],'data'=>array($v['ledger_id'],$v['ledger_receiptno'],$v['ledger_datetime'],$v['ledger_type'],$v['ledger_credit']));
								} // foreach($result['rows'] as $k=>$v) {

								//pre(array('$ledgerpaid'=>$ledgerpaid));
								//pre(array('$paydocs'=>$paydocs));

								if(!empty($ledgerpaid)) {

									$paymentdocument_balance = 0;

									foreach($ledgerpaid as $k=>$v) {

										log_notice(array('$ledgerpaid['.$k.']'=>$v));

										if(!empty($v['debit'])) {
											$cupdate = array();
											$cupdate['ledger_unpaid'] = $v['unpaid'];

											if(!($result = $appdb->update("tbl_ledger",$cupdate,"ledger_id=".$k))) {
												json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
												die;
											}
										} else
										if($v['paid']>0) {
											$cupdate = array();
											$cupdate['ledger_paid'] = $v['paid'];
											$cupdate['ledger_unpaid'] = $v['unpaid'];

											if(!($result = $appdb->update("tbl_ledger",$cupdate,"ledger_id=".$k))) {
												json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
												die;
											}

											if(!empty($paydocs[$k]['ledger_paid'])) {
												//$paymentdocument_amountdue = round(floatval($paydocs[$k]['ledger_credit']) - floatval($paydocs[$k]['ledger_paid']),2);
												$paymentdocument_amountdue = toFloat($paydocs[$k]['ledger_credit'],2);
												$paymentdocument_amountpaid = $paydocs[$k]['ledger_paid'];
											} else {
												$paymentdocument_amountdue = toFloat($paydocs[$k]['ledger_credit'],2);
												$paymentdocument_amountpaid = 0; //$v['paid'];
											}

											$content = array();
											$content['paymentdocument_paymentid'] = $retval['rowid'];
											$content['paymentdocument_ledgerid'] = $paydocs[$k]['ledger_id'];
											$content['paymentdocument_desc'] = $paydocs[$k]['ledger_type'];
											$content['paymentdocument_datetime'] = $paydocs[$k]['ledger_datetime'];
											$content['paymentdocument_datetimeunix'] = $paydocs[$k]['ledger_datetimeunix'];
											$content['paymentdocument_receiptno'] = $paydocs[$k]['ledger_receiptno'];
											//$content['paymentdocument_staffid'] = $paydocs[$k]['ledger_receiptno'];
											$content['paymentdocument_amountdue'] = $paymentdocument_amountdue;
											$content['paymentdocument_amountpaid'] = $paymentdocument_amountpaid;
											$content['paymentdocument_balance'] = $paymentdocument_balance = round(floatval($content['paymentdocument_amountdue']),2) - round(floatval($content['paymentdocument_amountpaid']),2);

											if(!($result = $appdb->insert("tbl_paymentdocument",$content,"paymentdocument_id"))) {
												json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
												die;
											}

											$paymentdocument_datetimeunix = intval(getDbUnixDate());

											$content = array();
											$content['paymentdocument_paymentid'] = $retval['rowid'];
											$content['paymentdocument_ledgerid'] = $paydocs[$k]['ledger_id'];
											$content['paymentdocument_desc'] = 'PAYMENT';
											$content['paymentdocument_datetime'] = pgDateUnix($paymentdocument_datetimeunix);
											$content['paymentdocument_datetimeunix'] = $paymentdocument_datetimeunix;
											$content['paymentdocument_receiptno'] = $paydocs[$k]['ledger_receiptno'];
											//$content['paymentdocument_staffid'] = $paydocs[$k]['ledger_receiptno'];
											//$content['paymentdocument_amountdue'] = $paydocs[$k]['ledger_credit'];

											if(!empty($paydocs[$k]['ledger_paid'])) {
												if(!empty($ledgerpaid[$k]['ipay'])) {
													$content['paymentdocument_amountpaid'] = $ledgerpaid[$k]['ipay']; //$paymentdocument_balance; //
												} else {
													$content['paymentdocument_amountpaid'] = $ledgerpaid[$k]['paid']; //$paymentdocument_balance; //
												}
												$content['paymentdocument_balance'] = $paymentdocument_balance = round(floatval($paymentdocument_balance),2) - round(floatval($content['paymentdocument_amountpaid']),2);
											} else {
												$content['paymentdocument_amountpaid'] = $ledgerpaid[$k]['paid'];
												$content['paymentdocument_balance'] = $paymentdocument_balance = round(floatval($paymentdocument_balance),2) - round(floatval($ledgerpaid[$k]['paid']),2);
											}


											if(!($result = $appdb->insert("tbl_paymentdocument",$content,"paymentdocument_id"))) {
												json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
												die;
											}

										} else {

											$paymentdocument_amountdue = toFloat($paydocs[$k]['ledger_credit'],2);
											$paymentdocument_amountpaid = 0; //$v['paid'];
											$paymentdocument_balance = toFloat($paymentdocument_balance + $paymentdocument_amountdue,2);

											$content = array();
											$content['paymentdocument_paymentid'] = $retval['rowid'];
											$content['paymentdocument_ledgerid'] = $paydocs[$k]['ledger_id'];
											$content['paymentdocument_desc'] = $paydocs[$k]['ledger_type'];
											$content['paymentdocument_datetime'] = $paydocs[$k]['ledger_datetime'];
											$content['paymentdocument_datetimeunix'] = $paydocs[$k]['ledger_datetimeunix'];
											$content['paymentdocument_receiptno'] = $paydocs[$k]['ledger_receiptno'];
											//$content['paymentdocument_staffid'] = $paydocs[$k]['ledger_receiptno'];
											$content['paymentdocument_amountdue'] = $paymentdocument_amountdue;
											$content['paymentdocument_amountpaid'] = $paymentdocument_amountpaid;
											$content['paymentdocument_balance'] = $paymentdocument_balance;

											if(!($result = $appdb->insert("tbl_paymentdocument",$content,"paymentdocument_id"))) {
												json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
												die;
											}

										} // if($v['paid']>0) {

									} // foreach($ledgerpaid as $k=>$v) {

//////////////

									if($customer_type=='REGULAR') {

										$fund_datetimeunix = intval(getDbUnixDate());

										$content = array();
										$content['fund_ymd'] = $fund_ymd = date('Ymd');
										$content['fund_type'] = 'payment';
										$content['fund_payment'] = toFloat($totalamountpaid,2);
										//$content['fund_amount'] = !empty($fund_amount) ? $fund_amount : 0;
										//$content['fund_amountdue'] = !empty($fund_amountdue) ? $fund_amountdue : 0;
										//$content['fund_discount'] = !empty($fund_discount) ? $fund_discount : 0;
										//$content['fund_discountamount'] = !empty($fund_discountamount) ? $fund_discountamount : 0;
										//$content['fund_processingfee'] = !empty($fund_processingfee) ? $fund_processingfee : 0;
										$content['fund_datetimeunix'] = !empty($fund_datetimeunix) ? $fund_datetimeunix : time();
										$content['fund_datetime'] = pgDateUnix($content['fund_datetimeunix']);

										//$content['fund_userid'] = $applogin->getStaffID();
										//$content['fund_username'] = !empty($content['fund_userid']) ? getCustomerNameByID($content['fund_userid']) : '';
										//$content['fund_usernumber'] = !empty($content['fund_userid']) ? getCustomerNumber($content['fund_userid']) : '';

										$content['fund_userid'] = $payment_customerid;
										$content['fund_username'] = !empty($content['fund_userid']) ? getCustomerNameByID($content['fund_userid']) : '';
										$content['fund_usernumber'] = !empty($content['fund_userid']) ? getCustomerNumber($content['fund_userid']) : '';

										//$content['fund_userpaymentterm'] = !empty($post['fund_userpaymentterm']) ? $post['fund_userpaymentterm'] : '';
										$content['fund_recepientid'] = $payment_customerid;
										$content['fund_recepientname'] = getCustomerNameByID($payment_customerid);
										$content['fund_recepientnumber'] = getCustomerNumber($payment_customerid);
										//$content['fund_recepientpaymentterm'] = !empty($post['fund_recepientpaymentterm']) ? $post['fund_recepientpaymentterm'] : '';
										$content['fund_status'] = 1;

										if(!($result = $appdb->insert("tbl_fund",$content,"fund_id"))) {
											json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
											die;
										}

										computeCustomerAvailableCredit($payment_customerid);

									} else
									if($customer_type=='STAFF') {

										$ledger_datetimeunix = intval(getDbUnixDate());

										$receiptno = $payment_ymd . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', $retval['rowid']);

										$content = array();
										$content['ledger_paymentid'] = $retval['rowid'];
										$content['ledger_debit'] = toFloat($totalamountpaid,2);;
										$content['ledger_type'] = 'PAYMENT';
										$content['ledger_datetimeunix'] = $ledger_datetimeunix;
										$content['ledger_datetime'] = pgDateUnix($ledger_datetimeunix);
										$content['ledger_user'] = $payment_customerid;
										$content['ledger_seq'] = '0';
										$content['ledger_receiptno'] = $receiptno;

										if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
											json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
											die;
										}

										computeStaffBalance($payment_customerid);

									}

//////////////
								} // if(!empty($ledgerpaid)) {

							}


						}

					}

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				$receiptno = '';

				if(!empty($params['paymentinfo']['payment_id'])&&!empty($params['paymentinfo']['payment_ymd'])) {
					$receiptno = $params['paymentinfo']['payment_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['paymentinfo']['payment_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'payment_receiptno',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'payment_datetime',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['paymentinfo']['payment_createstamp']) ? pgDate($params['paymentinfo']['payment_createstamp']) : '',
				);

				if($readonly) {

					$customername = '';

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'CUSTOMER NAME',
						'name' => 'payment_customer',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['paymentinfo']['payment_customerid']) ? getCustomerNameByID($params['paymentinfo']['payment_customerid']) : '',
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'CUSTOMER NAME',
						'name' => 'payment_customer',
						'readonly' => $readonly,
						//'readonly' => true,
						//'comboType' => 'checkbox',
						'required' => !$readonly,
						//'value' => !empty($params['customerinfo']['customer_parent']) ? $params['customerinfo']['customer_parent'] : '',
						'options' => array(), //$opt,
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'payment_status',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['paymentinfo']['payment_status']) ? getLoadTransactionStatusString($params['paymentinfo']['payment_status']) : 'DRAFT',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'payment_totalamountdue',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','digits'=>2,'autoUnmask'=>true),
					'value' => !empty($params['paymentinfo']['payment_totalamountdue']) ? $params['paymentinfo']['payment_totalamountdue'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT PAID',
					'name' => 'payment_totalamountpaid',
					'validate' => 'NotEmpty',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','digits'=>2,'autoUnmask'=>true),
					'value' => !empty($params['paymentinfo']['payment_totalamountpaid']) ? $params['paymentinfo']['payment_totalamountpaid'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'BALANCE',
					'name' => 'payment_balance',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','digits'=>2,'autoUnmask'=>true),
					'value' => !empty($params['paymentinfo']['payment_balance']) ? $params['paymentinfo']['payment_balance'] : '',
				);

				$params['tbDocuments'][] = array(
					'type' => 'container',
					'name' => 'payment_documents',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'payment_documents_'.$post['formval'],
				);

				$params['tbDissection'][] = array(
					'type' => 'container',
					'name' => 'payment_dissection',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'payment_dissection_'.$post['formval'],
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_payablesdetailpayment

		function router() {
			global $appdb, $applogin, $toolbars, $forms, $apptemplate;

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

					$toolbar = false;

					if(!empty($this->post['wid'])) {
						if(!empty($toolbar = $this->_toolbar($this->post['routerid'], $this->post['module']))) {
						}
					}

					$form = $this->_form($this->post['routerid'], $this->post['formid']);

					$jsonxml = $this->_xml($this->post['routerid'], $this->post['formid']);

					if(!empty($this->post['formval'])) {
						$form = str_replace('%formval%',$this->post['formval'],$form);
					}

					$retval = array('html'=>$form);

					if(!empty($toolbar)) {
						$retval['toolbar'] = $toolbar;
					}

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

					} else
					if($this->post['table']=='receivedstocks') {
						if(!($result = $appdb->query("select * from tbl_stock order by stock_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['stock_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$stockid = $v['stock_ymd'] . sprintf('%04d', $v['stock_id']);

								$rows[] = array('id'=>$v['stock_id'],'data'=>array(0,$v['stock_id'],pgDateUnix($v['stock_dateunix']),$stockid,$v['stock_supplier'],getLoadTransactionStatusString($v['stock_status'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='payment') {
						if(!($result = $appdb->query("select * from tbl_payment order by payment_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['payment_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$paymentid = $v['payment_ymd'] . sprintf('%04d', $v['payment_id']);

								$rows[] = array('id'=>$v['payment_id'],'data'=>array(0,$v['payment_id'],pgDateUnix($v['payment_dateunix']),$paymentid,$v['payment_customername'],number_format($v['payment_totalamountdue'],2),number_format($v['payment_totalamountpaid'],2),number_format($v['payment_balance'],2),getLoadTransactionStatusString($v['payment_status'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='purchaseorder') {
						if(!($result = $appdb->query("select * from tbl_purchaseorder order by purchaseorder_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['purchaseorder_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$purchaseid = $v['purchaseorder_ymd'] . sprintf('%04d', $v['purchaseorder_id']);

								$sup = getSupplierById($v['purchaseorder_supplier']);

								$supplier = '';

								if(!empty($sup['supplier_firstname'])) {
									$supplier .= $sup['supplier_firstname'] . ' ';
								}

								if(!empty($sup['supplier_lastname'])) {
									$supplier .= $sup['supplier_lastname'] . ' ';
								}

								$supplier = trim($supplier);

								$rows[] = array('id'=>$v['purchaseorder_id'],'data'=>array(0,$v['purchaseorder_id'],pgDateUnix($v['purchaseorder_dateunix']),$purchaseid,getSupplierNameById($v['purchaseorder_supplier']),getLoadTransactionStatusString($v['purchaseorder_status'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='simcard') {
						if(!($result = $appdb->query("select * from tbl_stocksimcard where stocksimcard_id=".$this->post['rowid']." order by stocksimcard_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['stocksimcard_id'])) {
							$rows = array();

							$sims = getAllSims(3,true);

							//$rows['sims'] = $sims;

							foreach($result['rows'] as $k=>$v) {

								//$stockid = $v['stock_ymd'] . sprintf('%04d', $v['stocksimcard_id']);

								$simid = '';
								$simname = '';

								if(!empty($v['stocksimcard_simnumber'])) {
									$simid = !empty($sims[$v['stocksimcard_simnumber']]['simcard_id']) ? $sims[$v['stocksimcard_simnumber']]['simcard_id'] : '';
									$simname = !empty($sims[$v['stocksimcard_simnumber']]['simcard_name']) ? $sims[$v['stocksimcard_simnumber']]['simcard_name'] : '';
								}

								$rows[] = array('id'=>$v['stocksimcard_id'],'data'=>array($simid,$simname,$v['stocksimcard_quantity'],$v['stocksimcard_discount'],$v['stocksimcard_amountdue']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='purchaseordersimcard') {
						if(!($result = $appdb->query("select * from tbl_purchaseordersimcard where purchaseordersimcard_purchaseorderid=".$this->post['rowid']." order by purchaseordersimcard_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						$asims = getAllSims(9,true);

						$simnames = array(array('text'=>'','value'=>''));

						foreach($asims as $k=>$v) {
							$simnames[] = array('text'=>$v,'value'=>$v);
						}


						$ctr=1;

						$rows = array();

						if(!empty($result['rows'][0]['purchaseordersimcard_id'])) {
							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$ctr,'simnames'=>array('options'=>$simnames),'data'=>array($ctr,$v['purchaseordersimcard_simcardname'],$v['purchaseordersimcard_simcardnumber'],$v['purchaseordersimcard_quantity'],$v['purchaseordersimcard_received'],$v['purchaseordersimcard_discount'],$v['purchaseordersimcard_amountdue'],$v['purchaseordersimcard_status']));
								$ctr++;
							}
						}

						while($ctr<=10) {
							$rows[] = array('id'=>$ctr,'simnames'=>array('options'=>$simnames),'data'=>array($ctr,'','','','','','',''));
							$ctr++;
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='document') {

						$customer_type = getCustomerType($this->post['rowid']);

						if($customer_type=='REGULAR') {

							$sql = "select a.*,b.* from tbl_ledger as a,tbl_fund as b where a.ledger_user=".$this->post['rowid']." and a.ledger_unpaid=1 and a.ledger_fundid=b.fund_id and b.fund_type='fundcredit' order by a.ledger_datetimeunix asc";

							if(!($result = $appdb->query($sql))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						} else
						if($customer_type=='STAFF') {

							//$sql ="select * from tbl_ledger where ledger_user=".$this->post['rowid']." and ledger_credit>0 and ledger_unpaid=1 and ledger_refunded=0 order by ledger_datetimeunix asc";

							//$sql ="select * from tbl_ledger where ledger_user=".$this->post['rowid']." and ledger_credit>=0 and ledger_unpaid=1 and ledger_refunded=0 and ledger_type not ilike '%REFUND%' and (ledger_type ilike '%DEALER%' or ledger_type ilike '%RETAIL%' or ledger_type ilike '%SMARTMONEY ENCASHMENT%' or ledger_type ilike '%SMARTMONEY PADALA%' or ledger_type ilike '%BEGINNING%' or ledger_type ilike '%ADDITIONAL%' or ledger_type ilike '%CUSTOMERRELOAD%') order by ledger_datetimeunix asc";

							$sql ="select * from tbl_ledger where ledger_user=".$this->post['rowid']." and ledger_credit>=0 and ledger_unpaid=1 and (ledger_type ilike '%DEALER%' or ledger_type ilike '%RETAIL%' or ledger_type ilike '%SMARTMONEY ENCASHMENT%' or ledger_type ilike '%SMARTMONEY PADALA%' or ledger_type ilike '%SMARTMONEY TOPUP%' or ledger_type ilike '%SMARTMONEY PAYMAYA%' or ledger_type ilike '%BEGINNING%' or ledger_type ilike '%ADDITIONAL%' or ledger_type ilike '%CUSTOMERRELOAD%' or ledger_type ilike '%REFUND%' or ledger_type ilike '%ADJUSTMENT%') order by ledger_datetimeunix asc";

							if(!($result = $appdb->query($sql))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}

						$rows = array();

						//pre(array('$result'=>$result));

						$amountdue = 0;
						$ledger_credit = 0;
						$total_debit = 0;

						if(!empty($result['rows'][0]['ledger_id'])) {
							foreach($result['rows'] as $k=>$v) {
								$ledger_credit = floatval($v['ledger_credit']);
								$ledger_debit = 0;

								if(!empty($v['ledger_paid'])) {
									$ledger_credit = $ledger_credit - floatval($v['ledger_paid']);
								}

								$amountdue = $amountdue + $ledger_credit;

								if(!empty($v['ledger_debit'])) {
									$ledger_debit = floatval($v['ledger_debit']);
									$total_debit = $total_debit + $ledger_debit;

									$amountdue = $amountdue - $ledger_debit;

									$ledger_credit = $ledger_debit * -1;
								}

								$rows[] = array('id'=>$v['ledger_id'],'data'=>array($v['ledger_id'],$v['ledger_receiptno'],$v['ledger_datetime'],$v['ledger_type'],$ledger_credit,$amountdue));
							}
						}

						$retval = array('rows'=>$rows,'amountdue'=>$amountdue,'debit'=>$ledger_debit,'sql'=>$sql);
					} else
					if($this->post['table']=='documentgrid') {

						if(!($result = $appdb->query("select * from tbl_paymentdocument where paymentdocument_paymentid=".$this->post['rowid']." order by paymentdocument_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$rows = array();

						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['paymentdocument_id'])) {
							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['paymentdocument_id'],'data'=>array($v['paymentdocument_id'],$v['paymentdocument_receiptno'],$v['paymentdocument_datetime'],$v['paymentdocument_desc'],$v['paymentdocument_amountdue'],$v['paymentdocument_amountpaid'],$v['paymentdocument_balance']));
							}
						}

						$retval = array('rows'=>$rows);

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

				}			}

			return false;
		} // router($vars=false,$retflag=false)

	}

	$appapppayables = new APP_app_payables;
}

# eof modules/app.user
