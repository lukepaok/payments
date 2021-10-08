<?php
session_start();
//--------------------------------------------------------------------------------------------------------------------

function G_Per_DBfield($sqlGetfld,$DBField) {
  $funcres  = DB_query($sqlGetfld,$db);
  $funcrow  = DB_fetch_array($funcres);
  $Func_ret = $funcrow["$DBField"];
  return $Func_ret;
}

function f_Per_sqlexe($sqlexe) {
  $funcres  = DB_query($sqlexe,$db);
  return $funcres->RecordCount();
}

function Get_Yphresia($vf_emp_id,$vf_endate) {
//  $Func_ret=array();
  $funcsql  = "SELECT EMPDATES_DATE FROM EMP_DATES WHERE EMPDDEFS_ID = ".$_SESSION['GLDiorismos']." AND EMP_ID = ".$vf_emp_id;
  $funcres  = DB_query($funcsql,$db);
  $funcrow  = DB_fetch_array($funcres);
  $HmDior   = ConvertSQLDate($funcrow['EMPDATES_DATE']);
  $Func_ret['HmDior']=$HmDior;
  $Yphresia = YearsMonthsDaysNew($vf_endate,$HmDior);
  $Func_ret['yphr']=array('YY'=>$Yphresia['y'],'MM'=>$Yphresia['m'],'DD'=>$Yphresia['d']);

  $funcsql  = "SELECT SUM(EXP_YEARS) AS YY, SUM(EXP_MONTHS) AS MM, SUM(EXP_DAYS) AS DD ";
  $funcsql .= "FROM EXPERIENCE WHERE EXP_LOGISMOS=1 AND EMP_ID =".$vf_emp_id;
  $funcres  = DB_query($funcsql,$db);
  $funcrow  = DB_fetch_array($funcres);
  $days = 360 * $funcrow['YY'] + 30 * $funcrow['MM'] + $funcrow['DD'];
  $years = intval($days / 360);
  $months = intval(($days - ($years*360)) / 30);
  $days = $days - ($years*360) - ($months*30);
  $Func_ret['proyphr1']=array('YY'=>$years,'MM'=>$months,'DD'=>$days);

  $funcsql  = "SELECT SUM(EXP_YEARS) AS YY, SUM(EXP_MONTHS) AS MM, SUM(EXP_DAYS) AS DD ";
  $funcsql .= "FROM EXPERIENCE WHERE EXP_LOGISMOS=2 AND EMP_ID =".$vf_emp_id;
  $funcres  = DB_query($funcsql,$db);
  $funcrow  = DB_fetch_array($funcres);
  $days = 360 * $funcrow['YY'] + 30 * $funcrow['MM'] + $funcrow['DD'];
  $years = intval($days / 360);
  $months = intval(($days - ($years*360)) / 30);
  $days = $days - ($years*360) - ($months*30);
  $Func_ret['proyphr2']=array('YY'=>$years,'MM'=>$months,'DD'=>$days);

  $funcsql  = "SELECT SUM(EXP_YEARS) AS YY, SUM(EXP_MONTHS) AS MM, SUM(EXP_DAYS) AS DD ";
  $funcsql .= "FROM EXPERIENCE WHERE EXP_LOGISMOS=3 AND EMP_ID =".$vf_emp_id;
  $funcres  = DB_query($funcsql,$db);
  $funcrow  = DB_fetch_array($funcres);
  $days = 360 * $funcrow['YY'] + 30 * $funcrow['MM'] + $funcrow['DD'];
  $years = intval($days / 360);
  $months = intval(($days - ($years*360)) / 30);
  $days = $days - ($years*360) - ($months*30);
  $Func_ret['proyphr3']=array('YY'=>$years,'MM'=>$months,'DD'=>$days);

  $TotalDays = 360 * ($Func_ret['proyphr1']['YY'] + $Func_ret['proyphr2']['YY'] + $Func_ret['proyphr3']['YY']) +
                30 * ($Func_ret['proyphr1']['MM'] + $Func_ret['proyphr2']['MM'] + $Func_ret['proyphr3']['MM']) +
                     ($Func_ret['proyphr1']['DD'] + $Func_ret['proyphr2']['DD'] + $Func_ret['proyphr3']['DD']);
  $TotYears  = intval($TotalDays / 360);
  $TotMonths = intval(($TotalDays - ($TotYears*360)) / 30);
  $TotDays   = $TotalDays - ($TotYears*360) - ($TotMonths*30);
  $Func_ret['proyphr']=array('YY'=>$TotYears,'MM'=>$TotMonths,'DD'=>$TotDays);

  $TotalDays = 360 * ($Func_ret['yphr']['YY'] + $Func_ret['proyphr1']['YY'] + $Func_ret['proyphr2']['YY'] + $Func_ret['proyphr3']['YY']) +
                30 * ($Func_ret['yphr']['MM'] + $Func_ret['proyphr1']['MM'] + $Func_ret['proyphr2']['MM'] + $Func_ret['proyphr3']['MM']) +
                     ($Func_ret['yphr']['DD'] + $Func_ret['proyphr1']['DD'] + $Func_ret['proyphr2']['DD'] + $Func_ret['proyphr3']['DD']);
  $TotYears  = intval($TotalDays / 360);
  $TotMonths = intval(($TotalDays - ($TotYears*360)) / 30);
  $TotDays   = $TotalDays - ($TotYears*360) - ($TotMonths*30);
  $Func_ret['yphrpluspro']=array('YY'=>$TotYears,'MM'=>$TotMonths,'DD'=>$TotDays);

  $funcsql  = "SELECT SUM(T.TRANM_AMOUNT) AS DD ";
  $funcsql .= "  FROM TRA_MANUAL T, EMPLOYEES E LEFT JOIN DIEYTHINSEIS D ON D.DIEY_ID = E.DIEY_ID, METAVOLES_MASTER M, METAVOLES_DEF DEF, TRANS_ADIES A ";
  $funcsql .= " WHERE E.EMP_ID = ".$vf_emp_id;
  $funcsql .= "   AND E.EMP_ID = T.EMP_ID AND M.METM_ID = T.METM_ID ";
  $funcsql .= "   AND DEF.METDEF_ID = M.METDEF_ID AND A.TRANM_ID = T.TRANM_ID ";
  $funcsql .= "   AND TRANM_KIND = 4 AND DEF.METDEF_ID in (".$_SESSION['GLAnefApod'].")";
  $funcres  = DB_query($funcsql,$db);
  $funcrow  = DB_fetch_array($funcres);
  $Arn_days = $funcrow['DD'];
  $years = intval($Arn_days / 360);
  $months = intval(($Arn_days - ($years*360)) / 30);
  $days = $Arn_days - ($years*360) - ($months*30);
  $Func_ret['arnit']=array('YY'=>$years,'MM'=>$months,'DD'=>$days);

  $TotalDays = $TotalDays - $Arn_days;
  $TotYears  = intval($TotalDays / 360);
  $TotMonths = intval(($TotalDays - ($TotYears*360)) / 30);
  $TotDays   = $TotalDays - ($TotYears*360) - ($TotMonths*30);
  $Func_ret['finalyphr']=array('YY'=>$TotYears,'MM'=>$TotMonths,'DD'=>$TotDays);

  return $Func_ret;
}










?>