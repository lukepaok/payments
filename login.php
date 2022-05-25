<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYMENTS
    login.php
---------------------------------------------------------------------------------------------------------------------------- */
include ('includes/session.inc');
ini_set('default_charset', 'ISO-8859-7');
$user=$_POST['name'];
$pass=$_POST['password'];
global $db;
//$SQL_User = 'SELECT EMP_ID FROM "ACCESS" WHERE ACC_USERNAME='."'".$_POST['name']."' AND ACC_PASSWORD='".iconv('UTF-8','ISO-8859-7', $_POST['password'])."'";
$SQL_User='SELECT EMP_ID FROM "ACCESS" WHERE ACC_USERNAME='."'".$_POST['name']."' AND ACC_PASSWORD='".$_POST['password']."'";
$RES_User=DB_query($SQL_User,$db);
$ROW_User=DB_fetch_array($RES_User);
if (DB_num_rows($RES_User)>0) {
  unset($_SESSION['FirstName']);
  unset($_SESSION['LastName']);
  unset($_SESSION['AFM']);
  unset($_SESSION['PayrollCode']);
  $exsql  = " SELECT * FROM EMPLOYEES WHERE EMP_TAX_NUMBER='".$_POST['name']."' AND EMP_ID=".$ROW_User['EMP_ID']."";
  $exres  = DB_query($exsql,$db);
  $exrow  = DB_fetch_array($exres);
  print 'pass';
  $_SESSION['FirstName'] = $exrow['EMP_FIRST_NAME'];
  $_SESSION['LastName'] = $exrow['EMP_LAST_NAME'];
  $_SESSION['AFM'] = $exrow['EMP_TAX_NUMBER'];
  $_SESSION['PayrollCode'] = $exrow['EMP_PAYROLL_CODE'];
}
else { print 'fail'; }
?>
