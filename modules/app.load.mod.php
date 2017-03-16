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

if(!class_exists('APP_app_load')) {

	class APP_app_load extends APP_Base_Ajax {

		var $desc = 'Load';

		var $pathid = 'load';
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

			$appaccess->rules($this->desc,'Load Module');
			$appaccess->rules($this->desc,'Load Module New');
			$appaccess->rules($this->desc,'Load Module Edit');
			$appaccess->rules($this->desc,'Load Module Delete');

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

		function _form_loadmainretail($routerid=false,$formid=false) {
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

		} // _form_loadmainretail

		function _form_loadmaindealer($routerid=false,$formid=false) {
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

		} // _form_loadmaindealer

		function _form_loadmainfundreload($routerid=false,$formid=false) {
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

		} // _form_loadmainfundreload

		function _form_loadmainchildreload($routerid=false,$formid=false) {
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

		} // _form_loadmainchildreload

		function _form_loadmaincustomerreload($routerid=false,$formid=false) {
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

		} // _form_loadmaincustomerreload

		function _form_loadmainfundtransfer($routerid=false,$formid=false) {
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

		} // _form_loadmainfundtransfer

		function _form_loadmainloadexpense($routerid=false,$formid=false) {
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

		} // _form_loadmainloadexpense

		function _form_loaddetailretail($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='loadnew'||$post['method']=='loadedit'||$post['method']=='loadmanually')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='loadedit'||$post['method']=='loadapproved'||$post['method']=='loadmanually'||$post['method']=='loadcancelled'||$post['method']=='loadhold'||$post['method']=='loadsave'||$post['method']=='loadtransfer')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['loadtransaction_id'])) {
							$params['retailinfo'] = $result['rows'][0];
						}
					}
				}

				if(!empty($post['method'])&&$post['method']=='loadsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Retail successfully saved!';

					$content = array();
					$content['loadtransaction_status'] = $loadtransaction_status = !empty($post['retail_status']) ? $post['retail_status'] : 0;

					if(!empty($post['retail_newassignedsimcard'])&&!empty($post['retail_assignedsimcard'])&&$post['retail_newassignedsimcard']!=$post['retail_assignedsimcard']) {

						if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
							if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_id=".$post['rowid']))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['rows'][0]['loadtransaction_id'])) {
								if(intval($result['rows'][0]['loadtransaction_status'])!=intval($post['retail_oldstatus'])) {
									$retval = array();
									$retval['error_code'] = '1567';
									$retval['error_message'] = 'Load Retail Status has Already Changed. Cannot Move Right Now!';
									json_encode_return($retval);
									die;
								}
							}
						}

						$content['loadtransaction_assignedsim'] = $post['retail_newassignedsimcard'];
					}

					if(!empty($content['loadtransaction_status'])&&$content['loadtransaction_status']==TRN_COMPLETED_MANUALLY) {

						$content['loadtransaction_manualdate'] = !empty($post['retail_manualdate']) ? $post['retail_manualdate'] : '';
						$content['loadtransaction_manualtime'] = !empty($post['retail_manualtime']) ? $post['retail_manualtime'] : '';
						$content['loadtransaction_refnumber'] = $params['retailinfo']['loadtransaction_refnumber'] = !empty($post['retail_referenceno']) ? $post['retail_referenceno'] : '';
						$content['loadtransaction_simcardbalance'] = $loadtransaction_simcardbalance = !empty($post['retail_simcardbalance']) ? $post['retail_simcardbalance'] : 0;
						$content['loadtransaction_runningbalance'] = $loadtransaction_runningbalance = !empty($post['retail_runningbalance']) ? $post['retail_runningbalance'] : 0;
						$content['loadtransaction_amount'] = !empty($post['loadtransaction_amountdue']) ? $post['loadtransaction_amountdue'] : 0;

						pre(array('$content'=>$content));
					}

					// retail_manualdate
					// retail_manualtime
					// retail_referenceno
					// retail_runningbalance
					// retail_simcardbalance

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['loadtransaction_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} /*else {

						if(!($result = $appdb->insert("tbl_simcard",$content,"simcard_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['simcard_id'])) {
							$retval['rowid'] = $result['returning'][0]['simcard_id'];
						}

					}*/

					if(!empty($retval['rowid'])&&$loadtransaction_status==TRN_CANCELLED) {

						$general_notificationforloadretailcancelled = getOption('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILCANCELLED',false);

						$itemData = getItemData($params['retailinfo']['loadtransaction_item'],$params['retailinfo']['loadtransaction_provider']);

						/*if(!empty($general_notificationforloadretailcancelled)) {
							$noti = explode(',', $general_notificationforloadretailcancelled);

							foreach($noti as $v) {
								$msg = getNotificationByID($v);
								$msg = str_replace('%TEXTCODE%',$params['retailinfo']['loadtransaction_item'],$msg);
								//$msg = str_replace('%ITEMQUANTITY%',$itemData['item_quantity'],$msg);
								$msg = str_replace('%ITEMQUANTITY%',$params['retailinfo']['loadtransaction_load'],$msg);
								$msg = str_replace('%CUSTMOBILENO%',$params['retailinfo']['loadtransaction_recipientnumber'],$msg);

								sendToGateway($params['retailinfo']['loadtransaction_customernumber'],$params['retailinfo']['loadtransaction_assignedsim'],$msg);
							}
						}*/

						$customer_type = getCustomerType($params['retailinfo']['loadtransaction_customerid']);

						$receiptno = '';

						if(!empty($params['retailinfo']['loadtransaction_id'])&&!empty($params['retailinfo']['loadtransaction_ymd'])) {
							$receiptno = $params['retailinfo']['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['retailinfo']['loadtransaction_id']));
						}

						$content = array();
						$content['ledger_loadtransactionid'] = $loadtransaction_id = $params['retailinfo']['loadtransaction_id'];

						/*if($customer_type=='STAFF') {
							//$content['ledger_debit'] = $itemData['item_srp'];
							$content['ledger_debit'] = $params['retailinfo']['loadtransaction_cost'];
						} else {
							//$content['ledger_credit'] = $itemData['item_eshopsrp'];
							$content['ledger_credit'] = $params['retailinfo']['loadtransaction_amountdue'];
						}*/

						if($customer_type=='STAFF') {
							//$content['ledger_debit'] = $itemData['item_srp'];
							$staffLedger = getStaffLedgerLoadtransactionId($loadtransaction_id);

							$content['ledger_debit'] = $staffLedger['ledger_credit'];
							$ledgerRefundId = $staffLedger['ledger_id'];
						} else {
							//$content['ledger_credit'] = $itemData['item_eshopsrp'];
							$customerLedger = getCustomerLedgerLoadtransactionId($loadtransaction_id);

							$content['ledger_credit'] = $customerLedger['ledger_debit'];
							$ledgerRefundId = $customerLedger['ledger_id'];
						}

						$ledger_datetimeunix = intval(getDbUnixDate());

						$content['ledger_type'] = 'REFUND '.$params['retailinfo']['loadtransaction_item'];
						$content['ledger_datetime'] = pgDateUnix($ledger_datetimeunix);
						$content['ledger_datetimeunix'] = $ledger_datetimeunix;
						$content['ledger_user'] = $params['retailinfo']['loadtransaction_customerid'];
						$content['ledger_seq'] = '0';
						$content['ledger_receiptno'] = $receiptno;

						//$content['ledger_datetimeunix'] = date2timestamp($content['ledger_datetime'], getOption('$DISPLAY_DATE_FORMAT','r'));

						if(!empty(($rebate = getRebateByLoadTransactionId($loadtransaction_id)))) {

							//print_r(array('$rebate'=>$rebate));

							if(!empty($rebate['rebate_credit'])) {

								$rcontent = $rebate;

								$rebate_credit = floatval($rcontent['rebate_credit']);

								unset($rcontent['rebate_credit']);
								unset($rcontent['rebate_id']);
								unset($rcontent['rebate_balance']);
								unset($rcontent['rebate_createstamp']);
								unset($rcontent['rebate_updatestamp']);

								$rcontent['rebate_debit'] = number_format($rebate_credit,3);

								//$rebate_balance = getRebateBalance($rebate['rebate_customerid']) - $rebate_credit;

								//$rcontent['rebate_balance'] = number_format($rebate_balance,3);

								if(!($result = $appdb->insert("tbl_rebate",$rcontent,"rebate_id"))) {
									return false;
								}

								//$ccontent = array();
								//$ccontent['customer_totalrebate'] = $rcontent['rebate_balance'];

								//if(!($result = $appdb->update("tbl_customer",$ccontent,"customer_id=".$rebate['rebate_customerid']))) {
								//	return false;
								//}

								computeCustomerRebateBalance($rebate['rebate_customerid']);

								$content['ledger_rebate'] = (0 - floatval($rcontent['rebate_debit']));
								//$content['ledger_rebatebalance'] = $rcontent['rebate_balance'];

							}
						}

						if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($ledgerRefundId)) {
							$content = array();
							$content['ledger_refunded'] = 1;

							if(!($result = $appdb->update("tbl_ledger",$content,"ledger_id=".$ledgerRefundId))) {
								return false;
							}
						}

						if($customer_type=='STAFF') {
							computeStaffBalance($params['retailinfo']['loadtransaction_customerid']);
							$balance = getStaffBalance($params['retailinfo']['loadtransaction_customerid']);
						} else {
							computeCustomerBalance($params['retailinfo']['loadtransaction_customerid']);
							computeChildRebateBalance($params['retailinfo']['loadtransaction_customerid']);
							$balance = getCustomerBalance($params['retailinfo']['loadtransaction_customerid']);
						}

						if(!empty($general_notificationforloadretailcancelled)) {
							$noti = explode(',', $general_notificationforloadretailcancelled);

							foreach($noti as $v) {
								$msg = getNotificationByID($v);
								$msg = str_replace('%TEXTCODE%',$params['retailinfo']['loadtransaction_item'],$msg);
								//$msg = str_replace('%ITEMQUANTITY%',$itemData['item_quantity'],$msg);
								$msg = str_replace('%ITEMQUANTITY%',$params['retailinfo']['loadtransaction_load'],$msg);
								$msg = str_replace('%CUSTMOBILENO%',$params['retailinfo']['loadtransaction_recipientnumber'],$msg);
								$msg = str_replace('%balance%',number_format($balance,2),$msg);

								sendToGateway($params['retailinfo']['loadtransaction_customernumber'],$params['retailinfo']['loadtransaction_assignedsim'],$msg);
							}
						}

					} else
					if(!empty($retval['rowid'])&&$loadtransaction_status==TRN_COMPLETED_MANUALLY) {

						$general_notificationforloadretailmanuallycompleted = getOption('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILMANUALLYCOMPLETED',false);

						$customer_type = getCustomerType($params['retailinfo']['loadtransaction_customerid']);

						if(!empty($general_notificationforloadretailmanuallycompleted)) {

							$noti = explode(',', $general_notificationforloadretailmanuallycompleted);

							// Your request to load %TEXTCODE% %ITEMQUANTITY% for %CUSTMOBILENO% has been completed: Ref:%LRTXNREF% <LRDATETIME> Balance:P%VBALANCE% Tx: %LRRECEIPTNO%

							if($customer_type=='STAFF') {
								$balance = getStaffBalance($params['retailinfo']['loadtransaction_customerid']);
							} else {
								$balance = getCustomerBalance($params['retailinfo']['loadtransaction_customerid']);
							}

							$receiptno = '';

							if(!empty($params['retailinfo']['loadtransaction_id'])&&!empty($params['retailinfo']['loadtransaction_ymd'])) {
								$receiptno = $params['retailinfo']['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['retailinfo']['loadtransaction_id']));
							}

							$ledgerBalance = getCustomerBalanceFromLedgerLoadtransactionId($params['retailinfo']['loadtransaction_id']);

							$balance = !empty($ledgerBalance) ? $ledgerBalance : $balance;

							foreach($noti as $v) {
								$msg = getNotificationByID($v);
								$msg = str_replace('%TEXTCODE%',$params['retailinfo']['loadtransaction_item'],$msg);
								//$msg = str_replace('%ITEMQUANTITY%',$itemData['item_quantity'],$msg);
								$msg = str_replace('%ITEMQUANTITY%',$params['retailinfo']['loadtransaction_load'],$msg);
								$msg = str_replace('%CUSTMOBILENO%',$params['retailinfo']['loadtransaction_recipientnumber'],$msg);
								$msg = str_replace('%LRTXNREF%',$params['retailinfo']['loadtransaction_refnumber'],$msg);
								$msg = str_replace('%LRDATETIME%',pgDate($params['retailinfo']['loadtransaction_updatestamp']),$msg);
								$msg = str_replace('%VBALANCE%',number_format($balance,2),$msg);
								$msg = str_replace('%LRRECEIPTNO%',$receiptno,$msg);

								sendToGateway($params['retailinfo']['loadtransaction_customernumber'],$params['retailinfo']['loadtransaction_assignedsim'],$msg);
							}

						}

						/*$msg = smsdt(). ' '.getNotification('$SUCCESSFULLY_LOADED');

						$msg = str_replace('%simcard%',$params['retailinfo']['loadtransaction_assignedsim'],$msg);
						$msg = str_replace('%productcode%',$params['retailinfo']['loadtransaction_product'],$msg);
						$msg = str_replace('%recipientnumber%',$params['retailinfo']['loadtransaction_recipientnumber'],$msg);
						$msg = str_replace('%ref%',$params['retailinfo']['loadtransaction_refnumber'],$msg);

						if($customer_type=='STAFF') {
							$msg = str_replace('%balance%',getStaffBalance($params['retailinfo']['loadtransaction_customerid']),$msg);
						} else {
							$msg = str_replace('%balance%',getCustomerBalance($params['retailinfo']['loadtransaction_customerid']),$msg);
						}

						sendToGateway($params['retailinfo']['loadtransaction_customernumber'],$params['retailinfo']['loadtransaction_assignedsim'],$msg);*/

					}

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$receiptno = '';

				if(!empty($params['retailinfo']['loadtransaction_id'])&&!empty($params['retailinfo']['loadtransaction_ymd'])) {
					$receiptno = $params['retailinfo']['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['retailinfo']['loadtransaction_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'retail_receiptno',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'retail_date',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => pgDate($params['retailinfo']['loadtransaction_createstamp']),
				);

				$providers = getProviders();

				$opt = array();

				foreach($providers as $v) {
					$selected = false;

					if(!empty($params['retailinfo']['loadtransaction_provider'])&&$params['retailinfo']['loadtransaction_provider']==$v) {
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
					'type' => 'combo',
					'label' => 'PROVIDER',
					'name' => 'retail_provider',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ITEM',
					'name' => 'retail_item',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_item']) ? strtoupper($params['retailinfo']['loadtransaction_item']) : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'retail_mobilenumber',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_recipientnumber']) ? $params['retailinfo']['loadtransaction_recipientnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'LOAD',
					'name' => 'retail_load',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['retailinfo']['loadtransaction_load']) ? $params['retailinfo']['loadtransaction_load'] : 0,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DISCOUNT',
					'name' => 'retail_discount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['retailinfo']['loadtransaction_discount']) ? $params['retailinfo']['loadtransaction_discount'] : 0,
				);*/

				/*if(!empty($params['retailinfo']['loadtransaction_load'])&&!empty($params['retailinfo']['loadtransaction_cost'])) {
					$percent = floatval($params['retailinfo']['loadtransaction_load']) - floatval($params['retailinfo']['loadtransaction_cost']);
					$percent = $percent / floatval($params['retailinfo']['loadtransaction_load']);

					$discount = floatval($params['retailinfo']['loadtransaction_load']) * $percent;

					$percent = $percent * 100;

					$amountdue = floatval($params['retailinfo']['loadtransaction_load']) - $discount;
				}*/

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'discountblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'DISCOUNT',
							'name' => 'retail_discountpercent',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['retailinfo']['loadtransaction_discountpercent']) ? number_format($params['retailinfo']['loadtransaction_discountpercent'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'retail_discount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['retailinfo']['loadtransaction_discount']) ? number_format($params['retailinfo']['loadtransaction_discount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'retail_processingfee',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['retailinfo']['loadtransaction_processingfee']) ? $params['retailinfo']['loadtransaction_processingfee'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'retail_amountdue',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'value' => !empty($amountdue) ? number_format($amountdue,2) : 0,
					'value' => !empty($params['retailinfo']['loadtransaction_amountdue']) ? $params['retailinfo']['loadtransaction_amountdue'] : 0,
				);

				//

				//if(!empty($params['retailinfo']['loadtransaction_status'])&&$params['retailinfo']['loadtransaction_status']==TRN_QUEUED) {

				if($post['method']=='loadtransfer') {

					//$sims = getAllSims(3);

					if(!empty(($simassignment = getItemSimAssign($params['retailinfo']['loadtransaction_item'],$params['retailinfo']['loadtransaction_provider'])))) {

						//pre(array('$simassignment'=>$simassignment));

						$opt = array();

						foreach($simassignment as $v) {
							$selected = false;
							if(!empty($params['retailinfo']['loadtransaction_assignedsim'])&&$params['retailinfo']['loadtransaction_assignedsim']==$v['itemassignedsim_simnumber']) {
								$selected = true;
							}
							//if($selected) {
							//	$opt[] = array('text'=>$v['itemassignedsim_simnumber'],'value'=>$v['itemassignedsim_simnumber'],'selected'=>$selected);
							//} else {
								$opt[] = array('text'=>$v['itemassignedsim_simnumber'],'value'=>$v['itemassignedsim_simnumber'],'selected'=>$selected);
							//}
						}

						$params['tbDetails'][] = array(
							'type' => 'combo',
							'label' => 'ASSIGNED SIM',
							'name' => 'retail_newassignedsimcard',
							'readonly' => true,
							//'inputWidth' => 200,
							//'required' => !$readonly,
							'options' => $opt,
						);

						$params['tbDetails'][] = array(
							'type' => 'hidden',
							//'label' => 'NEW ASSIGNED SIM',
							'name' => 'retail_assignedsimcard',
							//'readonly' => true,
							//'inputWidth' => 200,
							//'required' => !$readonly,
							//'options' => $opt,
							'value' => !empty($params['retailinfo']['loadtransaction_assignedsim']) ? $params['retailinfo']['loadtransaction_assignedsim'] : '',
						);

						$params['tbDetails'][] = array(
							'type' => 'hidden',
							//'label' => 'NEW ASSIGNED SIM',
							'name' => 'retail_oldstatus',
							//'readonly' => true,
							//'inputWidth' => 200,
							//'required' => !$readonly,
							//'options' => $opt,
							'value' => !empty($params['retailinfo']['loadtransaction_status']) ? $params['retailinfo']['loadtransaction_status'] : 0,
						);

					} else {

						$params['tbDetails'][] = array(
							'type' => 'input',
							'label' => 'ASSIGNED SIM',
							'name' => 'retail_assignedsimcard',
							'readonly' => true,
							//'required' => !$readonly,
							'value' => !empty($params['retailinfo']['loadtransaction_assignedsim']) ? $params['retailinfo']['loadtransaction_assignedsim'] : '',
						);

					}

				} else {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'ASSIGNED SIM',
						'name' => 'retail_assignedsimcard',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['retailinfo']['loadtransaction_assignedsim']) ? $params['retailinfo']['loadtransaction_assignedsim'] : '',
					);

				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CASHIER',
					'name' => 'retail_cashier',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_cashier']) ? $params['retailinfo']['loadtransaction_cashier'] : '',
				);

				if($post['method']=='loadapproved'||$post['method']=='loadtransfer') {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'retail_status',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => TRN_APPROVED,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'retail_statustext',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString(TRN_APPROVED),
					);

				} else
				if($post['method']=='loadmanually') {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'retail_status',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => TRN_COMPLETED_MANUALLY,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'retail_statustext',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString(TRN_COMPLETED_MANUALLY),
					);

				} else
				if($post['method']=='loadhold') {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'retail_status',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => TRN_HOLD,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'retail_statustext',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString(TRN_HOLD),
					);

				} else
				if($post['method']=='loadcancelled') {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'retail_status',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => TRN_CANCELLED,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'retail_statustext',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString(TRN_CANCELLED),
					);

				} else {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'retail_status',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['retailinfo']['loadtransaction_status']) ? $params['retailinfo']['loadtransaction_status'] : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'retail_statustext',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['retailinfo']['loadtransaction_status']) ? getLoadTransactionStatusString($params['retailinfo']['loadtransaction_status']) : '',
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CASH RECEIVED',
					'name' => 'retail_cashreceived',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['retailinfo']['loadtransaction_cashreceived']) ? $params['retailinfo']['loadtransaction_cashreceived'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'retail_customername',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => getCustomerNickByNumber($params['retailinfo']['loadtransaction_customernumber']),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'LOAD COMMAND',
					'name' => 'retail_laodcommand',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_keyword']) ? $params['retailinfo']['loadtransaction_keyword'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REBATE PARENT',
					'name' => 'retail_rebateparent',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_rebateparent']) ? getCustomerNameByID($params['retailinfo']['loadtransaction_rebateparent']) : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REBATE DISCOUNT',
					'name' => 'retail_rebatediscount',
					'readonly' => true,
					//'required' => !$readonly,
					//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['retailinfo']['loadtransaction_rebatediscount']) ? $params['retailinfo']['loadtransaction_rebatediscount'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REBATE AMOUNT',
					'name' => 'retail_rebateamount',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','digits'=>3,'autoUnmask'=>true),
					//'inputMask' => array('numericInput'=>true,'prefix'=>'','autoUnmask'=>true,'rightAlign'=>true),
					'value' => !empty($params['retailinfo']['loadtransaction_rebateamount']) ? $params['retailinfo']['loadtransaction_rebateamount'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'label',
					'label' => 'FOR MANUALLY COMPLETED',
					'labelWidth' => 200,
				);

/*
				$params['tbCustomer'][] = array(
					'type' => 'calendar',
					'label' => 'BIRTH DATE',
					'name' => 'customer_birthdate',
					'readonly' => true,
					'calendarPosition' => 'right',
					'dateFormat' => '%m-%d-%Y',
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_birthdate']) ? $params['customerinfo']['customer_birthdate'] : '',
				);
*/
				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'datetime',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(

						array(
							'type' => $readonly ? 'input' : 'calendar',
							'label' => 'DATE',
							'name' => 'retail_manualdate',
							'readonly' => true,
							'required' => !$readonly,
							'calendarPosition' => 'right',
							'dateFormat' => '%m-%d-%Y',
							'value' => !empty($params['retailinfo']['loadtransaction_manualdate']) ? $params['retailinfo']['loadtransaction_manualdate'] : '',
							'labelWidth' => 50,
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 35,
						),
						array(
							'type' => 'input', //$readonly ? 'input' : 'calendar',
							'label' => 'TIME',
							'name' => 'retail_manualtime',
							'readonly' => $readonly,
							'required' => !$readonly,
							'inputMask' => array('alias'=>'hh:mm','prefix'=>'','autoUnmask'=>true),
							'value' => !empty($params['retailinfo']['loadtransaction_manualtime']) ? $params['retailinfo']['loadtransaction_manualtime'] : '',
							'labelWidth' => 50,
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO',
					'name' => 'retail_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_refnumber']) ? $params['retailinfo']['loadtransaction_refnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SIMCARD BALANCE',
					'name' => 'retail_simcardbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['retailinfo']['loadtransaction_simcardbalance']) ? $params['retailinfo']['loadtransaction_simcardbalance'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RUNNING BALANCE',
					'name' => 'retail_runningbalance',
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_runningbalance']) ? $params['retailinfo']['loadtransaction_runningbalance'] : '',
				);

				$params['tbMessage'][] = array(
					'type' => 'input',
					'label' => 'FROM',
					'name' => 'retail_confirmationfrom',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_confirmationfrom']) ? $params['retailinfo']['loadtransaction_confirmationfrom'] : '',
				);

				$params['tbMessage'][] = array(
					'type' => 'input',
					'label' => 'DATE/TIME',
					'name' => 'retail_confirmationstamp',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['retailinfo']['loadtransaction_confirmationstamp']) ? pgDate($params['retailinfo']['loadtransaction_confirmationstamp']) : '',
				);

				$params['tbMessage'][] = array(
					'type' => 'input',
					'label' => 'CONFIRMATION',
					'name' => 'retail_confirmation',
					'readonly' => true,
					//'required' => !$readonly,
					'inputWidth' => 500,
					'rows' => 5,
					'value' => !empty($params['retailinfo']['loadtransaction_confirmation']) ? $params['retailinfo']['loadtransaction_confirmation'] : '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_loaddetailretail

		function _form_loaddetaildealer($routerid=false,$formid=false) {
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
					'name' => 'dealer_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'dealer_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'combo',
					'label' => 'PROVIDER',
					'name' => 'dealer_provider',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
					'options' => array(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RETAILER NAME',
					'name' => 'dealer_retailername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RETAILER NUMBER',
					'name' => 'dealer_retailerno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'LOAD',
					'name' => 'dealer_load',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DISCOUNT',
					'name' => 'dealer_discount',
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
					'label' => 'PROCESSING FEE',
					'name' => 'dealer_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'dealer_amountdue',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ASSIGNED SIM',
					'name' => 'dealer_assignedsimcard',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CASHIER',
					'name' => 'dealer_cashier',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'dealer_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CASH RECEIVED',
					'name' => 'retail_cashreceived',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'dealer_customername',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'dealer_customernumber',
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
					'label' => 'REBATE PARENT',
					'name' => 'dealer_rebateparent',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REBATE DISCOUNT',
					'name' => 'dealer_rebatediscount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REBATE AMOUNT',
					'name' => 'dealer_rebateamount',
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
							'name' => 'dealer_date',
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
							'name' => 'dealer_time',
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
					'name' => 'dealer_referenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SIMCARD BALANCE',
					'name' => 'dealer_simcardbalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RUNNING BALANCE',
					'name' => 'dealer_runningbalance',
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

		} // _form_loaddetaildealer

		function _form_loaddetailfundreload($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='loadnew'||$post['method']=='loadedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='loadedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_fund where fund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['fund_id'])) {
							$params['fundreloadinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='loadsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Fund reload successfully saved!';

					$content = array();
					$content['fund_ymd'] = date('Ymd');
					$content['fund_type'] = 'fundreload';
					$content['fund_amount'] = !empty($post['fund_amount']) ? $post['fund_amount'] : 0;
					$content['fund_amountdue'] = $fund_amountdue = !empty($post['fund_amountdue']) ? $post['fund_amountdue'] : 0;
					$content['fund_discount'] = !empty($post['fund_discount']) ? $post['fund_discount'] : 0;
					$content['fund_processingfee'] = !empty($post['fund_processingfee']) ? $post['fund_processingfee'] : 0;
					$content['fund_datetimeunix'] = $fund_datetimeunix = !empty($post['fund_datetimeunix']) ? $post['fund_datetimeunix'] : time();
					$content['fund_datetime'] = pgDateUnix($content['fund_datetimeunix']);
					$content['fund_userid'] = $fund_userid = !empty($post['fund_userid']) ? $post['fund_userid'] : 0;
					$content['fund_username'] = !empty($post['fund_username']) ? $post['fund_username'] : '';
					$content['fund_usernumber'] = !empty($post['fund_usernumber']) ? $post['fund_usernumber'] : '';
					$content['fund_userpaymentterm'] = !empty($post['fund_userpaymentterm']) ? $post['fund_userpaymentterm'] : '';
					$content['fund_recepientid'] = $fund_recepientid = !empty($post['fund_recepientid']) ? $post['fund_recepientid'] : 0;
					$content['fund_recepientname'] = getCustomerNameByID($content['fund_recepientid']);
					$content['fund_recepientnumber'] = !empty($post['fund_recepientnumber']) ? $post['fund_recepientnumber'] : '';
					$content['fund_recepientpaymentterm'] = !empty($post['fund_recepientpaymentterm']) ? $post['fund_recepientpaymentterm'] : '';
					$content['fund_status'] = 1;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['fund_updatestamp'] = 'now()';

						unset($content['fund_ymd']);
						unset($content['fund_datetimeunix']);
						unset($content['fund_datetime']);

						if(!($result = $appdb->update("tbl_fund",$content,"fund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_fund",$content,"fund_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['fund_id'])) {
							$retval['rowid'] = $result['returning'][0]['fund_id'];
						}

					}

					if(!empty($retval['rowid'])) {

						if(!($result = $appdb->query("delete from tbl_ledger where ledger_fundid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$content = array();
						$content['ledger_fundid'] = $retval['rowid'];
						$content['ledger_credit'] = $fund_amountdue;
						$content['ledger_type'] = 'FUNDRELOAD '.$fund_amountdue;
						$content['ledger_datetimeunix'] = $fund_datetimeunix;
						$content['ledger_datetime'] = pgDateUnix($fund_datetimeunix);
						$content['ledger_user'] = $fund_recepientid;
						$content['ledger_seq'] = '0';

						if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						computeCustomerBalance($fund_recepientid);

					}

					json_encode_return($retval);
					die;

				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$receiptno = '';

				if(!empty($params['fundreloadinfo']['fund_id'])&&!empty($params['fundreloadinfo']['fund_ymd'])) {
					$receiptno = $params['fundreloadinfo']['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['fundreloadinfo']['fund_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'fund_receiptno',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'fund_datetime',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['fundreloadinfo']['fund_datetime']) ? $params['fundreloadinfo']['fund_datetime'] : '',
				);

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'CUSTOMER NAME',
						'name' => 'fund_recepientname',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['fundreloadinfo']['fund_recepientname']) ? $params['fundreloadinfo']['fund_recepientname'] : '',
					);
				} else {

					if(!empty($params['fundreloadinfo']['fund_recepientid'])) {
						$params['tbDetails'][] = array(
							'type' => 'hidden',
							'name' => 'fund_recepientid',
							'value' => $params['fundreloadinfo']['fund_recepientid'],
						);

						$params['tbDetails'][] = array(
							'type' => 'input',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientname',
							'readonly' => true,
							//'required' => !$readonly,
							'value' => getCustomerNameByID($params['fundreloadinfo']['fund_recepientid']),
						);
					} else {
						$params['tbDetails'][] = array(
							'type' => 'combo',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientid',
							'readonly' => $readonly,
							'required' => !$readonly,
							'options' => array(), //$opt,
						);
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'fund_recepientnumber',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['fundreloadinfo']['fund_recepientnumber']) ? $params['fundreloadinfo']['fund_recepientnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT TERM',
					'name' => 'fund_recepientpaymentterm',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['fundreloadinfo']['fund_recepientpaymentterm']) ? $params['fundreloadinfo']['fund_recepientpaymentterm'] : '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUND',
					'name' => 'fundreload_fund',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DISCOUNT',
					'name' => 'fund_discount',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['fundreloadinfo']['fund_discount']) ? $params['fundreloadinfo']['fund_discount'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'fund_processingfee',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['fundreloadinfo']['fund_processingfee']) ? $params['fundreloadinfo']['fund_processingfee'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'fund_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['fundreloadinfo']['fund_amount']) ? $params['fundreloadinfo']['fund_amount'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'fund_amountdue',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['fundreloadinfo']['fund_amountdue']) ? $params['fundreloadinfo']['fund_amountdue'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'hidden',
					//'label' => 'USER ID',
					'name' => 'fund_userid',
					//'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->getUserID(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'fund_username',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->fullname(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'fund_status',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['fundreloadinfo']['fund_status']) ? getLoadTransactionStatusString($params['fundreloadinfo']['fund_status']) : 'DRAFT',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_loaddetailfundreload

		function _form_loaddetailchildreload($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='onrowselect')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_fund where fund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['fund_id'])) {
							$params['customerreloadinfo'] = $result['rows'][0];
						}
					}
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$receiptno = '';

				if(!empty($params['customerreloadinfo']['fund_id'])&&!empty($params['customerreloadinfo']['fund_ymd'])) {
					$receiptno = $params['customerreloadinfo']['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['customerreloadinfo']['fund_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'fund_receiptno',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'fund_datetime',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_datetime']) ? $params['customerreloadinfo']['fund_datetime'] : '',
				);

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'CUSTOMER NAME',
						'name' => 'fund_recepientname',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['customerreloadinfo']['fund_recepientname']) ? $params['customerreloadinfo']['fund_recepientname'] : '',
					);
				} else {

					if(!empty($params['customerreloadinfo']['fund_recepientid'])) {
						$params['tbDetails'][] = array(
							'type' => 'hidden',
							'name' => 'fund_recepientid',
							'value' => $params['customerreloadinfo']['fund_recepientid'],
						);

						$params['tbDetails'][] = array(
							'type' => 'input',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientname',
							'readonly' => true,
							//'required' => !$readonly,
							'value' => getCustomerNameByID($params['customerreloadinfo']['fund_recepientid']),
						);
					} else {
						$params['tbDetails'][] = array(
							'type' => 'combo',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientid',
							'readonly' => $readonly,
							'required' => !$readonly,
							'options' => array(), //$opt,
						);
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'fund_recepientnumber',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_recepientnumber']) ? $params['customerreloadinfo']['fund_recepientnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT TERM',
					'name' => 'fund_recepientpaymentterm',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_recepientpaymentterm']) ? $params['customerreloadinfo']['fund_recepientpaymentterm'] : '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUND',
					'name' => 'fundreload_fund',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/


				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DISCOUNT',
					'name' => 'fund_discount',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_discount']) ? $params['customerreloadinfo']['fund_discount'] : 0,
				);*/

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'discountblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'DISCOUNT',
							'name' => 'fund_discount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['customerreloadinfo']['fund_discount']) ? number_format($params['customerreloadinfo']['fund_discount'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'fund_discountamount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['customerreloadinfo']['fund_discountamount']) ? number_format($params['customerreloadinfo']['fund_discountamount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'fund_processingfee',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_processingfee']) ? $params['customerreloadinfo']['fund_processingfee'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'fund_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['customerreloadinfo']['fund_amount']) ? $params['customerreloadinfo']['fund_amount'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'fund_amountdue',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['customerreloadinfo']['fund_amountdue']) ? $params['customerreloadinfo']['fund_amountdue'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'hidden',
					//'label' => 'USER ID',
					'name' => 'fund_userid',
					//'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->getUserID(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'fund_username',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->fullname(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'fund_status',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_status']) ? getLoadTransactionStatusString($params['customerreloadinfo']['fund_status']) : 'DRAFT',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;
		} // _form_loaddetailchildreload

		function _form_loaddetailcustomerreload($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				$userId = $applogin->getUserID();
				$userData = $applogin->getUserData();

				if(!empty($userData['user_staffid'])) {
					$user_staffid = $userData['user_staffid'];
					$customer_type = getCustomerType($userData['user_staffid']);
					//$retval['customer_type'] = $customer_type;
				}

				if(!empty($post['method'])&&($post['method']=='loadnew'||$post['method']=='loadedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&$post['method']=='loadnew') {

					$retval = array();

					//$retval['userdata'] = $userData;

					if(!empty($customer_type)&&$customer_type=='STAFF') {

						/*if(!($result = $appdb->query("select * from tbl_fund where fund_userid=$userId order by fund_datetimeunix asc limit 1"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						pre(array('$result'=>$result));*/

						if(isCustomerFreezed($user_staffid)) {
							$retval['return_code'] = 'ERROR';
							$retval['return_message'] = 'Your account is currently freezed. Please contact administrator!';
							json_encode_return($retval);
							die;
						}

						if(isFreezeLevel($user_staffid)) {

							setCustomerFreeze($user_staffid);

							$retval['return_code'] = 'ERROR';
							$retval['return_message'] = 'Your account is currently freezed. Please contact administrator!';
							json_encode_return($retval);
							die;
						}

						if(isCriticalLevel($user_staffid)) {
							$params['return_code'] = 'ALERT';
							$params['return_message'] = 'Your account has reached its critical level. Please contact administrator!';
						}

						if(($availableCredit = getStaffAvailableCredit($user_staffid))) {

							$creditLimit = getStaffCreditLimit($user_staffid);

							if($availableCredit!=$creditLimit) {

								if(($terms = getStaffTerms($user_staffid))) {

									if(!empty(($unpaidTran = getStaffFirstUnpaidTransactions($user_staffid)))) {

										$currentDate = getDbUnixDate();

										$unpaidDate = pgDateUnix($unpaidTran['ledger_datetimeunix'],'m-d-Y') . ' 23:59';

										$unpaidStamp = date2timestamp($unpaidDate, getOption('$DISPLAY_DATE_FORMAT','r'));

										//$dueDate = floatval(86400 * ($terms-1)) + floatval($unpaidTran['ledger_datetimeunix']);

										$dueDate = floatval(86400 * ($terms-1)) + $unpaidStamp;

										setCustomerCreditDue($user_staffid,$dueDate);

										//pre(array('$unpaidStamp'=>$unpaidStamp,'$unpaidDate'=>$unpaidDate,'ledger_datetimeunix'=>$unpaidTran['ledger_datetimeunix'],'ledger_datetimeunix2'=>pgDateUnix($unpaidTran['ledger_datetimeunix']),'$dueDate'=>$dueDate,'$dueDate2'=>pgDateUnix($dueDate),'$currentDate'=>$currentDate,'$currentDate2'=>pgDateUnix($currentDate),'$unpaidTran'=>$unpaidTran));

										if($currentDate>$dueDate) {

											setCustomerFreeze($user_staffid);

											$retval['return_code'] = 'ERROR';
											$retval['return_message'] = 'Your account is currently freezed. Please contact administrator!';
											json_encode_return($retval);
											die;
										}
									}

								}

								//pre(array('$terms'=>$terms));
							}

							unsetCustomerCreditDue($user_staffid);

						} else {
							$retval['return_code'] = 'ERROR';
							$retval['return_message'] = 'You have not enough available credits to continue!';
							json_encode_return($retval);
							die;
						}

					} else {

						if(!$applogin->isSystemAdministrator()) {
							$retval['return_code'] = 'ERROR';
							$retval['return_message'] = 'You are not allowed to access this module!';
							json_encode_return($retval);
							die;
						}
					}

				} else
				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='loadedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_fund where fund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['fund_id'])) {
							$params['customerreloadinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='loadsave') {

					$userId = $applogin->getUserID();
					$userData = $applogin->getUserData();


					if(!empty($userData['user_staffid'])) {
						$user_staffid = $userData['user_staffid'];
						$customer_type = getCustomerType($userData['user_staffid']);
					}

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Customer reload successfully saved!';

					$content = array();
					$content['fund_ymd'] = $fund_ymd = date('Ymd');
					$content['fund_type'] = 'customerreload';
					$content['fund_amount'] = !empty($post['fund_amount']) ? $post['fund_amount'] : 0;
					$content['fund_amountdue'] = $fund_amountdue = !empty($post['fund_amountdue']) ? $post['fund_amountdue'] : 0;
					$content['fund_discount'] = !empty($post['fund_discount']) ? $post['fund_discount'] : 0;
					$content['fund_processingfee'] = !empty($post['fund_processingfee']) ? $post['fund_processingfee'] : 0;
					$content['fund_datetimeunix'] = $fund_datetimeunix = !empty($post['fund_datetimeunix']) ? $post['fund_datetimeunix'] : time();
					$content['fund_datetime'] = pgDateUnix($content['fund_datetimeunix']);
					$content['fund_userid'] = $fund_userid = !empty($post['fund_userid']) ? $post['fund_userid'] : 0;
					$content['fund_username'] = !empty($post['fund_username']) ? $post['fund_username'] : '';
					$content['fund_usernumber'] = !empty($post['fund_usernumber']) ? $post['fund_usernumber'] : '';
					$content['fund_userpaymentterm'] = !empty($post['fund_userpaymentterm']) ? $post['fund_userpaymentterm'] : '';
					$content['fund_recepientid'] = $fund_recepientid = !empty($post['fund_recepientid']) ? $post['fund_recepientid'] : 0;
					$content['fund_recepientname'] = getCustomerNameByID($content['fund_recepientid']);
					$content['fund_recepientnumber'] = $fund_recepientnumber = !empty($post['fund_recepientnumber']) ? $post['fund_recepientnumber'] : '';
					$content['fund_recepientpaymentterm'] = !empty($post['fund_recepientpaymentterm']) ? $post['fund_recepientpaymentterm'] : '';
					$content['fund_status'] = 1;

					if(!empty($customer_type)&&$customer_type=='STAFF') {
						$content['fund_staffid'] = $user_staffid;
					}

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['fund_updatestamp'] = 'now()';

						unset($content['fund_ymd']);
						unset($content['fund_datetimeunix']);
						unset($content['fund_datetime']);

						if(!($result = $appdb->update("tbl_fund",$content,"fund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_fund",$content,"fund_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['fund_id'])) {
							$retval['rowid'] = $result['returning'][0]['fund_id'];
						}

					}

					if(!empty($retval['rowid'])) {

						if(!($result = $appdb->query("delete from tbl_ledger where ledger_fundid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$receiptno = $fund_ymd . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', $retval['rowid']);

						$content = array();
						$content['ledger_fundid'] = $retval['rowid'];
						$content['ledger_credit'] = $fund_amountdue;
						$content['ledger_type'] = 'CUSTOMERRELOAD '.$fund_amountdue;
						$content['ledger_datetimeunix'] = $fund_datetimeunix;
						$content['ledger_datetime'] = $ledger_datetime = pgDateUnix($fund_datetimeunix);
						$content['ledger_user'] = $fund_recepientid;
						$content['ledger_seq'] = '0';
						$content['ledger_receiptno'] = $receiptno;

						if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						computeCustomerBalance($fund_recepientid);

						$fundBalance = getCustomerBalance($fund_recepientid);

						if(!empty(($gateways = getGateways($fund_recepientnumber)))) {

							//shuffle($gateways);

							foreach($gateways as $gw=>$v) {
								$errmsg = getNotification('CUSTOMER RELOAD');
								$errmsg = str_replace('%VAMOUNT%', number_format($fund_amountdue,2), $errmsg);
								$errmsg = str_replace('%VBALANCE%', number_format($fundBalance,2), $errmsg);
								$errmsg = str_replace('%FRRECEIPTNO%', $receiptno, $errmsg);
								$errmsg = str_replace('%DATETIME%', $ledger_datetime, $errmsg);

								// You have received %VAMOUNT% credits. Your current VFUND is P%VBALANCE%. Tx: %FRRECEIPTNO% as of %DATETIME% Thank you.

								sendToGateway($fund_recepientnumber,$gw,$errmsg);
								break;
							}
						}

						$content['ledger_user'] = $user_staffid;

						if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						computeStaffBalance($user_staffid);


					}

					json_encode_return($retval);
					die;

				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$receiptno = '';

				if(!empty($params['customerreloadinfo']['fund_id'])&&!empty($params['customerreloadinfo']['fund_ymd'])) {
					$receiptno = $params['customerreloadinfo']['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['customerreloadinfo']['fund_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'fund_receiptno',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'fund_datetime',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_datetime']) ? $params['customerreloadinfo']['fund_datetime'] : '',
				);

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'CUSTOMER NAME',
						'name' => 'fund_recepientname',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['customerreloadinfo']['fund_recepientname']) ? $params['customerreloadinfo']['fund_recepientname'] : '',
					);
				} else {

					if(!empty($params['customerreloadinfo']['fund_recepientid'])) {
						$params['tbDetails'][] = array(
							'type' => 'hidden',
							'name' => 'fund_recepientid',
							'value' => $params['customerreloadinfo']['fund_recepientid'],
						);

						$params['tbDetails'][] = array(
							'type' => 'input',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientname',
							'readonly' => true,
							//'required' => !$readonly,
							'value' => getCustomerNameByID($params['customerreloadinfo']['fund_recepientid']),
						);
					} else {
						$params['tbDetails'][] = array(
							'type' => 'combo',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientid',
							'readonly' => $readonly,
							'required' => !$readonly,
							'options' => array(), //$opt,
						);
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'fund_recepientnumber',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_recepientnumber']) ? $params['customerreloadinfo']['fund_recepientnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT TERM',
					'name' => 'fund_recepientpaymentterm',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_recepientpaymentterm']) ? $params['customerreloadinfo']['fund_recepientpaymentterm'] : '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUND',
					'name' => 'fundreload_fund',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/


				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DISCOUNT',
					'name' => 'fund_discount',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_discount']) ? $params['customerreloadinfo']['fund_discount'] : 0,
				);*/

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'discountblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'DISCOUNT',
							'name' => 'fund_discount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['customerreloadinfo']['fund_discount']) ? number_format($params['customerreloadinfo']['fund_discount'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'fund_discountamount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['customerreloadinfo']['fund_discountamount']) ? number_format($params['customerreloadinfo']['fund_discountamount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'fund_processingfee',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_processingfee']) ? $params['customerreloadinfo']['fund_processingfee'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'fund_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['customerreloadinfo']['fund_amount']) ? $params['customerreloadinfo']['fund_amount'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'fund_amountdue',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['customerreloadinfo']['fund_amountdue']) ? $params['customerreloadinfo']['fund_amountdue'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'hidden',
					//'label' => 'USER ID',
					'name' => 'fund_userid',
					//'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->getUserID(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'fund_username',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->fullname(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'fund_status',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_status']) ? getLoadTransactionStatusString($params['customerreloadinfo']['fund_status']) : 'DRAFT',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_loaddetailcustomerreload

		function _form_loaddetailfundtransfer($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='onrowselect')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_fund where fund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['fund_id'])) {
							$params['customerreloadinfo'] = $result['rows'][0];
						}
					}
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$receiptno = '';

				if(!empty($params['customerreloadinfo']['fund_id'])&&!empty($params['customerreloadinfo']['fund_ymd'])) {
					$receiptno = $params['customerreloadinfo']['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['customerreloadinfo']['fund_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'fund_receiptno',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'fund_datetime',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_datetime']) ? $params['customerreloadinfo']['fund_datetime'] : '',
				);

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'CUSTOMER NAME',
						'name' => 'fund_recepientname',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['customerreloadinfo']['fund_recepientname']) ? $params['customerreloadinfo']['fund_recepientname'] : '',
					);
				} else {

					if(!empty($params['customerreloadinfo']['fund_recepientid'])) {
						$params['tbDetails'][] = array(
							'type' => 'hidden',
							'name' => 'fund_recepientid',
							'value' => $params['customerreloadinfo']['fund_recepientid'],
						);

						$params['tbDetails'][] = array(
							'type' => 'input',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientname',
							'readonly' => true,
							//'required' => !$readonly,
							'value' => getCustomerNameByID($params['customerreloadinfo']['fund_recepientid']),
						);
					} else {
						$params['tbDetails'][] = array(
							'type' => 'combo',
							'label' => 'CUSTOMER NAME',
							'name' => 'fund_recepientid',
							'readonly' => $readonly,
							'required' => !$readonly,
							'options' => array(), //$opt,
						);
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'fund_recepientnumber',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_recepientnumber']) ? $params['customerreloadinfo']['fund_recepientnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT TERM',
					'name' => 'fund_recepientpaymentterm',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_recepientpaymentterm']) ? $params['customerreloadinfo']['fund_recepientpaymentterm'] : '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUND',
					'name' => 'fundreload_fund',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/


				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DISCOUNT',
					'name' => 'fund_discount',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_discount']) ? $params['customerreloadinfo']['fund_discount'] : 0,
				);*/

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'discountblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 350,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'DISCOUNT',
							'name' => 'fund_discount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['customerreloadinfo']['fund_discount']) ? number_format($params['customerreloadinfo']['fund_discount'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'fund_discountamount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['customerreloadinfo']['fund_discountamount']) ? number_format($params['customerreloadinfo']['fund_discountamount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROCESSING FEE',
					'name' => 'fund_processingfee',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_processingfee']) ? $params['customerreloadinfo']['fund_processingfee'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'fund_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['customerreloadinfo']['fund_amount']) ? $params['customerreloadinfo']['fund_amount'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'fund_amountdue',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['customerreloadinfo']['fund_amountdue']) ? $params['customerreloadinfo']['fund_amountdue'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'hidden',
					//'label' => 'USER ID',
					'name' => 'fund_userid',
					//'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->getUserID(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'fund_username',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => $applogin->fullname(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'fund_status',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['customerreloadinfo']['fund_status']) ? getLoadTransactionStatusString($params['customerreloadinfo']['fund_status']) : 'DRAFT',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;
		} // _form_loaddetailfundtransfer

		function _form_loaddetailloadexpense($routerid=false,$formid=false) {
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
					'name' => 'fundtransferreload_receiptno',
					'readonly' => $readonly,
					'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'fundtransferreload_date',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PROVIDER',
					'name' => 'fundtransferreload_fromcustomer',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ITEM',
					'name' => 'fundtransferreload_fromcustomernumber',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ASSIGNED SIM CARD TO RECEIVE LOAD',
					'name' => 'fundreload_paymentterm',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

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

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'fundtransferreload_amount',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DISCOUNT',
					'name' => 'fundtransferreload_discount',
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
					'label' => 'AMOUNT DUE',
					'name' => 'fundtransferreload_amountdue',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ASSIGNED SIM CARD TO SEND LOAD',
					'name' => 'fundtransferreload_processingfee',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'fundtransferreload_user',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'fundtransferreload_status',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'TO CUSTOMER',
					'name' => 'fundtransferreload_tochild',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'fundtransferreload_tocustomermobilenumber',
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
		} // _form_loaddetailloadexpense

		function router() {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

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
					if($this->post['table']=='retail') {
						if(!($result = $appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_type='retail' order by loadtransaction_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['loadtransaction_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$receiptno = '';

								if(!empty($v['loadtransaction_id'])&&!empty($v['loadtransaction_ymd'])) {
									$receiptno = $v['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['loadtransaction_id']));
								}

								$statusString = getLoadTransactionStatusString($v['loadtransaction_status']);

								//pre(array('$v'=>$v));


								if($v['loadtransaction_status']==TRN_QUEUED||$v['loadtransaction_status']==TRN_APPROVED||$v['loadtransaction_status']==TRN_SENT||$v['loadtransaction_status']==TRN_PROCESSING) {
									$statusString = $statusString . ', (' . intval($v['elapsedtime']) . 'sec)';
								}

								$rows[] = array('id'=>$v['loadtransaction_id'],'data'=>array(0,$v['loadtransaction_id'],pgDate($v['loadtransaction_createstamp']),$receiptno,$v['loadtransaction_provider'],$v['loadtransaction_assignedsim'],$v['loadtransaction_customername'],$v['loadtransaction_recipientnumber'],$v['loadtransaction_item'],number_format($v['loadtransaction_load'],2),number_format($v['loadtransaction_discount'],2),number_format($v['loadtransaction_amountdue'],2),$statusString));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='fundreload') {

						if(!($result = $appdb->query("select * from tbl_fund where fund_type='fundreload' order by fund_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['fund_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$receiptno = '';

								if(!empty($v['fund_id'])&&!empty($v['fund_ymd'])) {
									$receiptno = $v['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['fund_id']));
								}

								$rows[] = array('id'=>$v['fund_id'],'data'=>array(0,$v['fund_id'],$v['fund_datetime'],$receiptno,$v['fund_recepientname'],$v['fund_recepientnumber'],number_format($v['fund_amountdue'],2),getLoadTransactionStatusString($v['fund_status'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='customerreload') {

						if($applogin->isSystemAdministrator()) {
							if(!($result = $appdb->query("select * from tbl_fund where fund_type='customerreload' order by fund_id desc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						} else {
							$userid = $applogin->getUserID();

							if(!($result = $appdb->query("select * from tbl_fund where fund_type='customerreload' and fund_userid=$userid order by fund_id desc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}

						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['fund_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$receiptno = '';

								if(!empty($v['fund_id'])&&!empty($v['fund_ymd'])) {
									$receiptno = $v['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['fund_id']));
								}

								$rows[] = array('id'=>$v['fund_id'],'data'=>array(0,$v['fund_id'],$v['fund_datetime'],$receiptno,$v['fund_recepientname'],$v['fund_recepientnumber'],number_format($v['fund_amountdue'],2),getLoadTransactionStatusString($v['fund_status'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='childreload') {

						//if($applogin->isSystemAdministrator()) {
							if(!($result = $appdb->query("select * from tbl_fund where fund_type='childreload' order by fund_id desc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						//} else {
						//	$userid = $applogin->getUserID();

						//	if(!($result = $appdb->query("select * from tbl_fund where fund_type='childreload' and fund_userid=$userid order by fund_id desc"))) {
						//		json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						//		die;
						//	}
						//}

						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['fund_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$receiptno = '';

								if(!empty($v['fund_id'])&&!empty($v['fund_ymd'])) {
									$receiptno = $v['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['fund_id']));
								}

								$rows[] = array('id'=>$v['fund_id'],'data'=>array(0,$v['fund_id'],$v['fund_datetime'],$receiptno,$v['fund_username'],$v['fund_usernumber'],$v['fund_recepientname'],$v['fund_recepientnumber'],number_format($v['fund_amountdue'],2),getLoadTransactionStatusString($v['fund_status'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='fundtransfer') {

						//if($applogin->isSystemAdministrator()) {
							if(!($result = $appdb->query("select * from tbl_fund where fund_type='fundtransfer' order by fund_id desc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						//} else {
						//	$userid = $applogin->getUserID();

						//	if(!($result = $appdb->query("select * from tbl_fund where fund_type='fundtransfer' and fund_userid=$userid order by fund_id desc"))) {
						//		json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						//		die;
						//	}
						//}

						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['fund_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$receiptno = '';

								if(!empty($v['fund_id'])&&!empty($v['fund_ymd'])) {
									$receiptno = $v['fund_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['fund_id']));
								}

								$rows[] = array('id'=>$v['fund_id'],'data'=>array(0,$v['fund_id'],$v['fund_datetime'],$receiptno,$v['fund_username'],$v['fund_usernumber'],$v['fund_recepientname'],$v['fund_recepientnumber'],number_format($v['fund_amountdue'],2),getLoadTransactionStatusString($v['fund_status'])));
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

	$appappload = new APP_app_load;
}

# eof modules/app.user
