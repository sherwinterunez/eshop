<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* App Smart Money Module
*
* Date: August 5, 2017 3:45pm
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

if(!class_exists('APP_app_smartmoney')) {

	class APP_app_smartmoney extends APP_Base_Ajax {

		var $desc = 'SmartMoney';

		var $pathid = 'smartmoney';
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

			$appaccess->rules($this->desc,'Smart Money Module');

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

		function _form_smartmoneymainservicefees($routerid=false,$formid=false) {
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

		} // _form_smartmoneymainservicefees

		function _form_smartmoneymainmoneytransfer($routerid=false,$formid=false) {
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

		} // _form_smartmoneymainmoneytransfer

		function _form_smartmoneymainsettings($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				$post = $this->vars['post'];

				$params = array();

				$smartmoneysettings_smartpadalaservicefees = getOption('$SMARTMONEYSETTINGS_SMARTPADALASERVICEFEES',false);
				$smartmoneysettings_topupservicefees = getOption('$SMARTMONEYSETTINGS_TOPUPSERVICEFEES',false);
				$smartmoneysettings_paymayaservicefees = getOption('$SMARTMONEYSETTINGS_PAYMAYASERVICEFEES',false);
				$smartmoneysettings_pickupanywhereservicefees = getOption('$SMARTMONEYSETTINGS_PICKUPANYWHERESERVICEFEES',false);

				if(!empty($post['method'])&&$post['method']=='smartmoneyedit') {
					$readonly = false;
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave') {
					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Smart Money Settings successfully saved!';

					setSetting('$SMARTMONEYSETTINGS_SMARTPADALASERVICEFEES',!empty($post['smartmoneysettings_smartpadalaservicefees'])?$post['smartmoneysettings_smartpadalaservicefees']:false);
					setSetting('$SMARTMONEYSETTINGS_TOPUPSERVICEFEES',!empty($post['smartmoneysettings_topupservicefees'])?$post['smartmoneysettings_topupservicefees']:false);
					setSetting('$SMARTMONEYSETTINGS_PAYMAYASERVICEFEES',!empty($post['smartmoneysettings_paymayaservicefees'])?$post['smartmoneysettings_paymayaservicefees']:false);
					setSetting('$SMARTMONEYSETTINGS_PICKUPANYWHERESERVICEFEES',!empty($post['smartmoneysettings_pickupanywhereservicefees'])?$post['smartmoneysettings_pickupanywhereservicefees']:false);

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'SMART PADALA SERVICE FEES',
						'labelWidth' => 300,
						'name' => 'smartmoneysettings_smartpadalaservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_smartpadalaservicefees) ? $smartmoneysettings_smartpadalaservicefees : '',
					);
				} else {

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$serviceFees = getSmartMoneyServiceFees();

					foreach($serviceFees as $k=>$v) {
						$selected = false;
						if(!empty($smartmoneysettings_smartpadalaservicefees)&&$smartmoneysettings_smartpadalaservicefees==$v['smartmoneyservicefees_desc']) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
							}
						} else {
							$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
						}
					}

					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'SMART PADALA SERVICE FEES',
						'labelWidth' => 300,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_smartpadalaservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);
				}

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'TOP-UP SERVICE FEES',
						'labelWidth' => 300,
						'name' => 'smartmoneysettings_topupservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_topupservicefees) ? $smartmoneysettings_topupservicefees : '',
					);
				} else {

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$serviceFees = getSmartMoneyServiceFees();

					foreach($serviceFees as $k=>$v) {
						$selected = false;
						if(!empty($smartmoneysettings_topupservicefees)&&$smartmoneysettings_topupservicefees==$v['smartmoneyservicefees_desc']) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
							}
						} else {
							$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
						}
					}

					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'TOP-UP SERVICE FEES',
						'labelWidth' => 300,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_topupservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);
				}

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'PAYMAYA SERVICE FEES',
						'labelWidth' => 300,
						'name' => 'smartmoneysettings_paymayaservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_paymayaservicefees) ? $smartmoneysettings_paymayaservicefees : '',
					);
				} else {

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$serviceFees = getSmartMoneyServiceFees();

					foreach($serviceFees as $k=>$v) {
						$selected = false;
						if(!empty($smartmoneysettings_paymayaservicefees)&&$smartmoneysettings_paymayaservicefees==$v['smartmoneyservicefees_desc']) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
							}
						} else {
							$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
						}
					}

					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'PAYMAYA SERVICE FEES',
						'labelWidth' => 300,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_paymayaservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);
				}

				if($readonly) {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'PICK-UP ANYWHERE SERVICE FEES',
						'labelWidth' => 300,
						'name' => 'smartmoneysettings_pickupanywhereservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_pickupanywhereservicefees) ? $smartmoneysettings_pickupanywhereservicefees : '',
					);
				} else {

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$serviceFees = getSmartMoneyServiceFees();

					foreach($serviceFees as $k=>$v) {
						$selected = false;
						if(!empty($smartmoneysettings_pickupanywhereservicefees)&&$smartmoneysettings_pickupanywhereservicefees==$v['smartmoneyservicefees_desc']) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
							}
						} else {
							$opt[] = array('text'=>$v['smartmoneyservicefees_desc'],'value'=>$v['smartmoneyservicefees_desc'],'selected'=>$selected);
						}
					}

					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'PICK-UP ANYWHERE SERVICE FEES',
						'labelWidth' => 300,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_pickupanywhereservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);
				}

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_smartmoneymainsettings

		function _form_smartmoneydetailservicefees($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				$params = array();

				$post = $this->vars['post'];

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='smartmoneynew'||$this->vars['post']['method']=='smartmoneyedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='smartmoneyedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_smartmoneyservicefees where smartmoneyservicefees_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['smartmoneyservicefees_id'])) {
							$params['servicefeeinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Service fee successfully saved!';

					$content = array();
					$content['smartmoneyservicefees_desc'] = !empty($post['smartmoneyservicefees_desc']) ? $post['smartmoneyservicefees_desc'] : '';
					$content['smartmoneyservicefees_sendcommissionpercentage'] = !empty($post['smartmoneyservicefees_sendcommissionpercentage']) ? 1 : 0;
					$content['smartmoneyservicefees_receivecommissionpercentage'] = !empty($post['smartmoneyservicefees_receivecommissionpercentage']) ? 1 : 0;
					$content['smartmoneyservicefees_transferfeepercentage'] = !empty($post['smartmoneyservicefees_transferfeepercentage']) ? 1 : 0;
					$content['smartmoneyservicefees_active'] = !empty($post['smartmoneyservicefees_active']) ? 1 : 0;

					//pre(array('$post'=>$post));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['smartmoneyservicefees_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_smartmoneyservicefees",$content,"smartmoneyservicefees_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_smartmoneyservicefees",$content,"smartmoneyservicefees_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['smartmoneyservicefees_id'])) {
							$retval['rowid'] = $result['returning'][0]['smartmoneyservicefees_id'];
						}

					}

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_smartmoneyservicefeeslist where smartmoneyservicefeeslist_smartmoneyservicefeesid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['smartmoneyservicefeeslist_minamount'])&&is_array($post['smartmoneyservicefeeslist_minamount'])) {
						foreach($post['smartmoneyservicefeeslist_minamount'] as $k=>$v) {
							$content = array();
							$content['smartmoneyservicefeeslist_smartmoneyservicefeesid'] = $retval['rowid'];
							$content['smartmoneyservicefeeslist_minamount'] = !empty($post['smartmoneyservicefeeslist_minamount'][$k]) ? trim(str_replace(',','',$post['smartmoneyservicefeeslist_minamount'][$k])) : 0;
							$content['smartmoneyservicefeeslist_maxamount'] = !empty($post['smartmoneyservicefeeslist_maxamount'][$k]) ? trim(str_replace(',','',$post['smartmoneyservicefeeslist_maxamount'][$k])) : 0;
							$content['smartmoneyservicefeeslist_sendcommission'] = !empty($post['smartmoneyservicefeeslist_sendcommission'][$k]) ? trim(str_replace(',','',$post['smartmoneyservicefeeslist_sendcommission'][$k])) : 0;
							$content['smartmoneyservicefeeslist_receivecommission'] = !empty($post['smartmoneyservicefeeslist_receivecommission'][$k]) ? trim(str_replace(',','',$post['smartmoneyservicefeeslist_receivecommission'][$k])) : 0;
							$content['smartmoneyservicefeeslist_transferfee'] = !empty($post['smartmoneyservicefeeslist_transferfee'][$k]) ? trim(str_replace(',','',$post['smartmoneyservicefeeslist_transferfee'][$k])) : 0;

							if(!($result = $appdb->insert("tbl_smartmoneyservicefeeslist",$content,"smartmoneyservicefeeslist_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneydelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Smart Money Service fees successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_smartmoneyservicefees where smartmoneyservicefees_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!($result = $appdb->query("delete from tbl_smartmoneyservicefeeslist where smartmoneyservicefeeslist_smartmoneyservicefeesid in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_smartmoneyservicefees where smartmoneyservicefees_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!($result = $appdb->query("delete from tbl_smartmoneyservicefeeslist where smartmoneyservicefeeslist_smartmoneyservicefeesid=".$post['rowid']))) {
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

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DESCRIPTION',
					'name' => 'smartmoneyservicefees_desc',
					'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['servicefeeinfo']['smartmoneyservicefees_desc']) ? $params['servicefeeinfo']['smartmoneyservicefees_desc'] : '',
				);

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'smartmoneyservicefees_active',
					'readonly' => $readonly,
					'checked' => !empty($params['servicefeeinfo']['smartmoneyservicefees_active'])  ? true : false,
					'position' => 'label-right',
					'labelWidth' => 80,
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'SEND COMMISSION IN PERCENTAGE',
					'name' => 'smartmoneyservicefees_sendcommissionpercentage',
					'readonly' => $readonly,
					'checked' => !empty($params['servicefeeinfo']['smartmoneyservicefees_sendcommissionpercentage'])  ? true : false,
					'position' => 'label-right',
					'labelWidth' => 270,
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'TRANSFER FEE IN PERCENTAGE',
					'name' => 'smartmoneyservicefees_transferfeepercentage',
					'readonly' => $readonly,
					'checked' => !empty($params['servicefeeinfo']['smartmoneyservicefees_transferfeepercentage'])  ? true : false,
					'position' => 'label-right',
					'labelWidth' => 250,
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'RECEIVE COMMISSION IN PERCENTAGE',
					'name' => 'smartmoneyservicefees_receivecommissionpercentage',
					'readonly' => $readonly,
					'checked' => !empty($params['servicefeeinfo']['smartmoneyservicefees_receivecommissionpercentage'])  ? true : false,
					'position' => 'label-right',
					'labelWidth' => 250,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbDetails'][] = array(
					'type' => 'container',
					'name' => 'servicefees_container',
					'inputWidth' => 900,
					'inputHeight' => 200,
					'className' => 'servicefees_container_'.$post['formval'],
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_smartmoneydetailservicefees

		function _form_smartmoneydetailmoneytransfer($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				$params = array();

				$post = $this->vars['post'];

				$userId = $applogin->getUserID();
				$userData = $applogin->getUserData();

				if(!empty($userData['user_staffid'])) {
					$user_staffid = $userData['user_staffid'];
					$customer_type = getCustomerType($userData['user_staffid']);
				}

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='smartmoneynew'||$this->vars['post']['method']=='smartmoneyedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&$post['method']=='getsenderdata') {

					$senderid = !empty($post['senderid']) ? $post['senderid'] : false;

					$retval = array();
					$retval['error_code'] = '345325';
					$retval['error_message'] = 'Invalid Sender ID!';

					if(!empty($senderid)) {
					} else {
						json_encode_return($retval);
						die;
					}

					$sql = "select * from tbl_remitcust where remitcust_id=$senderid";

					if(!($result = $appdb->query($sql))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					if(!empty($result['rows'][0]['remitcust_id'])) {
						$remitcust = $result['rows'][0];

						$sql = "select * from tbl_remitcustnumber where remitcustnumber_remitcustid=$senderid order by remitcustnumber_id asc limit 1";

						if(!($result = $appdb->query($sql))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['remitcustnumber_mobileno'])) {

							$address = '';

							// remitcust_pahouseno | remitcust_pabarangay | remitcust_pamunicipality | remitcust_paprovince | remitcust_pazipcode

							if(!empty($remitcust['remitcust_pahouseno'])) {
								$address .= trim($remitcust['remitcust_pahouseno']).' ';
							}

							if(!empty($remitcust['remitcust_pabarangay'])) {
								$address .= trim($remitcust['remitcust_pabarangay']).' ';
							}

							if(!empty($remitcust['remitcust_pamunicipality'])) {
								$address .= trim($remitcust['remitcust_pamunicipality']).' ';
							}

							if(!empty($remitcust['remitcust_paprovince'])) {
								$address .= trim($remitcust['remitcust_paprovince']).' ';
							}

							if(!empty($remitcust['remitcust_pazipcode'])) {
								$address .= trim($remitcust['remitcust_pazipcode']).' ';
							}

							$remitcustnumber_mobileno = $result['rows'][0]['remitcustnumber_mobileno'];

							$retval = array();
							$retval['post'] = $post;
							$retval['data'] = array(
								'senderaddress'=>trim($address),
								'sendernumber'=>$remitcustnumber_mobileno,
								'senderidtype'=>$remitcust['remitcust_idtype'],
								'senderspecifyid'=>$remitcust['remitcust_specifyid'],
								'senderidnumber'=>$remitcust['remitcust_idnumber'],
								'senderidexpiration'=>$remitcust['remitcust_idexpiration'],
							);

						}
					}


					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='getservicefee') {

					$transaction = array();

					$transaction['PADALA'] = getOption('$SMARTMONEYSETTINGS_SMARTPADALASERVICEFEES',false);
					$transaction['TOPUP'] = getOption('$SMARTMONEYSETTINGS_TOPUPSERVICEFEES',false);
					$transaction['PAYMAYA'] = getOption('$SMARTMONEYSETTINGS_PAYMAYASERVICEFEES',false);
					$transaction['PICKUP'] = getOption('$SMARTMONEYSETTINGS_PICKUPANYWHERESERVICEFEES',false);

					$cardno = !empty($post['cardno']) ? $post['cardno'] : false;
					$transactiontype = !empty($post['transactiontype']) ? $post['transactiontype'] : false;
					$amount = !empty($post['amount'])&&is_numeric($post['amount']) ? $post['amount'] : false;

					$retval = array();
					$retval['error_code'] = '345345';
					$retval['error_message'] = 'Invalid Amount!';

					if(!empty($amount)&&$amount>=100) {
					} else {
						json_encode_return($retval);
						die;
					}

					$retval = array();
					$retval['error'] = true;
					//$retval['error_message'] = 'Invalid Card/Mobile Number!';

					if(isSmartMoneyCardNo($cardno)) {
					} else {
						if(isSmartMobileNo($cardno)) {
						} else {
							json_encode_return($retval);
							die;
						}
					}

					$retval = array();
					$retval['error_code'] = '345378';
					$retval['error_message'] = 'Invalid/No Service Fee!';
					$retval['post'] = $post;

					if(!empty($transactiontype)&&!empty($transaction[$transactiontype])) {
						$servicefee = $transaction[$transactiontype];
					} else {
						json_encode_return($retval);
						die;
					}

					$fees = getSmartMoneyServiceFee($servicefee,$amount);

					if(!empty($fees)) {
					} else {
						json_encode_return($retval);
						die;
					}

					$retval = array();
					$retval['fees'] = $fees;

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneynew') {

					$retval = array();

					if(!empty($customer_type)&&$customer_type=='STAFF') {

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
				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='smartmoneyedit'||$post['method']=='smartmoneyapproved'||$post['method']=='smartmoneymanually'||$post['method']=='smartmoneycancelled'||$post['method']=='smartmoneyhold'||$post['method']=='smartmoneytransfer')) {
				//if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='loadedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['loadtransaction_id'])) {
							$params['smartmoneyinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave'&&!empty($post['rowid'])) {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Smart Money Transfer successfully updated!';

					if(!empty($post['retail_status'])) {
						$content = array();
						$content['loadtransaction_status'] = $post['retail_status'];
						$content['loadtransaction_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave') {

					$retval = array();
					$retval['error_code'] = '345345';
					$retval['error_message'] = 'Invalid Card/Mobile Number!';

					$loadtransaction_cardno = !empty($post['loadtransaction_cardno']) ? $post['loadtransaction_cardno'] : false;
					$loadtransaction_amount = !empty($post['loadtransaction_amount'])&&is_numeric($post['loadtransaction_amount']) ? intval(str_replace(',','',$post['loadtransaction_amount'])) : false;
					$loadtransaction_cashreceived = !empty($post['loadtransaction_cashreceived'])&&is_numeric($post['loadtransaction_cashreceived']) ? $post['loadtransaction_cashreceived'] : false;
					$loadtransaction_assignedsim = !empty($post['loadtransaction_assignedsim']) ? $post['loadtransaction_assignedsim'] : false;

					if(isSmartMoneyCardNo($loadtransaction_cardno)) {
					} else {
						if(isSmartMobileNo($loadtransaction_cardno)) {
						} else {
							json_encode_return($retval);
							die;
						}
					}

					$retval = array();
					$retval['error_code'] = '345346';
					$retval['error_message'] = 'Invalid Amount!';

					if(!empty($loadtransaction_amount)) {
					} else {
						json_encode_return($retval);
						die;
					}

					$retval = array();
					$retval['error_code'] = '345347';
					$retval['error_message'] = 'Invalid Cash Received!';

					if(!empty($loadtransaction_cashreceived)) {
						if($loadtransaction_cashreceived>=$loadtransaction_amount) {
						} else {
							json_encode_return($retval);
							die;
						}
					} else {
						json_encode_return($retval);
						die;
					}

					$smartmoney_sendernumber = !empty($post['smartmoney_sendernumber']) ? $post['smartmoney_sendernumber'] : '';
					$smartmoney_receivernumber = !empty($post['smartmoney_receivernumber']) ? $post['smartmoney_receivernumber'] : '';
					$smartmoney_transactiontype = !empty($post['smartmoney_transactiontype']) ? $post['smartmoney_transactiontype'] : '';

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SmartMoney Remittance successfully saved!';
					$retval['post'] = $post;

					//$message = "SMARTMONEY PADALA $loadtransaction_cardno $loadtransaction_amount $smartmoney_sendernumber $smartmoney_receivernumber <STATUS> <LOADTRANSACTIONID>\r\n";

					$status = 'APPROVED';

					$message = "SMARTMONEY $smartmoney_transactiontype $loadtransaction_cardno $loadtransaction_amount $smartmoney_sendernumber $smartmoney_receivernumber $status <LOADTRANSACTIONID>\r\n";

					$content = array();
					$content['loadtransaction_ymd'] = $loadtransaction_ymd = date('Ymd');
					$content['loadtransaction_customerid'] = !empty($post['smartmoney_sendername']) ? $post['smartmoney_sendername'] : 0;
					$content['loadtransaction_customernumber'] = $smartmoney_sendernumber;
					//$content['loadtransaction_customername'] = getCustomerNickByNumber($loadtransaction_customernumber);
					//$content['loadtransaction_simhotline'] = $loadtransaction_simhotline;
					$content['loadtransaction_keyword'] = $message;
					$content['loadtransaction_recipientnumber'] = $smartmoney_receivernumber;
					$content['loadtransaction_destcardno'] = $loadtransaction_cardno;
					$content['loadtransaction_smartmoneytype'] = $smartmoney_transactiontype;
					$content['loadtransaction_amount'] = $loadtransaction_amount;
					$content['loadtransaction_amountdue'] = !empty($post['loadtransaction_amountdue']) ? str_replace(',','',$post['loadtransaction_amountdue']) : 0;
					$content['loadtransaction_cashreceived'] = !empty($post['loadtransaction_cashreceived']) ? str_replace(',','',$post['loadtransaction_cashreceived']) : 0;
					$content['loadtransaction_changed'] = !empty($post['loadtransaction_changed']) ? str_replace(',','',$post['loadtransaction_changed']) : 0;
					$content['loadtransaction_sendagentcommissionamount'] = !empty($post['smartmoney_sendagentcommissionamount']) ? str_replace(',','',$post['smartmoney_sendagentcommissionamount']) : 0;
					$content['loadtransaction_transferfeeamount'] = !empty($post['smartmoney_transferfeeamount']) ? str_replace(',','',$post['smartmoney_transferfeeamount']) : 0;
					$content['loadtransaction_receiveagentcommissionamount'] = !empty($post['smartmoney_receiveagentcommissionamount']) ? str_replace(',','',$post['smartmoney_receiveagentcommissionamount']) : 0;
					$content['loadtransaction_otherchargesamount'] = !empty($post['smartmoney_otherchargesamount']) ? str_replace(',','',$post['smartmoney_otherchargesamount']) : 0;
					//$content['loadtransaction_load'] = $item_quantity;
					//$content['loadtransaction_cost'] = $item_cost;
					//$content['loadtransaction_provider'] = $loadtransaction_provider;
					//$content['loadtransaction_assignedsim'] = $loadtransaction_assignedsim;
					//$content['loadtransaction_simcommand'] = $loadtransaction_simcommand;
					$content['loadtransaction_type'] = 'smartmoney';
					$content['loadtransaction_status'] = TRN_DRAFT;
					//$content['loadtransaction_itemthreshold'] = $item_threshold;

					if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					if(!empty($result['returning'][0]['loadtransaction_id'])) {
						$retval['rowid'] = $loadtransaction_id = $result['returning'][0]['loadtransaction_id'];
					}

					if(!empty($retval['rowid'])) {
						$message = str_replace('<LOADTRANSACTIONID>',$loadtransaction_id,$message);

						$content = array();
						$content['loadtransaction_keyword'] = $message;

						if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction_id))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$asims = getAllSims(10);

						if(!empty($asims[0]['simcard_number'])) {
							$hotlime = $asims[0]['simcard_number'];
						} else {
							$retval = array();
			        $retval['error_code'] = '3453431';
			        $retval['error_message'] = 'There is no Sim Hot Line!';

			        json_encode_return($retval);
			        die;
						}

						$content = array();

						if(!empty($user_staffid)) {
							$content['smsinbox_contactsid'] = $user_staffid;
						}

						$content['smsinbox_contactnumber'] = $smartmoney_sendernumber;
						$content['smsinbox_simnumber'] = $hotlime; //'09197708008';
						$content['smsinbox_message'] = $message;
						$content['smsinbox_unread'] = 1;

						//pre(array('$content'=>$content));

						ob_start();

						processSMS($content);

						$out = ob_get_clean();

						$retval['out'] = $out;

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

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				//$transactiontype = array('SMART PADALA','TOP-UP','PAYMAYA','PICK-UP ANYWHERE');

				$transactiontype = array('PADALA','TOPUP','PAYMAYA','PICKUP');

				foreach($transactiontype as $v) {
					$selected = false;
					if(!empty($params['moneytransferinfo']['transaction_type'])&&$params['moneytransferinfo']['transaction_type']==$v) {
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
					'label' => 'TRANSACTION TYPE',
					'name' => 'smartmoney_transactiontype',
					'labelWidth' => 200,
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CARD/MOBILE NUMBER',
					'name' => 'loadtransaction_cardno',
					'labelWidth' => 200,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'combo',
					'label' => 'CARD/MOBILE NUMBER',
					'name' => 'loadtransaction_cardno',
					'labelWidth' => 200,
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'options' => array(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'loadtransaction_amount',
					'labelWidth' => 200,
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['moneytransferinfo']['loadtransaction_amount']) ? number_format($params['moneytransferinfo']['loadtransaction_amount'],2) : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'sendagentcommissionblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 450,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'SEND AGENT COMMISSION',
							'name' => 'smartmoney_sendagentcommissionpercent',
							'labelWidth' => 200,
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_sendagentcommissionpercent']) ? number_format($params['moneytransferinfo']['loadtransaction_sendagentcommissionpercent'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'smartmoney_sendagentcommissionamount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_sendagentcommissionamount']) ? number_format($params['moneytransferinfo']['loadtransaction_sendagentcommissionamount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'transferfeeblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 450,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'TRANSFER FEE',
							'name' => 'smartmoney_transferfeepercent',
							'labelWidth' => 200,
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_transferfeepercent']) ? number_format($params['moneytransferinfo']['loadtransaction_transferfeepercent'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'smartmoney_transferfeeamount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_transferfeeamount']) ? number_format($params['moneytransferinfo']['loadtransaction_transferfeeamount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'receiveagentcommissionblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 450,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'RECEIVE AGENT COMMISSION',
							'name' => 'smartmoney_receiveagentcommissionpercent',
							'labelWidth' => 200,
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_receiveagentcommissionpercent']) ? number_format($params['moneytransferinfo']['loadtransaction_receiveagentcommissionpercent'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'smartmoney_receiveagentcommissionamount',
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_receiveagentcommissionamount']) ? number_format($params['moneytransferinfo']['loadtransaction_receiveagentcommissionamount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'name' => 'otherchargesblock',
					'blockOffset' => 0,
					'offsetTop' => 0,
					'width' => 450,
					'list' => array(
						array(
							'type' => 'input',
							'label' => 'OTHER CHARGES',
							'name' => 'smartmoney_otherchargespercent',
							'labelWidth' => 200,
							'readonly' => true,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($percent) ? number_format($percent,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_otherchargespercent']) ? number_format($params['moneytransferinfo']['loadtransaction_otherchargespercent'],2) : '',
							'inputWidth' => 90,
						),
						array(
							'type' => 'newcolumn',
							'offset' => 5,
						),
						array(
							'type' => 'input',
							'name' => 'smartmoney_otherchargesamount',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
							//'value' => !empty($discount) ? number_format($discount,2) : 0,
							'value' => !empty($params['moneytransferinfo']['loadtransaction_otherchargesamount']) ? number_format($params['moneytransferinfo']['loadtransaction_otherchargesamount'],2) : '',
							'inputWidth' => 100,
						),
					),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT DUE',
					'labelWidth' => 200,
					//'inputWidth' => 100,
					'name' => 'loadtransaction_amountdue',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => '',
				);


				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CASH RECEIVED',
					'labelWidth' => 200,
					//'inputWidth' => 100,
					'name' => 'loadtransaction_cashreceived',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CHANGE',
					'labelWidth' => 200,
					//'inputWidth' => 100,
					'name' => 'loadtransaction_changed',
					'readonly' => true,
					//'required' => !$readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => '',
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				$assignedsim = array('AUTOMATIC');

				foreach($assignedsim as $v) {
					$selected = false;
					if(!empty($params['moneytransferinfo']['loadtransaction_assignedsim'])&&$params['moneytransferinfo']['loadtransaction_assignedsim']==$v) {
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
					'label' => 'ASSIGNED SIM CARD',
					'labelWidth' => 200,
					//'inputWidth' => 100,
					'name' => 'loadtransaction_assignedsim',
					'readonly' => true,
					//'required' => !$readonly,
					//'value' => '',
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NAME',
					'name' => 'smartmoney_sendername',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'combo',
					'label' => 'SENDER NAME',
					'name' => 'smartmoney_sendername',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					//'numeric' => true,
					'options' => array(),
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER ADDRESS',
					'name' => 'smartmoney_senderaddress',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NUMBER',
					'name' => 'smartmoney_sendernumber',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				$idtype = array('VOTER\'S ID','DRIVER\'S LICENSE','SSS','GSIS','COMPANY ID','OTHERS');

				foreach($idtype as $v) {
					$selected = false;
					if(!empty($params['moneytransferinfo']['smartmoney_idtype'])&&$params['moneytransferinfo']['smartmoney_idtype']==$v) {
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
					'label' => 'ID TYPE',
					'name' => 'smartmoney_idtype',
					'labelWidth' => 150,
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SPECIFY ID',
					'name' => 'smartmoney_specifyid',
					'labelWidth' => 150,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID NUMBER',
					'name' => 'smartmoney_idnumber',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'EXPIRATION DATE',
					'name' => 'smartmoney_idexpiration',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);*/

				$params['tbDetails'][] = array(
					'type' => 'calendar',
					'label' => 'EXPIRATION DATE',
					'name' => 'smartmoney_idexpiration',
					'labelWidth' => 150,
					'readonly' => true,
					'calendarPosition' => 'right',
					'dateFormat' => '%m-%d-%Y',
					//'required' => !$readonly,
					'value' => !empty($params['moneytransferinfo']['smartmoney_idexpiration']) ? $params['moneytransferinfo']['smartmoney_idexpiration'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIVER NUMBER',
					'name' => 'smartmoney_receivernumber',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => 40,
				);

				$receiptno = '';

				if(!empty($params['moneytransferinfo']['loadtransaction_id'])&&!empty($params['moneytransferinfo']['loadtransaction_ymd'])) {
					$receiptno = $params['moneytransferinfo']['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['moneytransferinfo']['loadtransaction_id']));
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'name' => 'smartmoney_receiptno',
					'readonly' => true,
					'inputWidth' => 150,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'name' => 'smartmoney_date',
					'readonly' => true,
					'inputWidth' => 150,
					//'required' => !$readonly,
					'value' => !empty($params['moneytransferinfo']['loadtransaction_createstamp']) ? pgDate($params['moneytransferinfo']['loadtransaction_createstamp']) : '',
				);

				$fund_username = !empty($params['moneytransferinfo']['loadtransaction_staffid']) ? getCustomerNameByID($params['moneytransferinfo']['loadtransaction_staffid']) : '';

				if(!empty($fund_username)) {
				} else {
					$fund_username = !empty($params['moneytransferinfo']['loadtransaction_username']) ? $params['moneytransferinfo']['loadtransaction_username'] : $applogin->fullname();
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'USER',
					'name' => 'fund_username',
					'readonly' => true,
					'inputWidth' => 150,
					//'required' => !$readonly,
					//'value' => $applogin->fullname(),
					'value' => $fund_username,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS CODE',
					'name' => 'retail_status',
					'readonly' => true,
					'inputWidth' => 150,
					//'required' => !$readonly,
					//'value' => TRN_DRAFT,
					'value' => !empty($params['moneytransferinfo']['loadtransaction_status']) ? $params['moneytransferinfo']['loadtransaction_status'] : TRN_DRAFT,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'STATUS',
					'name' => 'retail_statustext',
					'readonly' => true,
					'inputWidth' => 150,
					//'required' => !$readonly,
					'value' => !empty($params['moneytransferinfo']['loadtransaction_status']) ? getLoadTransactionStatusString($params['moneytransferinfo']['loadtransaction_status']) : getLoadTransactionStatusString(TRN_DRAFT),
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_smartmoneydetailmoneytransfer

		function _form_discountdetailrebate($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='discountnew'||$this->vars['post']['method']=='discountedit')) {
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

		} // _form_discountdetailrebate

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
					if($this->post['table']=='scheme') {
						if(!($result = $appdb->query("select * from tbl_discount order by discount_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['discount_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['discount_id'],'data'=>array(0,$v['discount_id'],$v['discount_desc'],$v['discount_active']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='discountscheme') {
						if(!($result = $appdb->query("select * from tbl_discountlist where discountlist_discountid=".$this->post['rowid']." order by discountlist_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						$rows = array();

						$type = array('RETAIL','DEALER','CUSTOMER RELOAD','FUND RELOAD','CHILD RELOAD','FUND TRANSFER');
						$provider = getProviders();
						$simcard = getAllSims(8);
						$opttype = array(array('text'=>'','value'=>''));
						$optprovider = array(array('text'=>'','value'=>''));
						$optsimcard = array(array('text'=>'','value'=>''));
						$rowid = 1;

						foreach($type as $k=>$v) {
							$opttype[] = array('text'=>$v,'value'=>$v);
						}

						foreach($provider as $k=>$v) {
							$optprovider[] = array('text'=>$v,'value'=>$v);
						}

						foreach($simcard as $k=>$v) {
							$optsimcard[] = array('text'=>$v,'value'=>$v);
						}

						if(!empty($result['rows'][0]['discountlist_id'])) {

							foreach($result['rows'] as $k=>$v) {
								//$rows[] = array('id'=>$v['discountlist_id'],'type'=>$type,'provider'=>$provider,'simcard'=>$simcard,'data'=>array(0,$v['discountlist_id'],$v['discountlist_type'],$v['discountlist_provider'],$v['discountlist_simcard'],$v['discountlist_fee'],$v['discountlist_amount'],$v['discountlist_rate'],$v['discountlist_min'],$v['discountlist_max']));
								$rows[] = array('id'=>$rowid,'type'=>array('options'=>$opttype),'provider'=>array('options'=>$optprovider),'simcard'=>array('options'=>$optsimcard),'data'=>array($rowid,$v['discountlist_type'],$v['discountlist_provider'],getSimNameByNumber($v['discountlist_simcard']),$v['discountlist_fee'],$v['discountlist_amount'],$v['discountlist_rate'].' %',$v['discountlist_min'],$v['discountlist_max']));
								$rowid++;
							}

						}

						for($i=0;$i<10;$i++) {
							$rows[] = array('id'=>$rowid,'type'=>array('options'=>$opttype),'provider'=>array('options'=>$optprovider),'simcard'=>array('options'=>$optsimcard),'data'=>array($rowid,'','','','','','','',''));
							$rowid++;
						}

						if(!empty($rows)) {
							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='servicefees') {
						if(!($result = $appdb->query("select * from tbl_smartmoneyservicefees order by smartmoneyservicefees_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['smartmoneyservicefees_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['smartmoneyservicefees_id'],'data'=>array(0,$v['smartmoneyservicefees_id'],$v['smartmoneyservicefees_desc'],$v['smartmoneyservicefees_active']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='servicefeeslist') {
						if(!($result = $appdb->query("select * from tbl_smartmoneyservicefeeslist where smartmoneyservicefeeslist_smartmoneyservicefeesid=".$this->post['rowid']." order by smartmoneyservicefeeslist_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						$rows = array();

						$rowid = 1;

						/*$type = array('RETAIL','DEALER','CUSTOMER RELOAD','FUND RELOAD','CHILD RELOAD','FUND TRANSFER');
						$provider = getProviders();
						$simcard = getAllSims(8);
						$opttype = array(array('text'=>'','value'=>''));
						$optprovider = array(array('text'=>'','value'=>''));
						$optsimcard = array(array('text'=>'','value'=>''));

						foreach($type as $k=>$v) {
							$opttype[] = array('text'=>$v,'value'=>$v);
						}

						foreach($provider as $k=>$v) {
							$optprovider[] = array('text'=>$v,'value'=>$v);
						}

						foreach($simcard as $k=>$v) {
							$optsimcard[] = array('text'=>$v,'value'=>$v);
						}*/

						if(!empty($result['rows'][0]['smartmoneyservicefeeslist_id'])) {

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$rowid,'data'=>array($rowid,number_format($v['smartmoneyservicefeeslist_minamount'],2),number_format($v['smartmoneyservicefeeslist_maxamount'],2),number_format($v['smartmoneyservicefeeslist_sendcommission'],2),number_format($v['smartmoneyservicefeeslist_transferfee'],2),number_format($v['smartmoneyservicefeeslist_receivecommission'],2)));
								$rowid++;
							}

						}

						for($i=0;$i<10;$i++) {
							$rows[] = array('id'=>$rowid,'data'=>array($rowid,'','','','',''));
							$rowid++;
						}

						if(!empty($rows)) {
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

				}			}

			return false;
		} // router($vars=false,$retflag=false)

	}

	$appappdiscount = new APP_app_discount;
}

# eof modules/app.user
