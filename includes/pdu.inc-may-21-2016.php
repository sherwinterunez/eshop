<?php
//namespace Application\Pdu;


//use Application\Utf8\Utf8;
//use Application\Exception\InvalidArgumentException;
/*
 * 31.01.2014: PHP version by Bruce Lampson.
 * - https://github.com/BruceLampson
 *
 * April 2010: Futher changes and functionality by Keijo Kasvi.
 * http://smstools3.kekekasvi.com - Feel free to use this code as you wish.
 *
 * 18.05.2011
 * - Recurring and starting spaces in message text are now shown in a browser.
 *
 * 06.04.2011
 * - Fixed handling of TP-DCS when coding group bits are 1111xxxx.
 *
 * 24.03.2011
 * - Added index column to the user data translation.
 *
 * 09.08.2010
 * - Added hexadecimal dump for 8bit messages.
 *
 * 23.07.2010
 * - Added "Type Of Address" selection.
 *
 * 23.05.2010
 * - Added handling for pdu= query variable.
 *
 * 13.05.2010
 * - Result code of a status report is explained.
 *
 * 22.04.2010
 * - Fix: The modified code did not show if a receipt was requested.
 *
 * 11.04.2010
 * - USSD Entry/Display now supports UCS2. Alphabet is not detected from the Cell Broadcast PDU,
 *   use radio buttons to select alphabet.
 *
 * 10.04.2010
 * - Type Of Address is explained.
 * - User Data Header is extracted from the PDU and shown as a hex string.
 * - Fixed incorrectly taken discharge timestamp in status report. Changed all timezone handling.
 *
 * 09.04.2010
 * - New layout, user friendly with long PDU's.
 * - Handling for extended characters (encode and decode).
 * - Update counting when alphabet size is changed.
 * - Plain User Data is created using USSD packing character.
 * - Can decode GSM 7bit packed (USSD) User Data.
 * - Can decode Cell Broadcast PDU (7bit).
 * - etc...
 */

/* Script written by Swen-Peter Ekkebus, edited by Ing. Milan Chudik.
 *
 * Further fixes and functionality by Andrew Alexander:
 * Fix message length issues, handle +xx  & 0xx phone codes, added bit length options,
 * display 8 & 16 bit messages, reformat interface, deal with embedded spaces in hex,
 * allow leading AT command in input, implemented some support for alpanumeric senders...
 *
 * ekkebus[at]cs.utwente.nl
 * Feel free to use it, please don't forget to link to the source ;)
 *
 *
 * www.rednaxela.net - Feel free to use this code as you wish.
 * Version 1.5 r9aja
 *
 * Official BPS develop tool
 *
 * (c) BPS & co, 2003
 */

/* INCLUDES_START */

class Pdu  {

    const SEVEN_BITS = 7;
    const EIGHT_BITS = 8;
    const SIXTEEN_BITS = 16;

    private static $instance = null;

    private $hex = '0123456789ABCDEF';
    private $calculation;
    private $maxChars = 160;
    private $d = false;

    //Array with "The 7 bit defaultalphabet"
    private $sevenbitdefault = array(
        '@',	'£',	'$',	'¥',	'è',	'é',	'ù',	'ì',	'ò',	'Ç',	"\n",	'Ø',	'ø',	"\r",	'Å',	'å',
        'Δ',	'_',	'Φ',	'Γ',	'Λ',	'Ω',	'Π',	'Ψ',    'Σ',	'Θ',	'Ξ',	'☝',	'Æ',	'æ',	'ß',	'É',
        ' ',	'!',	'"',	'#',	'¤',	'%',	'&',	'\'',	'(',	')',	'*',	'+',	',',	'-',	'.',	'/',
        '0',	'1',	'2',	'3',	'4',	'5',	'6',	'7',	'8',	'9',	':',	';',	'<',	'=',	'>',	'?',
        '¡',	'A',	'B',	'C',	'D',	'E',	'F',	'G',	'H',	'I',	'J',	'K',	'L',	'M',	'N',	'O',
        'P',	'Q',	'R',	'S',	'T',	'U',	'V',	'W',	'X',	'Y',	'Z',	'Ä',	'Ö',	'Ñ',	'Ü',	'§',
        '¿',	'a',	'b',	'c',	'd',	'e',	'f',	'g',	'h',	'i',	'j',	'k',	'l',	'm',	'n',	'o',
        'p',	'q',	'r',	's',	't',	'u',	'v',	'w',	'x',	'y',	'z',	'ä',	'ö',	'ñ',	'ü',	'à'

    );

    private $sevenbitextended = array(
        '\f',	0x0A,	// '\u000a',	// <FF>
        '^',	0x14,	// '\u0014',	// CIRCUMFLEX ACCENT
        '{',	0x28,	// '\u0028',	// LEFT CURLY BRACKET
        '}',	0x29,	// '\u0029',	// RIGHT CURLY BRACKET
        '\\',	0x2F,	// '\u002f',	// REVERSE SOLIDUS
        '[',	0x3C,	// '\u003c',	// LEFT SQUARE BRACKET
        '~',	0x3D,	// '\u003d',	// TILDE
        ']',	0x3E,	// '\u003e',	// RIGHT SQUARE BRACKET
        '|',	0x40,	// '\u0040',	// VERTICAL LINE \u7c
        '€',	0x65 	// '\u0065'	// EURO SIGN &#8364;
    );

    private function __construct(){}

    public static function getInstance()
    {
        if(null === self::$instance) {
            self::$instance = new Pdu();
        }
        return self::$instance;
    }


    private function substr($str, $start, $length = null, $encoding = 'UTF-8'){
        if(isset($start) && isset($length)){
            return mb_substr($str,$start, $length,$encoding);
        }else if(isset($start) && !isset($length)){
            return mb_substr($str,$start);
        }
        return false;
    }

    private function parseInt( $string, $base = 10 ) {
        //@check
        return intval($string, $base);
    }

    private function substring($string, $start = null, $end = null ,$encoding = 'UTF-8') {
        if(isset($start) && isset($end)){
            if($start > $end){
                list($start,$end) = array($end,$start);
            }else if($start < 0){
                $start = 0;
            }
            return  mb_substr( $string, $start, $end - $start,$encoding);
        }else if(isset($start) && !isset($end)){
            if($start < 0){
                $start = 0;
            }
            return  mb_substr( $string, $start);
        }
        return false;
    }

    public function strlen($string, $encoding = 'UTF-8') {
        //@check
        return  mb_strlen($string, $encoding);
    }

    private function binToInt($x){

        $total = 0;
        $power = $this->parseInt($this->strlen($x))-1;
        for($i=0; $i < $this->strlen($x); $i++){
            if($x{$i} == '1'){
                $total = $total + pow(2,$power);
            }
            $power--;
        }
        return $total;
    }

    private function decode_timezone($timezone)
    {
        $tz = $this->parseInt($this->substring($timezone, 0, 1), 16);
        $result = '+';

        if ($tz & 8)
            $result = '-';
        $tz = ($tz & 7) * 10;
        $tz += $this->parseInt($this->substring($timezone, 1, 2), 10);

        $tz_hour = floor($tz / 4);
        $tz_min = 15 * ($tz % 4);

        if ($tz_hour < 10)
            $result .= '0';
        $result .= $tz_hour .':';
        if ($tz_min == 0)
            $result .= '00';
        else
            $result .= $tz_min;

        return $result;
    }

    private function intToBin($x,$size){

        $num = $this->parseInt($x);
        $bin = decbin($num);

        for($i = $this->strlen($bin);$i<$size;$i++){
            $bin = '0' . $bin;
        }
        return $bin;
    }

    private function HexToNum($numberS){

        $tens = $this->MakeNum($this->substring($numberS,0,1));
        $ones = 0;

        if($this->strlen($numberS) > 1){
            $ones = $this->MakeNum($this->substring($numberS,1,2));
        }

        if($ones == 'X'){
            return '00';
        }

        return  ($tens * 16) + ($ones * 1);
    }

    private function MakeNum($string){
        //@check
        if(($string >= '0') && ($string <= '9')){
            return $string;
        }

        switch(strtoupper($string))
        {
            case 'A': return 10;
            case 'B': return 11;
            case 'C': return 12;
            case 'D': return 13;
            case 'E': return 14;
            case 'F': return 15;
            default:
                return 16;
        }
    }

    private function intToHex($i){
        $h = '';
        $i = $this->parseInt($i);

        for($j = 0; $j <= 3; $j++){
            $h .= $this->hex{($i >> ($j * 8 + 4)) & 0x0F} . $this->hex{($i >> ($j * 8)) & 0x0F};
        }
        return $this->substring($h,0,2);
    }

    private function ToHex($i){
        $out = "";
        $out = $this->hex{($i & 0xf)};
        $i >>= 4;
        $out = $this->hex{($i & 0xf)} . $out;
        return $out;
    }

    public function getSevenBitDefaultAlphabet(){
        return $this->sevenbitdefault;
    }

    public function getSevenBitExtendedAlphabet(){
        return $this->sevenbitextended;
    }

    private function getSevenBitExtendedCh($character)
    {

        for ( $i = 0; $i < count($this->sevenbitextended); $i += 2){
            if (Utf8::utf8ToUnicode($this->sevenbitextended[$i +1]) == Utf8::utf8ToUnicode($character)){
                return $this->sevenbitextended[$i];
            }
        }

        return '';
    }

    private function getSevenBitExt($character)
    {
        for ( $i = 0; $i < count($this->sevenbitextended); $i += 2){
            if (Utf8::utf8ToUnicode($this->sevenbitextended[$i]) == Utf8::utf8ToUnicode($character)){
                return $this->sevenbitextended[$i +1];
            }
        }

        return 0;
    }

    private function getSevenBit($character)
    {
        for($i = 0; $i < count($this->sevenbitdefault);$i++){
            if(Utf8::utf8ToUnicode($this->sevenbitdefault[$i]) == Utf8::utf8ToUnicode($character)){
                return $i;
            }
        }
        return 0;
    }

    private function getEightBit($character){
        return $character;
    }

    private function get16Bit($character){
        return $character;
    }

    private function phoneNumberMap($character){

        if(($character >= '0') && ($character <= '9')){
            return $character;
        }

        switch(strtoupper($character)){
            case '*':
                return 'A';
            case '#':
                return 'B';
            case 'A':
                return 'C';
            case 'B':
                return 'D';
            case 'C':
                return 'E';
            //case '+':
            //return '+'; // An exception to fit with current processing ...
            default:
                return 'F';

        }

    }

    private function phoneNumberUnMap($character){

        if(($character >= '0') && ($character <= '9')){
            return $character;
        }

        switch($character){
            case 10:
                return '*';
            case 11:
                return '#';
            case 12:
                return 'A';
            case 13:
                return 'B';
            case 14:
                return 'C';
            default:
                return 'F';

        }

    }

    private function semiOctetToString($inp){
        $out = '';
        for($i=0;$i< $this->strlen($inp);$i=$i+2){
            $temp  = $this->substring($inp,$i,$i+2);
            $out  .= $this->phoneNumberMap($temp{1}) . $this->phoneNumberMap($temp{0});
        }
        return $out;
    }

    private  function getUserMessage($skip_characters, $input,$trueLength) // Add truelength AJA
    {

        //print_r(array('getUserMessage'=>array('$skip_characters'=>$skip_characters,'$input'=>$input,'$trueLength'=>$trueLength)));

        $byteString = '';
        $octetArray = array();
        $restArray = array();
        $septetsArray = array();
        $s=1;
        $count = 0;
        $matchcount = 0; // AJA
        $smsMessage = '';
        $escaped = 0;
        $char_counter = 0;

        //Cut the input string into pieces of2 (just get the hex octets)
        for($i=0;$i< $this->strlen($input);$i=$i+2){
            $hex = $this->substring($input,$i,$i+2);
            //print_r(array('$hex'=>$hex));
            $byteString .=  $this->intToBin($this->HexToNum($hex),8);
        }

        //print_r(array('$byteString'=>$byteString));

        for($i=0;$i< $this->strlen($byteString);$i=$i+8)
        {
            $octetArray[$count] = $this->substring($byteString,$i,$i+8);
            $restArray[$count] = $this->substring($octetArray[$count],0,($s%8));
            $septetsArray[$count] = $this->substring($octetArray[$count],($s%8),8);

            $s++;
            $count++;
            if($s == 8){
                $s = 1;
            }
        }

        //print_r(array('$octetArray'=>$octetArray,'$restArray'=>$restArray,'$septetsArray'=>$septetsArray));

        for ($i = 0; $i < count($restArray); $i++)
        {
            if ($i % 7 == 0)
            {
                if ($i != 0)
                {
                    $char_counter++;
                    $chval = $this->binToInt($restArray[$i-1]);

                    //print_r(array('if ($i != 0)'=>'if ($i != 0)','$i'=>$i,'$char_counter'=>$char_counter,'$chval'=>$chval,'chr($chval)'=>chr($chval),'$restArray[$i-1]'=>$restArray[$i-1]));

                    if ($escaped)
                    {
                        $smsMessage .=  $this->getSevenBitExtendedCh($chval);

                        //print_r(array('$i'=>$i,'$smsMessageA'=>$this->getSevenBitExtendedCh($chval)));

                        $escaped = 0;
                    }
                    else if ($chval == 27 && $char_counter > $skip_characters){
                        $escaped = 1;
                    }else if ($char_counter > $skip_characters){
                        $smsMessage .=  $this->sevenbitdefault[$chval];
                        //print_r(array('$i'=>$i,'$smsMessageB'=>$this->sevenbitdefault[$chval]));
                    }

                    $matchcount ++; // AJA
                }

                $char_counter++;
                $chval = $this->binToInt($septetsArray[$i]);

                //print_r(array('if ($i != 0)'=>'if ($i != 0)','$i'=>$i,'$char_counter'=>$char_counter,'$chval'=>$chval,'chr($chval)'=>chr($chval),'$septetsArray[$i]'=>$septetsArray[$i]));

                if ($escaped)
                {
                    $smsMessage .= $this->getSevenBitExtendedCh($chval);

                    //print_r(array('$i'=>$i,'$smsMessageC'=>$this->getSevenBitExtendedCh($chval)));

                    $escaped = 0;
                }
                else if ($chval == 27 && $char_counter > $skip_characters)
                    $escaped = 1;
                else if ($char_counter > $skip_characters) {
                    $smsMessage .= $this->sevenbitdefault[$chval];
                    //print_r(array('$i'=>$i,'$smsMessageD'=>$this->sevenbitdefault[$chval]));
                }

                $matchcount ++; // AJA
            }
            else
            {
                $char_counter++;
                $chval = $this->binToInt($septetsArray[$i] . $restArray[$i-1]);

                //print_r(array('else'=>'else','$i'=>$i,'$char_counter'=>$char_counter,'$chval'=>$chval,'chr($chval)'=>chr($chval),'$septetsArray[$i]'=>$septetsArray[$i],'$restArray[$i-1]'=>$restArray[$i-1],'$septetsArray[$i] . $restArray[$i-1]'=>$septetsArray[$i] . $restArray[$i-1]));

                if ($escaped)
                {
                    $smsMessage .= $this->getSevenBitExtendedCh($chval);

                    //print_r(array('$i'=>$i,'$smsMessageE'=>$this->getSevenBitExtendedCh($chval)));

                    $escaped = 0;
                }
                elseif ($chval == 27 && $char_counter > $skip_characters){
                    $escaped = 1;
                }

                elseif ($char_counter > $skip_characters){

                    $smsMessage .= $this->sevenbitdefault[$chval];

                    //print_r(array('$i'=>$i,'$smsMessageF'=>$this->sevenbitdefault[$chval]));

                }

                $matchcount ++; // AJA
            }

        }

        //print_r(array('$smsMessage1'=>$smsMessage));

        if ($matchcount != $trueLength) // Don't forget trailing characters!! AJA
        {
            $char_counter++;
            $chval = $this->binToInt($restArray[$i-1]);
            if (!$escaped)
            {
                if ($char_counter > $skip_characters)
                    $smsMessage .= $this->sevenbitdefault[$chval];
            }
            else if ($char_counter > $skip_characters)
                $smsMessage .= $this->getSevenBitExtendedCh($chval);

        }
        //else // Blank Filler
        //{
            //$calculation3 = "<TD  >+++++++</TD>";
            //$calculation4 = "<TD  >&nbsp;</TD>";
        //}

        //Put all the calculation info together
        //$calculation =  "Conversion of 8-bit octets to 7-bit default alphabet <BR><BR>" . $calculation0 .  "</TR>" . $calculation1 . "</TR>" . $calculation2 . "</TR></table>" . $calculation3 . "</TR>" . $calculation4 . "</TR></table>";

        //print_r(array('$smsMessage2'=>$smsMessage));

        return $smsMessage;


    }

    private function getUserMessage16($skip_characters, $input,$truelength)
    {
        $smsMessage = '';
        $char_counter = 0;
        $calculation = 'Not implemented';

        // Cut the input string into pieces of 4
        for($i=0; $i < $this->strlen($input);$i=$i+4)
        {
            $hex1 = $this->substring($input,$i,$i+2);
            $hex2 = $this->substring($input,$i+2,$i+4);
            $char_counter++;
            if ($char_counter > $skip_characters)
                $smsMessage .= '' . (string) Utf8::unicodeToUtf8(array($this->HexToNum($hex1)*256 + $this->HexToNum($hex2)));
        }

        return $smsMessage;
    }

    private function getUserMessage8($skip_characters, $input,$truelength)
    {
        $smsMessage = "";
        $calculation = "Not implemented";

        // Cut the input string into pieces of 2 (just get the hex octets)
        for($i=0;$i<$this->strlen($input);$i=$i+2)
        {
            $hex = $this->substring($input,$i,$i+2);

            $smsMessage .= '' . (string) Utf8::unicodeToUtf8(array($this->HexToNum($hex)));

        }

        return $smsMessage;
    }

/*    private function encodeGSM7bitPacked($inpString)
    {
        $octetFirst = "";
        $octetSecond = "";
        $output = "";
        $padding = Utf8::unicodeToUtf8(array(0x0D));
        $tmp = $inpString;
        $inpStr = "";

        for ($i = 0; $i < $this->strlen($tmp); $i++)
        {
            if ($this->getSevenBitExt($tmp{$i}))
                $inpStr .= Utf8::unicodeToUtf8(array(0x1B));

            $inpStr .= $tmp{$i};
        }

        $len = $this->strlen($inpStr);
        if (($len % 8 == 7) || ($len % 8 == 0 && $len > 0 && $inpStr{($len - 1)} == $padding))
            $inpStr += $padding;

        for ($i = 0; $i <= $this->strlen($inpStr); $i++)
        {
            if ($i == $this->strlen($inpStr))
            {
                if ($octetSecond != "") // AJA Fix overshoot
                {
                    $output .=  "" . ($this->intToHex($this->binToInt($octetSecond)));
                }
                break;
            }

            if ($inpStr{$i} == Utf8::unicodeToUtf8(array(0x1B)))
                $current = $this->intToBin(0x1B,7);
            else
            {
                $tmp = $this->getSevenBitExt($inpStr{$i});
                if ($tmp == 0)
                    $tmp = $this->getSevenBit($inpStr{$i});
                else
                    $tmp = $this->getSevenBitExt($inpStr{$i});

                $current = $this->intToBin($tmp,7);
            }

            $currentOctet = '';

            if($i!=0 && $i%8!=0)
            {
                $octetFirst = $this->substring($current,7-($i)%8);
                $currentOctet = $octetFirst . $octetSecond;	//put octet parts together

                $output .= "" . ($this->intToHex($this->binToInt($currentOctet)));
                $octetSecond = $this->substring($current,0,7-($i)%8);	//set net second octet
            }
            else
            {
                $octetSecond = $this->substring($current,0,7-($i)%8);
            }
        }

        return $output;
    }*/

    private function explain_cell_broadcast($inpString)
    {
        $result = "";
        $alphabet = $this->HexToNum($this->substring($inpString,8, 10));
        $explain_alphabet = "";

        if (($alphabet & 0xF0) == 0)
            $explain_alphabet = " Default Alphabet (7bit)";
        else if (($alphabet & 0xF0) == 0x10)
        {
            if (($alphabet & 0x0F) == 0)
                $explain_alphabet = " Default Alphabet (7bit), message preceeded by language indication";
            else if (($alphabet & 0x0F) == 0x01)
                $explain_alphabet = " UCS2 (16bit), message preceeded by language indication";
        }
        else if (($alphabet & 0xC0) == 0x40)
        {
            if (($alphabet & 0x0C) == 0)
                $explain_alphabet = " Default Alphabet (7bit)";
            else if (($alphabet & 0x0C) == 0x04)
                $explain_alphabet = " 8bit data";
            else if (($alphabet & 0x0C) == 0x08)
                $explain_alphabet = " UCS2 (16bit)";
            else if (($alphabet & 0x0C) == 0x0C)
                $explain_alphabet = " Reserved";
        }

        $result .= "Serial number: " . $this->substring($inpString,0, 4) . PHP_EOL;
        $result .= "Message identifier: " . $this->substring($inpString,4, 6) . PHP_EOL;
        $result .= "Data Coding Scheme: " . $this->substring($inpString,8, 10). $explain_alphabet . PHP_EOL;
        $result .= "Page Parameter: " . $this->substring($inpString,10, 12) . PHP_EOL;

        return $result;
    }

    private function decodeGSM7bitPacked($inpString, $is_cell_broadcast)
    {
        $result_prefix = "";

        $NewString = "";
        for($i = 0; $i < $this->strlen($inpString);$i++)
            if ($this->MakeNum($this->substr($inpString,$i, 1)) != 16)
                $NewString .= $this->substr($inpString,$i,1);
        $inpString = $NewString;

        $i = $this->strlen($inpString);

        if ($i % 2)
            return "ERROR: Length is not even";

        if ($is_cell_broadcast)
        {
            if ($i < 14)
                return "ERROR: Too short";

            $result_prefix .= $this->explain_cell_broadcast($inpString);

            $inpString = $this->substring($inpString,12);
            $i = $this->strlen($inpString);
        }

        $septets = floor($i / 2 * 8 / 7);
        $buffer = $this->getUserMessage(0, $inpString, $septets);
        $len = $this->strlen($buffer);
        $padding = Utf8::unicodeToUtf8(array(0x0D));
        $info = "";

        if (($septets % 8 == 0 && $len > 0 && $buffer{($len -1)} == $padding) || ($septets % 8 == 1 && $len > 1 && $buffer{($len -1)} == $padding && $buffer{($len -2)} == $padding))
        {
            $buffer = $this->substring($buffer,0, $len -1);
            $info = "<BR><SMALL>( Had $padding which is removed )</SMALL>";
        }

        return 'USSD/User Data without length information\nAlphabet: GSM 7bit\n' .$result_prefix. '\n<BIG>'. $buffer. "</BIG>\nLength: " . $this->strlen($buffer) . $info;
    }

    private function decode_ussdText($inpString, $bitSize, $is_cell_broadcast)
    {


        if ($bitSize == 7)
            return $this->decodeGSM7bitPacked($inpString, $is_cell_broadcast);

        if ($bitSize == 16)
        {
            $result_prefix = "";
            $NewString = "";
            for($i = 0; $i < $this->strlen($inpString);$i++)
                if ($this->MakeNum($this->substr($inpString,$i, 1)) != 16)
                    $NewString .= $this->substr($inpString,$i,1);
            $inpString = $NewString;

            $i = $this->strlen($inpString);

            if ($i % 2)
                return "ERROR: Length is not even";

            if ($is_cell_broadcast)
            {
                if ($i < 14)
                    return "ERROR: Too short";

                $result_prefix .= $this->explain_cell_broadcast($inpString);

                $inpString = $this->substring($inpString,12);
            }

            $messagelength = $this->strlen($inpString) / 2;
            $buffer = $this->getUserMessage16(0, $inpString, $messagelength);
            $info = "";

            return 'USSD/User Data without length information\nAlphabet: UCS2\n'.$result_prefix.'\n<BIG>'.$buffer."</BIG>\nLength: ".($messagelength/2) . $info;
        }

        return "ERROR";
    }

    private function explain_toa($octet)
    {
        $result = "";
        $p = "reserved";
        $octet_int = $this->parseInt($octet, 16);

        if ($octet_int != -1)
        {
            switch (($octet_int & 0x70) >> 4)
            {
                case 0:
                    $p = "unknown";
                    break;
                case 1:
                    $p = "international";
                    break;
                case 2:
                    $p = "national";
                    break;
                case 3:
                    $p = "network specific";
                    break;
                case 4:
                    $p = "subsciber";
                    break;
                case 5:
                    $p = "alphanumeric";
                    break;
                case 6:
                    $p = "abbreviated";
                    break;
            }

            $result .= $p;
            $p = "";

            switch ($result & 0x0F)
            {
                case 0:
                    $p = "unknown";
                    break;
                case 1:
                    $p = "ISDN/telephone";
                    break;
                case 3:
                    $p = "data";
                    break;
                case 4:
                    $p = "telex";
                    break;
                case 8:
                    $p = "national";
                    break;
                case 9:
                    $p = "private";
                    break;
                case 10:
                    $p = "ERMES";
                    break;
            }

            if ($p != "")
                $p = "Numbering Plan: " . $p;
            $result .= ", " . $p;
        }

        return $result;
    }

    private function explain_status($octet){
        $p = "unknown";
        $octet_int = $this->parseInt($octet, 16);

        switch ($octet_int)
        {
            case 0: $p = "Ok,short message received by the SME"; break;
            case 1: $p = "Ok,short message forwarded by the SC to the SME but the SC is unable to confirm delivery"; break;
            case 2: $p = "Ok,short message replaced by the SC"; break;

            case 32: $p = "Still trying,congestion"; break;
            case 33: $p = "Still trying,SME busy"; break;
            case 34: $p = "Still trying,no response sendr SME"; break;
            case 35: $p = "Still trying,service rejected"; break;
            case 36: $p = "Still trying,quality of service not available"; break;
            case 37: $p = "Still trying,error in SME"; break;

            case 64: $p = "Error,remote procedure error"; break;
            case 65: $p = "Error,incompatible destination"; break;
            case 66: $p = "Error,connection rejected by SME"; break;
            case 67: $p = "Error,not obtainable"; break;
            case 68: $p = "Error,quality of service not available"; break;
            case 69: $p = "Error,no interworking available"; break;
            case 70: $p = "Error,SM validity period expired"; break;
            case 71: $p = "Error,SM deleted by originating SME"; break;
            case 72: $p = "Error,SM deleted by SC administration"; break;
            case 73: $p = "Error,SM does not exist"; break;

            case 96: $p = "Error,congestion"; break;
            case 97: $p = "Error,SME busy"; break;
            case 98: $p = "Error,no response sendr SME"; break;
            case 99: $p = "Error,service rejected"; break;
            case 100: $p = "Error,quality of service not available"; break;
            case 101: $p = "Error,error in SME"; break;
        }

        return $p;
    }

    private function charCodeAt( $string, $index ) {
        $charCodeAt = Utf8::utf8ToUnicode($string[$index]);

        return (isset($charCodeAt[0])) ? $charCodeAt[0] : false;
        //return ord( $string[$index] );
        //return unpack('N', mb_convert_encoding($string[$index], mb_detect_encoding($string[$index]), 'UTF-8'));
    }

    public function pduToText($inp){
        $pduString = $inp;
        $start = 0;
        $out = array();


        // Silently Strip leading AT command
        if ($this->substr($pduString,0,2)=="AT")
        {
            for($i=0;$i< $this->strlen($pduString);$i++)
            {
                if($this->charCodeAt($pduString,$i)==10)
                {
                    $pduString = $this->substr($pduString,$i+1);
                    break;
                }
            }
        }

        // Silently strip whitespace
        $NewPDU="";
        for($i=0;$i<$this->strlen($pduString);$i++)
        {
            if ($this->MakeNum($this->substr($pduString,$i,1))!=16)
            {
                $NewPDU .= $this->substr($pduString,$i,1);
            }
        }
        $pduString = $NewPDU;

        $SMSC_lengthInfo = $this->HexToNum($this->substring($pduString, 0,2));
        $SMSC_info = $this->substring($pduString, 2,2+($SMSC_lengthInfo*2));
        $SMSC_TypeOfAddress = $this->substring($SMSC_info, 0,2);
        $SMSC_Number = $this->substring($SMSC_info, 2,2+($SMSC_lengthInfo*2));

        if ($SMSC_lengthInfo != 0)
        {
            $SMSC_Number = $this->semiOctetToString($SMSC_Number);

            // if the length is odd remove the trailing  F
            if(($this->substr($SMSC_Number, $this->strlen($SMSC_Number)-1,1) == 'F') || ($this->substr($SMSC_Number, $this->strlen($SMSC_Number)-1,1) == 'f'))
            {
                $SMSC_Number = $this->substring($SMSC_Number, 0,$this->strlen($SMSC_Number)-1);
            }
            //if (SMSC_TypeOfAddress == 91)
            //{
            //	SMSC_Number = "+" + SMSC_Number;
            //}
        }

        $start_SMSDeleivery = ($SMSC_lengthInfo*2)+2;

        $start = $start_SMSDeleivery;
        $firstOctet_SMSDeliver = $this->substr($pduString, $start,2);
        $start = $start + 2;
        //if ((HexToNum($firstOctet_SMSDeliver) & 0x20) == 0x20)
        //{
        //	$out .= "Receipt requested".$linefeed;
        //}

        print_r(array('$firstOctet_SMSDeliver'=>$firstOctet_SMSDeliver,'num'=>$this->HexToNum($firstOctet_SMSDeliver),'$start'=>$start));

        $UserDataHeader = 0;
        if (($this->HexToNum($firstOctet_SMSDeliver) & 0x40) == 0x40)
        {
            $UserDataHeader = 1;
            //$out .= "User Data Header".$linefeed;
        }

        $hex_dump = array();

//	bit1	bit0	Message type
//	0	0	SMS DELIVER (in the direction SC to MS)
//	0	0	SMS DELIVER REPORT (in the direction MS to SC)
//	1	0	SMS STATUS REPORT (in the direction SC to MS)
//	1	0	SMS COMMAND (in the direction MS to SC)
//	0	1	SMS SUBMIT (in the direction MS to SC)
//	0	1	SMS SUBMIT REPORT (in the direction SC to MS)
//	1	1	Reserved

// This needs tidying up!! AJA

        if (($this->HexToNum($firstOctet_SMSDeliver) & 0x03) == 1 || ($this->HexToNum($firstOctet_SMSDeliver) & 0x03) == 3) // Transmit Message
        {


            $out['smsSubmit'] = 'send';

            if (($this->HexToNum($firstOctet_SMSDeliver) & 0x03) == 3)
            {
                $out[] = "Unknown Message";
                $out[] = "Treat as Deliver";
            }


            if (($this->HexToNum($firstOctet_SMSDeliver) & 0x20) == 0x20)
                $rr = 'yes';
            else
                $rr = 'no';

            $out['receiptRequested'] = $rr;

            $MessageReference = $this->HexToNum($this->substr($pduString, $start,2));
            $start = $start + 2;

            // length in decimals
            $sender_addressLength = $this->HexToNum($this->substr($pduString, $start,2));
            if($sender_addressLength %2 != 0)
            {
                $sender_addressLength += 1;
            }
            $start = $start + 2;

            $sender_typeOfAddress = $this->substr($pduString, $start,2);
            $start = $start + 2;

            $sender_number = $this->semiOctetToString($this->substring($pduString,$start,$start+$sender_addressLength));



            if(($this->substr($sender_number,$this->strlen($sender_number)-1,1) == 'F') || ($this->substr($sender_number,$this->strlen($sender_number)-1,1) == 'f' ))
            {
                $sender_number =	$this->substring($sender_number, 0,$this->strlen($sender_number)-1);
            }
            //if (sender_typeOfAddress == 91)
            //{
            //	$sender_number = "+" + $sender_number;
            //}
            $start += $sender_addressLength;

            $tp_PID = $this->substr($pduString, $start,2);
            $start +=2;

            $tp_DCS = $this->substr($pduString, $start,2);
            $tp_DCS_desc = $this->tpDCSMeaning($tp_DCS);
            $start +=2;

            $ValidityPeriod = "";
            switch( ($this->HexToNum($firstOctet_SMSDeliver) & 0x18) )
            {
                case 0: // Not Present
                    $ValidityPeriod = "Not Present";
                    break;
                case 0x10: // Relative
                    $ValidityPeriod = "Rel " . $this->cValid( $this->HexToNum($this->substr($pduString,$start,2)));
                    $start +=2;
                    break;
                case 0x08: // Enhanced
                    $ValidityPeriod = "Enhanced - Not Decoded";
                    $start +=14;
                    break;
                case 0x18: // Absolute
                    $ValidityPeriod = "Absolute - Not Decoded";
                    $start +=14;
                    break;
            }

// Commonish...
            $messageLength = $this->HexToNum($this->substr($pduString,$start,2));

            //print_r(array('$messageLength'=>$messageLength,'hex'=>$this->substr($pduString,$start,2),'$start'=>$start));

            $start += 2;

            $bitSize = $this->DCS_Bits($tp_DCS);
            $userData = "Undefined format";
            $skip_characters = 0;

            //print_r(array('$bitSize'=>$bitSize));

            if (($bitSize == 7 || $bitSize == 16) && $UserDataHeader)
            {
                $ud_len = $this->HexToNum($this->substr($pduString,$start,2));

                //print_r(array('$ud_len'=>$ud_len,'$start'=>$start));

                $UserDataHeader = "";
                for ($i = 0; $i <= $ud_len; $i++)
                    $UserDataHeader .= $this->substr($pduString, $start +$i *2, 2) ." ";

                if ($bitSize == 7) {
                    $skip_characters = ((($ud_len + 1) * 8) + 6) / 7;
                    $skipBits = (($ud_len + 1) * 8) + ((7 - (($ud_len + 1) * 8) % 7) % 7);
                }
                else {
                    $skip_characters = ($ud_len +1) /2;
                }

                //print_r(array('$skipBits'=>$skipBits,'$ud_len'=>$ud_len,'$start'=>$start,'$skip_characters'=>$skip_characters));
            }

            if ($bitSize==7)
            {
                $userData = $this->getUserMessage($skip_characters, $this->substr($pduString, $start,$this->strlen($pduString)-$start),$messageLength);

                //print_r(array('$userData'=>$userData,'$start'=>$start,'$skip_characters'=>$skip_characters,'substr'=>$this->substr($pduString, $start,$this->strlen($pduString)-$start)));

            }
            else if ($bitSize==8)
            {
                $userData = $this->getUserMessage8($skip_characters, $this->substr($pduString, $start,$this->strlen($pduString)-$start),$messageLength);

                for ($i = 0; $i < $this->strlen($userData);$i++)
                {
                    if ($this->substr($userData,$i, 1) >= ' '){
                        $hex_dump[] = array('hex' => $this->intToHex($this->charCodeAt($userData,$i)),'pointer' => $this->substr($userData,$i, 1));
                    }else{
                        $hex_dump[] = array('hex' => $this->intToHex($this->charCodeAt($userData,$i)),'pointer' => '.');
                    }
                }

            }
            else if ($bitSize==16)
            {
                $userData = $this->getUserMessage16($skip_characters, $this->substr($pduString,$start,$this->strlen($pduString)-$start),$messageLength);
            }

            $userData = $this->substr($userData,0,$messageLength);
            if ($bitSize==16)
            {
                $messageLength/=2;
            }

            $out['smsc'] = $SMSC_Number;
            $out['recipient'] = $sender_number;
            $out['toa'] = $sender_typeOfAddress;
            $out['numberingPlan'] = $this->explain_toa($sender_typeOfAddress);
            $out['validity'] = $ValidityPeriod;
            $out['tpPid'] = $tp_PID;
            $out['tpDcs'] = $tp_DCS;
            $out['tpDcsDesc'] = $tp_DCS_desc;

            if ($UserDataHeader != ''){
                $out['userDataHeader'] =  $UserDataHeader;
            }



            $out['encoding'] = mb_detect_encoding($userData);
            $out['length']   = $messageLength;
            $out['message']  = $userData;

            if (!empty($hex_dump)){
                $out['hexadecimalDump'] = $hex_dump;
            }


        }
        else // Receive Message
            if (($this->HexToNum($firstOctet_SMSDeliver) & 0x03) == 0) // Receive Message
            {
                $out['smsDeliver'] = 'receive';

                if (($this->HexToNum($firstOctet_SMSDeliver) & 0x20) == 0x20)
                    $rr = "yes";
                else
                    $rr = "no";

                $out['receiptRequested'] = $rr;
                // length in decimals
                $sender_addressLength = $this->HexToNum($this->substr($pduString, $start,2));

                $start = $start + 2;

                $sender_typeOfAddress = $this->substr($pduString, $start,2);
                $start = $start + 2;

                $sender_number = '';
                if ($sender_typeOfAddress == "D0")
                {
                    $_sl = $sender_addressLength;

                    if($sender_addressLength%2 != 0)
                    {
                        $sender_addressLength +=1;
                    }

                    $sender_number = $this->getUserMessage(0, $this->substring($pduString,$start,$start+$sender_addressLength),$this->parseInt($_sl/2*8/7));


                }
                else
                {

                    if($sender_addressLength%2 != 0)
                    {
                        $sender_addressLength +=1;
                    }

                    $sender_number = $this->semiOctetToString($this->substring($pduString, $start,$start+$sender_addressLength));

                    if(($this->substr($sender_number,$this->strlen($sender_number)-1,1) == 'F') || ($this->substr($sender_number,$this->strlen($sender_number)-1,1) == 'f' ))
                    {
                        $sender_number =	$this->substring($sender_number,0,$this->strlen($sender_number)-1);
                    }
                    //if (sender_typeOfAddress == 91)
                    //{
                    //	$sender_number = "+" + $sender_number;
                    //}
                }
                $start +=$sender_addressLength;

                $tp_PID = $this->substr($pduString, $start,2);
                $start +=2;

                $tp_DCS = $this->substr($pduString,$start,2);
                $tp_DCS_desc = $this->tpDCSMeaning($tp_DCS);
                $start +=2;

                $timeStamp = $this->semiOctetToString($this->substr($pduString, $start,14));

                print_r(array('timestamp'=>$this->substr($pduString, $start,14)));


                // get date
                $year = $this->substring($timeStamp,0,2);
                $month = $this->substring($timeStamp,2,4);
                $day = $this->substring($timeStamp,4,6);
                $hours = $this->substring($timeStamp,6,8);
                $minutes = $this->substring($timeStamp,8,10);
                $seconds = $this->substring($timeStamp,10,12);
                $timezone = $this->substring($timeStamp,12,14);

                print_r(array('$year'=>$year,'$month'=>$month,'$day'=>$day,'$hours'=>$hours,'$minutes'=>$minutes,'$seconds'=>$seconds,'$timezone'=>$timezone));

                //$timeStamp = $day . "/" . $month . "/" . $year . " " . $hours . ":" . $minutes . ":" . $seconds . " GMT " .$this->decode_timezone($timezone);
                $timeStamp = new \DateTime($year. '-' . $month . '-' . $day . ' ' . $hours . ':' . $minutes . ':' . $seconds. ' GMT');

                $start +=14;

// Commonish...
                $messageLength = $this->HexToNum($this->substr($pduString, $start,2));
                $start += 2;

                $bitSize = $this->DCS_Bits($tp_DCS);
                $userData = "Undefined format";
                $skip_characters = 0;

                //print_r(array('$bitSize'=>$bitSize));

                if (($bitSize == 7 || $bitSize == 16) && $UserDataHeader)
                {
                    $ud_len = $this->HexToNum($this->substr($pduString,$start,2));

                    $UserDataHeader = "";
                    for ($i = 0; $i <= $ud_len; $i++)
                        $UserDataHeader .= $this->substr($pduString,$start +$i *2, 2) ." ";

                    if ($bitSize == 7)
                        $skip_characters = ((($ud_len + 1) * 8) + 6) / 7;
                    else
                        $skip_characters = ($ud_len +1) /2;

                }

                if ($bitSize==7)
                {
                    $userData = $this->getUserMessage($skip_characters, $this->substr($pduString,$start,$this->strlen($pduString)-$start),$messageLength);

                    //print_r(array('$userData'=>$userData,'$start'=>$start,'$skip_characters'=>$skip_characters,'substr'=>$this->substr($pduString, $start,$this->strlen($pduString)-$start)));
                }
                else if ($bitSize==8)
                {
                    $userData = $this->getUserMessage8($skip_characters, $this->substr($pduString,$start,$this->strlen($pduString)-$start),$messageLength);

                    for ($i = 0; $i < $this->strlen($userData);$i++)
                    {
                        if ($this->substr($userData,$i, 1) >= ' '){
                            $hex_dump[] = array('hex' => $this->intToHex($this->charCodeAt($userData,$i)),'pointer' => $userData);
                        }else{
                            $hex_dump[] = array('hex' => $this->intToHex($this->charCodeAt($userData,$i)),'pointer' => '.');

                        }

                    }

                }
                else if ($bitSize==16)
                {
                    $userData = $this->getUserMessage16($skip_characters, $this->substr($pduString,$start,$this->strlen($pduString)-$start),$messageLength);
                }

                $userData = $this->substr($userData,0,$messageLength);

                if ($bitSize==16)
                {
                    $messageLength/=2;
                }

                $out['smsc']                = $SMSC_Number;
                $out['number']              = $sender_number;
                $out['toa']                 = $sender_typeOfAddress." ".$this->explain_toa($sender_typeOfAddress);
                $out['timeStamp']           = $timeStamp;
                $out['timeStampTimeZone']   = $this->decode_timezone($timezone);
                $out['tpPid']              = $tp_PID;
                $out['tpDcs']              = $tp_DCS;
                $out['tpDcsDesc']         = $tp_DCS_desc;

                if ($UserDataHeader != ""){
                    $out['userDataHeader'] = $UserDataHeader;
                }



                $out['encoding'] = mb_detect_encoding($userData);
                $out['length']   = $messageLength;
                $out['message']  = $userData;

                if (!empty($hex_dump)){
                    $out['hexadecimalDump'] = $hex_dump;
                }

            }
            else
            {
                $out[] =  "SMS STATUS REPORT";

                $MessageReference = $this->HexToNum($this->substr($pduString,$start,2)); // ??? Correct this name
                $start = $start + 2;

                // length in decimals
                $sender_addressLength = $this->HexToNum($this->substr($pduString,$start,2));
                if($sender_addressLength%2 != 0)
                {
                    $sender_addressLength +=1;
                }
                $start = $start + 2;

                $sender_typeOfAddress = $this->substr($pduString,$start,2);
                $start = $start + 2;

                $sender_number = $this->semiOctetToString($this->substring($pduString,$start,$start+$sender_addressLength));

                if(($this->substr($sender_number, $this->strlen($sender_number)-1,1) == 'F') || ($this->substr($sender_number, $this->strlen($sender_number)-1,1) == 'f' ))
                {
                    $sender_number =	$this->substring($sender_number,0,$this->strlen($sender_number)-1);
                }
                //if (sender_typeOfAddress == 91)
                //{
                //	$sender_number = "+" + $sender_number;
                //}
                $start +=$sender_addressLength;

                $timeStamp = $this->semiOctetToString($this->substr($pduString,$start,14));

                // get date
                $year = $this->substring($timeStamp,0,2);
                $month = $this->substring($timeStamp,2,4);
                $day = $this->substring($timeStamp,4,6);
                $hours = $this->substring($timeStamp,6,8);
                $minutes = $this->substring($timeStamp,8,10);
                $seconds = $this->substring($timeStamp,10,12);
                $timezone = $this->substring($timeStamp,12,14);

                //$timeStamp = $day . "/" . $month . "/" . $year . " " . $hours . ":" . $minutes . ":" . $seconds . " GMT " .$this->decode_timezone($timezone);
                $timeStamp = new \DateTime($year. '-' . $month . '-' . $day . ' ' . $hours . ':' . $minutes . ':' . $seconds. ' GMT');
                $start +=14;

                $timeStamp2 = $this->semiOctetToString($this->substr($pduString,$start,14));

                // get date
                $year2 = $this->substring($timeStamp2,0,2);
                $month2 = $this->substring($timeStamp2,2,4);
                $day2 = $this->substring($timeStamp2,4,6);
                $hours2 = $this->substring($timeStamp2,6,8);
                $minutes2 = $this->substring($timeStamp2,8,10);
                $seconds2 = $this->substring($timeStamp2,10,12);
                $timezone2 = $this->substring($timeStamp2,12,14);

                //$timeStamp2 = $day2 . "/" . $month2 . "/" . $year2 . " " . $hours2 . ":" . $minutes2 . ":" . $seconds2 . " GMT " .$this->decode_timezone($timezone2);
                $timeStamp = new \DateTime($year2. '-' . $month2 . '-' . $day2 . ' ' . $hours2 . ':' . $minutes2 . ':' . $seconds2. ' GMT');
                $start +=14;

                $mStatus = $this->substr($pduString,$start,2);

                $out['smsc']                       = $SMSC_Number;
                $out['number']                     = $sender_number;
                $out['toa']                        = $sender_typeOfAddress." ".$this->explain_toa($sender_typeOfAddress);
                $out['messageRef']                 = $MessageReference;
                $out['timeStamp']                  = $timeStamp;
                $out['timeStampTimeZone']          = $this->decode_timezone($timezone);
                $out['dischargeTimestamp']         = $timeStamp2;
                $out['dischargeTimestampTimeZone'] = $this->decode_timezone($timezone2);
                $out['status']                     = $mStatus ." " .$this->explain_status($mStatus);

            }

        $out['message'] = strip_tags($out['message']);
        return $out;
    }

    /*public function filter($string){
        return str_replace(
            array('á', 'í', 'ó', 'ú', 'À', 'À', 'È', 'Ì', 'Í', 'Ò', 'Ó', 'Ù', 'Ú', '\f', '[', ']', '{', '}', '`', '|', '\\', '~', '^', '€'),
            array('à', 'ì', 'ò', 'ù', 'A', 'A', 'E', 'I', 'I', 'O', 'O', 'U', 'U',  '', '(', ')', '(', ')', '\'', '', '', '', '', 'Euro'),
            $string
        );
    }*/

    public function filter($string){
        return str_replace(
            array('á', 'í', 'ó', 'ú', 'À', 'À', 'È', 'Ì', 'Í', 'Ò', 'Ó', 'Ù', 'Ú'),
            array('à', 'ì', 'ò', 'ù', 'A', 'A', 'E', 'I', 'I', 'O', 'O', 'U', 'U'),
            $string
        );
    }

    public function textToPduSingle($params) // AJA fixed SMSC processing
    {
        $params         = (object)$params;
        $message        = (isset($params->message)) ? ($params->message) : null;
        $receiver       = (isset($params->number)) ? $params->number : null;
        $smsc           = (isset($params->smsc)) ? $params->smsc : null;
        $alphabetSize   = (isset($params->alphabetSize)) ? $params->alphabetSize : null;
        $class          = (isset($params->class)) ? $params->class : null;
        $typeOfAddress  = (isset($params->typeOfAddress)) ? $params->typeOfAddress : null;
        $validity       = (isset($params->validity)) ? $params->validity : null;
        $receipt        = (isset($params->receipt)) ? $params->receipt : false;

        $octetFirst = "";
        $octetSecond = "";
        $output = "";

        //Make header
        $smsInfoLength = 0;
        $smsLength = 0;
        $smsNumberFormat = "";
        $smscNumber = "";

        if ($smsc != null){
            $smsNumberFormat = "81"; // national

            if ($this->substr($smsc,0,1) == '+'){
                $smsNumberFormat = "91"; // international
                $smsc = $this->substr($smsc,1);
            }else if ($this->substr($smsc,0,1) !='0'){
                $smsNumberFormat = "91"; // international
            }
            if($this->strlen($smsc) % 2 != 0){
                // add trailing F
                $smsc .= "F";
            }
            $smscNumber = $this->semiOctetToString($smsc);
            $smsInfoLength = ($this->strlen(($smsNumberFormat . "" . $smscNumber)))/2;
            $smsLength = $smsInfoLength;
        }

        if($smsInfoLength < 10){
            $smsInfoLength = "0" . $smsInfoLength;
        }


        $firstOctet = ''; // = "1100";

        if ($receipt){
            if ($validity){
                $firstOctet = "3100"; // 18 is mask for validity period // 10 indicates relative
            }else{
                $firstOctet = "2100";
            }
        }else{
            if ($validity){
                $firstOctet = "1100";
            }else{
                $firstOctet = "0100";
            }
        }

        $receiverNumberFormat = "81"; // (national) 81 is "unknown"
        if ($this->substr($receiver,0,1) == '+'){
            $receiverNumberFormat = "91"; // international
            $receiver = $this->substr($receiver,1); //,$$phoneNumber.length-1);
        }else if ($this->substr($receiver,0,1) !='0'){
            $receiverNumberFormat = "91"; // international
        }

        switch ($typeOfAddress)
        {
            case "145":
                $receiverNumberFormat = "91"; // international
                break;

            case "161":
                $receiverNumberFormat = "A1"; // national
                break;

            case "129":
                $receiverNumberFormat = "81"; // unknown
                break;
        }

        $receiverNumberFormat = (isset($params->receiverFormat)) ? $params->receiverFormat : $receiverNumberFormat;

        $receiverNumberLength = $this->intToHex($this->strlen($receiver));




        if($this->strlen($receiver)%2 != 0)
        {
            // add trailing F
            $receiver .= "F";
        }

        $receiverNumber = $this->semiOctetToString($receiver);



        $protoId = "00";
        $DCS=0;
        if ($class != -1) // AJA
        {
            $DCS = $class | 0x10;
        }
        switch($alphabetSize)
        {
            case 7:
                break;
            case 8:
                $DCS = $DCS | 4;
                break;
            case 16:
                $DCS = $DCS | 8;
                break;
            default:
                return "Invalid Alphabet Size";
        }



        $dataEncoding = $this->intToHex($DCS);


        //  $dataEncoding = "00"; // Default
        //  if ($alphabetSize == 8)
        //  {
        //      DATA_ENCODING = "04";
        //  }
        //  else if ($alphabetSize == 16)
        //  {
        //      DATA_ENCODING = "08";
        //  }

        $validPeriod = ""; // AA
        if ($validity)
        {
            $validPeriod = $this->intToHex($validity); // AA
        }


        $userDataSize = null;

        if ($alphabetSize == 7){

            $tmp = preg_split('//u', $message, -1, PREG_SPLIT_NO_EMPTY);
            $inpStr = "";

            for ($i = 0; $i < count($tmp); $i++){
                if ($this->getSevenBitExt($tmp[$i])){
                    $inpStr .= Utf8::unicodeToUtf8(array(0x1B));
                }
                $inpStr .= $tmp[$i];
            }

            $inpStr = preg_split('//u', $this->substring($inpStr, 0, $this->maxChars), -1, PREG_SPLIT_NO_EMPTY);
            $countInpStr = count($inpStr);

            $userDataSize = $this->intToHex($countInpStr);

            print_r(array('$userDataSize'=>$countInpStr));

            for ( $i = 0; $i <= $countInpStr; $i++){

                if ($i == $countInpStr){
                    if ($octetSecond != "") {// AJA Fix overshoot
                        $output .= "" . $this->intToHex($this->binToInt($octetSecond));
                    }
                    break;
                }

                //var current = intToBin(getSevenBit(inpStr.charAt(i)),7);
                //console.log(inpStr.charAt(i) + ' == ' + String.fromCharCode(0x1B));

                if ($inpStr[$i] == Utf8::unicodeToUtf8(array(0x1B))){
                    $current = $this->intToBin(0x1B,7);
                }else{

                    $chr = $this->getSevenBitExt($inpStr[$i]);

                    if ($chr == 0){
                        $chr = $this->getSevenBit($inpStr[$i]);
                    }

                    $current = $this->intToBin($chr,7);
                }

                $currentOctet = '';
                if( $i != 0 && $i % 8 != 0){
                    $octetFirst = $this->substring($current, 7 - ($i) %8 );
                    $currentOctet = $octetFirst . $octetSecond; //put octet parts together

                    $output .= "" . $this->intToHex($this->binToInt($currentOctet));
                    $octetSecond = $this->substring($current, 0, 7 - ($i) %8);  //set net second octet
                }else{
                    $octetSecond = $this->substring($current,0, 7 - ($i) % 8);
                }

            }
            //encodeGSM7bitPacked(inpString);
        }else if ($alphabetSize == 8){

            $userDataSize = $this->intToHex($this->strlen($message));

            $CurrentByte = 0;

            $explode = preg_split('//u', $message, -1, PREG_SPLIT_NO_EMPTY);

            for($i = 0; $i < count($explode); $i++){
                $CurrentByte = $this->getEightBit($this->charCodeAt($explode,$i));

                //TODO compare to the orginal version
                //$output = "" . ( $this->ToHex( $CurrentByte ) );
                $output .= $this->ToHex( $CurrentByte );
            }

        }else if ($alphabetSize == 16){

            $userDataSize = $this->intToHex($this->strlen($message) * 2);

            $myChar = 0;

            $explode = preg_split('//u', $message, -1, PREG_SPLIT_NO_EMPTY);

            for($i = 0; $i < count($explode); $i++){
                $myChar = $this->get16Bit( $this->charCodeAt($explode,$i) );
                $output .= "" .  $this->ToHex( ( $myChar & 0xff00 ) >> 8 ) . $this->ToHex( $myChar & 0xff );
            }

        }

        $header = array(
            $smsInfoLength,
            $smsNumberFormat,
            $smscNumber,
            $firstOctet,
            $receiverNumberLength,
            $receiverNumberFormat,
            $receiverNumber,
            $protoId,
            $dataEncoding,
            $validPeriod,
            $userDataSize
        );

        //print_r($header);

        $pdu = implode('',$header) . $output;
        return array(
            'byte_size' => ($this->strlen($pdu)/2 - $smsLength - 1),
            'message' => $pdu,
        );

    }

    public function textToPduMultiple($params) // AJA fixed SMSC processing
    {
        $params         = (object)$params;
        $message        = (isset($params->message)) ? ($params->message) : null;
        $receiver       = (isset($params->number)) ? $params->number : null;
        $smsc           = (isset($params->smsc)) ? $params->smsc : null;
        $alphabetSize   = (isset($params->alphabetSize)) ? $params->alphabetSize : null;
        $class          = (isset($params->class)) ? $params->class : null;
        $typeOfAddress  = (isset($params->typeOfAddress)) ? $params->typeOfAddress : null;
        $validity       = (isset($params->validity)) ? $params->validity : null;
        $receipt        = (isset($params->receipt)) ? $params->receipt : false;

        $udh            = (isset($params->udh)) ? $params->udh : '';

        $octetFirst = "";
        $octetSecond = "";
        $output = "";

        //Make header
        $smsInfoLength = 0;
        $smsLength = 0;
        $smsNumberFormat = "";
        $smscNumber = "";

        if ($smsc != null){
            $smsNumberFormat = "81"; // national

            if ($this->substr($smsc,0,1) == '+'){
                $smsNumberFormat = "91"; // international
                $smsc = $this->substr($smsc,1);
            }else if ($this->substr($smsc,0,1) !='0'){
                $smsNumberFormat = "91"; // international
            }
            if($this->strlen($smsc) % 2 != 0){
                // add trailing F
                $smsc .= "F";
            }
            $smscNumber = $this->semiOctetToString($smsc);
            $smsInfoLength = ($this->strlen(($smsNumberFormat . "" . $smscNumber)))/2;
            $smsLength = $smsInfoLength;
        }

        if($smsInfoLength < 10){
            $smsInfoLength = "0" . $smsInfoLength;
        }


        $firstOctet = ''; // = "1100";

        if ($receipt){
            if ($validity){
                $firstOctet = "3100"; // 18 is mask for validity period // 10 indicates relative
            }else{
                $firstOctet = "2100";
            }
        }else{
            if ($validity){
                $firstOctet = "1100";
            }else{
                $firstOctet = "0100";
            }
        }

        if($udh) {
            $firstOctet = "4100";
            $ud_len = $this->HexToNum($this->substr($udh,0,2));
            $skipBits = (($ud_len + 1) * 8) + ((7 - (($ud_len + 1) * 8) % 7) % 7);

            //print_r(array('$firstOctet'=>$firstOctet,'$ud_len'=>$ud_len,'$skipBits'=>$skipBits));
        }

        $receiverNumberFormat = "81"; // (national) 81 is "unknown"
        if ($this->substr($receiver,0,1) == '+'){
            $receiverNumberFormat = "91"; // international
            $receiver = $this->substr($receiver,1); //,$$phoneNumber.length-1);
        }else if ($this->substr($receiver,0,1) !='0'){
            $receiverNumberFormat = "91"; // international
        }

        switch ($typeOfAddress)
        {
            case "145":
                $receiverNumberFormat = "91"; // international
                break;

            case "161":
                $receiverNumberFormat = "A1"; // national
                break;

            case "129":
                $receiverNumberFormat = "81"; // unknown
                break;
        }


        $receiverNumberFormat = (isset($params->receiverFormat)) ? $params->receiverFormat : $receiverNumberFormat;


        $receiverNumberLength = $this->intToHex($this->strlen($receiver));




        if($this->strlen($receiver)%2 != 0)
        {
            // add trailing F
            $receiver .= "F";
        }

        $receiverNumber = $this->semiOctetToString($receiver);



        $protoId = "00";
        $DCS=0;
        if ($class != -1) // AJA
        {
            $DCS = $class | 0x10;
        }
        switch($alphabetSize)
        {
            case 7:
                break;
            case 8:
                $DCS = $DCS | 4;
                break;
            case 16:
                $DCS = $DCS | 8;
                break;
            default:
                return "Invalid Alphabet Size";
        }



        $dataEncoding = $this->intToHex($DCS);


        //	$dataEncoding = "00"; // Default
        //	if ($alphabetSize == 8)
        //	{
        //		DATA_ENCODING = "04";
        //	}
        //	else if ($alphabetSize == 16)
        //	{
        //		DATA_ENCODING = "08";
        //	}

        /*
                $year = $this->substring($timeStamp,0,2);
                $month = $this->substring($timeStamp,2,4);
                $day = $this->substring($timeStamp,4,6);
                $hours = $this->substring($timeStamp,6,8);
                $minutes = $this->substring($timeStamp,8,10);
                $seconds = $this->substring($timeStamp,10,12);
                $timezone = $this->substring($timeStamp,12,14);
        */

        $validPeriod = '';

        //$validPeriod = date('ymdHis').'32';

        if ($validity)
        {
            $validPeriod = $this->intToHex($validity); // AA
        }


        $userDataSize = null;

        if ($alphabetSize == 7){

//////
        $tmsg = '';

        //print_r();

//////
            $tmp = preg_split('//u', $message, -1, PREG_SPLIT_NO_EMPTY);
            $inpStr = "";

            //print_r(array('count($tmp)'=>count($tmp)));

            for ($i = 0; $i < count($tmp); $i++){
                if ($this->getSevenBitExt($tmp[$i])){
                    $inpStr .= Utf8::unicodeToUtf8(array(0x1B));
                }
                $inpStr .= $tmp[$i];
            }

            $inpStr = preg_split('//u', $this->substring($inpStr, 0, $this->maxChars), -1, PREG_SPLIT_NO_EMPTY);
            $countInpStr = count($inpStr);
            $userDataSize = $this->intToHex($countInpStr);

            if(!empty($udh)) {
                $dsize = $countInpStr+6;
                print_r(array('$dsize'=>$dsize));
                $userDataSize = $this->intToHex($dsize);
                //$userDataSize = $this->intToHex(158);
            }

            //print_r(array('$inpStr'=>$inpStr,'$countInpStr'=>$countInpStr,'$userDataSize'=>$userDataSize,'$countInpStr+strlen($udh)'=>$countInpStr+(strlen($udh)/2)));

//////
            /*for($i=0;$i< $this->strlen($udh);$i=$i+2){
                $hex = $this->substring($udh,$i,$i+2);

                print_r(array('$hex'=>$hex));

                $tmsg .= chr($this->HexToNum($hex));
            }*/

            //$udBool = array();

            $udBool = '';

            /*if(!empty($udh)) {
                for($i=0;$i< $this->strlen($udh);$i=$i+2){

                    $hex = $this->substring($udh,$i,$i+2);

                    $current = $this->intToBin($this->HexToNum($hex),8);

                    $udBool[] = $current;

                    //$udBool .= $current;

                    print_r(array('$i'=>$i,'$hex'=>$hex,'$current'=>$current));

                }
            }*/

            /*if(!empty($udh)) {
                for($i=0;$i< $this->strlen($udh);$i=$i+2){

                    $hex = $this->substring($udh,$i,$i+2);

                    $current = $this->intToBin($this->HexToNum($hex),7);

                    $udBool[] = $current;

                    //$udBool .= $current;

                    print_r(array('$i'=>$i,'$hex'=>$hex,'$current'=>$current));

                }
            }*/

            for ( $i = 0; $i < $countInpStr; $i++){
                $chr = $this->getSevenBitExt($inpStr[$i]);

                if ($chr == 0){
                    $chr = $this->getSevenBit($inpStr[$i]);
                }

                $current = $this->intToBin($chr,7);

                $current_8 = $this->intToBin($chr,8);

                $udBool[] = $current;

                //$udBool .= $current;

                //print_r(array('$i'=>$i,'$inpStr[$i]'=>$inpStr[$i],'$chr'=>chr($chr),'$current'=>$current,'$current_8'=>$current_8));
            }

            //print_r(array('$udBool'=>$udBool,'count($udBool)'=>count($udBool)));

            //$udBoolLength = strlen($udBool) / 8;

            $udBoolLength = count($udBool);

            //for ( $i = 0; $i <= $udBoolLength; $i++){
            //    $current = $this->substring($udBool,$i*8,($i*8)+8);
            //    print_r(array('$i'=>$i,'$current'=>$current));
            //    $output .= "" . $this->intToHex($this->binToInt($current));
            //}

            //$octetSecond = '0';

            $first = true;

            $i = 0;
            
            foreach ( $udBool as $k=>$current ){

                if ($i == $udBoolLength){
                    if ($octetSecond != "") {// AJA Fix overshoot
                        $output .= "" . $this->intToHex($this->binToInt($octetSecond));
                        //print_r(array('$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                    }
                    break;
                }

                //$current = $udBool[$i];

                if($first) {
                    $output .= "" . $this->intToHex($this->binToInt($current.'0'));
                    $first = false;

                    //print_r(array('first'=>'first','$output'=>$output,'$i'=>$i));

                    continue;
                }

                $currentOctet = '';

                //if($i==6) {
                //    $output .= "" . $this->intToHex($this->binToInt($current.$octetSecond));
                //    print_r(array('A'=>'A','$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                //} else
                if( $i != 0 && $i % 8 != 0){
                    $octetFirst = $this->substring($current, 7 - ($i) %8 );
                    $currentOctet = $octetFirst . $octetSecond; //put octet parts together

                    $output .= "" . $this->intToHex($this->binToInt($currentOctet));
                    $octetSecond = $this->substring($current, 0, 7 - ($i) %8);  //set net second octet

                    //print_r(array('B'=>'B','$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                }else{
                    $octetSecond = $this->substring($current,0, 7 - ($i) % 8);
                    //print_r(array('C'=>'C','$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                }

                $i++;

            }
            
/*
            for ( $i = 0; $i <= $udBoolLength; $i++){

                if ($i == $udBoolLength){
                    if ($octetSecond != "") {// AJA Fix overshoot
                        $output .= "" . $this->intToHex($this->binToInt($octetSecond));
                        //print_r(array('$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                    }
                    break;
                }

                $current = $udBool[$i];

                $currentOctet = '';

                //if($i==6) {
                //    $output .= "" . $this->intToHex($this->binToInt($current.$octetSecond));
                //    print_r(array('A'=>'A','$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                //} else
                if( $i != 0 && $i % 8 != 0){
                    $octetFirst = $this->substring($current, 7 - ($i) %8 );
                    $currentOctet = $octetFirst . $octetSecond; //put octet parts together

                    $output .= "" . $this->intToHex($this->binToInt($currentOctet));
                    $octetSecond = $this->substring($current, 0, 7 - ($i) %8);  //set net second octet

                    print_r(array('B'=>'B','$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                }else{
                    $octetSecond = $this->substring($current,0, 7 - ($i) % 8);
                    print_r(array('C'=>'C','$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));
                }

            }

*/

//////

            /*for ( $i = 0; $i <= $countInpStr; $i++){

                if ($i == $countInpStr){
                    if ($octetSecond != "") {// AJA Fix overshoot
                        $output .= "" . $this->intToHex($this->binToInt($octetSecond));
                    }
                    break;
                }

                //var current = intToBin(getSevenBit(inpStr.charAt(i)),7);
                //console.log(inpStr.charAt(i) + ' == ' + String.fromCharCode(0x1B));

                if ($inpStr[$i] == Utf8::unicodeToUtf8(array(0x1B))){
                    $current = $this->intToBin(0x1B,7);
                }else{

                    $chr = $this->getSevenBitExt($inpStr[$i]);

                    if ($chr == 0){
                        $chr = $this->getSevenBit($inpStr[$i]);
                    }

                    $current = $this->intToBin($chr,7);
                }

                $currentOctet = '';
                if( $i != 0 && $i % 8 != 0){
                    $octetFirst = $this->substring($current, 7 - ($i) %8 );
                    $currentOctet = $octetFirst . $octetSecond;	//put octet parts together

                    $output .= "" . $this->intToHex($this->binToInt($currentOctet));
                    $octetSecond = $this->substring($current, 0, 7 - ($i) %8);	//set net second octet
                }else{
                    $octetSecond = $this->substring($current,0, 7 - ($i) % 8);
                }

                print_r(array('$i'=>$i, '$current'=>$current, '$currentOctet'=>$currentOctet, '$octetFirst'=>$octetFirst, '$octetSecond'=>$octetSecond, '7 - ($i) % 8'=>7 - ($i) % 8,'($i) % 8'=>($i) % 8,'$output'=>$output));

            }*/
            //encodeGSM7bitPacked(inpString);
        }else if ($alphabetSize == 8){

            $userDataSize = $this->intToHex($this->strlen($message));

            $CurrentByte = 0;

            $explode = preg_split('//u', $message, -1, PREG_SPLIT_NO_EMPTY);

            for($i = 0; $i < count($explode); $i++){
                $CurrentByte = $this->getEightBit($this->charCodeAt($explode,$i));

                //TODO compare to the orginal version
                //$output = "" . ( $this->ToHex( $CurrentByte ) );
                $output .= $this->ToHex( $CurrentByte );
            }

        }else if ($alphabetSize == 16){

            $userDataSize = $this->intToHex($this->strlen($message) * 2);

            $myChar = 0;

            $explode = preg_split('//u', $message, -1, PREG_SPLIT_NO_EMPTY);

            for($i = 0; $i < count($explode); $i++){
                $myChar = $this->get16Bit( $this->charCodeAt($explode,$i) );
                $output .= "" .  $this->ToHex( ( $myChar & 0xff00 ) >> 8 ) . $this->ToHex( $myChar & 0xff );
            }

        }

        $header = array(
            $smsInfoLength,
            $smsNumberFormat,
            $smscNumber,
            $firstOctet,
            $receiverNumberLength,
            $receiverNumberFormat,
            $receiverNumber,
            $protoId,
            $dataEncoding,
            $validPeriod,
            $userDataSize
        );

        $header2 = array(
            '$smsInfoLength'=>strlen($smsInfoLength),
            '$smsNumberFormat'=>strlen($smsNumberFormat),
            '$smscNumber'=>strlen($smscNumber),
            '$firstOctet'=>strlen($firstOctet),
            '$receiverNumberLength'=>strlen($receiverNumberLength),
            '$receiverNumberFormat'=>strlen($receiverNumberFormat),
            '$receiverNumber'=>strlen($receiverNumber),
            '$protoId'=>strlen($protoId),
            '$dataEncoding'=>strlen($dataEncoding),
            '$validPeriod'=>strlen($validPeriod),
            '$userDataSize'=>strlen($userDataSize)
        );

        print_r(array('$header'=>$header));

        print_r(array('$header2'=>$header2));

        $pdu = implode('',$header) . $udh . $output;
        return array(
            'byte_size' => ($this->strlen($pdu)/2 - $smsLength - 1),
            'message' => $pdu,
        );

    }

    private function DCS_Bits($tp_DCS)
    {
        $pomDCS = $this->HexToNum($tp_DCS);

        switch (($pomDCS & 0x0C) >> 2)
        {
            case 0: return 7;
            case 1: return 8;
            case 2: return 16;
        }

        return 7;
    }

    private function DCS_Bits_OLD($tp_DCS)
    {
        $AlphabetSize=7; // Set Default
        //alert($tp_DCS);
        $pomDCS =  $this->HexToNum($tp_DCS);
        //alert($pomDCS);
        switch($pomDCS & 192)
        {
            case 0: if($pomDCS & 32)
            {
                // $tp_DCS_desc="Compressed Text\n";
            }
            else
            {
                // $tp_DCS_desc="Uncompressed Text\n";
            }
                switch($pomDCS & 12)
                {
                    case 4:
                        $AlphabetSize=8;
                        break;
                    case 8:
                        $AlphabetSize=16;
                        break;
                }
                break;
            case 192:
                switch($pomDCS & 0x30)
                {
                    case 0x20:
                        $AlphabetSize=16;
                        break;
                    case 0x30:
                        if ($pomDCS & 0x4)
                        {
                            ;
                        }
                        else
                        {
                            $AlphabetSize=8;
                        }
                        break;
                }
                break;
        }

        return($AlphabetSize);
    }

    private function tpDCSMeaning($tp_DCS){
        $tp_DCS_desc=$tp_DCS;
        $pomDCS = $this->HexToNum($tp_DCS);
        $alphabet = "";

        switch($pomDCS & 192)
        {
            case 0: if($pomDCS & 32)
            {
                $tp_DCS_desc="Compressed Text";
            }
            else
            {
                $tp_DCS_desc="Uncompressed Text";
            }
                if(!($pomDCS & 16)) // AJA
                {
                    $tp_DCS_desc .= ", No class ";
                }
                else
                {
                    $tp_DCS_desc .= ", class: ";

                    switch($pomDCS & 3)
                    {
                        case 0:
                            $tp_DCS_desc .= "0 Flash ";
                            break;
                        case 1:
                            $tp_DCS_desc .= "1 ME specific ";
                            break;
                        case 2:
                            $tp_DCS_desc .= "2 SIM specific ";
                            break;
                        case 3:
                            $tp_DCS_desc .= "3 TE specific ";
                            break;
                    }
                }

                $tp_DCS_desc  .=  "Alphabet: ";
                switch($pomDCS & 12)
                {
                    case 0:
                        $tp_DCS_desc .= "Default (7bit)";
                        break;
                    case 4:
                        $tp_DCS_desc .= "8bit";
                        break;
                    case 8:
                        $tp_DCS_desc .= "UCS2 (16bit)";
                        break;
                    case 12:
                        $tp_DCS_desc .= "Reserved";
                        break;
                }
                break;
            case 64:
            case 128:
                $tp_DCS_desc ="Reserved coding group";
                break;
            case 192:
                switch($pomDCS & 0x30)
                {
                    case 0:
                        $tp_DCS_desc ="Message waiting group: Discard Message";
                        break;
                    case 0x10:
                        $tp_DCS_desc ="Message waiting group: Store Message. Default Alphabet.";
                        break;
                    case 0x20:
                        $tp_DCS_desc ="Message waiting group: Store Message. UCS2 Alphabet.";
                        break;
                    case 0x30:
                        // 06.04.2011: $tp_DCS_desc ="Data coding message class: ";
                        $alphabet = "Alphabet: ";
                        // 06.04.2011: if ($pomDCS & 0x4)
                        if (!($pomDCS & 0x4))
                        {
                            $alphabet  .=  "Default (7bit)";
                        }
                        else
                        {
                            $alphabet  .=  "8bit";
                        }
                        break;
                }

                // 06.04.2011:
                if ($tp_DCS_desc == $tp_DCS)
                    $tp_DCS_desc = "Class: ";
                else
                    $tp_DCS_desc .=  ", class: ";

                switch($pomDCS & 3)
                {
                    case 0:
                        $tp_DCS_desc .= "0 Flash";
                        break;
                    case 1:
                        $tp_DCS_desc .= "1 ME specific";
                        break;
                    case 2:
                        $tp_DCS_desc .= "2 SIM specific";
                        break;
                    case 3:
                        $tp_DCS_desc .= "3 TE specific";
                        break;
                }
                $tp_DCS_desc  .=  $alphabet;
                // -----------

                break;

        }

        //alert($tp_DCS.valueOf());
        return($tp_DCS_desc);
    }

    private function cValid($valid)
    {
        $value = '';
        $out = "";
//	if (isNaN(parseInt($valid)))
//	{
//		alert("No text please we're British!");
//	}
        $valid = $this->parseInt($valid);

        if ($valid <= 143)
        {
            $value = ($valid+1)*5; // Minutes
        }
        else if ($valid <= 167)
        {
            $value = (($valid-143) / 2 + 12); // Hours
            $value *= 60; // Convert to Minutes
        }
        else if ($valid <= 196)
        {
            $value = $valid-166; // days
            $value *= 60*24; // Convert to Minutes
        }
        else
        {
            $value = $valid-192; // Weeks
            $value *= 7*60*24; // Convert to Minutes
        }



        $mins = $value % 60;
        $hours = $value / 60;
        $days = $hours / 24;
        $weeks = $days / 7;
        $hours %= 24;
        $days %= 7;

        if ($this->parseInt($weeks) != 0)
        {
            $out .= $this->parseInt($weeks) . "w ";
        }

        if ($this->parseInt($days) != 0)
        {
            $out .= $this->parseInt($days) . "d ";
        }

        if ($this->parseInt($hours) != 0)
        {
            $out .= $this->parseInt($hours) . "h ";
        }
        if ($mins != 0)
        {
            $out .= $mins . "m ";
        }

        return $out;
    }

}

/* INCLUDES_END */
