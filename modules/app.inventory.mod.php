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

if(!class_exists('APP_app_inventory')) {

	class APP_app_inventory extends APP_Base_Ajax {

		var $desc = 'Inventory';

		var $pathid = 'inventory';
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

			$appaccess->rules($this->desc,'Inventory Module');

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

		function _form_inventorymainsimcards($routerid=false,$formid=false) {
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

		} // _form_inventorymainsimcards

		function _form_inventorymainitem($routerid=false,$formid=false) {
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

		} // _form_inventorymainitem

		function _form_inventorymainstocks($routerid=false,$formid=false) {
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

		} // _form_inventorymainstocks

		function _form_inventorymaininstore($routerid=false,$formid=false) {
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

		} // _form_inventorymaininstore

		function _form_inventorymainadjustment($routerid=false,$formid=false) {
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

		} // _form_inventorymainadjustment

		function _form_inventorymaincashfund($routerid=false,$formid=false) {
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

		} // _form_inventorymaincashfund

		function _form_inventorydetailsimcards($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$params = array();

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='inventorynew'||$post['method']=='inventoryedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='inventoryedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_simcard where simcard_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['simcard_id'])) {
							$params['simcardinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='getnetwork') {

					$retval = array();
					$retval['network'] = getNetworkName($this->vars['post']['mobileno']);

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='inventorypause') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'All Sim cards will now pause!';

					$curl = new MyCurl;

					$curl->get('http://127.0.0.1:8080/pause');

					$ctr=0;

					do {
						if($cont = $curl->get('http://127.0.0.1:8080/processcount')) {
							$count = intval(trim($cont['content']));
							if($count===0) {
								break;
							}
						}
						sleep(1);
					} while($ctr<60);

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='inventoryresume') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'All Sim cards has been resumed!';

					$curl = new MyCurl;

					$curl->get('http://127.0.0.1:8080/resume');

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='inventoryrestart') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card server has been restarted!';

					$curl = new MyCurl;

					$curl->get('http://127.0.0.1:8080/pause');

					$ctr=0;

					do {
						if($cont = $curl->get('http://127.0.0.1:8080/processcount')) {
							$count = intval(trim($cont['content']));
							if($count===0) {
								break;
							}
						}
						sleep(1);
					} while($ctr<60);

					$curl->get('http://127.0.0.1:8080/terminate');

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='inventorysave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card successfully saved!';

					$content = array();
					$content['simcard_ymd'] = date('Ymd');
					$content['simcard_name'] = !empty($post['simcard_name']) ? $post['simcard_name'] : '';
					$content['simcard_desc'] = !empty($post['simcard_desc']) ? $post['simcard_desc'] : '';
					$content['simcard_number'] = $sim_number = !empty($post['simcard_number']) ? $post['simcard_number'] : '';
					$content['simcard_cardnumber'] = !empty($post['simcard_cardnumber']) ? $post['simcard_cardnumber'] : '';
					$content['simcard_trademoneynumber'] = !empty($post['simcard_trademoneynumber']) ? $post['simcard_trademoneynumber'] : '';
					$content['simcard_provider'] = !empty($post['simcard_provider']) ? $post['simcard_provider'] : '';
					$content['simcard_category'] = !empty($post['simcard_category']) ? $post['simcard_category'] : '';
					$content['simcard_parentitem'] = !empty($post['simcard_parentitem']) ? $post['simcard_parentitem'] : '';
					$content['simcard_pin'] = !empty($post['simcard_pin']) ? $post['simcard_pin'] : '';
					$content['simcard_computername'] = !empty($post['simcard_computername']) ? $post['simcard_computername'] : '';
					$content['simcard_ipaddress'] = !empty($post['simcard_ipaddress']) ? $post['simcard_ipaddress'] : '';
					$content['simcard_comport'] = !empty($post['simcard_comport']) ? $post['simcard_comport'] : '';
					$content['simcard_linuxport'] = $sim_device = !empty($post['simcard_linuxport']) ? $post['simcard_linuxport'] : '';
					$content['simcard_balance'] = !empty($post['simcard_balance']) ? $post['simcard_balance'] : 0;
					$content['simcard_criticallevel'] = !empty($post['simcard_criticallevel']) ? $post['simcard_criticallevel'] : 0;
					$content['simcard_freezelevel'] = !empty($post['simcard_freezelevel']) ? $post['simcard_freezelevel'] : 0;
					$content['simcard_active'] = !empty($post['simcard_active']) ? 1 : 0;
					$content['simcard_hotline'] = !empty($post['simcard_hotline']) ? 1 : 0;
					$content['simcard_menu'] = !empty($post['simcard_menu']) ? 1 : 0;
					$content['simcard_failedbalanceinquiry'] = !empty($post['simcard_failedbalanceinquiry']) ? 1 : 0;
					$content['simcard_noconfirmationbalanceinquiry'] = !empty($post['simcard_noconfirmationbalanceinquiry']) ? 1 : 0;
					$content['simcard_failedbalanceinquirysimcommand'] = !empty($post['simcard_failedbalanceinquirysimcommand']) ? $post['simcard_failedbalanceinquirysimcommand'] : '';
					$content['simcard_noconfirmationbalanceinquirysimcommand'] = !empty($post['simcard_noconfirmationbalanceinquirysimcommand']) ? $post['simcard_noconfirmationbalanceinquirysimcommand'] : '';

					$content['simcard_failedsimreturnretry'] = !empty($post['simcard_failedsimreturnretry']) ? 1 : 0;
					$content['simcard_failedsimreturnretrycounter'] = !empty($post['simcard_failedsimreturnretrycounter']) ? $post['simcard_failedsimreturnretrycounter'] : 0;
					$content['simcard_waitingforconfirmationmessagetimer'] = !empty($post['simcard_waitingforconfirmationmessagetimer']) ? $post['simcard_waitingforconfirmationmessagetimer'] : 60;
					$content['simcard_reloadretry'] = !empty($post['simcard_reloadretry']) ? $post['simcard_reloadretry'] : 2;
					$content['simcard_balanceinquirytimer'] = !empty($post['simcard_balanceinquirytimer']) ? $post['simcard_balanceinquirytimer'] : 30;
					$content['simcard_balanceinquiryretrycounter'] = !empty($post['simcard_balanceinquiryretrycounter']) ? $post['simcard_balanceinquiryretrycounter'] : 2;
					$content['simcard_setstatustopending'] = !empty($post['simcard_setstatustopending']) ? 1 : 0;
					$content['simcard_stopprocessingloadcommand'] = !empty($post['simcard_stopprocessingloadcommand']) ? 1 : 0;
					$content['simcard_timelapsedforlatesms'] = !empty($post['simcard_timelapsedforlatesms']) ? $post['simcard_timelapsedforlatesms'] : 60;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['simcard_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_simcard",$content,"simcard_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_simcard",$content,"simcard_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['simcard_id'])) {
							$retval['rowid'] = $result['returning'][0]['simcard_id'];
						}

					}

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_simcardfunctions where simcardfunctions_simcardid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['simcardfunctions_loadcommandid'])&&is_array($post['simcardfunctions_loadcommandid'])&&!empty($post['simcardfunctions_modemcommandsname'])&&is_array($post['simcardfunctions_modemcommandsname'])) {

						foreach($post['simcardfunctions_loadcommandid'] as $k=>$v) {

							$simcardfunctions_loadcommandid = !empty($post['simcardfunctions_loadcommandid'][$k]) ? html_entity_decode($post['simcardfunctions_loadcommandid'][$k]) : '';

							if(!empty($simcardfunctions_loadcommandid)) {
								$simcardfunctions_loadcommandid = getLoadCommandIDByName($simcardfunctions_loadcommandid);
							}

							$content = array();
							$content['simcardfunctions_simcardid'] = $retval['rowid'];
							$content['simcardfunctions_loadcommandid'] = $simcardfunctions_loadcommandid;
							$content['simcardfunctions_modemcommandsname'] = !empty($post['simcardfunctions_modemcommandsname'][$k]) ? $post['simcardfunctions_modemcommandsname'][$k] : '';

							if(!($result = $appdb->insert("tbl_simcardfunctions",$content,"simcardfunctions_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					if(!empty($sim_device)&&!empty($sim_number)) {

						$curl = new MyCurl;

						$curl->get('http://127.0.0.1:8080/pause');

						$ctr=0;

						do {
							if($cont = $curl->get('http://127.0.0.1:8080/processcount')) {
								$count = intval(trim($cont['content']));
								if($count===0) {
									break;
								}
							}
							sleep(1);
						} while($ctr<60);

						setSimNumber($sim_device, $sim_number);

						$curl->get('http://127.0.0.1:8080/resume');

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventorydelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_simcard where simcard_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_simcard where simcard_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventoryrecompute') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card transactions successfully recomputed!';

					/*if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_simcard where simcard_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}*/

					if(!empty($post['rowid'])) {
						$retval['rowid'] = $post['rowid'];
					}

					if(!empty($post['trowid'])) {
						if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_id=".$post['trowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($result['rows'][0]['loadtransaction_createstampunix'])) {
						$loadtransaction_createstampunix = $result['rows'][0]['loadtransaction_createstampunix'];
						$loadtransaction_assignedsim = $result['rows'][0]['loadtransaction_assignedsim'];
					}

					if(!empty($loadtransaction_createstampunix)) {
						if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_createstampunix>=$loadtransaction_createstampunix and loadtransaction_assignedsim='$loadtransaction_assignedsim' order by loadtransaction_createstampunix asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($result['rows'][0]['loadtransaction_id'])) {
						//$retval['rows'] = $result['rows'];
						$loadtransaction_runningbalance = 0;

						$first = true;

						foreach($result['rows'] as $k=>$v) {

							$loadtransaction_id = $v['loadtransaction_id'];

							/*if($loadtransaction_runningbalance===0&&!empty($v['loadtransaction_runningbalance'])) {
								$loadtransaction_runningbalance = $v['loadtransaction_runningbalance'];
								continue;
							} else
							if($loadtransaction_runningbalance===0&&!empty($v['loadtransaction_simcardbalance'])) {
								$loadtransaction_runningbalance = $v['loadtransaction_simcardbalance'];
								continue;
							}*/

							if($first) {
								$loadtransaction_runningbalance = $v['loadtransaction_simcardbalance'];
								$first = false;
							} else {
								$in = 0;
								$out = 0;

								if($v['loadtransaction_type']=='smartpadala') {
									$in = $v['loadtransaction_amount'];
								} else
								if($v['loadtransaction_type']=='retail') {
									$out = $v['loadtransaction_amount'];
								} else
								if($v['loadtransaction_type']=='adjustment') {
									if(!empty($v['loadtransaction_adjustmentdebit'])) {
										$out = $v['loadtransaction_amountdue'];
									} else
									if(!empty($v['loadtransaction_adjustmentcredit'])) {
										$in = $v['loadtransaction_amountdue'];
									}
								}

								$loadtransaction_runningbalance = ($loadtransaction_runningbalance + $in);
								$loadtransaction_runningbalance = ($loadtransaction_runningbalance - $out);
							}

							$content = array();

							$content['loadtransaction_runningbalance'] = $loadtransaction_runningbalance;

							//pre(array('$content'=>$content,'$in'=>$in,'$out'=>$out,'$loadtransaction_runningbalance'=>$loadtransaction_runningbalance));

							if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction_id))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventorysimpause') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card paused!';

					if(!empty($post['rowid'])) {

						$retval['rowid'] = $post['rowid'];

						$content = array();
						$content['simcard_paused'] = 1;

						if(!($result = $appdb->update("tbl_simcard",$content,"simcard_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventorysimresume') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card resumed!';

					if(!empty($post['rowid'])) {

						$retval['rowid'] = $post['rowid'];

						$content = array();
						$content['simcard_paused'] = 0;

						if(!($result = $appdb->update("tbl_simcard",$content,"simcard_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventorysimrestart') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card restarted!';

					if(!empty($post['rowid'])) {

						$retval['rowid'] = $post['rowid'];

						setSetting('STATUS_MODEMINIT_'.getSimNumberById($post['rowid']),'2');

						$content = array();
						$content['simcard_paused'] = 0;

						if(!($result = $appdb->update("tbl_simcard",$content,"simcard_id=".$post['rowid']))) {
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

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				$params['tbSimcards'] = array();
				$params['tbDetails'] = array();
				$params['tbFeatures'] = array();
				$params['tbSmsfunctions'] = array();
				$params['tbTransactions'] = array();

				$productid = '';

				if(!empty($params['simcardinfo']['simcard_id'])&&!empty($params['simcardinfo']['simcard_ymd'])) {
					$productid = $params['simcardinfo']['simcard_ymd'] . sprintf('%04d', intval($params['simcardinfo']['simcard_id']));
				}

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'SIM CARD ID',
					'name' => 'simcard_productid',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $productid,
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'SIM CARD NAME',
					'name' => 'simcard_name',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_name']) ? $params['simcardinfo']['simcard_name'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'SIM NUMBER',
					'name' => 'simcard_number',
					'maxLength' => 11,
					'validate' => 'ValidMobileNo', //'srt.ValidateMobileNo', //
					//'inputMask' => '99999999999',
					'numeric' => true,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_number']) ? $params['simcardinfo']['simcard_number'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'PARENT ITEM',
					'name' => 'simcard_parentitem',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_parentitem']) ? $params['simcardinfo']['simcard_parentitem'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'CARD NUMBER',
					'name' => 'simcard_cardnumber',
					'readonly' => $readonly,
					'numeric' => true,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_cardnumber']) ? $params['simcardinfo']['simcard_cardnumber'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'TRADE MONEY NUMBER',
					'name' => 'simcard_trademoneynumber',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_trademoneynumber']) ? $params['simcardinfo']['simcard_trademoneynumber'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'PROVIDER',
					'name' => 'simcard_provider',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_provider']) ? $params['simcardinfo']['simcard_provider'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'CATEGORY',
					'name' => 'simcard_category',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => '',
				);


				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'BALANCE',
					'name' => 'simcard_balance',
					'readonly' => $readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'inputMaskParam' => array('prefix'=>'P '),
					//'inputMaskParam' => array('numericInput'=>true,'rightAlign'=>true,'autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_balance']) ? $params['simcardinfo']['simcard_balance'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'CRITICAL LEVEL',
					'name' => 'simcard_criticallevel',
					'readonly' => $readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_criticallevel']) ? $params['simcardinfo']['simcard_criticallevel'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'FREEZE LEVEL',
					'name' => 'simcard_freezelevel',
					'readonly' => $readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_freezelevel']) ? $params['simcardinfo']['simcard_freezelevel'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'PIN',
					'name' => 'simcard_pin',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_pin']) ? $params['simcardinfo']['simcard_pin'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbSimcards'][] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'simcard_active',
					'readonly' => $readonly,
					'checked' => !empty($params['simcardinfo']['simcard_active']) ? $params['simcardinfo']['simcard_active'] : 0,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'checkbox',
					'label' => 'RECEIVING',
					'name' => 'simcard_hotline',
					'readonly' => $readonly,
					'checked' => !empty($params['simcardinfo']['simcard_hotline']) ? $params['simcardinfo']['simcard_hotline'] : 0,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'checkbox',
					'label' => 'SENDING',
					'name' => 'simcard_sending',
					'readonly' => $readonly,
					'checked' => !empty($params['simcardinfo']['simcard_sending']) ? $params['simcardinfo']['simcard_sending'] : 0,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'checkbox',
					'label' => 'MENU',
					'name' => 'simcard_menu',
					'readonly' => $readonly,
					'checked' => !empty($params['simcardinfo']['simcard_menu']) ? $params['simcardinfo']['simcard_menu'] : 0,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'COMPUTER NAME',
					'name' => 'simcard_computername',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_computername']) ? $params['simcardinfo']['simcard_computername'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'IP ADDRESS',
					'name' => 'simcard_ipaddress',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_ipaddress']) ? $params['simcardinfo']['simcard_ipaddress'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'COM PORT',
					'name' => 'simcard_comport',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_comport']) ? $params['simcardinfo']['simcard_comport'] : '',
				);

				$params['tbSimcards'][] = array(
					'type' => 'input',
					'label' => 'LINUX PORT',
					'name' => 'simcard_linuxport',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['simcardinfo']['simcard_linuxport']) ? $params['simcardinfo']['simcard_linuxport'] : '',
				);

				// tbFeatures

				/*$params['tbFeatures'][] = array(
					'type' => 'checkbox',
					'label' => 'FAILED - SIM Return',
					'name' => 'simcard_failedsimreturn',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 220,
					'checked' => !empty($params['simcardinfo']['simcard_failedsimreturn']) ? $params['simcardinfo']['simcard_failedsimreturn'] : 0,
				);*/

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'FAILED - SIM RETURN RETRY COUNTER',
					'name' => 'simcard_failedsimreturnretry',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 260,
					'checked' => !empty($params['simcardinfo']['simcard_failedsimreturnretry']) ? $params['simcardinfo']['simcard_failedsimreturnretry'] : false,
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block[] = array(
					'type' => 'input',
					'inputWidth' => 100,
					'name' => 'simcard_failedsimreturnretrycounter',
					'readonly' => $readonly,
					'value' => !empty($params['simcardinfo']['simcard_failedsimreturnretrycounter']) ? $params['simcardinfo']['simcard_failedsimreturnretrycounter'] : 2,
				);

				$params['tbFeatures'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbFeatures'][] = array(
					'type' => 'input',
					'label' => 'WAITING FOR CONFIRMATION MESSAGE TIMER (seconds)',
					'labelWidth' => 370,
					'name' => 'simcard_waitingforconfirmationmessagetimer',
					'inputWidth' => 100,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['simcardinfo']['simcard_waitingforconfirmationmessagetimer']) ? $params['simcardinfo']['simcard_waitingforconfirmationmessagetimer'] : 60,
				);

				/*$params['tbFeatures'][] = array(
					'type' => 'checkbox',
					'label' => 'Perform Balance Inquiry',
					'name' => 'simcard_performbalanceinquiry',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 220,
					'checked' => !empty($params['simcardinfo']['simcard_performbalanceinquiry']) ? $params['simcardinfo']['simcard_performbalanceinquiry'] : 0,
				);*/

				$params['tbFeatures'][] = array(
					'type' => 'input',
					'label' => 'RELOAD RETRY',
					'labelWidth' => 110,
					'name' => 'simcard_reloadretry',
					'inputWidth' => 100,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['simcardinfo']['simcard_reloadretry']) ? $params['simcardinfo']['simcard_reloadretry'] : 2,
				);

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'FAILED - PERFORM BALANCE INQUIRY',
					'name' => 'simcard_failedbalanceinquiry',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 250,
					'checked' => !empty($params['simcardinfo']['simcard_failedbalanceinquiry']) ? $params['simcardinfo']['simcard_failedbalanceinquiry'] : 0,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$modemcommands = getModemCommands(1);

				foreach($modemcommands as $v) {
					$selected = false;
					if(!empty($params['simcardinfo']['simcard_failedbalanceinquirysimcommand'])&&$params['simcardinfo']['simcard_failedbalanceinquirysimcommand']==$v) {
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

				$block[] = array(
					'type' => 'combo',
					'name' => 'simcard_failedbalanceinquirysimcommand',
					'inputWidth' => 300,
					'readonly' => true,
					//'value' => !empty($params['simcardinfo']['simcard_failedbalanceinquirysimcommand']) ? $params['simcardinfo']['simcard_failedbalanceinquirysimcommand'] : '',
					'options' => $opt,
				);

				$params['tbFeatures'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbFeatures'][] = array(
					'type' => 'checkbox',
					'label' => 'SET STATUS TO PENDING',
					'name' => 'simcard_setstatustopending',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 220,
					'checked' => !empty($params['simcardinfo']['simcard_setstatustopending']) ? $params['simcardinfo']['simcard_setstatustopending'] : 0,
				);

				$params['tbFeatures'][] = array(
					'type' => 'input',
					'label' => 'BALANCE INQUIRY TIMER (seconds)',
					'labelWidth' => 240,
					'name' => 'simcard_balanceinquirytimer',
					'inputWidth' => 100,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['simcardinfo']['simcard_balanceinquirytimer']) ? $params['simcardinfo']['simcard_balanceinquirytimer'] : 30,
				);

				$params['tbFeatures'][] = array(
					'type' => 'input',
					'label' => 'BALANCE INQUIRY RETRY COUNTER',
					'labelWidth' => 245,
					'name' => 'simcard_balanceinquiryretrycounter',
					'inputWidth' => 100,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['simcardinfo']['simcard_balanceinquiryretrycounter']) ? $params['simcardinfo']['simcard_balanceinquiryretrycounter'] : 2,
				);

				$block = array();

				/*$block[] = array(
					'type' => 'checkbox',
					'label' => 'FAILED - Perform Balance Inquiry',
					'name' => 'simcard_failedbalanceinquiry',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 220,
					'checked' => !empty($params['simcardinfo']['simcard_failedbalanceinquiry']) ? $params['simcardinfo']['simcard_failedbalanceinquiry'] : 0,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);*/

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'NO CONFIRMATION - PERFORM BALANCE INQUIRY',
					'name' => 'simcard_noconfirmationbalanceinquiry',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 330,
					'checked' => !empty($params['simcardinfo']['simcard_noconfirmationbalanceinquiry']) ? $params['simcardinfo']['simcard_noconfirmationbalanceinquiry'] : 0,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$modemcommands = getModemCommands(1);

				foreach($modemcommands as $v) {
					$selected = false;
					if(!empty($params['simcardinfo']['simcard_failedbalanceinquirysimcommand'])&&$params['simcardinfo']['simcard_failedbalanceinquirysimcommand']==$v) {
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

				$block[] = array(
					'type' => 'combo',
					'name' => 'simcard_noconfirmationbalanceinquirysimcommand',
					'inputWidth' => 300,
					'readonly' => true,
					//'value' => !empty($params['simcardinfo']['simcard_noconfirmationbalanceinquirysimcommand']) ? $params['simcardinfo']['simcard_noconfirmationbalanceinquirysimcommand'] : '',
					'options' => $opt,
				);

				$params['tbFeatures'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbFeatures'][] = array(
					'type' => 'checkbox',
					'label' => 'STOP PROCESSING LOAD COMMAND',
					'name' => 'simcard_stopprocessingloadcommand',
					'readonly' => $readonly,
					'position' => 'label-right',
					'labelWidth' => 250,
					'checked' => !empty($params['simcardinfo']['simcard_stopprocessingloadcommand']) ? $params['simcardinfo']['simcard_stopprocessingloadcommand'] : 0,
				);

				$params['tbFeatures'][] = array(
					'type' => 'input',
					'label' => 'TIME LAPSED FOR LATE SMS (minutes)',
					'labelWidth' => 250,
					'name' => 'simcard_timelapsedforlatesms',
					'inputWidth' => 100,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['simcardinfo']['simcard_timelapsedforlatesms']) ? $params['simcardinfo']['simcard_timelapsedforlatesms'] : 60,
				);

				/*$params['tbSmsfunctions'][] = array(
					'type' => 'input',
					'label' => 'SMS FUNCTIONS',
					'name' => 'simcard_smsfunctions',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbSmsfunctions'][] = array(
					'type' => 'container',
					'name' => 'simcard_smsfunctions',
					'inputWidth' => 600,
					'inputHeight' => 200,
					'className' => 'simcard_smsfunctions_'.$post['formval'],
				);

				/*$params['tbTransactions'][] = array(
					'type' => 'input',
					'label' => 'TRANSACTIONS',
					'name' => 'simcard_transactions',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbTransactions'][] = array(
					'type' => 'container',
					'name' => 'simcard_transactions',
					'inputWidth' => 600,
					'inputHeight' => 200,
					'className' => 'simcard_transactions_'.$post['formval'],
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_inventorydetailsimcards

		function _form_inventorydetailitem($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='inventorynew'||$post['method']=='inventoryedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='inventoryedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_item where item_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['item_id'])) {
							$params['iteminfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='getnetwork') {

					$retval = array();
					$retval['network'] = getNetworkName($this->vars['post']['mobileno']);

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='inventorysave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Item successfully saved!';

					$content = array();
					$content['item_name'] = !empty($post['item_name']) ? $post['item_name'] : '';
					$content['item_code'] = !empty($post['item_code']) ? $post['item_code'] : '';
					$content['item_provider'] = !empty($post['item_provider']) ? $post['item_provider'] : '';
					$content['item_transactiontype'] = !empty($post['item_transactiontype']) ? $post['item_transactiontype'] : '';
					$content['item_quantity'] = !empty($post['item_quantity']) ? $post['item_quantity'] : 0;
					$content['item_cost'] = !empty($post['item_cost']) ? $post['item_cost'] : 0;
					$content['item_srp'] = !empty($post['item_srp']) ? $post['item_srp'] : 0;
					$content['item_eshopsrp'] = !empty($post['item_eshopsrp']) ? $post['item_eshopsrp'] : 0;
					$content['item_active'] = !empty($post['item_active']) ? 1 : 0;
					$content['item_checkprovider'] = !empty($post['item_checkprovider']) ? 1 : 0;
					$content['item_maintenance'] = !empty($post['item_maintenance']) ? 1 : 0;
					$content['item_maintenancenotification'] = !empty($post['item_maintenancenotification']) ? $post['item_maintenancenotification'] : '';

					if(!empty($content['item_maintenance'])) {
						$content['item_maintenancedaterangefrom'] = !empty($post['item_maintenancedaterangefrom']) ? $post['item_maintenancedaterangefrom'] : '';
						$content['item_maintenancedaterangeto'] = !empty($post['item_maintenancedaterangeto']) ? $post['item_maintenancedaterangeto'] : '';
						$content['item_maintenancedaterangefromunix'] = !empty($content['item_maintenancedaterangefrom']) ? date2timestamp($content['item_maintenancedaterangefrom'], getOption('$DISPLAY_DATE_FORMAT','r')) : 0;
						$content['item_maintenancedaterangetounix'] = !empty($content['item_maintenancedaterangeto']) ? date2timestamp($content['item_maintenancedaterangeto'], getOption('$DISPLAY_DATE_FORMAT','r')) : 0;
					} else {
						$content['item_maintenancedaterangefrom'] = '';
						$content['item_maintenancedaterangeto'] = '';
						$content['item_maintenancedaterangefromunix'] = 0;
						$content['item_maintenancedaterangetounix'] = 0;
					}

					$content['item_regularload'] = !empty($post['item_regularload']) ? 1 : 0;
					$content['item_regularloaddiscountscheme'] = !empty($post['item_regularloaddiscountscheme']) ? $post['item_regularloaddiscountscheme'] : '';
					$content['item_threshold'] = !empty($post['item_threshold']) ? $post['item_threshold'] : 0;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['item_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_item",$content,"item_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						$content['item_ymd'] = date('Ymd');

						if(!($result = $appdb->insert("tbl_item",$content,"item_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['item_id'])) {
							$retval['rowid'] = $result['returning'][0]['item_id'];
						}

					}

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_itemassignedsim where itemassignedsim_itemid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['itemassignedsim_seq'])&&is_array($post['itemassignedsim_seq'])) {
						foreach($post['itemassignedsim_seq'] as $k=>$v) {
							$content = array();
							$content['itemassignedsim_itemid'] = $retval['rowid'];
							$content['itemassignedsim_seq'] = !empty($post['itemassignedsim_seq'][$k]) ? $post['itemassignedsim_seq'][$k] : '';
							$content['itemassignedsim_simname'] = !empty($post['itemassignedsim_simname'][$k]) ? $post['itemassignedsim_simname'][$k] : '';
							$content['itemassignedsim_simnumber'] = getSimNumberByName($content['itemassignedsim_simname']);
							$content['itemassignedsim_simcommand'] = !empty($post['itemassignedsim_simcommand'][$k]) ? $post['itemassignedsim_simcommand'][$k] : '';
							$content['itemassignedsim_active'] = !empty($post['itemassignedsim_active'][$k]) ? 1 : 0;

							if(!($result = $appdb->insert("tbl_itemassignedsim",$content,"itemassignedsim_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					setOptionsItemCode();

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventorydelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Item successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_item where item_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							setOptionsItemCode();

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_item where item_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					setOptionsItemCode();

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

/*
		myTabbar.addTab("tbItem", "Item");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSimcommnads", "Assigned Sim and Sim Commands");
		myTabbar.addTab("tbSmsexpression", "SMS Expression");
		myTabbar.addTab("tbSmserror", "SMS Error");
*/

				$params['tbItem'] = array();
				$params['tbDetails'] = array();
				$params['tbSimcommands'] = array();
				$params['tbSmsexpression'] = array();
				$params['tbSmserror'] = array();

				$itemid = '';

				if(!empty($params['iteminfo']['item_id'])&&!empty($params['iteminfo']['item_ymd'])) {
					$itemid = $params['iteminfo']['item_ymd'] . sprintf('%04d', intval($params['iteminfo']['item_id']));
				}

				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'ITEM ID',
					'name' => 'item_id',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $itemid,
				);

				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'ITEM NAME',
					'name' => 'item_name',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['iteminfo']['item_name']) ? $params['iteminfo']['item_name'] : '',
				);

				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'TEXT CODE',
					'name' => 'item_code',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['iteminfo']['item_code']) ? $params['iteminfo']['item_code'] : '',
				);

				$providers = getProviders();

				$opt = array();

				foreach($providers as $v) {
					$selected = false;

					if(!empty($params['iteminfo']['item_provider'])&&$params['iteminfo']['item_provider']==$v) {
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

				$params['tbItem'][] = array(
					'type' => 'combo',
					'label' => 'PROVIDER',
					'name' => 'item_provider',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$opt = array();

				$category = array('SMART RETAIL','GLOBE RETAIL','SUN RETAIL');

				foreach($category as $v) {
					$selected = false;
					if(!empty($params['iteminfo']['item_transactiontype'])&&$params['iteminfo']['item_transactiontype']==$v) {
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

				$params['tbItem'][] = array(
					'type' => 'combo',
					'label' => 'TRANSACTION TYPE',
					'name' => 'item_transactiontype',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$params['tbItem'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'QUANTITY',
					'name' => 'item_quantity',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['iteminfo']['item_quantity']) ? $params['iteminfo']['item_quantity'] : '',
				);

				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'COST',
					'name' => 'item_cost',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['iteminfo']['item_cost']) ? $params['iteminfo']['item_cost'] : '',
				);

				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'SRP',
					'name' => 'item_srp',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['iteminfo']['item_srp']) ? $params['iteminfo']['item_srp'] : '',
				);


				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'eSHOP SRP',
					'name' => 'item_eshopsrp',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['iteminfo']['item_eshopsrp']) ? $params['iteminfo']['item_eshopsrp'] : '',
				);

				$params['tbItem'][] = array(
					'type' => 'input',
					'label' => 'THRESHOLD',
					'name' => 'item_threshold',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['iteminfo']['item_threshold']) ? $params['iteminfo']['item_threshold'] : '',
				);

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'FOR REGULAR LOAD',
					'labelWidth' => 130,
					'name' => 'item_regularload',
					'readonly' => $readonly,
					'checked' => !empty($params['iteminfo']['item_regularload']) ? true : false,
					'position' => 'label-right',
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				if($readonly) {

					$block[] = array(
						'type' => 'input',
						//'label' => 'eSHOP SRP',
						'name' => 'item_regularloaddiscountscheme',
						'readonly' => $readonly,
						'inputWidth' => 200,
						//'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['iteminfo']['item_regularloaddiscountscheme']) ? $params['iteminfo']['item_regularloaddiscountscheme'] : '',
					);

				} else {

					$opt = array();

					if(!$readonly) {
					  $opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$discountSchemes = getDiscountScheme();

					foreach($discountSchemes as $k=>$v) {
						$selected = false;
					  if(!empty($params['iteminfo']['item_regularloaddiscountscheme'])&&$params['iteminfo']['item_regularloaddiscountscheme']==$v['discount_desc']) {
					    $selected = true;
					  }
					  if($readonly) {
					    if($selected) {
					      $opt[] = array('text'=>$v['discount_desc'],'value'=>$v['discount_desc']['discount_desc'],'selected'=>$selected);
					    }
					  } else {
					    $opt[] = array('text'=>$v['discount_desc'],'value'=>$v['discount_desc'],'selected'=>$selected);
					  }
					}

					$block[] = array(
						'type' => 'combo',
						//'label' => 'RESEND DUPLICATE MESSAGE',
						//'labelWidth' => 210,
						'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'item_regularloaddiscountscheme',
						'readonly' => $readonly,
						'disabled' => !empty($params['iteminfo']['item_regularload']) ? false : true,
						//'required' => !$readonly,
						'options' => $opt,
					);

				}

				$params['tbItem'][] = array(
					'type' => 'block',
					'width' => 500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbItem'][] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'labelWidth' => 200,
					'name' => 'item_active',
					'readonly' => $readonly,
					'checked' => !empty($params['iteminfo']['item_active']) ? true : false,
					'position' => 'label-right',
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				$params['tbItem'][] = array(
					'type' => 'checkbox',
					'label' => 'CHECK PROVIDER',
					'labelWidth' => 200,
					'name' => 'item_checkprovider',
					'readonly' => $readonly,
					'checked' => !empty($params['iteminfo']['item_checkprovider']) ? true : false,
					'position' => 'label-right',
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);

				/*$params['tbItem'][] = array(
					'type' => 'checkbox',
					'label' => 'MAINTENANCE',
					'name' => 'item_maintenance',
					'readonly' => $readonly,
					'checked' => !empty($params['iteminfo']['item_maintenance']) ? true : false,
				);*/

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'MAINTENANCE',
					'labelWidth' => 106,
					'name' => 'item_maintenance',
					'readonly' => $readonly,
					'checked' => !empty($params['iteminfo']['item_maintenance']) ? true : false,
					'position' => 'label-right',
					'disabled' => false,
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				if($readonly) {

					$block[] = array(
						'type' => 'input',
						//'label' => 'eSHOP SRP',
						'name' => 'item_maintenancenotification',
						'readonly' => $readonly,
						//'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['iteminfo']['item_maintenancenotification']) ? $params['iteminfo']['item_maintenancenotification'] : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$lnotification = explode(',', !empty($params['iteminfo']['item_maintenancenotification']) ? $params['iteminfo']['item_maintenancenotification'] : '');

					foreach($allNotifications as $k=>$v) {
						$checked = false;

						if(in_array($v['notification_id'],$lnotification)) {
							$checked = true;
						}

						$opt[] = array('value'=>$v['notification_id'],'checked'=>$checked,'text'=>array(
							'notificationvalue' => !empty($v['notification_value']) ? $v['notification_value'] : ' '
						));
					}

					$params['maintenancenotificationopt'] = array(
						'opts'=>$opt,
						'value'=>!empty($params['iteminfo']['item_maintenancenotification']) ? $params['iteminfo']['item_maintenancenotification'] : ''
					);


					$block[] = array(
						'type' => 'combo',
						//'label' => 'RESEND DUPLICATE MESSAGE',
						//'labelWidth' => 210,
						//'inputWidth' => 200,
						'comboType' => 'checkbox',
						'name' => 'item_maintenancenotification',
						'readonly' => $readonly,
						'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				$params['tbItem'][] = array(
					'type' => 'block',
					'width' => 500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

/*
if($readonly) {
	$block[] = array(
		'type' => 'input',
		'label' => 'DATE',
		'name' => 'adjustment_datetime',
		'readonly' => $readonly,
		'required' => !$readonly,
		'value' => !empty($params['adjustmentinfo']['adjustment_datetime']) ? $params['adjustmentinfo']['adjustment_datetime'] : '',
	);
} else {
	$block[] = array(
		'type' => 'calendar',
		'label' => 'DATE',
		'name' => 'adjustment_datetime',
		'readonly' => true,
		'required' => !$readonly,
		'enableTime' => true,
		'enableTodayButton' => true,
		'calendarPosition' => 'right',
		'dateFormat' => '%m-%d-%Y %H:%i',
		'validate' => "NotEmpty",
		'value' => !empty($params['adjustmentinfo']['adjustment_datetime']) ? $params['adjustmentinfo']['adjustment_datetime'] : '',
	);
}
*/

				if($readonly) {
					$block[] = array(
						'type' => 'input',
						'label' => 'DATE RANGE',
						'name' => 'item_maintenancedaterangefrom',
						'readonly' => $readonly,
						'inputWidth' => 120,
						'value' => !empty($params['iteminfo']['item_maintenancedaterangefrom']) ? $params['iteminfo']['item_maintenancedaterangefrom'] : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						//'label' => 'eSHOP SRP',
						'name' => 'item_maintenancedaterangeto',
						'readonly' => $readonly,
						'inputWidth' => 120,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['iteminfo']['item_maintenancedaterangeto']) ? $params['iteminfo']['item_maintenancedaterangeto'] : '',
					);
				} else {

					/*$block[] = array(
						'type' => 'input',
						'label' => 'DATE RANGE',
						'name' => 'item_maintenancedaterangefrom',
						'readonly' => $readonly,
						'inputWidth' => 98,
						'value' => !empty($params['iteminfo']['item_maintenancedaterangefrom']) ? $params['iteminfo']['item_maintenancedaterangefrom'] : '',
					);*/

					$block[] = array(
						'type' => 'calendar',
						'label' => 'DATE RANGE',
						'name' => 'item_maintenancedaterangefrom',
						'readonly' => true,
						//'required' => !$readonly,
						'inputWidth' => 120,
						'enableTime' => true,
						'enableTodayButton' => true,
						'calendarPosition' => 'right',
						'dateFormat' => '%m-%d-%Y %H:%i',
						'validate' => "NotEmpty",
						'value' => !empty($params['iteminfo']['item_maintenancedaterangefrom']) ? $params['iteminfo']['item_maintenancedaterangefrom'] : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					/*$block[] = array(
						'type' => 'input',
						//'label' => 'eSHOP SRP',
						'name' => 'item_maintenancedaterangeto',
						'readonly' => $readonly,
						'inputWidth' => 98,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['iteminfo']['item_maintenancedaterangeto']) ? $params['iteminfo']['item_maintenancedaterangeto'] : '',
					);*/

					$block[] = array(
						'type' => 'calendar',
						//'label' => 'DATE RANGE',
						'name' => 'item_maintenancedaterangeto',
						'readonly' => true,
						//'required' => !$readonly,
						'inputWidth' => 120,
						'enableTime' => true,
						'enableTodayButton' => true,
						'calendarPosition' => 'right',
						'dateFormat' => '%m-%d-%Y %H:%i',
						'validate' => "NotEmpty",
						'value' => !empty($params['iteminfo']['item_maintenancedaterangeto']) ? $params['iteminfo']['item_maintenancedaterangeto'] : '',
					);

				}



				$params['tbItem'][] = array(
					'type' => 'block',
					'name' => 'item_maintenancedaterangeblock',
					'width' => 500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
					'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
				);

				$params['tbSimcommands'][] = array(
					'type' => 'container',
					'name' => 'item_simcommands',
					'inputWidth' => 600,
					'inputHeight' => 200,
					'className' => 'item_simcommands_'.$post['formval'],
				);

				$params['tbSmsexpression'][] = array(
					'type' => 'input',
					'label' => 'Expression',
					'name' => 'item_smsexpression',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => '',
				);

				$params['tbSmserror'][] = array(
					'type' => 'input',
					'label' => 'Error',
					'name' => 'item_smserror',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_inventorydetailitem

		function _form_inventorydetailstocks($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='inventorynew'||$this->vars['post']['method']=='inventoryedit')) {
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

		} // _form_inventorydetailstocks

		function _form_inventorydetailinstore($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='inventorynew'||$this->vars['post']['method']=='inventoryedit')) {
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

		} // _form_inventorydetailinstore

		function _form_inventorydetailadjustment($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				$method = false;

				$post = $this->vars['post'];

				$params = array();

				if(!empty($post['method'])&&($post['method']=='inventorynew'||$post['method']=='inventoryedit')) {
					$method = $post['method'];
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='inventoryedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_adjustment where adjustment_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$method = $post['method'];

						if(!empty($result['rows'][0]['adjustment_id'])) {
							$params['adjustmentinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='inventorysave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Adjustment successfully saved!';

					$content = array();
					$content['adjustment_datetime'] = $adjustment_datetime = !empty($post['adjustment_datetime']) ? $post['adjustment_datetime'] : '';
					$content['adjustment_datetimeunix'] = !empty($content['adjustment_datetime']) ? date2timestamp($content['adjustment_datetime'], getOption('$DISPLAY_DATE_FORMAT','r')) : 0;
					$content['adjustment_remarks'] = !empty($post['adjustment_remarks']) ? $post['adjustment_remarks'] : '';
					$content['adjustment_forcustomer'] = $adjustment_forcustomer = !empty($post['adjustment_forcustomer']) ? 1 : 0;
					$content['adjustment_forsimcard'] = $adjustment_forsimcard = !empty($post['adjustment_forsimcard']) ? 1 : 0;
					$content['adjustment_customerreceiptno'] = $adjustment_customerreceiptno = !empty($post['adjustment_customerreceiptno']) ? $post['adjustment_customerreceiptno'] : '';
					$content['adjustment_customerreceipt'] = $adjustment_customerreceipt = !empty($post['adjustment_customerreceipt']) ? $post['adjustment_customerreceipt'] : '';
					$content['adjustment_customername'] = $adjustment_customername = !empty($post['adjustment_customername']) ? $post['adjustment_customername'] : '';
					$content['adjustment_customermobileno'] = !empty($post['adjustment_customermobileno']) ? $post['adjustment_customermobileno'] : '';
					$content['adjustment_customerid'] = $adjustment_customerid = !empty($post['adjustment_customerid']) ? $post['adjustment_customerid'] : 0;
					$content['adjustment_customeritem'] = !empty($post['adjustment_customeritem']) ? $post['adjustment_customeritem'] : '';
					$content['adjustment_customeritemid'] = !empty($post['adjustment_customeritemid']) ? $post['adjustment_customeritemid'] : 0;
					$content['adjustment_customeramountdue'] = $adjustment_customeramountdue = !empty($post['adjustment_customeramountdue']) ? $post['adjustment_customeramountdue'] : 0;
					$content['adjustment_customercredit'] = $adjustment_customercredit = !empty($post['adjustment_customercredit']) ? 1 : 0;
					$content['adjustment_customerdebit'] = $adjustment_customerdebit = !empty($post['adjustment_customerdebit']) ? 1 : 0;
					$content['adjustment_simcardassignment'] = $adjustment_simcardassignment = !empty($post['adjustment_simcardassignment']) ? $post['adjustment_simcardassignment'] : '';
					$content['adjustment_simcarddatetime'] = $adjustment_simcarddatetime = !empty($post['adjustment_simcarddatetime']) ? $post['adjustment_simcarddatetime'] : '';
					$content['adjustment_simcarddatetimeunix'] = !empty($content['adjustment_simcarddatetime']) ? date2timestamp($content['adjustment_simcarddatetime'], getOption('$DISPLAY_DATE_FORMAT','r')) : 0;
					$content['adjustment_simcardreferenceno'] = $adjustment_simcardreferenceno = !empty($post['adjustment_simcardreferenceno']) ? $post['adjustment_simcardreferenceno'] : '';
					$content['adjustment_simcarditembalance'] = $adjustment_simcarditembalance = !empty($post['adjustment_simcarditembalance']) ? $post['adjustment_simcarditembalance'] : 0;
					$content['adjustment_simcardamountdue'] = $adjustment_simcardamountdue = !empty($post['adjustment_simcardamountdue']) ? $post['adjustment_simcardamountdue'] : 0;
					$content['adjustment_simcardcredit'] = $adjustment_simcardcredit = !empty($post['adjustment_simcardcredit']) ? 1 : 0;
					$content['adjustment_simcarddebit'] = $adjustment_simcarddebit = !empty($post['adjustment_simcarddebit']) ? 1 : 0;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['adjustment_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_adjustment",$content,"adjustment_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						$content['adjustment_ymd'] = $adjustment_ymd = date('Ymd');

						if(!($result = $appdb->insert("tbl_adjustment",$content,"adjustment_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['adjustment_id'])) {
							$retval['rowid'] = $result['returning'][0]['adjustment_id'];
						}

						if(!empty($retval['rowid'])) {

							// customer and simcard adjustment
							if($adjustment_forcustomer&&$adjustment_forsimcard&&!empty($adjustment_customerreceipt)) {

								$customer_type = getCustomerType($adjustment_customerid);

								$content = array();
								$content['ledger_adjustmentid'] = $retval['rowid'];

								if($adjustment_customercredit) {
									$content['ledger_credit'] = $adjustment_customeramountdue;
								} else
								if($adjustment_customerdebit) {
									$content['ledger_debit'] = $adjustment_customeramountdue;
								}

								$content['ledger_type'] = 'ADJUSTMENT';
								$content['ledger_datetime'] = $adjustment_datetime;
								$content['ledger_user'] = $adjustment_customerid;
								$content['ledger_receiptno'] = $adjustment_customerreceiptno;
								$content['ledger_loadtransactionid'] = $adjustment_customerreceipt;

								$content['ledger_datetimeunix'] = date2timestamp($content['ledger_datetime'], getOption('$DISPLAY_DATE_FORMAT','r'));

								if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

								if($customer_type=='STAFF') {
									computeStaffBalance($adjustment_customerid);
								} else {
									computeCustomerBalance($adjustment_customerid);
								}

								if(!empty($result['returning'][0]['ledger_id'])) {
									$retval['ledgerid'] = $result['returning'][0]['ledger_id'];
								}

								if(!empty($retval['ledgerid'])) {

									$content = getLoadTransaction(0,$adjustment_customerreceipt);

									unset($content['loadtransaction_id']);
									unset($content['loadtransaction_createstamp']);
									unset($content['loadtransaction_execstamp']);
									unset($content['loadtransaction_updatestamp']);
									unset($content['loadtransaction_balanceinquirystamp']);
									unset($content['loadtransaction_createstampunix']);

									$content['loadtransaction_ymd'] = $loadtransaction_ymd = date('Ymd');
									$content['loadtransaction_type'] = 'adjustment';
									$content['loadtransaction_adjustmentcredit'] = $adjustment_simcardcredit;
									$content['loadtransaction_adjustmentdebit'] = $adjustment_simcarddebit;
									$content['loadtransaction_assignedsim'] = $adjustment_simcardassignment;
									$content['loadtransaction_createstamp'] = $content['loadtransaction_updatestamp'] = $adjustment_simcarddatetime ;
									$content['loadtransaction_createstampunix'] = date2timestamp($adjustment_simcarddatetime, getOption('$DISPLAY_DATE_FORMAT','r'));
									$content['loadtransaction_refnumber'] = $adjustment_simcardreferenceno;
									$content['loadtransaction_simcardbalance'] = $adjustment_simcarditembalance;
									$content['loadtransaction_amountdue'] = $adjustment_simcardamountdue;
									$content['loadtransaction_status'] = TRN_COMPLETED;

									if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {
										json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
										die;
									}

									if(!empty($result['returning'][0]['loadtransaction_id'])) {
										$retval['loadtransactionid'] = $result['returning'][0]['loadtransaction_id'];
									}

								}

							} else
							if($adjustment_forcustomer) { // customer adjustment

								$customer_type = getCustomerType($adjustment_customerid);

								$content = array();
								$content['ledger_adjustmentid'] = $retval['rowid'];

								if($adjustment_customercredit) {
									$content['ledger_credit'] = $adjustment_customeramountdue;
								} else
								if($adjustment_customerdebit) {
									$content['ledger_debit'] = $adjustment_customeramountdue;
								}

								$receiptno = 'EADJ'.$adjustment_ymd . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($retval['rowid']));

								$content['ledger_type'] = 'ADJUSTMENT';
								$content['ledger_datetime'] = $adjustment_datetime;
								$content['ledger_user'] = $adjustment_customerid;
								$content['ledger_receiptno'] = $receiptno;
								//$content['ledger_loadtransactionid'] = $adjustment_customerreceipt;

								$content['ledger_datetimeunix'] = date2timestamp($content['ledger_datetime'], getOption('$DISPLAY_DATE_FORMAT','r'));

								if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

								if($customer_type=='STAFF') {
									computeStaffBalance($adjustment_customerid);
								} else {
									computeCustomerBalance($adjustment_customerid);
								}

								if(!empty($result['returning'][0]['ledger_id'])) {
									$retval['ledgerid'] = $result['returning'][0]['ledger_id'];
								}

							} else
							if($adjustment_forsimcard) { // simcard adjustment

								$content = array();

								$content['loadtransaction_ymd'] = $loadtransaction_ymd = date('Ymd');
								$content['loadtransaction_type'] = 'adjustment';
								$content['loadtransaction_adjustmentcredit'] = $adjustment_simcardcredit;
								$content['loadtransaction_adjustmentdebit'] = $adjustment_simcarddebit;
								$content['loadtransaction_assignedsim'] = $adjustment_simcardassignment;
								$content['loadtransaction_createstamp'] = $content['loadtransaction_updatestamp'] = $adjustment_simcarddatetime ;
								$content['loadtransaction_createstampunix'] = date2timestamp($adjustment_simcarddatetime, getOption('$DISPLAY_DATE_FORMAT','r'));
								$content['loadtransaction_refnumber'] = $adjustment_simcardreferenceno;
								$content['loadtransaction_simcardbalance'] = $adjustment_simcarditembalance;
								$content['loadtransaction_amountdue'] = $adjustment_simcardamountdue;
								$content['loadtransaction_status'] = TRN_COMPLETED;

								if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

								if(!empty($result['returning'][0]['loadtransaction_id'])) {
									$retval['loadtransactionid'] = $result['returning'][0]['loadtransaction_id'];
								}


							}

						} // if(!empty($retval['rowid'])) {

					} // if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventorydelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Adjustment successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_adjustment where adjustment_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_adjustment where adjustment_id=".$post['rowid']))) {
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

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				$block = array();

				$receiptno = 'auto generated';

				if(!empty($params['adjustmentinfo']['adjustment_id'])&&!empty($params['adjustmentinfo']['adjustment_ymd'])) {
					$receiptno = 'EADJ'.$params['adjustmentinfo']['adjustment_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['adjustmentinfo']['adjustment_id']));
				}

				$block[] = array(
					'type' => 'input',
					'label' => 'ADJUSTMENT NO.',
					'name' => 'adjustment_number',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => $receiptno,
				);

				//if($method=='onrowselect') {
				if($readonly) {
					$block[] = array(
						'type' => 'input',
						'label' => 'DATE',
						'name' => 'adjustment_datetime',
						'readonly' => $readonly,
						'required' => !$readonly,
						'value' => !empty($params['adjustmentinfo']['adjustment_datetime']) ? $params['adjustmentinfo']['adjustment_datetime'] : '',
					);
				} else {
					$block[] = array(
						'type' => 'calendar',
						'label' => 'DATE',
						'name' => 'adjustment_datetime',
						'readonly' => true,
						'required' => !$readonly,
						'enableTime' => true,
						'enableTodayButton' => true,
						'calendarPosition' => 'right',
						'dateFormat' => '%m-%d-%Y %H:%i',
						'validate' => "NotEmpty",
						'value' => !empty($params['adjustmentinfo']['adjustment_datetime']) ? $params['adjustmentinfo']['adjustment_datetime'] : '',
					);
				}

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$block[] = array(
					'type' => 'input',
					'label' => 'CASHIER',
					'name' => 'adjustment_cashier',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => '',
				);

				$block[] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'adjustment_status',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REMARKS',
					'name' => 'adjustment_remarks',
					'readonly' => $readonly,
					'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 580,
					'value' => !empty($params['adjustmentinfo']['adjustment_remarks']) ? $params['adjustmentinfo']['adjustment_remarks'] : '',
				);

				$block = array();

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 150,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'CUSTOMER ADJUSTMENT',
					'labelWidth' => 200,
					'name' => 'adjustment_forcustomer',
					'readonly' => $readonly,
					'checked' => !empty($params['adjustmentinfo']['adjustment_forcustomer']) ? true : false,
					'position' => 'label-right',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'SIMCARD ADJUSTMENT',
					'labelWidth' => 200,
					'name' => 'adjustment_forsimcard',
					'readonly' => $readonly,
					'checked' => !empty($params['adjustmentinfo']['adjustment_forsimcard']) ? true : false,
					'position' => 'label-right',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbDetails'][] = array(
					'type' => 'label',
					'label' => 'CUSTOMER ADJUSTMENT DETAILS',
					'labelWidth' => 500,
				);

				$block = array();

				if($readonly) {
					$block[] = array(
						'type' => 'input',
						'label' => 'RECEIPT NO.',
						'name' => 'adjustment_customerreceipt',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'value' => !empty($params['adjustmentinfo']['adjustment_customerreceipt']) ? $params['adjustmentinfo']['adjustment_customerreceipt'] : '',
					);
				} else {

					$block[] = array(
						'type' => 'hidden',
						'name' => 'adjustment_customerreceiptno',
						'value' => '',
					);

					$block[] = array(
						'type' => 'combo',
						'label' => 'RECEIPT NO.',
						'name' => 'adjustment_customerreceipt',
						'readonly' => $readonly,
						'options' => array(), //$opt,
					);
				}

				if($readonly) {
					$block[] = array(
						'type' => 'input',
						'label' => 'CUSTOMER',
						'name' => 'adjustment_customername',
						'readonly' => $readonly,
						'required' => !$readonly,
						'value' => !empty($params['adjustmentinfo']['adjustment_customername']) ? $params['adjustmentinfo']['adjustment_customername'] : '',
					);
				} else {

					$block[] = array(
						'type' => 'hidden',
						'name' => 'adjustment_customername',
						'value' => '',
					);

					$block[] = array(
						'type' => 'combo',
						'label' => 'CUSTOMER',
						'name' => 'adjustment_customerid',
						'readonly' => $readonly,
						'required' => !$readonly,
						'options' => array(), //$opt,
					);
				}

				$block[] = array(
					'type' => 'input',
					'label' => 'ITEM',
					'name' => 'adjustment_customeritem',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['adjustmentinfo']['adjustment_customeritem']) ? $params['adjustmentinfo']['adjustment_customeritem'] : '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$block[] = array(
					'type' => 'input',
					'label' => 'MOBILE NUMBER',
					'name' => 'adjustment_customermobileno',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['adjustmentinfo']['adjustment_customermobileno']) ? $params['adjustmentinfo']['adjustment_customermobileno'] : '',
				);

				$block[] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'adjustment_customeramountdue',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['adjustmentinfo']['adjustment_customeramountdue']) ? $params['adjustmentinfo']['adjustment_customeramountdue'] : 0,
				);

				$block2 = array();

				if($method=='inventorynew') {
					$block2[] = array(
						'type' => 'checkbox',
						'label' => 'CREDIT',
						'labelWidth' => 100,
						'name' => 'adjustment_customercredit',
						'readonly' => $readonly,
						'checked' => true,
						'position' => 'label-right',
					);
				} else {
					$block2[] = array(
						'type' => 'checkbox',
						'label' => 'CREDIT',
						'labelWidth' => 100,
						'name' => 'adjustment_customercredit',
						'readonly' => $readonly,
						'checked' => !empty($params['adjustmentinfo']['adjustment_customercredit']) ? true : false,
						'position' => 'label-right',
					);
				}

				$block2[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block2[] = array(
					'type' => 'checkbox',
					'label' => 'DEBIT',
					'labelWidth' => 100,
					'name' => 'adjustment_customerdebit',
					'readonly' => $readonly,
					'checked' => !empty($params['adjustmentinfo']['adjustment_customerdebit']) ? true : false,
					'position' => 'label-right',
				);

				$block[] = array(
					'type' => 'block',
					'width' => 400,
					'blockOffset' => 0,
					'offsetTop' => 0,
					'list' => $block2,
				);

				if($method=='onrowselect') {
					$params['tbDetails'][] = array(
						'type' => 'block',
						'name' => 'adjustment_blockcustomer',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'block',
						'name' => 'adjustment_blockcustomer',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
						'disabled' => !empty($params['adjustmentinfo']['adjustment_forcustomer']) ? false : true,
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'label',
					'label' => 'SIMCARD ADJUSTMENT DETAILS',
					'labelWidth' => 500,
				);

				$block = array();

				if($readonly) {
					$block[] = array(
						'type' => 'input',
						'label' => 'ASSIGNED TO SIM',
						'name' => 'adjustment_simcardassignment',
						'readonly' => $readonly,
						'required' => !$readonly,
						'numeric' => true,
						'value' => !empty($params['adjustmentinfo']['adjustment_simcardassignment']) ? $params['adjustmentinfo']['adjustment_simcardassignment'] : '',
					);
				} else {
					$block[] = array(
						'type' => 'combo',
						'label' => 'ASSIGNED TO SIM',
						'name' => 'adjustment_simcardassignment',
						'readonly' => $readonly,
						'options' => array(), //$opt,
					);
				}

				if($method=='onrowselect') {
					$block[] = array(
						'type' => 'input',
						'label' => 'DATE',
						'name' => 'adjustment_simcarddatetime',
						'readonly' => $readonly,
						'required' => !$readonly,
						'value' => !empty($params['adjustmentinfo']['adjustment_simcarddatetime']) ? $params['adjustmentinfo']['adjustment_simcarddatetime'] : '',
					);
				} else {
					$block[] = array(
						'type' => 'calendar',
						'label' => 'DATE',
						'name' => 'adjustment_simcarddatetime',
						'readonly' => true,
						'required' => !$readonly,
						'enableTime' => true,
						'enableTodayButton' => true,
						'calendarPosition' => 'right',
						'dateFormat' => '%m-%d-%Y %H:%i',
						'validate' => "NotEmpty",
					);
				}

				/*$block[] = array(
					'type' => 'input',
					'label' => 'DATE',
					'name' => 'adjustment_simcarddatetime',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$block[] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO.',
					'name' => 'adjustment_simcardreferenceno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['adjustmentinfo']['adjustment_simcardreferenceno']) ? $params['adjustmentinfo']['adjustment_simcardreferenceno'] : '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$block[] = array(
					'type' => 'input',
					'label' => 'SIMCARD BALANCE',
					'name' => 'adjustment_simcarditembalance',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['adjustmentinfo']['adjustment_simcarditembalance']) ? $params['adjustmentinfo']['adjustment_simcarditembalance'] : 0,
				);

				$block[] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'name' => 'adjustment_simcardamountdue',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['adjustmentinfo']['adjustment_simcardamountdue']) ? $params['adjustmentinfo']['adjustment_simcardamountdue'] : 0,
				);

				$block2 = array();

				if($method=='inventorynew') {
					$block2[] = array(
						'type' => 'checkbox',
						'label' => 'CREDIT',
						'labelWidth' => 100,
						'name' => 'adjustment_simcardcredit',
						'readonly' => $readonly,
						'checked' => true,
						'position' => 'label-right',
					);
				} else {
					$block2[] = array(
						'type' => 'checkbox',
						'label' => 'CREDIT',
						'labelWidth' => 100,
						'name' => 'adjustment_simcardcredit',
						'readonly' => $readonly,
						'checked' => !empty($params['adjustmentinfo']['adjustment_simcardcredit']) ? true : false,
						'position' => 'label-right',
					);
				}

				$block2[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block2[] = array(
					'type' => 'checkbox',
					'label' => 'DEBIT',
					'labelWidth' => 100,
					'name' => 'adjustment_simcarddebit',
					'readonly' => $readonly,
					'checked' => !empty($params['adjustmentinfo']['adjustment_simcarddebit']) ? true : false,
					'position' => 'label-right',
				);

				$block[] = array(
					'type' => 'block',
					'width' => 400,
					'blockOffset' => 0,
					'offsetTop' => 0,
					'list' => $block2,
				);

				if($method=='onrowselect') {
					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
						'name' => 'adjustment_blocksimcard',
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
						'name' => 'adjustment_blocksimcard',
						'disabled' => !empty($params['adjustmentinfo']['adjustment_forsimcard']) ? false : true,
					);
				}


				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_inventorydetailadjustment

		function _form_inventorydetailcashfund($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$readonly = true;

				$params = array();

				if(!empty($post['method'])&&($post['method']=='inventorynew'||$post['method']=='inventoryedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='inventoryedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_cashfund where cashfund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['cashfund_id'])) {
							$params['cashfundinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='inventorysave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Cash fund successfully saved!';

					$retval['post'] = $post;

					$retval['cashbreakdown'] = json_decode($post['cashbreakdown']);

					$content = array();
					$content['cashfund_totalcashfund'] = !empty($post['cashfund_totalcashfund']) ? $post['cashfund_totalcashfund'] : 0;
					$content['cashfund_user'] = !empty($post['cashfund_user']) ? $post['cashfund_user'] : 0;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['cashfund_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_cashfund",$content,"cashfund_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_cashfund",$content,"cashfund_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['cashfund_id'])) {
							$retval['rowid'] = $result['returning'][0]['cashfund_id'];
						}

					}

					if(!empty($retval['rowid'])) {

						if(!($result = $appdb->query("delete from tbl_cashfundlist where cashfundlist_cashfundid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!($result = $appdb->query("delete from tbl_ledger where ledger_cashfundid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($post['cashfundlist_type'])&&is_array($post['cashfundlist_type'])) {
							foreach($post['cashfundlist_type'] as $k=>$v) {

								$content = array();
								$content['cashfundlist_cashfundid'] = $retval['rowid'];
								$content['cashfundlist_seq'] = !empty($post['cashfundlist_seq'][$k]) ? $post['cashfundlist_seq'][$k] : '0';
								$content['cashfundlist_type'] = !empty($post['cashfundlist_type'][$k]) ? $post['cashfundlist_type'][$k] : '';
								$content['cashfundlist_datetime'] = !empty($post['cashfundlist_datetime'][$k]) ? $post['cashfundlist_datetime'][$k] : '';
								$content['cashfundlist_totalamount'] = !empty($post['cashfundlist_totalamount'][$k]) ? $post['cashfundlist_totalamount'][$k] : '';
								$content['cashfundlist_user'] = !empty($post['cashfund_user']) ? $post['cashfund_user'] : '0';
								$content['cashfundlist_breakdown'] = !empty($post['cashfundlist_breakdown'][$k]) ? $post['cashfundlist_breakdown'][$k] : '';

								$content['cashfundlist_datetimeunix'] = date2timestamp($content['cashfundlist_datetime'], getOption('$DISPLAY_DATE_FORMAT','r'));

								if(!($result = $appdb->insert("tbl_cashfundlist",$content,"cashfundlist_cashfundid"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

								$content = array();
								$content['ledger_cashfundid'] = $retval['rowid'];
								$content['ledger_credit'] = !empty($post['cashfundlist_totalamount'][$k]) ? $post['cashfundlist_totalamount'][$k] : '';
								$content['ledger_type'] = !empty($post['cashfundlist_type'][$k]) ? $post['cashfundlist_type'][$k] : '';
								$content['ledger_datetime'] = !empty($post['cashfundlist_datetime'][$k]) ? $post['cashfundlist_datetime'][$k] : '';
								$content['ledger_user'] = !empty($post['cashfund_user']) ? $post['cashfund_user'] : '0';
								$content['ledger_seq'] = !empty($post['cashfundlist_seq'][$k]) ? $post['cashfundlist_seq'][$k] : '0';

								$content['ledger_datetimeunix'] = date2timestamp($content['ledger_datetime'], getOption('$DISPLAY_DATE_FORMAT','r'));

								if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

							}

						}

						computeStaffBalance($post['cashfund_user']);

						/*if(!($result = $appdb->query("delete from tbl_cashfundbreakdown where cashfundbreakdown_cashfundid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}*/
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='inventorydelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Cash fund successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_cashfund where cashfund_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_cashfund where cashfund_id=".$post['rowid']))) {
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

/*
		myTabbar.addTab("tbSimcards", "Sim Card");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");
*/

				/*$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$fundtype = array('INITIAL FUND','ADDITIONAL FUND');

				foreach($fundtype as $v) {
					$selected = false;
					if(!empty($params['cashfundinfo']['cashfund_type'])&&$params['cashfundinfo']['cashfund_type']==$v) {
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
					'label' => 'TYPE',
					'name' => 'cashfund_type',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);*/

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STAFF',
						'name' => 'cashfund_user',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['cashfundinfo']['cashfund_user']) ? getCustomerNameByID($params['cashfundinfo']['cashfund_user']) : '',
					);
				} else {

					if(!empty($params['cashfundinfo']['cashfund_user'])) {
						$params['tbDetails'][] = array(
							'type' => 'hidden',
							'name' => 'cashfund_user',
							'value' => $params['cashfundinfo']['cashfund_user'],
						);

						$params['tbDetails'][] = array(
							'type' => 'input',
							'label' => 'STAFF',
							'name' => 'cashfund_username',
							'readonly' => true,
							//'required' => !$readonly,
							'value' => getCustomerNameByID($params['cashfundinfo']['cashfund_user']),
						);
					} else {
						$params['tbDetails'][] = array(
							'type' => 'combo',
							'label' => 'STAFF',
							'name' => 'cashfund_user',
							'readonly' => $readonly,
							'required' => !$readonly,
							'options' => array(), //$opt,
						);
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'TOTAL CASH FUND',
					'name' => 'cashfund_totalcashfund',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['cashfundinfo']['cashfund_totalcashfund']) ? $params['cashfundinfo']['cashfund_totalcashfund'] : '',
				);

				$block = array();

				$block[] = array(
					'type' => 'container',
					'name' => 'cashfund_fundlist',
					'inputWidth' => 550,
					'inputHeight' => 280,
					'className' => 'cashfund_fundlist_'.$post['formval'],
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 10,
				);

				$block[] = array(
					'type' => 'container',
					'name' => 'cashfund_breakdown',
					'inputWidth' => 550,
					'inputHeight' => 280,
					'className' => 'cashfund_breakdown_'.$post['formval'],
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'cashfund_block',
					'width' => 1150,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_inventorydetailcashfund

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

					$toolbar = false;

					if(!empty($this->post['wid'])) {
						if(!empty($toolbar = $this->_toolbar($this->post['routerid'], $this->post['module']))) {
						}
					}

					//pre(array('post'=>$this->post));

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
					if($this->post['table']=='simcards') {
						if(!($result = $appdb->query("select *,case when simcard_active=0 then 'no' when simcard_active=1 then 'yes' end as simcard_status,case when simcard_online=0 then 'no' when simcard_online=1 then 'yes' end as simcard_online,case when simcard_paused=0 then 'no' when simcard_paused=1 then 'yes' end as simcard_paused from tbl_simcard order by simcard_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['simcard_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$simcardid = $v['simcard_ymd'] . sprintf('%04d', $v['simcard_id']);

								$signal = !empty($v['simcard_comport']) ? getOption('SIGNAL_'.$v['simcard_number'],'') : '';

								$rows[] = array('id'=>$v['simcard_id'],'active'=>$v['simcard_active'],'data'=>array(0,$simcardid,$v['simcard_name'],$v['simcard_number'],$v['simcard_provider'],$v['simcard_category'],$v['simcard_ipaddress'],$signal,$v['simcard_comport'],$v['simcard_balance'],$v['simcard_status'],$v['simcard_online'],$v['simcard_paused']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='item') {
//myGrid.setHeader("#master_checkbox, Item ID, Name, Code, Provider, Type, Quantity, Cost, Active");

						if(!($result = $appdb->query("select *,case when item_active=0 then 'no' when item_active=1 then 'yes' end as item_status from tbl_item order by item_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['item_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$itemid = $v['item_ymd'] . sprintf('%04d', $v['item_id']);

								$rows[] = array('id'=>$v['item_id'],'active'=>$v['item_active'],'data'=>array(0,$itemid,$v['item_name'],$v['item_code'],$v['item_provider'],$v['item_transactiontype'],$v['item_quantity'],$v['item_cost'],$v['item_status']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='cashfund') {

						if(!($result = $appdb->query("select * from tbl_cashfund order by cashfund_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['cashfund_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['cashfund_id'],'data'=>array(0,$v['cashfund_id'],pgDate($v['cashfund_createstamp']),getCustomerNameByID($v['cashfund_user']),$v['cashfund_totalcashfund']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='cashfundlist') {

						if(!($result = $appdb->query("select * from tbl_cashfundlist where cashfundlist_cashfundid=".$this->post['rowid']." order by cashfundlist_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$rows = array();

						$seq = 1;

						$fundtype = array('ADDITIONAL FUND');

						$optfundtype = array(array('text'=>'','value'=>''));

						foreach($fundtype as $k=>$v) {
							$optfundtype[] = array('text'=>$v,'value'=>$v);
						}

						if(!empty($result['rows'][0]['cashfundlist_id'])) {

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$seq,'data'=>array($seq,$v['cashfundlist_type'],$v['cashfundlist_datetime'],$v['cashfundlist_totalamount'],'readonly'));
								$seq++;
							}

						}

						for($i=0;$i<10;$i++) {
							if(empty($rows)) {
								$rows[] = array('id'=>$seq,'fundtype'=>array('options'=>$optfundtype),'data'=>array($seq,'BEGINNING CASH',pgDateUnix(time()),'0.00',''));
							} else {
								$rows[] = array('id'=>$seq,'fundtype'=>array('options'=>$optfundtype),'data'=>array($seq,'','','',''));
							}
							$seq++;
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='cashfundbreakdown') {

					} else
					if($this->post['table']=='assignedsim') {

						$ctr = 1;

						$seq = 0;

						$rows = array();

						$asim = getAllSims(3);

						$assignedsim = array();

						if(!($result = $appdb->query("select * from tbl_itemassignedsim where itemassignedsim_itemid=".$this->post['rowid']." order by itemassignedsim_seq asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$modemcommands = array();

						if(($modemcommands = getModemCommands(1))) {
						} else {
							$modemcommands = array();
						}

						$optflg = false;

						if(!empty($result['rows'][0]['itemassignedsim_id'])) {

							//pre(array('$asim'=>$asim));

							//pre(array('$result'=>$result));


							foreach($result['rows'] as $k=>$v) {
								//$assignedsim[$v['itemassignedsim_simnumber']] = $v;
								if(!empty($asim[$v['itemassignedsim_simnumber']])) {
									$seq = intval($v['itemassignedsim_seq']);

									$row = array('id'=>$ctr,'data'=>array($seq,$v['itemassignedsim_active'],getSimNameByNumber($v['itemassignedsim_simnumber']),$v['itemassignedsim_simcommand']));

									if(!$optflg) {
										$opt = array(array('text'=>'','value'=>''));

										foreach($modemcommands as $x) {
											$opt[] = array('text'=>$x,'value'=>$x);
										}

										$row['options'] = array('options'=>$opt);
										$optflg = true;
									}

									$rows[] = $row;

									unset($asim[$v['itemassignedsim_simnumber']]);

									$ctr++;
								}
							}
						}

						$seq++;

						if(!empty($asim)) {
							foreach($asim as $k=>$v) {
								if(!empty($v['simcard_id'])) {

									$row = array('id'=>$ctr,'data'=>array($seq,0,$v['simcard_name'],' '));

									if(!$optflg) {
										$opt = array(array('text'=>'','value'=>''));

										foreach($modemcommands as $x) {
											$opt[] = array('text'=>$x,'value'=>$x);
										}

										$row['options'] = array('options'=>$opt);
										$optflg = true;
									}

									$rows[] = $row;

									$ctr++;

									$seq++;
								}
							}
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='smsfunctions') {

						if(!($result = $appdb->query("select * from tbl_simcardfunctions where simcardfunctions_simcardid=".$this->post['rowid']." order by simcardfunctions_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$ctr=1;
						$max=10;

						$rows = array();

						$loadcommands = getLoadCommands();
						$modemcommands = getModemCommands(1);

						$optloadcommands = array(array('text'=>'','value'=>''));
						$optmodemcommands = array(array('text'=>'','value'=>''));

						foreach($loadcommands as $k=>$v) {
							$optloadcommands[] = array('text'=>$v['smscommands_name'],'value'=>$v['smscommands_name']);
						}

						foreach($modemcommands as $k=>$v) {
							$optmodemcommands[] = array('text'=>$v,'value'=>$v);
						}

						if(!empty($result['rows'][0]['simcardfunctions_id'])) {
							foreach($result['rows'] as $k=>$v) {
								//$rows[] = array('id'=>$ctr,'data'=>array($ctr,htmlentities(getLoadCommandName($v['simcardfunctions_loadcommandid'])),$v['simcardfunctions_modemcommandsname']));
								//$rows[] = array('id'=>$ctr,'loadcommands'=>array('options'=>$optloadcommands),'modemcommands'=>array('options'=>$optmodemcommands),'simcardfunctions_loadcommandid'=>htmlentities(getLoadCommandName($v['simcardfunctions_loadcommandid'])),'data'=>array($ctr,$v['simcardfunctions_loadcommandid'],$v['simcardfunctions_modemcommandsname']));
								$rows[] = array('id'=>$ctr,'loadcommands'=>array('options'=>$optloadcommands),'modemcommands'=>array('options'=>$optmodemcommands),'data'=>array($ctr,htmlentities(getLoadCommandName($v['simcardfunctions_loadcommandid'])),$v['simcardfunctions_modemcommandsname']));
								$ctr++;
								$max++;
							}
						}

						while($ctr<=$max) {
							$rows[] = array('id'=>$ctr,'loadcommands'=>array('options'=>$optloadcommands),'modemcommands'=>array('options'=>$optmodemcommands),'data'=>array($ctr,'',''));
							$ctr++;
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='simcardtransactions') {

						$simcard = getSimCardByID($this->post['rowid']);

						//pre(array('$simcard'=>$simcard));

						$simcard_number = $simcard['simcard_number'];

						if(!empty($simcard_number)) {

							if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_assignedsim='$simcard_number' and loadtransaction_type in ('smartpadala','retail','adjustment') order by loadtransaction_createstampunix desc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['rows'][0]['loadtransaction_id'])) {
								$rows = array();

								foreach($result['rows'] as $k=>$v) {

									if($v['loadtransaction_status']==TRN_COMPLETED||$v['loadtransaction_status']==TRN_COMPLETED_MANUALLY) {
									} else {
										continue;
									}

									$prefix = '';
									$in = 0;
									$out = 0;

									if($v['loadtransaction_type']=='smartpadala') {
										$prefix = 'SP';
										$in = $v['loadtransaction_amount'];
									} else
									if($v['loadtransaction_type']=='retail') {
										$prefix = 'RL';
										$out = $v['loadtransaction_amountdue'];
									} else
									if($v['loadtransaction_type']=='adjustment') {
										$prefix = 'EADJ';
										if(!empty($v['loadtransaction_adjustmentdebit'])) {
											$out = $v['loadtransaction_amountdue'];
										} else
										if(!empty($v['loadtransaction_adjustmentcredit'])) {
											$in = $v['loadtransaction_amountdue'];
										}
									}

									$transid = $prefix . $v['loadtransaction_ymd'] . sprintf('%04d', $v['loadtransaction_id']);

									$rows[] = array('id'=>$v['loadtransaction_id'],'simcardbalance'=>$v['loadtransaction_simcardbalance'],'runningbalance'=>$v['loadtransaction_runningbalance'],'data'=>array($v['loadtransaction_id'],pgDateUnix($v['loadtransaction_createstampunix'], 'm-d-Y H:i:s'),$v['loadtransaction_datetime'],pgDate($v['loadtransaction_createstamp'],'m-d-Y'),pgDate($v['loadtransaction_createstamp'],'H:i'),$transid,$v['loadtransaction_customername'],$v['loadtransaction_refnumber'],$v['loadtransaction_customernumber'],$v['loadtransaction_recipientnumber'],strtoupper($v['loadtransaction_type']),getLoadTransactionStatusString($v['loadtransaction_status']),number_format($v['loadtransaction_servicecharge'],2),number_format($v['loadtransaction_transferfee'],2),number_format($v['loadtransaction_processingfee'],2),number_format($in,2),number_format($out,2),number_format($v['loadtransaction_simcardbalance'],2),number_format($v['loadtransaction_runningbalance'],2)));
								}

								$retval = array('rows'=>$rows);
							}


						}

					} else
					if($this->post['table']=='adjustment') {
						if(!($result = $appdb->query("select * from tbl_adjustment order by adjustment_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['adjustment_id'])) {
							$rows = array();

							$receiptno = '';

							foreach($result['rows'] as $k=>$v) {

								if(!empty($v['adjustment_id'])&&!empty($v['adjustment_ymd'])) {
									$receiptno = 'EADJ'.$v['adjustment_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['adjustment_id']));
								}

								$rows[] = array('id'=>$v['adjustment_id'],'data'=>array(0,$receiptno,$v['adjustment_datetime'],$v['adjustment_forcustomer'],$v['adjustment_forsimcard']));
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

	$appappinventory = new APP_app_inventory;
}

# eof modules/app.user
