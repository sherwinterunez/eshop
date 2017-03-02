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

if(!class_exists('APP_app_discount')) {

	class APP_app_discount extends APP_Base_Ajax {
	
		var $desc = 'Discount';

		var $pathid = 'discount';
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

			$appaccess->rules($this->desc,'Discount Module');

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

		function _form_discountmainscheme($routerid=false,$formid=false) {
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
			
		} // _form_discountmainscheme

		function _form_discountmaintransferfee($routerid=false,$formid=false) {
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
			
		} // _form_discountmaintransferfee

		function _form_discountmainrebate($routerid=false,$formid=false) {
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
			
		} // _form_discountmainrebate

		function _form_discountdetailscheme($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				$params = array();

				$post = $this->vars['post'];

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='discountnew'||$this->vars['post']['method']=='discountedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='discountedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_discount where discount_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

						if(!empty($result['rows'][0]['discount_id'])) {
							$params['discountinfo'] = $result['rows'][0];
						}
					}
				} else 
				if(!empty($post['method'])&&$post['method']=='discountsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim card successfully saved!';

					$content = array();
					$content['discount_desc'] = !empty($post['discount_desc']) ? $post['discount_desc'] : '';
					$content['discount_active'] = !empty($post['discount_active']) ? 1 : 0;

					//pre(array('$post'=>$post));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['discount_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_discount",$content,"discount_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

					} else {

						if(!($result = $appdb->insert("tbl_discount",$content,"discount_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

						if(!empty($result['returning'][0]['discount_id'])) {
							$retval['rowid'] = $result['returning'][0]['discount_id'];
						}

					}

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_discountlist where discountlist_discountid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['discountlist_type'])&&is_array($post['discountlist_type'])) {
						foreach($post['discountlist_type'] as $k=>$v) {
							$content = array();
							$content['discountlist_discountid'] = $retval['rowid'];
							$content['discountlist_type'] = !empty($post['discountlist_type'][$k]) ? $post['discountlist_type'][$k] : '';
							$content['discountlist_provider'] = !empty($post['discountlist_provider'][$k]) ? $post['discountlist_provider'][$k] : '';
							$content['discountlist_simcard'] = !empty($post['discountlist_simcard'][$k]) ? getSimNumberByName($post['discountlist_simcard'][$k]) : '';
							$content['discountlist_fee'] = !empty($post['discountlist_fee'][$k]) ? $post['discountlist_fee'][$k] : 0;
							$content['discountlist_amount'] = !empty($post['discountlist_amount'][$k]) ? $post['discountlist_amount'][$k] : 0;
							$content['discountlist_rate'] = !empty($post['discountlist_rate'][$k]) ? trim(str_replace('%','',$post['discountlist_rate'][$k])) : 0;
							$content['discountlist_min'] = !empty($post['discountlist_min'][$k]) ? trim(str_replace(',','',$post['discountlist_min'][$k])) : 0;
							$content['discountlist_max'] = !empty($post['discountlist_max'][$k]) ? trim(str_replace(',','',$post['discountlist_max'][$k])) : 0;

							if(!($result = $appdb->insert("tbl_discountlist",$content,"discountlist_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;				
							}
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='discountdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Discount scheme successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_discount where discount_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;				
							}

							if(!($result = $appdb->query("delete from tbl_discountlist where discountlist_discountid in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;				
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_discount where discount_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

						if(!($result = $appdb->query("delete from tbl_discountlist where discountlist_discountid=".$post['rowid']))) {
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
					'name' => 'discount_desc',
					'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['discountinfo']['discount_desc']) ? $params['discountinfo']['discount_desc'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'discount_active',
					'readonly' => $readonly,
					'checked' => !empty($params['discountinfo']['discount_active'])  ? true : false,
					//'position' => 'label-right',
				);

				$params['tbDetails'][] = array(
					'type' => 'container',
					'name' => 'scheme_container',
					'inputWidth' => 900,
					'inputHeight' => 200,
					'className' => 'scheme_container_'.$post['formval'],
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}				
			}

			return false;
			
		} // _form_discountdetailscheme

		function _form_discountdetailtransferfee($routerid=false,$formid=false) {
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
			
		} // _form_discountdetailtransferfee

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

						$type = array('RETAIL','DEALER');
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