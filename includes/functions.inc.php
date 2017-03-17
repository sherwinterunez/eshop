<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* Misc functions include file
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

/* INCLUDES_START */

function pre($data) {
	echo "\n\n<pre>\n\n";
	print_r($data);
	echo "\n\n</pre>\n\n";
}

function prebuf($data) {
	ob_start();
	pre($data);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

function printrbuf($data) {
	ob_start();
	print_r($data);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

function abs_path() {
	return ABS_PATH;
}

function home_dir() {
	return abs_path();
}

function includes_path() {
	return abs_path() . 'includes/';
}

function templates_path() {
	return abs_path() . 'templates/';
}

function modules_path() {
	return abs_path() . 'modules/';
}

function host() {
	if(!empty($_SERVER['HTTP_HOST'])) {
		return $_SERVER['HTTP_HOST'];
	}

	return $_SERVER['SERVER_NAME'];
}

function basepath() {
	return BASE_PATH;
}

function gentime() {
	$mtime      = explode( ' ', microtime() );
	return $mtime[1] + $mtime[0];
}

function timer_start() {
	global $app_time_start;

	$mtime      = explode( ' ', microtime() );
	$app_time_start = $mtime[1] + $mtime[0];
	return true;
}

function timer_stop() {
	global $app_time_start, $app_total_time;

	$mtime      = explode( ' ', microtime() );
	$time_end   = $mtime[1] + $mtime[0];
	$app_total_time = $time_end - $app_time_start;
	return $app_total_time;
}

function is_var_numeric($var=false) {
	if(empty($var)&&$var===0) return true;
	if(!empty($var)) return is_numeric($var);
	return false;
}

function setSetting($name=false,$val=false) {
	return setOption($name,$val,'SETTING',true);
}

function setOption($name=false,$val=false,$type='SETTING',$hidden=false) {
	global $appdb;

	if(empty($name)) {
		return false;
	}

	if(!($ret = $appdb->query("select * from tbl_options where options_name='$name'"))) {
		return false;
	}

	$content = array('options_name'=>$name,'options_value'=>$val,'options_type'=>$type);

	if($hidden) {
		$content['options_hidden'] = 1;
	}

	if(!empty($ret['rows'][0]['options_name'])) {
		$appdb->update('tbl_options',$content,'options_id='.$ret['rows'][0]['options_id']);
		return getOption($name,false,true);
	} else {
		if(!($result = $appdb->insert('tbl_options',$content,'options_id'))) {
			return false;
		}

		if(!empty($result['returning'][0]['options_id'])) {

			return getOption($name,false,true);
		}
	}

	return false;
}

function getOption($option_name=false,$default_val=false,$force=false) {
	global $appdb, $optionsArr;

	if(empty($option_name)) {
		return false;
	}

	if($force) $optionsArr = array();

	if(empty($optionsArr)) {
		if(!($ret = $appdb->query("select * from tbl_options"))) {
			return $default_val;
		}

		if(!empty($ret['rows'][0]['options_name'])) {
			$optionsArr = array();
			foreach($ret['rows'] as $k=>$v) {
				$optionsArr[$v['options_name']] = $v;
			}

			//print_r($optionsArr);
		}
	}

	if(!empty($optionsArr[$option_name]['options_id'])) {
		return $optionsArr[$option_name]['options_value'];
	}

	/*$ret = $appdb->query("select * from tbl_options where options_name='$option_name'");

	if(!empty($ret['rows'][0]['options_name'])) {
		return $ret['rows'][0]['options_value'];
	}*/

	return $default_val;
}

function getNotification($notification_name=false,$default_val=false,$force=false) {
	global $appdb, $notificationArr;

	if(empty($notification_name)) {
		return false;
	}

	if($force) $notificationArr = array();

	if(empty($notificationArr)) {
		if(!($ret = $appdb->query("select * from tbl_notification"))) {
			return $default_val;
		}

		if(!empty($ret['rows'][0]['notification_name'])) {
			$notificationArr = array();
			foreach($ret['rows'] as $k=>$v) {
				$notificationArr[$v['notification_name']] = $v;
			}

			//print_r($notificationArr);
		}
	}

	if(!empty($notificationArr[$notification_name]['notification_id'])) {
		return $notificationArr[$notification_name]['notification_value'];
	}

	return $default_val;
}

function getNotificationByID($notification_id=false,$default_val=false,$force=false) {
	global $appdb, $notificationArrByID;

	if(empty($notification_id)) {
		return false;
	}

	if($force) $notificationArrByID = array();

	if(empty($notificationArrByID)) {
		if(!($ret = $appdb->query("select * from tbl_notification"))) {
			return $default_val;
		}

		if(!empty($ret['rows'][0]['notification_id'])) {
			$notificationArrByID = array();
			foreach($ret['rows'] as $k=>$v) {
				$notificationArrByID[$v['notification_id']] = $v;
			}

			//print_r($notificationArrByID);
		}
	}

	if(!empty($notificationArrByID[$notification_id]['notification_id'])) {
		return $notificationArrByID[$notification_id]['notification_value'];
	}

	return $default_val;
}

function getAllNotifications() {
	global $appdb;

	if(!($ret = $appdb->query("select * from tbl_notification"))) {
		return $false;
	}

	if(!empty($ret['rows'][0]['notification_id'])) {
		return $ret['rows'];
	}

	return false;
}

function getOptionsWithType($type=false) {
	global $appdb;

	if(!empty($type)) {
	} else return false;

	if(!($ret = $appdb->query("select * from tbl_options where options_type='$type'"))) {
		return false;
	}

	if(!empty($ret['rows'][0]['options_id'])) {
		//print_r($ret['rows']);
		return $ret['rows'];
	}

	return false;
}

function getOptionValuesWithType($type=false) {
	global $appdb;

	if(!empty($type)) {
	} else return false;

	if(!($ret = $appdb->query("select * from tbl_options where options_type='$type'"))) {
		return false;
	}

	if(!empty($ret['rows'][0]['options_id'])) {
		//print_r($ret['rows']);
		//return $ret['rows'];

		$retval = array();

		foreach($ret['rows'] as $k=>$v) {
			$retval[] = $v['options_value'];
		}

		return $retval;
	}

	return false;

}

function getOptionNamesWithType($type=false) {
	global $appdb;

	if(!empty($type)) {
	} else return false;

	if(is_array($type)&&count($type)>0) {

		foreach($type as $k=>$v) {
			$type[$k] = "'".strtoupper(trim($v))."'";
		}

		$stype = implode(',', $type);

		$sql = "select * from tbl_options where options_type in ($stype) order by options_name";

		//pre(array('$sql'=>$sql));

		if(!($ret = $appdb->query($sql))) {
			return false;
		}

	} else {

		if(!($ret = $appdb->query("select * from tbl_options where options_type='$type' order by options_name"))) {
			return false;
		}

	}


	if(!empty($ret['rows'][0]['options_id'])) {
		//print_r($ret['rows']);
		//return $ret['rows'];

		$retval = array();

		foreach($ret['rows'] as $k=>$v) {
			$retval[] = $v['options_name'];
		}

		return $retval;
	}

	return false;

}

function getNotificationNamesWithType($type=false) {
	global $appdb;

	if(!empty($type)) {
	} else return false;

	if(is_array($type)&&count($type)>0) {

		foreach($type as $k=>$v) {
			$type[$k] = "'".strtoupper(trim($v))."'";
		}

		$stype = implode(',', $type);

		$sql = "select * from tbl_notification where notification_type in ($stype) order by notification_name";

		//pre(array('$sql'=>$sql));

		if(!($ret = $appdb->query($sql))) {
			return false;
		}

	} else {

		if(!($ret = $appdb->query("select * from tbl_notification where notification_type='$type' order by notification_name"))) {
			return false;
		}

	}


	if(!empty($ret['rows'][0]['notification_id'])) {
		//print_r($ret['rows']);
		//return $ret['rows'];

		$retval = array();

		foreach($ret['rows'] as $k=>$v) {
			$retval[] = $v['notification_name'];
		}

		return $retval;
	}

	return false;

}

function getAllOptionNames() {
	global $appdb;

	if(!($ret = $appdb->query("select * from tbl_options order by options_type asc, options_name asc"))) {
		return false;
	}

	if(!empty($ret['rows'][0]['options_id'])) {
		//print_r($ret['rows']);
		//return $ret['rows'];

		$retval = array();

		foreach($ret['rows'] as $k=>$v) {
			$retval[] = $v['options_name'];
		}

		return $retval;
	}

	return false;

}

function update_option($option_name=false,$option_val=false) {
	global $appdb;

	if(empty($option_name)) {
		return false;
	}

	$ret = $appdb->query("select id from tbl_options where option_name='$option_name'");

	if(empty($ret['affected'])) {
		$sql = sprintf("insert into tbl_options (option_name,option_value,datestamp) values ('%s','%s','now()')",pg_escape_string($option_name),pg_escape_string($option_val));
		$appdb->query($sql);
		return true;
	} else {
		$sql = sprintf("update tbl_options set option_value='%s',datestamp=now() where option_name='%s'",pg_escape_string($option_val),pg_escape_string($option_name));
		$appdb->query($sql);
		return true;
	}

	return false;
}

function log_event($event=false) {
	global $appdb;

	$save = array();

	if(!empty($_SESSION['login_user']['userid'])&&!empty($_SESSION['login_user']['username'])) {
		$save['user_id'] = $_SESSION['login_user']['userid'];
		$save['user_name'] = $_SESSION['login_user']['username'];
	}

	if(empty($event)) {
		$event = 'UNKNOWN EVENT';
	}

	$save['event'] = $event;

	if(!($ret=$appdb->insert('tbl_events', $save, 'id'))) {
		return false;
	}

	return true;
}

function getTimeFromServer() {
	global $appdb;

	if(!empty($appdb)&&$appdb->ready()) {
		//if(!($result = $appdb->query('select extract(epoch from now()::timestamp without time zone) as time'))) {
		if(!($result = $appdb->query('select extract(epoch from now()) as time'))) {
		} else {
			if(!empty($result['rows'][0]['time'])) {
				return intval($result['rows'][0]['time']);
			}
		}
	}
	json_error_return(1); // 1 => 'Error in SQL execution.'
}

function debug_string_backtrace() {
	ob_start();
	debug_print_backtrace();
	$trace = ob_get_contents();
	ob_end_clean();

	// Remove first item from backtrace as it's this function which
	// is redundant.
	$trace = preg_replace ('/^#0\s+' . __FUNCTION__ . "[^\n]*\n/", '', $trace, 1);

	// Renumber backtrace items.
	//$trace = preg_replace ('/^#(\d+)/me', '\'#\' . ($1 - 1)', $trace);

	return $trace;
}

function json_error_return($vars=false,$msg=false) {
	global $error_codes, $appdb;

	header('Content-type: application/json');

	if($vars!==false) {
	} else {
		die(json_encode(array('error_code'=>65535,'error_message'=>'Unknown error has occured.','backtrace'=>debug_string_backtrace(),'dberrors'=>$appdb->lasterror,'dbqueries'=>$appdb->queries)));
	}

	if(intval($vars)>0&&!empty($error_codes[intval($vars)])) {
		die(json_encode(array('error_code'=>intval($vars),'error_message'=>$error_codes[intval($vars)],'backtrace'=>debug_string_backtrace(),'dberrors'=>$appdb->lasterror,'dbqueries'=>$appdb->queries)));
	}

	if(intval($vars)===0) {
		die(json_encode(array('code'=>0,'message'=>!empty($msg)?$msg:'Success!','backtrace'=>debug_string_backtrace(),'dberrors'=>$appdb->lasterror,'dbqueries'=>$appdb->queries)));
	}

	//pre(array('$vars'=>$vars));

	//if(!empty($error_codes[$errorcode])) {

	//}
}

function json_return($vars=array(),$noerrorcode=false) {
	header('Content-type: application/json');

	if(!$noerrorcode&&!isset($vars['error_code'])) {
		$vars['error_code']=0;
	}

	die(json_encode($vars));
}

function json_encode_return($vars,$opt=0) {
	die(json_encode($vars,$opt));
}

function json_return_error($code=254,$vars=array()) {
	global $error_codes, $appdb;

	$appdb->rollback();

	$vars['db'] = $appdb->queries;

	$ret = array_merge($vars,array('error_code'=>$code,'error_message'=>$error_codes[$code]));

	if(!empty($line)) {
		$ret['error_line'] = $line;
	}

	if(!empty($file)) {
		$ret['error_file'] = $file;
	}

	if(BACKTRACE) {
		$dback = debug_backtrace();
		$ret['backtrace'] = $dback[0];
	}

	json_return($ret);
}

function Array2XML($arr=array()) {
	if(!empty($arr)&&is_array($arr)) {
	} else return false;

	if(sizeof($arr)>1) {
		$arr = array('root'=>array('@value'=>$arr));
	}

	$output = '';

	foreach($arr as $k=>$v) {
		$output .= '<'.$k;

		if(!empty($v)&&is_array($v)) {
			if(!empty($v['@attribute'])&&is_array($v['@attribute'])) {
				foreach($v['@attribute'] as $h=>$j) {
					$output .= ' '.trim($h).'="'.trim($j).'"';
				}
			}
		}

		$output .= '>';

		if(!empty($v)&&is_array($v)) {
			if(!empty($v['@value'])&&is_array($v['@value'])) {
				foreach($v['@value'] as $h=>$j) {
					if(!empty($j)&&is_array($j)) {
						$output .= Array2XML($j);
					}
				}
			} else
			if(!empty($v['@value'])) {
				$output .= $v['@value'];
			}
		}

		$output .= '</'.$k.'>';
	}

	return !empty($output) ? $output : false;
}

function array2xml_return($arr) {
	header('Content-type: text/xml');

	$output = Array2XML($arr);

	die($output);
}

function _t($data='') {
	global $applanguage;

	return $applanguage->translate($data);
}

function is_blank($value) {
	return empty($value) && !is_numeric($value);
}

function xmlobj2array($obj, $level=0) {

	$items = array();

	if(!is_object($obj)) return $items;

	$child = (array)$obj;

	if(sizeof($child)>1) {
		foreach($child as $aa=>$bb) {
			if(is_array($bb)) {
				foreach($bb as $ee=>$ff) {
					if(!is_object($ff)) {
						$items[$aa][$ee] = $ff;
					} else
					if(get_class($ff)=='SimpleXMLElement') {
						$items[$aa][$ee] = xmlobj2array($ff,$level+1);
					}
				}
			} else
			if(!is_object($bb)) {
				$items[$aa] = $bb;
			} else
			if(get_class($bb)=='SimpleXMLElement') {
				$items[$aa] = xmlobj2array($bb,$level+1);
			}
		}
	} else
	if(sizeof($child)>0) {
		foreach($child as $aa=>$bb) {
			if(!is_array($bb)&&!is_object($bb)) {
				$items[$aa] = $bb;
			} else
			if(is_object($bb)) {
				$items[$aa] = xmlobj2array($bb,$level+1);
			} else {
				foreach($bb as $cc=>$dd) {
					if(!is_object($dd)) {
						$items[$aa][$cc] = $dd;
					} else
					if(get_class($dd)=='SimpleXMLElement') {
						$items[$aa][$cc] = xmlobj2array($dd,$level+1);
					}
				}
			}
		}
	}

	return $items;

} // xmlobj2array

function header_json() {
	header('Content-type: application/json');
}

function header_xml() {
	header('Content-type: text/xml');
}

function substrNumChar($str,$numchar=0) {
	if(!empty($str)) {
	} else return false;

	if($numchar==0) return $str;

	if(!is_numeric($numchar)) return false;

	if(strlen($str)>$numchar) {
		return substr($str,0,$numchar);
	}

	return $str;
}

//-----------------------------------------------------------------------------------------
//this line was added on JULY 18, 2013 - 2:53pm
function cleans($inputs)
{
 $inputs=@trim($inputs);
 $inputs=htmlentities($inputs);
 return $inputs;
}
//this line was added for sanitization added by : jeE :JULY 18, 2013 - 2:53pm
function filedownload($filename)
{
	// Test to ensure that the file exists.
        if(!file_exists($filename)) die("I'm sorry, the file doesn't seem to exist.");
    // Send file headers
        header("Content-type: text/plain");
        header("Content-Disposition: attachment;filename=".$filename);
        // Send the file contents.
        readfile($filename);
}
//END

function calculateAge($birthday) {

	$stime = (time() - strtotime($birthday));

	return floor($stime / 31556926);
}

function check_utf8($string) {
	//return iconv("UTF-8", "ISO-8859-1//IGNORE", $string);

	if(function_exists('iconv')) {
		return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $string);
	}

	return $string;
}

function pgFixString($string) {
	return pg_escape_string(trim(check_utf8($string)));
}

// windows friendly function
/*function date2timestamp($date, $format='m/d/Y', $timezone='America/Los_Angeles') {
	$old_timezone = date_default_timezone_get();
	date_default_timezone_set($timezone);
	$date = date_parse_from_format($format, $date);
	$day_start=mktime(0,0,0,$date['month'],$date['day'],($date['year']));
	//$day_end=$day_start+(60*60*24);
	date_default_timezone_set($old_timezone);
	//return array('day_start'=>$day_start, 'day_end'=>$day_end);

	return $day_start;
}*/

function date2timestamp($date, $format='m/d/Y', $timezone='Asia/Manila') {
	$old_timezone = date_default_timezone_get();
	date_default_timezone_set($timezone);
	$date = date_parse_from_format($format, $date);

	$month = !empty($date['month']) ? $date['month'] : 0;
	$day = !empty($date['day']) ? $date['day'] : 0;
	$year = !empty($date['year']) ? $date['year'] : 0;

	$hour = !empty($date['hour']) ? $date['hour'] : 0;
	$minute = !empty($date['minute']) ? $date['minute'] : 0;
	$second = !empty($date['second']) ? $date['second'] : 0;

	//echo "<pre>";
	//print_r($date);
	//echo "</pre>";

	$day_start=mktime($hour,$minute,$second,$month,$day,$year);
	//$day_end=$day_start+(60*60*24);
	date_default_timezone_set($old_timezone);
	//return array('day_start'=>$day_start, 'day_end'=>$day_end);

	return $day_start;
}

/* linux only function
function date2timestamp($date, $format='%m/%d/%Y', $timezone='America/Los_Angeles') {
	$old_timezone = date_default_timezone_get();
	date_default_timezone_set($timezone);
	$date=strptime($date,$format);
	$day_start=mktime(0,0,0,++$date['tm_mon'],$date['tm_mday'],($date['tm_year']+1900));
	//$day_end=$day_start+(60*60*24);
	date_default_timezone_set($old_timezone);
	//return array('day_start'=>$day_start, 'day_end'=>$day_end);

	return $day_start;
}*/

function alphanumonly($str) {
	if(empty($str)) return false;

	return preg_replace("/[^a-zA-Z0-9]/", "", $str);
}

function clearcrlf($str) {
	$t = explode("\n", $str);
	$tstr = '';

	foreach($t as $k) {
		$tstr .= trim($k)." ";
	}

	return trim($tstr);
}

function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    //return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');

    return array(
        'days'=>intval($dtF->diff($dtT)->format('%a')),
        'hours'=>intval($dtF->diff($dtT)->format('%h')),
        'minutes'=>intval($dtF->diff($dtT)->format('%i')),
        'seconds'=>intval($dtF->diff($dtT)->format('%s')),
    );
}

function daysToSeconds($days=0) {
    return (60*60*24*intval($days));
}

function createRandomFile($path='/tmp',$prefix='',$postfix='.tmp') {
	$ctr=0;
	while(true) {
		$file = $path.'/'.$prefix.sha1(sha1((time() * rand(1000,9999))) . sha1((time() * rand(1000,9999)))) . $postfix;
		if(createFile($file)) {
			return $file;
		}

		if(++$ctr>100) break;
	}

	return false;
}

function createFile($file=false, $delete=false) {

	if(!empty($file)) {
	} else return false;

	if($delete) {
		@unlink($file);
	}

	if(!file_exists($file)) {
		if($hf=@fopen($file,'x')) {
			/*pre(array('createFile'=>$hf,'$file'=>$file));

			$dir    = '/tmp';
			$files1 = scandir($dir);
			$files2 = scandir($dir, 1);

			print_r($files1);
			print_r($files2);*/

			fclose($hf);
			return true;
		}
	}

	return false;
}

function saveToFile($file=false, $content=false) {

	if(!empty($file)&&!empty($content)&&is_readable($file)&&is_writable($file)) {
	} else return false;

	//pre(array('saveToFile'=>$file));

	if($hf=fopen($file,'w')) {

		$ret=fwrite($hf,$content."\n");

		fclose($hf);

		//pre(array('readFromFile'=>readFromFile($file)));

		return $ret;

	}

	return false;
}

function readFromFile($file=false) {

	if(!empty($file)&&file_exists($file)&&is_readable($file)&&($hf=fopen($file,'r'))) {
	} else return false;

	$content = fread($hf,filesize($file));
	fclose($hf);

	if(!empty($content)) {
		return $content;
	}

	return false;
}

function clearDoubleSpace($str=false) {
	if(!empty($str)) {
		$str = trim($str);

		do {
			if(preg_match('/(\s\s)/si',$str,$match)&&isset($match[1])) {
				//pre(array('$match'=>$match));
				$str = str_replace($match[1],' ',$str);
				//echo '['.$str.'].';
			} else {
				return $str;
				//break;
			}
		} while(1);
	}
	return false;
}

function clearcrlf2($str=false) {
	if(!empty($str)) {
		$str = trim($str);

		$ok = false;

		do {
			if(preg_match('/(\r)/',$str,$match)&&isset($match[1])) {
				$str = str_replace($match[1],'',$str);
			} else {
				//return $str;
				break;
			}
		} while(1);

		do {
			if(preg_match('/(\n)/',$str,$match)&&isset($match[1])) {
				$str = str_replace($match[1],'',$str);
			} else {
				return $str;
				//break;
			}
		} while(1);

	}
	return false;
}

function toFloat($num=false,$round=0) {
	if(!empty($num)) {
		$num = str_replace(',','',$num);

		$num = clearDoubleSpace($num);

		$num = clearcrlf2($num);

		$num = floatval($num);

		if(!empty($round)) {
			$num = round($num,$round);
		}

		return $num;
	}
	return 0;
}

function log_notice($str=false) {
	if(!empty($str)) {
		return trigger_error(prebuf($str));
	}

	return false;
}

timer_start();

/* INCLUDES_END */


#eof ./includes/functions/index.php
