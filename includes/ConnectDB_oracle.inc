<?php

/* $Revision: 1.9 $ */

define ('LIKE','LIKE');

//include("adodb/adodb-exceptions.inc.php");
include('adodb/adodb.inc.php');
putenv("NLS_LANG=AMERICAN_AMERICA.EL8ISO8859P7");
$AdoDB = NewADOConnection('oci8');
$AdoDB ->NLS_DATE_FORMAT =  'RRRR-MM-DD HH24:MI:SS';
$AdoDB->Connect($host, $dbuser, $dbpassword, $dbservice);
//$AdoDB->debug = true;
$AdoDB->SetFetchMode(ADODB_FETCH_ASSOC);

//NMado $NMarkService = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = '.$host.')(PORT = 1521))(CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = '.$dbservice.') ) )';

//--$db = mysql_connect($host , $dbuser, $dbpassword);
//NMado $db = ocilogon($dbuser, $dbpassword, $NMarkService);

//NMado if ( !$db ) {
if ( !$AdoDB ) {
	echo '<BR>' . _('The configuration in the file config.php for the database user name and password do not provide the information required to connect to the database server');
	exit;
}

// Απαραίτητο για την υποστήριξη των ελληνικών....
//--mysql_query("SET NAMES greek",$db);
//--mysql_query("SET character_set_connection=greek");
//--mysql_query("SET character_set_client=greek");

//--if (! mysql_select_db($_SESSION['DatabaseName'],$db)) {
//--	echo '<BR>' . _('The company name entered does not correspond to a database on the database server specified in the config.php configuration file. Try logging in with a different company name');
//--	echo '<BR><A HREF="index.php">' . _('Back to login page') . '</A>';
//--	unset ($_SESSION['DatabaseName']);
//--	exit;
//--}

require_once ('includes/MiscFunctions.php');

if (!defined('CASE_UPPER')) define('CASE_UPPER', 1);
if (!defined('CASE_LOWER')) define('CASE_LOWER', 2);
if (!defined('CASE_FIRST')) define('CASE_FIRST', 3);

function array_key_case_change(&$array, $mode = CASE_FIRST) {

	// Make sure $array is really an array
	if (!is_array($array)) return false;

	$temp = $array;
	while (list($key, $value) = each($temp)) {
		// First we unset the original so it's not lingering about
		unset($array[$key]);

		// Then modify the $key
		switch($mode) {
			case CASE_UPPER:
				$key = strtoupper($key);
				break;
			case CASE_LOWER:
				$key = strtolower($key);
				break;
			case CASE_FIRST:
				$key = ucfirst(strtolower($key));
				break;
		}

		// Lastly readd to the array using the new $key
		$array[$key] = $value;
	}
	return true;
}


function DB_query ($SQL,&$Conn,$ErrorMessage='',$DebugMessage= '',$Transaction=false,$TrapErrors=true){

	global $debug,$_SESSION,$AdoDB;

	//$cursor = ociparse($Conn, $SQL );

	$recordset = $AdoDB->Execute($SQL);


	//$_SESSION['OracleCursor'] = $cursor;

	//$result=mysql_query($SQL,$Conn);

	if ($DebugMessage == '') {
		$DebugMessage = _('The SQL that failed was');
	}

	if (DB_error_no($AdoDB) != 0 AND DB_error_no($AdoDB) != 1403 AND $TrapErrors==true){
		if ($TrapErrors){
//			require_once('includes/header.inc');
		}
		prnMsg($ErrorMessage.'<BR>' .DB_error_no($AdoDB).' - '.DB_error_msg($AdoDB),'error', _('Database Error'));
		if ($debug==1){
			prnMsg($DebugMessage. "<BR>$SQL<BR>",'error',_('Database SQL Failure'));
		}
		if ($Transaction){
			$SQL = 'rollback';
			$Result = DB_query($SQL,$Conn);
			if (DB_error_no($AdoDB) !=0){
				prnMsg(_('Error Rolling Back Transaction'), '', _('Database Rollback Error') );
			}
		}
		if ($TrapErrors){
			include('includes/footer.inc');
			exit;
		}
	}
	/*	else { // Αν δεν υπάρχει λάθος...

	//ocisetprefetch($cursor, $_SESSION[ 'setsize' ]);

	if (is_array($bind)) {
	foreach ($bind as $fieldname => $value) {
	ocibindbyname($cursor, ':' . $fieldname, $bind[ $fieldname ], -1);
	}
	}

	//$ok = ociexecute($cursor, OCI_COMMIT_ON_SUCCESS);
	//ocifetchstatement($cursor,$tab_result);
	//ociexecute($cursor, OCI_COMMIT_ON_SUCCESS);
	//OCIExecute ($statement, OCI_DEFAULT);

	if (! $ok)
	{ $err = ocierror($cursor);

	if (is_array($err))
	prnMsg($ErrorMessage.'<BR>' . DB_error_msg($Conn),'error', _('Database Error'));

	if ($cursor) ocifreestatement($cursor);

	$cursor = false;
	}

	}*/


	return $recordset;

}

function DB_query_limit ($SQL,&$Conn,$LimitStart=0,	$LimitEnd=0,$ErrorMessage='',$DebugMessage= '',$Transaction=false,$TrapErrors=true){

	global $debug,$_SESSION,$AdoDB;

	//$cursor = ociparse($Conn, $SQL );

	//echo $LimitStart."-".$LimitEnd;

	//$recordset = $AdoDB->Execute($SQL);
	$recordset = $AdoDB->SelectLimit($SQL,$LimitEnd,$LimitStart);


	//$_SESSION['OracleCursor'] = $cursor;

	//$result=mysql_query($SQL,$Conn);

	if ($DebugMessage == '') {
		$DebugMessage = _('The SQL that failed was');
	}

	if (DB_error_no($AdoDB) != 0 AND DB_error_no($AdoDB) != 1403 AND $TrapErrors==true){
		if ($TrapErrors){
//			require_once('includes/header.inc');
		}
		prnMsg($ErrorMessage.'<BR>' .DB_error_no($AdoDB).' - '.DB_error_msg($AdoDB),'error', _('Database Error'));
		if ($debug==1){
			prnMsg($DebugMessage. "<BR>$SQL<BR>",'error',_('Database SQL Failure'));
		}
		if ($Transaction){
			$SQL = 'rollback';
			$Result = DB_query($SQL,$Conn);
			if (DB_error_no($AdoDB) !=0){
				prnMsg(_('Error Rolling Back Transaction'), '', _('Database Rollback Error') );
			}
		}
		if ($TrapErrors){
			include('includes/footer.inc');
			exit;
		}
	}


	return $recordset;

}



function DB_fetch_array_assoc (&$ResultIndex, $assoc) {

	//$RowPointer=mysql_fetch_array($ResultIndex, $assoc);
	//Return $RowPointer;
	$RowPointer=$ResultIndex->FetchRow();
	Return $RowPointer;
}

function DB_fetch_field (&$ResultIndex, $offset) {

	//NMAdo $Result=mysql_fetch_field($ResultIndex, $offset);
	$Result=$ResultIndex->FetchField($offset);
	Return $Result;
}

function DB_num_fields (&$ResultIndex){

	//NMAdo return oci_num_fields($_SESSION['OracleCursor']);
	//return mysql_num_fields($ResultIndex);
	return $ResultIndex->FieldCount();
}


function DB_fetch_row (&$ResultIndex) {

	//$RowPointer=mysql_fetch_row($ResultIndex);

	//NMAdo if ( OCIFetchInto ( $ResultIndex, $row, OCI_NUM + OCI_RETURN_NULLS  ) )
	//NMAdo      return $row;

	//NMAdo     return 0;

	$arr = $ResultIndex->FetchRow();

	return $arr;

	//Return $RowPointer;
}

function DB_fetch_array (&$ResultIndex) {

	//NMado $RowPointer=mysql_fetch_array($ResultIndex);
	$RowPointer=$ResultIndex->FetchRow();
	Return $RowPointer;
}

function DB_data_seek (&$ResultIndex,$Record) {
	mysql_data_seek($ResultIndex,$Record);
}

function DB_free_result (&$ResultIndex){
	//mysql_free_result($ResultIndex);

	//NMAdo if ( $_SESSION['OracleCursor'] >= 0 ) {
	//NMAdo   OCIFreeStatement ( $_SESSION['OracleCursor'] );
	//NMAdo   $_SESSION['OracleCursor'] = -1;
	//NMAdo }

	$ResultIndex->Free();

}

function DB_num_rows (&$ResultIndex){

	global $AdoDB;

	//return mysql_num_rows($ResultIndex);
	//NMAdo $res = OCIFetchstatement($ResultIndex,$results);
	//NMAdo $ok = ociexecute($ResultIndex, OCI_COMMIT_ON_SUCCESS);
	return $ResultIndex->RecordCount();
	//NMAdo return $res;
	//return ocirowcount($ResultIndex);

}

function DB_error_no (&$Conn){

	global $AdoDB;
	//NMAdo $temp = ocierror($Conn);
	//NMAdo return $temp['code'];
	return $AdoDB->ErrorNo();
}

function DB_error_msg(&$Conn){
	//NMAdo $temp = ocierror($Conn);
	//NMAdo return $temp['message'];
	global $AdoDB;
	return $AdoDB->ErrorMsg();

}

function DB_Last_Insert_ID(&$Conn,$table, $fieldname,$sequence=''){
	//return mysql_insert_id($Conn);

	//echo 'select '.$sequence.'.currval as id from dual';
	$sql='select '.$sequence.'.currval as id from dual';
	//echo $sql;
	$Result=DB_query($sql,$Conn,'','',false,false);
	$mydrow=DB_fetch_array($Result);
	return $mydrow['ID'];
	//global $AdoDB;
	//return $AdoDB->Insert_ID($table,$fieldname);
	//return $Conn->Insert_ID($table,$fieldname);
}

function DB_Next_Insert_ID(&$Conn,$table, $fieldname,$sequence=''){
	//return mysql_insert_id($Conn);

	//echo 'select '.$sequence.'.currval as id from dual';
	$Result=DB_query('select '.$sequence.'.nextval as id from dual',$Conn,'','',false,false);
	$mydrow=DB_fetch_array($Result);
	return $mydrow['ID'];
	//global $AdoDB;
	//return $AdoDB->Insert_ID($table,$fieldname);
	//return $Conn->Insert_ID($table,$fieldname);
}

function DB_escape_string($String){
	Return mysql_escape_string($String);
}


function INTERVAL( $val, $Inter ){
	global $dbtype;
	return "\n".'INTERVAL ' . $val . ' '. $Inter."\n";
}

function DB_Maintenance($Conn){

	prnMsg(_('The system has just run the regular database administration and optimisation routine.'),'info');

	$TablesResult = DB_query('SHOW TABLES',$Conn);
	while ($myrow = DB_fetch_row($TablesResult)){
		$Result = DB_query('OPTIMIZE TABLE ' . $myrow[0],$Conn);
	}

	$Result = DB_query('UPDATE config
				SET confvalue="' . Date('Y-m-d') . '" 
				WHERE confname="DB_Maintenance_LastRun"',
	$Conn);
}

function DB_Quoted($myStr){

	$myStr=str_replace("'","''",$myStr);
	$myStr=str_replace("\\","",$myStr);
	//return "'".stripslashes($myStr)."'";

	return "'".$myStr."'";

}


function DB_Exec_StoredProc ($SQL,$inArray,&$outArray,
&$Conn,
$ErrorMessage='',
$DebugMessage= '',
$Transaction=false,
$TrapErrors=true){

	global $debug,$_SESSION,$AdoDB;


	$sth=$AdoDB->PrepareSP($SQL);

	foreach ($inArray as $k => $v) {

		$AdoDB->InParameter($sth,$v,$k,64);
	}

	foreach ($outArray as $k => $v) {

		$AdoDB->OutParameter($sth,$v,$k);
	}

	$recordset = $AdoDB->Execute($sth);


	if ($DebugMessage == '') {
		$DebugMessage = _('The SQL that failed was');
	}

	if (DB_error_no($AdoDB) != 0 AND DB_error_no($AdoDB) != 1403 AND $TrapErrors==true){
		if ($TrapErrors){
//			require_once('includes/header.inc');
		}
		prnMsg($ErrorMessage.'<BR>' .DB_error_no($AdoDB).' - '.DB_error_msg($AdoDB),'error', _('Database Error'));
		if ($debug==1){
			prnMsg($DebugMessage. "<BR>$SQL<BR>",'error',_('Database SQL Failure'));
		}
		if ($Transaction){
			$SQL = 'rollback';
			$Result = DB_query($SQL,$Conn);
			if (DB_error_no($AdoDB) !=0){
				prnMsg(_('Error Rolling Back Transaction'), '', _('Database Rollback Error') );
			}
		}
		if ($TrapErrors){
			include('includes/footer.inc');
			exit;
		}
	}



	return $recordset;

}

?>
