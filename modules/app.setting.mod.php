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

if(!class_exists('APP_app_setting')) {

	class APP_app_setting extends APP_Base_Ajax {

		var $desc = 'Setting';

		var $pathid = 'setting';
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

			$appaccess->rules($this->desc,'Setting Module');

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

		function _form_settingmainsimcommand($routerid=false,$formid=false) {
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

		} // _form_settingmainsimcommand

		function _form_settingmainexpressions($routerid=false,$formid=false) {
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

		} // _form_settingmainexpressions

		function _form_settingmainsmserror($routerid=false,$formid=false) {
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

		} // _form_settingmainsmserror

		function _form_settingmainloadcommand($routerid=false,$formid=false) {
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

		} // _form_settingmainloadcommand

		function _form_settingmainnetworkprefix($routerid=false,$formid=false) {
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

		} // _form_settingmainnetworkprefix

		function _form_settingmainprovider($routerid=false,$formid=false) {
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

		} // _form_settingmainprovider

		function _form_settingmainoptions($routerid=false,$formid=false) {
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

		} // _form_settingmainoptions

		function _form_settingmainnotification($routerid=false,$formid=false) {
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

		} // _form_settingmainnotification

		function _form_settingmaingsmdb($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				$post = $this->vars['post'];

				$params = array();

				$db_user = getOption('$DB_USER',DB_USER);
				$db_pass = getOption('$DB_PASS',DB_PASS);
				$db_name = getOption('$DB_NAME',DB_NAME);
				$db_ip = getOption('$DB_IP',DB_IP);
				$db_port = getOption('$DB_PORT',DB_PORT);

				if(!empty($post['method'])&&$post['method']=='settingreset') {
					$readonly = false;
					$db_user = DB_USER;
					$db_pass = DB_PASS;
					$db_name = DB_NAME;
					$db_ip = DB_IP;
					$db_port = DB_PORT;
				} else
				if(!empty($post['method'])&&$post['method']=='settingedit') {
					$readonly = false;
				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {
					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'GSM DB successfully saved!';

					if(!empty($post['db_user'])&&!empty($post['db_pass'])&&!empty($post['db_name'])&&!empty($post['db_ip'])&&!empty($post['db_port'])) {
					} else {
						$retval['return_message'] = 'Incomplete data received!';
						json_encode_return($retval);
						die;
					}

					setSetting('$DB_USER',$post['db_user']);
					setSetting('$DB_PASS',$post['db_pass']);
					setSetting('$DB_NAME',$post['db_name']);
					setSetting('$DB_IP',$post['db_ip']);
					setSetting('$DB_PORT',$post['db_port']);

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DB USER',
					'name' => 'db_user',
					'readonly' => $readonly,
					'required' => true,
					'value' => $db_user,
					//'labelAlign' => $position,
					//'value' => !empty($params['productinfo']['eloadproduct_code']) ? $params['productinfo']['eloadproduct_code'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DB PASS',
					'name' => 'db_pass',
					'readonly' => $readonly,
					'required' => true,
					'value' => $db_pass,
					//'labelAlign' => $position,
					//'value' => !empty($params['productinfo']['eloadproduct_code']) ? $params['productinfo']['eloadproduct_code'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DB NAME',
					'name' => 'db_name',
					'readonly' => $readonly,
					'required' => true,
					'value' => $db_name,
					//'labelAlign' => $position,
					//'value' => !empty($params['productinfo']['eloadproduct_code']) ? $params['productinfo']['eloadproduct_code'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DB IP',
					'name' => 'db_ip',
					'readonly' => $readonly,
					'required' => true,
					'value' => $db_ip,
					//'value' => !empty($params['productinfo']['eloadproduct_code']) ? $params['productinfo']['eloadproduct_code'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DB PORT',
					'name' => 'db_port',
					'readonly' => $readonly,
					'required' => true,
					'value' => $db_port,
					//'labelAlign' => $position,
					//'value' => !empty($params['productinfo']['eloadproduct_code']) ? $params['productinfo']['eloadproduct_code'] : '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingmaingsmdb

		function _form_settingmaingeneral($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$readonly = true;

				$post = $this->vars['post'];

				$params = array();

				$general_notifyadminpendingtransaction = getOption('$GENERALSETTINGS_NOTIFYADMINPENDINGTRANSACTION',false);
				$general_notifyadminbelowaveragesignalstrength = getOption('$GENERALSETTINGS_NOTIFYADMINBELOWAVERAGESIGNALSTRENGTH',false);
				$general_belowaveragesignalstrength = getOption('$GENERALSETTINGS_BELOWAVERAGESIGNALSTRENGTH',false);
				$general_notifyadminerrorsignalstrength = getOption('$GENERALSETTINGS_NOTIFYADMINERRORSIGNALSTRENGTH',false);
				$general_errorsignalstrength = getOption('$GENERALSETTINGS_ERRORSIGNALSTRENGTH',false);
				$general_notifyadminfailedtransaction = getOption('$GENERALSETTINGS_NOTIFYADMINFAILEDTRANSACTION',false);
				$general_notifyadminfailedcomport = getOption('$GENERALSETTINGS_NOTIFYADMINFAILEDCOMPORT',false);
				$general_adminmobilenumbers = getOption('$GENERALSETTINGS_ADMINMOBILENUMBERS',false);
				$general_resendtimer = getOption('$GENERALSETTINGS_RESENDTIMER',false);
				$general_resendduplicatenotification = getOption('$GENERALSETTINGS_RESENDDUPLICATENOTIFICATION',false);
				$general_waitingforconfirmationmessagetimer = getOption('$GENERALSETTINGS_WAITINGFORCONFIRMATIONMESSAGETIMER',false);
				$general_balanceinquirytimer = getOption('$GENERALSETTINGS_BALANCEINQUIRYTIMER',false);
				$general_balanceinquiryretries = getOption('$GENERALSETTINGS_BALANCEINQUIRYRETRIES',false);
				$general_reloadretries = getOption('$GENERALSETTINGS_RELOADRETRIES',false);
				$general_readporttimeout = getOption('$GENERALSETTINGS_READPORTTIMEOUT',false);
				$general_notificationforloadretailcancelled = getOption('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILCANCELLED',false);
				$general_notificationforloadretailcompleted = getOption('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILCOMPLETED',false);
				$general_notificationforloadretailmanuallycompleted = getOption('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILMANUALLYCOMPLETED',false);

				if(!empty($post['method'])&&$post['method']=='settingedit') {
					$readonly = false;
				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {
					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'General Settings successfully saved!';

					//setSetting('$DB_USER',$post['db_user']);
					setSetting('$GENERALSETTINGS_NOTIFYADMINPENDINGTRANSACTION',!empty($post['general_notifyadminpendingtransaction'])?true:false);
					setSetting('$GENERALSETTINGS_NOTIFYADMINBELOWAVERAGESIGNALSTRENGTH',!empty($post['general_notifyadminbelowaveragesignalstrength'])?true:false);
					setSetting('$GENERALSETTINGS_BELOWAVERAGESIGNALSTRENGTH',!empty($post['general_belowaveragesignalstrength'])?$post['general_belowaveragesignalstrength']:'');
					setSetting('$GENERALSETTINGS_NOTIFYADMINERRORSIGNALSTRENGTH',!empty($post['general_notifyadminerrorsignalstrength'])?true:false);
					setSetting('$GENERALSETTINGS_ERRORSIGNALSTRENGTH',!empty($post['general_errorsignalstrength'])?$post['general_errorsignalstrength']:'');
					setSetting('$GENERALSETTINGS_NOTIFYADMINFAILEDTRANSACTION',!empty($post['general_notifyadminfailedtransaction'])?true:false);
					setSetting('$GENERALSETTINGS_NOTIFYADMINFAILEDCOMPORT',!empty($post['general_notifyadminfailedcomport'])?true:false);
					setSetting('$GENERALSETTINGS_ADMINMOBILENUMBERS',!empty($post['general_adminmobilenumbers'])?$post['general_adminmobilenumbers']:'');
					setSetting('$GENERALSETTINGS_RESENDTIMER',!empty($post['general_resendtimer'])?$post['general_resendtimer']:1800);
					setSetting('$GENERALSETTINGS_RESENDDUPLICATENOTIFICATION',!empty($post['general_resendduplicatenotification'])?$post['general_resendduplicatenotification']:'');
					setSetting('$GENERALSETTINGS_WAITINGFORCONFIRMATIONMESSAGETIMER',!empty($post['general_waitingforconfirmationmessagetimer'])?$post['general_waitingforconfirmationmessagetimer']:60);
					setSetting('$GENERALSETTINGS_BALANCEINQUIRYTIMER',!empty($post['general_balanceinquirytimer'])?$post['general_balanceinquirytimer']:30);
					setSetting('$GENERALSETTINGS_BALANCEINQUIRYRETRIES',!empty($post['general_balanceinquiryretries'])?$post['general_balanceinquiryretries']:2);
					setSetting('$GENERALSETTINGS_RELOADRETRIES',!empty($post['general_reloadretries'])?$post['general_reloadretries']:3);
					setSetting('$GENERALSETTINGS_READPORTTIMEOUT',!empty($post['general_readporttimeout'])?$post['general_readporttimeout']:60);
					setSetting('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILCANCELLED',!empty($post['general_notificationforloadretailcancelled'])?$post['general_notificationforloadretailcancelled']:'');
					setSetting('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILCOMPLETED',!empty($post['general_notificationforloadretailcompleted'])?$post['general_notificationforloadretailcompleted']:'');
					setSetting('$GENERALSETTINGS_NOTIFICATIONFORLOADRETAILMANUALLYCOMPLETED',!empty($post['general_notificationforloadretailmanuallycompleted'])?$post['general_notificationforloadretailmanuallycompleted']:'');

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$newcolumnoffset = 50;

				$position = 'right';

				$params['tbDetails'] = array();

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'NOTIFY ADMIN FOR PENDING TRANSACTION',
					'labelWidth' => 500,
					'name' => 'general_notifyadminpendingtransaction',
					'readonly' => $readonly,
					'checked' => !empty($general_notifyadminpendingtransaction) ? true : false,
					'position' => 'label-right',
				);

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'NOTIFY ADMIN FOR BELOW AVERAGE SIGNAL STRENGTH',
					'labelWidth' => 360,
					'name' => 'general_notifyadminbelowaveragesignalstrength',
					'readonly' => $readonly,
					'checked' => !empty($general_notifyadminbelowaveragesignalstrength) ? true : false,
					'position' => 'label-right',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block[] = array(
					'type' => 'input',
					'name' => 'general_belowaveragesignalstrength',
					'readonly' => $readonly,
					'value' => !empty($general_belowaveragesignalstrength) ? $general_belowaveragesignalstrength : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'NOTIFY ADMIN FOR ERROR SIGNAL STRENGTH',
					'labelWidth' => 300,
					'name' => 'general_notifyadminerrorsignalstrength',
					'readonly' => $readonly,
					'checked' => !empty($general_notifyadminerrorsignalstrength) ? true : false,
					'position' => 'label-right',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$block[] = array(
					'type' => 'input',
					'name' => 'general_errorsignalstrength',
					'readonly' => $readonly,
					'value' => !empty($general_errorsignalstrength) ? $general_errorsignalstrength : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'NOTIFY ADMIN FOR FAILED TRANSACTION',
					'labelWidth' => 500,
					'name' => 'general_notifyadminfailedtransaction',
					'readonly' => $readonly,
					'checked' => !empty($general_notifyadminfailedtransaction) ? true : false,
					'position' => 'label-right',
				);

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'NOTIFY ADMIN FOR FAILED COM PORT',
					'labelWidth' => 500,
					'name' => 'general_notifyadminfailedcomport',
					'readonly' => $readonly,
					'checked' => !empty($general_notifyadminfailedcomport) ? true : false,
					'position' => 'label-right',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'ADMIN MOBILE NUMBERS',
					'labelWidth' => 170,
					'name' => 'general_adminmobilenumbers',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($general_adminmobilenumbers) ? $general_adminmobilenumbers : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'READ PORT TIMEOUT (seconds)',
					'labelWidth' => 200,
					'name' => 'general_readporttimeout',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($general_readporttimeout) ? $general_readporttimeout : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RESEND TIMER (seconds)',
					'labelWidth' => 180,
					'name' => 'general_resendtimer',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($general_resendtimer) ? $general_resendtimer : '',
				);

				if($readonly) {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'RESEND DUPLICATE MESSAGE',
						'labelWidth' => 210,
						'name' => 'general_resendduplicatenotification',
						'readonly' => $readonly,
						'required' => !$readonly,
						'value' => !empty($general_resendduplicatenotification) ? $general_resendduplicatenotification : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$lnotification = explode(',', $general_resendduplicatenotification);

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

					$params['general_resendduplicatenotificationopt'] = array(
						'opts'=>$opt,
						'value'=>!empty($general_resendduplicatenotification) ? $general_resendduplicatenotification : ''
					);


					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'RESEND DUPLICATE MESSAGE',
						'labelWidth' => 210,
						//'inputWidth' => 200,
						'comboType' => 'checkbox',
						'name' => 'general_resendduplicatenotification',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				/*$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'WAITING FOR CONFIRMATION MESSAGE TIMER (seconds)',
					'labelWidth' => 350,
					'name' => 'general_waitingforconfirmationmessagetimer',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($general_waitingforconfirmationmessagetimer) ? $general_waitingforconfirmationmessagetimer : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'BALANCE INQUIRY TIMER (seconds)',
					'labelWidth' => 230,
					'name' => 'general_balanceinquirytimer',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($general_balanceinquirytimer) ? $general_balanceinquirytimer : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'BALANCE INQUIRY RETRIES',
					'labelWidth' => 180,
					'name' => 'general_balanceinquiryretries',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($general_balanceinquiryretries) ? $general_balanceinquiryretries : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'RELOAD RETRIES',
					'labelWidth' => 180,
					'name' => 'general_reloadretries',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($general_reloadretries) ? $general_reloadretries : '',
				);*/

				if($readonly) {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'NOTIFICATION FOR LOAD RETAIL CANCELLED',
						'labelWidth' => 300,
						'name' => 'general_notificationforloadretailcancelled',
						'readonly' => $readonly,
						'required' => !$readonly,
						'numeric' => true,
						'value' => !empty($general_notificationforloadretailcancelled) ? $general_notificationforloadretailcancelled : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$lnotification = explode(',', $general_notificationforloadretailcancelled);

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

					$params['general_notificationforloadretailcancelledopt'] = array(
						'opts'=>$opt,
						'value'=>!empty($general_notificationforloadretailcancelled) ? $general_notificationforloadretailcancelled : ''
					);


					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'NOTIFICATION FOR LOAD RETAIL CANCELLED',
						'labelWidth' => 300,
						//'inputWidth' => 200,
						'comboType' => 'checkbox',
						'name' => 'general_notificationforloadretailcancelled',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				if($readonly) {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'NOTIFICATION FOR LOAD RETAIL COMPLETED',
						'labelWidth' => 300,
						'name' => 'general_notificationforloadretailcompleted',
						'readonly' => $readonly,
						'required' => !$readonly,
						'numeric' => true,
						'value' => !empty($general_notificationforloadretailcompleted) ? $general_notificationforloadretailcompleted : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$lnotification = explode(',', $general_notificationforloadretailcompleted);

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

					$params['general_notificationforloadretailcompletedopt'] = array(
						'opts'=>$opt,
						'value'=>!empty($general_notificationforloadretailcompleted) ? $general_notificationforloadretailcompleted : ''
					);


					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'NOTIFICATION FOR LOAD RETAIL COMPLETED',
						'labelWidth' => 300,
						//'inputWidth' => 200,
						'comboType' => 'checkbox',
						'name' => 'general_notificationforloadretailcompleted',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				if($readonly) {

					$params['tbDetails'][] = array(
						'type' => 'input',
						'label' => 'NOTIFICATION FOR LOAD RETAIL MANUALLY COMPLETED',
						'labelWidth' => 300,
						'name' => 'general_notificationforloadretailmanuallycompleted',
						'readonly' => $readonly,
						'required' => !$readonly,
						'numeric' => true,
						'value' => !empty($general_notificationforloadretailmanuallycompleted) ? $general_notificationforloadretailmanuallycompleted : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$lnotification = explode(',', $general_notificationforloadretailmanuallycompleted);

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

					$params['general_notificationforloadretailmanuallycompletedopt'] = array(
						'opts'=>$opt,
						'value'=>!empty($general_notificationforloadretailmanuallycompleted) ? $general_notificationforloadretailmanuallycompleted : ''
					);


					$params['tbDetails'][] = array(
						'type' => 'combo',
						'label' => 'NOTIFICATION FOR LOAD RETAIL MANUALLY COMPLETED',
						'labelWidth' => 300,
						//'inputWidth' => 200,
						'comboType' => 'checkbox',
						'name' => 'general_notificationforloadretailmanuallycompleted',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingmaingeneral

		function _form_settingmaingateway($routerid=false,$formid=false) {
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

		} // _form_settingmaingateway

		function _form_settingdetailsimcommand($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$params = array();

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&$post['method']=='getoption'&&!empty($post['option'])) {

					$retval = array();

					$retval['value'] = getOption($post['option'],false);

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['modemcommands_id'])) {
							$params['modemcommandsinfo'] = $result['rows'][0];

							if(!($result = $appdb->query("select * from tbl_atcommands where atcommands_modemcommandsid=".$post['rowid']." order by atcommands_id asc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['rows'][0]['atcommands_id'])) {
								$params['atcommandsinfo'] = $result['rows'];

								if(!empty($post['insertrow'])) {
									$insertrow = intval($post['insertrow']) - 1;

									$atcommandsinfo = array();

									foreach($params['atcommandsinfo'] as $k=>$v) {
										if($insertrow===$k) {
											$atcommandsinfo[] = array();
										}
										$atcommandsinfo[] =  $v;
									}

									$params['atcommandsinfo'] = $atcommandsinfo;
								}
							}

						}
					}

				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim Command successfully saved!';

					$content = array();

					$content['modemcommands_name'] = !empty($post['modemcommands_name']) ? $post['modemcommands_name'] : '';
					$content['modemcommands_desc'] = !empty($post['modemcommands_desc']) ? $post['modemcommands_desc'] : '';
					$content['modemcommands_category'] = !empty($post['modemcommands_category']) ? $post['modemcommands_category'] : '';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['modemcommands_name'])) {
							$modemcommands_name = $result['rows'][0]['modemcommands_name'];
						}

						$content['modemcommands_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_modemcommands",$content,"modemcommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($modemcommands_name)) {
							$itemContent = array();
							$itemContent['itemassignedsim_simcommand'] = $content['modemcommands_name'];

							if(!($result = $appdb->update("tbl_itemassignedsim",$itemContent,"itemassignedsim_simcommand='$modemcommands_name'"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}

					} else {

						if(!($result = $appdb->insert("tbl_modemcommands",$content,"modemcommands_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['modemcommands_id'])) {
							$retval['rowid'] = $result['returning'][0]['modemcommands_id'];
						}

					}

					if(!empty($retval['rowid'])&&!empty($post['atcommands_at'][0])) {

						if(!($result = $appdb->query("delete from tbl_atcommands where atcommands_modemcommandsid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						foreach($post['atcommands_at'] as $k=>$v) {

							if(trim($v)=='') continue;

							$content = array();
							$content['atcommands_modemcommandsid'] = $retval['rowid'];
							$content['atcommands_at'] = $v;

							$content['atcommands_regx0'] = '';

							if(!empty($post['atcommands_regx0'][$k])) {
								$json = json_decode($post['atcommands_regx0'][$k],true);
								//pre(array('$json'=>$json));
								if(!empty($json['v'])) {
									$content['atcommands_regx0'] = $json['v'];
									//pre(array('atcommands_regx0'=>$content['atcommands_regx0']));
								}
							}

							$content['atcommands_regx1'] = '';

							if(!empty($post['atcommands_regx1'][$k])) {
								$json = json_decode($post['atcommands_regx1'][$k],true);
								if(!empty($json['v'])) {
									$content['atcommands_regx1'] = $json['v'];
								}
							}

							$content['atcommands_regx2'] = '';

							if(!empty($post['atcommands_regx2'][$k])) {
								$json = json_decode($post['atcommands_regx2'][$k],true);
								if(!empty($json['v'])) {
									$content['atcommands_regx2'] = $json['v'];
								}
							}

							//$content['atcommands_regx0'] = !empty($post['atcommands_regx0'][$k]) ? $post['atcommands_regx0'][$k] : '';
							//$content['atcommands_regx1'] = !empty($post['atcommands_regx1'][$k]) ? $post['atcommands_regx1'][$k] : '';
							//$content['atcommands_regx2'] = !empty($post['atcommands_regx2'][$k]) ? $post['atcommands_regx2'][$k] : '';
							$content['atcommands_param0'] = !empty($post['atcommands_param0'][$k]) ? $post['atcommands_param0'][$k] : '';
							$content['atcommands_param1'] = !empty($post['atcommands_param1'][$k]) ? $post['atcommands_param1'][$k] : '';
							$content['atcommands_param2'] = !empty($post['atcommands_param2'][$k]) ? $post['atcommands_param2'][$k] : '';
							$content['atcommands_resultindex'] = !empty($post['atcommands_resultindex'][$k]) ? $post['atcommands_resultindex'][$k] : '';
							$content['atcommands_expectedresult'] = !empty($post['atcommands_expectedresult'][$k]) ? $post['atcommands_expectedresult'][$k] : '';
							$content['atcommands_repeat'] = !empty($post['atcommands_repeat'][$k]) ? $post['atcommands_repeat'][$k] : '';
							$content['atcommands_return'] = !empty($post['atcommands_return'][$k]) ? $post['atcommands_return'][$k] : '';

							if(!($result = $appdb->insert("tbl_atcommands",$content,"atcommands_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim Command successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_modemcommands where modemcommands_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}


							if(!($result = $appdb->query("delete from tbl_atcommands where atcommands_modemcommandsid in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_modemcommands where modemcommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}


						if(!($result = $appdb->query("delete from tbl_atcommands where atcommands_modemcommandsid=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				} else
				if($this->vars['post']['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Sim Command successfully cloned!';

					if(!empty($post['rowid'])) {

						if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['modemcommands_id'])) {

							$content = $result['rows'][0];
							$content['modemcommands_name'] = $content['modemcommands_name'] . '_clone_' . time();
							unset($content['modemcommands_id']);
							unset($content['modemcommands_createstamp']);
							unset($content['modemcommands_updatestamp']);

							if(!($result = $appdb->insert("tbl_modemcommands",$content,"modemcommands_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['modemcommands_id'])) {
								$modemcommands_id = $result['returning'][0]['modemcommands_id'];
							}

						}

					}

					if(!empty($modemcommands_id)) {

						if(!($result = $appdb->query("select * from tbl_atcommands where atcommands_modemcommandsid=".$post['rowid']." order by atcommands_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['atcommands_id'])) {

							foreach($result['rows'] as $k=>$content) {
								$content['atcommands_modemcommandsid'] = $modemcommands_id;
								unset($content['atcommands_id']);
								unset($content['atcommands_createstamp']);
								unset($content['atcommands_updatestamp']);

								if(!($result = $appdb->insert("tbl_atcommands",$content,"atcommands_id"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}
							}

						}

						$retval['rowid'] = $modemcommands_id;
					}

					json_encode_return($retval);
					die;
				}

				$params['regex'] = getOptionNamesWithType('REGEX');

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

				$block[] = array(
					'type' => 'input',
					'label' => 'NAME',
					'name' => 'modemcommands_name',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['modemcommandsinfo']['modemcommands_name']) ? $params['modemcommandsinfo']['modemcommands_name'] : '',
				);

				$block[] = array(
					'type' => 'input',
					'label' => 'DESCRIPTION',
					'name' => 'modemcommands_desc',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['modemcommandsinfo']['modemcommands_desc']) ? $params['modemcommandsinfo']['modemcommands_desc'] : '',
				);

				/*$block[] = array(
					'type' => 'input',
					'label' => 'CATEGORY',
					'name' => 'modemcommands_category',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['modemcommandsinfo']['modemcommands_category']) ? $params['modemcommandsinfo']['modemcommands_category'] : '',
				);*/

				$opt = array();

				$category = array('SMART RETAIL','GLOBE RETAIL','SUN RETAIL');

				foreach($category as $v) {
					$selected = false;
					if(!empty($params['modemcommandsinfo']['modemcommands_category'])&&$params['modemcommandsinfo']['modemcommands_category']==$v) {
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
					'label' => 'CATEGORY',
					'name' => 'modemcommands_category',
					'readonly' => true,
					//'required' => !$readonly,
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 2300,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array('type' => 'label','labelWidth' => 20,'label' => 'ID',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'AT Command',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'RegX #1',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Expression',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Param',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'RegX #2',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Expression',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Param',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'RegX #3',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Expression',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Param',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Result Index',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Expected Result',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Repeat',);
				$block[] = array('type' => 'newcolumn','offset' => 0,);
				$block[] = array('type' => 'label','labelWidth' => 150,'label' => 'Return',);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 2300,
					'blockOffset' => 0,
					'offsetTop' => 10,
					'className' => 'cls_sherwin3',
					'list' => $block,
				);

				//if(!empty($params['atcommandsinfo'])) {

					for($i=0;$i<20;$i++) {

						if($readonly) {
							if(!empty($params['atcommandsinfo'][$i]['atcommands_at'])) {
							} else continue;
						}

						$block = array();

						$block[] = array(
							'type' => 'input',
							'label' => ($i+1).'.',
							'name' => 'atcommands_at['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'labelWidth' => 20,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_at']) ? $params['atcommandsinfo'][$i]['atcommands_at'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$opt = array();

						if(!$readonly) {
							$opt[] = array('text'=>'','value'=>json_encode(array('o'=>'')),'selected'=>false);
						}

						foreach($params['regex'] as $v) {
							$selected = false;
							if(!empty($params['atcommandsinfo'][$i]['atcommands_regx0'])&&$params['atcommandsinfo'][$i]['atcommands_regx0']==$v) {
								$selected = true;
							}
							if($readonly) {
								if($selected) {
									$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
									//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
									$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
								}
							} else {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						}

						$block[] = array(
							'type' => 'combo',
							'name' => 'atcommands_regx0['.$i.']',
							'readonly' => true,
							//'required' => !$readonly,
							'inputWidth' => 150,
							//'value' => !empty($params['atcommandsinfo'][$i]['atcommands_regx0']) ? $params['atcommandsinfo'][$i]['atcommands_regx0'] : '',
							'options' => $opt,
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'options_regx0['.$i.']',
							'readonly' => true,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_regx0']) ? getOption($params['atcommandsinfo'][$i]['atcommands_regx0']) : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'atcommands_param0['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_param0']) ? $params['atcommandsinfo'][$i]['atcommands_param0'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$opt = array();

						if(!$readonly) {
							$opt[] = array('text'=>'','value'=>json_encode(array('o'=>'')),'selected'=>false);
						}

						foreach($params['regex'] as $v) {
							$selected = false;
							if(!empty($params['atcommandsinfo'][$i]['atcommands_regx1'])&&$params['atcommandsinfo'][$i]['atcommands_regx1']==$v) {
								$selected = true;
							}
							if($readonly) {
								if($selected) {
									$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
									//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
									$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
								}
							} else {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						}

						$block[] = array(
							'type' => 'combo',
							'name' => 'atcommands_regx1['.$i.']',
							'readonly' => true,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'options' => $opt,
							//'value' => !empty($params['atcommandsinfo'][$i]['atcommands_regx1']) ? $params['atcommandsinfo'][$i]['atcommands_regx1'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'options_regx1['.$i.']',
							'readonly' => true,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_regx1']) ? getOption($params['atcommandsinfo'][$i]['atcommands_regx1']) : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'atcommands_param1['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_param1']) ? $params['atcommandsinfo'][$i]['atcommands_param1'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$opt = array();

						if(!$readonly) {
							$opt[] = array('text'=>'','value'=>json_encode(array('o'=>'')),'selected'=>false);
						}

						foreach($params['regex'] as $v) {
							$selected = false;
							if(!empty($params['atcommandsinfo'][$i]['atcommands_regx2'])&&$params['atcommandsinfo'][$i]['atcommands_regx2']==$v) {
								$selected = true;
							}
							if($readonly) {
								if($selected) {
									$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
									//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
									$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
								}
							} else {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						}

						$block[] = array(
							'type' => 'combo',
							'name' => 'atcommands_regx2['.$i.']',
							'readonly' => true,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'options' => $opt,
							//'value' => !empty($params['atcommandsinfo'][$i]['atcommands_regx2']) ? $params['atcommandsinfo'][$i]['atcommands_regx2'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'options_regx2['.$i.']',
							'readonly' => true,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_regx2']) ? getOption($params['atcommandsinfo'][$i]['atcommands_regx2']) : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'atcommands_param2['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_param2']) ? $params['atcommandsinfo'][$i]['atcommands_param2'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'atcommands_resultindex['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_resultindex']) ? $params['atcommandsinfo'][$i]['atcommands_resultindex'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'atcommands_expectedresult['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_expectedresult']) ? $params['atcommandsinfo'][$i]['atcommands_expectedresult'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$block[] = array(
							'type' => 'input',
							'name' => 'atcommands_repeat['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputWidth' => 150,
							'value' => !empty($params['atcommandsinfo'][$i]['atcommands_repeat']) ? $params['atcommandsinfo'][$i]['atcommands_repeat'] : '',
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$opt = array();

						$return = array('FAILED','SENT');

						foreach($return as $v) {
							$selected = false;
							if(!empty($params['atcommandsinfo'][$i]['atcommands_return'])&&$params['atcommandsinfo'][$i]['atcommands_return']==$v) {
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
							'name' => 'atcommands_return['.$i.']',
							'readonly' => $readonly,
							//'required' => !$readonly,
							'inputWidth' => 150,
							//'value' => !empty($params['atcommandsinfo'][$i]['atcommands_return']) ? $params['atcommandsinfo'][$i]['atcommands_return'] : '',
							'options' => $opt,
						);

						$block[] = array('type' => 'newcolumn','offset' => 0,);

						$params['tbDetails'][] = array(
							'type' => 'block',
							'width' => 2200,
							'blockOffset' => 0,
							'offsetTop' => 10,
							'className' => 'cls_sherwin3',
							'list' => $block,
						);

					}

				//}



/*
			{type: "block", width: 2200, blockOffset: 0, offsetTop:10, className:"cls_sherwin3", list:[
				{type:"label",labelWidth:20,label:"ID"},
				{type: "newcolumn", offset:0},
				{type:"label",labelWidth:150,label:"AT Command"},
				{type: "newcolumn", offset:0},
				{type:"label",labelWidth:150,label:"RegX #1"},
				{type: "newcolumn", offset:300},
				{type:"label",labelWidth:150,label:"RegX #2"},
				{type: "newcolumn", offset:300},
				{type:"label",labelWidth:150,label:"RegX #3"},
				{type: "newcolumn", offset:300},
				{type:"label",labelWidth:150,label:"Result Index"},
				{type: "newcolumn", offset:0},
				{type:"label",labelWidth:150,label:"Expected Result"},
				{type: "newcolumn", offset:0},
				{type:"label",labelWidth:150,label:"Repeat"},
			]},

*/

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingdetailsimcommand

		function _form_settingdetailexpressions($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$params['smscommandsinfo'] = $result['rows'][0];
						}
					}

				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Expression successfully saved!';

					$content = array();
					$content['smscommands_active'] = !empty($post['smscommands_active']) ? 1 : 0;
					$content['smscommands_priority'] = !empty($post['smscommands_priority']) ? $post['smscommands_priority'] : 0;
					$content['smscommands_type'] = 'expressions';
					$content['smscommands_sampletext'] = !empty($post['smscommands_sampletext']) ? $post['smscommands_sampletext'] : '';
					$content['smscommands_sender'] = !empty($post['smscommands_sender']) ? $post['smscommands_sender'] : '';
					$content['smscommands_action0'] = !empty($post['smscommands_action0']) ? $post['smscommands_action0'] : '';
					$content['smscommands_desc'] = !empty($post['smscommands_desc']) ? $post['smscommands_desc'] : '';
					$content['smscommands_category'] = !empty($post['smscommands_category']) ? $post['smscommands_category'] : '';
					//$content['smscommands_action0'] = '_eLoadExpressionProcessSMS';

					for($i=0;$i<10;$i++) {

						$t = !empty($post['smscommands_key'][$i]) ? json_decode($post['smscommands_key'][$i],true) : false;

						$content['smscommands_key'.$i] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';

						//$t = !empty($post['smscommands_key_error'][$i]) ? json_decode($post['smscommands_key_error'][$i],true) : false;

						//$content['smscommands_key'.$i.'_error'] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';
					}

					//pre(array('$content'=>$content));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['smscommands_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_smscommands",$content,"smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['smscommands_id'])) {
							$retval['rowid'] = $result['returning'][0]['smscommands_id'];
						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Expression successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Expression successfully cloned!';

					if(!empty($post['rowid'])) {

						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						//pre(array('result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$content = $result['rows'][0];
							$content['smscommands_desc'] = $content['smscommands_desc'] . ' cloned '.time();
							unset($content['smscommands_id']);
							unset($content['smscommands_createstamp']);
							unset($content['smscommands_updatestamp']);

							if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['smscommands_id'])) {
								$retval['rowid'] = $result['returning'][0]['smscommands_id'];
							}

						}
					}

					json_encode_return($retval);
					die;
				}

				//$params['options'] = getAllOptionNames();

				$params['options'] = getOptionNamesWithType(array('REGEX','KEYCODE','ITEMCODE','PRODUCTCODE'));

				$params['errormessage'] = getOptionNamesWithType('ERRORMESSAGE');

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

				$block[] = array(
					'type' => 'input',
					'label' => 'PRIORITY',
					'name' => 'smscommands_priority',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_priority']) ? $params['smscommandsinfo']['smscommands_priority'] : '10',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'smscommands_active',
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_active']) ? true : false,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'DESCRIPTION',
					'name' => 'smscommands_desc',
					'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_desc']) ? $params['smscommandsinfo']['smscommands_desc'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'CATEGORY',
					'name' => 'smscommands_category',
					'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_category']) ? $params['smscommandsinfo']['smscommands_category'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'SENDER',
					'name' => 'smscommands_sender',
					'inputWidth' => 200,
					'readonly' => $readonly,
					//'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_sender']) ? $params['smscommandsinfo']['smscommands_sender'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$actionOptions = array();
				//$actionOptions[] = array('text'=>'_SendSMS','value'=>'_SendSMS');
				//$actionOptions[] = array('text'=>'_SendSMStoMobileNumber','value'=>'_SendSMStoMobileNumber');
				//$actionOptions[] = array('text'=>'_eLoadProcessSMS ( $ITEMCODE, $MOBILENUMBER )','value'=>'_eLoadProcessSMS');
				$actionOptions[] = array('text'=>'_eLoadExpressionProcessSMS','value'=>'_eLoadExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_AutoLoadMAXBalanceExpressionProcessSMS','value'=>'_AutoLoadMAXBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_SunBalanceExpressionProcessSMS','value'=>'_SunBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_LoadWalletBalanceExpressionProcessSMS','value'=>'_LoadWalletBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_LoadAirtimeBalanceExpressionProcessSMS','value'=>'_LoadAirtimeBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_SmartPadalaExpression','value'=>'_SmartPadalaExpression');

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				foreach($actionOptions as $v) {
					$selected = false;
					if($v['value']==$params['smscommandsinfo']['smscommands_action0']) {
						$selected = true;
					}
					if($readonly) {
						if($selected) {
							$v['selected'] = true;
							$opt[] = $v;
						}
					} else {
						$v['selected'] = $selected;
						$opt[] = $v;
					}
				}

				$block = array();

				$block[] = array(
					'type' => 'combo',
					'label' => 'ACTION',
					//'labelWidth' => 70,
					'inputWidth' => 500,
					'name' => 'smscommands_action0',
					'readonly' => $readonly,
					//'required' => !$readonly,
					//'numeric' => true,
					//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$sampletext = !empty($params['smscommandsinfo']['smscommands_sampletext']) ? $params['smscommandsinfo']['smscommands_sampletext'] : '';

				$block[] = array(
					'type' => 'input',
					'label' => 'SAMPLE',
					'name' => 'smscommands_sampletext',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 600,
					'value' => $sampletext,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$regx = '';

				for($i=0;$i<10;$i++) {
					$regx .= !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '';
				}

				$prebuf = '';

				$regxmatches = '';

				if(!empty($regx)&&!empty($sampletext)&&@preg_match('/'.$regx.'/si',$sampletext,$regxmatches)) {
					$prebuf = printrbuf($regxmatches);
				}

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'REGEX',
					'name' => 'smscommands_fullregx',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 600,
					'value' => $regx,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'MATCHES',
					'name' => 'smscommands_prebuf',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 5,
					'inputWidth' => 600,
					'value' => trim($prebuf),
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				for($i=0;$i<10;$i++) {

					$block = array();

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['options'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i])&&$params['smscommandsinfo']['smscommands_key'.$i]==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						'label' => 'KEY #'.($i+1),
						'name' => 'smscommands_key['.$i.']',
						'readonly' => $readonly,
						'required' => ($i===0 ? !$readonly : false),
						'inputWidth' => 300,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? $params['smscommandsinfo']['smscommands_key'.$i] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$regx = !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '';

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_['.$i.']',
						'readonly' => true,
						'inputWidth' => 300,
						'rows' => 3,
						//'required' => !$readonly,
						'value' => $regx,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					/*$sampleoutput = '';

					if(!empty($regx)&&!empty($sampletext)&&@preg_match('/'.$regx.'/si',$sampletext,$matches)) {
						//print_r(array('$matches'=>$matches));
						if(!empty($matches[1])) {
							$sampleoutput = $matches[1];
						}
					}*/

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_output_['.$i.']',
						'readonly' => true,
						'inputWidth' => 300,
						'rows' => 3,
						'value' => !empty($regxmatches[($i+1)]) ? $regxmatches[($i+1)] : '',
						//'required' => !$readonly,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '',
					);

					/*$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['errormessage'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i.'_error'])&&$params['smscommandsinfo']['smscommands_key'.$i.'_error']==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						//'label' => 'KEY #'.($i+1),
						'name' => 'smscommands_key_error['.$i.']',
						'readonly' => $readonly,
						//'required' => !$readonly,
						//'numeric' => true,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_error_['.$i.']',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? getOption($params['smscommandsinfo']['smscommands_key'.$i.'_error']) : '',
					);*/

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1500,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
					);

				}

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;
		} // _form_settingdetailexpressions

		function _form_settingdetailsmserror($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$params['smscommandsinfo'] = $result['rows'][0];
						}
					}

				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SMS Error successfully saved!';

					$content = array();
					$content['smscommands_active'] = !empty($post['smscommands_active']) ? 1 : 0;
					$content['smscommands_priority'] = !empty($post['smscommands_priority']) ? $post['smscommands_priority'] : 0;
					$content['smscommands_type'] = 'smserror';
					$content['smscommands_sampletext'] = !empty($post['smscommands_sampletext']) ? $post['smscommands_sampletext'] : '';
					//$content['smscommands_action0'] = !empty($post['smscommands_action0']) ? $post['smscommands_action0'] : '';
					$content['smscommands_desc'] = !empty($post['smscommands_desc']) ? $post['smscommands_desc'] : '';
					$content['smscommands_category'] = !empty($post['smscommands_category']) ? $post['smscommands_category'] : '';
					$content['smscommands_sender'] = !empty($post['smscommands_sender']) ? $post['smscommands_sender'] : '';
					$content['smscommands_notification0'] = !empty($post['smscommands_notification0']) ? $post['smscommands_notification0'] : '';
					$content['smscommands_smserrorcheckbalance'] = !empty($post['smscommands_smserrorcheckbalance']) ? 1 : 0;
					$content['smscommands_smserrorcheckbalancesimcommand'] = !empty($post['smscommands_smserrorcheckbalancesimcommand']) ? $post['smscommands_smserrorcheckbalancesimcommand'] : '';
					$content['smscommands_smserrorsetstatuscheckbox'] = !empty($post['smscommands_smserrorsetstatuscheckbox']) ? 1 : 0;
					$content['smscommands_smserrorsettostatus'] = !empty($post['smscommands_smserrorsettostatus']) ? $post['smscommands_smserrorsettostatus'] : 0;
					$content['smscommands_smserrorsettostatusbalanceinquiry'] = !empty($post['smscommands_smserrorsettostatusbalanceinquiry']) ? 1 : 0;
					$content['smscommands_smserrorsettostatusbalanceinquirysimcommand'] = !empty($post['smscommands_smserrorsettostatusbalanceinquirysimcommand']) ? $post['smscommands_smserrorsettostatusbalanceinquirysimcommand'] : '';
					$content['smscommands_action0'] = '_eLoadSMSErrorProcessSMS';

					for($i=0;$i<10;$i++) {

						$t = !empty($post['smscommands_key'][$i]) ? json_decode($post['smscommands_key'][$i],true) : false;

						$content['smscommands_key'.$i] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';

						//$t = !empty($post['smscommands_key_error'][$i]) ? json_decode($post['smscommands_key_error'][$i],true) : false;

						//$content['smscommands_key'.$i.'_error'] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';
					}

					//pre(array('$content'=>$content));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['smscommands_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_smscommands",$content,"smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['smscommands_id'])) {
							$retval['rowid'] = $result['returning'][0]['smscommands_id'];
						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SMS Error successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SMS Error successfully cloned!';

					if(!empty($post['rowid'])) {

						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						//pre(array('result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$content = $result['rows'][0];
							$content['smscommands_desc'] = $content['smscommands_desc'] . ' cloned '.time();
							unset($content['smscommands_id']);
							unset($content['smscommands_createstamp']);
							unset($content['smscommands_updatestamp']);

							if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['smscommands_id'])) {
								$retval['rowid'] = $result['returning'][0]['smscommands_id'];
							}

						}
					}

					json_encode_return($retval);
					die;
				}

				//$params['options'] = getAllOptionNames();

				$params['options'] = getOptionNamesWithType(array('REGEX','KEYCODE','ITEMCODE','PRODUCTCODE'));

				$params['errormessage'] = getOptionNamesWithType('ERRORMESSAGE');

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

				$block[] = array(
					'type' => 'input',
					'label' => 'PRIORITY',
					'name' => 'smscommands_priority',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_priority']) ? $params['smscommandsinfo']['smscommands_priority'] : '10',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'smscommands_active',
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_active']) ? true : false,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'DESCRIPTION',
					'name' => 'smscommands_desc',
					'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_desc']) ? $params['smscommandsinfo']['smscommands_desc'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'CATEGORY',
					'name' => 'smscommands_category',
					'inputWidth' => 500,
					'readonly' => $readonly,
					'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_category']) ? $params['smscommandsinfo']['smscommands_category'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'SENDER',
					'name' => 'smscommands_sender',
					'inputWidth' => 200,
					'readonly' => $readonly,
					//'required' => !$readonly,
					//'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_sender']) ? $params['smscommandsinfo']['smscommands_sender'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				if($readonly) {

					$block[] = array(
						'type' => 'input',
						'label' => 'NOTIFICATION',
						//'labelWidth' => 210,
						'name' => 'smscommands_notification0',
						'readonly' => $readonly,
						'required' => !$readonly,
						'value' => !empty($params['smscommandsinfo']['smscommands_notification0']) ? $params['smscommandsinfo']['smscommands_notification0'] : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$lnotification = array();

					if(!empty($params['smscommandsinfo']['smscommands_notification0'])) {
						$lnotification = explode(',', $params['smscommandsinfo']['smscommands_notification0']);
					}

					//pre(array('$lnotification'=>$lnotification));

					foreach($allNotifications as $k=>$v) {
						$checked = false;

						//if($v['customer_id']==$vars['params']['customerinfo']['customer_parent']) {
						//	$selected = true;
						//}

						if(in_array($v['notification_id'],$lnotification)) {
							$checked = true;
						}

						$opt[] = array('value'=>$v['notification_id'],'checked'=>$checked,'text'=>array(
							//'notificationid' => !empty($v['notification_id']) ? $v['notification_id'] : ' ',
							//'notificationname' => !empty($v['notification_name']) ? $v['notification_name'] : ' ',
							//'notificationtype' => !empty($v['notification_type']) ? $v['notification_type'] : ' ',
							'notificationvalue' => !empty($v['notification_value']) ? $v['notification_value'] : ' '
						));
					}

					$params['smscommands_notification0opt'] = array(
						'opts'=>$opt,
						'value' => !empty($params['smscommandsinfo']['smscommands_notification0']) ? $params['smscommandsinfo']['smscommands_notification0'] : '',
					);


					$block[] = array(
						'type' => 'combo',
						'label' => 'NOTIFICATION',
						//'labelWidth' => 210,
						//'inputWidth' => 200,
						'comboType' => 'checkbox',
						'name' => 'smscommands_notification0',
						'readonly' => $readonly,
						//'required' => !$readonly,
						'options' => array(),
					);

				}

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$actionOptions = array();
				//$actionOptions[] = array('text'=>'_SendSMS','value'=>'_SendSMS');
				//$actionOptions[] = array('text'=>'_SendSMStoMobileNumber','value'=>'_SendSMStoMobileNumber');
				//$actionOptions[] = array('text'=>'_eLoadProcessSMS ( $ITEMCODE, $MOBILENUMBER )','value'=>'_eLoadProcessSMS');
				$actionOptions[] = array('text'=>'_eLoadExpressionProcessSMS','value'=>'_eLoadExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_AutoLoadMAXBalanceExpressionProcessSMS','value'=>'_AutoLoadMAXBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_SunBalanceExpressionProcessSMS','value'=>'_SunBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_LoadWalletBalanceExpressionProcessSMS','value'=>'_LoadWalletBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_LoadAirtimeBalanceExpressionProcessSMS','value'=>'_LoadAirtimeBalanceExpressionProcessSMS');
				$actionOptions[] = array('text'=>'_SmartPadalaExpression','value'=>'_SmartPadalaExpression');

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				foreach($actionOptions as $v) {
					$selected = false;
					if(!empty($params['smscommandsinfo']['smscommands_action0'])&&$v['value']==$params['smscommandsinfo']['smscommands_action0']) {
						$selected = true;
					}
					if($readonly) {
						if($selected) {
							$v['selected'] = true;
							$opt[] = $v;
						}
					} else {
						$v['selected'] = $selected;
						$opt[] = $v;
					}
				}

				/*$block = array();

				$block[] = array(
					'type' => 'combo',
					'label' => 'ACTION',
					//'labelWidth' => 70,
					'inputWidth' => 500,
					'name' => 'smscommands_action0',
					'readonly' => $readonly,
					//'required' => !$readonly,
					//'numeric' => true,
					//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);*/

				$block = array();

				$sampletext = !empty($params['smscommandsinfo']['smscommands_sampletext']) ? $params['smscommandsinfo']['smscommands_sampletext'] : '';

				$block[] = array(
					'type' => 'input',
					'label' => 'SAMPLE',
					'name' => 'smscommands_sampletext',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 600,
					'value' => $sampletext,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$regx = '';

				for($i=0;$i<10;$i++) {
					$regx .= !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '';
				}

				$prebuf = '';

				$regxmatches = '';

				if(!empty($regx)&&!empty($sampletext)&&@preg_match('/'.$regx.'/si',$sampletext,$regxmatches)) {
					$prebuf = printrbuf($regxmatches);
				}

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'REGEX',
					'name' => 'smscommands_fullregx',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 600,
					'value' => $regx,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'MATCHES',
					'name' => 'smscommands_prebuf',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 5,
					'inputWidth' => 600,
					'value' => trim($prebuf),
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				for($i=0;$i<10;$i++) {

					$block = array();

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['options'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i])&&$params['smscommandsinfo']['smscommands_key'.$i]==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						'label' => 'KEY #'.($i+1),
						'name' => 'smscommands_key['.$i.']',
						'readonly' => $readonly,
						'required' => ($i===0 ? !$readonly : false),
						'inputWidth' => 300,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? $params['smscommandsinfo']['smscommands_key'.$i] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$regx = !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '';

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_['.$i.']',
						'readonly' => true,
						'inputWidth' => 300,
						'rows' => 3,
						//'required' => !$readonly,
						'value' => $regx,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					/*$sampleoutput = '';

					if(!empty($regx)&&!empty($sampletext)&&@preg_match('/'.$regx.'/si',$sampletext,$matches)) {
						//print_r(array('$matches'=>$matches));
						if(!empty($matches[1])) {
							$sampleoutput = $matches[1];
						}
					}*/

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_output_['.$i.']',
						'readonly' => true,
						'inputWidth' => 300,
						'rows' => 3,
						'value' => !empty($regxmatches[($i+1)]) ? $regxmatches[($i+1)] : '',
						//'required' => !$readonly,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '',
					);

					/*$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['errormessage'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i.'_error'])&&$params['smscommandsinfo']['smscommands_key'.$i.'_error']==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						//'label' => 'KEY #'.($i+1),
						'name' => 'smscommands_key_error['.$i.']',
						'readonly' => $readonly,
						//'required' => !$readonly,
						//'numeric' => true,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_error_['.$i.']',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? getOption($params['smscommandsinfo']['smscommands_key'.$i.'_error']) : '',
					);*/

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1500,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
					);

				}

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'A. CHECK BALANCE',
					'name' => 'smscommands_smserrorcheckbalance',
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_smserrorcheckbalance']) ? true : false,
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
					if(!empty($params['smscommandsinfo']['smscommands_smserrorcheckbalancesimcommand'])&&$params['smscommandsinfo']['smscommands_smserrorcheckbalancesimcommand']==$v) {
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
					'name' => 'smscommands_smserrorcheckbalancesimcommand',
					'inputWidth' => 300,
					'readonly' => true,
					//'value' => !empty($params['simcardinfo']['simcard_failedbalanceinquirysimcommand']) ? $params['simcardinfo']['simcard_failedbalanceinquirysimcommand'] : '',
					'options' => $opt,
				);

				$params['tbFeatures'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'B. SET STATUS',
					'name' => 'smscommands_smserrorsetstatuscheckbox',
					'inputWidth' => 150,
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_smserrorsetstatuscheckbox']) ? true : false,
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				$opt = array();

				//if(!$readonly) {
				//	$opt[] = array('text'=>'','value'=>'','selected'=>false);
				//}

				$status = array(TRN_CANCELLED=>TRNS_CANCELLED,TRN_HOLD=>TRNS_HOLD);

				foreach($status as $k=>$v) {
					$selected = false;
					if(!empty($params['smscommandsinfo']['smscommands_smserrorsettostatus'])&&$params['smscommandsinfo']['smscommands_smserrorsettostatus']==$k) {
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

				$block[] = array(
					'type' => 'combo',
					'name' => 'smscommands_smserrorsettostatus',
					'inputWidth' => 300,
					'readonly' => true,
					//'value' => !empty($params['simcardinfo']['simcard_failedbalanceinquirysimcommand']) ? $params['simcardinfo']['simcard_failedbalanceinquirysimcommand'] : '',
					'options' => $opt,
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 20,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'PERFORM BALANCE INQUIRY',
					'name' => 'smscommands_smserrorsettostatusbalanceinquiry',
					'labelWidth' => 200,
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_smserrorsettostatusbalanceinquiry']) ? true : false,
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
					if(!empty($params['smscommandsinfo']['smscommands_smserrorsettostatusbalanceinquirysimcommand'])&&$params['smscommandsinfo']['smscommands_smserrorsettostatusbalanceinquirysimcommand']==$v) {
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
					'name' => 'smscommands_smserrorsettostatusbalanceinquirysimcommand',
					'inputWidth' => 300,
					'readonly' => true,
					//'value' => !empty($params['simcardinfo']['simcard_failedbalanceinquirysimcommand']) ? $params['simcardinfo']['simcard_failedbalanceinquirysimcommand'] : '',
					'options' => $opt,
				);

				$params['tbFeatures'][] = array(
					'type' => 'block',
					'width' => 1500,
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
		} // _form_settingdetailsmserror

		function _form_settingdetailsmserrorXXX($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$params['smscommandsinfo'] = $result['rows'][0];
						}
					}

				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SMS Error successfully saved!';

					$content = array();
					$content['smscommands_active'] = !empty($post['smscommands_active']) ? 1 : 0;
					$content['smscommands_priority'] = !empty($post['smscommands_priority']) ? $post['smscommands_priority'] : 0;
					$content['smscommands_type'] = 'smserror';
					$content['smscommands_sampletext'] = !empty($post['smscommands_sampletext']) ? $post['smscommands_sampletext'] : '';
					$content['smscommands_action0'] = !empty($post['smscommands_action0']) ? $post['smscommands_action0'] : '';
					//$content['smscommands_action0'] = '_eLoadSMSErrorProcessSMS';

					for($i=0;$i<10;$i++) {

						$t = !empty($post['smscommands_key'][$i]) ? json_decode($post['smscommands_key'][$i],true) : false;

						$content['smscommands_key'.$i] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';

						//$t = !empty($post['smscommands_key_error'][$i]) ? json_decode($post['smscommands_key_error'][$i],true) : false;

						//$content['smscommands_key'.$i.'_error'] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';
					}

					//pre(array('$content'=>$content));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['smscommands_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_smscommands",$content,"smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['smscommands_id'])) {
							$retval['rowid'] = $result['returning'][0]['smscommands_id'];
						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SMS Error successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'SMS Error successfully cloned!';

					if(!empty($post['rowid'])) {

						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						//pre(array('result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$content = $result['rows'][0];
							unset($content['smscommands_id']);
							unset($content['smscommands_createstamp']);
							unset($content['smscommands_updatestamp']);

							if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['smscommands_id'])) {
								$retval['rowid'] = $result['returning'][0]['smscommands_id'];
							}

						}
					}

					json_encode_return($retval);
					die;
				}

				//$params['options'] = getAllOptionNames();

				$params['options'] = getOptionNamesWithType(array('REGEX','KEYCODE','ITEMCODE','PRODUCTCODE'));

				$params['errormessage'] = getOptionNamesWithType('ERRORMESSAGE');

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

				$block[] = array(
					'type' => 'input',
					'label' => 'PRIORITY',
					'name' => 'smscommands_priority',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_priority']) ? $params['smscommandsinfo']['smscommands_priority'] : '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'smscommands_active',
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_active']) ? true : false,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$sampletext = !empty($params['smscommandsinfo']['smscommands_sampletext']) ? $params['smscommandsinfo']['smscommands_sampletext'] : '';

				$block[] = array(
					'type' => 'input',
					'label' => 'SAMPLE',
					'name' => 'smscommands_sampletext',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 600,
					'value' => $sampletext,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$regx = '';

				for($i=0;$i<10;$i++) {
					$regx .= !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '';
				}

				$prebuf = '';

				$regxmatches = '';

				if(!empty($regx)&&!empty($sampletext)&&@preg_match('/'.$regx.'/si',$sampletext,$regxmatches)) {
					$prebuf = printrbuf($regxmatches);
				}

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'REGEX',
					'name' => 'smscommands_fullregx',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 600,
					'value' => $regx,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'MATCHES',
					'name' => 'smscommands_prebuf',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 5,
					'inputWidth' => 600,
					'value' => trim($prebuf),
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1500,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				for($i=0;$i<10;$i++) {

					$block = array();

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['options'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i])&&$params['smscommandsinfo']['smscommands_key'.$i]==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						'label' => 'KEY #'.($i+1),
						'name' => 'smscommands_key['.$i.']',
						'readonly' => $readonly,
						'required' => ($i===0 ? !$readonly : false),
						'inputWidth' => 300,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? $params['smscommandsinfo']['smscommands_key'.$i] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$regx = !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '';

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_['.$i.']',
						'readonly' => true,
						'inputWidth' => 300,
						'rows' => 3,
						//'required' => !$readonly,
						'value' => $regx,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					/*$sampleoutput = '';

					if(!empty($regx)&&!empty($sampletext)&&@preg_match('/'.$regx.'/si',$sampletext,$matches)) {
						//print_r(array('$matches'=>$matches));
						if(!empty($matches[1])) {
							$sampleoutput = $matches[1];
						}
					}*/

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_output_['.$i.']',
						'readonly' => true,
						'inputWidth' => 300,
						'rows' => 3,
						'value' => !empty($regxmatches[($i+1)]) ? $regxmatches[($i+1)] : '',
						//'required' => !$readonly,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '',
					);

					/*$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['errormessage'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i.'_error'])&&$params['smscommandsinfo']['smscommands_key'.$i.'_error']==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						//'label' => 'KEY #'.($i+1),
						'name' => 'smscommands_key_error['.$i.']',
						'readonly' => $readonly,
						//'required' => !$readonly,
						//'numeric' => true,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_error_['.$i.']',
						'readonly' => true,
						//'required' => !$readonly,
						'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? getOption($params['smscommandsinfo']['smscommands_key'.$i.'_error']) : '',
					);*/

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1500,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
					);

				}

				$actionOptions = array();
				$actionOptions[] = array('text'=>'_SendSMS','value'=>'_SendSMS');
				$actionOptions[] = array('text'=>'_SendSMStoMobileNumber','value'=>'_SendSMStoMobileNumber');
				$actionOptions[] = array('text'=>'_eLoadProcessSMS ( $ITEMCODE, $MOBILENUMBER )','value'=>'_eLoadProcessSMS');
				$actionOptions[] = array('text'=>'_eLoadExpressionProcessSMS','value'=>'_eLoadExpressionProcessSMS');

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				foreach($actionOptions as $v) {
					$selected = false;
					if($v['value']==$params['smscommandsinfo']['smscommands_action0']) {
						$selected = true;
					}
					if($readonly) {
						if($selected) {
							$v['selected'] = true;
							$opt[] = $v;
						}
					} else {
						$v['selected'] = $selected;
						$opt[] = $v;
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'combo',
					'label' => 'ACTION',
					//'labelWidth' => 70,
					'inputWidth' => 500,
					'name' => 'smscommands_action0',
					'readonly' => $readonly,
					//'required' => !$readonly,
					//'numeric' => true,
					//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
					'options' => $opt,
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;
		} // _form_settingdetailsmserror

		function _form_settingdetailloadcommand($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$params = array();

				$post = $this->vars['post'];

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$params['smscommandsinfo'] = $result['rows'][0];
						}
					}

				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Load Command successfully saved!';

					$content = array();
					$content['smscommands_name'] = !empty($post['smscommands_name']) ? $post['smscommands_name'] : '';
					$content['smscommands_active'] = !empty($post['smscommands_active']) ? 1 : 0;
					$content['smscommands_checkprovider'] = !empty($post['smscommands_checkprovider']) ? 1 : 0;
					$content['smscommands_priority'] = !empty($post['smscommands_priority']) ? $post['smscommands_priority'] : 0;
					$content['smscommands_action0'] = !empty($post['smscommands_action0']) ? $post['smscommands_action0'] : '';
					$content['smscommands_checkprovidernotification'] = !empty($post['smscommands_checkprovidernotification']) ? $post['smscommands_checkprovidernotification'] : '';
					$content['smscommands_type'] = 'loadcommand';
					//$content['smscommands_action0'] = '_eLoadProcessSMS';

					for($i=0;$i<10;$i++) {

						$t = !empty($post['smscommands_key'][$i]) ? json_decode($post['smscommands_key'][$i],true) : false;

						$content['smscommands_key'.$i] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';

						$t = !empty($post['smscommands_key_error'][$i]) ? json_decode($post['smscommands_key_error'][$i],true) : false;

						$content['smscommands_key'.$i.'_error'] = !empty($t)&&!empty($t['v']) ? $t['v'] : '';
						$content['smscommands_notification'.$i] = !empty($post['smscommands_key_notifications'][$i]) ? $post['smscommands_key_notifications'][$i] : '';
					}

					//pre(array('$content'=>$content));

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['smscommands_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_smscommands",$content,"smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['smscommands_id'])) {
							$retval['rowid'] = $result['returning'][0]['smscommands_id'];
						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Load Command successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Load Command successfully cloned!';

					if(!empty($post['rowid'])) {

						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						//pre(array('result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$content = $result['rows'][0];
							unset($content['smscommands_id']);
							unset($content['smscommands_createstamp']);
							unset($content['smscommands_updatestamp']);

							if(!($result = $appdb->insert("tbl_smscommands",$content,"smscommands_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['smscommands_id'])) {
								$retval['rowid'] = $result['returning'][0]['smscommands_id'];
							}

						}
					}

					json_encode_return($retval);
					die;
				}

				//$params['options'] = getAllOptionNames();

				$params['options'] = getOptionNamesWithType(array('REGEX','KEYCODE','ITEMCODE','PRODUCTCODE'));

				$params['errormessage'] = getNotificationNamesWithType('ERRORMESSAGE');

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

				$block[] = array(
					'type' => 'input',
					'label' => 'NAME',
					'labelWidth' => 70,
					'inputWidth' => 500,
					'name' => 'smscommands_name',
					'readonly' => $readonly,
					'required' => !$readonly,
					'value' => !empty($params['smscommandsinfo']['smscommands_name']) ? $params['smscommandsinfo']['smscommands_name'] : '',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'smscommands_active',
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_active']) ? true : false,
				);

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$block = array();

				$block[] = array(
					'type' => 'input',
					'label' => 'PRIORITY',
					'labelWidth' => 70,
					'name' => 'smscommands_priority',
					'readonly' => $readonly,
					'required' => !$readonly,
					'numeric' => true,
					'value' => !empty($params['smscommandsinfo']['smscommands_priority']) ? $params['smscommandsinfo']['smscommands_priority'] : '40',
				);

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => $newcolumnoffset,
				);

				$block[] = array(
					'type' => 'checkbox',
					'label' => 'CHECK PROVIDER',
					'name' => 'smscommands_checkprovider',
					//'offsetTop' => 10,
					'position' => 'label-right',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'checked' => !empty($params['smscommandsinfo']['smscommands_checkprovider']) ? true : false,
				);

///////////

				$block[] = array(
					'type' => 'newcolumn',
					'offset' => 0,
				);

				if($readonly) {

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_checkprovidernotification',
						'readonly' => true,
						'inputWidth' => 272,
						'value' => !empty($params['smscommandsinfo']['smscommands_checkprovidernotification']) ? $params['smscommandsinfo']['smscommands_checkprovidernotification'] : '',
					);

				} else {

					$opt = array();

					$allNotifications = getAllNotifications();

					$lnotification = explode(',', $params['smscommandsinfo']['smscommands_checkprovidernotification']);

					foreach($allNotifications as $k=>$v) {
						$checked = false;

						if(in_array($v['notification_id'],$lnotification)) {
							$checked = true;
						}

						$opt[] = array('value'=>$v['notification_id'],'checked'=>$checked,'text'=>array(
							'notificationvalue' => !empty($v['notification_value']) ? $v['notification_value'] : ' '
						));
					}

					$params['smscommands_checkprovidernotification'] = array(
						'opts'=>$opt,
						'value'=>!empty($params['smscommandsinfo']['smscommands_checkprovidernotification']) ? $params['smscommandsinfo']['smscommands_checkprovidernotification'] : ''
					);

					$block[] = array(
						'type' => 'combo',
						'name' => 'smscommands_checkprovidernotification',
						'readonly' => true,
						'inputWidth' => 272,
						'comboType' => 'checkbox',
						'options' => array(),
					);

				}

///////////

				$params['tbDetails'][] = array(
					'type' => 'block',
					'width' => 1000,
					'blockOffset' => 0,
					'offsetTop' => 5,
					'list' => $block,
				);

				$actionOptions = array();
				$actionOptions[] = array('text'=>'_SendSMS','value'=>'_SendSMS');
				$actionOptions[] = array('text'=>'_SendSMStoMobileNumber','value'=>'_SendSMStoMobileNumber');
				$actionOptions[] = array('text'=>'_eLoadProcessSMS ( $ITEMCODE, $MOBILENUMBER )','value'=>'_eLoadProcessSMS');
				$actionOptions[] = array('text'=>'_eLoadExpressionProcessSMS','value'=>'_eLoadExpressionProcessSMS');
				//$actionOptions[] = array('text'=>'_LoadWalletProcessSMS','value'=>'_LoadWalletProcessSMS');
				$actionOptions[] = array('text'=>'_LoadWalletBalanceProcessSMS','value'=>'_LoadWalletBalanceProcessSMS');
				$actionOptions[] = array('text'=>'_LoadAirtimeBalanceProcessSMS','value'=>'_LoadAirtimeBalanceProcessSMS');
				$actionOptions[] = array('text'=>'_childReload','value'=>'_childReload');
				$actionOptions[] = array('text'=>'_fundTransfer','value'=>'_fundTransfer');
				$actionOptions[] = array('text'=>'_fundCredit','value'=>'_fundCredit');
				$actionOptions[] = array('text'=>'_eShopBalance','value'=>'_eShopBalance');
				$actionOptions[] = array('text'=>'_eShopStatus','value'=>'_eShopStatus');
				//$actionOptions[] = array('text'=>'_eShopVL','value'=>'_eShopVL');
				//$actionOptions[] = array('text'=>'_MobileDTR','value'=>'_MobileDTR');
				$actionOptions[] = array('text'=>'_SmartPadalaCustomerPayment','value'=>'_SmartPadalaCustomerPayment');

				$opt = array();

				if(!$readonly) {
					$opt[] = array('text'=>'','value'=>'','selected'=>false);
				}

				foreach($actionOptions as $v) {
					$selected = false;
					if($v['value']==$params['smscommandsinfo']['smscommands_action0']) {
						$selected = true;
					}
					if($readonly) {
						if($selected) {
							$v['selected'] = true;
							$opt[] = $v;
						}
					} else {
						$v['selected'] = $selected;
						$opt[] = $v;
					}
				}

				$params['tbDetails'][] = array(
					'type' => 'combo',
					'label' => 'ACTION',
					'labelWidth' => 70,
					'inputWidth' => 800,
					'name' => 'smscommands_action0',
					'readonly' => $readonly,
					//'required' => !$readonly,
					//'numeric' => true,
					//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
					'options' => $opt,
				);

				for($i=0;$i<10;$i++) {

					$block = array();

					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['options'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i])&&$params['smscommandsinfo']['smscommands_key'.$i]==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getOption($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						'label' => 'KEY #'.($i+1),
						'labelWidth' => 70,
						'name' => 'smscommands_key['.$i.']',
						'readonly' => $readonly,
						'required' => ($i===0 ? !$readonly : false),
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? $params['smscommandsinfo']['smscommands_key'.$i] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_['.$i.']',
						'readonly' => true,
						'inputWidth' => 300,
						'rows' => 3,
						//'required' => !$readonly,
						'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i]) ? getOption($params['smscommandsinfo']['smscommands_key'.$i]) : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 20,
					);

					/*
					$opt = array();

					if(!$readonly) {
						$opt[] = array('text'=>'','value'=>'','selected'=>false);
					}

					foreach($params['errormessage'] as $v) {
						$selected = false;
						if(!empty($params['smscommandsinfo']['smscommands_key'.$i.'_error'])&&$params['smscommandsinfo']['smscommands_key'.$i.'_error']==$v) {
							$selected = true;
						}
						if($readonly) {
							if($selected) {
								$jv = json_encode(array('v'=>$v,'o'=>getNotification($v,'')));
								//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
								$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
							}
						} else {
							$jv = json_encode(array('v'=>$v,'o'=>getNotification($v,'')));
							//$opt[] = array('text'=>$v,'value'=>$v.'|'.getOption($v,''),'selected'=>$selected);
							$opt[] = array('text'=>$v,'value'=>$jv,'selected'=>$selected);
						}
					}

					$block[] = array(
						'type' => 'combo',
						//'label' => 'KEY #'.($i+1),
						'name' => 'smscommands_key_error['.$i.']',
						'readonly' => $readonly,
						//'required' => !$readonly,
						//'numeric' => true,
						//'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? $params['smscommandsinfo']['smscommands_key'.$i.'_error'] : '',
						'options' => $opt,
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'input',
						'name' => 'smscommands_key_error_['.$i.']',
						'readonly' => true,
						'inputWidth' => 100,
						'rows' => 3,
						//'required' => !$readonly,
						'value' => !empty($params['smscommandsinfo']['smscommands_key'.$i.'_error']) ? getNotification($params['smscommandsinfo']['smscommands_key'.$i.'_error']) : '',
					);

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);*/

					if($readonly) {

						$block[] = array(
							'type' => 'input',
							'name' => 'smscommands_key_notifications_['.$i.']',
							'readonly' => true,
							'inputWidth' => 272,
							'value' => !empty($params['smscommandsinfo']['smscommands_notification'.$i]) ? $params['smscommandsinfo']['smscommands_notification'.$i] : '',
						);

					} else {

						$opt = array();

						$allNotifications = getAllNotifications();

						$lnotification = explode(',', $params['smscommandsinfo']['smscommands_notification'.$i]);

						//pre(array('$lnotification'=>$lnotification));

						foreach($allNotifications as $k=>$v) {
							$checked = false;

							//if($v['customer_id']==$vars['params']['customerinfo']['customer_parent']) {
							//	$selected = true;
							//}

							if(in_array($v['notification_id'],$lnotification)) {
								$checked = true;
							}

							$opt[] = array('value'=>$v['notification_id'],'checked'=>$checked,'text'=>array(
								//'notificationid' => !empty($v['notification_id']) ? $v['notification_id'] : ' ',
								//'notificationname' => !empty($v['notification_name']) ? $v['notification_name'] : ' ',
								//'notificationtype' => !empty($v['notification_type']) ? $v['notification_type'] : ' ',
								'notificationvalue' => !empty($v['notification_value']) ? $v['notification_value'] : ' '
							));
						}

						$params['notificationopt'][$i] = array(
							'opts'=>$opt,
							'value'=>!empty($params['smscommandsinfo']['smscommands_notification'.$i]) ? $params['smscommandsinfo']['smscommands_notification'.$i] : ''
						);

						$block[] = array(
							'type' => 'combo',
							//'label' => 'KEY #'.($i+1),
							'name' => 'smscommands_key_notifications['.$i.']',
							'readonly' => true,
							'inputWidth' => 272,
							'comboType' => 'checkbox',
							//'required' => !$readonly,
							//'numeric' => true,
							//'value' => !empty($params['smscommandsinfo']['smscommands_notification'.$i]) ? $params['smscommandsinfo']['smscommands_notification'.$i] : '',
							'options' => array(),
						);

					}

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1500,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
					);

				} // for($i=0;$i<10;$i++) {

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingdetailloadcommand

		function _form_settingdetailnetworkprefix($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$params = array();

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_network where network_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['network_id'])) {
							$params['networkinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Network Prefix successfully saved!';

					$content = array();
					$content['network_number'] = !empty($post['network_number']) ? trim($post['network_number']) : '';
					$content['network_name'] = !empty($post['network_name']) ? trim($post['network_name']) : '';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['network_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_network",$content,"network_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_network",$content,"network_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['network_id'])) {
							$retval['rowid'] = $result['returning'][0]['network_id'];
						}

					}

					json_encode_return($retval);
					die;

				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Network Prefix successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_network where network_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_network where network_id=".$post['rowid']))) {
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

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'PREFIX',
					'name' => 'network_number',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputMask' => '999',
					'inputWidth' => 100,
					'value' => !empty($params['networkinfo']['network_number']) ? $params['networkinfo']['network_number'] : '',
				);

				$providers = getProviders();

				$opt = array();

				foreach($providers as $v) {
					$selected = false;

					if(!empty($params['networkinfo']['network_name'])&&$params['networkinfo']['network_name']==$v) {
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
					'name' => 'network_name',
					'readonly' => true,
					'required' => !$readonly,
					'inputWidth' => 300,
					'options' => $opt,
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingdetailnetworkprefix

		function _form_settingdetailprovider($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$params = array();

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_provider where provider_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['provider_id'])) {
							$params['providerinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Provider successfully saved!';

					$content = array();
					$content['provider_name'] = !empty($post['provider_name']) ? trim($post['provider_name']) : '';
					$content['provider_desc'] = !empty($post['provider_desc']) ? trim($post['provider_desc']) : '';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['provider_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_provider",$content,"provider_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_provider",$content,"provider_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['provider_id'])) {
							$retval['rowid'] = $result['returning'][0]['provider_id'];
						}

					}

					json_encode_return($retval);
					die;
				}
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Provider successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_provider where provider_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_provider where provider_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					json_encode_return($retval);
					die;
				}

				$params['hello'] = 'Hello, Sherwin!';

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'NAME',
					'name' => 'provider_name',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['providerinfo']['provider_name']) ? $params['providerinfo']['provider_name'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DESCRIPTION',
					'name' => 'provider_desc',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['providerinfo']['provider_desc']) ? $params['providerinfo']['provider_desc'] : '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingdetailprovider

		function _form_settingdetailoptions($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$params = array();

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_options where options_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['options_id'])) {
							$params['optionsinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Options successfully saved!';

					$content = array();
					$content['options_name'] = !empty($post['options_name']) ? trim($post['options_name']) : '';
					$content['options_value'] = !empty($post['options_value']) ? trim($post['options_value']) : '';
					$content['options_type'] = !empty($post['options_type']) ? trim($post['options_type']) : '';
					$content['options_desc'] = !empty($post['options_desc']) ? trim($post['options_desc']) : '';
					$content['options_hidden'] = !empty($post['options_hidden']) ? 1 : 0;
					$content['options_field1'] = !empty($post['options_field1']) ? trim($post['options_field1']) : '';
					$content['options_field2'] = !empty($post['options_field2']) ? trim($post['options_field2']) : '';
					$content['options_field3'] = !empty($post['options_field3']) ? trim($post['options_field3']) : '';
					$content['options_field4'] = !empty($post['options_field4']) ? trim($post['options_field4']) : '';
					$content['options_field5'] = !empty($post['options_field5']) ? trim($post['options_field5']) : '';
					$content['options_field6'] = !empty($post['options_field6']) ? trim($post['options_field6']) : '';
					$content['options_field7'] = !empty($post['options_field7']) ? trim($post['options_field7']) : '';
					$content['options_field8'] = !empty($post['options_field8']) ? trim($post['options_field8']) : '';
					$content['options_field9'] = !empty($post['options_field9']) ? trim($post['options_field9']) : '';
					$content['options_field10'] = !empty($post['options_field10']) ? trim($post['options_field10']) : '';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						if(!($result = $appdb->update("tbl_options",$content,"options_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_options",$content,"options_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['options_id'])) {
							$retval['rowid'] = $result['returning'][0]['options_id'];
						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Options successfully cloned!';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						if(!($result = $appdb->query("select * from tbl_options where options_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['options_id'])) {
							$content = $result['rows'][0];
							unset($content['options_id']);
							unset($content['options_timestamp']);
							$content['options_name'] = $content['options_name'] . '_clone_' . time();

							if(!($result = $appdb->insert("tbl_options",$content,"options_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['options_id'])) {
								$retval['rowid'] = $result['returning'][0]['options_id'];
							}

						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Options successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_options where options_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_options where options_id=".$post['rowid']))) {
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

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'NAME',
					'name' => 'options_name',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_name']) ? $params['optionsinfo']['options_name'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DESCRIPTION',
					'name' => 'options_desc',
					'readonly' => $readonly,
					'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_desc']) ? $params['optionsinfo']['options_desc'] : '',
				);

				$options_types = array('STRING','NUMERIC','SETTING','NETWORK','REGEX','KEYCODE','PRODUCTCODE','ITEMCODE','ERRORMESSAGE','MESSAGE');

				$opt = array();
				foreach($options_types as $v) {
					$selected = false;
					if(!empty($params['optionsinfo']['options_type'])&&$params['optionsinfo']['options_type']==$v) {
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
					'name' => 'options_type',
					'readonly' => true,
					'required' => !$readonly,
					'inputWidth' => 500,
					//'value' => '',
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'VALUE',
					'name' => 'options_value',
					'readonly' => $readonly,
					'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_value']) ? $params['optionsinfo']['options_value'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'HIDDEN',
					'name' => 'options_hidden',
					'readonly' => $readonly,
					'checked' => !empty($params['optionsinfo']['options_hidden']) ? true : false,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #1',
					'name' => 'options_field1',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field1']) ? $params['optionsinfo']['options_field1'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #2',
					'name' => 'options_field2',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field2']) ? $params['optionsinfo']['options_field2'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #3',
					'name' => 'options_field3',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field3']) ? $params['optionsinfo']['options_field3'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #4',
					'name' => 'options_field4',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field4']) ? $params['optionsinfo']['options_field4'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #5',
					'name' => 'options_field5',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field5']) ? $params['optionsinfo']['options_field5'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #6',
					'name' => 'options_field6',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field6']) ? $params['optionsinfo']['options_field6'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #7',
					'name' => 'options_field7',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field7']) ? $params['optionsinfo']['options_field7'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #8',
					'name' => 'options_field8',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field8']) ? $params['optionsinfo']['options_field8'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #9',
					'name' => 'options_field9',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field9']) ? $params['optionsinfo']['options_field9'] : '',
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FIELD #10',
					'name' => 'options_field10',
					'readonly' => $readonly,
					//'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['optionsinfo']['options_field10']) ? $params['optionsinfo']['options_field10'] : '',
				);


				/*$params['tbDetails'][] = array(
					'type' => 'checkbox',
					'label' => 'ACTIVE',
					'name' => 'provider_desc',
					'readonly' => $readonly,
					//'checked' => !empty($params['productinfo']['eloadproduct_disabled']) ? true : false,
					//'required' => !$readonly,
					//'value' => '',
				);*/

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingdetailoptions

		function _form_settingdetailnotification($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$params = array();

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_notification where notification_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['notification_id'])) {
							$params['notificationinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Notification successfully saved!';

					$content = array();
					$content['notification_name'] = !empty($post['notification_name']) ? trim($post['notification_name']) : '';
					$content['notification_value'] = !empty($post['notification_value']) ? trim($post['notification_value']) : '';
					$content['notification_type'] = !empty($post['notification_type']) ? trim($post['notification_type']) : '';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						if(!($result = $appdb->update("tbl_notification",$content,"notification_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_notification",$content,"notification_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['notification_id'])) {
							$retval['rowid'] = $result['returning'][0]['notification_id'];
						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Notification successfully cloned!';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						if(!($result = $appdb->query("select * from tbl_notification where notification_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['notification_id'])) {
							$content = $result['rows'][0];
							unset($content['notification_id']);
							unset($content['notification_timestamp']);
							$content['notification_name'] = $content['notification_name'] . '_clone_' . time();

							if(!($result = $appdb->insert("tbl_notification",$content,"notification_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['notification_id'])) {
								$retval['rowid'] = $result['returning'][0]['notification_id'];
							}

						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Notification successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_notification where notification_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_notification where notification_id=".$post['rowid']))) {
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

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'NAME',
					'name' => 'notification_name',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['notificationinfo']['notification_name']) ? $params['notificationinfo']['notification_name'] : '',
				);

				$notification_types = array('ERRORMESSAGE','MESSAGE');

				$opt = array();
				foreach($notification_types as $v) {
					$selected = false;
					if(!empty($params['notificationinfo']['notification_type'])&&$params['notificationinfo']['notification_type']==$v) {
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
					'name' => 'notification_type',
					'readonly' => true,
					'required' => !$readonly,
					'inputWidth' => 500,
					//'value' => '',
					'options' => $opt,
				);

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'VALUE',
					'name' => 'notification_value',
					'readonly' => $readonly,
					'required' => !$readonly,
					'rows' => 3,
					'inputWidth' => 500,
					'value' => !empty($params['notificationinfo']['notification_value']) ? $params['notificationinfo']['notification_value'] : '',
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingdetailnotification

		function _form_settingdetailgateway($routerid=false,$formid=false) {
			global $applogin, $toolbars, $forms, $apptemplate, $appdb;

			if(!empty($routerid)&&!empty($formid)) {

				$post = $this->vars['post'];

				$params = array();

				$readonly = true;

				if(!empty($post['method'])&&($post['method']=='settingnew'||$post['method']=='settingedit')) {
					$readonly = false;
				}

				if(!empty($post['method'])&&($post['method']=='onrowselect'||$post['method']=='settingedit')) {
					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {
						if(!($result = $appdb->query("select * from tbl_gateway where gateway_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['gateway_id'])) {
							$params['gatewayinfo'] = $result['rows'][0];
						}
					}
				} else
				if(!empty($post['method'])&&$post['method']=='settingsave') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Gateway successfully saved!';

					$content = array();
					$content['gateway_desc'] = !empty($post['gateway_desc']) ? trim($post['gateway_desc']) : '';
					//$content['gateway_provider'] = !empty($post['gateway_provider']) ? trim($post['gateway_provider']) : '';
					$content['gateway_function'] = !empty($post['gateway_function']) ? trim($post['gateway_function']) : '';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						$retval['rowid'] = $post['rowid'];

						$content['gateway_updatestamp'] = 'now()';

						if(!($result = $appdb->update("tbl_gateway",$content,"gateway_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

					} else {

						if(!($result = $appdb->insert("tbl_gateway",$content,"gateway_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['gateway_id'])) {
							$retval['rowid'] = $result['returning'][0]['gateway_id'];
						}

					}

					if(!empty($retval['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_gatewaylist where gatewaylist_gatewayid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						if(!($result = $appdb->query("delete from tbl_gatewayprovider where gatewayprovider_gatewayid=".$retval['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['gatewaylist_seq'])&&is_array($post['gatewaylist_simname'])) {
						foreach($post['gatewaylist_seq'] as $k=>$v) {
							$content = array();
							$content['gatewaylist_gatewayid'] = $retval['rowid'];
							$content['gatewaylist_seq'] = !empty($post['gatewaylist_seq'][$k]) ? $post['gatewaylist_seq'][$k] : '';
							$content['gatewaylist_simname'] = !empty($post['gatewaylist_simname'][$k]) ? $post['gatewaylist_simname'][$k] : '';
							$content['gatewaylist_simnumber'] = getSimNumberByName($content['gatewaylist_simname']);
							$content['gatewaylist_failed'] = !empty($post['gatewaylist_failed'][$k]) ? 1 : 0;

							if(!($result = $appdb->insert("tbl_gatewaylist",$content,"gatewaylist_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					if(!empty($retval['rowid'])&&!empty($post['gateway_provider'])&&is_array($post['gateway_provider'])) {
						foreach($post['gateway_provider'] as $k=>$v) {
							$content = array();
							$content['gatewayprovider_gatewayid'] = $retval['rowid'];
							$content['gatewayprovider_provider'] = !empty($post['gateway_provider'][$k]) ? $post['gateway_provider'][$k] : '';

							if(!($result = $appdb->insert("tbl_gatewayprovider",$content,"gatewayprovider_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingclone') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Gateway successfully cloned!';

					if(!empty($post['rowid'])&&is_numeric($post['rowid'])&&$post['rowid']>0) {

						if(!($result = $appdb->query("select * from tbl_gateway where gateway_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['rows'][0]['gateway_id'])) {
							$content = $result['rows'][0];
							unset($content['gateway_id']);
							unset($content['gateway_createstamp']);
							unset($content['gateway_updatestamp']);
							$content['gateway_desc'] = $content['gateway_desc'] . '_clone_' . time();

							if(!($result = $appdb->insert("tbl_gateway",$content,"gateway_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!empty($result['returning'][0]['gateway_id'])) {
								$retval['rowid'] = $result['returning'][0]['gateway_id'];

								if(!($result = $appdb->query("select * from tbl_gatewaylist where gatewaylist_gatewayid=".$post['rowid']))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

								if(!empty($result['rows'][0]['gatewaylist_id'])) {
									foreach($result['rows'] as $k=>$content) {
										unset($content['gatewaylist_id']);
										unset($content['gatewaylist_createstamp']);
										unset($content['gatewaylist_updatestamp']);
										$content['gatewaylist_gatewayid'] = $retval['rowid'];

										if(!($result = $appdb->insert("tbl_gatewaylist",$content,"gatewaylist_id"))) {
											json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
											die;
										}

									}
								}

								if(!($result = $appdb->query("select * from tbl_gatewayprovider where gatewayprovider_gatewayid=".$post['rowid']))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}

								if(!empty($result['rows'][0]['gatewayprovider_id'])) {
									foreach($result['rows'] as $k=>$content) {
										unset($content['gatewayprovider_id']);
										unset($content['gatewayprovider_timestamp']);
										$content['gatewayprovider_gatewayid'] = $retval['rowid'];

										if(!($result = $appdb->insert("tbl_gatewayprovider",$content,"gatewayprovider_id"))) {
											json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
											die;
										}

									}
								}

							}

						}

					}

					json_encode_return($retval);
					die;
				} else
				if(!empty($post['method'])&&$post['method']=='settingdelete') {

					$retval = array();
					$retval['return_code'] = 'SUCCESS';
					$retval['return_message'] = 'Gateway successfully deleted!';

					if(!empty($post['rowids'])) {

						$rowids = explode(',', $post['rowids']);

						$arowid = array();

						for($i=0;$i<count($rowids);$i++) {
							$rowid = intval(trim($rowids[$i]));
							if(!empty($rowid)) {
								$arowid[] = $rowid;
							}
						}

						//pre(array('$arowid'=>$arowid));

						if(!empty($arowid)) {
							$rowids = implode(',', $arowid);

							if(!($result = $appdb->query("delete from tbl_gateway where gateway_id in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!($result = $appdb->query("delete from tbl_gatewaylist where gatewaylist_gatewayid in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							if(!($result = $appdb->query("delete from tbl_gatewayprovider where gatewayprovider_gatewayid in (".$rowids.")"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							json_encode_return($retval);
							die;
						}

					}

					if(!empty($post['rowid'])) {
						if(!($result = $appdb->query("delete from tbl_gateway where gateway_id=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						if(!($result = $appdb->query("delete from tbl_gatewaylist where gatewaylist_gatewayid=".$post['rowid']))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						if(!($result = $appdb->query("delete from tbl_gatewayprovider where gatewayprovider_gatewayid=".$post['rowid']))) {
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

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'DESCRIPTION',
					'name' => 'gateway_desc',
					'readonly' => $readonly,
					'required' => !$readonly,
					'inputWidth' => 500,
					'value' => !empty($params['gatewayinfo']['gateway_desc']) ? $params['gatewayinfo']['gateway_desc'] : '',
				);

				/*$opt = array();

				foreach($providers as $v) {
					$selected = false;

					if(!empty($params['gatewayinfo']['gateway_provider'])&&$params['gatewayinfo']['gateway_provider']==$v) {
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
					'name' => 'gateway_provider',
					'readonly' => true,
					'required' => !$readonly,
					'options' => $opt,
				);*/

				$myproviders = array();

				if(!($result = $appdb->query("select * from tbl_gatewayprovider where gatewayprovider_gatewayid=".$post['rowid']." order by gatewayprovider_id asc"))) {
					json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
					die;
				}
				//pre(array('$result'=>$result));

				if(!empty($result['rows'][0]['gatewayprovider_provider'])) {
					foreach($result['rows'] as $k=>$v) {
						$myproviders[] = $v['gatewayprovider_provider'];
					}
				}

				$providers = getProviders();

				$first = true;

				foreach($providers as $k=>$v) {

					$checked = false;

					if(in_array($v, $myproviders)) {
						$checked = true;
					}

					$block = array();

					if($first) {
						$block[] = array(
							'type' => 'label',
							'label' => 'PROVIDER',
						);
					} else {
						$block[] = array(
							'type' => 'label',
							'label' => '',
						);
					}

					$first = false;

					$block[] = array(
						'type' => 'newcolumn',
						'offset' => 0,
					);

					$block[] = array(
						'type' => 'checkbox',
						'label' => $v,
						'labelWidth' => 250,
						'name' => 'gateway_provider['.$k.']',
						'readonly' => $readonly,
						'checked' => $checked,
						'position' => 'label-right',
						'value' => $v,
					);

					$params['tbDetails'][] = array(
						'type' => 'block',
						'width' => 1000,
						'blockOffset' => 0,
						'offsetTop' => 5,
						'list' => $block,
					);

				}

				$params['tbDetails'][] = array(
					'type' => 'input',
					'label' => 'FUNCTION',
					'name' => 'gateway_function',
					'readonly' => true,
					'value' => 'SENDING',
				);

				$params['tbDetails'][] = array(
					'type' => 'container',
					'name' => 'gatewaylist_container',
					'inputWidth' => 600,
					'inputHeight' => 200,
				);

				$templatefile = $this->templatefile($routerid,$formid);

				if(file_exists($templatefile)) {
					return $this->_form_load_template($templatefile,$params);
				}
			}

			return false;

		} // _form_settingdetailgateway

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

					if($this->post['table']=='simcommand') {
						if(!($result = $appdb->query("select * from tbl_modemcommands order by modemcommands_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['modemcommands_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['modemcommands_id'],'data'=>array(0,$v['modemcommands_id'],$v['modemcommands_name'],$v['modemcommands_desc'],$v['modemcommands_category'],pgDate($v['modemcommands_createstamp']),pgDate($v['modemcommands_updatestamp'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='networkprefix') {
						if(!($result = $appdb->query("select * from tbl_network order by network_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['network_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['network_id'],'data'=>array(0,$v['network_id'],$v['network_number'],$v['network_name'],pgDate($v['network_timestamp']),pgDate($v['network_updatestamp'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='loadcommand') {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_type='loadcommand' order by smscommands_priority asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['smscommands_id'],'data'=>array(0,$v['smscommands_id'],$v['smscommands_priority'],htmlentities($v['smscommands_name']),htmlentities($v['smscommands_active'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='loadcommand2') {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_type='loadcommand' order by smscommands_priority asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['smscommands_id'],'data'=>array(0,$v['smscommands_id'],$v['smscommands_priority'],$v['smscommands_key0'],$v['smscommands_key1'],$v['smscommands_key2'],$v['smscommands_key3'],$v['smscommands_key4'],$v['smscommands_active']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='expressions') {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_type='expressions' order by smscommands_priority asc, smscommands_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								//$rows[] = array('id'=>$v['smscommands_id'],'data'=>array(0,$v['smscommands_id'],$v['smscommands_priority'],$v['smscommands_desc'],$v['smscommands_category'],$v['smscommands_key0'],$v['smscommands_key1'],$v['smscommands_key2'],$v['smscommands_key3'],$v['smscommands_key4'],$v['smscommands_active']));
								$rows[] = array('id'=>$v['smscommands_id'],'data'=>array(0,$v['smscommands_id'],$v['smscommands_priority'],$v['smscommands_desc'],$v['smscommands_category'],$v['smscommands_active']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='smserror') {
						if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_type='smserror' order by smscommands_priority asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['smscommands_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['smscommands_id'],'data'=>array(0,$v['smscommands_id'],$v['smscommands_priority'],$v['smscommands_key0'],$v['smscommands_key1'],$v['smscommands_key2'],$v['smscommands_key3'],$v['smscommands_key4'],$v['smscommands_active']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='provider') {
						if(!($result = $appdb->query("select * from tbl_provider order by provider_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['provider_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['provider_id'],'data'=>array(0,$v['provider_id'],$v['provider_name'],$v['provider_desc'],pgDate($v['provider_timestamp']),pgDate($v['provider_updatestamp'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='options') {
						if($applogin->isSystemAdministrator()) {
							if(!($result = $appdb->query("select * from tbl_options order by options_id asc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						} else {
							if(!($result = $appdb->query("select * from tbl_options where options_hidden=0 order by options_id asc"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['options_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['options_id'],'data'=>array(0,$v['options_id'],$v['options_name'],$v['options_type'],htmlentities($v['options_desc']),htmlentities($v['options_value'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='notification') {
						if(!($result = $appdb->query("select * from tbl_notification order by notification_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['notification_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {
								$rows[] = array('id'=>$v['notification_id'],'data'=>array(0,$v['notification_id'],$v['notification_name'],$v['notification_type'],htmlentities($v['notification_value'])));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='gateway') {
						if(!($result = $appdb->query("select * from tbl_gateway order by gateway_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}
						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['gateway_id'])) {
							$rows = array();

							foreach($result['rows'] as $k=>$v) {

								$myproviders = array();

								if(!($presult = $appdb->query("select * from tbl_gatewayprovider where gatewayprovider_gatewayid=".$v['gateway_id']." order by gatewayprovider_id asc"))) {
									json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
									die;
								}
								//pre(array('$result'=>$result));

								if(!empty($presult['rows'][0]['gatewayprovider_provider'])) {
									foreach($presult['rows'] as $o) {
										$myproviders[] = $o['gatewayprovider_provider'];
									}
								}

								$rows[] = array('id'=>$v['gateway_id'],'data'=>array(0,$v['gateway_id'],$v['gateway_desc'],implode(',',$myproviders),$v['gateway_function']));
							}

							$retval = array('rows'=>$rows);
						}

					} else
					if($this->post['table']=='gatewaylist') {

						$ctr = 1;

						$seq = 0;

						$asim = getAllSims(3,true);

						if(!($result = $appdb->query("select * from tbl_gatewaylist where gatewaylist_gatewayid=".$this->post['rowid']." order by gatewaylist_seq asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						//pre(array('$asim'=>$asim));

						//pre(array('$result'=>$result));

						if(!empty($result['rows'][0]['gatewaylist_id'])) {

							$optflg = false;

							foreach($result['rows'] as $k=>$v) {
								if(!empty($asim[$v['gatewaylist_simnumber']])) {
									$seq = intval($v['gatewaylist_seq']);

									$row = array('id'=>$ctr,'data'=>array($seq,getSimNameByNumber($v['gatewaylist_simnumber']),$v['gatewaylist_simnumber'],$v['gatewaylist_failed']));

									if(!$optflg) {
										$opt = array(array('text'=>'','value'=>''));

										foreach($asim as $k=>$x) {
											$opt[] = array('text'=>$x['simcard_name'],'value'=>$x['simcard_name']);
										}

										$row['options'] = array('options'=>$opt);
										$optflg = true;
									}

									$rows[] = $row;

									$ctr++;
								}
							}
						}

						$seq++;

						$to = ($seq+20);

						if(!empty($asim)) {
							for($i=$seq;$seq<$to;$seq++) {
								$row = array('id'=>$ctr,'data'=>array($seq,''));

								$opt = array(array('text'=>'','value'=>''));

								foreach($asim as $k=>$x) {
									$opt[] = array('text'=>$x['simcard_name'],'value'=>$x['simcard_name']);
								}

								$row['options'] = array('options'=>$opt);

								$rows[] = $row;

								$ctr++;
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

	$appappsetting = new APP_app_setting;
}

# eof modules/app.user
