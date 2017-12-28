<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Date Created: February 23, 2011
*
* Description:
*
* Application entry point.
*
*/

//define('ANNOUNCE', true);

error_reporting(E_ALL);

ini_set("max_execution_time", 300);

define('APPLICATION_RUNNING', true);

define('ABS_PATH', dirname(__FILE__) . '/');

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

//define('INCLUDE_PATH', ABS_PATH . 'includes/');

require_once(ABS_PATH.'includes/index.php');
//require_once(ABS_PATH.'modules/index.php');

/*require_once(INCLUDE_PATH.'config.inc.php');
require_once(INCLUDE_PATH.'miscfunctions.inc.php');
require_once(INCLUDE_PATH.'functions.inc.php');
require_once(INCLUDE_PATH.'errors.inc.php');
require_once(INCLUDE_PATH.'error.inc.php');
require_once(INCLUDE_PATH.'db.inc.php');
require_once(INCLUDE_PATH.'pdu.inc.php');
require_once(INCLUDE_PATH.'pdufactory.inc.php');
require_once(INCLUDE_PATH.'utf8.inc.php');
require_once(INCLUDE_PATH.'sms.inc.php');
require_once(INCLUDE_PATH.'userfuncs.inc.php');*/

date_default_timezone_set('Asia/Manila');

/*$mno = '+639287710253';

$mno = '214';

$mno = '09493621618';

$regx = '(\d+)(\d{3})(\d{7})$';

if(preg_match('#'.$regx.'#',$mno,$matches)) {
	print_r(array('$mno'=>$mno,'$matches'=>$matches));
}*/

//////////////////////////////////////////

/*$str = '09-May 19:44: You are about to Pasaload P10 to 09493621255. Reply YES to confirm or NO to cancel to 808 w/in 15mins. P1/Pasa Txn.Ref:290474774655';

//$str = '09-May 19:44: You are about to Pasaload P10 to +639493621255. Reply YES to confirm or NO to cancel to 808 w/in 15mins. P1/Pasa Txn.Ref:290474774655';

//$regx = '(You\s+are\s+about\s+to\s+Pasaload)(\s+)(P)(\d+)(\s+to\s+)(\+\d+|\d+)(.+)(Ref\:)(\d+)';

//$regx = '(Pasaload)(\s+)(P)(\d+)(\s+to\s+)(\+\d+|\d+)(.+)(Ref\:)(\d+)';

//$regx = '(Pasaload)(.+?)(\d+)(.+?)(\+\d+|\d+)(.+?)(Ref\:)(\d+)';

//$regx = '(Pasaload)(.+?)(\d+)(.+?)(\+\d+\d{3}\d{7}|\d+\d{3}\d{7})(.+?)(Ref\:)(\d+)';

//$regx = '(Pasaload)(.+?)(\d+)(.+?)(\+\d+|\d+)(.+?)(Ref\:)(\d+)';

$regx = '(\+\d+\d{3}\d{7}|\d+\d{3}\d{7})(.+?)(Ref\:)(\d+)';

if(preg_match('#'.$regx.'#si',$str,$matches)) {
	print_r(array('$str'=>$str,'$regx'=>$regx,'$matches'=>$matches));
}*/

//////////////////////////////////////////

/*$str = 'eshop      rl      talk100      09287710253';

do {
	$str = str_replace('  ', ' ', trim($str));
} while(preg_match('#\s\s#si', $str));

$keys = explode(' ', $str);

print_r(array('$str'=>$str,'$keys'=>$keys));

*/

/*$str = array();

$str[] = '27May 1135: 09397599095 has loaded LOAD 5 (P4.77) to 09493621618. New Load Wallet Balance:P495.23. Ref:071058379805';
$str[] = '27-May 17:47:639397599095 has loaded BIG BYTES 30 to 09493621618. New Load Wallet Balance:P466.56. Ref:800008270828';
$str[] = '27-May 18:09: 639397599095 has loaded SMARTLoad (P11.47) to 09493621618. New Load Wallet Balance: P455.09. Ref:800008272452';
$str[] = '1/2 14-Jun 19:37:639397599095 has loaded SMARTLoad All Text 10 (P9.55) to 09493621618. Your new Load Wallet Balance is P216.87.';
$str[] = '2/2 Maari ring ibenta ang Big Bytes 50 w/ 700 MB valid for 3 days! Text BIG50 to 2477. Ref:800009252120';

foreach($str as $v) {
	if(preg_match('/(\d+\d{3}\d{7}).+?loaded(.+?)to(.+?)(\d+\d{3}\d{7}).+?balance.+?(\d+\.\d+).+?ref.+?(\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

/*$str = array();
$str[] = 'QLOAD RL TALK100 09493621618';
$str[] = 'QLOAT RL 5 09328747492';
$str[] = 'ALOAD RL 10 09243481942';
$str[] = 'DLOAD RL 15 09172342349';

foreach($str as $v) {
	if(preg_match('/(.+?)\s+(TALK100|5|10|15)\s+(0\d{3}\d{7})/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

/*
$str =  array();
$str[] = '1/2 14-Jun 19:37:639397599095 has loaded SMARTLoad All Text 10 (P9234.35) to 09493621618. Your new Load Wallet Balance is P216.00.';
$str[] = '2/2 Maari ring ibenta ang Big Bytes 50 w/ 700 MB valid for 3 days! Text BIG50 to 2477. Ref:800009252120';
$str[] = '08Jun 0202:09397599095 has loaded 6.00 (P5.73) to 09493621618. New Load Wallet Balance:P121.92. Ref:071060830291';

foreach($str as $v) {
	if(preg_match('/\d+(\d{10})\s+has\s+loaded/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/has\s+loaded\s+(.+?)\s+\(/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/has\s+loaded.+?\(.+?([0-9\,]+\.\d+|[0-9\,]+|\d+)\)\s+to/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/\)\s+to\s+\d+(\d{10})/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/Wallet\s+Balance.+?P(\d+\.\d+|\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/Ref.+?(\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}

*/

/*$str = array();
$str[] = '18Aug 09:18: 09397599095 Load Wallet Balance: P641.30. Ref:004919718730';
$str[] = '18Aug 10:16: 09397599095 Load Wallet Balance: P641.30. Ref:003502788573';

foreach($str as $v) {
	if(preg_match('/\d+(\d{10})\s+Load\s+Wallet\s+/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/Balance.+?.+?([0-9\,]+\.\d+|[0-9\,]+|\d+).+?\s+/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/Ref.+?(\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

//$str = array();
//$str[] = '04Jul 16:16: P1000.00 is loaded to Load Wallet of 09397599095 from OXFORD DISTRIBUTION 639397609523.New Balance:P1185.42 Ref:860596120557';
//$str[] = '08Jun 20:46: P200.00 is loaded to Load Wallet of 09397599095 from ATorefranca by Pacifictel 639206495557.New Balance:P321.92 Ref:810367979450';
//$str[] = '27May 10:12: P500.00 is loaded to Load Wallet of 09397599095 from ATorefranca by Pacifictel 639206495557.New Balance:P500.00 Ref:820355792503';

/*foreach($str as $v) {
	//if(preg_match('/.+?\s+P([0-9\,]+\.\d+|[0-9\,]+|\d+).+?\s+is\s+loaded/si',$v,$matches)) {
	if(preg_match('/.+?\s+P([^\s]+)\s+is\s+loaded/si',$v,$matches)) { // $SMARTRETAILLOAD_AMOUNT_1
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/.+?Load\s+Wallet\s+of\s+\d+(\d{10})\s+/si',$v,$matches)) { // $SMARTRETAILLOAD_SIMCARD_1
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/from\s+(.+?\s+\d+\d{10})\..+?/si',$v,$matches)) { // $SMARTRETAILLOAD_DISTRIBUTOR_1
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/New\s+Balance\:.+?([0-9\,]+\.\d+|[0-9\,]+|\d+)\s+/si',$v,$matches)) { // $SMARTRETAILLOAD_BALANCE_1
		print_r(array('$matches'=>$matches));
	}
	if(preg_match('/Ref\:.+?(\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

//foreach($str as $v) {
	//if(preg_match('/.+?\s+P([^\s]+)\s+is\s+loaded.+?Load\s+Wallet\s+of\s+\d+(\d{10})\s+from\s+(.+?\s+\d+\d{10})\..+?New\s+Balance\:.+?([0-9\,]+\.\d+|[0-9\,]+|\d+)\s+Ref\:(\d+)/si',$v,$matches)) {
//	if(preg_match('/.+?\s+P([^\s]+)\s+is\s+loaded.+?Load\s+Wallet\s+of\s+\d+(\d{10})\s+from\s+(.+?\s+\d+\d{10}).+?New\s+Balance\:.+?([0-9\,]+\.\d+|[0-9\,]+|\d+)\s+Ref\:(\d+)/si',$v,$matches)) {
//		print_r(array('$matches'=>$matches));
//	}
//}

/*$str = array();
$str[] = "19Aug11:16 AM
LOAD BAL: P0.00
Unli Viber Exp: 19Aug 11:59PM";

foreach($str as $v) {
	if(preg_match('/.+?LOAD\s+BAL\:\s+P([0-9\,]+\.\d+|[0-9\,]+|\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}
*/


/*$str = array();
$str[] = 'You have P1.38 in your AutoLoadMAX account. Trace No: 30482788 11/25/2016 03:47PM.';

foreach($str as $v) {
	if(preg_match('/.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?AutoLoadMAX.+?Trace.+?(?<REF>\d+)\s+(?<DATETIME>.+?)\./si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/



/*$str = array();
$str[] = 'The credit in your account is 200 Peso.';

foreach($str as $v) {
	if(preg_match('/credit.+?account.+?(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+)\s+Peso\./si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/


/*$str = array();
$str[] = 5;
$str[] = 50;
$str[] = 500;

foreach($str as $v) {
	if(preg_match('/([1-9]\d{3,}|[1-9]\d{2}|[5-9]\d{1})/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

/*$str = array();
$str[] = 'eshop rl smart 09493621618 f1';
//$str[] = 50;
//$str[] = 500;

foreach($str as $v) {
	if(preg_match('/^ESHOP\s+RL\s+(TALK100|AT10|AT12|5|3|REG60|SMART|GLOBE|SUN|AT20|AT30|AT50|BIGCALL100|BIGSURF80|BIGTXT50|BIGTXT100|UCT25|UCT30|UCT50|UCT100|UCT350|10|15|P20|ECO30|50|100|EXTRA115|200|250|300|500|1000|ALLIN99|AI250|TRINET100|ST30|GU15|UA20|U30|GU30|GT20|AM15|TP15|UTP10|TNTXT10|TNTXT20|GT10|KAT25|TOT20|GA15|GA30|TRI20|TRI30|TOT10|T15|U150|T100|T20|UA25|TP10|UTP15|UT10|UAT15|UAT30|BRO30|BRO50|BRO60|BRO100|BRO200|BRO300|BRO500|BROTXT20|BBYTES5|BBYTES10|BBYTES15|BBYTES30|BBYTES70|SURFMAX50|SURFMAX85|SURFMAX200|SURFMAX250|SURFMAX500|SURFMAX995|FLEX20|FLEX30|FLEX50|FLEX100|GIGA50|GIGA99|CIG290|CIG390|CIG430|CIG590|SAT20|UTXT20|UTXT40|UTXT80|SULIT15|ALL20|TXT20|GO20|GO25|GO30|GO50|CALL30|GOSURF10|GOSURF15|GOSURF30|GOSURF50|GOSURF99|GOSURF199|GOSURF299|GOSURF499|GOSURF999|TIPIDD30|TIPIDD50|TIPIDD100|SIDD149|SUD699|TINGI30|TINGI40|TGS30|TGS50|TGS5D|TGS299|ASTIG10|ASTIG15|ASTIG20|ASTIG30|ATA15|ST5|TXT10|UA10|C10|C15|C20|UNLI15|GS10|GS15|GS30|GS50|GS99|FB10|FB15|TMIDD30|TV10|TV40|TV99|KAP5|KOU25|KOU50|KS10|KS20|KS50|KS299|KC10|KAU10|KTA15|KT5|KU10|CMUNLI5|CMANET10|CMANET99|CMTALK30|CMCHAT10|CMSURF10|CMSURF20|CMSURF50|CMSURF99|CMSURF199|CMSURF399|CMSURF499|CMSURF599|CMUNLI15|CMUNLI50|CMUNLI100|CMUNLI199|CM365|GREG10|GREG11|GREG12|GREG13|GREG14|GREG15|GREG16|GREG17|GREG18|GREG19|GREG20|GREG21|GREG22|GREG23|GREG24|GREG25|GREG26|GREG27|GREG28|GREG29|GREG30|GREG31|GREG32|GREG33|GREG34|GREG35|GREG36|GREG37|GREG38|GREG39|GREG40|GREG41|GREG42|GREG43|GREG44|GREG45|GREG46|GREG47|GREG48|GREG49|GREG50|GREG51|GREG52|GREG53|GREG54|GREG55|GREG56|GREG57|GREG58|GREG59|GREG60|GREG61|GREG62|GREG63|GREG64|GREG65|GREG66|GREG67|GREG68|GREG69|GREG70|GREG71|GREG72|GREG73|GREG74|GREG75|GREG76|GREG77|GREG78|GREG79|GREG80|GREG81|GREG82|GREG83|GREG84|GREG85|GREG86|GREG87|GREG88|GREG89|GREG90|GREG91|GREG92|GREG93|GREG94|GREG95|GREG96|GREG97|GREG98|GREG99|GREG100|GREG101|GREG102|GREG103|GREG104|GREG105|GREG106|GREG107|GREG108|GREG109|GREG110|GREG111|GREG112|GREG113|GREG114|GREG115|GREG116|GREG117|GREG118|GREG119|GREG120|GREG121|GREG122|GREG123|GREG124|GREG125|GREG126|GREG127|GREG128|GREG129|GREG130|GREG131|GREG132|GREG133|GREG134|GREG135|GREG136|GREG137|GREG138|GREG139|GREG140|GREG141|GREG142|GREG143|GREG144|GREG145|GREG146|GREG147|GREG148|GREG149|GREG150|SULIT30|BT5|CTC10|CTC15|CTC20|CTC30|CTC50|CTC150|FLEXI30|FLEXI50|IDD30|IDD60|ME40|TA15|IDD50|IDD100|IDD200|IDD300|TT30|SURF60|CTU25|CTU30|CTU50|CTU150|CTU450|DCTU100|TAPLUS25|TAPLUS100|TU20|TU50|TU60|TU150|TU200|TU300|TUPLUS300|UMIX25|UTA20|WIN10|WIN15|BS15|BS25|BS40|BS80|BS150|BS300|SBW25|SBW50|SBW100|SBW250|SBW300|SBW999|USURF50|USURF100|USURF220|USURF450|USURF899|NONSTOP25|NONSTOP50|NONSTOP250|NONSTOP450|I15|I25|I50|I100|I250|I999|TRINET300|TRIO10|UTT20|SREG|PLDT30|PLDT50|PLDT60|PLDT100|PLDT115|PLDT175|PLDT200|PLDT300|PLDT500|PLDT1000|MER110|MER220|MER330|MER550|MER1100)\s+(0\d{3}\d{7})\s+(F\d+)$/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

/*
$str = array();
$str[] = 'eshop rl smart101 09493621618';
//$str[] = 50;
//$str[] = 500;

foreach($str as $v) {
	if(preg_match('/^ESHOP\s+RL\s+(TALK100|AT10|AT12|5|GREG5|REG60|SMART|GLOBE|SUN|AT20|AT30|AT50|BIGCALL100|BIGSURF80|BIGTXT50|BIGTXT100|UCT25|UCT30|UCT50|UCT100|UCT350|10|15|P20|ECO30|50|100|EXTRA115|200|250|300|500|1000|ALLIN99|AI250|TRINET100|ST30|GU15|UA20|U30|GU30|GT20|AM15|TP15|UTP10|TNTXT10|TNTXT20|GT10|KAT25|TOT20|GA15|GA30|TRI20|TRI30|TOT10|T15|U150|T100|T20|UA25|TP10|UTP15|UT10|UAT15|UAT30|BRO30|BRO50|BRO60|BRO100|BRO200|BRO300|BRO500|BROTXT20|BBYTES5|BBYTES10|BBYTES15|BBYTES30|BBYTES70|SURFMAX50|SURFMAX85|SURFMAX200|SURFMAX250|SURFMAX500|SURFMAX995|FLEX20|FLEX30|FLEX50|FLEX100|GIGA50|GIGA99|CIG290|CIG390|CIG430|CIG590|SAT20|UTXT20|UTXT40|UTXT80|SULIT15|ALL20|TXT20|GO20|GO25|GO30|GO50|CALL30|GOSURF10|GOSURF15|GOSURF30|GOSURF50|GOSURF99|GOSURF199|GOSURF299|GOSURF499|GOSURF999|TIPIDD30|TIPIDD50|TIPIDD100|SIDD149|SUD699|TINGI30|TINGI40|TGS30|TGS50|TGS5D|TGS299|ASTIG10|ASTIG15|ASTIG20|ASTIG30|ATA15|ST5|TXT10|UA10|C10|C15|C20|UNLI15|GS10|GS15|GS30|GS50|GS99|FB10|FB15|TMIDD30|TV10|TV40|TV99|KAP5|KOU25|KOU50|KS10|KS20|KS50|KS299|KC10|KAU10|KTA15|KT5|KU10|CMUNLI5|CMANET10|TRITEXT5|CMTALK30|CMCHAT10|CMSURF10|CMSURF20|CMSURF50|CMSURF99|CMSURF199|CMSURF399|CMSURF499|CMSURF299|CMUNLI15|CMUNLI50|CMUNLI100|CMUNLI199|CM365|GREG10|GREG11|GREG12|GREG13|GREG14|GREG15|GREG16|GREG17|GREG18|GREG19|GREG20|GREG21|GREG22|GREG23|GREG24|GREG25|GREG26|GREG27|GREG28|GREG29|GREG30|GREG31|GREG32|GREG33|GREG34|GREG35|GREG36|GREG37|GREG38|GREG39|GREG40|GREG41|GREG42|GREG43|GREG44|GREG45|GREG46|GREG47|GREG48|GREG49|GREG50|GREG51|GREG52|GREG53|GREG54|GREG55|GREG56|GREG57|GREG58|GREG59|GREG60|GREG61|GREG62|GREG63|GREG64|GREG65|GREG66|GREG67|GREG68|GREG69|GREG70|GREG71|GREG72|GREG73|GREG74|GREG75|GREG76|GREG77|GREG78|GREG79|GREG80|GREG81|GREG82|GREG83|GREG84|GREG85|GREG86|GREG87|GREG88|GREG89|GREG90|GREG91|GREG92|GREG93|GREG94|GREG95|GREG96|GREG97|GREG98|GREG99|GREG100|GREG101|GREG102|GREG103|GREG104|GREG105|GREG106|GREG107|GREG108|GREG109|GREG110|GREG111|GREG112|GREG113|GREG114|GREG115|GREG116|GREG117|GREG118|GREG119|GREG120|GREG121|GREG122|GREG123|GREG124|GREG125|GREG126|GREG127|GREG128|GREG129|GREG130|GREG131|GREG132|GREG133|GREG134|GREG135|GREG136|GREG137|GREG138|GREG139|GREG140|GREG141|GREG142|GREG143|GREG144|GREG145|GREG146|GREG147|GREG148|GREG149|GREG150|SULIT30|BT5|CTC10|CTC15|CTC20|CTC30|CTC50|CTC150|FLEXI30|FLEXI50|IDD30|IDD60|ME40|TA15|IDD50|IDD100|IDD200|IDD300|TT30|SURF60|CTU25|CTU30|CTU50|CTU150|CTU450|DCTU100|TAPLUS25|TAPLUS100|TU20|TU50|TU60|TU150|TU200|TU300|TUPLUS300|UMIX25|UTA20|WIN10|WIN15|BS15|BS25|BS40|BS80|BS150|BS300|SBW25|SBW50|SBW100|SBW250|SBW300|SBW999|USURF50|USURF100|USURF220|USURF450|USURF899|NONSTOP25|NONSTOP50|NONSTOP250|NONSTOP450|I15|I25|I50|I100|I250|I999|TRINET300|TRIO10|UTT20|SREG|PLDT30|PLDT50|PLDT60|PLDT100|PLDT115|PLDT175|PLDT200|PLDT300|PLDT500|PLDT1000|MER110|MER220|MER330|MER550|MER1100|CMANET70|CMVIBES5|SMART101)\s+(0\d{3}\d{7})/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}
*/

/*
$str = array();
$str[] = 'eshop rl smart101 09493621618';
//$str[] = 50;
//$str[] = 500;

foreach($str as $v) {
	if(preg_match('/(TALK100|AT10|AT12|5|GREG5|REG60|SMART|GLOBE|SUN|AT20|AT30|AT50|BIGCALL100|BIGSURF80|BIGTXT50|BIGTXT100|UCT25|UCT30|UCT50|UCT100|UCT350|10|15|P20|ECO30|50|100|EXTRA115|200|250|300|500|1000|ALLIN99|AI250|TRINET100|ST30|GU15|UA20|U30|GU30|GT20|AM15|TP15|UTP10|TNTXT10|TNTXT20|GT10|KAT25|TOT20|GA15|GA30|TRI20|TRI30|TOT10|T15|U150|T100|T20|UA25|TP10|UTP15|UT10|UAT15|UAT30|BRO30|BRO50|BRO60|BRO100|BRO200|BRO300|BRO500|BROTXT20|BBYTES5|BBYTES10|BBYTES15|BBYTES30|BBYTES70|SURFMAX50|SURFMAX85|SURFMAX200|SURFMAX250|SURFMAX500|SURFMAX995|FLEX20|FLEX30|FLEX50|FLEX100|GIGA50|GIGA99|CIG290|CIG390|CIG430|CIG590|SAT20|UTXT20|UTXT40|UTXT80|SULIT15|ALL20|TXT20|GO20|GO25|GO30|GO50|CALL30|GOSURF10|GOSURF15|GOSURF30|GOSURF50|GOSURF99|GOSURF199|GOSURF299|GOSURF499|GOSURF999|TIPIDD30|TIPIDD50|TIPIDD100|SIDD149|SUD699|TINGI30|TINGI40|TGS30|TGS50|TGS5D|TGS299|ASTIG10|ASTIG15|ASTIG20|ASTIG30|ATA15|ST5|TXT10|UA10|C10|C15|C20|UNLI15|GS10|GS15|GS30|GS50|GS99|FB10|FB15|TMIDD30|TV10|TV40|TV99|KAP5|KOU25|KOU50|KS10|KS20|KS50|KS299|KC10|KAU10|KTA15|KT5|KU10|CMUNLI5|CMANET10|TRITEXT5|CMTALK30|CMCHAT10|CMSURF10|CMSURF20|CMSURF50|CMSURF99|CMSURF199|CMSURF399|CMSURF499|CMSURF299|CMUNLI15|CMUNLI50|CMUNLI100|CMUNLI199|CM365|GREG10|GREG11|GREG12|GREG13|GREG14|GREG15|GREG16|GREG17|GREG18|GREG19|GREG20|GREG21|GREG22|GREG23|GREG24|GREG25|GREG26|GREG27|GREG28|GREG29|GREG30|GREG31|GREG32|GREG33|GREG34|GREG35|GREG36|GREG37|GREG38|GREG39|GREG40|GREG41|GREG42|GREG43|GREG44|GREG45|GREG46|GREG47|GREG48|GREG49|GREG50|GREG51|GREG52|GREG53|GREG54|GREG55|GREG56|GREG57|GREG58|GREG59|GREG60|GREG61|GREG62|GREG63|GREG64|GREG65|GREG66|GREG67|GREG68|GREG69|GREG70|GREG71|GREG72|GREG73|GREG74|GREG75|GREG76|GREG77|GREG78|GREG79|GREG80|GREG81|GREG82|GREG83|GREG84|GREG85|GREG86|GREG87|GREG88|GREG89|GREG90|GREG91|GREG92|GREG93|GREG94|GREG95|GREG96|GREG97|GREG98|GREG99|GREG100|GREG101|GREG102|GREG103|GREG104|GREG105|GREG106|GREG107|GREG108|GREG109|GREG110|GREG111|GREG112|GREG113|GREG114|GREG115|GREG116|GREG117|GREG118|GREG119|GREG120|GREG121|GREG122|GREG123|GREG124|GREG125|GREG126|GREG127|GREG128|GREG129|GREG130|GREG131|GREG132|GREG133|GREG134|GREG135|GREG136|GREG137|GREG138|GREG139|GREG140|GREG141|GREG142|GREG143|GREG144|GREG145|GREG146|GREG147|GREG148|GREG149|GREG150|SULIT30|BT5|CTC10|CTC15|CTC20|CTC30|CTC50|CTC150|FLEXI30|FLEXI50|IDD30|IDD60|ME40|TA15|IDD50|IDD100|IDD200|IDD300|TT30|SURF60|CTU25|CTU30|CTU50|CTU150|CTU450|DCTU100|TAPLUS25|TAPLUS100|TU20|TU50|TU60|TU150|TU200|TU300|TUPLUS300|UMIX25|UTA20|WIN10|WIN15|BS15|BS25|BS40|BS80|BS150|BS300|SBW25|SBW50|SBW100|SBW250|SBW300|SBW999|USURF50|USURF100|USURF220|USURF450|USURF899|NONSTOP25|NONSTOP50|NONSTOP250|NONSTOP450|I15|I25|I50|I100|I250|I999|TRINET300|TRIO10|UTT20|SREG|PLDT30|PLDT50|PLDT60|PLDT100|PLDT115|PLDT175|PLDT200|PLDT300|PLDT500|PLDT1000|MER110|MER220|MER330|MER550|MER1100|CMANET70|CMVIBES5|SMART101)\s+\s+/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/


/*
$str = array();
$str[] = '19Jul 1742: 09397599095 has loaded SMARTLoad All Text 10 (P4.77) to 09493621618. New Load Wallet Balance:P999.23. Ref:071068076269';

foreach($str as $v) {
	if(preg_match('/\d+(?<SIMCARD>\d{10})\s+has\s+loaded\s+(?<PRODUCT>SMARTLoad\s+All\s+Text\s+10)\s+\(.+?(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+)\)\s+to\s+\d+(?<MOBILENO>\d{10}).+?Wallet\s+Balance.+?P(?<BALANCE>\d+\.\d+|\d+).+?Ref.+?(?<REFERENCE>\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}
*/



/*
$str = array();
$str[] = '26-Oct 16:19:639285900960 has loaded Mega All-in 250 to 09215631826. New Load Wallet Balance:P4686.50. Ref:801445847557';

foreach($str as $v) {
	if(preg_match('/\d+(?<SIMCARD>\d{10})\s+has\s+loaded\s+(?<PRODUCT>.+?)\s+\(.+?(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+)\)\s+to\s+\d+(?<MOBILENO>\d{10}).+?Wallet\s+Balance.+?P(?<BALANCE>\d+\.\d+|\d+).+?Ref.+?(?<REFERENCE>\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}
*/


/*$str = array();
$str[] = '02/28/2017 05:24PM 09561032661 has loaded 11.00 Load(P10.50) to 09152935330. New load wallet balance is P189.50. Ref:880983963';

foreach($str as $v) {
	if(preg_match('/\d+(?<SIMCARD>\d{10})\s+has\s+loaded\s+(?<PRODUCT>.+?)\(P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+)\)\s+to\s+\d+(?<MOBILENO>\d{10})\.\s+New.+?balance\s+is\s+P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+)\..+?Ref.+?(?<REFERENCE>\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

/*$str = array();
$str[] = '01 Mar 16:52:02: 9331060933 has loaded 5 Peso(4.77 Peso) to 9227529393. New Load Wallet Balance: 171.38 Peso. Ref: 0301165202147660.';

foreach($str as $v) {
	if(preg_match('/(?<SIMCARD>\d{10})\s+has\s+loaded\s+(?<PRODUCT>.+?)\((?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+)\s+Peso\)\s+to\s+(?<MOBILENO>\d{10})\.\s+New.+?Balance.+?(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+)\s+Peso\.\s+?Ref.+?(?<REFERENCE>\d+)/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

/*$regx = 'Transfer.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?Dealer.+?Load\s+Wallet\s+\d+(?<MOBILENO>\d{10})\s+completed.+?Bal\:P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?Ref.+?(?<REFERENCE>\d+)';

$str = array();
$str[] = '29Apr 12:16: Transfer of P10.00 from Dealer Card of TOP MOBILE D to Load Wallet 09216119988 completed.Avail Bal:P73,760.00 Ref:870057907129 ';
$str[] = '29Apr 1030: Transfer of P500.00 from Dealer TOP MOBILE D to Load Wallet 09397889394 completed. Avail Bal:P73,820.00 Ref:060213437377';

foreach($str as $k=>$v) {
	if(preg_match('/'.$regx.'/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}*/

/*
$regx = 'P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?loaded.+?Load\s+Wallet.+?\d+(?<SIMCARD>\d{10})\s+from\s+(?<SUPPLIER>.+?)\..+?Balance\:P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?Ref.+?(?<REFERENCE>\d+)';

$str = array();
$str[] = '02May 19:06: P10.00 is loaded to Load Wallet of 09216119988 from TOP MOBILE D 639397602109.New Balance:P3679.55 Ref:860490615490';
$str[] = '13Apr 11:06: P3000.00 is loaded to Load Wallet of 09216119988 from TOP MOBILE D 639397602109.New Balance:P4408.30 Ref:860473998163';

foreach($str as $k=>$v) {
	if(preg_match('/'.$regx.'/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}
*/

//$regx = 'CONFIRM.+?Ref\:(?<REF>.{12}).+?Customer.+?Cellphone.+?Receiver.+?Cellphone';
//$regx = '.+?Sent.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?from\s+(?<LABEL>.+?)\s+to\s+(?<CARDNO>.{16}).+?at.+?\d+(?<MOBILENO>\d{10}).+?Ref\:(?<REF>.{12})';
//$regx = '.+?Sent.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?from\s+(?<LABEL>.+?)\s+to\s+(?<CARDNO>.+?\s+)at.+?\d+(?<MOBILENO>\d{10}).+?deducted\s+P(?<FEE>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?bal.+?P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?Ref\:(?<REF>.{12})';
//$regx = '.+?Sent.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?from\s+(?<LABEL>.+?)\s+to\s+(?<CARDNO>.{16}).+?at.+?\d+(?<MOBILENO>\d{10}).+?Ref\:(?<REF>.{12})';
//$regx = '.+?Remittance.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?fee.+?P(?<FEE>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?deducted.+?bal.+?P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?Ref\:(?<REF>.{12})';
//$regx = '.+?Remittance .+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?commission.+?P(?<COMMISSION>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?received.+?\d+(?<MOBILENO>\d{10}).+?Ref\:(?<REF>.{12}).+?Bal.+?P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+)';
//$regx = '.+?Remittance .+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+)';

//$regx = '.+?Remittance .+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?commission.+?P(?<COMMISSION>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?received.+?\d+(?<MOBILENO>\d{10}).+?Ref\:(?<REF>.{12})';

//$regx = '.+?Received.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?with.+?P(?<COMMISSION>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?commission\s+from\s+\d+(?<MOBILENO>\d{10})\s+to\s+(?<LABEL>.+?)\..+?Ref\:(?<REF>.{12}).+?Bal.+?P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+)';

//$regx = '.+?We\s+have\s+sent.+?Thank\s+you.+?Ref\:(?<REF>.{12})';

//$regx = '\d+(?<SIMCARD>\d{10})\s+has\s+loaded\s+(?<PRODUCT>.+?)\(.+?(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+)\)\s+to\s+\d+(?<MOBILENO>\d{10}).+?Wallet\s+Balance.+?P(?<BALANCE>\d+\.\d+|\d+).+?Ref.+?(?<REFERENCE>\d+)';

//----

//$regx = '.+?Received.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?from.+?\d+(?<MOBILENO>\d{10}).+?Ref\:(?<REF>.{12}).+?Bal.+?P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+)';

//$regx = '.+?Remittance.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?commission.+?P(?<COMMISSION>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?added.+?Bal.+?P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?Ref\:(?<REF>.{12})';

$regx = '.+?Received.+?P(?<AMOUNT>[0-9\,]+\.\d+|[0-9\,]+|\d+).+?from\s+(?<SOURCE>.+?)\s+.+?Ref\:(?<REF>.{12}).+?Bal.+?P(?<BALANCE>[0-9\,]+\.\d+|[0-9\,]+|\d+)';

$str = array();
//$str[] = '17Aug 2143:Sent PHP500.00 from LOADING to 557751******8104 at 639092701100.Ref:f620ccf870f6.Sa next msg,i-type ang customer &receiver cellphone# &send to 8890.';
//$str[] = '17Aug 2143:Remittance of PHP500.00 & fee of PHP18.50 was deducted from your account.Avail bal:PHP9,592.50.Ref:f620ccf870f6';

/*$str[] = "CONFIRM Ref:8ce57d66c530\nCustomer Cellphone#:\nReceiver Cellphone#:";
$str[] = '18Aug 0009:Sent PHP500.00 from LOADING to 557751******8104 at 639092701100.Ref:8ce57d66c530.Sa next msg,i-type ang customer &receiver cellphone# &send to 8890.';
$str[] = '18Aug 0009:Remittance of PHP500.00 & fee of PHP18.50 was deducted from your account.Avail bal:PHP9,074.00.Ref:8ce57d66c530';
$str[] = '18Aug 0049: We have sent a text message to your customer on the Smart Padala transaction details. Thank you! Ref:8ce57d66c530';

$str[] = '18Aug 0009:Remittance of PHP500.00 & commission of PHP11.50 was received from 639477409000.LIBRE ang pag-claim ng iyong customer.Ref:8ce57d66c530 Bal:PHP511.50';
*/

$str[] = '26Aug 1558:Remittance of PHP600.00 & fee of PHP18.50 was deducted from your account.Avail bal:PHP13,206.00.Ref:a1e65ae6793a';
$str[] = '26Aug 1558:Sent PHP600.00 from LOADING to 557751******8104 at 639092701100.Ref:a1e65ae6793a.Sa next msg,i-type ang customer &receiver cellphone# &send to 8890.';
$str[] = "CONFIRM Ref:a1e65ae6793a\nCustomer Cellphone#:\nReceiver Cellphone#:";

$str[] = '1/2 26Aug 1558:Remittance of PHP600.00 & commission of PHP11.50 was received from 639477409000.LIBRE ang pag-claim ng iyong customer.Ref:a1e65ae6793a';
$str[] = '2/2 Bal:PHP1,123.00';

$str[] = '17Aug 2143:Remittance of PHP500.00 & commission of PHP11.50 was received from 639477409000.LIBRE ang pag-claim ng iyong customer.Ref:f620ccf870f6 Bal:PHP511.50';

$str[] = '26Aug 2347: We have sent a text message to your customer on the Smart Padala transaction details. Thank you! Ref:a464a0761a12';

$str[] = '5-Sep 16:31:639471617115 has loaded 50 Load (P47.78) to 09460036139. New Load Wallet Balance:P3521.64. Ref:800058079190';

//$str[] = '01Oct 1004: Received P500.00 with P11.50 commission from 09282573535 to LOADING.LIBRE ang pag-claim! Ref:3152f53eeab6 Bal:P9,459.00';

$str[] = '2017-09-24 17:08:38: Received PHP600.00 from +639216811152 w/commission kung ikaw ay Smart Padala Agent.LIBRE ang pag-claim ni suki! Ref:9b129a9b73fc Bal: PHP188173.15. Para malaman ang iyong komisyon, i-check ang balance sa Smart Money menu.';

//$str[] = '06Oct 0926: Received P1,500.00 with P17.25 commission from 09478254176 to ENCASHMENT.LIBRE ang pag-claim! Ref:4e9feaa73642 Bal:P11,438.00';

//$str[] = '28Sep 1437: Received P900.00 with P11.50 commission from 09984815444 to LOADING.LIBRE ang pag-claim! Ref:5c4ed4976d7b Bal:P505,608.62';

$str[] = '27Sep 1346:Remittance of P500.00 & commission of P11.50 was added to your account.Avail Bal:P71,611.25.Ref:d9d9359b2e2d';

$str[] = '2017-09-27 09:20:24: Received PHP1,000.00 from POSIBLE w/commission kung ikaw ay Smart Padala Agent.LIBRE ang pag-claim ni suki! Ref:3a5c3e85d7d4 Bal: PHP47143.50. Para malaman ang iyong komisyon, i-check ang balance sa Smart Money menu.';

$str[] = '2017-09-24 19:34:38: Received PHP2,000.00 from Bayad Center w/commission kung ikaw ay Smart Padala Agent.LIBRE ang pag-claim ni suki! Ref:f3417e81e20e Bal: PHP199222.65. Para malaman ang iyong komisyon, i-check ang balance sa Smart Money menu.';

$str[] = '2017-09-24 09:46:04: Received PHP800.00 from EXPRESSPAY w/commission kung ikaw ay Smart Padala Agent.LIBRE ang pag-claim ni suki! Ref:fd5b3732ac5d Bal: PHP62243.75. Para malaman ang iyong komisyon, i-check ang balance sa Smart Money menu.';

$str[] = '2017-09-23 18:19:42: Received PHP700.00 from Payswitch w/commission kung ikaw ay Smart Padala Agent.LIBRE ang pag-claim ni suki! Ref:e5e19ce8f2d1 Bal: PHP460225.12. Para malaman ang iyong komisyon, i-check ang balance sa Smart Money menu.';

$str[] = '30Oct 1813:Remittance of P1,500.00 & commission of P17.25 was added to your account.Avail Bal:P116,815.50.Ref:747136769ed3';

$str[] = '01Dec 1741:Sent P500.00 from LOADING to ****8104 at 09092701100. Also deducted P18.50 from your account.Bal:P10,896.00.Ref:4cf334b57203 ';

$str[] = '28Dec 1655:Sent P500.00 from LOADING to ****8104 at 09092701100. Also deducted P18.50 from your account.Bal:P14,181.00.Ref:304b244099ec ';

$str[] = '2017-12-28 12:31:16: Received PHP4,700.00 from +639284879822 w/commission kung ikaw ay Smart Padala Agent.LIBRE ang pag-claim ni suki! Ref:dcbbdfc5b809 Bal: PHP38491.05. Para malaman ang iyong komisyon, i-check ang balance sa Smart Money menu.';

foreach($str as $k=>$v) {
	if(preg_match('/'.$regx.'/si',$v,$matches)) {
		print_r(array('$matches'=>$matches));
	}
}

///
