<?php
/*
* 
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* App Module
*
* Date: November 13, 2015
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

if(!class_exists('APP_App')) {

	class APP_App extends APP_Base {
	
		var $pathid = 'app';
		var $desc = 'App';
		var $post = false;
		var $vars = false;
		
		var $cls_ajax = false;

		var $usermod = false;
	
		function __construct() {
			parent::__construct();
		}
		
		function __destruct() {
			parent::__destruct();
		}
		
		function modulespath() {
			return str_replace(basename(__FILE__),'',__FILE__);
		}

		function add_css() {
			global $apptemplate;
		}

		function add_script() {
			global $apptemplate;

			$apptemplate->add_script('/'.$this->pathid.'/js/');
		}

		function add_rules() {
			global $appaccess;
		}

		function add_route() {
			global $approuter;
		}

		function js($vars) {
			require_once('app.mod.inc.js');				
		}

		function render($vars) {
			global $applogin, $apptemplate, $appform, $current_page;

			if(!$applogin->is_loggedin()) {
				redirect301('/'.$applogin->pathid.'/');
			}
			
			$this->check_url();

			$apptemplate->header($this->desc.' | '.APP_NAME);

			//$apptemplate->page('topnavbar');
	
			//$apptemplate->page('topnav');
	
			//$apptemplate->page('topmenu');

			//$apptemplate->page('workarea');

			//$apptemplate->page('app');

			$apptemplate->footer();
			
		} // render

	} // class APP_App

	$appapp = new APP_App;
}

# eof modules/app