<?php
session_start();
//--------------------------------------------------------------------------------------------------------------------

//---------------------------------------------------   DATABASE   ---------------------------------------------------
function Get_DBfield($sqlGetfld,$DBField) {
  $funcres  = DB_query($sqlGetfld,$db);
  $funcrow  = DB_fetch_array($funcres);
  $Func_ret = $funcrow["$DBField"];
  return $Func_ret;
}

//---------------------------------------------------  MISTHODOSIA  ---------------------------------------------------

//----  PAY_ID    ------------------------
function find_payid($fpc_yearper,$fpc_monthper) {
  $funcsql = "SELECT PAYROLL_TRANSACTIONS.PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAYROLL_TRANSACTIONS.PAT_ID = ".$fpc_monthper." AND PAYROLL_TRANSACTIONS.PAY_YEAR = ".$fpc_yearper;
//echo $funcsql;
  $Func_ret = Get_DBfield($funcsql,'PAY_ID');
  return $Func_ret;
}

//----  SAL_ID    ------------------------
function find_salid($fpc_payid,$fpc_empid) {
  $funcsql = "SELECT SALARY.SAL_ID FROM SALARY WHERE SALARY.PAY_ID = ".$fpc_payid." AND SALARY.EMP_ID = ".$fpc_empid;
  $Func_ret = Get_DBfield($funcsql,'SAL_ID');
  return $Func_ret;
}

//----  BEN,DED,TAX,LOAN,REC.... ---------
function find_misth_part($fpc_salid,$fpc_part) {
  $funcsql = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE = '".$fpc_part."' ";
  $funcres =DB_query($funcsql,$db);
  $funcrow =DB_fetch_array($funcres);
  $Func_ret = $funcrow['CREDIT']-$funcrow['DEBIT'];
  if (in_array($fpc_part,array('DED','EDED','×DED','TAX','LOAN','REC'))) { $Func_ret = - $Func_ret; }
  return $Func_ret;
}

// YPOLOGISMOS MHNA STON OPOIO YPARXEI MISTHODOSIA
function cmp_last_misth($fpc_empid,$fpc_yearper,$fpc_monthper) {
  //PROSOXH periodos: 13=Xristougenna, 14=Pasxa, 15=Adeia
//  $Func_ret = array('month'=>0,'year'=>0);
  if ($fpc_monthper==12) { //XRISTOYGENNA
    $Current_month=12;
    $Current_year=$fpc_yearper;
    $Last_month=4;
    $Last_year=$fpc_yearper;
    $Current_per=$Current_year.'12';
    $Last_per   =$Last_year.'04';
  }
  elseif ($fpc_monthper==4) { //PASXA
    $Current_month=4;
    $Current_year=$fpc_yearper;
    $Last_month=12;
    $Last_year=$fpc_yearper-1;
    $Current_per=$Current_year.'04';
    $Last_per   =$Last_year.'12';
  }
  elseif ($fpc_monthper==7) { //ADEIA
    $Current_month=7;
    $Current_year=$fpc_yearper;
    $Last_month=6;
    $Last_year=$fpc_yearper-1;
    $Current_per=$Current_year.'07';
    $Last_per   =$Last_year.'06';
  }
  $Misth_a=0;
  $Misth_b=0;
  $Month_a=0;
  $Year_a =0;
  
//echo $Current_month.' ZXCVB '.$Current_year.' CVBNM '.$Current_per.' ZXCVB '.$Current_year.' CVBNM '.$Last_per.' CVBNM <BR>';
//  while (($Current_month>=$Last_month && $Current_year>=$Last_year) || ($Misth_a<=0 && $Misth_b<=0)) {
//  while (($Current_month>=$Last_month && $Current_year>=$Last_year) && ($Misth_a<=0 && $Misth_b<=0)) {
  while (($Current_per>=$Last_per) && ($Misth_a<=0 && $Misth_b<=0)) {
    $fpc_payid=find_payid($Current_year,$Current_month);
    $fpc_salid=find_salid($fpc_payid,$fpc_empid);
//echo ' |XCVBN| '.$Current_year.' |XCVBN| '.$Current_month.' |XCVBN| '.$fpc_payid.' |XCVBN| '.$fpc_salid.' |QWERTY| <BR>'.PHP_EOL;
    if ($fpc_salid!='') {
      $fpc_misthbas=find_misth_part($fpc_salid,'BAS');
      $fpc_misthben=find_misth_part($fpc_salid,'BEN');
      $fpc_misthxben=find_misth_part($fpc_salid,'EBEN');
//echo $Current_year.' XCVBN '.$Current_month['month'].' XCVBN '.$fpc_misthbas['year'].' QWERTY <BR>';
      $Mikta = $fpc_misthbas+$fpc_misthben+$fpc_misthxben;
      if ($Mikta>0) {
        if ($Misth_a==0) {
          $Misth_a=$Mikta;
          $Month_a=$Current_month;
          $Year_a =$Current_year;
        }
        else {
          $Misth_b=$Mikta;
          $Month_b=$Current_month;
          $Year_b =$Current_year;
        }
      }
    }
    if ($Current_month==1) {
      $Current_month=12;
//      $Last_year=$Last_year-1;
      $Current_year=$Current_year-1;
      $Current_per =$Current_year.'12';
    }
    else {
      $Current_month=$Current_month-1;
      $Current_per  =$Current_per-1;
    }
//echo ' |XCVBN| '.$Current_per.' |XCVBN| '.$Last_per.' |XCVBN| '.$Current_year.' |XCVBN| '.$Current_month.' |XCVBN| '.$fpc_payid.' |XCVBN| '.$fpc_salid.' |QWERTY| <BR>'.PHP_EOL;
  }
  if ($Misth_b>$Misth_a) {
    $Func_ret = array('month'=>$Month_b,'year'=>$Year_b);
  }
  else {
    $Func_ret = array('month'=>$Month_a,'year'=>$Year_a);
  }
  return $Func_ret;
}

// BASIKOS + EPIDOMATA
function cmpt_mikta($fpc_empid,$fpc_yearper,$fpc_monthper) {
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
function cmpt_clear($fpc_empid,$fpc_yearper,$fpc_monthper) {
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
//--------------------------------------------------------------------------------------------------------------------

function cmpt_strike_days($fpc_empid,$fpc_date_from,$fpc_date_to) {
  $funcsql = "SELECT COUNT(ISSTRIKE) AS STRIKEDAYS FROM ATTENDANCE WHERE EMP_ID=".$fpc_empid." AND ATT_DATE BETWEEN TO_DATE('".$fpc_date_from."','dd/mm/yyyy') AND TO_DATE('".$fpc_date_to."','dd/mm/yyyy') AND ISSTRIKE=1";
  $Func_ret = Get_DBfield($funcsql,'STRIKEDAYS');
  return $Func_ret;
}

//--------------------------------------------------------------------------------------------------------------------

function cmp_dorobasic($fpc_empid, $fpc_yearper, $fpc_per, $fpc_mikta) {
  $Plafon_doro = 36000;
  $Doro_year = array(13 => 500, 14 => 250, 15 => 250); //PROSOXH 13=Xristougenna, 14=Pasxa, 15=Adeia
  $From_year=$fpc_yearper-1;
  $Doro_from = array(13 => '16/04/'.$fpc_yearper, 14 => '16/12/'.$From_year,   15 => '01/07/'.$From_year);
  $Doro_to   = array(13 => '15/12/'.$fpc_yearper, 14 => '15/04/'.$fpc_yearper, 15 => '30/06/'.$fpc_yearper);
  $Doro_days = array(13 => 240, 14 => 120, 15 => 360);

  $Sum_Year_dora = $Doro_year[13] + $Doro_year[14] + $Doro_year[15];
  $Sum_Year_Mikta = $fpc_mikta * 12 + $Sum_Year_dora;


  //echo '|$Sum_Year_Mikta| '.$Last_misth['month'].' |XCVBN| '.$Last_misth['year'].' |QWERTY|'.PHP_EOL;

  if ($Sum_Year_Mikta <= $Plafon_doro) { $Doro_basic = $Doro_year[$fpc_per]; }
  elseif ($Sum_Year_Mikta >= $Plafon_doro + $Sum_Year_dora) { $Doro_basic = 0;}
  else {
    $New_sum_dora = $Plafon_doro + $Sum_Year_dora - $Sum_Year_Mikta;
    $Doro_basic = $Doro_year[$fpc_per] * $New_sum_dora / $Sum_Year_dora;
  }

// EPANERGOPOIHSH TWN HMERWN APERGIAS
  $Strike_days = cmpt_strike_days($fpc_empid,$Doro_from[$fpc_per],$Doro_to[$fpc_per]);
//$Strike_days = 0 ;
// EPANERGOPOIHSH TWN HMERWN APERGIAS

  $Func_ret = $Doro_basic;
  if ($Strike_days>0) {
    $New_doro_days = $Doro_days[$fpc_per] - $Strike_days;
    $Func_ret = $New_doro_days * $Doro_basic / $Doro_days[$fpc_per];
  }
  return $Func_ret;
}

//----  PAY_ID    ------------------------
function find_ded_1011($fpc_empid,$fpc_dedescr) {
  $funcsql = "SELECT * FROM DEDS_1011 WHERE EMP_ID = ".$fpc_empid;
  $Func_ret = Get_DBfield($funcsql,$fpc_dedescr);
  return $Func_ret;
}

//--------------------------------------------------------------------------------------------------------------------
//function Cmp_Ben($FPBenefit,$FPSalid) {
//  include ('include/v_BDLRE.php');
//  $bensql  = "SELECT SUM(ESAD_CREDIT) AS CREDIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$FPSalid." AND ESAD_MODULE='BEN' AND ( ";
//  $stub = '';
//  foreach($custom_benefits[$FPBenefit] as $kv=>$vv) {
//    if ($stub!='') $stub .= ' or ';
//    if (empty($vv)) { $stub .= ' ESAD_DESCRIPTION=\''.$kv.'\' '; }
//    else { $stub .= ' SUBSTR(ESAD_DESCRIPTION,'.$vv[0].','.$vv[1].')=\''.$kv.'\' '; }
//  }
//  $bensql .= $stub;
//  $bensql .= ' ) ';
//  $benrs =DB_query($bensql,$db);
//  $benrow =DB_fetch_array($benrs);
//  $Benefit_amount = $benrow['CREDIT'];
//  return $Benefit_amount;
//}

function Comp_deds_1011($fpc_empid,$fpc_ded_emp,$fpc_ded_erg,$fpc_rundays,$fpc_perdays) {
  $funcsql = "SELECT * FROM DEDS_1011 WHERE EMP_ID = ".$fpc_empid;
  $Ded_emp = Get_DBfield($funcsql,$fpc_ded_emp);
  $Func_ret['ded_emp']=($Ded_emp*$fpc_rundays)/$fpc_perdays;
  $Ded_erg = Get_DBfield($funcsql,$fpc_ded_erg);
  $Func_ret['ded_erg']=($Ded_erg*$fpc_rundays)/$fpc_perdays;
  return $Func_ret;
}

function Check_3mines($fpc_empid,$fpc_period,$fpc_year,$fpc_3mini_date,$fpc_per_days,$fpc_ded_emp,$fpc_ded_erg) {
  $Func_ret['calc'] = 'yes' ;
  $Per_date_from='01/'.$fpc_period.'/'.$fpc_year;
  $Per_date_to=getDaysInMonth($Per_date_from).'/'.$fpc_period.'/'.$fpc_year;
  if (Date1GreaterThanDate2 ($Per_date_from, $fpc_3mini_date)) {
    $Func_ret['ded_emp'] = 0 ;
    $Func_ret['ded_erg'] = 0 ;
  }
  elseif (Date1GreaterThanDate2 ($fpc_3mini_date, $Per_date_to)) {
    $Func_ret['calc'] = 'no' ;
  }
  else {
    $Trim_run_days=date_diff_exact($fpc_3mini_date, $Per_date_from);
    $Func_ret['ded_emp'] = ($fpc_ded_emp*$Trim_run_days['days'])/$fpc_per_days ;
    $Func_ret['ded_erg'] = ($fpc_ded_erg*$Trim_run_days['days'])/$fpc_per_days ;
  }
  return $Func_ret;
}

function Aneu_apodox($fpc_empid,$fpc_period,$fpc_year,$fpc_modid) {
    $fpc_period=$fpc_period-1;
	
	if ($fpc_period==0){
	$fpc_period=12;
	$fpc_year=$fpc_year-1;
    $tmpsql = 'select t.*,g.pay_year from salary_emp_detail t,salary f,payroll_transactions g ';
    $tmpsql .= ' where t.sal_id=f.sal_id and f.pay_id=g.pay_id and f.emp_id='.$fpc_empid.' and f.pat_id='.$fpc_period.' and pay_year='.$fpc_year.'';
    $tmpsql .= ' and esad_module=\'ADED\' and ESAD_MODULEID='.$fpc_modid.'';
	//ECHO $tmpsql;DIE();
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
	$result=$tmprow['ESAD_DEBIT'];
	}
	else{
	$tmpsql = 'select t.*,g.pay_year from salary_emp_detail t,salary f,payroll_transactions g ';
    $tmpsql .= ' where t.sal_id=f.sal_id and f.pay_id=g.pay_id and f.emp_id='.$fpc_empid.' and f.pat_id='.$fpc_period.' and pay_year='.$fpc_year.'';
    $tmpsql .= ' and esad_module=\'ADED\' and ESAD_MODULEID='.$fpc_modid.'';
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
	$result=$tmprow['ESAD_DEBIT'];
	}
	//ECHO $tmpsql;DIE();
	return $result;
		}
		
		
		
		
    function efedria($fpc_empid,$fpc_period,$fpc_year,$fpc_modid) {
    
	
	if ($fpc_period==0){
	$fpc_period=12;
	$fpc_year=$fpc_year-1;
    $tmpsql = 'select t.*,g.pay_year from salary_emp_detail t,salary f,payroll_transactions g ';
    $tmpsql .= ' where t.sal_id=f.sal_id and f.pay_id=g.pay_id and f.emp_id='.$fpc_empid.' and f.pat_id='.$fpc_period.' and pay_year='.$fpc_year.'';
    $tmpsql .= ' and esad_module=\'DED\' and ESAD_MODULEID='.$fpc_modid.'';
	//ECHO $tmpsql;DIE();
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
	$result=$tmprow['ESAD_DEBIT'];
	}
	else{
	$tmpsql = 'select t.*,g.pay_year from salary_emp_detail t,salary f,payroll_transactions g ';
    $tmpsql .= ' where t.sal_id=f.sal_id and f.pay_id=g.pay_id and f.emp_id='.$fpc_empid.' and f.pat_id='.$fpc_period.' and pay_year='.$fpc_year.'';
    $tmpsql .= ' and esad_module=\'DED\' and ESAD_MODULEID='.$fpc_modid.'';
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
	$result=$tmprow['ESAD_DEBIT'];
	}
	//ECHO $tmpsql;DIE();
	return $result;
		}

?>