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

if(!class_exists('APP_app_receivables')) {

	class APP_app_receivables extends APP_Base_Ajax {
	
		var $desc = 'Receivables';

		var $pathid = 'receivables';
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

			$appaccess->rules($this->desc,'Receivables Module');

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

		function _form_receivablesmaincustomer($routerid=false,$formid=false) {
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
			
		} // _form_receivablesmaincustomer

		function _form_receivablesmainpayment($routerid=false,$formid=false) {
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
			
		} // _form_receivablesmainpayment

		function _form_receivablesmaincustomerrole($routerid=false,$formid=false) {
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
			
		} // _form_receivablesmaincustomerrole

		function _form_receivablesdetailcustomer($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb, $appsession;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='receivablesnew'||$post['method']=='receivablesedit')) {
					$_SESSION['UPLOADS'] = array();
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='receivablesedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_customer where customer_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

						if(!empty($result['rows'][0]['customer_id'])) {
							$params['customerinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='getnetwork') {

					$retval = array();
					$retval['network'] = getNetworkName($this->vars['post']['mobileno']);

					json_encode_return($retval);
					die;

				} else 
				if(!empty($post['method'])&&$post['method']=='receivablesphotoget') {

					/*$retval = array();
					$retval['vars'] = $this->vars; 
					$retval['$_SESSION'] = $_SESSION;
					$retval['$_GET'] = $_GET;

					pre($retval);

					json_encode_return($retval);
					die;*/

					if(!empty($_GET['itemId'])) {
						if(!($result = $appdb->query("select * from tbl_upload where upload_id=".$_GET['itemId']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}						
					} else {
						if(!($result = $appdb->query("select * from tbl_upload where upload_name='".$post['name']."' and upload_customerid=".$post['rowid']." order by upload_id desc limit 1"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}						
					}

					if(!empty($result['rows'][0]['upload_content'])) {
						//$retval['uploadid'] = $result['rows'][0]['upload_id'];
						$content = base64_decode($result['rows'][0]['upload_content']);
					}

					if(!empty($content)) {
						header("Content-Type: image/jpg");
						print_r($content);
					}

					die();

				} else
				if(!empty($post['method'])&&$post['method']=='receivablesphotoupload') {

//	print_r("{state: true, itemId: '".@$_REQUEST["itemId"]."', itemValue: '".str_replace("'","\\'",$filename)."'}");

					$filename = $_FILES["file"]["name"];
					
					$retval = array();
					$retval['state'] = true;
					$retval['itemId'] = $post['itemId'];
					$retval['filename'] = str_replace("'","\\'",$filename);
					$retval['vars'] = $this->vars;
					$retval['$_FILES'] = $_FILES;

					$filepath = $_FILES['file']['tmp_name'];

					if(is_readable($filepath)&&($hf=fopen($filepath,'r'))) {

						$fcontent = fread($hf,filesize($filepath));
						fclose($hf);
						@unlink($filepath);

						$b64content = base64_encode($fcontent);

						if($b64content) {
							$content = array();
							$content['upload_sid'] = $appsession->id();
							$content['upload_type'] = $_FILES['file']['type'];
							$content['upload_temp'] = 1;
							$content['upload_content'] = $b64content;
							$content['upload_size'] = $_FILES['file']['size'];
							$content['upload_name'] = $post['itemId'];
							//$content['upload_customerid'] = $post['rowid'];

							if(!($result = $appdb->query("select * from tbl_upload where upload_customerid=0 and upload_sid='".$content['upload_sid']."' and upload_name='".$post['itemId']."'"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;				
							}

							if(!empty($result['rows'][0]['upload_id'])) {

								$retval['uploadid'] = $result['rows'][0]['upload_id'];

								if(!($result = $appdb->update("tbl_upload",$content,"upload_id=".$retval['uploadid']))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;				
								}

								if(!in_array($retval['uploadid'], $_SESSION['UPLOADS'])) {
									$_SESSION['UPLOADS'][] = $retval['uploadid'];
								}

							} else {
								if(!($result = $appdb->insert("tbl_upload",$content,"upload_id"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;				
								}

								if(!empty($result['returning'][0]['upload_id'])) {
									$retval['uploadid'] = $result['returning'][0]['upload_id'];
									$_SESSION['UPLOADS'][] = $retval['uploadid'];
								}
							}

							$retval['itemValue'] = $retval['uploadid'];
						}						
					}



					//json_encode_return($retval);
					header("Content-Type: text/html");
					print_r(json_encode($retval));
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='receivablessave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Customer successfully saved!';

					//pre(array('$vars'=>$this->vars));
					//die;

					$content = array();
					$content['customer_ymd'] = date('Ymd');
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
	
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['customer_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

					} else {

						if(!($result = $appdb->insert("tbl_customer",$content,"customer_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

						if(!empty($result['returning'][0]['customer_id'])) {
							$retval['rowid'] = $result['returning'][0]['customer_id'];
						}

					}

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_virtualnumber where virtualnumber_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['virtualnumber_mobileno'])&&is_array($post['virtualnumber_mobileno'])) {

						$customer_mobileno = '';

						foreach($post['virtualnumber_mobileno'] as $k=>$v) {
							$content = array();
							$content['virtualnumber_customerid'] = $retval['rowid'];
							$content['virtualnumber_mobileno'] = !empty($post['virtualnumber_mobileno'][$k]) ? $post['virtualnumber_mobileno'][$k] : '';
							$content['virtualnumber_provider'] = !empty($post['virtualnumber_provider'][$k]) ? $post['virtualnumber_provider'][$k] : '';
							$content['virtualnumber_default'] = !empty($post['virtualnumber_default'][$k]) ? $post['virtualnumber_default'][$k] : 0;
							$content['virtualnumber_active'] = !empty($post['virtualnumber_active'][$k]) ? $post['virtualnumber_active'][$k] : 0;

							if(!($result = $appdb->insert("tbl_virtualnumber",$content,"virtualnumber_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;				
							}

							if(!empty($content['virtualnumber_default'])&&!empty($content['virtualnumber_active'])) {
								$customer_mobileno = $content['virtualnumber_mobileno'];
							}
						}

						$content = array();
						$content['customer_mobileno'] = $customer_mobileno;

						if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

					}

					if(!empty($retval['rowid'])) {
						if(!empty($_SESSION['UPLOADS'])) {

							$content = array();
							$content['upload_customerid'] = $retval['rowid'];
							$content['upload_temp'] = 0;
							$content['upload_updatestamp'] = 'now()';

							foreach($_SESSION['UPLOADS'] as $uid) {
								if(!($result = $appdb->update("tbl_upload",$content,"upload_id=$uid"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;				
								}
							}
						}						
					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='receivablesdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Customer successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_customer where customer_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;				
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_customer where customer_id=".$post['rowid']))) {
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
		myTabbar.addTab("tbCustomer", "Customer");
		myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbIdentification", "Identification");
		myTabbar.addTab("tbAddress", "Address");
		myTabbar.addTab("tbVirtualNumbers", "Virtual Numbers");
		myTabbar.addTab("tbWebAccess", "Web Access");
		myTabbar.addTab("tbDownline", "Downline");
		myTabbar.addTab("tbDownlineRebate", "Downline Rebate Settings");
		myTabbar.addTab("tbChild", "Child");
		myTabbar.addTab("tbChildRebate", "Child Rebate Settings");
*/

				$params['tbCustomer'] = array();
				$params['tbDetails'] = array();
				$params['tbIdentification'] = array();
				$params['tbAddress'] = array();
				$params['tbVirtualNumbers'] = array();
				$params['tbWebAccess'] = array();
				$params['tbDownline'] = array();
				$params['tbDownlineRebate'] = array();
				$params['tbChild'] = array();
				$params['tbChildRebate'] = array();

				$custid = '';

				if(!empty($params['customerinfo']['customer_id'])&&!empty($params['customerinfo']['customer_ymd'])) {
					$custid = $params['customerinfo']['customer_ymd'] . sprintf('%04d', intval($params['customerinfo']['customer_id']));
				}

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER ID',
					'name' => 'customer_id',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $custid,
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'LAST NAME',
					'name' => 'customer_lastname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_lastname']) ? $params['customerinfo']['customer_lastname'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'FIRST NAME',
					'name' => 'customer_firstname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_firstname']) ? $params['customerinfo']['customer_firstname'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'MIDDLE NAME',
					'name' => 'customer_middlename',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_middlename']) ? $params['customerinfo']['customer_middlename'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'SUFFIX',
					'name' => 'customer_suffix',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_suffix']) ? $params['customerinfo']['customer_suffix'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'COMPANY NAME',
					'name' => 'customer_companyname',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_companyname']) ? $params['customerinfo']['customer_companyname'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

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

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$gender = array('MALE','FEMALE');

				foreach($gender as $v) {
					$selected = false;
					if(!empty($params['customerinfo']['customer_gender'])&&$params['customerinfo']['customer_gender']==$v) {
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

				$params['tbCustomer'][] = array(
					'type' => 'combo',
					'label' => 'GENDER',
					'name' => 'customer_gender',
					'readonly' => true,
					'inputWidth' => 200,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$civilstatus = array('SINGLE','MARRIED','WIDOW','SEPARATED');

				foreach($civilstatus as $v) {
					$selected = false;
					if(!empty($params['customerinfo']['customer_civilstatus'])&&$params['customerinfo']['customer_civilstatus']==$v) {
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

				$params['tbCustomer'][] = array(
					'type' => 'combo',
					'label' => 'CIVIL STATUS',
					'name' => 'customer_civilstatus',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$accounttype = array('RETAIL','DEALER');

				foreach($accounttype as $v) {
					$selected = false;
					if(!empty($params['customerinfo']['customer_accounttype'])&&$params['customerinfo']['customer_accounttype']==$v) {
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

				$params['tbCustomer'][] = array(
					'type' => 'combo',
					'label' => 'ACCOUNT TYPE',
					'name' => 'customer_accounttype',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'TOTAL REBATE',
					'name' => 'customer_totalrebate',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_totalrebate']) ? $params['customerinfo']['customer_totalrebate'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'BALANCE',
					'name' => 'customer_balance',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_balance']) ? $params['customerinfo']['customer_balance'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CREDIT LIMIT',
					'name' => 'customer_creditlimit',
					'readonly' => $readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditlimit']) ? $params['customerinfo']['customer_creditlimit'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CRITICAL LEVEL',
					'name' => 'customer_criticallevel',
					'readonly' => $readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_criticallevel']) ? $params['customerinfo']['customer_criticallevel'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CREDIT BALANCE',
					'name' => 'customer_creditbalance',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditbalance']) ? $params['customerinfo']['customer_creditbalance'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CREDIT DUE',
					'name' => 'customer_creditdue',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditdue']) ? $params['customerinfo']['customer_creditdue'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'PARENT',
					'name' => 'customer_parent',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_parent']) ? $params['customerinfo']['customer_parent'] : '',
				);

				/*$params['tbIdentification'][] = array(
					'type' => 'upload',
					'label' => 'ID',
					'inputWidth' => 330,
					'url' => "/templates/default/dhtmlx/dhtmlxform_item_upload.php",
					'_swfLogs' => "enabled", 
					'swfPath' => "/templates/default/dhtmlx/uploader.swf", 
					'swfUrl' => "/templates/default/dhtmlx/dhtmlxform_item_upload.php",
				);*/

// {type: "image", name: "photo", label: "Photo", imageWidth: 126, imageHeight: 126, url: "../common/type_image/dhxform_image.php"}

				$imagepost = $post;
				$imagepost['method'] = 'receivablesphotoget';
				$imagepost['name'] = 'customer_photo';

				$imagedata = urlencode(base64_encode(gzcompress(json_encode($imagepost),9)));

				$params['tbIdentification'][] = array(
					'type' => 'image',
					'label' => 'Customer Photo',
					'labelWidth' => 120,
					'name' => 'customer_photo',
					'inputWidth' => 300,
					'inputHeight' => 300,
					'imageWidth' => 300,
					'imageHeight' => 300,
					'disabled' => $readonly,
					'url' => '/app/json/',
					'image_url' => '/app/api/'.$imagedata.'/',
					'routerid' => $post['routerid'],
					'action' => $post['action'],
					'formid' => $post['formid'],
					'module' => $post['module'],
					'method' => 'receivablesphotoupload',
					'rowid' => $post['rowid'],
					'formval' => $post['formval'],
				);

				$params['tbIdentification'][] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$imagepost = $post;
				$imagepost['method'] = 'receivablesphotoget';
				$imagepost['name'] = 'customer_idphoto';

				$imagedata = urlencode(base64_encode(gzcompress(json_encode($imagepost),9)));

				$params['tbIdentification'][] = array(
					'type' => 'image',
					'label' => 'Customer ID',
					'labelWidth' => 120,
					'name' => 'customer_idphoto',
					'inputWidth' => 300,
					'inputHeight' => 300,
					'imageWidth' => 300,
					'imageHeight' => 300,
					'disabled' => $readonly,
					'url' => '/app/json/',
					'image_url' => '/app/api/'.$imagedata.'/',
					'routerid' => $post['routerid'],
					'action' => $post['action'],
					'formid' => $post['formid'],
					'module' => $post['module'],
					'method' => 'receivablesphotoupload',
					'rowid' => $post['rowid'],
					'formval' => $post['formval'],
				);

				$params['tbAddress'][] = array(
					'type' => 'label',
					'label' => 'PRESENT ADDRESS',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'HOUSE NO / STREET NAME',
					'name' => 'customer_pahouseno',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_pahouseno']) ? $params['customerinfo']['customer_pahouseno'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'BARANGAY',
					'name' => 'customer_pabarangay',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_pabarangay']) ? $params['customerinfo']['customer_pabarangay'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'MUNICIPALITY',
					'name' => 'customer_pamunicipality',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_pamunicipality']) ? $params['customerinfo']['customer_pamunicipality'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'PROVINCE',
					'name' => 'customer_paprovince',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_paprovince']) ? $params['customerinfo']['customer_paprovince'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'ZIP CODE',
					'name' => 'customer_pazipcode',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_pazipcode']) ? $params['customerinfo']['customer_pazipcode'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbAddress'][] = array(
					'type' => 'label',
					'labelWidth' => 200,
					'label' => 'ALTERNATIVE ADDRESS',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'HOUSE NO / STREET NAME',
					'name' => 'customer_aahouseno',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_aahouseno']) ? $params['customerinfo']['customer_aahouseno'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'BARANGAY',
					'name' => 'customer_aabarangay',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_aabarangay']) ? $params['customerinfo']['customer_aabarangay'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'MUNICIPALITY',
					'name' => 'customer_aamunicipality',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_aamunicipality']) ? $params['customerinfo']['customer_aamunicipality'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'PROVINCE',
					'name' => 'customer_aaprovince',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_aaprovince']) ? $params['customerinfo']['customer_aaprovince'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'ZIP CODE',
					'name' => 'customer_aazipcode',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_aazipcode']) ? $params['customerinfo']['customer_aazipcode'] : '',
				);

				$params['tbVirtualNumbers'][] = array(
					'type' => 'container',
					'name' => 'customer_virtualnumbers',
					'inputWidth' => 450,
					'inputHeight' => 200,
				);

				$params['tbDownline'][] = array(
					'type' => 'container',
					'name' => 'customer_downline',
					'inputWidth' => 450,
					'inputHeight' => 200,
				);

				$params['tbDownlineRebate'][] = array(
					'type' => 'container',
					'name' => 'customer_downlinesettings',
					'inputWidth' => 450,
					'inputHeight' => 200,
				);

				$params['tbChild'][] = array(
					'type' => 'container',
					'name' => 'customer_child',
					'inputWidth' => 450,
					'inputHeight' => 200,
				);

				$params['tbChildRebate'][] = array(
					'type' => 'container',
					'name' => 'customer_childsettings',
					'inputWidth' => 450,
					'inputHeight' => 200,
				);
				

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_receivablesdetailcustomer

		function _form_receivablesdetailpayment($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='receivablesnew'||$this->vars['post']['method']=='receivablesedit')) {
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
			
		} // _form_receivablesdetailpayment

		function _form_receivablesdetailcustomerrole($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='receivablesnew'||$this->vars['post']['method']=='receivablesedit')) {
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
			
		} // _form_receivablesdetailcustomerrole

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

					$form = $this->_form($this->post['routerid'], $this->post['formid']);

					$jsonxml = $this->_xml($this->post['routerid'], $this->post['formid']);

					if(!empty($this->post['formval'])) {
						$form = str_replace('%formval%',$this->post['formval'],$form);
					}

					$retval = array('html'=>$form);

					if(!empty($jsonxml)) {
						$retval['xml'] = $jsonxml;
					}

					//$retval['db'] = array('count'=>$appdb->getCount());

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
					if($this->post['table']=='customer') {
						if(!($result = $appdb->query("select * from tbl_customer order by customer_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['customer_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$custid = $v['customer_ymd'] . sprintf('%04d', $v['customer_id']);

								$rows[] = array('id'=>$v['customer_id'],'data'=>array(0,$custid,$v['customer_mobileno'],$v['customer_lastname'],$v['customer_firstname'],$v['customer_middlename'],$v['customer_suffix']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='virtualnumber') {
						if(!($result = $appdb->query("select * from tbl_virtualnumber where virtualnumber_customerid=".$this->post['rowid']." order by virtualnumber_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}
						//pre(array('$result'=>$result));

						$ctr=1;

						$rows = array();

						if(!empty($result['rows'][0]['virtualnumber_id'])) {
							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$ctr,'data'=>array($ctr,$v['virtualnumber_mobileno'],$v['virtualnumber_provider'],$v['virtualnumber_default'],$v['virtualnumber_active']));
								$ctr++;
							}
						}

						while($ctr<=10) {
							$rows[] = array('id'=>$ctr,'data'=>array($ctr,'','',0,0));
							$ctr++;								
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

				}
			}

			return false;
		} // router($vars=false,$retflag=false)
		
	}

	$appappreceivables = new APP_app_receivables;
}

# eof modules/app.user