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

		function _form_smartmoneymaincards($routerid=false,$formid=false) {
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

		} // _form_smartmoneymaincards

		function _form_smartmoneymainencashment($routerid=false,$formid=false) {
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

		} // _form_smartmoneymainencashment

		function _form_smartmoneymainunassigned($routerid=false,$formid=false) {
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

		} // _form_smartmoneymainencashment

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

				$smartmoneysettings_smartpadaladigits = getOption('$SMARTMONEYSETTINGS_SMARTPADALADIGITS',false);
				$smartmoneysettings_topupdigits = getOption('$SMARTMONEYSETTINGS_TOPUPDIGITS',false);
				$smartmoneysettings_paymayadigits = getOption('$SMARTMONEYSETTINGS_PAYMAYADIGITS',false);
				$smartmoneysettings_pickupanywheredigits = getOption('$SMARTMONEYSETTINGS_PICKUPANYWHEREDIGITS',false);

				$smartmoneysettings_smartpadalaprefix = getOption('$SMARTMONEYSETTINGS_SMARTPADALAPREFIX',false);
				$smartmoneysettings_topupprefix = getOption('$SMARTMONEYSETTINGS_TOPUPPREFIX',false);
				$smartmoneysettings_paymayaprefix = getOption('$SMARTMONEYSETTINGS_PAYMAYAPREFIX',false);
				$smartmoneysettings_pickupanywhereprefix = getOption('$SMARTMONEYSETTINGS_PICKUPANYWHEREPREFIX',false);

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

					setSetting('$SMARTMONEYSETTINGS_SMARTPADALADIGITS',!empty($post['smartmoneysettings_smartpadaladigits'])?$post['smartmoneysettings_smartpadaladigits']:false);
					setSetting('$SMARTMONEYSETTINGS_TOPUPDIGITS',!empty($post['smartmoneysettings_topupdigits'])?$post['smartmoneysettings_topupdigits']:false);
					setSetting('$SMARTMONEYSETTINGS_PAYMAYADIGITS',!empty($post['smartmoneysettings_paymayadigits'])?$post['smartmoneysettings_paymayadigits']:false);
					setSetting('$SMARTMONEYSETTINGS_PICKUPANYWHEREDIGITS',!empty($post['smartmoneysettings_pickupanywheredigits'])?$post['smartmoneysettings_pickupanywheredigits']:false);

					setSetting('$SMARTMONEYSETTINGS_SMARTPADALAPREFIX',!empty($post['smartmoneysettings_smartpadalaprefix'])?$post['smartmoneysettings_smartpadalaprefix']:false);
					setSetting('$SMARTMONEYSETTINGS_TOPUPPREFIX',!empty($post['smartmoneysettings_topupprefix'])?$post['smartmoneysettings_topupprefix']:false);
					setSetting('$SMARTMONEYSETTINGS_PAYMAYAPREFIX',!empty($post['smartmoneysettings_paymayaprefix'])?$post['smartmoneysettings_paymayaprefix']:false);
					setSetting('$SMARTMONEYSETTINGS_PICKUPANYWHEREPREFIX',!empty($post['smartmoneysettings_pickupanywhereprefix'])?$post['smartmoneysettings_pickupanywhereprefix']:false);

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				if($readonly) {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'SMART PADALA',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						'name' => 'smartmoneysettings_smartpadalaservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_smartpadalaservicefees) ? $smartmoneysettings_smartpadalaservicefees : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_smartpadaladigits',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_smartpadaladigits) ? $smartmoneysettings_smartpadaladigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_smartpadalaprefix',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_smartpadalaprefix) ? $smartmoneysettings_smartpadalaprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
					);

				} else {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'SMART PADALA',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

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

					$block[] = array(
						'type' => 'combo',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_smartpadalaservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_smartpadaladigits',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_smartpadaladigits) ? $smartmoneysettings_smartpadaladigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_smartpadalaprefix',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_smartpadalaprefix) ? $smartmoneysettings_smartpadalaprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
					);

				}

				if($readonly) {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'TOP-UP',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						'name' => 'smartmoneysettings_topupservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_topupservicefees) ? $smartmoneysettings_topupservicefees : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_topupdigits',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_topupdigits) ? $smartmoneysettings_topupdigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_topupprefix',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_topupprefix) ? $smartmoneysettings_topupprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
					);

				} else {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'TOP-UP',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

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

					$block[] = array(
						'type' => 'combo',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_topupservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_topupdigits',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_topupdigits) ? $smartmoneysettings_topupdigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_topupprefix',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_topupprefix) ? $smartmoneysettings_topupprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
					);
				}

				if($readonly) {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'PAYMAYA',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						'name' => 'smartmoneysettings_paymayaservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_paymayaservicefees) ? $smartmoneysettings_paymayaservicefees : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_paymayadigits',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_paymayadigits) ? $smartmoneysettings_paymayadigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_paymayaprefix',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_paymayaprefix) ? $smartmoneysettings_paymayaprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
					);

				} else {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'PAYMAYA',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

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

					$block[] = array(
						'type' => 'combo',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_paymayaservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_paymayadigits',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_paymayadigits) ? $smartmoneysettings_paymayadigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_paymayaprefix',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_paymayaprefix) ? $smartmoneysettings_paymayaprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
					);
				}

				if($readonly) {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'PICK-UP',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						'name' => 'smartmoneysettings_pickupanywhereservicefees',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_pickupanywhereservicefees) ? $smartmoneysettings_pickupanywhereservicefees : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_pickupanywheredigits',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_pickupanywheredigits) ? $smartmoneysettings_pickupanywheredigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_pickupanywhereprefix',
						'readonly' => true,
						'value' => !empty($smartmoneysettings_pickupanywhereprefix) ? $smartmoneysettings_pickupanywhereprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
					);

				} else {

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'PICK-UP',
						'labelWidth' => 110,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

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

					$block[] = array(
						'type' => 'combo',
						'label' => 'SERVICE FEES',
						'labelWidth' => 100,
						//'inputWidth' => 200,
						//'comboType' => 'checkbox',
						'name' => 'smartmoneysettings_pickupanywhereservicefees',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'DIGITS',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_pickupanywheredigits',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_pickupanywheredigits) ? $smartmoneysettings_pickupanywheredigits : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'input',
						'label' => 'PREFIX',
						'labelWidth' => 55,
						'inputWidth' => 60,
						'name' => 'smartmoneysettings_pickupanywhereprefix',
						'readonly' => false,
						'numeric' => true,
						'value' => !empty($smartmoneysettings_pickupanywhereprefix) ? $smartmoneysettings_pickupanywhereprefix : '',
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
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

		function _form_smartmoneydetailcards($routerid=false,$formid=false) {
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
						if(!($result = $appdb->query("select * from tbl_smartmoneynumber where smartmoneynumber_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['smartmoneynumber_id'])) {
							$params['cardinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Card number successfully saved!';

					$content = array();
					$content['smartmoneynumber_number'] = !empty($post['smartmoneynumber_number']) ? $post['smartmoneynumber_number'] : '';
					$content['smartmoneynumber_type'] = !empty($post['smartmoneynumber_type']) ? $post['smartmoneynumber_type'] : '';

					//pre(array('$post'=>$post));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['smartmoneynumber_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_smartmoneynumber",$content,"smartmoneynumber_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_smartmoneynumber",$content,"smartmoneynumber_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['smartmoneynumber_id'])) {
							$retval['rowid'] = $result['returning'][0]['smartmoneynumber_id'];
						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneydelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Card number successfully deleted!';

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

							if(!($result = $appdb->query("delete from tbl_smartmoneynumber where smartmoneynumber_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_smartmoneynumber where smartmoneynumber_id=".$post['rowid']))) {
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
					'labelWidth' => 200,
					'name' => 'smartmoneynumber_number',
					'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['cardinfo']['smartmoneynumber_number']) ? $params['cardinfo']['smartmoneynumber_number'] : '',
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				//$transactiontype = array('SMART PADALA','TOP-UP','PAYMAYA','PICK-UP ANYWHERE');

				$transactiontype = array('PADALA','TOPUP','PAYMAYA','PICKUP');

				foreach($transactiontype as $v) {
					$selected = false;
					if(!empty($params['cardinfo']['smartmoneynumber_type'])&&$params['cardinfo']['smartmoneynumber_type']==$v) {
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

				if($post['method']=='smartmoneynew'||$post['method']=='smartmoneyedit') {
					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'TRANSACTION TYPE',
						'name' => 'smartmoneynumber_type',
						'labelWidth' => 200,
						'readonly' => true,
						//'required' => !$readonly,
						'options' => $opt,
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'TRANSACTION TYPE',
						'name' => 'smartmoneynumber_type',
						'labelWidth' => 200,
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['cardinfo']['smartmoneynumber_type']) ? $params['cardinfo']['smartmoneynumber_type'] : '',
					);
				}

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_smartmoneydetailcards

		function _form_smartmoneydetailencashment($routerid=false,$formid=false) {
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

				if(!empty($post['method'])&&$post['method']=='getencashmentinfo') {

					$refnumber = !empty($post['refnumber']) ? trim($post['refnumber']) : false;

					$retval = array();
		      $retval['error_code'] = '345385';
		      $retval['error_message'] = 'Invalid Reference Number!';

					if(!empty($refnumber)) {
		      } else {
		        json_encode_return($retval);
		        die;
		      }

					$sql = "select * from tbl_loadtransaction where loadtransaction_type='smartmoney' and loadtransaction_smartmoneytype='RECEIVED' and loadtransaction_status=".TRN_CLAIMED." and loadtransaction_refnumber='$refnumber' and loadtransaction_cardlabel!='' limit 1";

					if(!($result = $appdb->query($sql))) {
		        json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
		        die;
		      }

					if(!empty($result['rows'][0]['loadtransaction_id'])) {
						$retval = array();
			      $retval['error_code'] = '345385';
			      $retval['error_message'] = 'This Reference Number was Already Claimed!';

						json_encode_return($retval);
		        die;
					}

					$sql = "select * from tbl_loadtransaction where loadtransaction_type='smartmoney' and loadtransaction_smartmoneytype='RECEIVED' and loadtransaction_status=".TRN_RECEIVED." and loadtransaction_refnumber='$refnumber' and loadtransaction_cardlabel!='' limit 1";

					if(!($result = $appdb->query($sql))) {
		        json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
		        die;
		      }

					if(!empty($result['rows'][0]['loadtransaction_id'])) {
						$retval = array();
						$retval['post'] = $post;
						$retval['data'] = $result['rows'][0];
						$retval['data']['loadtransaction_statusstr'] = getLoadTransactionStatusString($retval['data']['loadtransaction_status']);
					}

					json_encode_return($retval);
		      die;

				} else
		    if(!empty($post['method'])&&$post['method']=='getsenderdata') {

		      $senderid = !empty($post['senderid']) ? $post['senderid'] : false;

		      $retval = array();
		      $retval['error_code'] = '345325';
		      $retval['error_message'] = 'Invalid Remittance/Sender ID!';

		      if(!empty($senderid)) {
		      } else {
		        json_encode_return($retval);
		        die;
		      }

		      $sql = "select * from tbl_remitcust where remitcust_id=$senderid";

					//pre(array('$post'=>$post,'$senderid'=>$senderid,'$sql'=>$sql));

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

							$fullname = '';

							if(!empty($remitcust['remitcust_firstname'])) {
		            $fullname .= trim($remitcust['remitcust_firstname']).' ';
		          }

							if(!empty($remitcust['remitcust_middlename'])) {
		            $fullname .= trim($remitcust['remitcust_middlename']).' ';
		          }

							if(!empty($remitcust['remitcust_lastname'])) {
		            $fullname .= trim($remitcust['remitcust_lastname']);
		          }

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
								'sendername'=>trim($fullname),
		            'senderaddress'=>trim($address),
		            'sendernumber'=>$remitcustnumber_mobileno,
		            'senderidtype'=>$remitcust['remitcust_idtype'],
		            'senderspecifyid'=>$remitcust['remitcust_specifyid'],
		            'senderidnumber'=>$remitcust['remitcust_idnumber'],
		            'senderidexpiration'=>$remitcust['remitcust_idexpiration'],
		          );

		        } else {

							$retval = array();
				      $retval['error_code'] = '345325';
				      $retval['error_message'] = 'Invalid Remittance/Sender Mobile Number!';

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
				if(!empty($post['method'])&&($post['method']=='smartmoneyprint')) {
					$tpost = $post;

					$tpost['method'] = 'generatereport';

					$retval = array();
					$retval['topost'] = base64_encode(gzcompress(json_encode($tpost)));
					//$retval['post'] = $post;
					json_encode_return($retval);
				} else
				if(!empty($post['method'])&&($post['method']=='generatereport'||$post['method']=='generatereportprint')) {

					$params['tbReceipt'] = array();

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'JJS Telecom',
						'labelWidth' => 300,
						'className' => 'receiptHeader_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'Ziga Avenue, Brgy. Basud, Tabaco City, Albay, 4511',
						'labelWidth' => 300,
						'className' => 'receiptAddress_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'Smart Padala: 5577519312809107',
						'labelWidth' => 300,
						'className' => 'receiptSmartPadala_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'SMART MONEY REMITTANCE',
						'labelWidth' => 300,
						'className' => 'receiptTitle_'.$post['formval'],
					);

					$block = array();

					$block[] = array(
						'type' => 'label',
						'label' => 'RECEIPT NO.:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 10,
					);

					$block[] = array(
						'type' => 'label',
						'label' => 'XXXXXXXXXX',
						'labelWidth' => 160,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'block',
						'width' => 300,
						'blockOffset' => 0,
						'offsetTop' => 0,
						'list' => $block,
						'className' => 'block_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'REFERENCE NO.:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'DATE:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'AMOUNT RECEIVED:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'RECIPIENT NAME:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'ADDRESS:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'CASHIER:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'DATE/TIME:',
						'labelWidth' => 130,
						'className' => 'receiptDetails_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'Thank You. Come Again.',
						'labelWidth' => 300,
						'className' => 'receiptTitle_'.$post['formval'],
					);

					if($post['method']=='generatereportprint') {
						return json_encode($params);
						//pre(array('$post'=>$post));
					}

					json_encode_return($params);
					die;

				} else
		    if(!empty($post['method'])&&($post['method']=='smartmoneynew')) {

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

		          $custData = getRemitCustData($params['smartmoneyinfo']['loadtransaction_customerid']);

		          if(!empty($custData)&&is_array($custData)) {
		            foreach($custData as $k=>$v) {
		              $params['smartmoneyinfo'][$k] = $v;
		            }
		          }
		        }
		      }
		    } else
				if(!empty($post['method'])&&$post['method']=='smartmoneylock') {

					$refnumber = !empty($post['refnumber']) ? trim($post['refnumber']) : false;

					$retval = array();
		      $retval['error_code'] = '345385';
		      $retval['error_message'] = 'Invalid Reference Number!';

					if(!empty($refnumber)) {
		      } else {
		        json_encode_return($retval);
		        die;
		      }

					$sql = "select * from tbl_loadtransaction where loadtransaction_type='smartmoney' and loadtransaction_smartmoneytype='RECEIVED' and loadtransaction_status=".TRN_RECEIVED." and loadtransaction_refnumber='$refnumber' limit 1";

					if(!($result = $appdb->query($sql))) {
		        json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
		        die;
		      }

					if(!empty($result['rows'][0]['loadtransaction_id'])) {

						$retval = array();
			      $retval['return_code'] = 'SUCCESS';
			      $retval['return_message'] = 'Reference number has been locked!';
						$retval['post'] = $post;

						$content = array();
						$content['loadtransaction_status'] = TRN_LOCKED;
						$content['loadtransaction_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_type='smartmoney' and loadtransaction_smartmoneytype='RECEIVED' and loadtransaction_refnumber='$refnumber' and loadtransaction_status=".TRN_RECEIVED))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {
						$retval = array();
			      $retval['error_code'] = '345385';
			      $retval['error_message'] = 'Invalid Reference Number!';
					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave') {

					$retval = array();
		      $retval['error_code'] = '345925';
		      $retval['error_message'] = 'Invalid reference number/Locked has expired! Please cancel and try again!';

					$refnumber = !empty($post['loadtransaction_refnumber']) ? $post['loadtransaction_refnumber'] : false;

					if(!empty($refnumber)) {
		      } else {
		        json_encode_return($retval);
		        die;
		      }

					$sql = "select * from tbl_loadtransaction where loadtransaction_type='smartmoney' and loadtransaction_smartmoneytype='RECEIVED' and loadtransaction_status=".TRN_LOCKED." and loadtransaction_refnumber='$refnumber' limit 1";

					if(!($result = $appdb->query($sql))) {
		        json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
		        die;
		      }

					if(!empty($result['rows'][0]['loadtransaction_id'])) {
						$smartmoneyinfo = $result['rows'][0];
					} else {
						json_encode_return($retval);
		        die;
					}

					$retval = array();
		      $retval['return_code'] = 'SUCCESS';
		      $retval['return_message'] = 'SmartMoney Remittance successfully saved!';
					$retval['post'] = $post;
					$retval['smartmoneyinfo'] = $smartmoneyinfo;

					$userId = $applogin->getUserID();
		      $userData = $applogin->getUserData();

		      if(!empty($userData['user_staffid'])) {
		        $user_staffid = $userData['user_staffid'];
		        $customer_type = getCustomerType($userData['user_staffid']);
		      }

					$content = array();

					$dt = intval(getDbUnixDate());

					$content['loadtransaction_ymd'] = date('Ymd',$dt);
					$content['loadtransaction_status'] = TRN_CLAIMED;
					$content['loadtransaction_updatestamp'] = 'now()';
					$content['loadtransaction_receiverid'] = $content['loadtransaction_customerid'] = !empty($post['smartmoney_recipientname']) ? $post['smartmoney_recipientname']: 0;
					$content['loadtransaction_receivername'] = $content['loadtransaction_customername'] = !empty($post['smartmoney_fullname']) ? $post['smartmoney_fullname'] : '';
					$content['loadtransaction_receivernumber'] = !empty($post['smartmoney_recipientnumber']) ? $post['smartmoney_recipientnumber'] : '';
					$content['loadtransaction_receiveraddress'] = !empty($post['smartmoney_recipientaddress']) ? $post['smartmoney_recipientaddress'] : '';
					$content['loadtransaction_receiveridexpiration'] = !empty($post['smartmoney_idexpiration']) ? $post['smartmoney_idexpiration'] : '';
					$content['loadtransaction_receiveridnumber'] = !empty($post['smartmoney_idnumber']) ? $post['smartmoney_idnumber'] : '';
					$content['loadtransaction_receiveridtype'] = !empty($post['smartmoney_idtype']) ? $post['smartmoney_idtype'] : '';
					$content['loadtransaction_receiverspecifyid'] = !empty($post['smartmoney_specifyid']) ? $post['smartmoney_specifyid'] : '';
					$content['loadtransaction_amountdue'] = !empty($post['loadtransaction_amountdue']) ? $post['loadtransaction_amountdue'] : 0;
					$content['loadtransaction_staffid'] = !empty($user_staffid) ? $user_staffid : 0;
					$content['loadtransaction_otherchargesamount'] = !empty($post['smartmoney_otherchargesamount']) ? $post['smartmoney_otherchargesamount'] : 0;

					if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$smartmoneyinfo['loadtransaction_id']))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();
				$params['tbMessage'] = array();

				$receiptno = '';

				if(!empty($params['smartmoneyinfo']['loadtransaction_id'])&&!empty($params['smartmoneyinfo']['loadtransaction_ymd'])) {
					$receiptno = $params['smartmoneyinfo']['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['smartmoneyinfo']['loadtransaction_id']));
				}

				$params['tbDetails'][] = array(
		      'type' => 'hidden',
		      'name' => 'smartmoney_approved',
		      'value' => 0,
		    );

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT NO',
					'labelWidth' => 150,
					'name' => 'encashment_receiptno',
					'readonly' => true,
					//'required' => !$readonly,
					//'labelAlign' => $position,
					'value' => $receiptno,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIPT DATE/TIME',
					'labelWidth' => 150,
					'name' => 'encashment_date',
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_updatestamp']) ? pgDate($params['smartmoneyinfo']['loadtransaction_updatestamp']) : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO.',
					'labelWidth' => 150,
					'name' => 'loadtransaction_refnumber',
					'readonly' => $readonly,
		      'required' => !$readonly,
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_refnumber']) ? $params['smartmoneyinfo']['loadtransaction_refnumber'] : '',
				);

				$params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'AMOUNT',
		      'name' => 'loadtransaction_amount',
		      'labelWidth' => 150,
		      'readonly' => true,
		      //'required' => !$readonly,
		      'numeric' => true,
		      'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_amount']) ? number_format($params['smartmoneyinfo']['loadtransaction_amount'],2) : '',
		    );

				$params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'COMMISSION',
		      'name' => 'loadtransaction_receiveagentcommissionamount',
		      'labelWidth' => 150,
		      'readonly' => true,
		      //'required' => !$readonly,
		      'numeric' => true,
		      'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveagentcommissionamount']) ? number_format($params['smartmoneyinfo']['loadtransaction_receiveagentcommissionamount'],2) : '',
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
		          'label' => 'SERVICE CHARGE',
		          'name' => 'smartmoney_otherchargespercent',
		          'labelWidth' => 150,
		          'readonly' => true,
		          //'required' => !$readonly,
		          'inputMask' => array('alias'=>'percentage','prefix'=>'','autoUnmask'=>true),
		          //'value' => !empty($percent) ? number_format($percent,2) : 0,
		          'value' => !empty($params['smartmoneyinfo']['loadtransaction_otherchargespercent']) ? number_format($params['smartmoneyinfo']['loadtransaction_otherchargespercent'],2) : '',
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
		          'value' => !empty($params['smartmoneyinfo']['loadtransaction_otherchargesamount']) ? number_format($params['smartmoneyinfo']['loadtransaction_otherchargesamount'],2) : '',
		          'inputWidth' => 100,
		        ),
		      ),
		    );

				$params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'AMOUNT DUE',
		      'labelWidth' => 150,
		      //'inputWidth' => 100,
		      'name' => 'loadtransaction_amountdue',
		      'readonly' => true,
		      'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
		      //'required' => !$readonly,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_amountdue']) ? number_format($params['smartmoneyinfo']['loadtransaction_amountdue'],2) : '',
		    );

				$params['tbDetails'][] = array(
					'type' => 'hidden',
					'name' => 'smartmoney_fullname',
					'value' => '',
				);

				if($post['method']=='smartmoneynew') {
		      $params['tbDetails'][] = array(
		        'type' => 'combo',
		        'label' => 'RECIPIENT NAME',
		        'name' => 'smartmoney_recipientname',
		        'labelWidth' => 150,
		        'readonly' => $readonly,
		        'required' => !$readonly,
		        //'numeric' => true,
		        'options' => array(),
		      );
		    } else {
		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'RECIPIENT NAME',
		        'name' => 'smartmoney_recipientname',
		        'labelWidth' => 150,
		        'readonly' => $readonly,
		        'required' => !$readonly,
		        //'numeric' => true,
		        'value' => !empty($params['smartmoneyinfo']['loadtransaction_receivername']) ? $params['smartmoneyinfo']['loadtransaction_receivername'] : '',
		      );
		    }

				$params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'RECIPIENT NUMBER',
		      'name' => 'smartmoney_recipientnumber',
		      'labelWidth' => 150,
		      'readonly' => true,
		      //'required' => !$readonly,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_receivernumber']) ? $params['smartmoneyinfo']['loadtransaction_receivernumber'] : '',
		    );

				$params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'RECIPIENT ADDRESS',
		      'name' => 'smartmoney_recipientaddress',
		      'labelWidth' => 150,
					'inputWidth' => 300,
		      'readonly' => true,
					'rows' => 2,
		      //'required' => !$readonly,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveraddress']) ? $params['smartmoneyinfo']['loadtransaction_receiveraddress'] : '',
		    );

				$params['tbDetails'][] = array(
		      'type' => 'newcolumn',
		      'offset' => 50,
		    );

				$fund_username = !empty($params['smartmoneyinfo']['loadtransaction_staffid']) ? getCustomerNameByID($params['smartmoneyinfo']['loadtransaction_staffid']) : '';

		    if(!empty($fund_username)) {
		    } else {
		      $fund_username = !empty($params['smartmoneyinfo']['loadtransaction_username']) ? $params['smartmoneyinfo']['loadtransaction_username'] : $applogin->fullname();
		    }

		    $params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'USER',
					'labelWidth' => 150,
		      'name' => 'fund_username',
		      'readonly' => true,
		      //'inputWidth' => 150,
		      //'required' => !$readonly,
		      //'value' => $applogin->fullname(),
		      'value' => $fund_username,
		    );

		    if($post['method']=='smartmoneynew') {

		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS CODE',
						'labelWidth' => 150,
		        'name' => 'smartmoney_status',
		        'readonly' => true,
		        //'inputWidth' => 150,
		        'value' => TRN_DRAFT,
		      );

		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS',
						'labelWidth' => 150,
		        'name' => 'smartmoney_statustext',
		        'readonly' => true,
		        //'inputWidth' => 150,
		        //'required' => !$readonly,
		        'value' => getLoadTransactionStatusString(TRN_DRAFT),
		      );

		    } else {

					$params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS CODE',
						'labelWidth' => 150,
		        'name' => 'smartmoney_status',
		        'readonly' => true,
		        //'inputWidth' => 150,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_status']) ? $params['smartmoneyinfo']['loadtransaction_status'] : TRN_DRAFT,
		      );

		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS',
						'labelWidth' => 150,
		        'name' => 'smartmoney_statustext',
		        'readonly' => true,
		        //'inputWidth' => 150,
		        //'required' => !$readonly,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_status']) ? getLoadTransactionStatusString($params['smartmoneyinfo']['loadtransaction_status']) : getLoadTransactionStatusString(TRN_DRAFT),
		      );

				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NAME',
					'name' => 'smartmoney_customername',
					'labelWidth' => 150,
					'readonly' => true,
					//'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_customername']) ? $params['smartmoneyinfo']['loadtransaction_customername'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'CUSTOMER NUMBER',
					'name' => 'smartmoney_customernumber',
					'labelWidth' => 150,
					'readonly' => true,
					//'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_customernumber']) ? $params['smartmoneyinfo']['loadtransaction_customernumber'] : '',
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

		    /*if($post['method']=='smartmoneynew') {
		      $params['tbDetails'][] = array(
		        'type' => 'combo',
		        'label' => 'ID TYPE',
		        'name' => 'smartmoney_idtype',
		        'labelWidth' => 150,
		        'readonly' => true,
		        //'required' => !$readonly,
		        'options' => $opt,
		      );
		    } else {*/
		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'ID TYPE',
		        'name' => 'smartmoney_idtype',
		        'labelWidth' => 150,
		        'readonly' => true,
		        //'required' => !$readonly,
		        'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveridtype']) ? $params['smartmoneyinfo']['loadtransaction_receiveridtype'] : '',
		      );
		    //}

		    $params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'SPECIFY ID',
		      'name' => 'smartmoney_specifyid',
		      'labelWidth' => 150,
		      'readonly' => true,
		      //'required' => !$readonly,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiverspecifyid']) ? $params['smartmoneyinfo']['loadtransaction_receiverspecifyid'] : '',
		    );

		    $params['tbDetails'][] = array(
		      'type' => 'input',
		      'label' => 'ID NUMBER',
		      'name' => 'smartmoney_idnumber',
		      'labelWidth' => 150,
		      'readonly' => true,
		      //'required' => !$readonly,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveridnumber']) ? $params['smartmoneyinfo']['loadtransaction_receiveridnumber'] : '',
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

		    if($post['method']=='smartmoneynew') {
		      $params['tbDetails'][] = array(
		        'type' => 'calendar',
		        'label' => 'EXPIRATION DATE',
		        'name' => 'smartmoney_idexpiration',
		        'labelWidth' => 150,
		        'readonly' => true,
		        'calendarPosition' => 'right',
		        'dateFormat' => '%m-%d-%Y',
		        //'required' => !$readonly,
		        'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveridexpiration']) ? $params['smartmoneyinfo']['loadtransaction_receiveridexpiration'] : '',
		      );
		    } else {
		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'EXPIRATION DATE',
		        'name' => 'smartmoney_idexpiration',
		        'labelWidth' => 150,
		        'readonly' => true,
		        'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveridexpiration']) ? $params['smartmoneyinfo']['loadtransaction_receiveridexpiration'] : '',
		      );
		    }

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_smartmoneydetailencashment

		function _form_smartmoneydetailunassigned($routerid=false,$formid=false) {
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
						if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['loadtransaction_id'])) {
							$params['cardinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave') {

					if(!empty($post['unassigned_messagedate'])&&preg_match('/^(?<MM>\d+)\-(?<DD>\d+)\-(?<YY>\d+)$/si',$post['unassigned_messagedate'],$match)) {
						//pre(array('$match'=>$match));
					} else {
						$retval = array();
						$retval['error_code'] = 7457345;
						$retval['error_message'] = 'Invalid message date!';
						json_encode_return($retval);
						die;
					}

					if(!empty($post['unassigned_messagetime'])&&preg_match('/^(?<HH>\d+)\:(?<MM>\d+)\:(?<SS>\d+)$/si',$post['unassigned_messagetime'],$match)) {
						//pre(array('$match'=>$match));
					} else {
						$retval = array();
						$retval['error_code'] = 7457346;
						$retval['error_message'] = 'Invalid message time!';
						json_encode_return($retval);
						die;
					}

					$sdt = $post['unassigned_messagedate'];
					$stm = $post['unassigned_messagetime'];

					$smt = date2timestamp($sdt.' '.$stm,'m-d-Y h:i:s');

					//pre(array('id'=>$v,'$sdt'=>$sdt,'$stm'=>$stm,'$smt'=>$smt));

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Card number successfully saved!';

					$content = array();
					$content['loadtransaction_createstampunix'] = $smt;
					$content['loadtransaction_cardlabel'] = !empty($post['loadtransaction_cardlabel']) ? $post['loadtransaction_cardlabel'] : '';
					$content['loadtransaction_simcardbalance'] = !empty($post['loadtransaction_simcardbalance']) ? $post['loadtransaction_simcardbalance'] : 0;
					$content['loadtransaction_receiveagentcommissionamount'] = !empty($post['loadtransaction_receiveagentcommissionamount']) ? $post['loadtransaction_receiveagentcommissionamount'] : 0;
					$content['loadtransaction_fromnumber'] = !empty($post['loadtransaction_fromnumber']) ? $post['loadtransaction_fromnumber'] : '';
					$content['loadtransaction_otherchargesamount'] = !empty($post['loadtransaction_otherchargesamount']) ? $post['loadtransaction_otherchargesamount'] : '';
					//pre(array('$post'=>$post));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&intval($post['rowid'])>0) {

						$retval['rowid'] = $post['rowid'];

						$content['loadtransaction_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$post['rowid']))) {
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


//pgDateUnix($v['loadtransaction_createstampunix'], 'm-d-Y H:i:s');

				$unassigned_messagedate = '';
				$unassigned_messagetime = '';

				if(!empty($params['cardinfo']['loadtransaction_createstampunix'])) {
					$unassigned_messagedate = pgDateUnix($params['cardinfo']['loadtransaction_createstampunix'], 'm-d-Y');
					$unassigned_messagetime = pgDateUnix($params['cardinfo']['loadtransaction_createstampunix'], 'H:i:s');
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MESSAGE DATE',
					'labelWidth' => 150,
					'name' => 'unassigned_messagedate',
					'inputMask' => array('alias'=>'mm-dd-yyyy','prefix'=>'','autoUnmask'=>false),
					//'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => $unassigned_messagedate,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'labelWidth' => 150,
					'name' => 'loadtransaction_amount',
					//'inputWidth' => 500,
					'readonly' => true,
					//'required' => !$readonly,
					'numeric' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['cardinfo']['loadtransaction_amount']) ? $params['cardinfo']['loadtransaction_amount'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'BALANCE',
					'labelWidth' => 150,
					'name' => 'loadtransaction_simcardbalance',
					//'inputWidth' => 500,
					'readonly' => true,
					//'required' => !$readonly,
					'numeric' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['cardinfo']['loadtransaction_simcardbalance']) ? $params['cardinfo']['loadtransaction_simcardbalance'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'COMMISSION',
					'labelWidth' => 150,
					'name' => 'loadtransaction_receiveagentcommissionamount',
					//'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['cardinfo']['loadtransaction_receiveagentcommissionamount']) ? $params['cardinfo']['loadtransaction_receiveagentcommissionamount'] : 0,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'OTHER CHARGES',
					'labelWidth' => 150,
					'name' => 'loadtransaction_otherchargesamount',
					//'inputWidth' => 500,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'numeric' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['cardinfo']['loadtransaction_otherchargesamount']) ? $params['cardinfo']['loadtransaction_otherchargesamount'] : 0,
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				//$transactiontype = array('SMART PADALA','TOP-UP','PAYMAYA','PICK-UP ANYWHERE');

				$transactiontype = array('PADALA','TOPUP','PAYMAYA','PICKUP');

				$smartmoneys = getSmartMoneyOfSimNumber($params['cardinfo']['loadtransaction_assignedsim']);

				//pre(array('$smartmoneys'=>$smartmoneys));

				foreach($smartmoneys as $v) {
					$selected = false;
					//if(!empty($params['cardinfo']['smartmoneynumber_type'])&&$params['cardinfo']['smartmoneynumber_type']==$v) {
					//	$selected = true;
					//}
					if($readonly) {
						if($selected) {
							$opt[] = array('text'=>$v['smartmoney_label'].' / '.$v['smartmoney_number'],'value'=>$v['smartmoney_label'],'selected'=>$selected);
						}
					} else {
						$opt[] = array('text'=>$v['smartmoney_label'].' / '.$v['smartmoney_number'],'value'=>$v['smartmoney_label'],'selected'=>$selected);
					}
				}

				if($post['method']=='smartmoneynew'||$post['method']=='smartmoneyedit') {
					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'ASSIGNED CARD',
						'name' => 'loadtransaction_cardlabel',
						'labelWidth' => 150,
						'inputWidth' => 250,
						'readonly' => true,
						//'required' => !$readonly,
						'options' => $opt,
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'ASSIGNED CARD',
						'name' => 'loadtransaction_cardlabel',
						'labelWidth' => 150,
						'inputWidth' => 250,
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['cardinfo']['loadtransaction_cardlabel']) ? $params['cardinfo']['loadtransaction_cardlabel'] : '',
						//'value' => '',
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => 50,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MESSAGE TIME',
					'labelWidth' => 180,
					'name' => 'unassigned_messagetime',
					'inputMask' => array('alias'=>'hh:mm:ss','prefix'=>'','autoUnmask'=>false),
					//'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => $unassigned_messagetime,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'REFERENCE NO.',
					'labelWidth' => 180,
					'name' => 'loadtransaction_refnumber',
					//'inputWidth' => 500,
					'readonly' => true,
					//'required' => !$readonly,
					'value' => !empty($params['cardinfo']['loadtransaction_refnumber']) ? $params['cardinfo']['loadtransaction_refnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'MOBILE NO./CARD NO.',
					'labelWidth' => 180,
					'name' => 'loadtransaction_fromnumber',
					//'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['cardinfo']['loadtransaction_fromnumber']) ? $params['cardinfo']['loadtransaction_fromnumber'] : '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_smartmoneydetailunassigned

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

							$custData = getRemitCustData($params['smartmoneyinfo']['loadtransaction_customerid']);

							if(!empty($custData)&&is_array($custData)) {
								foreach($custData as $k=>$v) {
									$params['smartmoneyinfo'][$k] = $v;
								}
							}
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='smartmoneysave'&&!empty($post['rowid'])) {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Smart Money Transfer successfully updated!';

					if(!empty($post['smartmoney_status'])) {
						$content = array();
						$content['loadtransaction_status'] = $post['smartmoney_status'];
						$content['loadtransaction_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$retval['rowid'] = $post['rowid'];

						if(!empty($user_staffid)) {

							if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_id=".$post['rowid']))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['rows'][0]['loadtransaction_id'])) {
								$loadtransaction = $result['rows'][0];

								$receiptno = '';

								if(!empty($loadtransaction['loadtransaction_id'])&&!empty($loadtransaction['loadtransaction_ymd'])) {
									$receiptno = $loadtransaction['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($loadtransaction['loadtransaction_id']));
								}

								$content = array();
								$content['ledger_loadtransactionid'] = $loadtransaction['loadtransaction_id'];
								$content['ledger_debit'] = $loadtransaction['loadtransaction_amountdue'];

								$ledger_datetimeunix = intval(getDbUnixDate());

								$content['ledger_type'] = 'SMARTMONEY '.$loadtransaction['loadtransaction_smartmoneytype'].' '.$loadtransaction['loadtransaction_amount'];
								$content['ledger_datetime'] = pgDateUnix($ledger_datetimeunix);
								$content['ledger_datetimeunix'] = $ledger_datetimeunix;
								$content['ledger_user'] = $user_staffid;
								$content['ledger_seq'] = '0';
								$content['ledger_receiptno'] = $receiptno;

								//if(!empty($rebate_credit)) {
									//$content['ledger_rebate'] = $rebate_credit;
									//$content['ledger_rebatebalance'] = $rebate_balance;
								//}

								if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

								computeStaffBalance($user_staffid);
							}
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

					$smartmoney_transactiontype = !empty($post['smartmoney_transactiontype']) ? $post['smartmoney_transactiontype'] : '';

					if(!empty($smartmoney_transactiontype)) {
					} else {
						$retval = array();
						$retval['error_code'] = '345349';
						$retval['error_message'] = 'Invalid Transaction Type!';
						json_encode_return($retval);
						die;
					}

					$digit = array();

					$digit['PADALA'] = getOption('$SMARTMONEYSETTINGS_SMARTPADALADIGITS',false);
					$digit['TOPUP'] = getOption('$SMARTMONEYSETTINGS_TOPUPDIGITS',false);
					$digit['PAYMAYA'] = getOption('$SMARTMONEYSETTINGS_PAYMAYADIGITS',false);
					$digit['PICKUP'] = getOption('$SMARTMONEYSETTINGS_PICKUPANYWHEREDIGITS',false);

					$prefix = array();

					$prefix['PADALA'] = getOption('$SMARTMONEYSETTINGS_SMARTPADALAPREFIX',false);
					$prefix['TOPUP'] = getOption('$SMARTMONEYSETTINGS_TOPUPPREFIX',false);
					$prefix['PAYMAYA'] = getOption('$SMARTMONEYSETTINGS_PAYMAYAPREFIX',false);
					$prefix['PICKUP'] = getOption('$SMARTMONEYSETTINGS_PICKUPANYWHEREPREFIX',false);

					if(!empty($digit[$smartmoney_transactiontype])&&is_numeric($digit[$smartmoney_transactiontype])&&isValidCardNo($loadtransaction_cardno,$digit[$smartmoney_transactiontype])) {
					} else
					if(isSmartMoneyCardNo($loadtransaction_cardno)) {
					} else {
						if(isSmartMobileNo($loadtransaction_cardno)) {
						} else {
							json_encode_return($retval);
							die;
						}
					}

					if(!empty($prefix[$smartmoney_transactiontype])&&is_numeric($prefix[$smartmoney_transactiontype])) {
						if(isValidCardNoPrefix($loadtransaction_cardno,$prefix[$smartmoney_transactiontype])) {
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

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SmartMoney Remittance successfully saved!';
					$retval['post'] = $post;

					//$message = "SMARTMONEY PADALA $loadtransaction_cardno $loadtransaction_amount $smartmoney_sendernumber $smartmoney_receivernumber <STATUS> <LOADTRANSACTIONID>\r\n";

					$status = 'DRAFT';

					if(!empty($post['smartmoney_approved'])) {
						$status = 'APPROVED';
					}

					$message = "SMARTMONEY $smartmoney_transactiontype $loadtransaction_cardno $loadtransaction_amount $smartmoney_sendernumber $smartmoney_receivernumber $status <LOADTRANSACTIONID>\r\n";

					$content = array();
					$content['loadtransaction_ymd'] = $loadtransaction_ymd = date('Ymd');

					$content['loadtransaction_customerid'] = !empty($post['smartmoney_sendername']) ? $post['smartmoney_sendername'] : 0;
					$content['loadtransaction_customernumber'] = $smartmoney_sendernumber;
					$content['loadtransaction_customername'] = !empty($content['loadtransaction_customerid']) ? getRemitCustName($content['loadtransaction_customerid']) : '';

					$content['loadtransaction_senderid'] = $loadtransaction_senderid = !empty($post['smartmoney_sendername']) ? $post['smartmoney_sendername'] : 0;
					$content['loadtransaction_sendernumber'] = $smartmoney_sendernumber;
					$content['loadtransaction_sendername'] = !empty($content['loadtransaction_customerid']) ? getRemitCustName($content['loadtransaction_customerid']) : '';

					//$content['loadtransaction_simhotline'] = $loadtransaction_simhotline;
					$content['loadtransaction_keyword'] = $message;
					$content['loadtransaction_recipientnumber'] = $smartmoney_receivernumber;
					$content['loadtransaction_destcardno'] = $loadtransaction_cardno;
					$content['loadtransaction_destcardnomasked'] = maskedSmartMoneyNumber($loadtransaction_cardno);
					$content['loadtransaction_smartmoneytype'] = $smartmoney_transactiontype;
					$content['loadtransaction_amount'] = $loadtransaction_amount;
					$content['loadtransaction_amountdue'] = $loadtransaction_amountdue = !empty($post['loadtransaction_amountdue']) ? str_replace(',','',$post['loadtransaction_amountdue']) : 0;
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
					$content['loadtransaction_status'] = !empty($post['smartmoney_approved']) ? TRN_APPROVED : TRN_DRAFT;
					//$content['loadtransaction_itemthreshold'] = $item_threshold;

					if(!empty($post['loadtransaction_assignedsim'])&&$post['loadtransaction_assignedsim']=='AUTOMATIC') {
						$asm = getAllSmartMoney();
						if(!empty($asm)) {
							shuffle($asm);

							$content['loadtransaction_assignedsim'] = $asm[0]['simcard_number'];
							$content['loadtransaction_simcommand'] = $asm[0]['smartmoney_modemcommand'];
							$content['loadtransaction_cardlabel'] = $asm[0]['smartmoney_label'];
						}
					} else
					if(!empty($post['loadtransaction_assignedsim'])) {
						$asm = getAllSmartMoney();

						$content['loadtransaction_assignedsim'] = $post['loadtransaction_assignedsim'];

						if(!empty($asm)) {
							foreach($asm as $k=>$v) {
								if(!empty($v['smartmoney_modemcommand'])&&!empty($v['simcard_number'])&&$v['simcard_number']==$content['loadtransaction_assignedsim']) {
									$content['loadtransaction_simcommand'] = $v['smartmoney_modemcommand'];
									$content['loadtransaction_cardlabel'] = $asm[0]['smartmoney_label'];
									break;
								}
							}
						}
					}

					if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					if(!empty($result['returning'][0]['loadtransaction_id'])) {
						$retval['rowid'] = $loadtransaction_id = $result['returning'][0]['loadtransaction_id'];

						$cupdate = array();
						$cupdate['loadtransaction_createstampunix'] = '#extract(epoch from loadtransaction_updatestamp)#';

						if(!($result = $appdb->update("tbl_loadtransaction",$cupdate,"loadtransaction_id=".$loadtransaction_id))) {
							return false;
						}
					}

					if(!empty($retval['rowid'])) {
						$message = str_replace('<LOADTRANSACTIONID>',$loadtransaction_id,$message);

						$content = array();
						$content['loadtransaction_keyword'] = $message;

						if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction_id))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						$content = array();
						$content['smartmoneynumber_number'] = $loadtransaction_cardno;
						$content['smartmoneynumber_type'] = $smartmoney_transactiontype;

						if(!($result = $appdb->insert("tbl_smartmoneynumber",$content,"smartmoneynumber_id"))) {
							//json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							//die;
							if(preg_match('/duplicate\s+key/gi')) {
								if(!($result = $appdb->update("tbl_smartmoneynumber",$content,"smartmoneynumber_number=".$loadtransaction_cardno))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}
							}
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

						if(!empty($user_staffid)) {
							$receiptno = '';

							if(!empty($loadtransaction_id)&&!empty($loadtransaction_ymd)) {
								$receiptno = $loadtransaction_ymd . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($loadtransaction_id));
							}

							$content = array();
							$content['ledger_loadtransactionid'] = $loadtransaction_id;
							$content['ledger_credit'] = $loadtransaction_amountdue;

							$ledger_datetimeunix = intval(getDbUnixDate());

							$content['ledger_type'] = 'SMARTMONEY '.$smartmoney_transactiontype.' '.$loadtransaction_amount;
							$content['ledger_datetime'] = pgDateUnix($ledger_datetimeunix);
							$content['ledger_datetimeunix'] = $ledger_datetimeunix;
							$content['ledger_user'] = $user_staffid;
							$content['ledger_seq'] = '0';
							$content['ledger_receiptno'] = $receiptno;

							//if(!empty($rebate_credit)) {
								//$content['ledger_rebate'] = $rebate_credit;
								//$content['ledger_rebatebalance'] = $rebate_balance;
							//}

							if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							computeStaffBalance($user_staffid);

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
					if(!empty($params['smartmoneyinfo']['loadtransaction_smartmoneytype'])&&$params['smartmoneyinfo']['loadtransaction_smartmoneytype']==$v) {
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

				if($post['method']=='smartmoneynew') {
					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'TRANSACTION TYPE',
						'name' => 'smartmoney_transactiontype',
						'labelWidth' => 200,
						'readonly' => true,
						//'required' => !$readonly,
						'options' => $opt,
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'TRANSACTION TYPE',
						'name' => 'smartmoney_transactiontype',
						'labelWidth' => 200,
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_smartmoneytype']) ? $params['smartmoneyinfo']['loadtransaction_smartmoneytype'] : '',
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'hidden',
					'name' => 'smartmoney_approved',
					'value' => 0,
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

				if($post['method']=='smartmoneynew') {
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
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'CARD/MOBILE NUMBER',
						'name' => 'loadtransaction_cardno',
						'labelWidth' => 200,
						'readonly' => true,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_destcardno']) ? $params['smartmoneyinfo']['loadtransaction_destcardno'] : '',
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'AMOUNT',
					'name' => 'loadtransaction_amount',
					'labelWidth' => 200,
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'inputMask' => array('alias'=>'currency','prefix'=>'','autoUnmask'=>true),
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_amount']) ? number_format($params['smartmoneyinfo']['loadtransaction_amount'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_sendagentcommissionpercent']) ? number_format($params['smartmoneyinfo']['loadtransaction_sendagentcommissionpercent'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_sendagentcommissionamount']) ? number_format($params['smartmoneyinfo']['loadtransaction_sendagentcommissionamount'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_transferfeepercent']) ? number_format($params['smartmoneyinfo']['loadtransaction_transferfeepercent'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_transferfeeamount']) ? number_format($params['smartmoneyinfo']['loadtransaction_transferfeeamount'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveagentcommissionpercent']) ? number_format($params['smartmoneyinfo']['loadtransaction_receiveagentcommissionpercent'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_receiveagentcommissionamount']) ? number_format($params['smartmoneyinfo']['loadtransaction_receiveagentcommissionamount'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_otherchargespercent']) ? number_format($params['smartmoneyinfo']['loadtransaction_otherchargespercent'],2) : '',
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
							'value' => !empty($params['smartmoneyinfo']['loadtransaction_otherchargesamount']) ? number_format($params['smartmoneyinfo']['loadtransaction_otherchargesamount'],2) : '',
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
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_amountdue']) ? number_format($params['smartmoneyinfo']['loadtransaction_amountdue'],2) : '',
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
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_cashreceived']) ? number_format($params['smartmoneyinfo']['loadtransaction_cashreceived'],2) : '',
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
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_changed']) ? number_format($params['smartmoneyinfo']['loadtransaction_changed'],2) : '',
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				$assignedsim = array('AUTOMATIC');

				$asm = getAllSmartMoney();

				if(!empty($asm)) {
					foreach($asm as $k=>$v) {
						if(!empty($v['simcard_number'])) {
							$assignedsim[] = $v['simcard_number'];
						}
					}
				}

				foreach($assignedsim as $v) {
					$selected = false;
					if(!empty($params['smartmoneyinfo']['loadtransaction_assignedsim'])&&$params['smartmoneyinfo']['loadtransaction_assignedsim']==$v) {
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

				if($post['method']=='smartmoneynew'||$post['method']=='smartmoneytransfer') {
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
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'ASSIGNED SIM CARD',
						'labelWidth' => 200,
						'name' => 'loadtransaction_assignedsim',
						//'labelWidth' => 150,
						'readonly' => true,
						//'numeric' => true,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_assignedsim']) ? $params['smartmoneyinfo']['loadtransaction_assignedsim'] : '',
					);
				}


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

				if($post['method']=='smartmoneynew') {
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
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'SENDER NAME',
						'name' => 'smartmoney_sendername',
						'labelWidth' => 150,
						'readonly' => $readonly,
						'required' => !$readonly,
						//'numeric' => true,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_customername']) ? $params['smartmoneyinfo']['loadtransaction_customername'] : '',
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER ADDRESS',
					'name' => 'smartmoney_senderaddress',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['smartmoneyinfo']['senderaddress']) ? $params['smartmoneyinfo']['senderaddress'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SENDER NUMBER',
					'name' => 'smartmoney_sendernumber',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['smartmoneyinfo']['sendernumber']) ? $params['smartmoneyinfo']['sendernumber'] : '',
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

				if($post['method']=='smartmoneynew') {
					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'ID TYPE',
						'name' => 'smartmoney_idtype',
						'labelWidth' => 150,
						'readonly' => true,
						//'required' => !$readonly,
						'options' => $opt,
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'ID TYPE',
						'name' => 'smartmoney_idtype',
						'labelWidth' => 150,
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['smartmoneyinfo']['senderidtype']) ? $params['smartmoneyinfo']['senderidtype'] : '',
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'SPECIFY ID',
					'name' => 'smartmoney_specifyid',
					'labelWidth' => 150,
					'readonly' => $readonly,
					//'required' => !$readonly,
					'value' => !empty($params['smartmoneyinfo']['senderspecifyid']) ? $params['smartmoneyinfo']['senderspecifyid'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ID NUMBER',
					'name' => 'smartmoney_idnumber',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['smartmoneyinfo']['senderidnumber']) ? $params['smartmoneyinfo']['senderidnumber'] : '',
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

				if($post['method']=='smartmoneynew') {
					$params['tbDetails'][] = array(
						'type' => 'calendar',
						'label' => 'EXPIRATION DATE',
						'name' => 'smartmoney_idexpiration',
						'labelWidth' => 150,
						'readonly' => true,
						'calendarPosition' => 'right',
						'dateFormat' => '%m-%d-%Y',
						//'required' => !$readonly,
						'value' => !empty($params['smartmoneyinfo']['senderidexpiration']) ? $params['smartmoneyinfo']['senderidexpiration'] : '',
					);
				} else {
					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'EXPIRATION DATE',
						'name' => 'smartmoney_idexpiration',
						'labelWidth' => 150,
						'readonly' => true,
						'value' => !empty($params['smartmoneyinfo']['senderidexpiration']) ? $params['smartmoneyinfo']['senderidexpiration'] : '',
					);
				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RECEIVER NUMBER',
					'name' => 'smartmoney_receivernumber',
					'labelWidth' => 150,
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_recipientnumber']) ? $params['smartmoneyinfo']['loadtransaction_recipientnumber'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'newcolumn',
					'offset' => 40,
				);

				$receiptno = '';

				if(!empty($params['smartmoneyinfo']['loadtransaction_id'])&&!empty($params['smartmoneyinfo']['loadtransaction_ymd'])) {
					$receiptno = $params['smartmoneyinfo']['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($params['smartmoneyinfo']['loadtransaction_id']));
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
					'value' => !empty($params['smartmoneyinfo']['loadtransaction_createstamp']) ? pgDate($params['smartmoneyinfo']['loadtransaction_createstamp']) : '',
				);

				$fund_username = !empty($params['smartmoneyinfo']['loadtransaction_staffid']) ? getCustomerNameByID($params['smartmoneyinfo']['loadtransaction_staffid']) : '';

				if(!empty($fund_username)) {
				} else {
					$fund_username = !empty($params['smartmoneyinfo']['loadtransaction_username']) ? $params['smartmoneyinfo']['loadtransaction_username'] : $applogin->fullname();
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

				if($post['method']=='smartmoneynew') {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'smartmoney_status',
						'readonly' => true,
						'inputWidth' => 150,
						'value' => TRN_DRAFT,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'smartmoney_statustext',
						'readonly' => true,
						'inputWidth' => 150,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString(TRN_DRAFT),
					);

				} else
				if($post['method']=='smartmoneymanually') {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'smartmoney_status',
						'readonly' => true,
						'inputWidth' => 150,
						'value' => TRN_COMPLETED_MANUALLY,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'smartmoney_statustext',
						'readonly' => true,
						'inputWidth' => 150,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString(TRN_COMPLETED_MANUALLY),
					);

				} else
				if($post['method']=='smartmoneyhold') {

		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS CODE',
		        'name' => 'smartmoney_status',
						'inputWidth' => 150,
		        'readonly' => true,
		        //'required' => !$readonly,
		        'value' => TRN_HOLD,
		      );

		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS',
		        'name' => 'smartmoney_statustext',
						'inputWidth' => 150,
		        'readonly' => true,
		        //'required' => !$readonly,
		        'value' => getLoadTransactionStatusString(TRN_HOLD),
		      );

		    } else
				if($post['method']=='smartmoneycancelled') {

		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS CODE',
		        'name' => 'smartmoney_status',
						'inputWidth' => 150,
		        'readonly' => true,
		        //'required' => !$readonly,
		        'value' => TRN_CANCELLED,
		      );

		      $params['tbDetails'][] = array(
		        'type' => 'input',
		        'label' => 'STATUS',
		        'name' => 'smartmoney_statustext',
						'inputWidth' => 150,
		        'readonly' => true,
		        //'required' => !$readonly,
		        'value' => getLoadTransactionStatusString(TRN_CANCELLED),
		      );

		    } else
				if($post['method']=='smartmoneyapproved'||$post['method']=='smartmoneytransfer') {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'smartmoney_status',
						'readonly' => true,
						'inputWidth' => 150,
						//'required' => !$readonly,
						//'value' => TRN_DRAFT,
						'value' => TRN_APPROVED,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'smartmoney_statustext',
						'readonly' => true,
						'inputWidth' => 150,
						//'required' => !$readonly,
						'value' => getLoadTransactionStatusString(TRN_APPROVED),
					);

				} else {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS CODE',
						'name' => 'smartmoney_status',
						'readonly' => true,
						'inputWidth' => 150,
						//'required' => !$readonly,
						//'value' => TRN_DRAFT,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_status']) ? $params['smartmoneyinfo']['loadtransaction_status'] : TRN_DRAFT,
					);

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'STATUS',
						'name' => 'smartmoney_statustext',
						'readonly' => true,
						'inputWidth' => 150,
						//'required' => !$readonly,
						'value' => !empty($params['smartmoneyinfo']['loadtransaction_status']) ? getLoadTransactionStatusString($params['smartmoneyinfo']['loadtransaction_status']) : getLoadTransactionStatusString(TRN_DRAFT),
					);

				}

				$params['tbMessage'][] = array(
		      'type' => 'input',
		      'label' => 'FROM',
		      'name' => 'retail_confirmationfrom',
		      'readonly' => true,
		      //'required' => !$readonly,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_confirmationfrom']) ? $params['smartmoneyinfo']['loadtransaction_confirmationfrom'] : '',
		    );

		    $params['tbMessage'][] = array(
		      'type' => 'input',
		      'label' => 'DATE/TIME',
		      'name' => 'retail_confirmationstamp',
		      'readonly' => true,
		      //'required' => !$readonly,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_confirmationstamp']) ? pgDate($params['smartmoneyinfo']['loadtransaction_confirmationstamp']) : '',
		    );

		    $params['tbMessage'][] = array(
		      'type' => 'input',
		      'label' => 'CONFIRMATION',
		      'name' => 'retail_confirmation',
		      'readonly' => true,
		      //'required' => !$readonly,
		      'inputWidth' => 500,
		      'rows' => 5,
		      'value' => !empty($params['smartmoneyinfo']['loadtransaction_confirmation']) ? $params['smartmoneyinfo']['loadtransaction_confirmation'] : '',
		    );

				if(!empty($params['smartmoneyinfo']['loadtransaction_status'])) {

					/*$params['tbReceipt'][] = array(
			      'type' => 'input',
			      'label' => 'STATUS',
			      'name' => 'receipt_test',
			      'readonly' => true,
			      //'required' => !$readonly,
			      'value' => !empty($params['smartmoneyinfo']['loadtransaction_status']) ? $params['smartmoneyinfo']['loadtransaction_status'] : '',
			    );*/

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'JJS Telecom',
						'labelWidth' => 500,
						'className' => 'receiptCompany_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'Ziga Avenue, Brgy. Basud, Tabaco City, Albay, 4511',
						'labelWidth' => 500,
						'className' => 'receiptAddress_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'Smart Padala: 5577519312808109',
						'labelWidth' => 500,
						'className' => 'receiptSmartPadala_'.$post['formval'],
					);

					$params['tbReceipt'][] = array(
						'type' => 'label',
						'label' => 'SMART MONEY TRANSFER',
						'labelWidth' => 500,
						'className' => 'receiptTitle_'.$post['formval'],
					);

				}

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

		function router($retflag=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			//$retflag=false;

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

					//if($this->post['method']=='generatereportprint') {
						//pre(array('post'=>$this->post));
						//die;
					//}

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

					/*if($this->post['method']=='generatereportprint') {
						pre(array('$retflag'=>$retflag,'$form'=>$form));
						pre(array('$retflag'=>$retflag,'$retval'=>$retval));
						pre(array('post'=>$this->post));
						die;
					}*/

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
					if($this->post['table']=='smartmoney') {

						$where = '';

            if(!empty($this->post['datefrom'])&&!empty($this->post['dateto'])) {
              $datefrom = date2timestamp($this->post['datefrom'],'m-d-Y H:i');
              $dateto = date2timestamp($this->post['dateto'],'m-d-Y H:i');
              $dtfrom = date('m-d-Y H:i',$datefrom);
              $dtto = date('m-d-Y H:i',$dateto);

              //pre(array('$datefrom'=>$datefrom,'$dtfrom'=>$dtfrom,'$dateto'=>$dateto,'$dtto'=>$dtto));

              $where = " and extract(epoch from loadtransaction_createstamp)>=$datefrom and extract(epoch from loadtransaction_createstamp)<=$dateto";
            }

						if(!($result = $appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_type='smartmoney' and loadtransaction_smartmoneytype in ('PADALA','TOPUP','PICKUP','PAYMAYA') $where order by loadtransaction_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['loadtransaction_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$receiptno = '';

								if(!empty($v['loadtransaction_id'])&&!empty($v['loadtransaction_ymd'])) {
									$receiptno = $v['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['loadtransaction_id']));
								}

								$statusString = getLoadTransactionStatusString($v['loadtransaction_status']);

								$rows[] = array('id'=>$v['loadtransaction_id'],'data'=>array(0,$v['loadtransaction_id'],pgDate($v['loadtransaction_createstamp']),$receiptno,$v['loadtransaction_sendername'],$v['loadtransaction_destcardno'],number_format($v['loadtransaction_amount'],2),number_format($v['loadtransaction_sendagentcommissionamount'],2),number_format($v['loadtransaction_transferfeeamount'],2),number_format($v['loadtransaction_receiveagentcommissionamount'],2),number_format($v['loadtransaction_otherchargesamount'],2),number_format($v['loadtransaction_amountdue'],2),$statusString));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='claimed') {

						$where = '';

            if(!empty($this->post['datefrom'])&&!empty($this->post['dateto'])) {
              $datefrom = date2timestamp($this->post['datefrom'],'m-d-Y H:i');
              $dateto = date2timestamp($this->post['dateto'],'m-d-Y H:i');
              $dtfrom = date('m-d-Y H:i',$datefrom);
              $dtto = date('m-d-Y H:i',$dateto);

              //pre(array('$datefrom'=>$datefrom,'$dtfrom'=>$dtfrom,'$dateto'=>$dateto,'$dtto'=>$dtto));

              $where = " and extract(epoch from loadtransaction_updatestamp)>=$datefrom and extract(epoch from loadtransaction_updatestamp)<=$dateto";
            }

						if(!($result = $appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_type='smartmoney' and loadtransaction_smartmoneytype in ('RECEIVED') and loadtransaction_status=".TRN_CLAIMED." $where order by loadtransaction_id desc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['loadtransaction_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$receiptno = '';

								if(!empty($v['loadtransaction_id'])&&!empty($v['loadtransaction_ymd'])) {
									$receiptno = $v['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($v['loadtransaction_id']));
								}

								$statusString = getLoadTransactionStatusString($v['loadtransaction_status']);

								$rows[] = array('id'=>$v['loadtransaction_id'],'data'=>array(0,$v['loadtransaction_id'],pgDate($v['loadtransaction_updatestamp']),$receiptno,$v['loadtransaction_sendername'],$v['loadtransaction_destcardno'],number_format($v['loadtransaction_amount'],2),number_format($v['loadtransaction_sendagentcommissionamount'],2),number_format($v['loadtransaction_transferfeeamount'],2),number_format($v['loadtransaction_receiveagentcommissionamount'],2),number_format($v['loadtransaction_otherchargesamount'],2),number_format($v['loadtransaction_amountdue'],2),$statusString));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='cards') {
						if(!($result = $appdb->query("select * from tbl_smartmoneynumber order by smartmoneynumber_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['smartmoneynumber_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['smartmoneynumber_id'],'data'=>array(0,$v['smartmoneynumber_id'],$v['smartmoneynumber_number'],$v['smartmoneynumber_type']));
							}

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

					} else
					if($this->post['table']=='unassigned') {

						//$simcard = getSimCardByID($this->post['rowid']);

						//pre(array('$simcard'=>$simcard));

						//$simcard_number = $simcard['simcard_number'];

						//if(!empty($simcard_number)) {

							if(!($result = $appdb->query("select * from tbl_loadtransaction where loadtransaction_type in ('smartmoney') order by loadtransaction_createstampunix desc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							/*$sm = getSmartMoneyOfSimNumber($simcard_number);

							$optcardlabel = array(array('text'=>'','value'=>''));

							if(!empty($sm)&&is_array($sm)) {
								foreach($sm as $k=>$v) {
									$optcardlabel[] = array('text'=>$v['smartmoney_label'],'value'=>$v['smartmoney_label']);
								}
							}*/

							if(!empty($result['rows'][0]['loadtransaction_id'])) {
								$rows = array();

								foreach($result['rows'] as $k=>$v) {

									if($v['loadtransaction_status']==TRN_COMPLETED||$v['loadtransaction_status']==TRN_COMPLETED_MANUALLY||$v['loadtransaction_status']==TRN_CLAIMED||$v['loadtransaction_status']==TRN_RECEIVED) {
									} else {
										continue;
									}

									if(trim($v['loadtransaction_cardlabel'])=='') {
									} else {
										continue;
									}

									$prefix = '';
									$in = 0;
									$out = 0;
									$flag = 0;

									if($v['loadtransaction_smartmoneytype']=='PADALA'||$v['loadtransaction_smartmoneytype']=='TOPUP'||$v['loadtransaction_smartmoneytype']=='PAYMAYA'||$v['loadtransaction_smartmoneytype']=='TOPUP') {
										$prefix = 'SM';
										$out = $v['loadtransaction_amount'];
										$flag = 1;
									} else
									if($v['loadtransaction_smartmoneytype']=='RECEIVED') {
										$prefix = 'SM';
										$in = $v['loadtransaction_amount'];
										$flag = 2;
									}

									$transid = $prefix . $v['loadtransaction_ymd'] . sprintf('%04d', $v['loadtransaction_id']);

									//$rows[] = array('id'=>$v['loadtransaction_id'],'cardlabel'=>array('options'=>$optcardlabel),'simcardbalance'=>$v['loadtransaction_simcardbalance'],'runningbalance'=>$v['loadtransaction_runningbalance'],'data'=>array($v['loadtransaction_id'],pgDateUnix($v['loadtransaction_createstampunix'], 'm-d-Y H:i:s'),$v['loadtransaction_datetime'],pgDate($v['loadtransaction_createstamp'],'m-d-Y'),pgDate($v['loadtransaction_createstamp'],'H:i'),$transid,$v['loadtransaction_customername'],$v['loadtransaction_refnumber'],$v['loadtransaction_destcardno'],$v['loadtransaction_recipientnumber'],strtoupper($v['loadtransaction_cardlabel']),strtoupper($v['loadtransaction_smartmoneytype']),getLoadTransactionStatusString($v['loadtransaction_status']),number_format($v['loadtransaction_sendagentcommissionamount'],2),number_format($v['loadtransaction_transferfeeamount'],2),number_format($v['loadtransaction_receiveagentcommissionamount'],2),number_format($v['loadtransaction_otherchargesamount'],2),number_format($in,2),number_format($out,2),number_format($v['loadtransaction_simcardbalance'],2),number_format($v['loadtransaction_runningbalance'],2)));

									$rows[] = array('id'=>$v['loadtransaction_id'],'simcardbalance'=>$v['loadtransaction_simcardbalance'],'runningbalance'=>$v['loadtransaction_runningbalance'],'data'=>array(0,$v['loadtransaction_id'],pgDateUnix($v['loadtransaction_createstampunix'], 'm-d-Y H:i:s'),$v['loadtransaction_assignedsim'],$v['loadtransaction_datetime'],pgDate($v['loadtransaction_createstamp'],'m-d-Y'),pgDate($v['loadtransaction_createstamp'],'H:i'),$transid,$v['loadtransaction_customername'],$v['loadtransaction_refnumber'],$v['loadtransaction_fromnumber'],$v['loadtransaction_recipientnumber'],strtoupper($v['loadtransaction_cardlabel']),strtoupper($v['loadtransaction_smartmoneytype']),getLoadTransactionStatusString($v['loadtransaction_status']),number_format($v['loadtransaction_sendagentcommissionamount'],2),number_format($v['loadtransaction_transferfeeamount'],2),number_format($v['loadtransaction_receiveagentcommissionamount'],2),number_format($v['loadtransaction_otherchargesamount'],2),number_format($in,2),number_format($out,2),number_format($v['loadtransaction_simcardbalance'],2),number_format($v['loadtransaction_runningbalance'],2)));

									/*if($flag==1) {
										$rows[] = array('id'=>$v['loadtransaction_id'],'simcardbalance'=>$v['loadtransaction_simcardbalance'],'runningbalance'=>$v['loadtransaction_runningbalance'],'data'=>array(0,$v['loadtransaction_id'],pgDateUnix($v['loadtransaction_createstampunix'], 'm-d-Y H:i:s'),getSimNameByNumber($v['loadtransaction_assignedsim']),$v['loadtransaction_confirmationfrom'],$v['loadtransaction_datetime'],$v['loadtransaction_refnumber'],$v['loadtransaction_destcardno'],$v['loadtransaction_amount'],number_format($v['loadtransaction_receiveagentcommissionamount'],2),number_format($v['loadtransaction_simcardbalance'],2)));
									} else
									if($flag==2) {
										$rows[] = array('id'=>$v['loadtransaction_id'],'simcardbalance'=>$v['loadtransaction_simcardbalance'],'runningbalance'=>$v['loadtransaction_runningbalance'],'data'=>array(0,$v['loadtransaction_id'],pgDateUnix($v['loadtransaction_createstampunix'], 'm-d-Y H:i:s'),getSimNameByNumber($v['loadtransaction_assignedsim']),$v['loadtransaction_confirmationfrom'],$v['loadtransaction_datetime'],$v['loadtransaction_refnumber'],$v['loadtransaction_fromnumber'],$v['loadtransaction_amount'],number_format($v['loadtransaction_receiveagentcommissionamount'],2),number_format($v['loadtransaction_simcardbalance'],2)));
									} else {
										$rows[] = array('id'=>$v['loadtransaction_id'],'simcardbalance'=>$v['loadtransaction_simcardbalance'],'runningbalance'=>$v['loadtransaction_runningbalance'],'data'=>array(0,$v['loadtransaction_id'],pgDateUnix($v['loadtransaction_createstampunix'], 'm-d-Y H:i:s'),getSimNameByNumber($v['loadtransaction_assignedsim']),$v['loadtransaction_confirmationfrom'],$v['loadtransaction_datetime'],$v['loadtransaction_refnumber'],$v['loadtransaction_destcardno'],$v['loadtransaction_amount'],number_format($v['loadtransaction_receiveagentcommissionamount'],2),number_format($v['loadtransaction_simcardbalance'],2)));
									}*/

								}

								$retval = array('rows'=>$rows);
							}


						//}

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

	$appappdiscount = new APP_app_discount;
}

# eof modules/app.user
