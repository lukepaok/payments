<?php
session_start();
include('adodb/adodb.inc.php');

function openSQLDB(){
  extract($GLOBALS);
  if ($dbType == 'MySQL') {
    $db = NewADOConnection('mysql');
    $db -> Connect($host,$dbuser,$dbpassword,$dbservice) or die("Unable to connect to MySQL Database");
    $db->Execute('SET character_set_client=greek');
    $db->Execute('SET character_set_connection=greek');
    $db->Execute('SET character_set_results=greek');
  }
  elseif ($dbType == 'oracle' ) {
//    putenv("NLS_LANG=AMERICAN_AMERICA.EL8MSWIN1253");
    putenv("NLS_LANG=AMERICAN_AMERICA.EL8ISO8859P7");
    $db = NewADOConnection('oci8');
    $db -> NLS_DATE_FORMAT="YYYY/MM/DD";
    $db -> PConnect($host,$dbuser,$dbpassword,$dbservice) or die("Unable to connect to Oracle Database ".$DB_SERVER."-".$DB_USER."-".$DB_PSWD."-".$DB_NAME);
//  $db->debug = true;
  }
  else {
    echo "Δεν είναι σωστές οι ρυθμίσεις για την σύνδεση με την DataBase";
    $db = false;
  }
  return $db;
}

// Executes sql and returns RecordCount
function f_sqlexe($sqlexe) {
  extract($GLOBALS);
//print "sqlexe=$sqlexe<BR>";
  $rs = openSQLDB() -> Execute($sqlexe) or die("Unable to execute the SQL: $sqlexe".openSQLDB() -> ErrorMsg());
  $ReturnData = $rs->RecordCount();
  $rs->close();
  return $ReturnData;
}

function f_Getfld($sqlGetfld,$DBField) {
  extract($GLOBALS);
  $rs = openSQLDB() -> Execute($sqlGetfld) or die("Unable to execute the SQL: $sqlGetfld".openSQLDB() -> ErrorMsg());
  $ReturnData = $rs->fields["$DBField"];
  $rs->close();
  return $ReturnData;
}

function f_GetTableSet($sqlTableSet) {
  extract($GLOBALS);
  $rs = openSQLDB() -> Execute($sqlTableSet) or die("Unable to execute the SQL: $sqlTableSet.".openSQLDB() -> ErrorMsg());
  $rs->close();
  return $rs;
}

function f_GetIndexID($Description,$table,$fieldname,$fieldid,$foreas) {
  extract($GLOBALS);
  if ($Description=='') {
    $Field_ID=0;
  }
  else {
    $sqlIndexid = "SELECT ".$fieldid." FROM ".$table." WHERE ".$fieldname."='".$Description."'";
    $Field_ID=f_Getfld($sqlIndexid,$fieldid);
    if ($Field_ID=='' && $foreas!=-1){
      if ($foreas==0) {
        $sqlIndexid = "INSERT INTO ".$table." (".$fieldname.") VALUES ('".$Description."')";
      }
      else {
        $sqlIndexid = "INSERT INTO ".$table." (".$fieldname.", FOR_ID) VALUES ('".$Description."',".$foreas.")";
      }
      f_sqlexe($sqlIndexid);
      $sqlIndexid = "SELECT ".$fieldid." FROM ".$table." WHERE ".$fieldname."='".$Description."'";
      $Field_ID=f_Getfld($sqlIndexid,$fieldid);
    }
  }
  if ($Field_ID=='') $Field_ID=0;
  return $Field_ID;
}

function f_GetfldsCon($sql,$ArrayName) {
  extract($GLOBALS);
  $rs = openSQLDB() -> Execute($sql) or die("Unable to execute the SQL: $sql".openSQLDB() -> ErrorMsg());
  $OutString='';
  foreach ($ArrayName as $key => $value) {
    $OutString=$OutString.$rs->fields["$value"].' ';
  }
  $rs->close();
  return $OutString;
}

?>