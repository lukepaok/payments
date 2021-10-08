<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYMENTS
    func_payroll.php
   ---------------------------------------------------------------------------------------------------------------------------- */
session_start();
$_SESSION['VathmosIatr']=
  array(1=>'Διευθυντης' ,2=>'Επιμελητης Α', 3=>'Επιμελητης Β', 4=>'Ειδικευομενος', 5=>'Αναπληρωτης Καθηγητής',6=>'Καθηγητής',7=>'Αγροτικός Ιατρός 14',8=>'Αγροτικός Ιατρός 15',9=>'Αγροτικός Ιατρός 16',
       10=>'Λεκτορ',11=>'Επικουρος',14=>'Λοχαγος');
$_SESSION['ProsAmoiv']=
  array(21=>'KANONIKH',23=>'ARGIA',24=>'ARGNYXT',25=>'SYMPLHR',26=>'SYMPNYXT',27=>'ENERG1',28=>'ENERG2',30=>'KANONYXT',31=>'ENERG3',32=>'ENERG4',33=>'MIKTH1',34=>'MIKTH2',35=>'MIKTH3',36=>'MIKTH4',
        37=>'ETOIM1',38=>'ETOIM2',39=>'ETOIM3',40=>'ETOIM4', );

function G_DBfield($sqlGetfld,$DBField) {
  $funcres=DB_query($sqlGetfld,$db);
  $funcrow=DB_fetch_array($funcres);
  $Func_ret=$funcrow["$DBField"];
  return $Func_ret;
}

function C_Date2TS($vDate) {
  $date_array=explode('/',$vDate);
  return mktime(12,0,0,$date_array[1],$date_array[0],$date_array[2]);
}

function G_VathmosNo($fpc_empid) {
  $SQL="SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='ΒΑΘΜΟΣ_ΙΑΤΡΩΝ' ";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret=$ROW['ECOP_VALUE'];
  if ($Func_ret=='') { $Func_ret=0; }
  return $Func_ret;
}

function G_VathmosDescr($fpc_empid) {
  $SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='ΒΑΘΜΟΣ_ΙΑΤΡΩΝ' ";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  if ($ROW['ECOP_VALUE']>0) {$Func_ret = $_SESSION['VathmosIatr'][$ROW['ECOP_VALUE']]; }
  else {
    $SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='ΒΑΘΜΟΣ_ΔΥ' ";
    $RES = DB_query($SQL,$db);
    $ROW = DB_fetch_array($RES);
    $Vathmos=$ROW['ECOP_VALUE'];
    $SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='ΝΕΟ_ΚΛΙΜΑΚΙΟ' ";
    $RES = DB_query($SQL,$db);
    $ROW = DB_fetch_array($RES);
    $Func_ret = $Vathmos.' '.$ROW['ECOP_VALUE'];
  }
  return $Func_ret;
}

function G_Salid($fpc_empid,$fpc_payid) {
  $SQL = "SELECT SALARY.SAL_ID FROM SALARY WHERE SALARY.PAY_ID = ".$fpc_payid." AND SALARY.EMP_ID = ".$fpc_empid;
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret = $ROW['SAL_ID'];
  return $Func_ret;
}

function G_ExSalid($fpc_empid,$fpc_payid) {
  $SQL = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$fpc_empid." AND SALARY.PAY_ID=".$fpc_payid;
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
//echo $SQL;die();
  $Func_ret = $ROW['EXSAL_ID'];
  return $Func_ret;
}

function G_Ex2Salid($fpc_empid,$fpc_payid) {
  $SQL = "SELECT SALARY.SAL_ID, EXTRA2_SALARY.EXSAL_ID FROM EXTRA2_SALARY, SALARY WHERE EXTRA2_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA2_SALARY.EMP_ID =".$fpc_empid." AND SALARY.PAY_ID=".$fpc_payid;
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret = $ROW['EXSAL_ID'];
  return $Func_ret;
}
function G_VarTakt($fpc_type,$fpc_descr) {
  $SQL = "SELECT XMLD_NAME FROM XML_DETAIL WHERE XMLD_DESCR='".$fpc_descr."' AND XMLD_TYPE='".$fpc_type."'";
  if (substr($fpc_descr,0,16)=='Νοσοκομειακό Επ.') { $SQL = "SELECT XMLD_NAME FROM XML_DETAIL WHERE SUBSTR(XMLD_DESCR,1,17)='".substr($fpc_descr,0,17)."' AND XMLD_TYPE='".$fpc_type."'"; }
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret = $ROW['XMLD_NAME'];
  if ($Func_ret=='') { $Func_ret = '!!! AGNOSTO !!!'; }
  return $Func_ret;
}

function G_Mod_VarName($fpc_type,$fpc_mod_id) {
  $SQL = "SELECT BDL_VAR FROM BDLRE_GROUP WHERE BDL_ID='".$fpc_mod_id."' AND BDL_TYPE='".$fpc_type."'";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret = $ROW['BDL_VAR'];
  if ($Func_ret=='') { $Func_ret = 'AGNOSTO'; }
  return $Func_ret;
}

function G_VarPA($fpc_type,$fpc_descr,$fpc_tid) {
  if ($fpc_type=='HOUR') { $Func_ret = $_SESSION['ProsAmoiv'][$fpc_tid]; }
  elseif ($fpc_type=='EXTH') { $Func_ret = 'BONUS'; }
  elseif ($fpc_type=='PLAE') { $Func_ret = 'PER_EFHMAP'; }
  elseif ($fpc_type=='PLAF') { $Func_ret = 'PLAFON'; }
  elseif ($fpc_type=='PLAP') { $Func_ret = 'PER_AP'; }
  elseif ($fpc_type=='SEVE') { $Func_ret = 'SEVEN'; }
  else {
    $SQL = "SELECT XMLD_NAME FROM XML_DETAIL WHERE XMLD_DESCR='".$fpc_descr."' AND XMLD_TYPE='".$fpc_type."'";
    $RES = DB_query($SQL,$db);
    $ROW = DB_fetch_array($RES);
    $Func_ret = $ROW['XMLD_NAME'];
  }
  if ($Func_ret=='') { $Func_ret = '!!! AGNOSTO !!!'; }
  return $Func_ret;
}


?>