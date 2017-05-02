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

if(!class_exists('APP_app_contact')) {

	class APP_app_contact extends APP_Base_Ajax {

		var $desc = 'Contacts';

		var $pathid = 'contact';
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

			$appaccess->rules($this->desc,'Contacts Module');

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

		function _form_contactmaincustomer($routerid=false,$formid=false) {
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

		} // _form_contactmaincustomer

		function _form_contactmainretailer($routerid=false,$formid=false) {
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

		} // _form_contactmainretailer

		function _form_contactmainremittance($routerid=false,$formid=false) {
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

		} // _form_contactmainremittance

		function _form_contactmainsupplier($routerid=false,$formid=false) {
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

		} // _form_contactmainsupplier

		function _form_contactdetailcustomer($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb, $appsession;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='contactnew'||$post['method']=='contactedit')) {
					$_SESSION['UPLOADS'] = array();

					if(!($result = $appdb->query("delete from tbl_upload where upload_sid='".$appsession->id()."' and upload_temp=1"))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='contactedit')) {
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
				if(!empty($post['method'])&&$post['method']=='contactphotoget') {

					if(!empty($post['_method'])&&$post['_method']=='contactnew'&&empty($_GET['itemId'])) {
						header("Content-Type: image/jpg");
						die();
					}

					/*$retval = array();
					$retval['vars'] = $this->vars;
					$retval['$_SESSION'] = $_SESSION;
					$retval['$_GET'] = $_GET;

					pre($retval);

					json_encode_return($retval);
					die;*/

					if(!empty($post['rowid'])) {
					} else {
						$post['rowid'] = 0;
					}

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
				if(!empty($post['method'])&&$post['method']=='contactphotoupload') {

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
				if(!empty($post['method'])&&$post['method']=='contactsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Customer successfully saved!';

					//pre(array('$vars'=>$this->vars));
					//die;

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
					$content['customer_discountcustomerreload'] = !empty($post['customer_discountcustomerreload']) ? $post['customer_discountcustomerreload'] : '';
					$content['customer_discountfundreload'] = !empty($post['customer_discountfundreload']) ? $post['customer_discountfundreload'] : '';
					$content['customer_discountchildreload'] = !empty($post['customer_discountchildreload']) ? $post['customer_discountchildreload'] : '';
					$content['customer_discountfundtransfer'] = !empty($post['customer_discountfundtransfer']) ? $post['customer_discountfundtransfer'] : '';
					$content['customer_discountretail'] = !empty($post['customer_discountretail']) ? $post['customer_discountretail'] : '';
					$content['customer_creditnotibeforedue'] = !empty($post['customer_creditnotibeforedue']) ? $post['customer_creditnotibeforedue'] : 180;
					$content['customer_creditnotiafterdue'] = !empty($post['customer_creditnotiafterdue']) ? $post['customer_creditnotiafterdue'] : 1440;
					$content['customer_creditnotibeforeduemsg'] = !empty($post['customer_creditnotibeforeduemsg']) ? $post['customer_creditnotibeforeduemsg'] : 88;
					$content['customer_creditnotiafterduemsg'] = !empty($post['customer_creditnotiafterduemsg']) ? $post['customer_creditnotiafterduemsg'] : 89;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['customer_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						computeCustomerCreditDue($retval['rowid']);

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

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_virtualnumber where virtualnumber_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!($result = $appdb->query("delete from tbl_childsettings where childsettings_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!($result = $appdb->query("delete from tbl_downlinesettings where downlinesettings_customerid=".$retval['rowid']))) {
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

					if(!empty($retval['rowid'])&&!empty($post['childsettings_provider'])&&is_array($post['childsettings_provider'])&&!empty($post['childsettings_category'])&&is_array($post['childsettings_category'])&&!empty($post['childsettings_type'])&&is_array($post['childsettings_type'])&&!empty($post['childsettings_discount'])&&is_array($post['childsettings_discount'])) {

						foreach($post['childsettings_provider'] as $k=>$v) {
							$content = array();
							$content['childsettings_customerid'] = $retval['rowid'];
							$content['childsettings_provider'] = !empty($post['childsettings_provider'][$k]) ? $post['childsettings_provider'][$k] : '';
							$content['childsettings_category'] = !empty($post['childsettings_category'][$k]) ? $post['childsettings_category'][$k] : '';
							$content['childsettings_type'] = !empty($post['childsettings_type'][$k]) ? $post['childsettings_type'][$k] : '';
							$content['childsettings_discount'] = !empty($post['childsettings_discount'][$k]) ? $post['childsettings_discount'][$k] : '';

							if(!($result = $appdb->insert("tbl_childsettings",$content,"childsettings_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['downlinesettings_mobileno'])&&is_array($post['downlinesettings_mobileno'])&&!empty($post['downlinesettings_discount'])&&is_array($post['downlinesettings_discount'])&&!empty($post['downlinesettings_retailername'])&&is_array($post['downlinesettings_retailername'])) {

						foreach($post['downlinesettings_mobileno'] as $k=>$v) {
							$content = array();
							$content['downlinesettings_customerid'] = $retval['rowid'];
							$content['downlinesettings_mobileno'] = !empty($post['downlinesettings_mobileno'][$k]) ? $post['downlinesettings_mobileno'][$k] : '';
							//$content['downlinesettings_category'] = !empty($post['downlinesettings_category'][$k]) ? $post['downlinesettings_category'][$k] : '';
							//$content['downlinesettings_type'] = !empty($post['downlinesettings_type'][$k]) ? $post['downlinesettings_type'][$k] : '';
							//$content['downlinesettings_simcard'] = !empty($post['downlinesettings_simcard'][$k]) ? $post['downlinesettings_simcard'][$k] : '';
							$content['downlinesettings_discount'] = !empty($post['downlinesettings_discount'][$k]) ? $post['downlinesettings_discount'][$k] : '';

							if(!($result = $appdb->insert("tbl_downlinesettings",$content,"downlinesettings_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
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

						if($customer_type=='STAFF') {
							computeStaffBalance($retval['rowid']);
						} else
						if($customer_type=='REGULAR') {
							computeCustomerBalance($retval['rowid']);
						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='contactdelete') {

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

							if(!($result = $appdb->query("delete from tbl_virtualnumber where virtualnumber_customerid in (".$rowids.")"))) {
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

						if(!($result = $appdb->query("delete from tbl_virtualnumber where virtualnumber_customerid=".$post['rowid']))) {
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
				$params['tbDiscount'] = array();
				$params['tbChild'] = array();
				$params['tbChildRebate'] = array();
				$params['tbTransaction'] = array();
				$params['tbCreditTransaction'] = array();

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

				//$params['tbCustomer'][] = array(
				//	'type' => 'newcolumn',
				//	'offset' => $newcolumnoffset,
				//);

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

				$params['tbCustomer'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				$accounttype = array('REGULAR','STAFF','ADMIN');

				foreach($accounttype as $v) {
					$selected = false;
					if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']==$v) {
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
					'label' => 'CUSTOMER TYPE',
					'name' => 'customer_type',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				$accounttype = array('CASH','CREDIT');

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

				$accounttypecash = true;

				if(!empty($params['customerinfo']['customer_accounttype'])&&$params['customerinfo']['customer_accounttype']=='CREDIT') {
					$accounttypecash = false;
				}

				if($readonly) {
					$params['tbCustomer'][] = array(
						'type' => 'input',
						'label' => 'PARENT',
						'name' => 'customer_parent',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['customerinfo']['customer_parent']) ? getCustomerNameByID($params['customerinfo']['customer_parent']) : '',
					);
				} else {
					$params['tbCustomer'][] = array(
						'type' => 'combo',
						'label' => 'PARENT',
						'name' => 'customer_parent',
						'readonly' => $readonly,
						//'readonly' => true,
						//'comboType' => 'checkbox',
						//'required' => !$readonly,
						//'value' => !empty($params['customerinfo']['customer_parent']) ? $params['customerinfo']['customer_parent'] : '',
						'options' => array(), //$opt,
					);
				}

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'TOTAL REBATE',
					'name' => 'customer_totalrebate',
					'readonly' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','digits'=>3,'autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_totalrebate']) ? $params['customerinfo']['customer_totalrebate'] : '',
				);

				if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']=='STAFF') {

					$params['tbCustomer'][] = array(
						'type' => 'input',
						'label' => 'STAFF BALANCE',
						'name' => 'customer_staffbalance',
						'readonly' => true,
						'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						//'required' => !$readonly,
						'value' => !empty($params['customerinfo']['customer_staffbalance']) ? $params['customerinfo']['customer_staffbalance'] : '',
					);

				} else
				if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']=='REGULAR') {

					$params['tbCustomer'][] = array(
						'type' => 'input',
						'label' => 'BALANCE',
						'name' => 'customer_balance',
						'readonly' => true,
						'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						//'required' => !$readonly,
						'value' => !empty($params['customerinfo']['customer_balance']) ? $params['customerinfo']['customer_balance'] : '',
					);

				}

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'FREEZE LEVEL',
					'name' => 'customer_freezelevel',
					'readonly' => $readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_freezelevel']) ? $params['customerinfo']['customer_freezelevel'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CRITICAL LEVEL',
					'name' => 'customer_criticallevel',
					'readonly' => $readonly,
					//'hidden' => $accounttypecash,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_criticallevel']) ? $params['customerinfo']['customer_criticallevel'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CREDIT LIMIT',
					'name' => 'customer_creditlimit',
					'readonly' => $readonly,
					'hidden' => $accounttypecash,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditlimit']) ? $params['customerinfo']['customer_creditlimit'] : '',
				);

				if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']=='STAFF') {

					/*$params['tbCustomer'][] = array(
						'type' => 'input',
						'label' => 'CREDIT BALANCE',
						'name' => 'customer_creditbalance',
						'readonly' => true,
						'hidden' => $accounttypecash,
						'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						//'required' => !$readonly,
						'value' => !empty($params['customerinfo']['customer_creditbalance']) ? $params['customerinfo']['customer_creditbalance'] : '',
					);*/

			} else
			if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']=='REGULAR') {

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CREDIT BALANCE',
					'name' => 'customer_creditbalance',
					'readonly' => true,
					'hidden' => $accounttypecash,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_totalcredit']) ? $params['customerinfo']['customer_totalcredit'] : '',
				);

			}

				$params['tbCustomer'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']=='STAFF') {
					$customer_availablecredit = getStaffAvailableCredit($params['customerinfo']['customer_id']);
				} else
				if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']=='REGULAR') {
					$customer_availablecredit = getCustomerAvailableCredit($params['customerinfo']['customer_id']);
				} else {
					$customer_availablecredit = 0;
				}

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'AVAILABLE CREDIT',
					'name' => 'customer_availablecredit',
					'readonly' => true,
					'hidden' => $accounttypecash,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					//'value' => !empty($params['customerinfo']['customer_availablecredit']) ? $params['customerinfo']['customer_availablecredit'] : '',
					//'value' => getStaffAvailableCredit($params['customerinfo']['customer_id']),
					'value' => $customer_availablecredit,
				);

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$accounttype = array('1 DAY','3 DAYS','7 DAYS','10 DAYS','15 DAYS','30 DAYS');

				foreach($accounttype as $v) {
					$selected = false;
					if(!empty($params['customerinfo']['customer_terms'])&&$params['customerinfo']['customer_terms']==$v) {
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
					'label' => 'TERMS',
					'name' => 'customer_terms',
					'readonly' => true,
					'hidden' => $accounttypecash,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CREDIT DUE',
					'name' => 'customer_creditdue',
					'readonly' => true,
					'hidden' => $accounttypecash,
					//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditdue']) ? $params['customerinfo']['customer_creditdue'] : '',
				);

				/*if($readonly) {
					$params['tbCustomer'][] = array(
						'type' => 'input',
						'label' => 'CREDIT NOTIFICATION',
						'name' => 'customer_creditnotificationdate',
						'readonly' => true,
						'hidden' => $accounttypecash,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						//'required' => !$readonly,
						'value' => !empty($params['customerinfo']['customer_creditnotificationdate']) ? $params['customerinfo']['customer_creditnotificationdate'] : '',
					);
				} else {
					$params['tbCustomer'][] = array(
						'type' => 'calendar',
						'label' => 'CREDIT NOTIFICATION',
						'name' => 'customer_creditnotificationdate',
						'readonly' => $readonly,
						'hidden' => $accounttypecash,
						'enableTime' => true,
						'enableTodayButton' => true,
						'calendarPosition' => 'right',
						'dateFormat' => '%m-%d-%Y %H:%i',
						//'required' => !$readonly,
						'value' => !empty($params['customerinfo']['customer_creditnotificationdate']) ? $params['customerinfo']['customer_creditnotificationdate'] : '',
					);
				}*/

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'NOTI BEFORE DUE (minutes)',
					'name' => 'customer_creditnotibeforedue',
					'readonly' => $readonly,
					'hidden' => $accounttypecash,
					'inputWidth' => 70,
					'numeric' => true,
					//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditnotibeforedue']) ? $params['customerinfo']['customer_creditnotibeforedue'] : '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				if($readonly) {

					$block[] = array(
						'type' => 'input',
						'name' => 'customer_creditnotibeforeduemsg',
						'hidden' => $accounttypecash,
						'readonly' => $readonly,
						'inputWidth' => 125,
						'value' => !empty($params['customerinfo']['customer_creditnotibeforeduemsg']) ? $params['customerinfo']['customer_creditnotibeforeduemsg'] : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$customer_creditnotibeforeduemsg = !empty($params['customerinfo']['customer_creditnotibeforeduemsg']) ? $params['customerinfo']['customer_creditnotibeforeduemsg'] : '';

					$lnotification = explode(',', $customer_creditnotibeforeduemsg);

					//pre(array('$lnotification'=>$lnotification));

					foreach($allNotifications as $k=>$v) {
						$checked = false;

						if(in_array($v['notification_id'],$lnotification)) {
							$checked = true;
						}

						$opt[] = array('value'=>$v['notification_id'],'checked'=>$checked,'text'=>array(
							'notificationvalue' => !empty($v['notification_value']) ? $v['notification_value'] : ' '
						));
					}

					$params['customer_creditnotibeforeduemsgopt'] = array(
						'opts'=>$opt,
						'value'=>!empty($customer_creditnotibeforeduemsg) ? $customer_creditnotibeforeduemsg : ''
					);

					$block[] = array(
						'type' => 'combo',
						//'label' => 'RESEND DUPLICATE MESSAGE',
						//'labelWidth' => 210,
						'inputWidth' => 125,
						'comboType' => 'checkbox',
						'name' => 'customer_creditnotibeforeduemsg',
						'readonly' => $readonly,
						'hidden' => $accounttypecash,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				$params['tbCustomer'][] = array(
					'type' => 'block',
					'width' => 350,
					'blockOffset' => 0,
					'offsetTop' => 0,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'NOTI AFTER DUE (every minutes)',
					'name' => 'customer_creditnotiafterdue',
					'readonly' => $readonly,
					'hidden' => $accounttypecash,
					'inputWidth' => 70,
					'numeric' => true,
					//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditnotiafterdue']) ? $params['customerinfo']['customer_creditnotiafterdue'] : '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				if($readonly) {

					$block[] = array(
						'type' => 'input',
						'name' => 'customer_creditnotiafterduemsg',
						'readonly' => $readonly,
						'hidden' => $accounttypecash,
						'inputWidth' => 125,
						'value' => !empty($params['customerinfo']['customer_creditnotiafterduemsg']) ? $params['customerinfo']['customer_creditnotiafterduemsg'] : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$customer_creditnotiafterduemsg = !empty($params['customerinfo']['customer_creditnotiafterduemsg']) ? $params['customerinfo']['customer_creditnotiafterduemsg'] : '';

					$lnotification = explode(',', $customer_creditnotiafterduemsg);

					//pre(array('$lnotification'=>$lnotification));

					foreach($allNotifications as $k=>$v) {
						$checked = false;

						if(in_array($v['notification_id'],$lnotification)) {
							$checked = true;
						}

						$opt[] = array('value'=>$v['notification_id'],'checked'=>$checked,'text'=>array(
							'notificationvalue' => !empty($v['notification_value']) ? $v['notification_value'] : ' '
						));
					}

					$params['customer_creditnotiafterduemsgopt'] = array(
						'opts'=>$opt,
						'value'=>!empty($customer_creditnotiafterduemsg) ? $customer_creditnotiafterduemsg : ''
					);

					$block[] = array(
						'type' => 'combo',
						//'label' => 'RESEND DUPLICATE MESSAGE',
						//'labelWidth' => 210,
						'inputWidth' => 125,
						'comboType' => 'checkbox',
						'name' => 'customer_creditnotiafterduemsg',
						'readonly' => $readonly,
						'hidden' => $accounttypecash,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				$params['tbCustomer'][] = array(
					'type' => 'block',
					'width' => 350,
					'blockOffset' => 0,
					'offsetTop' => 0,
					'list' => $block,
				);


/*
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
*/
				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'PAYMENT PERCENTAGE',
					'name' => 'customer_paymentpercentage',
					'readonly' => $readonly,
					'hidden' => $accounttypecash,
					'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
					//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_paymentpercentage']) ? $params['customerinfo']['customer_paymentpercentage'] : 0,
				);

				$params['tbCustomer'][] = array(
					'type' => 'checkbox',
					'label' => 'ACCOUNT FREEZED',
					//'labelWidth' => 500,
					'name' => 'customer_freezed',
					'readonly' => $readonly,
					'checked' => !empty($params['customerinfo']['customer_freezed']) ? true : false,
					'position' => 'label-right',
				);

				if($readonly) {

					$params['tbDiscount'][] = array(
						'type' => 'input',
						'label' => 'CUSTOMER RELOAD',
						'name' => 'customer_discountcustomerreload',
						'readonly' => $readonly,
						'inputWidth' => 200,
						//'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['customerinfo']['customer_discountcustomerreload']) ? $params['customerinfo']['customer_discountcustomerreload'] : '',
					);

					$params['tbDiscount'][] = array(
						'type' => 'input',
						'label' => 'FUND RELOAD',
						'name' => 'customer_discountfundreload',
						'readonly' => $readonly,
						'inputWidth' => 200,
						//'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['customerinfo']['customer_discountfundreload']) ? $params['customerinfo']['customer_discountfundreload'] : '',
					);

					$params['tbDiscount'][] = array(
						'type' => 'input',
						'label' => 'CHILD RELOAD',
						'name' => 'customer_discountchildreload',
						'readonly' => $readonly,
						'inputWidth' => 200,
						//'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['customerinfo']['customer_discountchildreload']) ? $params['customerinfo']['customer_discountchildreload'] : '',
					);

					$params['tbDiscount'][] = array(
						'type' => 'input',
						'label' => 'FUND TRANSFER',
						'name' => 'customer_discountfundtransfer',
						'readonly' => $readonly,
						'inputWidth' => 200,
						//'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['customerinfo']['customer_discountfundtransfer']) ? $params['customerinfo']['customer_discountfundtransfer'] : '',
					);

					$params['tbDiscount'][] = array(
						'type' => 'input',
						'label' => 'RETAIL',
						'name' => 'customer_discountretail',
						'readonly' => $readonly,
						'inputWidth' => 200,
						//'disabled' => !empty($params['iteminfo']['item_maintenance']) ? false : true,
						//'required' => !$readonly,
						//'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
						'value' => !empty($params['customerinfo']['customer_discountretail']) ? $params['customerinfo']['customer_discountretail'] : '',
					);

				} else {

////////////////

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$discountSchemes = getDiscountScheme();

					foreach($discountSchemes as $k=>$v) {
						$selected = false;
						if(!empty($params['customerinfo']['customer_discountcustomerreload'])&&$params['customerinfo']['customer_discountcustomerreload']==$v['discount_desc']) {
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

					$params['tbDiscount'][] = array(
						'type' => 'combo',
						'label' => 'CUSTOMER RELOAD',
						//'labelWidth' => 210,
						'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'customer_discountcustomerreload',
						'readonly' => $readonly,
						//'disabled' => !empty($params['iteminfo']['item_regularload']) ? false : true,
						//'required' => !$readonly,
						'options' => $opt,
					);

////////////////

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$discountSchemes = getDiscountScheme();

					foreach($discountSchemes as $k=>$v) {
						$selected = false;
						if(!empty($params['customerinfo']['customer_discountfundreload'])&&$params['customerinfo']['customer_discountfundreload']==$v['discount_desc']) {
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

					$params['tbDiscount'][] = array(
						'type' => 'combo',
						'label' => 'FUND RELOAD',
						//'labelWidth' => 210,
						'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'customer_discountfundreload',
						'readonly' => $readonly,
						//'disabled' => !empty($params['iteminfo']['item_regularload']) ? false : true,
						//'required' => !$readonly,
						'options' => $opt,
					);

////////////////

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$discountSchemes = getDiscountScheme();

					foreach($discountSchemes as $k=>$v) {
						$selected = false;
						if(!empty($params['customerinfo']['customer_discountchildreload'])&&$params['customerinfo']['customer_discountchildreload']==$v['discount_desc']) {
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

					$params['tbDiscount'][] = array(
						'type' => 'combo',
						'label' => 'CHILD RELOAD',
						//'labelWidth' => 210,
						'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'customer_discountchildreload',
						'readonly' => $readonly,
						//'disabled' => !empty($params['iteminfo']['item_regularload']) ? false : true,
						//'required' => !$readonly,
						'options' => $opt,
					);

////////////////

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$discountSchemes = getDiscountScheme();

					foreach($discountSchemes as $k=>$v) {
						$selected = false;
						if(!empty($params['customerinfo']['customer_discountfundtransfer'])&&$params['customerinfo']['customer_discountfundtransfer']==$v['discount_desc']) {
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

					$params['tbDiscount'][] = array(
						'type' => 'combo',
						'label' => 'FUND TRANSFER',
						//'labelWidth' => 210,
						'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'customer_discountfundtransfer',
						'readonly' => $readonly,
						//'disabled' => !empty($params['iteminfo']['item_regularload']) ? false : true,
						//'required' => !$readonly,
						'options' => $opt,
					);

////////////////

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					$discountSchemes = getDiscountScheme();

					foreach($discountSchemes as $k=>$v) {
						$selected = false;
						if(!empty($params['customerinfo']['customer_discountretail'])&&$params['customerinfo']['customer_discountretail']==$v['discount_desc']) {
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

					$params['tbDiscount'][] = array(
						'type' => 'combo',
						'label' => 'RETAIL',
						//'labelWidth' => 210,
						'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'customer_discountretail',
						'readonly' => $readonly,
						//'disabled' => !empty($params['iteminfo']['item_regularload']) ? false : true,
						//'required' => !$readonly,
						'options' => $opt,
					);

////////////////

				}

				/*$opt = array();
				$opt[] = array('value'=>1,'text'=>array('one'=>'one1','two'=>'two1','three'=>'three1'));
				$opt[] = array('value'=>2,'text'=>array('one'=>'one2','two'=>'two2','three'=>'three2'));
				$opt[] = array('value'=>3,'text'=>array('one'=>'one3','two'=>'two3','three'=>'three3'));
				$opt[] = array('value'=>4,'text'=>array('one'=>'one4','two'=>'two4','three'=>'three4'));
				$opt[] = array('value'=>5,'text'=>array('one'=>'one5','two'=>'two5','three'=>'three5'));*/

				/*$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'PARENT',
					'name' => 'customer_parent',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_parent']) ? $params['customerinfo']['customer_parent'] : '',
				);*/

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
				$imagepost['method'] = 'contactphotoget';
				$imagepost['name'] = 'customer_photo';
				$imagepost['_method'] = $post['method'];

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
					'method' => 'contactphotoupload',
					'rowid' => !empty($post['rowid']) ? $post['rowid'] : 0,
					'formval' => $post['formval'],
				);

				$params['tbIdentification'][] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$imagepost = $post;
				$imagepost['method'] = 'contactphotoget';
				$imagepost['name'] = 'customer_idphoto';
				$imagepost['_method'] = $post['method'];

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
					'method' => 'contactphotoupload',
					'rowid' => !empty($post['rowid']) ? $post['rowid'] : 0,
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
					'className' => 'customer_virtualnumbers_'.$post['formval'],
				);

				$params['tbDownline'][] = array(
					'type' => 'container',
					'name' => 'customer_downline',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_downline_'.$post['formval'],
				);

				$params['tbDownlineRebate'][] = array(
					'type' => 'container',
					'name' => 'customer_downlinesettings',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_downlinesettings_'.$post['formval'],
				);

				$params['tbChild'][] = array(
					'type' => 'container',
					'name' => 'customer_child',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_child_'.$post['formval'],
				);

				$params['tbChildRebate'][] = array(
					'type' => 'container',
					'name' => 'customer_childsettings',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_childsettings_'.$post['formval'],
				);

				$params['tbTransaction'][] = array(
					'type' => 'container',
					'name' => 'customer_transaction',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_transaction_'.$post['formval'],
				);

				$params['tbCreditTransaction'][] = array(
					'type' => 'container',
					'name' => 'customer_credittransaction',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_credittransaction_'.$post['formval'],
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_contactdetailcustomer

		function _form_contactdetailretailer($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb, $appsession;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='contactnew'||$post['method']=='contactedit')) {
					$_SESSION['UPLOADS'] = array();

					if(!($result = $appdb->query("delete from tbl_upload where upload_sid='".$appsession->id()."' and upload_temp=1"))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='contactedit')) {
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
				if(!empty($post['method'])&&$post['method']=='contactsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Retailer successfully saved!';

					//pre(array('$vars'=>$this->vars));
					//die;

					$content = array();
					$content['customer_mobileno'] = !empty($post['customer_mobileno']) ? $post['customer_mobileno'] : '';
					$content['customer_firstname'] = !empty($post['customer_firstname']) ? $post['customer_firstname'] : '';
					$content['customer_lastname'] = !empty($post['customer_lastname']) ? $post['customer_lastname'] : '';
					$content['customer_middlename'] = !empty($post['customer_middlename']) ? $post['customer_middlename'] : '';
					$content['customer_suffix'] = !empty($post['customer_suffix']) ? $post['customer_suffix'] : '';
					$content['customer_birthdate'] = !empty($post['customer_birthdate']) ? $post['customer_birthdate'] : '';
					$content['customer_gender'] = !empty($post['customer_gender']) ? $post['customer_gender'] : '';
					$content['customer_civilstatus'] = !empty($post['customer_civilstatus']) ? $post['customer_civilstatus'] : '';
					//$content['customer_accounttype'] = !empty($post['customer_accounttype']) ? $post['customer_accounttype'] : '';
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
					//$content['customer_creditlimit'] = !empty($post['customer_creditlimit']) ? floatval($post['customer_creditlimit']) : 0;
					//$content['customer_criticallevel'] = !empty($post['customer_criticallevel']) ? floatval($post['customer_criticallevel']) : 0;
					$content['customer_parent'] = !empty($post['customer_parent']) ? $post['customer_parent'] : 0;
					//$content['customer_accounttype'] = !empty($post['customer_accounttype']) ? $post['customer_accounttype'] : '';
					$content['customer_type'] = $customer_type = !empty($post['customer_type']) ? $post['customer_type'] : '';
          $content['customer_retailermin'] = !empty($post['customer_retailermin']) ? $post['customer_retailermin'] : 100;
          $content['customer_retailermax'] = !empty($post['customer_retailermax']) ? $post['customer_retailermax'] : 1000;
					//$content['customer_freezelevel'] = !empty($post['customer_freezelevel']) ? $post['customer_freezelevel'] : 0;
					//$content['customer_terms'] = !empty($post['customer_terms']) ? $post['customer_terms'] : '';
					//$content['customer_paymentpercentage'] = !empty($post['customer_paymentpercentage']) ? $post['customer_paymentpercentage'] : 100;
					//$content['customer_freezed'] = !empty($post['customer_freezed']) ? 1 : 0;
					//$content['customer_discountcustomerreload'] = !empty($post['customer_discountcustomerreload']) ? $post['customer_discountcustomerreload'] : '';
					//$content['customer_discountfundreload'] = !empty($post['customer_discountfundreload']) ? $post['customer_discountfundreload'] : '';
					//$content['customer_discountchildreload'] = !empty($post['customer_discountchildreload']) ? $post['customer_discountchildreload'] : '';
					//$content['customer_discountfundtransfer'] = !empty($post['customer_discountfundtransfer']) ? $post['customer_discountfundtransfer'] : '';
					//$content['customer_discountretail'] = !empty($post['customer_discountretail']) ? $post['customer_discountretail'] : '';
					//$content['customer_creditnotibeforedue'] = !empty($post['customer_creditnotibeforedue']) ? $post['customer_creditnotibeforedue'] : 180;
					//$content['customer_creditnotiafterdue'] = !empty($post['customer_creditnotiafterdue']) ? $post['customer_creditnotiafterdue'] : 1440;
					//$content['customer_creditnotibeforeduemsg'] = !empty($post['customer_creditnotibeforeduemsg']) ? $post['customer_creditnotibeforeduemsg'] : 88;
					//$content['customer_creditnotiafterduemsg'] = !empty($post['customer_creditnotiafterduemsg']) ? $post['customer_creditnotiafterduemsg'] : 89;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['customer_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						//computeCustomerCreditDue($retval['rowid']);

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

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_retailerassignedsim where retailerassignedsim_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!($result = $appdb->query("delete from tbl_retailerupline where retailerupline_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['retailerassignedsim_seq'])&&is_array($post['retailerassignedsim_seq'])) {
						foreach($post['retailerassignedsim_seq'] as $k=>$v) {
							$content = array();
							$content['retailerassignedsim_customerid'] = $retval['rowid'];
							$content['retailerassignedsim_seq'] = !empty($post['retailerassignedsim_seq'][$k]) ? $post['retailerassignedsim_seq'][$k] : '';
							$content['retailerassignedsim_simname'] = !empty($post['retailerassignedsim_simname'][$k]) ? $post['retailerassignedsim_simname'][$k] : '';
							$content['retailerassignedsim_simnumber'] = getSimNumberByName($content['retailerassignedsim_simname']);
							$content['retailerassignedsim_simcommand'] = !empty($post['retailerassignedsim_simcommand'][$k]) ? $post['retailerassignedsim_simcommand'][$k] : '';
							$content['retailerassignedsim_active'] = !empty($post['retailerassignedsim_active'][$k]) ? 1 : 0;

							if(!($result = $appdb->insert("tbl_retailerassignedsim",$content,"retailerassignedsim_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['retailerupline_uplineid'])&&is_array($post['retailerupline_uplineid'])) {
						foreach($post['retailerupline_uplineid'] as $k=>$v) {
							$content = array();
							$content['retailerupline_customerid'] = $retval['rowid'];
							$content['retailerupline_uplineid'] = !empty($post['retailerupline_uplineid'][$k]) ? $post['retailerupline_uplineid'][$k] : '';

							if(!($result = $appdb->insert("tbl_retailerupline",$content,"retailerupline_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					/*if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_virtualnumber where virtualnumber_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!($result = $appdb->query("delete from tbl_childsettings where childsettings_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!($result = $appdb->query("delete from tbl_downlinesettings where downlinesettings_customerid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}*/

					/*if(!empty($retval['rowid'])&&!empty($post['virtualnumber_mobileno'])&&is_array($post['virtualnumber_mobileno'])) {

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
					}*/

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='contactdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Retailer successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_virtualnumber where virtualnumber_customerid in (".$rowids.")"))) {
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

						if(!($result = $appdb->query("delete from tbl_virtualnumber where virtualnumber_customerid=".$post['rowid']))) {
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
				$params['tbAddress'] = array();
				$params['tbSetting'] = array();
				$params['tbAssignedSim'] = array();
				$params['tbUpline'] = array();

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
					'label' => 'RETAILER NO.',
					'name' => 'customer_mobileno',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => array('mask'=>'09999999999'),
					'value' => !empty($params['customerinfo']['customer_mobileno']) ? $params['customerinfo']['customer_mobileno'] : '',
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
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'COMPANY NAME',
					'name' => 'customer_companyname',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_companyname']) ? $params['customerinfo']['customer_companyname'] : '',
				);

				//$params['tbCustomer'][] = array(
				//	'type' => 'newcolumn',
				//	'offset' => $newcolumnoffset,
				//);

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

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				$accounttype = array('RETAILER');

				foreach($accounttype as $v) {
					$selected = false;
					if(!empty($params['customerinfo']['customer_type'])&&$params['customerinfo']['customer_type']==$v) {
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
					'label' => 'CUSTOMER TYPE',
					'name' => 'customer_type',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

        $params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'MINIMUM LOAD',
					'name' => 'customer_retailermin',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_retailermin']) ? $params['customerinfo']['customer_retailermin'] : '100',
				);

        $params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'MAXIMUM LOAD',
					'name' => 'customer_retailermax',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_retailermax']) ? $params['customerinfo']['customer_retailermax'] : '1000',
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				/*$accounttype = array('CASH','CREDIT');

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

				$accounttypecash = true;

				if(!empty($params['customerinfo']['customer_accounttype'])&&$params['customerinfo']['customer_accounttype']=='CREDIT') {
					$accounttypecash = false;
				}*/

				/*if($readonly) {
					$params['tbCustomer'][] = array(
						'type' => 'input',
						'label' => 'PARENT',
						'name' => 'customer_parent',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['customerinfo']['customer_parent']) ? getCustomerNameByID($params['customerinfo']['customer_parent']) : '',
					);
				} else {
					$params['tbCustomer'][] = array(
						'type' => 'combo',
						'label' => 'PARENT',
						'name' => 'customer_parent',
						'readonly' => $readonly,
						//'readonly' => true,
						//'comboType' => 'checkbox',
						//'required' => !$readonly,
						//'value' => !empty($params['customerinfo']['customer_parent']) ? $params['customerinfo']['customer_parent'] : '',
						'options' => array(), //$opt,
					);
				}*/

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

				$params['tbSetting'][] = array(
					'type' => 'container',
					'name' => 'customer_setting',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_setting_'.$post['formval'],
				);

				$params['tbAssignedSim'][] = array(
					'type' => 'container',
					'name' => 'customer_assignedsim',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_assignedsim_'.$post['formval'],
				);

				$params['tbUpline'][] = array(
					'type' => 'container',
					'name' => 'customer_upline',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'customer_upline_'.$post['formval'],
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_contactdetailretailer

		function _form_contactdetailretailer2($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb, $appsession;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='contactnew'||$post['method']=='contactedit')) {
					$_SESSION['UPLOADS'] = array();
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='contactedit')) {
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
				if(!empty($post['method'])&&$post['method']=='contactphotoget') {

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
				if(!empty($post['method'])&&$post['method']=='contactphotoupload') {

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
				if(!empty($post['method'])&&$post['method']=='contactsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Customer successfully saved!';

					//pre(array('$vars'=>$this->vars));
					//die;

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
				if(!empty($post['method'])&&$post['method']=='contactdelete') {

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
				$imagepost['method'] = 'contactphotoget';
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
					'method' => 'contactphotoupload',
					'rowid' => !empty($post['rowid']) ? $post['rowid'] : 0,
					'formval' => $post['formval'],
				);

				$params['tbIdentification'][] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$imagepost = $post;
				$imagepost['method'] = 'contactphotoget';
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
					'method' => 'contactphotoupload',
					'rowid' => !empty($post['rowid']) ? $post['rowid'] : 0,
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

		} // _form_contactdetailretailer

		function _form_contactdetailremittance($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb, $appsession;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='contactnew'||$post['method']=='contactedit')) {
					$_SESSION['UPLOADS'] = array();
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='contactedit')) {
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
				if(!empty($post['method'])&&$post['method']=='contactphotoget') {

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
				if(!empty($post['method'])&&$post['method']=='contactphotoupload') {

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
				if(!empty($post['method'])&&$post['method']=='contactsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Customer successfully saved!';

					//pre(array('$vars'=>$this->vars));
					//die;

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
				if(!empty($post['method'])&&$post['method']=='contactdelete') {

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
				$imagepost['method'] = 'contactphotoget';
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
					'method' => 'contactphotoupload',
					'rowid' => $post['rowid'],
					'formval' => $post['formval'],
				);

				$params['tbIdentification'][] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$imagepost = $post;
				$imagepost['method'] = 'contactphotoget';
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
					'method' => 'contactphotoupload',
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

		} // _form_contactdetailremittance

		function _form_contactdetailsupplier($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb, $appsession;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='contactnew'||$post['method']=='contactedit')) {
					$_SESSION['UPLOADS'] = array();

					if(!($result = $appdb->query("delete from tbl_upload where upload_sid='".$appsession->id()."' and upload_temp=1"))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='contactedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_supplier where supplier_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['supplier_id'])) {
							$params['supplierinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='getnetwork') {

					$retval = array();
					$retval['network'] = getNetworkName($this->vars['post']['mobileno']);

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='contactphotoget') {

					if(!empty($post['_method'])&&$post['_method']=='contactnew'&&empty($_GET['itemId'])) {
						header("Content-Type: image/jpg");
						die();
					}

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
						if(!empty($post['rowid'])) {
						} else {
							$post['rowid'] = 0;
						}
						if(!($result = $appdb->query("select * from tbl_upload where upload_name='".$post['name']."' and upload_supplierid=".$post['rowid']." order by upload_id desc limit 1"))) {
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
				if(!empty($post['method'])&&$post['method']=='contactphotoupload') {

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

							if(!($result = $appdb->query("select * from tbl_upload where upload_supplierid=0 and upload_sid='".$content['upload_sid']."' and upload_name='".$post['itemId']."'"))) {
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
				if(!empty($post['method'])&&$post['method']=='contactsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Supplier successfully saved!';

					//pre(array('$vars'=>$this->vars));
					//die;

					$content = array();
					$content['supplier_firstname'] = !empty($post['supplier_firstname']) ? $post['supplier_firstname'] : '';
					$content['supplier_lastname'] = !empty($post['supplier_lastname']) ? $post['supplier_lastname'] : '';
					$content['supplier_middlename'] = !empty($post['supplier_middlename']) ? $post['supplier_middlename'] : '';
					$content['supplier_suffix'] = !empty($post['supplier_suffix']) ? $post['supplier_suffix'] : '';
					$content['supplier_birthdate'] = !empty($post['supplier_birthdate']) ? $post['supplier_birthdate'] : '';
					$content['supplier_gender'] = !empty($post['supplier_gender']) ? $post['supplier_gender'] : '';
					$content['supplier_civilstatus'] = !empty($post['supplier_civilstatus']) ? $post['supplier_civilstatus'] : '';
					$content['supplier_type'] = !empty($post['supplier_type']) ? $post['supplier_type'] : '';
					$content['supplier_company'] = !empty($post['supplier_companyname']) ? $post['supplier_companyname'] : '';
					$content['supplier_pahouseno'] = !empty($post['supplier_pahouseno']) ? $post['supplier_pahouseno'] : '';
					$content['supplier_pabarangay'] = !empty($post['supplier_pabarangay']) ? $post['supplier_pabarangay'] : '';
					$content['supplier_pamunicipality'] = !empty($post['supplier_pamunicipality']) ? $post['supplier_pamunicipality'] : '';
					$content['supplier_paprovince'] = !empty($post['supplier_paprovince']) ? $post['supplier_paprovince'] : '';
					$content['supplier_pazipcode'] = !empty($post['supplier_pazipcode']) ? $post['supplier_pazipcode'] : '';
					$content['supplier_aahouseno'] = !empty($post['supplier_aahouseno']) ? $post['supplier_aahouseno'] : '';
					$content['supplier_aabarangay'] = !empty($post['supplier_aabarangay']) ? $post['supplier_aabarangay'] : '';
					$content['supplier_aamunicipality'] = !empty($post['supplier_aamunicipality']) ? $post['supplier_aamunicipality'] : '';
					$content['supplier_aaprovince'] = !empty($post['supplier_aaprovince']) ? $post['supplier_aaprovince'] : '';
					$content['supplier_aazipcode'] = !empty($post['supplier_aazipcode']) ? $post['supplier_aazipcode'] : '';
					$content['supplier_creditlimit'] = !empty($post['supplier_creditlimit']) ? floatval($post['supplier_creditlimit']) : 0;

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['supplier_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_supplier",$content,"supplier_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						$content['supplier_ymd'] = date('Ymd');

						if(!($result = $appdb->insert("tbl_supplier",$content,"supplier_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['supplier_id'])) {
							$retval['rowid'] = $result['returning'][0]['supplier_id'];
						}

					}

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_suppliernumber where suppliernumber_supplierid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['suppliernumber_mobileno'])&&is_array($post['suppliernumber_mobileno'])) {

						$customer_mobileno = '';

						foreach($post['suppliernumber_mobileno'] as $k=>$v) {
							$content = array();
							$content['suppliernumber_supplierid'] = $retval['rowid'];
							$content['suppliernumber_mobileno'] = !empty($post['suppliernumber_mobileno'][$k]) ? $post['suppliernumber_mobileno'][$k] : '';
							$content['suppliernumber_remittanceno'] = !empty($post['suppliernumber_remittanceno'][$k]) ? $post['suppliernumber_remittanceno'][$k] : '';
							$content['suppliernumber_trademoney'] = !empty($post['suppliernumber_trademoney'][$k]) ? $post['suppliernumber_trademoney'][$k] : 0;
							$content['suppliernumber_provider'] = !empty($post['suppliernumber_provider'][$k]) ? $post['suppliernumber_provider'][$k] : 0;

							if(!($result = $appdb->insert("tbl_suppliernumber",$content,"suppliernumber_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							//if(!empty($content['virtualnumber_default'])&&!empty($content['virtualnumber_active'])) {
							//	$customer_mobileno = $content['virtualnumber_mobileno'];
							//}
						}

						/*$content = array();
						$content['customer_mobileno'] = $customer_mobileno;

						if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}*/
					}

					if(!empty($retval['rowid'])) {
						if(!empty($_SESSION['UPLOADS'])) {

							$content = array();
							$content['upload_supplierid'] = $retval['rowid'];
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
				if(!empty($post['method'])&&$post['method']=='contactdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Supplier successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_supplier where supplier_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_supplier where supplier_id=".$post['rowid']))) {
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
				$params['tbContactNumbers'] = array();
				$params['tbTransactions'] = array();

				$custid = '';

				if(!empty($params['supplierinfo']['supplier_id'])&&!empty($params['supplierinfo']['supplier_ymd'])) {
					$custid = $params['supplierinfo']['supplier_ymd'] . sprintf('%04d', intval($params['supplierinfo']['supplier_id']));
				}

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'SUPPLIER ID',
					'name' => 'supplier_id',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $custid,
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'LAST NAME',
					'name' => 'supplier_lastname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_lastname']) ? $params['supplierinfo']['supplier_lastname'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'FIRST NAME',
					'name' => 'supplier_firstname',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_firstname']) ? $params['supplierinfo']['supplier_firstname'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'MIDDLE NAME',
					'name' => 'supplier_middlename',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_middlename']) ? $params['supplierinfo']['supplier_middlename'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'SUFFIX',
					'name' => 'supplier_suffix',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_suffix']) ? $params['supplierinfo']['supplier_suffix'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'COMPANY NAME',
					'name' => 'supplier_companyname',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_company']) ? $params['supplierinfo']['supplier_company'] : '',
				);

				$params['tbCustomer'][] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$params['tbCustomer'][] = array(
					'type' => 'calendar',
					'label' => 'BIRTH DATE',
					'name' => 'supplier_birthdate',
					'readonly' => true,
					'calendarPosition' => 'right',
					'dateFormat' => '%m-%d-%Y',
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_birthdate']) ? $params['supplierinfo']['supplier_birthdate'] : '',
				);

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				$gender = array('MALE','FEMALE');

				foreach($gender as $v) {
					$selected = false;
					if(!empty($params['supplierinfo']['supplier_gender'])&&$params['supplierinfo']['supplier_gender']==$v) {
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
					'name' => 'supplier_gender',
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
					if(!empty($params['supplierinfo']['supplier_civilstatus'])&&$params['supplierinfo']['supplier_civilstatus']==$v) {
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
					'name' => 'supplier_civilstatus',
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
					if(!empty($params['supplierinfo']['supplier_type'])&&$params['supplierinfo']['supplier_type']==$v) {
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
					'name' => 'supplier_type',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				//$params['tbCustomer'][] = array(
				//	'type' => 'newcolumn',
				//	'offset' => $newcolumnoffset,
				//);

				$params['tbCustomer'][] = array(
					'type' => 'input',
					'label' => 'CREDIT LIMIT',
					'name' => 'customer_creditlimit',
					'readonly' => $readonly,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					//'required' => !$readonly,
					'value' => !empty($params['customerinfo']['customer_creditlimit']) ? $params['customerinfo']['customer_creditlimit'] : '',
				);

				$imagepost = $post;
				$imagepost['method'] = 'contactphotoget';
				$imagepost['name'] = 'supplier_photo';
				$imagepost['_method'] = $post['method'];

				$imagedata = urlencode(base64_encode(gzcompress(json_encode($imagepost),9)));

				$params['tbIdentification'][] = array(
					'type' => 'image',
					'label' => 'Supplier Photo',
					'labelWidth' => 120,
					'name' => 'supplier_photo',
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
					'method' => 'contactphotoupload',
					'rowid' => !empty($post['rowid']) ? $post['rowid'] : 0,
					'formval' => $post['formval'],
				);

				$params['tbIdentification'][] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$imagepost = $post;
				$imagepost['method'] = 'contactphotoget';
				$imagepost['name'] = 'supplier_idphoto';
				$imagepost['_method'] = $post['method'];

				$imagedata = urlencode(base64_encode(gzcompress(json_encode($imagepost),9)));

				$params['tbIdentification'][] = array(
					'type' => 'image',
					'label' => 'Supplier ID',
					'labelWidth' => 120,
					'name' => 'supplier_idphoto',
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
					'method' => 'contactphotoupload',
					'rowid' => !empty($post['rowid']) ? $post['rowid'] : 0,
					'formval' => $post['formval'],
				);

				$params['tbAddress'][] = array(
					'type' => 'label',
					'label' => 'PRESENT ADDRESS',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'HOUSE NO / STREET NAME',
					'name' => 'supplier_pahouseno',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_pahouseno']) ? $params['supplierinfo']['supplier_pahouseno'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'BARANGAY',
					'name' => 'supplier_pabarangay',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_pabarangay']) ? $params['supplierinfo']['supplier_pabarangay'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'MUNICIPALITY',
					'name' => 'supplier_pamunicipality',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_pamunicipality']) ? $params['supplierinfo']['supplier_pamunicipality'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'PROVINCE',
					'name' => 'supplier_paprovince',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_paprovince']) ? $params['supplierinfo']['supplier_paprovince'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'ZIP CODE',
					'name' => 'supplier_pazipcode',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_pazipcode']) ? $params['supplierinfo']['supplier_pazipcode'] : '',
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
					'name' => 'supplier_aahouseno',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_aahouseno']) ? $params['supplierinfo']['supplier_aahouseno'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'BARANGAY',
					'name' => 'supplier_aabarangay',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_aabarangay']) ? $params['supplierinfo']['supplier_aabarangay'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'MUNICIPALITY',
					'name' => 'supplier_aamunicipality',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_aamunicipality']) ? $params['supplierinfo']['supplier_aamunicipality'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'PROVINCE',
					'name' => 'supplier_aaprovince',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_aaprovince']) ? $params['supplierinfo']['supplier_aaprovince'] : '',
				);

				$params['tbAddress'][] = array(
					'type' => 'input',
					'label' => 'ZIP CODE',
					'name' => 'supplier_aazipcode',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['supplierinfo']['supplier_aazipcode']) ? $params['supplierinfo']['supplier_aazipcode'] : '',
				);

				$params['tbSupplierNumbers'][] = array(
					'type' => 'container',
					'name' => 'supplier_suppliernumbers',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'supplier_suppliernumbers_'.$post['formval'],
				);

				$params['tbTransactions'][] = array(
					'type' => 'container',
					'name' => 'supplier_suppliertransactions',
					'inputWidth' => 450,
					'inputHeight' => 200,
					'className' => 'supplier_suppliertransactions_'.$post['formval'],
				);


				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_contactdetailsupplier

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
						if(!($result = $appdb->query("select * from tbl_customer where customer_type in ('STAFF','REGULAR','ADMIN') order by customer_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['customer_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$custid = $v['customer_ymd'] . sprintf('%04d', $v['customer_id']);

								$rows[] = array('id'=>$v['customer_id'],'data'=>array(0,$custid,$v['customer_mobileno'],$v['customer_lastname'],$v['customer_firstname'],$v['customer_middlename'],$v['customer_type'],$v['customer_suffix']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='retailer') {
						if(!($result = $appdb->query("select * from tbl_customer where customer_type in ('RETAILER') order by customer_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['customer_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$custid = $v['customer_ymd'] . sprintf('%04d', $v['customer_id']);

								$rows[] = array('id'=>$v['customer_id'],'data'=>array(0,$custid,$v['customer_mobileno'],$v['customer_lastname'],$v['customer_firstname'],$v['customer_middlename'],$v['customer_type'],$v['customer_suffix']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='supplier') {
						if(!($result = $appdb->query("select * from tbl_supplier order by supplier_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['supplier_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$custid = $v['supplier_ymd'] . sprintf('%04d', $v['supplier_id']);

								$rows[] = array('id'=>$v['supplier_id'],'data'=>array(0,$custid,$v['supplier_mobileno'],$v['supplier_lastname'],$v['supplier_firstname'],$v['supplier_middlename'],$v['supplier_suffix']));
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

					} else
					if($this->post['table']=='suppliercontactnumber') {
						if(!($result = $appdb->query("select * from tbl_suppliernumber where suppliernumber_supplierid=".$this->post['rowid']." order by suppliernumber_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						$ctr=1;

						$rows = array();

						if(!empty($result['rows'][0]['suppliernumber_id'])) {
							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$ctr,'data'=>array($ctr,$v['suppliernumber_mobileno'],$v['suppliernumber_remittanceno'],$v['suppliernumber_trademoney'],$v['suppliernumber_provider']));
								$ctr++;
							}
						}

						while($ctr<=10) {
							$rows[] = array('id'=>$ctr,'data'=>array($ctr,'','','',''));
							$ctr++;
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='downline') {

						$downline = getCustomerDownline($this->post['rowid']);

						//pre(array('$downline'=>$downline));

						$optdiscount = array(array('text'=>'','value'=>''));

						$rows = array();

						if(!empty($downline)&&is_array($downline)) {
							foreach($downline as $k=>$v) {
								$custid = $v['customer_ymd'] . sprintf('%04d', $v['customer_id']);

								$customerName = !empty($v['customer_firstname']) ? $v['customer_firstname'] : '';
								$customerName .= !empty($v['customer_middlename']) ? ' '.$v['customer_middlename'] : '';
								$customerName .= !empty($v['customer_lastname']) ? ' '.$v['customer_lastname'] : '';

								$rows[] = array('id'=>$k,'data'=>array($custid,$v['customer_mobileno'],$customerName,getTotalRebateAsChild($v['customer_id'])));
							}
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='downlinesettings') {

						$settings = getCustomerDownlineSettings($this->post['rowid'],1);

						$downline = getCustomerDownline($this->post['rowid']);

						$discount = getDiscountScheme();

						pre(array('$downline'=>$downline,'$settings'=>$settings));

						foreach($discount as $k=>$v) {
							$optdiscount[] = array('text'=>$v['discount_desc'],'value'=>$v['discount_desc']);
						}

						$rows = array();

						$optflag = false;

						if(!empty($downline)&&is_array($downline)) {
							foreach($downline as $k=>$v) {
								//$custid = $v['customer_ymd'] . sprintf('%04d', $v['customer_id']);

								$customerName = !empty($v['customer_firstname']) ? $v['customer_firstname'] : '';
								$customerName .= !empty($v['customer_middlename']) ? ' '.$v['customer_middlename'] : '';
								$customerName .= !empty($v['customer_lastname']) ? ' '.$v['customer_lastname'] : '';

								$cdiscount = '';

								if(!empty($settings[$v['customer_mobileno']])) {
									$cdiscount = $settings[$v['customer_mobileno']]['downlinesettings_discount'];
								}

								if(!$optflag) {
									$rows[] = array('id'=>$k,'discount'=>array('options'=>$optdiscount),'data'=>array($v['customer_mobileno'],$customerName,$cdiscount));
								} else {
									$rows[] = array('id'=>$k,'data'=>array($v['customer_mobileno'],$customerName,$cdiscount));
								}
							}
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='child') {

						$children = getCustomerChild($this->post['rowid']);

						$rows = array();

						if(!empty($children)&&is_array($children)) {
							foreach($children as $k=>$v) {
								$custid = $v['customer_ymd'] . sprintf('%04d', $v['customer_id']);

								$customerName = !empty($v['customer_firstname']) ? $v['customer_firstname'] : '';
								$customerName .= !empty($v['customer_middlename']) ? ' '.$v['customer_middlename'] : '';
								$customerName .= !empty($v['customer_lastname']) ? ' '.$v['customer_lastname'] : '';

								$rows[] = array('id'=>$k,'data'=>array($custid,$v['customer_mobileno'],$customerName,getTotalRebateAsChild($v['customer_id'])));
							}
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='childsettings') {

						if(!($result = $appdb->query("select * from tbl_childsettings where childsettings_customerid=".$this->post['rowid']." order by childsettings_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$ctr=1;
						$max=10;

						$rows = array();

						$provider = getProviders();
						$category = array('SMART RETAILER','GLOBE RETAILER','SUN RETAILER');
						$type = array('RETAIL','DEALER');
						$discount = getDiscountScheme();

						$optcategory = array(array('text'=>'','value'=>''));
						$optprovider = array(array('text'=>'','value'=>''));
						$opttype = array(array('text'=>'','value'=>''));
						$optdiscount = array(array('text'=>'','value'=>''));

						foreach($provider as $k=>$v) {
							$optprovider[] = array('text'=>$v,'value'=>$v);
						}

						foreach($category as $k=>$v) {
							$optcategory[] = array('text'=>$v,'value'=>$v);
						}

						foreach($type as $k=>$v) {
							$opttype[] = array('text'=>$v,'value'=>$v);
						}

						foreach($discount as $k=>$v) {
							$optdiscount[] = array('text'=>$v['discount_desc'],'value'=>$v['discount_desc']);
						}

						if(!empty($result['rows'][0]['childsettings_id'])) {
							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$ctr,'data'=>array($ctr,$v['childsettings_provider'],$v['childsettings_category'],$v['childsettings_type'],$v['childsettings_discount']));
								$ctr++;
								$max++;
							}
						}

						while($ctr<=$max) {
							$rows[] = array('id'=>$ctr,'provider'=>array('options'=>$optprovider),'category'=>array('options'=>$optcategory),'type'=>array('options'=>$opttype),'discount'=>array('options'=>$optdiscount),'data'=>array($ctr,'','','',''));
							$ctr++;
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='transaction') {

						if(!($result = $appdb->query("select * from tbl_ledger where ledger_user=".$this->post['rowid']." order by ledger_datetimeunix asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						$rows = array();

						if(!empty($result['rows'][0]['ledger_id'])) {
							foreach($result['rows'] as $k=>$v) {

								$mobileNo = getLoadTransactionMobileNumber($v['ledger_loadtransactionid']);

								if(!$mobileNo) {
									$mobileNo = getCustomerNumber($v['ledger_user']);

									if(!$mobileNo) {
										$mobileNo = '';
									}
								}

								$rows[] = array('id'=>$v['ledger_id'],'data'=>array($v['ledger_id'],($k+1),pgDateUnix($v['ledger_datetimeunix']),$v['ledger_receiptno'],$v['ledger_type'],$mobileNo,$v['ledger_debit'],$v['ledger_credit'],$v['ledger_balance'],$v['ledger_rebate'],$v['ledger_rebatebalance']));
							}
						}

						$retval = array('rows'=>$rows);
					} else
					if($this->post['table']=='retailersetting') {
						$result = array();
						//if(!($result = $appdb->query("select * from tbl_virtualnumber where virtualnumber_customerid=".$this->post['rowid']." order by virtualnumber_id asc"))) {
						//	json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						//	die;
						//}
						//pre(array('$result'=>$result));

						$dsim = getAllDealerSimCard();

						$acustomer = getAllCustomers(false,'customer_lastname asc');

						//pre(array('$dsim'=>$dsim));

						$ctr=1;

						$rows = array();

						$optflg = false;

						if(!empty($result['rows'][0]['retailernumber_id'])) {
							foreach($result['rows'] as $k=>$v) {
								$row = array('id'=>$ctr,'data'=>array($ctr,$v['retailernumber_mobileno'],$v['retailernumber_provider'],$v['retailernumber_category'],$v['retailernumber_sim'],$v['retailernumber_upline']));

								if(!$optflg) {
									$opt = array(array('text'=>'','value'=>''));

									foreach($dsim as $x) {
										$opt[] = array('text'=>$x['simcard_number'],'value'=>$x['simcard_number']);
									}

									$row['dealersim'] = array('options'=>$opt);

									$opt = array();

									foreach($acustomer as $g=>$h) {
										$opt[] = array('value'=>$h['customer_id'],'text'=>array(
											'customermobileno' => !empty($h['customer_mobileno']) ? $h['customer_mobileno'] : ' ',
											'customerfirstname' => !empty($h['customer_firstname']) ? $h['customer_firstname'] : ' ',
											'customerlastname' => !empty($h['customer_lastname']) ? $h['customer_lastname'] : ' ',
											'customermiddlename' => !empty($h['customer_middlename']) ? $h['customer_middlename'] : ' '
										));
									}

									$row['upline'] = array('options'=>$opt);

									$optflg = true;
								}

								$rows[] = $row;

								$ctr++;
							}
						}

						while($ctr<=10) {
							$row = array('id'=>$ctr,'data'=>array($ctr,'','','','',''));

							if(!$optflg) {
								$opt = array(array('text'=>'','value'=>''));

								foreach($dsim as $x) {
									$opt[] = array('text'=>$x['simcard_number'],'value'=>$x['simcard_number']);
								}

								$row['dealersim'] = array('options'=>$opt);

								$opt = array();

								foreach($acustomer as $g=>$h) {
									$opt[] = array('value'=>$h['customer_id'],'checked'=>false,'text'=>array(
										'checkbox' => '1',
										'customermobileno' => !empty($h['customer_mobileno']) ? $h['customer_mobileno'] : ' ',
										'customerfirstname' => !empty($h['customer_firstname']) ? $h['customer_firstname'] : ' ',
										'customerlastname' => !empty($h['customer_lastname']) ? $h['customer_lastname'] : ' ',
										'customermiddlename' => !empty($h['customer_middlename']) ? $h['customer_middlename'] : ' '
									));
								}

								$row['upline'] = $opt;

								$optflg = true;
							}

							$rows[] = $row;

							$ctr++;
						}

						$retval = array('rows'=>$rows);

					} else
					if($this->post['table']=='retailerassignedsim') {

						//$result = array();

						if(!($result = $appdb->query("select * from tbl_retailerassignedsim where retailerassignedsim_customerid=".$this->post['rowid']." order by retailerassignedsim_seq asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$dsim = getAllDealerSimCard(false,1);

						$acustomer = getAllCustomers(false,'customer_lastname asc');

						//pre(array('$result'=>$result));

						//pre(array('$dsim'=>$dsim));

						$modemcommands = array();

						if(($modemcommands = getModemCommands(1))) {
						} else {
							$modemcommands = array();
						}

						$ctr=1;

						$seq=0;

						$rows = array();

						$optflg = false;

						if(!empty($result['rows'][0]['retailerassignedsim_id'])) {
							foreach($result['rows'] as $k=>$v) {

								if(!empty($dsim[$v['retailerassignedsim_simnumber']])) {
									$seq = intval($v['retailerassignedsim_seq']);

									$row = array('id'=>$ctr,'data'=>array($seq,$v['retailerassignedsim_active'],getSimNameByNumber($v['retailerassignedsim_simnumber']),$v['retailerassignedsim_simcommand']));

									if(!$optflg) {
										$opt = array(array('text'=>'','value'=>''));

										foreach($modemcommands as $x) {
											$opt[] = array('text'=>$x,'value'=>$x);
										}

										$row['options'] = array('options'=>$opt);
										$optflg = true;
									}

									$rows[] = $row;

									unset($dsim[$v['retailerassignedsim_simnumber']]);

									$ctr++;
								}
							}
						}

						$seq++;

						if(!empty($dsim)) {
							foreach($dsim as $k=>$v) {
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
					if($this->post['table']=='retailerupline') {

						//$result = array();

						if(!($result = $appdb->query("select * from tbl_retailerupline where retailerupline_customerid=".$this->post['rowid']." order by retailerupline_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$ctr = 1;

						$acustomer = getAllCustomers(false,'customer_lastname asc',1);

						$optflg = false;

						//pre(array('$acustomer'=>$acustomer));

						if(!empty($result['rows'][0]['retailerupline_id'])) {
							foreach($result['rows'] as $k=>$v) {

								if(!empty($acustomer[$v['retailerupline_uplineid']])) {
									//$row = array('id'=>$ctr,'data'=>array($ctr,getCustomerFullname($v['retailerupline_uplineid'],true)));
									$row = array('id'=>$ctr,'data'=>array($ctr,$v['retailerupline_uplineid']));

									if(!$optflg) {
										$opt = array(array('text'=>'','value'=>''));

										foreach($acustomer as $x) {
											$fname = getCustomerFullname($x['customer_id'],true);
											$opt[] = array('text'=>$fname,'value'=>$x['customer_id']);
										}

										$row['options'] = array('options'=>$opt);
										$optflg = true;
									}

									$rows[] = $row;

									unset($acustomer[$v['retailerupline_customerid']]);

									$ctr++;
								}
							}
						}

						while($ctr<=10) {
							$row = array('id'=>$ctr,'data'=>array($ctr,''));

							if(!$optflg) {
								$opt = array(array('text'=>'','value'=>''));

								foreach($acustomer as $x) {
									$fname = getCustomerFullname($x['customer_id'],true);
									$opt[] = array('text'=>$fname,'value'=>$x['customer_id']);
								}

								$row['options'] = array('options'=>$opt);
								$optflg = true;
							}

							$rows[] = $row;

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

	$appappcontact = new APP_app_contact;
}

# eof modules/app.user
