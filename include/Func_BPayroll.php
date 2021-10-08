<?php
/* --------------------------------------------------------------
    PAYROLL
    Func_BPayroll.php
    01-12/12/2012
    include:
   -------------------------------------------------------------- */

session_start();
//--------------------------------------------------------------------------------------------------------------------

//---------------------------------------------------   DATABASE   ---------------------------------------------------
function Get_DBfield($sqlGetfld,$DBField) {
  $funcres  = DB_query($sqlGetfld,$db);
  $funcrow  = DB_fetch_array($funcres);
  $Func_ret = $funcrow["$DBField"];
  return $Func_ret;
}

function Exec_sql($sqlexe) {
  $funcres  = DB_query($sqlexe,$db);
  $Func_ret = DB_num_rows($funcres);
  return $Func_ret;
}

//---------------------------------------------------     DATES     ---------------------------------------------------

function Get_Date_Array($Date) {
  // Format Date='dd/mm/yyyy'
  $date_array=explode('/', $Date);
  return $date_array;
}

//---------------------------------------------------  MISTHODOSIA  ---------------------------------------------------

//----  PAY_ID    ------------------------
function Find_Pay_id($fpc_monthper,$fpc_yearper) {
  $funcsql = "SELECT PAYROLL_TRANSACTIONS.PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAYROLL_TRANSACTIONS.PAT_ID = ".$fpc_monthper." AND PAYROLL_TRANSACTIONS.PAY_YEAR = ".$fpc_yearper;
//echo $funcsql;
  $Func_ret = Get_DBfield($funcsql,'PAY_ID');
  return $Func_ret;
}

//----  SAL_ID    ------------------------
function Find_Sal_id($fpc_empid,$fpc_monthper,$fpc_yearper) {
  $Func_ret = 0;
  $Pay_id=Find_Pay_id($fpc_monthper,$fpc_yearper);
  if ($Pay_id>0) {
    $funcsql = "SELECT SALARY.SAL_ID FROM SALARY WHERE SALARY.PAY_ID = ".$Pay_id." AND SALARY.EMP_ID = ".$fpc_empid;
    $Func_ret = Get_DBfield($funcsql,'SAL_ID');
  }
  return $Func_ret;
}

//----  BEN,DED,TAX,LOAN,REC.... ---------
function Find_Misth_Part($fpc_salid,$fpc_part) {
  $funcsql = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE = '".$fpc_part."' ";
  $funcres =DB_query($funcsql,$db);
  $funcrow =DB_fetch_array($funcres);
  $Func_ret = $funcrow['CREDIT']-$funcrow['DEBIT'];
  if (in_array($fpc_part,array('DED','EDED','×DED','TAX','LOAN','REC'))) { $Func_ret = - $Func_ret; }
  return $Func_ret;
}

// BASIKOS + EPIDOMATA
function Comp_Mikta($fpc_empid,$fpc_yearper,$fpc_monthper) {
  $Func_ret = 0;
  $fpc_payid=find_payid($fpc_yearper,$fpc_monthper);
  $fpc_salid=find_salid($fpc_payid,$fpc_empid);
  if ($fpc_salid!='') {
    $fpc_misthbas=find_misth_part($fpc_salid,'BAS');
    $fpc_misthben=find_misth_part($fpc_salid,'BEN');
    $fpc_misthxben=find_misth_part($fpc_salid,'EBEN');
    $Func_ret = $fpc_misthbas+$fpc_misthben+$fpc_misthxben;
  }
  return $Func_ret;
}

// BASIKOS + EPIDOMATA - KRATHSEIS
function Comp_Clear($fpc_empid,$fpc_yearper,$fpc_monthper) {
  $Func_ret = 0;
  $mikta_month_misth = cmpt_mikta($fpc_empid,$fpc_yearper,$fpc_monthper);
  $fpc_payid=find_payid($fpc_yearper,$fpc_monthper);
  $fpc_salid=find_salid($fpc_payid,$fpc_empid);
  if ($fpc_salid!='') {
    $fpc_misthded=find_misth_part($fpc_salid,'DED');
    $Func_ret = $mikta_month_misth - $fpc_misthded;
  }
  return $Func_ret;
}

function G_One_BDLRE($fpc_empid,$fpc_month,$fpc_year,$fpc_module,$fpc_mod_name) {
  include ('include/v_BDLRE.php');
  $stub = '';
  if ($fpc_module=='BEN') {
    foreach($custom_benefits[$fpc_mod_name] as $kv=>$vv) {
      if ($stub!='') $stub .= ' OR ';
      if (empty($vv)) { $stub .= ' ESAD_DESCRIPTION=\''.$kv.'\' '; }
      else { $stub .= ' SUBSTR(ESAD_DESCRIPTION,'.$vv[0].','.$vv[1].')=\''.$kv.'\' '; }
    }
  }
  elseif ($fpc_module=='BEN_RETRO') {
    foreach($custom_ben_retro[$fpc_mod_name] as $kv=>$vv) {
      if ($stub!='') $stub .= ' OR ';
      if (empty($vv)) { $stub .= ' RDET_DESCRIPTION=\''.$kv.'\' '; }
      else { $stub .= ' SUBSTR(RDET_DESCRIPTION,'.$vv[0].','.$vv[1].')=\''.$kv.'\' '; }
    }
  }
  elseif ($fpc_module=='DED') {
    foreach ($custom_deductions_emp[$fpc_mod_name] as $kv=>$vv) {
      if ($stub!='') $stub .= ' OR ';
      if (empty($vv)) { $stub .= " ESAD_DESCRIPTION='".$kv."' "; }
      else { $stub .= ' SUBSTR(ESAD_DESCRIPTION,'.$vv[0].','.$vv[1].")='".$kv."' "; }
    }
  }
  elseif ($fpc_module=='ERGDED') {
    foreach($custom_deductions_erg[$fpc_mod_name] as $kv=>$vv) {
      if ($stub!='') $stub .= ' OR ';
      if (empty($vv)) { $stub .= ' OSAD_DESCRIPTION=\''.$kv.'\' '; }
      else { $stub .= ' SUBSTR(OSAD_DESCRIPTION,'.$vv[0].','.$vv[1].')=\''.$kv.'\' '; }
    }
  }
  $Date_from  = "01/".str_pad($fpc_month,2,"0",str_pad_left)."/".$fpc_year;
  $Date_to    = getDaysInMonth($Date_from)."/".str_pad($fpc_month,2,"0",str_pad_left)."/".$fpc_year;
  $funcsql    = "SELECT SALARY.SAL_ID FROM SALARY, PAYROLL_TRANSACTIONS WHERE SALARY.EMP_ID = ".$fpc_empid;
  $funcsql   .= " AND SALARY.PAY_ID = PAYROLL_TRANSACTIONS.PAY_ID ";
  $funcsql   .= " AND PAY_YEAR = ".$fpc_year;
  $funcsql   .= " AND SALARY.PAT_ID = ".$fpc_month;
  $funcsql   .= " AND SAL_DATE >= ".FormatDateForSQL($Date_from)." AND SAL_DATE < ".FormatDateForSQL(dateadd($Date_to,'d',1));
  $funcres    = DB_query($funcsql,$db);
  $Amount     = 0;
  $fpc_Amount = 0;
  while ($funcrow=DB_fetch_array($funcres)) {
    $fpc_salid = $funcrow['SAL_ID'];
    if ($fpc_module=='BEN') {
      $bensql  = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE='BEN' AND ( ";
      $bensql .= $stub;
      $bensql .= ' ) ';
      $benrs   = DB_query($bensql,$db);
      $benrow  = DB_fetch_array($benrs);
      $Amount  = $benrow['CREDIT']-$benrow['DEBIT'];
    }
    elseif ($fpc_module=='BEN_RETRO') {
      $tmpsql  = "SELECT SUM(RD.RDET_CREDIT) AS CREDIT, SUM(RD.RDET_DEBIT) AS DEBIT FROM RETRO_DETAIL RD,RETRO_MASTER RM ";
      $tmpsql .= " WHERE RM.SAL_ID_TO=".$fpc_salid." AND RM.RMST_ID=RD.RMST_ID AND RD.RDET_MODULE='BEN' AND ( ";
      $tmpsql .= $stub;
      $tmpsql .= " ) ";
      $tmpres  = DB_query($tmpsql,$db);
      $tmprow  = DB_fetch_array($tmpres);
      $Amount  = $tmprow['CREDIT']-$tmprow['DEBIT'];
    }
    elseif ($fpc_module=='DED') {
      $dedsql  = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE='DED' AND ( ";
      $dedsql .= $stub;
      $dedsql .= ' ) ';
      $dedrs   = DB_query($dedsql,$db);
      $dedrow  = DB_fetch_array($dedrs);
      $Amount  = $dedrow['DEBIT']-$dedrow['CREDIT'];
    }
    elseif ($fpc_module=='ERGDED') {
      $bensql  = "SELECT SUM(OSAD_CREDIT) AS CREDIT, SUM(OSAD_DEBIT) AS DEBIT FROM SALARY_ERG_DETAIL WHERE SAL_ID=".$fpc_salid." AND OSAD_MODULE='DED' AND ( ";
      $bensql .= $stub;
      $bensql .= ' ) ';
      $benrs   = DB_query($bensql,$db);
      $benrow  = DB_fetch_array($benrs);
      $Amount  = $benrow['DEBIT']-$benrow['CREDIT'];
    }
    if ($Amount!=0) { $fpc_Amount=$Amount; }
  }
  return $fpc_Amount;
}



?>