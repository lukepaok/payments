<?php


/********************************************/
/** STANDARD MESSAGE HANDLING & FORMATTING **/
/********************************************/

function prnMsg($msg,$type='info', $prefix=''){

	echo '<P>' . getMsg($msg, $type, $prefix) . '</P>';

}//prnMsg


function prnMsg1($msg,$type='info', $prefix=''){
$Colour='red';
	echo '<P><FONT COLOR="red"' . getMsg($msg, $type, $prefix) . '</FONT></P>';

}//prnMsg

function getMsg($msg,$type='info',$prefix=''){
	$Colour='';
	switch($type){
		case 'error':
			$Colour='red';
			$prefix = $prefix ? $prefix : _('ΣΦΑΛΜΑ') . ' ' ._('');
			break;
		case 'warn':
			$Colour='maroon';
			$prefix = $prefix ? $prefix : _('ΠΡΟΕΙΔΟΠΟΙΗΣΗ') . ' ' . _('');
			break;
		case 'success':
			$Colour='darkgreen';
			$prefix = $prefix ? $prefix : _('ΕΠΙΤΥΧΙΑ') . ' ' . _('');
			break;
		case 'info':
		default:
			$prefix = $prefix ? $prefix : _('ΠΛΗΡΟΦΟΡΙΑ') . ' ' ._('');
			$Colour='navy';
	}
	return '<FONT COLOR="' . $Colour . '"><B>' . $prefix . '</B> : ' .$msg . '</FONT>';
}//getMsg

function IsEmailAddress($TestEmailAddress){

/*thanks to Gavin Sharp for this regular expression to test validity of email addresses */

	if (function_exists("preg_match")){
		if(preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $TestEmailAddress)){
			return true;
		} else {
			return false;
		}
	} else {
		if (strlen($TestEmailAddress)>5 AND strstr($TestEmailAddress,'@')>2 AND (strstr($TestEmailAddress,'.co')>3 OR strstr($TestEmailAddress,'.org')>3 OR strstr($TestEmailAddress,'.net')>3 OR strstr($TestEmailAddress,'.edu')>3 OR strstr($TestEmailAddress,'.biz')>3)){
			return true;
		} else {
			return false;
		}
	}
}
?>
