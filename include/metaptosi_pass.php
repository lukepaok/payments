<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYMENTS
    metaptosi_pass.php
---------------------------------------------------------------------------------------------------------------------------- */
global $db;
$sql2="SELECT * FROM EMPLOYESS ";
$RES2=DB_query($sql2,$db);
while ($DetailRow2=DB_fetch_array($RES2)) {
  $PPassword=$DetailRow2['EMP_PAYROLL_CODE'];
  if ($_SESSION['GLInstall']=='YPE2') { $PPassword=$DetailRow2['EMP_AMKA']; }
  $sql3='INSERT INTO "ACCESS" (ACC_ID,EMP_ID,BRA_ID,FOR_ID,ACC_USERNAME,ACC_PASSWORD,ACC_REALNAME) VALUES("",'.$DetailRow2['EMP_ID']."','0','0','".
         $DetailRow2['EMP_TAX_NUMBER']."','".$PPassword."','".$DetailRow2['EMP_LAST_NAME']." ".$DetailRow2['EMP_FIRST_NAME']."')";
  $RES3=DB_query($sql3,$db);
}
print'текос диадийасиас';die();
?>