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

if(!class_exists('APP_app_tools')) {

	class APP_app_tools extends APP_Base_Ajax {
	
		var $desc = 'Tools';

		var $pathid = 'tools';
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

			$appaccess->rules($this->desc,'Tools Module');

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

		function _form_toolsmaintask($routerid=false,$formid=false) {
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
			
		} // _form_toolsmaintask

		function _form_toolsmainruncommand($routerid=false,$formid=false) {
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
			
		} // _form_toolsmainruncommand

		function _form_toolsmainarchive($routerid=false,$formid=false) {
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
			
		} // _form_toolsmainarchive

		function _form_toolsmainbackuprestore($routerid=false,$formid=false) {
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
			
		} // _form_toolsmainbackuprestore

		function _form_toolsdetailtask($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='toolsnew'||$this->vars['post']['method']=='toolsedit')) {
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
			
		} // _form_toolsdetailtask

		function _form_toolsdetailruncommand($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='toolsnew'||$this->vars['post']['method']=='toolsedit')) {
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
			
		} // _form_toolsdetailruncommand

		function _form_toolsdetailarchive($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='toolsnew'||$this->vars['post']['method']=='toolsedit')) {
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
			
		} // _form_toolsdetailarchive

		function _form_toolsdetailbackuprestore($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				if(!empty($this->vars['post']['method'])&&($this->vars['post']['method']=='toolsnew'||$this->vars['post']['method']=='toolsedit')) {
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
			
		} // _form_toolsdetailbackuprestore

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

				}			}

			return false;
		} // router($vars=false,$retflag=false)
		
	}

	$appapptools = new APP_app_tools;
}

# eof modules/app.user